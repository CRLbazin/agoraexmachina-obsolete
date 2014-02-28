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
* @version 1.0
*/
class instancesController extends \library\baseController //implements \library\interfaces\iCrud
{

	public function indexAction(\library\httpRequest $request)
	{
		//data processing
		if(isset($_POST))
		{
			if($request->getData('form_entity') == 'applications\modules\instances\entities\instancesEntity')
			{
				$instancesController = new \applications\modules\instances\instancesController($this->application, "instances", "add");
				$instancesController->addAction($request);
			}
		}
	
		$categoriesManager = $this->baseManager->getManagerOf('instances\categories');
		$this->page->addVar('categories', $categoriesManager->getById($request->getGET('categories')));
		
		$this->page->addVar('instances', $this->currentManager->getByCategories($request->getGET('categories')));
	}
	
	
	public function addAction(\library\httpRequest $request)
	{
		
		$this->page->setLayout('modal');
	
		if(isset($_SESSION['users']))
		{
			// $_POST processing
			if(!empty($_POST))
				$this->currentEntity->hydrate(array
				(
					'name'			=> $request->getData('name'),
					'descr'			=> $request->getData('descr'),
					'image'			=> $request->getData('image'),
					'deadline'		=> $request->getData('deadline'),
					'users'			=> $_SESSION['users']->id,
					'categories'	=> $request->getGET('categories'),
				));
			
				
			// create form
			$formBuilder = new \applications\modules\instances\forms\instancesForm($this->currentEntity);
			$formBuilder->build();
			$form = $formBuilder->getForm();
			
			
			//posted and valid
			if(!empty($_POST) && $form->isValid())
			{
				
				// upload image
				if(!empty($_POST))
					if(isset($_FILES))
						if($_FILES['image']['name'] != "")
						{
							uploadFile($_FILES['image'], $_SERVER['DOCUMENT_ROOT']. WEBSITE_ROOT.'/images/', $_FILES['image']['name']);
							$this->currentEntity->setImage( $_FILES['image']['name']);
						}
			
				$this->baseManager->getManagerOf('instances')->save($this->currentEntity);	
				$this->page->addVar('msgSuccess', _TR_InstancesAddSuccessfully);	
			}
			//posted and invalid
			else if(!empty($_POST) && !$form->isValid())
			{
				$this->page->addVar('msgError', $form->displayErrorMsg());
				$this->page->addVar('form', $form->createView());
			}
			//not posted
			else
				$this->page->addVar('form', $form->createView());
		}
		
	}
	
	
	public function displayAction(\library\httpRequest $request)
	{
		//POST event
		if(isset($_POST))
		{
			//add votes
			if($request->getData('form_entity') == 'applications\modules\instances\entities\votesEntity')
			{
				$votesController = new \applications\modules\instances\votesController($this->application, "instances\votes", "add");
				$votesController->addAction($request);
			}
			//edit instances
			else if($request->getData('form_entity') == 'applications\modules\instances\entities\instancesEntity')
			{
				$instancesController = new \applications\modules\instances\instancesController($this->application, "instances", "edit");
				$instancesController->editAction($request);
			}
		}
		
		
		//get instances
		$instances = $this->currentManager->getById($request->getGET('instances'));
		
		
		//get categories and votes
		$categories = $this->baseManager->getManagerOf('instances\categories')->getById($request->getGET('categories'));
		$votes = $this->baseManager->getManagerOf('instances\votes')->getByInstances($request->getGET('instances'));
		
		$this->page->addVar('instances', $instances);
		$this->page->addVar('categories', $categories);
		$this->page->addVar('votes', $votes);
		
		
	}
	
	public function editAction(\library\httpRequest $request)
	{
		$this->page->setLayout('modal');
		
		$entity = $this->currentManager->getById($request->getGET('instances'));
		$this->currentEntity->hydrate($entity[0]);
		
		
		if(isset($_SESSION['users']))
		{
			// $_POST processing
			if(!empty($_POST))
				$this->currentEntity->hydrate(array
				(
					'name'			=> $request->getData('name'),
					'descr'			=> $request->getData('descr'),
					'image'			=> $request->getData('image'),
					'deadline'		=> $request->getData('deadline'),
					'users'			=> $_SESSION['users']->id,
					'categories'	=> $request->getGET('categories'),
				));
			
				
			// create form
			$formBuilder = new \applications\modules\instances\forms\instancesForm($this->currentEntity);
			$formBuilder->build();
			$form = $formBuilder->getForm();
			
			
			//posted and valid
			if(!empty($_POST) && $form->isValid())
			{
				
				// upload image
				if(!empty($_POST))
					if(isset($_FILES))
						if($_FILES['image']['name'] != "")
						{
							uploadFile($_FILES['image'], $_SERVER['DOCUMENT_ROOT']. WEBSITE_ROOT.'/images/', $_FILES['image']['name']);
							$this->currentEntity->setImage( $_FILES['image']['name']);
						}
			
				$this->baseManager->getManagerOf('instances')->save($this->currentEntity);	
				$this->page->addVar('msgSuccess', _TR_InstancesAddSuccessfully);	
			}
			//posted and invalid
			else if(!empty($_POST) && !$form->isValid())
			{
				$this->page->addVar('msgError', $form->displayErrorMsg());
				$this->page->addVar('form', $form->createView());
			}
			//not posted
			else
				$this->page->addVar('form', $form->createView());
		}
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
	