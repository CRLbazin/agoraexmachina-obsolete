<?php
/**
* file for the router class.
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.core
* @license GNU GPL
* @filesource
*/
namespace library;

/**
* router class
*/
class router
{
	protected	$routes = array();
	const		NO_ROUTE = 1;
	

    /**
    * get all routes
    * get the URLs, the variables, the modules and the actions of all routes, use the "/applications/config/routes.xml" file.
    * @param string current url (optionnal)
    * @return array list of routes object
    */
	public function getAllRoutes($currentUrl = null)
	{
	    //get content of the file.
	    $xml = new \DOMDocument;
	    $xml->load(__DIR__.'/../applications/config/routes.xml');
	    $file = $xml->getElementsByTagName('route');
	     
	    //parse the content.
	    $varsNames = array();
	    $varsValues = array();
	    $varsList = array();
	    
	    foreach($file as $line)
	    {
	        	        
	        //create the route.
	        $varsNames = explode(',', $line->getAttribute('vars')); //get the name of all variables 	        
	        $route = new route($line->getAttribute('url'), $line->getAttribute('module'), $line->getAttribute('action'), $line->getAttribute('name'), $varsNames);
	        
	        //get variables.
	        if($varsValues = $route->match($currentUrl))
	        {
	            array_shift($varsValues); // the first result contain the full captured string (cf. pregmatch manual).
		    
	            foreach($varsValues as $key => $match)
	            	$varsList[$varsNames[$key]] = $match;
                
    			$route->setVars($varsList);
    	        
	        }
	
	        //add the route to the router.
	        $this->addRoute($route);
	    }
	    
	    //return all routes.
	    return $this->routes;
	}
	
	
	/**
	* add a route to the router.
	* @param object route
	* @return void
	*/
	public function addRoute(Route $route)
	{
		if(!in_array($route, $this->routes)) //check if the route is not already registered.
			$this->routes[] = $route;
	}
	
	
	/**
	* get the route associate to an URL.
	* @param string the url
	* @return route|exception return matched route or exception
	*/
	public function getRoute($url)
	{
	 	// get all routes.
		$this->getAllRoutes($url);

		// filter the route.
		$route = @array_shift(array_values(array_filter($this->routes, function($object)
		    {
		        return $object->match($_SERVER['REQUEST_URI']);
		    })));


		if(isset($route))
		  {
			return $route;
		  }		
else
			throw new \RuntimeException(_TR_NoRouteSpecified, self::NO_ROUTE);
	}
}


?>