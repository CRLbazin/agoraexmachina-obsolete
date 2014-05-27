<?php
/**
* file for the base servie class
* @package cu.core
* @license GNU GPL
* @filesource
*/
namespace library;

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
		$this->baseManager = new baseManager();
		$this->currentManager = $this->baseManager->getManagerOf($calledClass[1][0]."\\".$calledClass[2][0]);		
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
}

?>
