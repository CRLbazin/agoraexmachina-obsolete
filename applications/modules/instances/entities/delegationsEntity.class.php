<?php
/**
* file for the delegations entity
* @author cyril bazin 
* @package cu.instances 
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\entities;

/**
* delegations entities
*/
class delegationsEntity extends \library\baseEntity
{
	protected 
		$id,
		$users1,
		$users2,
		$users2List,
		$categories,
		$instances;
		
	/**
	* setter id
	* @param int id of the entity
	* @return void
	*/
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	* getter id
	* @return int id of the entity
	*/
	public function getId()
	{
		return $this->id;
	}

	/**
	* setter users1
	* @param varchar users1 of the entity (delegation from user1)
	* @return void
	*/
	public function setUsers1($users1)
	{
		$this->users1= $users1;
	}
	
	/**
	* getter users1
	* @return varchar users1 of the entity (delegation from user1)
	*/
	public function getUsers1()
	{
		return $this->users1;
	}
	
	/**
	* setter users2
	* @param varchar users2 of the entity (delegation to user2)
	* @return void
	*/
	public function setUsers2($users2)
	{
		$this->users2 = $users2;
	}

	/**
	* getter users2
	* @return varchar users2 of the entity (delegation to user2)
	*/
	public function getUsers2()
	{
		return $this->users2;
	}
	
	/**
	* setter users2List
	* @param array $users2List (list of all users2 available)
	* @return void
	*/
	public function setUsers2List($users2List)
	{
		$this->users2List = $users2List;
	}
	
	/**
	* getter getUsers2List (list of all users2 available)
	* @return array
	*/
	public function getUsers2List()
	{
		return $this->users2List;
	}
	
	/**
	* setter categories
	* @param varchar categories of the entity
	* @return void
	*/
	public function setCategories($categories)
	{
		$this->categories = $categories;
	}

	/**
	* getter categories
	* @return varchar categories of the entity
	*/
	public function getCategories()
	{
		return $this->categories;
	}
	
	/**
	* setter instances
	* @param varchar instances of the entity
	* @return void
	*/
	public function setInstances($instances)
	{
		$this->instances = $instances;
	}

	/**
	* getter instances
	* @return varchar instances of the entity
	*/
	public function getInstances()
	{
		return $this->instances;
	}
}	

?>