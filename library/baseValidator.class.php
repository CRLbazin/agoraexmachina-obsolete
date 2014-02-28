<?php
/**
* file for the base validator class
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* validator class
* @version 1.1
* @author cyril bazin <crlbazin@gmail.com>
*/
abstract class baseValidator
{
	protected $errorMsg;
	
	/**
	* constructor of the base validator class
	* @param string error message
	*/
	public function __construct($errorMsg)
	{
		$this->setErrorMsg($errorMsg);
	}
	
	/**
	* is valid method
	*/
	abstract public function isValid($value);
	
	/**
	* set error message
	* @param string error message
	*/
	public function setErrorMsg($errorMsg)
	{
		$this->errorMsg = $errorMsg;
	}
	
	/**
	* get error message
	* @return string error message
	*/
	public function getErrorMsg()
	{
		return $this->errorMsg;
	}

}