<?php
/**
* file for the services of users
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.users
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\users\services;

use library\baseManager;
/**
* users services
*/
class usersService extends \library\baseService
{
	protected 	$baseManager;
    protected   $currentManager;
    protected   $currentEntity;
    
    
    /**
     * subscribe a user
     * @param object http request
     * @return bool
     */   
    public function add(\applications\modules\users\entities\usersEntity $user)
    {
    	//check if the email exists
    	if(!$this->checkEmailExists($user->getEmail()))
	   	{
	   		if(VAR_ENABLE_MAIL_REGISTRATION == 1)
	   		{
	   			$user->setLevel(rand(100000, 999999));
	   			$user->setActive(0);
	   		}
	   		else
	   		{

	   			$user->setLevel(1);
	   			$user->setActive(1);
	   		}
		   	
	   		//try to save in db
       		if($this->currentManager->save($user))
	       	{
	       		//send email
	       		$dest = $user->getEmail();
	           	$subject = WEBSITE_TITLE.' - Activez votre compte';
	           	$msg = '<body><head></head><body><div style="width : 100%;height : 550px;padding : 25px;background-color : #EFEFEF"><div style="padding : 20px;width : 450px;margin-left: auto;margin-right: auto;background-color: #ffffff !important;box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3), 0 3px 8px rgba(0, 0, 0, 0.2);"><h2 style="color: #428bca !important;">Bonjour '.$user->getName().' et bienvenue</h2><hr/>Activez votre compte en cliquant sur <a href="'.WEBSITE_DNS.''.WEBSITE_ROOT.'/users/active/'. $user->getEmail() .'/'. $user->getLevel() .'/">ce lien</a>.<br/><br/>Une fois votre compte activ&eacute;, connectez-vous et rejoignez les nombreux sujets propos&eacute;s.<br/><br/>Si vous rencontrez le moindre probl&egrave;me, n&#39;h&eacute;sitez pas &agrave;  nous contacter &agrave;  l&#39;adresse suivante : contact.agoraexmachina@gmail.com<br/><br/><br/><br/><p style="color: #555555 !important;">L&#39;&eacute;quipe AGORA Ex Machina.</p></div></div></body></body>';
		       	try
		       	{
		       		sendEmail($dest, $subject, $msg);
		       		return true;
		       	}
		       	catch(\Exception $e)
		       	{
		       		\library\handleErrors::setErrors($this->errorSendEmail);
		       	}
	       	}
	       	else 
	       		\library\handleErrors::setErrors($this->errorSaveInDb);
	    }
	    else
	    	\library\handleErrors::setErrors($this->errorExistingElement);
    	
    	return false;
    }
    
    /**
     * register a user
     * @param \library\httpRequest $request
     * @return bool
     */
    public function register(\applications\modules\users\entities\usersEntity $user)
    {
    	//check if user exists in db
    	if($register = $this->currentManager->register($user->getEmail(), $user->getPassword()))
    	{
    		$this->setUserSession($register[0]);
    		return true;
    	}
    	else
    	{
    		\library\handleErrors::setErrors($this->errorNotExistingElement);
    		return false;
    	}
    }
    
    /**
     * check if the email exists in db
     * @param string email to check
     * @return bool 
     */
    public function checkEmailExists($email)
    {
        if($this->currentManager->getByEmail($email))
            return true ; 
        else 
            return false;
    }
    
    /**
     * set user session
     * @param object $user
     * @return void
     */
    public function setUserSession($user)
    {
    	$_SESSION['users'] = $user;
    }
    

    /**
    * delete element
    * @param int id of the element
    */
    public function delete($id)
    {
    	$this->currentManager->delete($id);
    }
    
    /**
    * active a user
    * @param string $email
    */
    public function active($email, $code)
    {
    	if($this->checkEmailExists($email))
    	{
    		$users = $this->currentManager->getByEmail($email);
    	
    		if($users[0]->level == $code)
    		{
    			$users[0]->level = 1;
    			$users[0]->active = 1;
    			
    			$this->currentEntity->hydrate($users[0]);
    			
    			if($this->currentManager->save($this->currentEntity))
    			{
    				$this->page->addVar('content', _TR_ValidationSuccess);
    				$_SESSION['users'] = $users[0];
    			}
    		}
    		else
    			\library\handleErrors::setErrors($this->errorElement);
    	}
    	else
    		\library\handleErrors::setErrors($this->errorExistingElement);
    }
    
    
    /**
    * save a user
    * @param \applications\modules\users\interfaces\IUsersEntity $user
    */
    public function save(\applications\modules\users\interfaces\IUsersEntity $user)
    {
    	$this->currentManager->save($user);
    }
    
}

?>