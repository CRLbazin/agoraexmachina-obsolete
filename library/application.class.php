<?php
/**
* file for the application class
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* application class
* @version 1.1
* @author cyril bazin <crlbazin@gmail.com>
*/
class application extends \library\baseApplication
{
	/**
	* constructor of the application class
	* call parent contructor applicationClass
	*/
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	* run the application
	* get and execute controller, send http response
	*/
	public function run()
	{
		//get and execute controller
		$controller = $this->getController();
		$controller->execute();
		
		//send http response
		$this->httpResponse->setPage($controller->getPage());
		$this->httpResponse->send();
	}	
}
?>