<?php

/**
* file for the instances delegations
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\managers;
use applications\modules\instances\entities;

/**
* delegations manager
*/
class delegationsManager extends \library\baseManager
{
	/**
    * ctor
    * @return void
    */
	public function __construct()
	{
		//run baseManager constructor
		parent::__construct();
		//define name of the module
		$this->module = 'instances' ;
	}
	

	/**
	 * get delegations given for a category
	 * @param int id of the category
	 * @param int id of the user1 (delegation from)
	 * @return array containing all of the result set rows
	 */
	public function getDelegationGivenForCategories($categories, $users1)
	{
	    $req = $this->db->query("
		SELECT
			a.*,
			b.name as users1Name,
			c.name as users2Name
		FROM
			delegations a
			LEFT JOIN users b
				ON a.users1 = b.id
			LEFT JOIN users c
				ON a.users2 = c.id
		WHERE a.categories = '".$categories."'
		AND a.users1 = '".$users1."'
		AND a.instances = '0'
		");
	
	
	
	    $res = $req->fetchAll(\PDO::FETCH_OBJ);
	
	    if(isset($res[0]))
	        return $res[0];
	}
	
	
	/**
	* get delegations given for a user
	* @param int id of the user
	* @return array containing all of the result set rows
	*/
	public function getDelegationGiven($users1)
	{
		$req = $this->db->query("
		SELECT
			a.*,
			b.name as users1Name,
			c.name as users2Name,
	        i.name as instancesName,
		    ca.name as categoriesName
		FROM
			delegations a
		    LEFT JOIN instances i
		        ON a.instances = i.id		    
		    LEFT JOIN categories ca
		        ON a.categories = ca.id
			LEFT JOIN users b
				ON a.users1 = b.id
			LEFT JOIN users c
				ON a.users2 = c.id
		WHERE a.users1 = '".$users1."'
		AND a.instances = '0'
		");
		
	
		$res = $req->fetchAll(\PDO::FETCH_OBJ);
		
		return $res;
	}
	
	/**
	* get delegations receive for a category
	* @param int id of the category
	* @param int id of the users2 (delegation to)
	* @return array containing all of the result set rows
	*/
	public function getDelegationReceiveForCategories($categories, $users2)
	{
		$req = $this->db->query("
		SELECT
			a.*,
			b.name as users1Name,
			c.name as users2Name
		FROM
			delegations a
			LEFT JOIN users b
				ON a.users1 = b.id
			LEFT JOIN users c
				ON a.users2 = c.id
		WHERE a.categories = '".$categories."'
		AND a.users2 = '".$users2."'
		AND a.instances = '0'
		");
		
		$res = $req->fetchAll(\PDO::FETCH_OBJ);

		
		if(isset($res[0]) && $users2 != $res[0]->users1)
		{
			foreach($res as $r)
			{
				$valueUsers1 = $r->users1;
				
				while(isset($valueUsers1))
				{
					$req = $this->db->query("
						SELECT
							a.*,
					        concat(b.name, ' (via ', c.name, ')') as users1Name,
							c.name as users2Name
						FROM
							delegations a
							LEFT JOIN users b
								ON a.users1 = b.id
							LEFT JOIN users c
								ON a.users2 = c.id
						WHERE a.categories = '".$categories."'
						AND a.users2 = '".$valueUsers1."'
						AND a.instances = 0");
					
					
					$res2 = $req->fetchAll(\PDO::FETCH_OBJ);
					
					if(isset($res2[0]) && $valueUsers1 != $users2)
					{
						foreach($res2 as $val)
							array_push($res, $val); 
						$valueUsers1 = $res2[0]->users1;
					}
					else
						$valueUsers1 = null;
				}
			}
		}
		return $res;
	}
	
	/**
	* get delegations given for an instance
	* @param int id of the instance
	* @param int id of the users1 (delegation from)
	* @return array containing all of the result set rows
	*/
	public function getDelegationGivenForInstances($instances, $users1)
	{
		$req = $this->db->query("
		SELECT
			a.*,
			b.name as users1Name,
			c.name as users2Name
		FROM
			delegations a
			LEFT JOIN users b
				ON a.users1 = b.id
			LEFT JOIN users c
				ON a.users2 = c.id
		WHERE a.instances = '".$instances."' 
		AND a.users1 = '".$users1."'
		");
	
		$res = $req->fetchAll(\PDO::FETCH_OBJ);
		
		if(isset($res[0]))
			return $res[0];
	}
	

	/**
	* get delegations receive for an instance
	* @param int id of the category
	* @param int id of the instance
	* @param int id of the users2 (delegation to)
	* @return array containing all of the result set rows
	*/
	public function getDelegationReceiveForInstances($instances, $users2, $categories=null )
	{
		$req = $this->db->query("
		SELECT
			a.*,
			b.name as users1Name,
			c.name as users2Name
		FROM
			delegations a
			LEFT JOIN users b
				ON a.users1 = b.id
			LEFT JOIN users c
				ON a.users2 = c.id
		WHERE a.instances = '".$instances."'
		AND a.users2 = '".$users2."'
		");

		$res = $req->fetchAll(\PDO::FETCH_OBJ);
		
		if(isset($res[0]) && $users2 != $res[0]->users1)
		{
			foreach($res as $r)
			{
				$valueUsers1 = $r->users1;
				
				while(isset($valueUsers1))
				{
					$req = $this->db->query("
						SELECT
							a.*,
							concat(b.name, ' (via ', c.name, ')') as users1Name,
							c.name as users2Name
						FROM
							delegations a
							LEFT JOIN users b
								ON a.users1 = b.id
							LEFT JOIN users c
								ON a.users2 = c.id
						WHERE a.categories = '".$categories."'
						AND a.instances = '".$instances."'
						AND a.users2 = '".$valueUsers1."'
						");
					
					
					$res2 = $req->fetchAll(\PDO::FETCH_OBJ);
					if(isset($res2[0]) && $valueUsers1 != $users2)
					{
						foreach($res2 as $val)
							array_push($res, $val); 
						$valueUsers1 = $res2[0]->users1;
					}
					else
						$valueUsers1 = null;
				}
			}
		}
		//get delegations from categories
		if($categories != null)
		    foreach($this->getDelegationReceiveForCategories($categories, $users2) as $v)
		        array_push($res, $v);
		    
			
		return $res;
	}
	
	
	
	/**
	 * add or update a delegation
	 * @param entity delegation
	 * @return boolean
	 */
	public function save(\applications\modules\instances\entities\delegationsEntity $delegations)
	{
		if($delegations->getId() == "")
			$sql = "INSERT INTO delegations";
		else
			$sql = "UPDATE delegations";
	
		$sql .= "
			SET
			users1		= :users1,
			users2		= :users2,
			categories	= :categories,
			instances	= :instances";
	
		if($delegations->getId() != "")
			$sql .= " WHERE id = :id ";
	
		$req = $this->db->prepare($sql);
	
		if($delegations->getId() != "")
			$req->bindValue(":id", $delegations->getId());
	
	
		$req->bindValue(":users1", $delegations->getUsers1());
		$req->bindValue(":users2", $delegations->getUsers2());
		$req->bindValue(":categories", $delegations->getCategories());
		$req->bindValue(":instances", $delegations->getInstances());
	
		return $req->execute() ? true : false;
	}
	

	
	/**
	* delete delegation(s) for categories
	* @param array or int of the categories
	* @param int id of the users1 (delegation from)
	* @return booleean
	*/
	public function deleteForCategories($categories, $users1)
	{
		if(is_array($categories))
		    foreach($categories as $key=>$value)
		        return $this->db->exec("DELETE FROM delegations WHERE categories = '".$value."' and users1 = '".$users1."' and instances = 0") ? true : false;
		else
			return $this->db->exec("DELETE FROM delegations WHERE categories = '".$categories."' and users1 = '".$users1."' and instances = 0") ? true : false;
	}
	
	/**
	* delete delegation(s) for instances
	* @param array or int of the instances
	* @param int id of the users1 (delegation from)
	* @return booleean
	*/
	public function deleteForInstances($instances, $users1)
	{
		if(is_array($instances))
		    foreach($instances as $key=>$value)
		        return $this->db->exec("DELETE FROM delegations WHERE instances = '".$value."' and users1 = '".$users1."'") ? true : false;
		else
			return $this->db->exec("DELETE FROM delegations WHERE instances = '".$instances."' and users1 = '".$users1."'") ? true : false;
	}
	
	
	/**
	 * get delegations receive for a user
	 * @param int id of the users2 (delegation to)
	 * @return array containing all of the result set rows
	 */
	public function getDelegationReceive($users2)
	{
	    $req = $this->db->query("
		SELECT
			a.*,
			b.name as users1Name,
			c.name as users2Name,
	        i.name as instancesName,
		    ca.name as categoriesName
		FROM
			delegations a
		    LEFT JOIN instances i
		       ON  a.instances = i.id
	        LEFT JOIN categories ca
	            ON a.categories = ca.id
			LEFT JOIN users b
				ON a.users1 = b.id
			LEFT JOIN users c
				ON a.users2 = c.id
		WHERE a.users2 = '".$users2."'
	    ORDER BY instances
		");
	
	    $res = $req->fetchAll(\PDO::FETCH_OBJ);
	    
	    if(isset($res[0]) && $users2 != $res[0]->users1)
	    {
	        foreach($res as $r)
	        {
	            $valueUsers1 = $r->users1;
	            $valuesCategories = $r->categories;
	            $valuesInstances = $r->instances;
	
	            while(isset($valueUsers1))
	            {
	                $req = $this->db->query("
						SELECT
							a.*,
							concat(b.name, ' (via ', c.name, ')') as users1Name,
							c.name as users2Name,
                	        i.name as instancesName,
                		    ca.name as categoriesName
						FROM
							delegations a
                		    LEFT JOIN instances i
                		        ON a.instances = i.id
                	        LEFT JOIN categories ca
                	            ON a.categories = ca.id
							LEFT JOIN users b
								ON a.users1 = b.id
							LEFT JOIN users c
								ON a.users2 = c.id
						WHERE a.users2 = '".$valueUsers1."'
	                    AND        a.categories = '".$valuesCategories."'
						");

	                	
	                $res2 = $req->fetchAll(\PDO::FETCH_OBJ);
	                
	                
	                if(isset($res2[0]) && $valueUsers1 != $users2)
	                {
	                    foreach($res2 as $val)
	                        array_push($res, $val);
	                    $valueUsers1 = $res2[0]->users1;
	                }
	                else
	                    $valueUsers1 = null;
	            }
	        }
	    }
	
	    	
	    return $res;
	}
}
?>