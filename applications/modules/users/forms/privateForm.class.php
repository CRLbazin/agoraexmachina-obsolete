<?php
/**
* file for the private users form
* @author cyril bazin <crlbazin@gmail.com>
* @copyright GNU GPL
* @package cu.users
* @filesource
*/
namespace applications\modules\users\forms;

/**
* private form
* @version 1.0
*/
class privateForm extends \library\baseFormBuilder
{
	/**
	* build private users form
	* @todo variabilize the titles
	*/
	public function build()
	{
		$this->form->add(new \library\webComponents\text(
			array(
				'title' 	=> _TR_Id,
				'name' 		=> 'id',
				'readonly'	=> 'readonly',
				'value' 	=>  $this->form->getEntity()->getId(),
			)));
		$this->form->add(new \library\webComponents\text(
			array(
				'title' => _TR_Name,
				'name' => 'name',
				'value' =>  $this->form->getEntity()->getName(),
				'validators'	=> array(
					new \library\validators\notNullValidator("<b>"._TR_Name.'</b> : '._TR_NotNull),
				)
			)));
		$this->form->add(new \library\webComponents\email(
			array(
				'title' => _TR_Email,
				'name' => 'email',
				'value' =>  $this->form->getEntity()->getEmail(),
				'validators'	=> array(
					new \library\validators\notNullValidator("<b>"._TR_Email.'</b> : '._TR_NotNull),
					new \library\validators\emailValidator("<b>"._TR_Email.'</b> : '._TR_EmailFormat),
				)
			)));
		$this->form->add(new \library\webComponents\password(
			array(
				'title' => _TR_Password,
				'name' => 'password',
				'value' =>  $this->form->getEntity()->getPassword(),
				'validators'	=> array(
					new \library\validators\notNullValidator("<b>"._TR_Password.'</b> : '._TR_NotNull),
					new \library\validators\passwordValidator("<b>"._TR_Password.'</b> : '._TR_PasswordFormat),
				)
			)));
		$this->form->add(new \library\webComponents\text(
			array(
				'title' => _TR_CreationDate,
				'name' => 'Date de creation',
				'value' =>  $this->form->getEntity()->getCreationDate(),
					'readonly'	=> 'readonly',
			)));
	}
	
	
}
?>