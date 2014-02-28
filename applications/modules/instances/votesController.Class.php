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
* @version 1.0
*/
class votesController extends \library\baseController //implements \library\interfaces\iCrud
{
	public function addAction(\library\httpRequest $request)
	{
		//define the layout
		$this->page->setLayout('modal');
		
		if(isset($_SESSION['users']))
		{
		
			//get entities
			$votesEntity = new \applications\modules\instances\entities\votesEntity();
			if(isset($_POST))
				$votesEntity->hydrate(array
				(
					'instances'		=> $request->getGET('instances'),
					'users'			=> $_SESSION['users']->id,
					'name'			=> $request->getData('name'),
					'descr'			=> $request->getData('descr'),
				));
			
			//create form
			$formBuilder = new \applications\modules\instances\forms\votesForm($votesEntity);
			$formBuilder->build();
			$form = $formBuilder->getForm();
			
			
			if($form->isValid() == false)
				$this->page->addVar('msgError', $form->displayErrorMsg());
			else if(!empty($_POST))
			{
				$this->baseManager->getManagerOf('instances\votes')->save($votesEntity);
				$this->page->addVar('msgSuccess', "vote mis &agrave; jour avec succ&egrave;s");
			}
			
			$this->page->addVar('form', $form->createView());
			
		
		}
		else
			$this->page->addVar('msgError', _TR_MustConnected);
		
	}
	
	
}
	