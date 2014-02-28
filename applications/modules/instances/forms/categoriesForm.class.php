<?php

/**
* file for the categories form
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\forms;

/**
* categories form
* @version 1.0
*/
class categoriesForm extends \library\baseFormBuilder
{
	/**
	* build code form
	*/
	public function build()
	{ 
		$this->form->add(new \library\webComponents\text(
			array( "title" => "id", 
			"name" => "id", 
			"readonly" => "readonly",
			"value" => $this->form->getEntity()->getId(), 
		)));

		$this->form->add(new \library\webComponents\text(
			array( "title" => _TR_Name, 
			"name" => "name", 
			"value" => $this->form->getEntity()->getName(), 
		)));

	}
}

?>