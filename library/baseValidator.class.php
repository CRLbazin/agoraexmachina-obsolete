<?php
/**
* file for the base validator class
* @package cu.core
* @copyright GNU GPL
* @filesource
* @todo � refactoriser
*/
namespace library;

/**
* validator class
* @author cyril bazin <crlbazin@gmail.com>
*/
abstract class baseValidator
{
	protected $errorMsg;
	
	
	/**
	* constructor of the base validator class
	* @param string error message
	*/
	public function __construct()
	{
		$this->setErrorMsg();
	}
	
	/**
	* is valid method
	*/
	abstract public function isValid($value);
	
	/**
	* set error message
	* @param string error message
	*/
	abstract public function setErrorMsg();
	
	/**
	* get error message
	* @return string error message
	*/
	public function getErrorMsg()
	{
		return $this->errorMsg;
	}

}