<?php
/**
* file for the users form
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\forms;

/**
* users form
*/
class usersForm extends \library\baseFormBuilder
{
	/**
	* build descr form
	*/
	public function build()
	{ 
	    $usersService = new \applications\modules\users\services\usersService;
	    foreach($usersService->getAllActiveUsers() as $value)
	        $usersList[$value->id] = $value->name;
	    

	    $this->form->add(new \library\webComponents\select(
	        array(
	            "title" 	=> _TR_Users,
	            "name" 		=> "users",
	            "value" 	=> $this->form->getEntity()->getUsers(),
	            "values"	=> $usersList,
	                "validators" => array(
			        new \library\validators\notNullValidator("<b>"._TR_Users.'</b> : '._TR_NotNull),
			    )
	        )));
	    
		$this->form->add(new \library\webComponents\bool(
		array(
		    "title" 	=> _TR_CanSeeTheInstance, 
			"name" 		=> "whoCanSeeTheInstance", 
			"value" 	=> $this->form->getEntity()->getWhoCanSeeTheInstance(),
		)));

		$this->form->add(new \library\webComponents\bool(
		    array(
		        "title" 	=> _TR_CanVote,
		        "name" 		=> "whoCanVote",
		        "value" 	=> $this->form->getEntity()->getWhoCanVote(),
		    )));

		$this->form->add(new \library\webComponents\bool(
		    array(
		        "title" 	=> _TR_CanWriteVote,
		        "name" 		=> "whoCanWriteVote",
		        "value" 	=> $this->form->getEntity()->getWhoCanWriteVote(),
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
		
	
	}
}

?>