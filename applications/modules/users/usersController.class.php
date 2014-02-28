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
* @version 1.0
*/
class usersController extends \library\baseController implements \library\interfaces\iCrud
{
	protected $usersManager = array();
	
	
	/**
	* page admin of the users
	*/
	public function adminAction()
	{
		//define the template's attributes
		$this->page->setLayout('back');
		
		//get the users manager
		$this->usersManager = $this->baseManager->getManagerOf('users');
		
		//get the admin component
		$listAdmin = new \library\webComponents\listAdmin(array(
			'module'	=> 'users',
			'title'		=> "Administration des utilisateurs",
			'columns'	=> array(_TR_Id, _TR_Name, _TR_Email, _TR_Active, _TR_CreationDate),
			'data'		=> $this->usersManager->getAll(array("id", "name", "email", "active", "creationDate"))
		));
		
		$this->page->addVar('listAdmin', $listAdmin->build());
	}
	
	
	/**
	* front page register / subcribe
	*/
	public function registerAction()
	{
	
		if(isset($_POST['subscribeHidden']))
		{
			$usersEntity = new \applications\modules\users\entities\usersEntity(array(
				"name" => $this->application->httpRequest->getData('name'),
				"password" => $this->application->httpRequest->getData('password'),
				"email" => $this->application->httpRequest->getData('email'),
				"level" => 1,
				"active" => 1,
			));
		}
		else
			$usersEntity = new \applications\modules\users\entities\usersEntity();
		
		$usersManager = $this->baseManager->getManagerOf('users');
	
	
		/**
		* create subscribe form
		*/
		$formBuilder = new \applications\modules\users\forms\subscribeForm($usersEntity);
		$formBuilder->build();
		$formSubscribe = $formBuilder->getForm();
		$this->page->addVar('formSubscribe', $formSubscribe->createView());
		
	
		
		/**
		* data processing
		* ****************************************************************
		* ************* register form ************************************
		* ****************************************************************
		*/
		if(isset($_POST['registerHidden']))
		{
			$register = $usersManager->register($this->application->httpRequest->getData('email'), $this->application->httpRequest->getData('password'));
			if($register)
			{
				$_SESSION['users'] = $register[0];
			}
			else
				$this->page->addVar('msgError', _TR_wrongPassword);
		}
		
		/**
		* data processing
		* ****************************************************************
		* ************* subscribe form ************************************
		* ****************************************************************
		*/
		if(isset($_POST['subscribeHidden']))
		{			
			if(!$formSubscribe->isValid())
			{
				$this->page->addVar('msgError', $formSubscribe->displayErrorMsg());
			}
			else
			{
				if($usersManager->save($usersEntity))
					$this->page->addVar('msgSuccess', _TR_UserCreateSuccessfully);
			}
		}
		
		/**
		* create register form
		*/
		if(!isset($_SESSION['users']->name))
		{
			$formBuilder = new \applications\modules\users\forms\registerForm($usersEntity);
			$formBuilder->build();
			$formRegister = $formBuilder->getForm();
			$this->page->addVar('formRegister', $formRegister->createView());
		}
		
	}

	/**
	* delete a user
	* @param post post array of id to delete
	*/
	public function deleteAction($post)
	{
		//get the users manager
		$this->users = $this->baseManager->getManagerOf('users');
		
		while(list($key, $id) = @each($post['id']))			
			$this->users->delete($id);
		$this->page->addVar('msgSuccess', "utilisateur(s) supprim&eacute;(s) avec succ&egrave;s");
	}
	
	/**
	* add a user
	* @param request
	*/
	public function addAction(\library\httpRequest $request)
	{
		//define the template's attributes
		$this->page->setLayout('back');
		
		
		//get users entitiy
		if(!empty($_POST))
		{
			$usersEntity = new \applications\modules\users\entities\usersEntity(array(
				'name'		=> $request->getData('name'),
				'email'		=> $request->getData('email'),
				'password'	=> $request->getData('password'),
				'active'	=> $request->getData('active'),
				'level'		=> $request->getData('level'),
			));
		}
		else
			$usersEntity = new \applications\modules\users\entities\usersEntity();
		
		
		//create form
		$formBuilder = new \applications\modules\users\forms\usersForm($usersEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
		
		if(!empty($_POST))
		{
			if($form->isValid() == false)
			{
				$this->page->addVar('msgError', $form->displayErrorMsg());
				$this->page->addVar('form', $form->createView());
			}
			else
			{
				$this->baseManager->getManagerOf('users')->save($usersEntity);
				$this->page->addVar('msgSuccess', "utilisateur ajout&eacute; avec succ&egrave;s");				
			}
		}		
		else
			$this->page->addVar('form', $form->createView());
			
	}
		
	/**
	* edit a user
	* @param httpRequest
	*/
	public function editAction(\library\httpRequest $request)
	{
		//define the template's attributes
		$this->page->setLayout('back');
		
		//get manager
		$usersManager = $this->baseManager->getManagerOf('users');
		$users = $usersManager->getById($request->getGET('users'));
		$usersEntity = new \applications\modules\users\entities\usersEntity();
		$usersEntity->hydrate($users[0]);
			
		//get users entitiy
		//data processing
		if(!empty($_POST))
			$usersEntity = new \applications\modules\users\entities\usersEntity(array(
				'id'		=> $request->getGET('users'),
				'name'		=> $request->getData('name'),
				'email'		=> $request->getData('email'),
				'password'	=> $request->getData('password'),
				'active'	=> $request->getData('active'),
				'level'		=> $request->getData('level'),
			));
		
		//create form
		$formBuilder = new \applications\modules\users\forms\usersForm($usersEntity);
		$formBuilder->build();
		$form = $formBuilder->getForm();
		
		if($form->isValid() == false)
			$this->page->addVar('msgError', $form->displayErrorMsg());
		else if(!empty($_POST))
		{
			$this->baseManager->getManagerOf('users')->save($usersEntity);
			$this->page->addVar('msgSuccess', "utilisateur mis &agrave; jour avec succ&egrave;s");
		}
		
		$this->page->addVar('form', $form->createView());
		
	}
	
	/**
	* diconnect a user
	*/
	public function disconnectAction()
	{
		unset($_SESSION['users']);
		header("location:".WEBSITE_ROOT);
	}
	
	/**
	* display private space
	*/
	public function privateAction(\library\httpRequest $request)
	{
		if($_SESSION['users']->id == $request->getGET('users'))
		{
			//get manager
			$usersManager = $this->baseManager->getManagerOf('users');
			$users = $usersManager->getById($request->getGET('users'));
			$usersEntity = new \applications\modules\users\entities\usersEntity();
			$usersEntity->hydrate($users[0]);
				
			//get users entitiy
			//data processing
			if(!empty($_POST))
			{
				$usersEntity->setName($request->getData('name'));
				$usersEntity->setEmail($request->getData('email'));
				$usersEntity->setPassword($request->getData('password'));
			}
			
			//create form
			$formBuilder = new \applications\modules\users\forms\privateForm($usersEntity);
			$formBuilder->build();
			$form = $formBuilder->getForm();
			
			if($form->isValid() == false)
				$this->page->addVar('msgError', $form->displayErrorMsg());
			else if(!empty($_POST))
			{
				$this->baseManager->getManagerOf('users')->save($usersEntity);
				$this->page->addVar('msgSuccess', "utilisateur mis &agrave; jour avec succ&egrave;s");
			}
			
			$this->page->addVar('form', $form->createView());
		}
		else
			header("location:".WEBSITE_ROOT);
			
	}
	

	
	
}

?>
