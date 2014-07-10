<?php
/**
* file for the users controller
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.users
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\users;

/**
* users controller
*/
class usersController extends \library\baseController
{
	
	/**
	* page admin of the users
	* @return void
	*/
	public function adminAction()
	{
		//define the template's attributes
		$this->page->setLayout('back');		
		
		//get the admin component
		$listAdmin = new \library\webComponents\listAdmin(array(
			'module'	=> 'users',
			'title'		=> "Administration des utilisateurs",
			'columns'	=> array( _TR_Name, _TR_Email, _TR_Active, _TR_CreationDate),
			'data'		=> $this->currentService->getAll(array("id", "name", "email", "active", "creationDate"))
		));
		
		$this->page->addVar('listAdmin', $listAdmin->build());
	}
		
	/**
	* page register / subcribe
	* @param \library\httpRequest $request
	* @return void
	*/
	public function registerAction(\library\httpRequest $request)
	{	
		//create register form
		$formBuilder = new \applications\modules\users\forms\registerForm($this->currentEntity);
		$formBuilder->build();
		$formRegister = $formBuilder->getForm();
		if($request->getData('register') && $formRegister->isValid())
				$this->currentService->register($this->currentEntity);
		
		$this->page->addVar('formRegister', $formRegister->createView());

		
		//create subscribe form
		$formBuilder = new \applications\modules\users\forms\subscribeForm($this->currentEntity);
		$formBuilder->build();
		$formSubscribe = $formBuilder->getForm();
		if($request->getData('subscribe') && $formSubscribe->isValid())
				$this->currentService->add($this->currentEntity);
			
		$this->page->addVar('formSubscribe', $formSubscribe->createView());
	}
	
	/**
	* add a user
	* @param \library\httpRequest $request
	* @eturn void
	*/
	public function addAction(\library\httpRequest $request)
	{
		//define the template's attributes
		$this->page->setLayout('back');
		
		//create form
		$formBuilder = new \applications\modules\users\forms\usersForm($this->currentEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
		if ($request->isPosted() && $form->isValid())
				if($this->currentService->add($this->currentEntity))
					$this->page->addVar('msgSuccess', _TR_UserCreateSuccessfully);
		
		$this->page->addVar('form', $form->createView());
		
			
	}
		
	/**
	* edit a user
	* @param httpRequest
	* @return void
	*/
	public function editAction(\library\httpRequest $request)
	{
		//define the template's attributes
		$this->page->setLayout('back');
		
		//create form
		$formBuilder = new \applications\modules\users\forms\usersForm($this->currentEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
		if($request->isPosted() && $form->isValid())
		{			
			$this->currentService->save($this->currentEntity);
			$this->page->addVar('msgSuccess', _TR_UserUpdateSuccessfully);
		}
		
		$this->page->addVar('form', $form->createView());
		
	}
	
	/**
	* disconnect a user
	* @return void
	*/
	public function disconnectAction()
	{
		unset($_SESSION['users']);
		header("location:".WEBSITE_ROOT);
	}
	
	/**
	* private user area 
	* @param \library\httpRequest $request
	* @return void
	*/
	public function privateAction(\library\httpRequest $request)
	{
		//create form
		$formBuilder = new \applications\modules\users\forms\privateForm($this->currentEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
		if($request->isPosted() && $form->isValid())
		{
			$this->currentService->save($this->currentEntity);
			$this->page->addVar('msgSuccess', _TR_UserUpdateSuccessfully);
		}
		
		$this->page->addVar('form', $form->createView());
	}
	
	/**
	* active a user account
	* @param \library\httpRequest $request
	* @return void
	*/
	public function activeAction(\library\httpRequest $request)
	{
		$this->currentService->active($request->getGET('email'), $request->getGET('code'));		
	}
	
}

?>
