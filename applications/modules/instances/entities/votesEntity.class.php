<?php
/**
* file for the votes entity
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\entities;

/**
* votes entities
*/
class votesEntity extends \library\baseEntity
{
	protected 
		$id,
		$instances,
		$users,
		$name,
		$descr;
		
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
	* setter instances
	* @param int instances of the entity
	* @return void
	*/
	public function setInstances($instances)
	{
		$this->instances = $instances;
	}

	/**
	* getter instances
	* @return int instances of the entity
	*/
	public function getInstances()
	{
		return $this->instances;
	}
	
	/**
	* setter users
	* @param int users of the entity
	* @return void
	*/
	public function setUsers($users)
	{
		$this->users = $users;
	}

	/**
	* getter users
	* @return int users of the entity
	*/
	public function getUsers()
	{
		return $this->users;
	}
	
	/**
	* setter name
	* @param string name of the entity
	* @return void
	*/
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	* getter name
	* @return string name of the entity
	*/
	public function getName()
	{
		return $this->name;
	}
	/**
	* setter descr
	* @param string description of the entity
	* @return void
	*/
	public function setDescr($descr)
	{
		$this->descr = $descr;
	}

	/**
	* getter descr
	* @return string description of the entity
	*/
	public function getDescr()
	{
		return $this->descr;
	}
}
?>