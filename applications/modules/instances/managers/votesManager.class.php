<?php
/**
* file for the votes manager
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\managers;
use applications\modules\instances\entities;

/**
* votes manager
* @version 1.0
*/
class votesManager extends \library\baseManager
{
	public function __construct()
	{
		//run baseManager constructor
		parent::__construct();
		//define name of the module
		$this->module = 'votes' ;
	}

	/**
	* add or update a votes
	* @param entity votes
	*/
	public function save(\applications\modules\instances\entities\votesEntity $votes )
	{
		if($votes->getId() == "")
			$sql = "INSERT INTO votes";
		else
			$sql = "UPDATE votes";

		$sql .= "
			SET
			instances = :instances,
			users = :users,
			name = :name,
			descr = :descr";
		
		if($votes->getId() != "")
			$sql .= " WHERE id = :id ";

		$req = $this->db->prepare($sql);

		if($votes->getId() != "")
			$req->bindValue(":id", $votes->getId());


		$req->bindValue(":instances", $votes->getInstances());
		$req->bindValue(":users", $votes->getUsers());
		$req->bindValue(":name", $votes->getName());
		$req->bindValue(":descr", $votes->getDescr());
		if(!$req->execute())
			echo $req->errorInfo()[2];
		else
			return true ;
	}
	
	public function getByInstances($instances)
	{
		$req = $this->db->query("SELECT * FROM ".$this->module." WHERE instances = '".$instances."'");
		return $req->fetchAll(\PDO::FETCH_OBJ);
	}
}
?>