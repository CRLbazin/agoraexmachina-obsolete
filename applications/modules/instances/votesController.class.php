<?php
/**
* file for the votes controller
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.instances
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\instances;

/**
* votes controller
*/
class votesController extends \library\baseController
{

	/**
	 * add a vote
	 * @param \library\httpRequest $request
	 * @return void
	 */
	public function addAction(\library\httpRequest $request)
	{
		//define the layout
		$this->page->setLayout('modal');
	
		//complete currentEntity
		$this->currentEntity->setUsers($_SESSION['users']->id);
		$this->currentEntity->setInstances($request->getGET('instances'));
	
	
		//create form
		$formBuilder = new \applications\modules\instances\forms\votesForm($this->currentEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
		if($request->isPosted() && $form->isValid())
		if($this->currentService->add($this->currentEntity))
			$this->page->addVar('msgSuccess', "vote cr&eacute;&eacute; avec succ&egrave;s");
			
		$this->page->addVar('form', $form->createView());
	
	}
	
	
	/**
	* edit a vote
	* @param \library\httpRequest $request
	* @return void
	*/
	public function editAction(\library\httpRequest $request)
	{
		//define the layout
		$this->page->setLayout('modal');
		
		//complete currentEntity
		
		//create form
		$formBuilder = new \applications\modules\instances\forms\votesForm($this->currentEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
		if($request->isPosted() && $form->isValid())
			if($this->currentService->add($this->currentEntity))
				$this->page->addVar('msgSuccess', "vote mis &agrave; jour avec succ&egrave;s");
			
		$this->page->addVar('form', $form->createView());
		
	}
	
	/**
	* delete an element
	* @param \library\httpRequest $request
	* @return void
	*/
	public function deleteAction(\library\httpRequest $request)
	{
		$this->currentService->delete($request->getGET('id'));
		$this->page->addVar('msgSuccess', _TR_elementsDeleted);
	}
	
	
	/**
	* vote action
	* @param \library\httpRequest $request
	* @return void
	*/
	public function voteAction(\library\httpRequest $request)
	{
		
		
		$this->page->setLayout('modal');
		
		if($request->getGET('vote') == "voteFor") {$result = 1;}
		if($request->getGET('vote') == "voteAgainst") {$result = -1;}
		if($request->getGET('vote') == "voteWhite") {$result = 0;} 
		
		if(isset($_SESSION['users']))
		{
			if($this->currentService->vote($request->getGET('id'), $_SESSION['users']->id, $result))
				$this->page->addVar('msgSuccess', _TR_voteConsidered);
		}
		else
			$this->page->addVar('msgError', _TR_MustBeConnected);
	}
	
	
}
	