<?php
/**
* file for the admin controller
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.admin
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\admin;

/**
* admin controller
* @version 1.1
*/
class adminController extends \library\baseController
{

	/**
	* index page of the admin module
	*/		
	public function indexAction()
	{	
		//define the layout
		$this->page->setLayout('back');
	}

}

?>