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
* @author cyril bazin <crlbazin@gmail.com>
*/
abstract class baseFormBuilder
{
	protected $form;
	
	/**
	* constructor of the base form builder class.
	* @param \library\entity entity used to create the form
	* @return void
	*/
	public function __construct(baseEntity $entity)
	{
		$this->form = new form($entity);
	}

	/**
	* abstract build form method 
	*/
	abstract public function build();
	
	/**
	 * get form
	 * @return \library\form
	 */
	public function getForm()
	{
		return $this->form;
	}
	
}
?>