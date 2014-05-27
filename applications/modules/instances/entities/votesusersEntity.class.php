<?php
/**
* file for the votes user entity
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\entities;

/**
* votes users entities
*/
class votesusersEntity extends \library\baseEntity
{
	protected 
		$id,
		$votes,
		$users,
		$values;
		
	/**
	* setter id
	* @param int id of the entity
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
	* setter votes
	* @param int votes of the entity
	*/
	public function setVotes($votes)
	{
		$this->votes= $votes;
	}

	/**
	* getter votes
	* @return int votes of the entity
	*/
	public function getVotes()
	{
		return $this->votes;
	}
	
	/**
	* setter users
	* @param int users of the entity
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
	* setter values
	* @param string values of the entity
	*/
	public function setValues($values)
	{
		$this->values = $values;
	}

	/**
	* getter values
	* @return string values of the entity
	*/
	public function getValues()
	{
		return $this->values;
	}
	
}
?>