<?php
/**
* file for the routes class.
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* class route
*/
class route
{
	protected		$action;
	protected		$module;
	protected		$url;
	protected		$name;
	protected		$varsNames;
	protected		$vars = array();
	
	
	/**
	* route constructor.
	* set url, module, action, name and variables of the route.
	* @param string url of the route 
	* @param string module of the route
	* @param string action of the route
	* @param string name of the route
	* @param array variables of the route
	* @return void
	*/
	public function __construct($url, $module, $action, $name, array $varsNames)
	{
		$this->setUrl($url);
		$this->setModule($module);
		$this->setAction($action);
		$this->setName($name);
		$this->setVarsNames($varsNames);
	}
	
	/**
	* check if the route contains the current URL.
	* @param string url
	* @return array results of search. $matches[0] will contain the text that matched the full pattern, $matches[1] will have the text that matched the first captured parenthesized subpattern, and so on.
	*/
	public function match($url)
	{
	   $url = preg_replace('/(\/+)$/', "", $url);
	   $this->url = preg_replace('/(\/+)$/', "", $this->url);
	   
		if(preg_match('`^'.$this->url.'$`', $url, $matches))
			return $matches;
		else
			return false;
	}
	
	/**
	* check if the route has variables.
	* @return bool returns FALSE if var exists and has a non-empty, non-zero value. Otherwise returns TRUE
	*/
	public function hasVars()
	{
		return !empty($this->varsNames);
	}
	
	/**
	* set url of the route.
	* @param string url of the route
	* @return void 
	*/
	public function setUrl($url)
	{
		if(is_string($url))
			$this->url = $url;
	}
	
	/**
	* set name of the route.
	* @param string name of the route
	* @return void
	*/
	public function setName($name)
	{
		if(is_string($name))
			$this->name = $name;
	}
	
		
	/**
	* set module of the route.
	* @param string name of the module
	* @return void
	*/
	public function setModule($module)
	{
		if(is_string($module))
			$this->module = $module;
	}
	
	/**
	* set action of the route.
	* @param string name of the action
	* @return void
	*/
	public function setAction($action)
	{
		if(is_string($action))
			$this->action = $action;
	}
	
	/**
	* set variables of the route.
	* @param array list of variables
	* @return void
	*/
	public function setVarsNames($varsNames)
	{
		$this->varsNames = $varsNames;
	}
	
	/**
	* get url of the route.
	* @return string url of the route
	*/
	public function getUrl()
	{
		return $this->url;
	}
	
	/**
	* get name of the route.
	* @return string name of the route
	*/
	public function getName()
	{
		return $this->name;
	}
	
	/**
	* get module of the route.
	* @return string module name of the route
	*/
	public function getModule()
	{
		return $this->module;
	}
	
	/**
	* get action of the route.
	* @return string action name of the route
	*/
	public function getAction()
	{
		return $this->action;
	}
	
	/**
	* get list of the variables of the route.
	* @return array list of variables
	*/
	public function getVarsNames()
	{
		return $this->varsNames;
	}
	
	/**
	* get variables of the route.
	* @return string variable
	*/
	public function getVars()
	{
		return $this->vars;
	}
	
	/**
	* set variables of the route
	* @return void
	*/
	public function setVars($vars)
	{
		$this->vars = $vars;
	}
}


?>