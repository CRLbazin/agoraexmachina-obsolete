<?php

namespace library\validators;

/**
* email validator
* @author cyril bazin
* @package cu.core
* @version 1.0
*/
class passwordValidator extends \library\baseValidator
{

	public function isValid($value)
	{
		$uppercase = preg_match('@[A-Z]@', $value);
		$lowercase = preg_match('@[a-z]@', $value);
		$number    = preg_match('@[0-9]@', $value);
		
		if(!$uppercase || !$lowercase || !$number || strlen($value) < 9) 
			return false;
		else
			return true;
		
	}
}