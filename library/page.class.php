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
*/
class page
{

	protected $vars = array();
	protected $viewFile = '';
	protected $layout = "front"; //default layout
	
	/**
	* set the view file of the page.
	* @param string name of the view
	* @return void
	*/
	public function setViewFile($view)
	{
		if(!is_string($view) || empty($view))
			throw new \InvalidArgumentException(_TR_ViewNotFound);
		else
		  $this->viewFile = $view;
	}

	/**
	* add a variable to the page.
	* @param string name of the variable
	* @param string value of the variable
	* @return void
	*/
	public function addVar($var, $value)
	{
		if(!is_string($var) || is_numeric($var) || empty($var))
			throw new \InvalidArgumentException(_TR_WrongFormatVarPage);
		else
		    $this->vars[$var] = $value;
	}
	
	/**
	* get generated page.
	* @return string the contents of the page.
	*/
	public function getGeneratedPage()
	{
		
        extract($this->vars);
		
		ob_start(); //This function will turn output buffering on. While output buffering is active no output is sent from the script (other than headers), instead the output is stored in an internal buffer.
		
		if(file_exists($this->viewFile)) //require view file.
			require $this->viewFile;

		$content = ob_get_clean(); //Get current buffer contents and delete current output buffer.
		
		$parser = new bbcode\parser(); //instanciate bb code parser.
		$parser->addCodeDefinitionSet(); //add code definitions for bbcode parser.
		$content = $parser->parse($content); //parse content for apply bbcode modifications.
		
		ob_start(); //This function will turn output buffering on. While output buffering is active no output is sent from the script (other than headers), instead the output is stored in an internal buffer.
		
		require __DIR__."/../applications/templates/".$this->layout.".layout.php"; //require layout.
		
		return ob_get_clean(); //return current buffer contents and delete current output buffer
	}
	
	/**
	* set layout of the page.
	* @param string name of the layout (front or back)
	* @return void
	*/
	public function setLayout($value)
	{
		$this->layout = $value;
	}
}

?>