<?php
/**
* file for the base controller class
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* base controller
* @version 1.1
* @author cyril bazin <crlbazin@gmail.com>
*/
abstract class baseController extends application
{
	protected	$page;
	protected	$breadcrumb;
	protected	$application;
	protected	$module = '';
	protected	$action = '';
	protected	$view;
	protected	$viewFile;
	protected	$baseManager; 
	protected	$currentManager;
	protected	$currentEntity;
	protected	$formAction;
	protected	$delete;
	
	
	/**
	* constructor of the base controller class
	* instanciate baseManager class, breadcrumb class, and view class
	* @param application instance of the application
	* @param string name of the module
	* @param string name of the action 
	*/
	public function __construct(application $application, $module, $action)
	{
		$this->page = new page();		
		$this->baseManager = new baseManager();
		$this->breadcrumb = new breadcrumb();	
			
		$this->application = $application;
		$this->module = $module;
		$this->action = $action;
			
		$this->setView($action);
		$this->setBreadcrumb($this->application->httpRequest);		
		
		$this->currentManager = $this->baseManager->getManagerOf($module);
		
		$currentEntityPath = "\\applications\\modules\\".$module."\\entities\\".$module."Entity";
		if(class_exists($currentEntityPath))
			$this->currentEntity = new $currentEntityPath();
		
		
	}
	
	/**
	* execute method of the controller	
	*/	
	public function execute()
	{
		// called method called by URL
		$method = $this->action.'Action';		
		
		if(!is_callable(array($this, $method)))
			throw new \RuntimeException(_TR_ActionDoesntExist);
		
		$this->$method($this->application->httpRequest);
	}
	
	
	/**
	* get page
	* @return object page
	*/
	public function getPage()
	{
		return $this->page;
	}
	
	/**
	* set view to use
	* @param string view of the page
	*/
	public function setView($view)
	{
		if(!is_string($view) || empty($view))
			throw new \InvalidArgumentException('La view spécifiée est invalide');
		else
		{
			preg_match_all('/([\w]*)\\\([\w]*)$/', $this->module, $modules);
			$this->view = $view;
			if(!isset($modules[1][0]))
				$this->page->setViewFile(__DIR__.'/../applications/modules/'.$this->module.'/views/'.$this->view.'.php');
			else
				$this->page->setViewFile(__DIR__.'/../applications/modules/'.$modules[1][0].'/views/'.$modules[2][0].'.'.$this->view.'.php');
		}
		
		
	}
	
	/**
	* set and build breadcrumb
	*/
	public function setBreadcrumb($httpRequest)
	{
		$this->breadcrumb->build($httpRequest);
		$this->page->addVar('breadcrumb', $this->breadcrumb->getBreadcrumb());
	}
	

	/**
	* admin page for projects
	* list all projects
	*/
	public function adminAction()
	{
		// define the layout
		$this->page->setLayout('back');
		
		//get the admin component
		if(isset($this->listAdmin))
		{
			$listAdminComponent = new \library\webComponents\listAdmin(array(
				'module'	=> $this->listAdmin['module'],
				'title'		=> $this->listAdmin['title'],
				'columns'	=> $this->listAdmin['columns'],
				'data'		=> $this->currentManager->getAll($this->listAdmin['data'])
			));
			$this->page->addVar('listAdmin', $listAdminComponent->build());
		}
		else
		{
			//show error success
			$this->page->addVar('msgError', _TR_TechnicalError);
		}
	
	}
	
	
	
}

?>