<?php

namespace library\webComponents;

/**
* separator web component
* @author cyril bazin
* @package cu.core
*/
class separator extends \library\field
{

	public function build()
	{
		$widget = '';
		$widget .= '<h4>'.$this->data.'</h4>';
		
		return $widget;
	}
}
?>