<?php
/**
* file for the users entity
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\entities;

/**
* users entities
*/
class usersEntity extends \library\baseEntity
{
	protected 
		$id,
		$whoCanSeeTheInstance,
		$whoCanVote,
		$whoCanWriteVote,
		$instances,
		$users;
		
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

	public function getWhoCanSeeTheInstance()
	{
	    return $this->whoCanSeeTheInstance;
	}
	
	public function setWhoCanSeeTheInstance($whoCanSeeTheInstance)
	{
	    $this->whoCanSeeTheInstance = $whoCanSeeTheInstance;
	}


	public function getWhoCanVote()
	{
	    return $this->whoCanVote;
	}
	
	public function setWhoCanVote($whoCanVote)
	{
	    $this->whoCanVote = $whoCanVote;
	}


	public function getWhoCanWriteVote()
	{
	    return $this->whoCanWriteVote;
	}
	
	public function setWhoCanWriteVote($whoCanWriteVote)
	{
	    $this->whoCanWriteVote = $whoCanWriteVote;
	}
	
}
?>