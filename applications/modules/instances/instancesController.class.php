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
	* ctor
	* @return void
	*/
	public function __construct(\library\application $application, $module, $action)
	{
		parent::__construct($application, $module, $action);
		require('functions/functions.php');
		
		//delegations
		$delegationsCategories = array();
		$delegationsInstances = array();
		if(isset($_SESSION['users']))
		{
			$delegationService = new \applications\modules\instances\services\delegationsService();
			unset($_SESSION['delegations']);
			$_SESSION['delegations']['categories'] = $delegationService->getDelegationGivenForCategories($this->application->getHttpRequest()->getGET('id'), $_SESSION['users']->id);
			$_SESSION['delegations']['instances'] = $delegationService->getDelegationGivenForInstances($this->application->getHttpRequest()->getGET('id'), $_SESSION['users']->id);
			$_SESSION['delegations']['receiveForCategories'] = $delegationService->getDelegationReceiveForCategories($this->application->getHttpRequest()->getGET('id'), $_SESSION['users']->id);
			$_SESSION['delegations']['receiveForInstances'] = $delegationService->getDelegationReceiveForInstances($this->application->getHttpRequest()->getGET('id'), $_SESSION['users']->id, $this->application->getHttpRequest()->getGET('categories'));
			
			foreach($_SESSION['delegations']['receiveForCategories'] as $v)
			    array_push($delegationsCategories, $v);
			
			foreach($_SESSION['delegations']['receiveForInstances'] as $v)
			    array_push($delegationsInstances, $v);
			
		}
		else
		    unset($_SESSION['delegations']);
		
		

		
		$this->page->addVar('delegationsCategories', $delegationsCategories);
		$this->page->addVar('delegationsInstances', $delegationsInstances);
		    	
		
	}
	
	
	
	
	

	/**
	* index page 
	* @param \library\httpRequest $request
	* @return void
	*/
	public function indexAction(\library\httpRequest $request)
	{		
		$categoriesService = new \applications\modules\instances\services\categoriesService();
		$instancesUsersService = new \applications\modules\instances\services\usersService();
		
		$this->page->addVar('categories', $categoriesService->getById($request->getGET('id')));
		$this->page->addVar('instances', $this->currentService->getSecureByCategories($request->getGET('id'), @$_SESSION['users']->id));

		
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
		$forums = $this->getServiceOf('instances\forums')->getByInstances($request->getGET('id'));
		$forumsanswers = $this->getServiceOf('instances\forums')->getByInstancesWithAnswers($request->getGET('id'));
		$users = $this->getServiceOf('instances\users')->getByInstances($request->getGET('id'));
		$instances = $this->currentService->getSecureById($request->getGET('id'), @$_SESSION['users']->id);
		
		
		$categories = $this->getServiceOf('instances\categories')->getById($request->getGET('categories'));
		$votes = $this->getServiceOf('instances\votes')->getByInstances($request->getGET('id'), $currentUser);
		
		$votesFor = $this->getServiceOf('instances\votes')->getByInstancesAndResults($request->getGET('id'), 'voteFor', $instances->quorumRequired);
		$votesAgainst = $this->getServiceOf('instances\votes')->getByInstancesAndResults($request->getGET('id'), 'voteAgainst', $instances->quorumRequired);
		$votesWhite = $this->getServiceOf('instances\votes')->getByInstancesAndResults($request->getGET('id'), 'voteWhite', $instances->quorumRequired);
		$votesStatusQuo = $this->getServiceOf('instances\votes')->getByInstancesAndResults($request->getGET('id'), 'voteStatusQuo', $instances->quorumRequired);
		
		
			
		$this->page->addVar('instances', $instances);
		$this->page->addVar('categories', $categories);
		$this->page->addVar('votes', $votes);
		$this->page->addVar('forums', $forums);
		$this->page->addVar('forumsanswers', $forumsanswers);
		$this->page->addVar('users', $users);
		$this->page->addVar('votesFor', $votesFor);
		$this->page->addVar('votesAgainst', $votesAgainst);
		$this->page->addVar('votesWhite', $votesWhite);
		$this->page->addVar('votesStatusQuo', $votesStatusQuo);
			
	}
	
	
	/**
	* edit an instance
	* @param \library\httpRequest $request
	* @return void
	*/
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
	
	/**
	* delete an instance
	* @param \library\httpRequest $request
	* @return void
	*/
	public function deleteAction(\library\httpRequest $request)
	{		
		if($this->currentService->delete($request->getGET('instances')))
			$this->page->addVar('msgSuccess', _TR_elementsDeleted);
	}
	
	

	
	
}
	
