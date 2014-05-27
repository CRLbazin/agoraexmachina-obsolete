<?php
/**
* file for the HTTP request class
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* HTTP request manager class
* @author cyril bazin <crlbazin@gmail.com>
*/
class httpRequest
{
	
	/**
	* check if data is posted
	* @return boolean
	*/
	public function isPosted()
	{
		if(!empty($_POST))
			return true;
		else
			return false;
	}
	
	public function getPOST()
	{
		return $_POST;
	}
	
	/**
	* get current URI
	* @return string current URI
	*/
	public function requestUrl()
	{
		return $_SERVER['REQUEST_URI'];
	}
	
	/**
	* get a POST or GET data
	* @param string the name of the data
	* @return string value of the data
	*/
	public function getData($key)
	{
		return isset($_REQUEST[$key]) ? $_REQUEST[$key] : null;
	}
	
	/**
	* get a GET data
	* @param string the name of the data
	* @return string value of the data
	*/
	public function getGET($key)
	{
		return isset($_GET[$key]) ? $_GET[$key] : null;
	}
	
	
}

?>