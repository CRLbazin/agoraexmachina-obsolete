<?php 
/**
 * file for the error class.
* @package cu.core
* @license GNU GPL
* @author cyril bazin
* @filesource
 */

namespace library;

/**
* error
*/
class error
{
	protected	$type;
	protected	$msg;
	protected	$div;
	
	const	TYPE_ERR	= 'error';
	const	TYPE_WAR 	= 'warning';
	const	TYPE_INF 	= 'info';
	const	TYPE_SUC	= 'success';
	
	const	DIV_GLOBAL	= 'err_global';

	/**
	* error constructor
	* @param array with type, msg and div values
	*/
	public function __construct(array $values = array())
	{
		if(!empty($values))
			$this->hydrate($values);
	}
	


	/**
	 * hydrate the object
	 * @param array list of objects used to hydrate the entity
	 * @return void
	 */
	public function hydrate($values)
	{
		if(isset($values))
		foreach($values as $attr => $val)
		{
			$method = 'set'.ucfirst($attr);
			if(is_callable(array($this, $method)))
				$this->$method($val);
		}
	}

	/**
	 * type setter
	 * @param string $type
	 * @return void
	 */
	public function setType($type)
	{
		$this->type = $type;
	}
	
	/**
	 * msg setter
	 * @param string $msg
	 * @return void
	 */
	public function setMsg($msg)
	{
		$this->msg = $msg;
	}
	
	/**
	 * div setter
	 * @param string $msg
	 * @return void
	 */
	public function setDiv($div)
	{
		$this->div = $div;
	}	

	/**
	* type getter
	* @return string $type
	*/
	public function getType()
	{
		return $this->type;
	}
	
	/**
	* msg getter
	* @return string $msg
	*/
	public function getMsg()
	{
		return $this->msg;
	}
	
	/**
	* div getter
	* @return string $msg
	*/
	public function getDiv()
	{
		return $this->div;
	}
	
	
	
}

?>