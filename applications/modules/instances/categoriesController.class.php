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
class categoriesController extends \library\baseController //implements \library\interfaces\iCrud
{

	

	public function adminAction()
	{	
		if($_SESSION['users']->level >= 8)
		{
			//get the categories manager
			$this->categoriesManager = $this->baseManager->getManagerOf('instances\categories');
			
			//get the admin component
			$listAdmin = new \library\webComponents\listAdmin(array(
				'module'	=> 'categories',
				'title'		=> "Administration des thèmes",
				'columns'	=> array(_TR_Id, _TR_Name),
				'data'		=> $this->categoriesManager->getAll(array("id", "name"))
			));
			
			$this->page->addVar('listAdmin', $listAdmin->build());
		}
	}
	
	
	public function editAction(\library\httpRequest $request)
	{
		if($_SESSION['users']->level >= 8)
		{
			//get manager
			$categoriesManager = $this->baseManager->getManagerOf('instances\categories');
			$categories = $categoriesManager->getById($request->getGET('categories'));
			$categoriesEntity = new \applications\modules\instances\entities\categoriesEntity();
			$categoriesEntity->hydrate($categories[0]);
				
			//get users entitiy
			//data processing
			if(!empty($_POST))
				$categoriesEntity->setName($request->getData('name'));
			
			//create form
			$formBuilder = new \applications\modules\instances\forms\categoriesForm($categoriesEntity);
			$formBuilder->build();
			$form = $formBuilder->getForm();
			
			if($form->isValid() == false)
				$this->page->addVar('msgError', $form->displayErrorMsg());
			else if(!empty($_POST))
			{
				$this->baseManager->getManagerOf('instances\categories')->save($categoriesEntity);
				$this->page->addVar('msgSuccess', "thème mis &agrave; jour avec succ&egrave;s");
			}
			
			$this->page->addVar('form', $form->createView());
		}
		else
			header("location:".WEBSITE_ROOT);		
		
	}
	
	public function addAction(\library\httpRequest $request)
	{
		if($_SESSION['users']->level >= 8)
		{
			//get manager
			$categoriesManager = $this->baseManager->getManagerOf('instances\categories');			
			//get entities
			$categoriesEntity = new \applications\modules\instances\entities\categoriesEntity();
				
			//get users entitiy
			//data processing
			if(!empty($_POST))
				$categoriesEntity->setName($request->getData('name'));
			
			//create form
			$formBuilder = new \applications\modules\instances\forms\categoriesForm($categoriesEntity);
			$formBuilder->build();
			$form = $formBuilder->getForm();
			
			if($form->isValid() == false)
				$this->page->addVar('msgError', $form->displayErrorMsg());
			else if(!empty($_POST))
			{
				$this->baseManager->getManagerOf('instances\categories')->save($categoriesEntity);
				$this->page->addVar('msgSuccess', "thème mis &agrave; jour avec succ&egrave;s");
			}
			
			$this->page->addVar('form', $form->createView());
		}
		else
			header("location:".WEBSITE_ROOT);		
		
	}
	
}
	