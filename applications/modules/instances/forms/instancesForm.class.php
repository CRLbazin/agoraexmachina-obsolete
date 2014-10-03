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
			array( 
			    "title"      => _TR_Name, 
			    "name"       => "name", 
			    "value"      => $this->form->getEntity()->getName(),
			    "maxlenght"  => "255", 
			    "validators" => array(
			        new \library\validators\notNullValidator("<b>"._TR_Name.'</b> : '._TR_NotNull),
			    )				
		)));
	
		$this->form->add(new \library\webComponents\textarea(
			array( 
			    "title"      => _TR_Desc, 
			    "name"       => "descr", 
			    "class"      => "tinymce",
			    "value"      => $this->form->getEntity()->getDescr(), 
			    "validators" => array(
			        new \library\validators\notNullValidator("<b>"._TR_Descr.'</b> : '._TR_NotNull),
			    )
		)));
	
		$this->form->add(new \library\webComponents\image(
			array(
			    "title"      => _TR_Image, 
			    "name"       => "image", 
			    "value"      => $this->form->getEntity()->getImage(),
			    "readonly"   => "readonly", 
                "validators" => array(
                	new \library\validators\notNullValidator("<b>"._TR_Descr.'</b> : '._TR_NotNull),
                )
		)));
	
		$this->form->add(new \library\webComponents\datepicker(
			array( 
			    "title"          => _TR_Deadline, 
			    "name"           => "deadline", 
			    "value"          => $this->form->getEntity()->getdeadline(), 
			    "validators"     => array(
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
		
		
		$this->form->add(new \library\webComponents\select(
			array(
			    "title"  => _TR_WhoCanSeeTheInstance,
			    "name"   => "whoCanSeeTheInstance",
			    "value"  => $this->form->getEntity()->getWhoCanSeeTheInstance(),
			    "values" => array("allUsers" => _TR_AllUsers, "guests" => _TR_Guests, "noOne" => _TR_NoOne),
			    "blank"  => false,
			    )
		));
		
		
		$this->form->add(new \library\webComponents\select(
			array(
			    "title"  => _TR_WhoCanVote,
			    "name"   => "whoCanVote",
			    "value"  => $this->form->getEntity()->getWhoCanVote(),
			    "values" => array("allUsers" => _TR_AllUsers, "guests" => _TR_Guests, "noOne" => _TR_NoOne),
			    "blank"  => false,
			    )
		));

		$this->form->add(new \library\webComponents\select(
		    array(
		        "title"  => _TR_WhoCanWriteVote,
		        "name"   => "whoCanWriteVote",
		        "value"  => $this->form->getEntity()->getWhoCanWriteVote(),
		        "values" => array("allUsers" => _TR_AllUsers, "guests" => _TR_Guests, "noOne" => _TR_NoOne),
			    "blank"  => false,
			    )
		));

		$this->form->add(new \library\webComponents\select(
		    array(
		        "title"  => _TR_TypeOfDelegation,
		        "name"   => "typeOfDelegation",
		        "value"  => $this->form->getEntity()->getTypeOfDelegation(),
		        "values" => array("delegation" => _TR_Delegation, "procuration" => _TR_Procuration),
			    "blank"  => false,
			    )
		));
		
		$this->form->add(new \library\webComponents\pourcent(
		    array(
		        "title"  => _TR_QuorumRequired,
		        "name"   => "quorumRequired",
		        "value"  => $this->form->getEntity()->getQuorumRequired(),
		    )
		));

		
		
		
	}
}

?>