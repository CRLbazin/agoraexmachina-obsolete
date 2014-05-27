<?php
/**
* file for the instances controller
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.instances
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\instances;

/**
* instances controller
*/
class instancesController extends \library\baseController
{

	/**
	* index page 
	* @param \library\httpRequest $request
	* @return void
	*/
	public function indexAction(\library\httpRequest $request)
	{		
		$categoriesManager = $this->baseManager->getManagerOf('instances\categories');
		$this->page->addVar('categories', $categoriesManager->getById($request->getGET('id')));
		
		$this->page->addVar('instances', $this->currentManager->getByCategories($request->getGET('id')));
	}
	
	/**
	* add an instance 
	* @param \library\httpRequest $request
	* @return void
	*/
	public function addAction(\library\httpRequest $request)
	{	
		$this->page->setLayout('modal');
		
		//complete currentEntity
		$this->currentEntity->setCategories($request->getGET('categories'));
		$this->currentEntity->setUsers($_SESSION['users']->id);
		$this->currentEntity->setImage('logoInstance.jpg');
		
		
		// create form
		$formBuilder = new \applications\modules\instances\forms\instancesForm($this->currentEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
		if($request->isPosted() && $form->isValid())
			if($this->currentService->add($this->currentEntity))
				$this->page->addVar('msgSuccess', _TR_InstancesAddSuccessfully);
			
		$this->page->addVar('form', $form->createView());
		
		
		
	}
	
	
	/**
	* display an instance
	* @param \library\httpRequest $request
	* @return void
	*/
	public function displayAction(\library\httpRequest $request)
	{
		//init
		$currentUser = isset($_SESSION['users']) ? $_SESSION['users']->id : 0;
		
		//get categories and votes		
		$categories = $this->baseManager->getManagerOf('instances\categories')->getById($request->getGET('categories'));
		$votes = $this->baseManager->getManagerOf('instances\votes')->getByInstances($request->getGET('id'), $currentUser);
		$forumsManager = $this->baseManager->getManagerOf('instances\forums');
		$forums = $forumsManager->getByInstances($request->getGET('id'));
		$forumsanswers = $forumsManager->getByInstancesWithAnswers($request->getGET('id'));
		
		$this->page->addVar('instances', $this->currentEntity);
		$this->page->addVar('categories', $categories);
		$this->page->addVar('votes', $votes);
		$this->page->addVar('forums', $forums);
		$this->page->addVar('forumsanswers', $forumsanswers);
		
		
	}
	
	public function editAction(\library\httpRequest $request)
	{
		$this->page->setLayout('modal');


		// create form
		$formBuilder = new \applications\modules\instances\forms\instancesForm($this->currentEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
		if($request->isPosted() && $form->isValid())
		if($this->currentService->add($this->currentEntity))
			$this->page->addVar('msgSuccess', _TR_InstancesUpdatedSuccessfully);
			
		$this->page->addVar('form', $form->createView());
		
	}
	
	
	public function deleteAction(\library\httpRequest $request)
	{		
		//get linked object manager
		$votesManager = $this->baseManager->getManagerOf('instances\votes');
		
		//delete action
		$this->currentManager->delete($request->getGET('instances'));	
		$votesManager->delete(array('instances' => $request->getGET('instances')));
		
		//show message success
		$this->page->addVar('msgSuccess', _TR_elementsDeleted);
	}
	
	
}
	