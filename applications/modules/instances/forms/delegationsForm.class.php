<?php

/**
* file for the delegations form
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\forms;

/**
* delegations form
*/
class delegationsForm extends \library\baseFormBuilder
{
	/**
	* build code form
	*/
	public function build()
	{ 
		$this->form->add(new \library\webComponents\select(
			array(
			    "title" 	=> _TR_Users2, 
			    "name" 		=> "users2",
			    "value" 	=> $this->form->getEntity()->getUsers2(),
			    "values"	=> $this->form->getEntity()->getUsers2List(),
		)));
		

		$this->form->add(new \library\webComponents\hidden(
			array( 
			    "title"  => _TR_Categories,
			    "name"   => "categories",
			    "value"  => $this->form->getEntity()->getCategories(),
					
			)));
		
		$this->form->add(new \library\webComponents\hidden(
		array( 
		    "title"   => _TR_Instance,
		    "name"    => "instances",
		    "value"   => $this->form->getEntity()->getInstances(),
		)));
		
		$this->form->add(new \library\webComponents\hidden(
				array( 
				    "title"     => "id",
				    "name"      => "id",
				    "readonly"  => "readonly",
				    "value"     => $this->form->getEntity()->getId(),
				)));
		
		$this->form->add(new \library\webComponents\hidden(
				array( 
				    "title" => _TR_Users1,
				    "name"  => "users1",
				    "value" => $this->form->getEntity()->getUsers1(),
				)));
		
	}
}

?>