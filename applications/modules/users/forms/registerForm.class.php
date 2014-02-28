<?php
/**
* file for the users form
* @author cyril bazin <crlbazin@gmail.com>
* @copyright GNU GPL
* @package cu.users
* @filesource
*/
namespace applications\modules\users\forms;

/**
* register form
* @version 1.0
*/
class registerForm extends \library\baseFormBuilder
{
	/**
	* build register form
	* @todo variabilize the titles
	*/
	public function build()
	{
		$this->form->add(new \library\webComponents\email(
			array(
				'title' => _TR_Email,
				'name' => 'email',
				'value' =>  $this->form->getEntity()->getEmail(),
			)));
		$this->form->add(new \library\webComponents\password(
			array(
				'title' => _TR_Password,
				'name' => 'password',
				'value' =>  $this->form->getEntity()->getPassword(),
			)));
		$this->form->add(new \library\webComponents\hidden(
			array(
				'title' => 'registerHidden',
				'name' => 'registerHidden',
				'value' =>  true,
			)));
	}
	
	
}
?>