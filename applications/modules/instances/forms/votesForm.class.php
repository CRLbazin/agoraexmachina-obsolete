<?php
/**
* file for the votes form
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\forms;

/**
* votes form
*/
class votesForm extends \library\baseFormBuilder
{
	/**
	* build descr form
	*/
	public function build()
	{ 
		$this->form->add(new \library\webComponents\text(
		array( 
			"title" 	=> _TR_Name, 
			"name" 		=> "name", 
			"value" 	=> $this->form->getEntity()->getName(), 
		)));

		$this->form->add(new \library\webComponents\textarea(
		array( 
			"title" 		=> _TR_Descr,
			"name"			=> "descr",
			"class" 		=> "tinymce",
			"value" 		=> $this->form->getEntity()->getDescr(), 
			'validators'	=> array(
				new \library\validators\notNullValidator("<b>"._TR_Descr.'</b> : '._TR_NotNull),
			) 
		)));
		

		$this->form->add(new \library\webComponents\hidden(
				array(
						"title" 	=> _TR_Id,
						"name" 		=> "id",
						"readonly" 	=> "readonly",
						"value" 	=> $this->form->getEntity()->getId(),
				)
		));
		
		$this->form->add(new \library\webComponents\hidden(
				array(
						"title" 	=> _TR_Instance,
						"name" 		=> "instances",
						"readonly" 	=> "readonly",
						"value" 	=> $this->form->getEntity()->getInstances(),
				)
		));
		
		$this->form->add(new \library\webComponents\hidden(
				array(
						"title" 	=> _TR_Users,
						"name" 		=> "users",
						"readonly" 	=> "readonly",
						"value" 	=> $this->form->getEntity()->getUsers(),
				)
		));
		

	}
}

?>