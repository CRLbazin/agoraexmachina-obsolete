<?php
	 /**
* file for the instances form
* @author cyril bazin 
* @package cu.instances 
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\forms;

/**
* instances form
*/
class instancesForm extends \library\baseFormBuilder
{
	/**
	* build categories form
	*/
	public function build()
	{ 		
		
		

		$this->form->add(new \library\webComponents\text(
			array( "title" => _TR_Name, 
			"name" => "name", 
			"value" => $this->form->getEntity()->getName(), 
			'validators'	=> array(
				new \library\validators\notNullValidator("<b>"._TR_Name.'</b> : '._TR_NotNull),
			)				
		)));
	
		$this->form->add(new \library\webComponents\textarea(
			array( "title" => _TR_Desc, 
			"name" => "descr", 
			"class" => "tinymce",
			"value" => $this->form->getEntity()->getDescr(), 
			'validators'	=> array(
				new \library\validators\notNullValidator("<b>"._TR_Descr.'</b> : '._TR_NotNull),
			)
		)));
	
		$this->form->add(new \library\webComponents\image(
			array( "title" => _TR_Image, 
			"name" => "image", 
			"value" => $this->form->getEntity()->getImage(),
			"readonly"	=> "readonly", 
			'validators'	=> array(
				new \library\validators\notNullValidator("<b>"._TR_Descr.'</b> : '._TR_NotNull),
			)
		)));
	
		$this->form->add(new \library\webComponents\datepicker(
			array( "title" => _TR_Deadline, 
			"name" => "deadline", 
			"value" => $this->form->getEntity()->getdeadline(), 
			'validators'	=> array(
				new \library\validators\notNullValidator("<b>"._TR_Date.'</b> : '._TR_NotNull),
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
						"title" 	=> _TR_Categories,
						"name" 		=> "categories",
						"readonly" 	=> "readonly",
						"value" 	=> $this->form->getEntity()->getCategories(),
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