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
* @version 1.0
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
			"title" => _TR_Name, 
			"name" => "name", 
			"value" => $this->form->getEntity()->getName(), 
		)));

		$this->form->add(new \library\webComponents\text(
		array( 
			"title" => _TR_Descr, 
			"name" => "descr", 
			"value" => $this->form->getEntity()->getDescr(), 
		)));

	}
}

?>