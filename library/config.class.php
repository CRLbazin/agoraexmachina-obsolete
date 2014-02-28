<?php
/**
* file for the config class
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* configuration getter class
* @version 1.1
* @author cyril bazin <crlbazin@gmail.com>
*/
class config 
{

	/**
	* constructor of the config class
	* get configurations and translations
	*/
	public function __construct()
	{
		$this->getConfig();
		$this->getTranslate();
	}
	
	/**
	* get configurations
	* read and load the configurations file 
	*/
	public function getConfig()
	{
		//define a variable for each line in configuration file
		$xml = new \DOMDocument;
		$xml->load(__DIR__.'/../applications/config/config.xml');
		$elements = $xml->getElementsByTagName('define');
		foreach($elements as $element)
		{
			define($element->getAttribute('var'), $element->getAttribute('value'));
		}
	}
	
	/**
	* get translations
	* read and load the translations file
	*/
	public function getTranslate()
	{
		//define a variable for each line in translation file
		$xml = new \DOMDocument;
		$xml->load(__DIR__.'/../applications/config/fr.translate.xml');
		$elements = $xml->getElementsByTagName('translate');
		foreach($elements as $element)
		{
			define($element->getAttribute('var'), $element->getAttribute('value'));
		}		
	}
}

?>