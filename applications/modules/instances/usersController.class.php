<?php
/**
* file for the users controller
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.instances
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\instances;

/**
* users controller
*/
class usersController extends \library\baseController
{
	
	/**
	 * add a users
	 * @param \library\httpRequest $request
	 * @return void
	 */
	public function addAction(\library\httpRequest $request)
	{
		//define the layout
		$this->page->setLayout('modal');
	
		//complete currentEntity
		$this->currentEntity->setInstances($request->getGET('instances'));
		
		//get instance informations
		$instancesService = $this->getServiceOf('instances');
		$instance = $instancesService->getById($request->getGET('instances'));
		
		if($instance->whoCanSeeTheInstance == "allUsers"){$this->currentEntity->setWhoCanSeeTheInstance("1");}else if($instance->whoCanSeeTheInstance == "noOne"){$this->currentEntity->setWhoCanSeeTheInstance("0");}
		if($instance->whoCanVote == "allUsers"){$this->currentEntity->setWhoCanVote("1");}else if($instance->whoCanVote == "noOne"){$this->currentEntity->setWhoCanVote("0");}
		if($instance->whoCanWriteVote == "allUsers"){$this->currentEntity->setWhoCanWriteVote("1");}else if($instance->whoCanWriteVote == "noOne"){$this->currentEntity->setWhoCanWriteVote("0");}
		if($this->currentEntity->getUsers() == $_SESSION['users']->id){$this->currentEntity->setWhoCanSeeTheInstance("1");$this->currentEntity->setWhoCanVote("1");$this->currentEntity->setWhoCanWriteVote("1");}
		
	
	
		//create form
		$formBuilder = new \applications\modules\instances\forms\usersForm($this->currentEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
		if($request->isPosted() && $form->isValid())
    		if($this->currentService->add($this->currentEntity))
    			$this->page->addVar('msgSuccess', "utilisateur cr&eacute;&eacute; avec succ&egrave;s");
    			
		$this->page->addVar('form', $form->createView());
	
	}
	
	
	/**
	* edit a user
	* @param \library\httpRequest $request
	* @return void
	*/
	public function editAction(\library\httpRequest $request)
	{
		//define the layout
		$this->page->setLayout('modal');
		
		//get instance informations
		$instancesService = $this->getServiceOf('instances');
		$instance = $instancesService->getById($request->getGET('instances'));
		
		if($instance->whoCanSeeTheInstance == "allUsers"){$this->currentEntity->setWhoCanSeeTheInstance("1");}else if($instance->whoCanSeeTheInstance == "noOne"){$this->currentEntity->setWhoCanSeeTheInstance("0");}
		if($instance->whoCanVote == "allUsers"){$this->currentEntity->setWhoCanVote("1");}else if($instance->whoCanVote == "noOne"){$this->currentEntity->setWhoCanVote("0");}
		if($instance->whoCanWriteVote == "allUsers"){$this->currentEntity->setWhoCanWriteVote("1");}else if($instance->whoCanWriteVote == "noOne"){$this->currentEntity->setWhoCanWriteVote("0");}
		if($this->currentEntity->getUsers() == $_SESSION['users']->id){$this->currentEntity->setWhoCanSeeTheInstance("1");$this->currentEntity->setWhoCanVote("1");$this->currentEntity->setWhoCanWriteVote("1");}
		
		//create form
		$formBuilder = new \applications\modules\instances\forms\usersForm($this->currentEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
		if($request->isPosted() && $form->isValid())
			if($this->currentService->add($this->currentEntity))
				$this->page->addVar('msgSuccess', "utilisateur mis &agrave; jour avec succ&egrave;s");
			
		$this->page->addVar('form', $form->createView());
		
	}
	
	/**
	* delete an element
	* @param \library\httpRequest $request
	* @return void
	*/
	public function deleteAction(\library\httpRequest $request)
	{
		//define the layout
		$this->page->setLayout('modal');
		
		$this->currentService->delete($request->getGET('id'));
		$this->page->addVar('msgSuccess', _TR_elementsDeleted);
	}
	
	
	
	
	
}
	