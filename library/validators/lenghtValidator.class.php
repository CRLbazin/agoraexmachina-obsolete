<?php

namespace library\validators;

/**
* lenght validator
* @author cyril bazin
* @package cu.core
* @version 1.0
*/
class lenghtValidator extends \library\baseValidator
{
	
	public function setErrorMsg()
	{
		$this->errorMsg = _TR_EmailFormat;
	}
	

	public function isValid($value)
	{
		$email = stripslashes(htmlentities($value));
        if(!preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',str_replace('&amp;','&',$email)))
			return false;
		else
			return true;
		
	}
}