<?php
/**
* file for the base controller class
* @package cu.core
* @license GNU GPL
* @filesource
*/
namespace library;

/**
* base controller
* @author cyril bazin <crlbazin@gmail.com>
*/
abstract class baseController
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
	protected   $currentService;
	protected	$formAction;
	protected	$delete;
	
	
	/**
	* constructor of the base controller class.
	* instanciate the base manager, the breadcrumb class and the view class.
	* @param application instance of the application
	* @param string name of the module
	* @param string name of the action
	* @return void 
	*/
	public function __construct(\library\application $application, $module, $action)
	{
		$this->page = new page();
		$this->baseManager = new baseManager();
		$this->breadcrumb = new breadcrumb();	
			
		$this->application = $application;
		$this->module = $module;
		$this->action = $action;
		
		$this->setView($action);
		$this->setBreadcrumb($this->application->getHttpRequest());		
		
		preg_match_all('/([\w]*)\\\([\w]*)$/', $this->module, $modules);
		
		$this->currentManager = $this->baseManager->getManagerOf($module);
			
		
		if(!isset($modules[1][0]))
		{
			$currentEntityPath = "\\applications\\modules\\".$module."\\entities\\".$module."Entity";
			$currentServicePath = "\\applications\\modules\\".$module."\\services\\".$module."Service";
		}
		else
		{
			$currentEntityPath = "\\applications\\modules\\".$modules[1][0]."\\entities\\".$modules[2][0]."Entity";
			$currentServicePath = "\\applications\\modules\\".$modules[1][0]."\\services\\".$modules[2][0]."Service";
		}
		
		
		
		
		if(class_exists($currentEntityPath))
		{
			$this->currentEntity = new $currentEntityPath();
			
			if(!$this->application->getHttpRequest()->isPosted() && $this->application->getHttpRequest()->getGET('id') <> "")
				$this->currentEntity->hydrate($this->currentManager->getById($this->application->getHttpRequest()->getGET('id')));
			else
				$this->currentEntity->hydrate($this->application->getHttpRequest()->getPOST());
		}
		
		
		if(isset($_FILES['image']))
    			$this->currentEntity->setImage($_FILES['image']['name']);
		
		if(class_exists($currentServicePath ))
			$this->currentService = new $currentServicePath();
	}
	

	
	/**
	* execute the method associate with the current URL
	* @return void	
	*/	
	public function execute()
	{
		
		//post delete action
		if($this->application->getHttpRequest()->getData('formAction') == "delete")
		{
			$this->delete($this->application->getHttpRequest());
		}
		
		//get actions
		$method = $this->action.'Action';

		if(!is_callable(array($this, $method)))
			throw new \RuntimeException(_TR_ActionDoesntExist);
		
		$this->$method($this->application->getHttpRequest());
		
		
	}
	
	
	
	/**
	 * delete element(s)
	 * @param \library\httpRequest $request
	 */
	public function delete(\library\httpRequest $request)
	{
		foreach($request->getData('id') as $key => $id)
			$this->currentService->delete($id);
	
		$this->page->addVar('msgSuccess', _TR_DeleteComplete);
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
	* set view associate with the current method.
	* @param string view of the page
	* @return void 
	*/
	public function setView($view)
	{
		if(is_string($view))
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
	* set breadcrumb
	*/
	public function setBreadcrumb($httpRequest)
	{
		$this->breadcrumb->build($httpRequest);
		$this->page->addVar('breadcrumb', $this->breadcrumb->getBreadcrumb());
	}
	

	/**
	* common admin method.
	*/
	public function adminAction()
	{
		// define the layout
		$this->page->setLayout('back');
		
		$listAdminComponent = new \library\webComponents\listAdmin(array(
			'module'	=> $this->listAdmin['module'],
			'title'		=> $this->listAdmin['title'],
			'columns'	=> $this->listAdmin['columns'],
			'data'		=> $this->currentManager->getAll($this->listAdmin['data'])
		));
		$this->page->addVar('listAdmin', $listAdminComponent->build());
		
	}
	
	
	
	
	
}

?>