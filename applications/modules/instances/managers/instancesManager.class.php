<?php

/**
* file for the instances manager
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\managers;
use applications\modules\instances\entities;

/**
* instances manager
*/
class instancesManager extends \library\baseManager
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
	 * delete
	 * delete instance(s) 
	 * @param array|int id of the row to deleted
	 * @return void
	 */
	public function delete($values)
	{
		if(is_array($values))
		foreach($values as $key=>$value)
			$this->db->exec("DELETE FROM instances WHERE ".$key ." = '".$value."'");
		else
			$this->db->exec("DELETE FROM instances WHERE id = '".$values."'");
			
	}
	
	
	/**
	* get instances by categories
	* @param array|int id of the categorie(s)
	* @return array containing all of the result set rows
	*/
	public function getByCategories($categories)
	{
		if(!is_array($categories))
		{
			$req = $this->db->query("SELECT * FROM ".$this->module." WHERE categories = '".$categories."' ORDER BY categories");
		}
		else
		{
			$sql = "SELECT * FROM ".$this->module." WHERE active = 1 ";
			foreach($categories as $value)
				$sql .= "OR categories = '".$value."' ";
			$sql ."  ORDER BY categories" ;
			$req = $this->db->query($sql);
		}
		return $req->fetchAll(\PDO::FETCH_OBJ);
	}
	
	
	/**
	* save an instance
	* @param \applications\modules\instances\entities\instancesEntity $instances
	* @return boolean
	*/
	public function save(\applications\modules\instances\entities\instancesEntity $instances )
	{
		if($instances->getId() == "")
			$sql = "INSERT INTO instances";
		else
			$sql = "UPDATE instances";

		$sql .= "
			SET
			name = :name,
			descr = :descr,
			image = :image,
			deadline = :deadline,
			users = :users,
			categories = :categories";
		
		if($instances->getId() != "")
			$sql .= " WHERE id = :id ";

		$req = $this->db->prepare($sql);

		if($instances->getId() != "")
			$req->bindValue(":id", $instances->getId());


		$req->bindValue(":name", $instances->getName());
		$req->bindValue(":descr", $instances->getDescr());
		$req->bindValue(":image", $instances->getImage());
		$req->bindValue(":deadline", $instances->getdeadline());
		$req->bindValue(":users", $instances->getUsers());
		$req->bindValue(":categories", $instances->getCategories());
		
		
		return $req->execute() ? true : false;
	}
	
	
}
?>