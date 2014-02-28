<?php
/**
* file for the bb code parser application 
* @author cyril bazin <crlbazin@gmail.com>
* @package bbcode
* @copyright GNU GPL
*/
namespace library\bbcode;

/**
* parser class
* @version 1.0
*/
class parser 
{
	public $codeDefinitionSet = array();

	public function addCodeDefinitionSet()
	{
		array_push($this->codeDefinitionSet, array('/\[b\](\w*)\[\/b\]/', '<b>${1}</b>'));
		array_push($this->codeDefinitionSet, array('/\[u\](\w*)\[\/u\]/', '<u>${1}</u>'));
		array_push($this->codeDefinitionSet, array('/\[br\]/', '<br />'));
	}
	
	
	public function parse($content)
	{
		foreach($this->codeDefinitionSet as $codeDefinition)
			$content = preg_replace($codeDefinition[0], $codeDefinition[1], $content);
		
		return $content;
	}

}