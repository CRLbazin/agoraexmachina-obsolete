<?php
/**
* file for the base form builder class
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* base form builder
* @version 1.1
* @author cyril bazin <crlbazin@gmail.com>
*/
abstract class baseFormBuilder
{
	protected $form;
	
	/**
	* constructor of the base form builder class
	* instantiate a new form
	* @param entity entity used to create the form
	*/
	public function __construct($entity)
	{
		$this->form = new form($entity);
	}

	/**
	* build form 
	*/
	abstract public function build();
	
	/**
	* get form
	* @return object form
	*/
	public function getForm()
	{
		return $this->form;
	}
		
	
}
?>