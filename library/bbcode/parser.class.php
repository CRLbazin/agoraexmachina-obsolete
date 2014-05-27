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
		array_push($this->codeDefinitionSet, array('/\[h1\]([\w\W]*)\[\/h1\]/', '<h1>${1}</h1>'));
		array_push($this->codeDefinitionSet, array('/\[h2\]([\w\W]*)\[\/h2\]/', '<h2>${1}</h2>'));
		array_push($this->codeDefinitionSet, array('/\[h3\]([\w\W]*)\[\/h3\]/', '<h3>${1}</h3>'));
		array_push($this->codeDefinitionSet, array('/\[h4\]([\w\W]*)\[\/h4\]/', '<h4>${1}</h4>'));
		array_push($this->codeDefinitionSet, array('/\[u\]([\w\W]*)\[\/u\]/', '<u>${1}</u>'));
		array_push($this->codeDefinitionSet, array('/\[mail\]([\w\W]*)\[\/mail\]/', '<a href=\'mailto:${1}\'>${1}</a>'));
		array_push($this->codeDefinitionSet, array('/\[br\]/', '<br />'));
	}
	
	
	public function parse($content)
	{
		foreach($this->codeDefinitionSet as $codeDefinition)
			$content = preg_replace($codeDefinition[0], $codeDefinition[1], $content);
		
		return $content;
	}

}