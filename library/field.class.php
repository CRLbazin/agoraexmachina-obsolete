<?php
/**
* file for the field class
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* field class
* field corresponding to the forms
* @author cyril bazin <crlbazin@gmail.com>
*/
abstract class field
{
	protected $title;
	protected $name;
	protected $maxLenght;
	protected $readonly;
	protected $value;
	protected $data;
	protected $module;
	protected $class;
	protected $surveyPannel;
	protected $inputgroups;
	protected $validators = array();
	protected $errorMsg = array();
	

	/**
	* constructor of the field class.
	* @param array values used to hydrate the field
	* @return void
	*/
	public function __construct(array $values = array())
	{
		if(!empty($values))
			$this->hydrate($values);
	}
	
	/**
	* abstract build field method.
	*/
	abstract public function build();
	
	
	/**
	* set the name of the field.
	* @param string name of the field
	* @return void
	*/
	public function setName($name)
	{
		$this->name = $name;
	}
	
	
	/**
	* get the name of the field.
	* @return string name of the field
	*/
	public function getName()
	{
		return $this->name;
	}
	
	/**
	* get the title of the field.
	* @return string title of the field
	*/
	public function getTitle()
	{
		return $this->title;
	}
	
	
	/**
	 * set the survey pannel number.
	 * @param string name of the page
	 */
	public function setSurveyPannel($surveyPannel)
	{
	    $this->surveyPannel = $surveyPannel;
	}
	
	/**
	 * get the survey pannel number.
	 * @return string name of the page
	 */
	public function getSurveyPannel ()
	{
	    return $this->surveyPannel ;
	}
	
	/**
	* hydrate the field.
	* @param array values used to hydrate the field
	* @return void
	*/
	public function hydrate($values)
	{
		foreach($values as $key=>$value)
			$this->$key = $value;
			
	}
	
	/**
	* get validators.
	* @return array validators of the current field
	*/
	public function getValidators()
	{
		return $this->validators;
	}
	
	
	/**
	* is valid method.
	* @return bool false=invalid, true=valid
	*/
	public function isValid()
	{
		$res = true;
		
		foreach($this->validators as $validator)
			if(!$validator->isValid($this->value))
			{
				$error = new \library\error(array(
					'type'	=> \library\error::TYPE_ERR,
					'msg'	=> $validator->getErrorMsg(),
					'div'	=> 'field_error_msg_'.$this->getName(),
				));
				
				\library\handleErrors::setErrors($error);
				$res = false;
			}
			
			return $res;
	}
	
	/**
	* get errors validation message 
	* @return string error message
	*/
	public function getErrorMsg()
	{
		foreach($this->validators as $validator)
			if(!$validator->isValid($this->value))
				$this->errorMsg[] = $validator->getErrorMsg();
			
		return $this->errorMsg;
	}
}
?>