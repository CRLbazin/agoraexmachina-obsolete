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
class categoriesController extends \library\baseController
{

	/**
	* admin controller
	* @return void
	*/
	public function adminAction()
	{	
		//get the categories manager
		$this->categoriesManager = $this->baseManager->getManagerOf('instances\categories');
		
		//get the admin component
		$listAdmin = new \library\webComponents\listAdmin(array(
			'module'	=> 'categories',
			'title'		=> "Administration des th&egrave;mes",
			'columns'	=> array(_TR_Name),
			'data'		=> $this->currentManager->getAll(array("id", "name"))
		));
		
		$this->page->addVar('listAdmin', $listAdmin->build());
	}
		
	/**
	* edit a category
	* @param \library\httpRequest $request
	* @return void
	*/
	public function editAction(\library\httpRequest $request)
	{		
		$formBuilder = new \applications\modules\instances\forms\categoriesForm($this->currentEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
		if($request->isPosted() && $form->isValid())
		{
			$this->currentManager->save($this->currentEntity);
			$this->page->addVar('msgSuccess', "th&egrave;me mis &agrave; jour avec succ&egrave;s");
		}
		
		$this->page->addVar('form', $form->createView());			
		
	}
	
	/**
	* add a category
	* @param \library\httpRequest $request
	* @return void
	*/
	public function addAction(\library\httpRequest $request)
	{			
		$formBuilder = new \applications\modules\instances\forms\categoriesForm($this->currentEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
		if($request->isPosted() && $form->isValid())
		{
			$this->currentManager->save($this->currentEntity);
			$this->page->addVar('msgSuccess', "th&egrave;me mis &agrave; jour avec succ&egrave;s");
		}
		
		$this->page->addVar('form', $form->createView());		
	}
	
}
	