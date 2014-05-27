<?php 
/**
 * file for the handle errors class.
* @package cu.core
* @license GNU GPL
* @author cyril bazin
* @filesource
 */

namespace library;

/**
* errors manager
*/
class handleErrors
{
	
	public function __construct()
	{
		unset($_SESSION['handleErrors']);
	}
	
	/**
	* set error to handleError
	* @param \library\error $error
	* @return void
	*/
	public static function setErrors(\library\error $error)
	{
		$_SESSION['handleErrors'][] = $error;
	}
	
	/**
	* getter errors
	* @return array of error object
	*/
	public static function getErrors()
	{
		if(isset($_SESSION['handleErrors']))
			return $_SESSION['handleErrors'];
		else
			return null;
	}
	
	public static function getErrorsByDiv($div)
	{
		$res = array();
		if(isset($_SESSION['handleErrors']))
			foreach($_SESSION['handleErrors'] as $error)
				if($error->getDiv() == $div)
					array_push($res, $error);
				
		return $res;
	}
	
	
}

?>