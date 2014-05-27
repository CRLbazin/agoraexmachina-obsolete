<?php

namespace library\validators;

/**
* not null validator
* @author cyril bazin
* @package cu.core
* @version 1.0
*/
class notNullValidator extends \library\baseValidator
{
	
	
	public function setErrorMsg()
	{
		$this->errorMsg = _TR_NotNull;
	}
	

	public function isValid($value)
	{
		if($value == null || $value == "")
			return false;
		else
			return true;
		
	}
}