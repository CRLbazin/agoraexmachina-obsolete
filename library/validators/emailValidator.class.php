<?php

namespace library\validators;

/**
* email validator
* @author cyril bazin
* @package cu.core
* @version 1.0
*/
class emailValidator extends \library\baseValidator
{

	public function isValid($value)
	{
		$email = stripslashes(htmlentities($value));
        if(!preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',str_replace('&amp;','&',$email)))
			return false;
		else
			return true;
		
	}
}