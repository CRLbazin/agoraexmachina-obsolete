<?php
/**
* file for the router class
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* class router
* @version 1.1
*/
class router
{
	protected	$routes = array();
	const		NO_ROUTE = 1;
	
	/**
	* add a route to the router 
	* @param object route
	*/
	public function addRoute(Route $route)
	{
		if(!in_array($route, $this->routes))
		{
			$this->routes[] = $route;
		}
	}
	
	/**
	* get urls, variables, modules and actions of all routes in routes file
	* return object routes
	*/
	public function getAllRoutes()
	{			
		$xml = new \DOMDocument;
		$xml->load(__DIR__.'/../applications/config/routes.xml');
		$routes = $xml->getElementsByTagName('route');		
		foreach($routes as $route)
		{
			$vars = array();			
			// get variables
			if($route->hasAttribute('vars'))
			{
				$vars = explode(',', $route->getAttribute('vars'));
			}
			// add routes to router
			$this->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $route->getAttribute('name'), $vars));
		}
		return $this->routes;
	}
	
	/**
	* get route of a URL
	* @param string the url to search
	* @return route|exception return matched route or exception
	*/
	public function getRoute($url)
	{
		// get all routes
		$this->getAllRoutes();
		
		foreach($this->routes as $route)
		{
			// check if the url is in the route
			if(($varsValues = $route->match($url)) !== false)
			{
				// check if the route has variables
				if ($route->hasVars())
				{
					$varsNames = $route->getVarsNames();
					$listVars = array();
				
					// creating array with key / value
					// (key = name of the variable, value = it's value.)
					foreach ($varsValues as $key => $match)
					{
						// the first value contain the full captured string (cf. pregmatch manual)
						if ($key !== 0)
						{
							$listVars[$varsNames[$key - 1]] = $match;
						}
					}
					// assign this array of variables to the route
					$route->setVars($listVars);
				}
				$res = $route;
			}
		}
		if(isset($res))
			return $res;
		else
			throw new \RuntimeException(_TR_NoRouteSpecified, self::NO_ROUTE);
	}
	
	
	
	
}


?>