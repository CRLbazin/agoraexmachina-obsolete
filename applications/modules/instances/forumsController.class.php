<?php
/**
* file for the forums controller
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.instances
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\instances;

/**
* forums controller
*/
class forumsController extends \library\baseController
{

	/**
	 * add a forums
	 * @param \library\httpRequest $request
	 * @return void
	 */
	public function addAction(\library\httpRequest $request)
	{
		//define the layout
		$this->page->setLayout('modal');
	
		//complete currentEntity
		$this->currentEntity->setForumsTitle($request->getData('forumsanswerstitle'));
		$this->currentEntity->setForumsUsers($_SESSION['users']->id);
		$this->currentEntity->setForumsAnswersUsers($_SESSION['users']->id);
		$this->currentEntity->setForumsInstances($request->getGET('instances'));
		$this->currentEntity->setForumsCreationDate(date('yyyy-mm-dd'));
		$this->currentEntity->setForumsAnswersCreationDate(date('yyyy-mm-dd'));
	
	
	
		//create form
		$formBuilder = new \applications\modules\instances\forms\forumsForm($this->currentEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
		if($request->isPosted() && $form->isValid())
		if($this->currentService->add($this->currentEntity))
			$this->page->addVar('msgSuccess', "Sujet cr&eacute;&eacute; avec succ&egrave;s");
			
		$this->page->addVar('form', $form->createView());
	
	}
	
	/**
	 * add an answer
	 * @param \library\httpRequest $request
	 * @return void
	 */
	public function addAnswersAction(\library\httpRequest $request)
	{
		//define the layout
		$this->page->setLayout('modal');
	
		//complete currentEntity
		$this->currentEntity->setForumsId($request->getGET('forums'));
		$this->currentEntity->setForumsInstances($request->getData('forumsinstances'));
		
		$this->currentEntity->setForumsTitle($request->getData('forumsanswerstitle'));		
		$this->currentEntity->setForumsAnswersTitle($request->getData('forumsanswerstitle'));
		
		$this->currentEntity->setForumsAnswersForums($request->getGET('forums'));
		$this->currentEntity->setForumsAnswersUsers($_SESSION['users']->id);
		$this->currentEntity->setForumsUsers($_SESSION['users']->id);
		$this->currentEntity->setForumsInstances($request->getGET('instances'));
		$this->currentEntity->setForumsCreationDate(date('yyyy-mm-dd'));
		$this->currentEntity->setForumsAnswersCreationDate(date('yyyy-mm-dd'));


		//create form
		$formBuilder = new \applications\modules\instances\forms\forumsForm($this->currentEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
		if($request->isPosted() && $form->isValid())
		if($this->currentService->addAnswers($this->currentEntity))
			$this->page->addVar('msgSuccess', "R&eacute;ponse ajout&eacute; avec succ&egrave;s");
			
		$this->page->addVar('form', $form->createView());
	
	}
	
	
	/**
	* edit a answer
	* @param \library\httpRequest $request
	* @return void
	*/
	public function editAnswersAction(\library\httpRequest $request)
	{
		//define the layout
		$this->page->setLayout('modal');
		
		//complete currentEntity		
		$this->currentEntity->hydrate($this->currentManager->getAnswersById($request->getGET('id')));
		if($request->isPosted())
		{ 
			$this->currentEntity->setForumsAnswersTitle($request->getData('forumsanswerstitle'));
			$this->currentEntity->setForumsAnswersDescr($request->getData('forumsanswersdescr'));
		}
		
		//create form
		$formBuilder = new \applications\modules\instances\forms\forumsForm($this->currentEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
		if($request->isPosted() && $form->isValid())
			if($this->currentService->add($this->currentEntity))
				$this->page->addVar('msgSuccess', "r&eacute;ponse mise &agrave; jour avec succ&egrave;s");
			
		$this->page->addVar('form', $form->createView());		
	}
	
	/**
	* delete an element
	* @param \library\httpRequest $request
	* @return void
	*/
	public function deleteAnswersAction(\library\httpRequest $request)
	{
		//define the layout
		$this->page->setLayout('modal');
		
		$this->currentService->delete($request->getGET('id'));
		$this->page->addVar('msgSuccess', _TR_elementsDeleted);
	}
	
	

	
	
}
	