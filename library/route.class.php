<?php
/**
* file for the routes class
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* class route
* @version 1.1
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
	* route constructor
	* set url, module, action, name and variables
	* @param string url in the route 
	* @param string module in the route
	* @param string action in the route
	* @param string name in the route
	* @param array variables in the route
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
	* check if the road contains the current URL
	* @param string url
	* @return string route corresponding to the URL or false
	*/
	public function match($url)
	{
		if(preg_match('`^'.$this->url.'$`', $url, $matches))
			return $matches;
		else
			return false;
	}
	
	/**
	* check if route has variables
	* @return bool true of false if the route has variables
	*/
	public function hasVars()
	{
		return !empty($this->varsNames);
	}
	
	/**
	* set url of the route
	* @param string url of the route
	*/
	public function setUrl($url)
	{
		if(is_string($url))
			$this->url = $url;
	}
	
	/**
	* set name of the route
	* @param string name of the route
	*/
	public function setName($name)
	{
		if(is_string($name))
			$this->name = $name;
	}
	
		
	/**
	* set module of the route
	* @param string name of the module
	*/
	public function setModule($module)
	{
		if(is_string($module))
			$this->module = $module;
	}
	
	/**
	* set action of the route
	* @param string name of the action
	*/
	public function setAction($action)
	{
		if(is_string($action))
			$this->action = $action;
	}
	
	/**
	* set variables of the route
	* @param array list of variables
	*/
	public function setVarsNames($varsNames)
	{
		$this->varsNames = $varsNames;
	}
	
	/**
	* get url of the route
	* @return string url of the route
	*/
	public function getUrl()
	{
		return $this->url;
	}
	
	/**
	* get name of the route
	* @return string name of the route
	*/
	public function getName()
	{
		return $this->name;
	}
	
	/**
	* get module of the route
	* @return string module of the route
	*/
	public function getModule()
	{
		return $this->module;
	}
	
	/**
	* get action of the route
	* @return string action of the route
	*/
	public function getAction()
	{
		return $this->action;
	}
	
	/**
	* get list of the variables of the route
	* @return array list of variables
	*/
	public function getVarsNames()
	{
		return $this->varsNames;
	}
	
	/**
	* get variables of the route
	* @return string variable
	*/
	public function getVars()
	{
		return $this->vars;
	}
	
	/**
	* set variables of the route
	* @return string variable
	*/
	public function setVars($vars)
	{
		$this->vars = $vars;
	}
}


?>