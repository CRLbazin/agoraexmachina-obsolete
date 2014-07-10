<?php
/**
* file for the base servie class
* @package cu.core
* @license GNU GPL
* @filesource
*/
namespace library;

use applications\modules\instances\interfaces\IInstancesEntity;
/**
* base service
* @author cyril bazin <crlbazin@gmail.com>
*/
abstract class baseService
{ 
	
	protected	$errorSendEmail;
	protected 	$errorSaveInDb;
	protected 	$errorIncompletForm;
	protected	$errorExistingElement;
	protected	$errorElement;
	protected  $aze;
	
    /**
     * constructor of the base service class
     * @return void
     */
	public function __construct()
	{
		$this->initCurrentManager();
		$this->initStandardErrors();
		
	}
	
	/**
	* init service current manager 
	* @return void
	*/
	public function initCurrentManager()
	{
		preg_match_all('/applications\\\modules\\\([\w]*)\\\services\\\([\w]+)Service$/', get_called_class(), $calledClass);
		$baseManager = new baseManager();
		$this->currentManager = $baseManager->getManagerOf($calledClass[1][0]."\\".$calledClass[2][0]);		
	}
	
	/**
	* get the manager of a module.
	* @param string name of the module
	* @return object manager of the module
	*/
	public function getManagerOf($module)
	{
	    if(!is_string($module) || empty($module))
	        throw new \InvalidArgumentException(_TR_ModuleNotFound);
	
	    else if(!isset($this->managers[$module]))
	    {
	        preg_match_all('/([\w]*)\\\([\w]*)$/', $module, $modules);
	        	
	        if(!isset($modules[1][0]))
	            $manager = "\\applications\\modules\\".$module."\\managers\\".$module."Manager";
	        else
	        {
	            $manager = "\\applications\\modules\\".$modules[1][0]."\\managers\\".$modules[2][0]."Manager";
	        }
	        if(class_exists($manager))
	        {
	            $this->managers[$module] = new $manager();
	            return $this->managers[$module];
	        }
	    }
	}
	
	
	/**
	 * get the service of a module
	 * @param string name of the module
	 * @return object service of the module
	 */
	public function getServiceOf($module)
	{
	    if(!is_string($module) || empty($module))
	        throw new \InvalidArgumentException('Le service spécifié est vide');
	    else
	    {
	        preg_match_all('/([\w]*)\\\([\w]*)$/', $module, $modules);
	
	        if(!isset($modules[1][0]))
	            $service = "\\applications\\modules\\".$module."\\services\\".$module."Service";
	        else
	            $service = "\\applications\\modules\\".$modules[1][0]."\\services\\".$modules[2][0]."Service";
	
	         
	        if(class_exists($service))
	            return new $service();
	    }
	
	    return false;
	}
	
	
	
	
	
	/**
	* init standards errors for the handle errors in all services
	* @return void
	*/
	public function initStandardErrors()
	{
		$this->errorExistingElement = new \library\error(array(
			    						'type'	=> \library\error::TYPE_ERR,
			    						'msg'	=>	_TR_elementExists,
			    						'div'	=>	\library\error::DIV_GLOBAL,
			    						));
		
		$this->errorSendEmail = new \library\error(array(
			    						'type'	=> \library\error::TYPE_ERR,
			    						'msg'	=>	_TR_mailNotSend,
			    						'div'	=>	\library\error::DIV_GLOBAL,
			    						));
	 	
		$this->errorSaveInDb = new \library\error(array(
			    						'type'	=> \library\error::TYPE_ERR,
			    						'msg'	=>	_TR_elementNotSave,
			    						'div'	=>	\library\error::DIV_GLOBAL,
			    						));
	
		$this->errorIncompletForm  = new \library\error(array(
			    						'type'	=> \library\error::TYPE_ERR,
			    						'msg'	=>	_TR_incompleteForm,
			    						'div'	=>	\library\error::DIV_GLOBAL,
			    						));
	
		
		$this->errorNotExistingElement  = new \library\error(array(
			    						'type'	=> \library\error::TYPE_ERR,
			    						'msg'	=>	_TR_elementDoesntExists,
			    						'div'	=>	\library\error::DIV_GLOBAL,
			    						));
		
	}
	
	
	/**
	* execute a method
	* @param string name of the service
	* @param 
	* @return mixed return of a service
	*/
	public function execute()
	{
	    
	}
	
	public function executeAsync()
	{   
	}
	

	/**
	* get all 
	* @return array of all categories
	*/
	public function getAll($fields=null)
	{
		return $this->currentManager->getAll($fields);
	}
	
	/**
	* get by id
	* @param int $id
	* @return pdo_object anonymous object with property names that correspond to the column names returned in result set.
	*/
	public function getById($id)
	{
	    return $this->currentManager->getById($id);
	    
	}
}

?>
