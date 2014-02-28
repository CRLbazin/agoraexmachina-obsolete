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
* @version 1.0
*/
class instancesManager extends \library\baseManager
{
	public function __construct()
	{
		//run baseManager constructor
		parent::__construct();
		//define name of the module
		$this->module = 'instances' ;
	}
	
	/**
	* get an object by categories
	* execute a query "select" with a filter on categories
	* @param array|string name or list of names to filter the query 
	* @return pdo_object anonymous object with property names that correspond to the column names returned in result set
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
	* add or update a instances
	* @param entity instances
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
		
		
		if(!$req->execute())
			echo $req->errorInfo()[2];
		else
			return true ;
	}
}
?>