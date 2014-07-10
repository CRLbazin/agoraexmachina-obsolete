<?php
/**
* file for the categories entity
* @author cyril bazin 
* @package cu.instances 
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\entities;

/**
* categories entities
*/
class categoriesEntity extends \library\baseEntity
{
	protected 
		$id,
		$name,
		$code;
		
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
	* setter name
	* @param varchar name of the entity
	* @return void
	*/
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	* getter name
	* @return varchar name of the entity
	*/
	public function getName()
	{
		return $this->name;
	}
}	

?>