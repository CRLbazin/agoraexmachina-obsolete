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
*/
class categoriesForm extends \library\baseFormBuilder
{
	/**
	* build code form
	*/
	public function build()
	{ 
		$this->form->add(new \library\webComponents\text(
			array( 
			    "title"      => "id", 
			    "name"       => "id", 
			    "readonly"   => "readonly",
			    "value"      => $this->form->getEntity()->getId(), 
		)));

		$this->form->add(new \library\webComponents\text(
			array( 
			    "title"  => _TR_Name, 
			    "name"   => "name", 
			    "maxLength"  => "50",
			    "value"  => $this->form->getEntity()->getName(), 
		)));


		$this->form->add(new \library\webComponents\select(
				array(
						"title"  => _TR_SizeW,
						"name"   => "sizeW",
						"value"  => $this->form->getEntity()->getSizeW(),
						"values" => array("" => _TR_Default, "double" => "double", "triple" => "triple", "quadro" => "quadro"),
				)
		));		

		$this->form->add(new \library\webComponents\select(
				array(
						"title"  => _TR_SizeH,
						"name"   => "sizeH",
						"value"  => $this->form->getEntity()->getSizeH(),
						"values" => array("" => _TR_Default, "double-vertical" => "double-vertical", "triple-vertical" => "triple-vertical", "quadro-vertical" => "quadro-vertical"),
				)
		));
		

		$this->form->add(new \library\webComponents\colorPicker(
				array(
						"title"  => _TR_Color,
						"name"   => "color",
						"value"  => $this->form->getEntity()->getColor(),
				)
		));

	}
}

?>