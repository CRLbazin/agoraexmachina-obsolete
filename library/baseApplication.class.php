<?php
/**
* file for the base application class 
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* base application class
* @author cyril bazin <crlbazin@gmail.com>
*/
abstract class baseApplication
{
	protected	$httpRequest;
	protected	$httpResponse;
	protected	$config;
	protected 	$router;

	/**
	* constructor of the base application class
	* get request, set response, load the configuration and start session
	*/
	public function __construct()
	{
		$this->httpRequest = new httpRequest($this);
		$this->httpResponse = new httpResponse($this);
		$this->config = new config();
		session_start();
	}
	
	/**
	* get a controller
	* get the controller to use by the URL and the file routes.xml
	* @return object instance of a controller object
	*/	
	public function getController()
	{
		$router = new \library\router;
				
		// try to get the route corresponding to the URL
		// if the getRoute() method can't find the route, call error404 method
		try
		{
			$matchedRoute = $router->getRoute($this->httpRequest->requestUrl());
		}
		catch(\RuntimeException $e)
		{
			$this->httpResponse->redirect404();
		}
		// add the variables of the route to the GET session 
		$_GET = array_merge($_GET, $matchedRoute->getVars());
		
		// run the controller found in the route
		preg_match_all('/([\w]*)\\\([\w]*)$/', $matchedRoute->getModule(), $modules);		
		if(!isset($modules[2][0]))
			$controller = 'applications\\modules\\'.$matchedRoute->getModule().'\\'.$matchedRoute->getModule().'Controller';
		else
			$controller = 'applications\\modules\\'.$modules[1][0].'\\'.$modules[2][0].'Controller';
		
		return new $controller($this, $matchedRoute->getModule(), $matchedRoute->getAction());
	}
		
}
?>