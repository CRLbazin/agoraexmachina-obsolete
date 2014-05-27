<?php
/**
* file for the users entity interface
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.users
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\users\interfaces;

/**
* interface users entity
*/
interface IUsersEntity
{
		
	public function setId($id);
	
	public function getId();
	
	public function setName($name);
	
	public function getName();
	
	public function setPassword($password);
	
	public function getPassword();
	
	public function setEmail($email);
	
	public function getEmail();
	
	public function setActive($active);
	
	public function getActive();
	
	public function setLevel($level);
	
	public function getLevel();	
	
	public function setCreationDate($creationDate);
	
	public function getCreationDate();
	
	
}
?>