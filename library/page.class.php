<?php
/**
* file for the page class
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* page class
* @version 1.1
*/
class page
{

	protected $vars = array();
	protected $viewFile = '';
	protected $layout = "front";
	
	/**
	* set view file
	* @param string name of the view file
	*/
	public function setViewFile($view)
	{
		if(!is_string($view) || empty($view))
		{
			throw new \InvalidArgumentException('La vue spécifiée est invalide');
		}
		$this->viewFile = $view;
	}

	/**
	* add a variable to the page
	* @param string name of the variable
	* @param string value of the variable
	*/
	public function addVar($var, $value)
	{
		if(!is_string($var) || is_numeric($var) || empty($var))
		{
			throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractère non nulle');
		}
		$this->vars[$var] = $value;
	}
	
	/**
	* get generated page
	* extracts variables
	* require view file
	* require layout
	*/
	public function getGeneratedPage()
	{
		
		extract($this->vars);
		
		ob_start();
		if(file_exists($this->viewFile))
			require $this->viewFile;
		$content = ob_get_clean();
		
		$parser = new bbcode\parser();
		$parser->addCodeDefinitionSet();
		$content = $parser->parse($content);
		
		ob_start();
		require __DIR__."/../applications/templates/".$this->layout.".layout.php";
		return ob_get_clean();
	}
	
	/**
	* set layout
	* @param string name of the layout (front or back)
	*/
	public function setLayout($value)
	{
		$this->layout = $value;
	}
}

?>