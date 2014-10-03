<?php
/**
* file for the delegations controller
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.instances
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\instances;

/**
* delegations controller
*/
class delegationsController extends \library\baseController
{

	

	/**
	 * add a delegation
	 * @param \library\httpRequest $request
	 * @return void
	 */
	public function addAction(\library\httpRequest $request)
	{
		$this->page->setLayout('modal');
		
		//get all users except me
		$usersService = new \applications\modules\users\services\usersService();
		$users = $usersService->getAllActiveUsers($_SESSION['users']->id);
		
		//build delegation entity
		$this->currentEntity->setUsers1($_SESSION['users']->id);
		
		//set categories and instances
		if($request->getGET('categories') <> "")
			$this->currentEntity->setCategories($request->getGET('categories'));
		if($request->getGET('instances') <> "")
			$this->currentEntity->setInstances($request->getGET('instances'));
		
		// create form
		$formBuilder = new \applications\modules\instances\forms\delegationsForm($this->currentEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
				
		if($request->isPosted() && $form->isValid())
			if($this->currentService->add($this->currentEntity))
				$this->page->addVar('msgSuccess', _TR_DelegationAddSuccessfully);
			
		$this->page->addVar('form', $form->createView());
	
	}
	
	
	/**
	 * delete a delegation
	 * @param \library\httpRequest $request
	 * @return void
	 */
	public function deleteAction(\library\httpRequest $request)
	{
		$this->page->setLayout('modal');
		
		if($request->getGET('categories') <> "" && $request->getGET('instances') == "")
			if($this->currentService->deleteForCategories($request->getGET('categories'), $_SESSION['users']->id))
				$this->page->addVar('msgSuccess', _TR_DelegationDeletedSuccessfully);
			else
				$this->page->addVar('msgError', _TR_DelegationDeletedError);
		
		if($request->getGET('instances') <> "")
			if($this->currentService->deleteForInstances($request->getGET('instances'), $_SESSION['users']->id))
				$this->page->addVar('msgSuccess', _TR_DelegationDeletedSuccessfully);
			else
				$this->page->addVar('msgError', _TR_DelegationDeletedError);
		
	}
	
	
}
	