<?php
/**
* file for the forums form
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\forms;

/**
* forums form
*/
class forumsForm extends \library\baseFormBuilder
{
	/**
	* build descr form
	*/
	public function build()
	{ 
		
		$this->form->add(new \library\webComponents\text(
				array(
						"title" 	=> _TR_Title,
						"name" 		=> "forumsanswerstitle",
						"value" 	=> $this->form->getEntity()->getForumsAnswersTitle(),
				)));
		
		$this->form->add(new \library\webComponents\textarea(
				array(
						"title" 	=> _TR_Descr,
						"name" 		=> "forumsanswersdescr",
						"rows"		=> 12,
						"value" 	=> $this->form->getEntity()->getForumsAnswersDescr(),
				)));
		
		$this->form->add(new \library\webComponents\hidden(
				array(
						"title" 	=> _TR_Id,
						"name" 		=> "forumsid",
						"value" 	=> $this->form->getEntity()->getForumsId(),
				)));
		
		
		$this->form->add(new \library\webComponents\hidden(
				array(
						"title" 	=> _TR_Instance,
						"name" 		=> "forumsinstances",
						"value" 	=> $this->form->getEntity()->getForumsInstances(),
				)));
		
		
		$this->form->add(new \library\webComponents\hidden(
				array(
						"title" 	=> _TR_Users,
						"name" 		=> "forumsusers",
						"value" 	=> $this->form->getEntity()->getForumsUsers(),
				)));

		$this->form->add(new \library\webComponents\hidden(
				array(
						"title" 	=> _TR_CreationDate,
						"name" 		=> "forumscreationdate",
						"value" 	=> $this->form->getEntity()->getForumsCreationDate(),
				)));
		
		
		$this->form->add(new \library\webComponents\hidden(
				array(
						"title" 	=> _TR_Id,
						"name" 		=> "forumsanswersid",
						"value" 	=> $this->form->getEntity()->getForumsAnswersId(),
				)));
		
		$this->form->add(new \library\webComponents\hidden(
				array(
						"title" 	=> _TR_Users,
						"name" 		=> "forumsanswersusers",
						"value" 	=> $this->form->getEntity()->getForumsAnswersUsers(),
				)));
		
		
		$this->form->add(new \library\webComponents\hidden(
				array(
						"title" 	=> _TR_CreationDate,
						"name" 		=> "forumsanswerscreationdate",
						"value" 	=> $this->form->getEntity()->getForumsAnswersCreationDate(),
				)));
	}
}

?>