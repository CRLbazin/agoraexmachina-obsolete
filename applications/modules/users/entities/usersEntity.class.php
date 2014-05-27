<?php
/**
* file for the users entity
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.users
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\users\entities;

/**
* users entity
*/
class usersEntity extends \library\baseEntity implements \applications\modules\users\interfaces\IUsersEntity
{
	protected	$id,
				$name,
				$password,
				$email,
				$active,
				$level,
				$creationDate,
				$charter;
		
	/**
	* setter id
	* @param int id of the user
	* @return void
	*/
	public function setId($id)
	{
		$this->id = $id;
	}
	
	/**
	* getter id
	* @return int id of the user
	*/
	public function getId()
	{
		return $this->id;
	}
	
	/**
	* setter name
	* @param string name of the user
	* @return void
	*/
	public function setName($name)
	{
		$this->name = secureString($name);
	}
	
	/**
	* getter name
	* @return string name of the user
	*/
	public function getName()
	{
		return $this->name;
	}
	
	/**
	* setter password
	* @param string password of the user
	* @return void
	*/
	public function setPassword($password)
	{
		$this->password = $password;
	}
	
	/**
	* getter password
	* @return string password of the user
	*/
	public function getPassword()
	{
		return $this->password;
	}
	
	/**
	* setter email
	* @param string email of the user
	*/
	public function setEmail($email)
	{
		$this->email = secureString($email);
	}		
	
	/**
	* getter password
	* @return string password of the user
	*/
	public function getEmail()
	{
		return $this->email;
	}			
	
	/**
	* setter active
	* @param int active of the user
	* @return void
	*/			
	public function setActive($active)
	{
		$this->active = $active;
	}
	
	/**
	* getter active
	* @return int active of the user
	*/	
	public function getActive()
	{
		return $this->active ;
	}	
	
	/**
	* setter level
	* @param int level of the user
	* @return void
	*/	
	public function setLevel($level)
	{
		$this->level = $level;
	}
	
	/**
	* getter level
	* @return int level of the user
	*/	
	public function getLevel()
	{
		return $this->level ;
	}
	
	
	/**
	* setter creationDate
	* @param int creationDate of the user
	* @return void
	*/	
	public function setCreationDate($creationDate)
	{
		$this->creationDate = $creationDate;
	}
	
	/**
	* getter creationDate
	* @return int creationDate of the user
	*/	
	public function getCreationDate()
	{
		return $this->creationDate ;
	}
	
}
?>