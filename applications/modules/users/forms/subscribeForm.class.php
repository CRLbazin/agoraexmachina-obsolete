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
* subscribe form
*/
class subscribeForm extends \library\baseFormBuilder
{
	/**
	* build subscribe form
	*/
	public function build()
	{
		$this->form->add(new \library\webComponents\text(
			array(
				'title' 		=> _TR_Name,
				'name' 			=> 'name',
				'value' 		=>  $this->form->getEntity()->getName(),
				'required'		=> 'required',
				'inputgroups'	=> 'glyphicon glyphicon-user',
				'validators'	=> array
					(
							new \library\validators\notNullValidator("<b>"._TR_Name.'</b> : '._TR_NotNull),
					)
			)));
		
		$this->form->add(new \library\webComponents\email(
			array(
				'title' 		=> _TR_Email,
				'name'			=> 'email',
				'value' 		=>  $this->form->getEntity()->getEmail(),
				'required'		=> 'required',
				'validators'	=> array
					(
							new \library\validators\notNullValidator("<b>"._TR_Email.'</b> : '._TR_NotNull),
							new \library\validators\emailValidator("<b>"._TR_Email.'</b> : '._TR_EmailFormat),
					)
			)));
		
		$this->form->add(new \library\webComponents\password(
			array(
				'title' 		=> _TR_Password,
				'name' 			=> 'password',
				'value' 		=>  $this->form->getEntity()->getPassword(),
				'required'		=> 'required',
				'validators'	=> array
					(
							new \library\validators\notNullValidator("<b>"._TR_Password.'</b> : '._TR_NotNull),
							new \library\validators\passwordValidator("<b>"._TR_Password.'</b> : '._TR_PasswordFormat),
					)
			)));
		
		$this->form->add(new \library\webComponents\textarea(
			array(
				'title' 		=> _TR_Charter,
				'name' 			=> 'charter',
				'readonly' 		=> 'readonly',
				'rows'			=> '10',
				'value' 		=>  _TR_CharterDetail,
			)));
		
		$this->form->add(new \library\webComponents\hidden(
		    array(
		    		'name'  	=> 'subscribe',
		    		'value'		=> true,
		   )));
	}
	
	
}
?>