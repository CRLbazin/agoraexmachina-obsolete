<?php
/**
* file for the users manager
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\managers;
use applications\modules\instances\entities;

/**
* users manager
*/
class usersManager extends \library\baseManager
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
		$this->module = 'users' ;
	}

	/**
	* get all users for an instance
	* @param int id of the instance
	* @return array containing all of the result set rows
	*/
	public function getByInstances($instance)
	{
		$req = $this->db->query("
		SELECT 
				a.id,
				a.instances,
				a.users,
				b.name,
		        a.whoCanSeeTheInstance,
		        a.whoCanVote,
		        a.whoCanWriteVote
		FROM 
			instancesusers a 
				LEFT JOIN users b
				ON a.users = b.id
		WHERE  a.instances = ".$instance);
		
		return $req->fetchAll(\PDO::FETCH_OBJ);
	}
	
	

	/**
	* save users
	* @param \applications\modules\instances\entities\usersEntity $users
	* @return boolean
	*/
	public function save(\applications\modules\instances\entities\usersEntity $users)
	{
		if($users->getId() == "")
			$sql = "INSERT INTO instancesusers";
		else
			$sql = "UPDATE instancesusers";
	
		$sql .= "
			SET
			instances = :instances,
			users = :users,
			whoCanSeeTheInstance = :whoCanSeeTheInstance,
			whoCanVote = :whoCanVote,
		    whoCanWriteVote = :whoCanWriteVote";
	
		if($users->getId() != "")
			$sql .= " WHERE id = :id ";
	
		$req = $this->db->prepare($sql);
	
		if($users->getId() != "")
			$req->bindValue(":id", $users->getId());
	
		$req->bindValue(":instances", $users->getInstances());
		$req->bindValue(":users", $users->getUsers());
		$req->bindValue(":whoCanSeeTheInstance", $users->getWhoCanSeeTheInstance());
		$req->bindValue(":whoCanVote", $users->getWhoCanVote());
		$req->bindValue(":whoCanWriteVote", $users->getWhoCanWriteVote());
	
		return $req->execute() ? true : false;
	}
	
	public function getById($id)
	{
		$req = $this->db->query("SELECT * FROM instancesusers WHERE id = '".$id."'");
		$res = $req->fetchAll(\PDO::FETCH_OBJ);

		if(isset($res[0]))
			return $res[0];
		else
			return null;
	}
	
	
	
	
	/**
	* delete a user
	* @param int $id of the user
	*/
	public function delete($id)
	{
	    $this->db->exec("DELETE FROM instancesusers WHERE id = ".$id);
	}
	
	
}
?>