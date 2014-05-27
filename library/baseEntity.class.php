<?php
/**
* file for the base entity class
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* base entity
* @author cyril bazin <crlbazin@gmail.com>
*/
abstract class baseEntity 
{
	/**
	* constructor of the base entity class. Call hydration method
	* @param array list of objects used to hydrate the entity
	* @return void
	*/
	public function __construct(array $values = array())
	{
		if(!empty($values))
			$this->hydrate($values);
	}
	
	/**
	* hydrate the entity
	* @param array list of objects used to hydrate the entity
	* @return void
	*/
	public function hydrate($values)
	{
	    if(isset($values))
		foreach($values as $attr => $val)
		{
			$method = 'set'.ucfirst($attr);
			if(is_callable(array($this, $method)))
				$this->$method($val);
		}
	}
	
	/**
	* get the attributs of the entity
	* @return array list of attributes of the entity
	*/
	public function getAttributes()
	{
		$array = array();
		foreach($this as $key => $value)
		{
			$array[$key] = $value;
		}
		return $array;
	}

}
?>