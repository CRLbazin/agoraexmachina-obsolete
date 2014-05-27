<?php
/**
* file for the HTTP response class
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.core
* @license GNU GPL
* @filesource
*/
namespace library;

/**
* HTTP response manager class
*/
class httpResponse
{
	
	/**
	* send a HTTP response to the client.
	* @param string content of the data to send to the client
	* @return void
	*/
	public function send($content)
	{
		exit($content);
	}
	
	
	/**
	* redirect where page not found. 
	* @return void
	*/
	public function redirect404()
	{
		if(ENABLE_REDIRECT_404 == "1")
			header("location:".WEBSITE_404);	
	}
}

?>