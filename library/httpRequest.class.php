<?php
/**
* file for the httpRequest class
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* http request manager class
* @version 1.1
* @author cyril bazin <crlbazin@gmail.com>
*/
class httpRequest
{
	/**
	* get URL
	* @return string URI
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