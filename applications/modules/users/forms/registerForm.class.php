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
*/
class registerForm extends \library\baseFormBuilder
{
	/**
	* build register form
	*/
	public function build()
	{
		$this->form->add(new \library\webComponents\email(
			array(
				'title'			=> _TR_Email,
				'name' 			=> 'email',
				'required'		=> 'required',
				'value' 		=>  $this->form->getEntity()->getEmail(),
				'validators'	=> array
					(
							new \library\validators\notNullValidator(),
							new \library\validators\emailValidator(),
					)
			)));
		
		
		$this->form->add(new \library\webComponents\password(
			array(
				'title' 		=> _TR_Password,
				'name' 			=> 'password',
				'required'		=> 'required',
				'value' 		=>  $this->form->getEntity()->getPassword(),
				)								
			));

		
		$this->form->add(new \library\webComponents\hidden(
		    array(
		        'name'			=> 'register',
		    	'value'			=> true,
		      )));
	}
}
?>