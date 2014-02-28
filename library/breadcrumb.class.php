<?php
/**
* file for the breadcrumb class
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* class breadcrumb
* @version 1.1
* @author cyril bazin <crlbazin@gmail.com>
*/
class breadcrumb
{
	protected $items = array();
	
	/**
	* build breadcrumb
	* @param HTTP_GET HTTP Get Request
	*/
	public function build($httpRequest)
	{	
		$router = new \library\router;
		$routes = $router->getAllRoutes();
		
		foreach($routes as $route)		
			if(preg_match('`^'.$route->getUrl().'[\w\W]*$`', $httpRequest->requestUrl(), $matches))
			{
				preg_match_all('/([0-9]{1,10})+\-([\w\W][^\/]+)/', $httpRequest->requestUrl(), $matchesURL);
				
				foreach($matchesURL[0] as $url)
					$route->setUrl(preg_replace('/(\(\[0\-9\]{1\,10}\)\+\\\-\[\\\w\\\W\]\+)/', $url, $route->getUrl(), 1));

				$this->items[] = $route;
			}
	}
	
	/**
	* get breadcrumb
	* @return object breadcrumb
	*/
	public function getBreadcrumb()
	{
		return $this->items;
	}
}