<?php
/**
* file for the application class.
* @package cu.core
* @license GNU GPL
* @filesource
*/
namespace library;

/**
* application class.
* represents the main class of the web application.
* @author cyril bazin <crlbazin@gmail.com>
*/
class application
{
	protected	$httpRequest;
	protected	$httpResponse;
	protected	$config;
	protected 	$router;
	protected 	$handleErrors;
	protected	$overloads;
	
	
	/**
	* private constructor of the application class.
	* start session.
	* run the engine for the HTTP requests.
	* run the engine for the HTTP responses.
	* run the loader of the configuration.
	* run the handle error
	* @return void
	*/
	public function __construct()
	{
		session_start();
		$this->httpRequest = new httpRequest($this);
		$this->httpResponse = new httpResponse($this);
		$this->config = new config();
		$this->handleError = new handleErrors();
		
	}
	
	
	/**
	* run the application.
	* get the controller and execute the method.
	* send the HTTP response to the client.
	* @return void
	*/
	public function run()
	{
		//get the controller and execute the method.
		$controller = $this->getController();
		$controller->execute();
		
		//send the HTTP response to the client.
		$this->httpResponse->send($controller->getPage()->getGeneratedPage());
	}
	
	/**
	 * get the HTTP request manager
	 * @return object HTTP request object
	 */
	public function getHttpRequest()
	{
	    return $this->httpRequest;
	}
	

	/**
	 * get the controller to call with the current URL.
	 * @return object controller
	 */
	public function getController()
	{
	
	    //instanciate the router.
	    $router = new \library\router;
	    
	    // try to get the route corresponding to the URL and return the associate controller.
	    try
	    {
	        //get the route.
	        $matchedRoute = $router->getRoute($this->httpRequest->requestUrl());
		
	        $_GET = array_merge($_GET, $matchedRoute->getVars());
	        
	        // define the controller of the route.
	        preg_match_all('/([\w]*)\\\([\w]*)$/', $matchedRoute->getModule(), $modules);
		
	        if(!isset($modules[2][0]))
	            $controller = 'applications\\modules\\'.$matchedRoute->getModule().'\\'.$matchedRoute->getModule().'Controller';
	        else
	            $controller = 'applications\\modules\\'.$modules[1][0].'\\'.$modules[2][0].'Controller';

		return new $controller($this, $matchedRoute->getModule(), $matchedRoute->getAction());
	    }
	    //route not found : 404 redirection.
	    catch(\RuntimeException $e)
	    {
	    	if( ENABLE_REDIRECT_404 == 1)
	    		$this->httpResponse->redirect404();
	    }    	
	   
	}	
	
}
?>