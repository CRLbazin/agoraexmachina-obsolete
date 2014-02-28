<?php
/**
* file for the home controller
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.home
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\home;

/**
* home controller
* @version 1.1
*/
class homeController extends \library\baseController
{

	/**
	* index of the home page
	*/
	public function indexAction()
	{
		// set layout
		$this->page->setLayout("front");
		
		//get categories manager
		$categoriesManager = $this->baseManager->getManagerOf('instances\categories');
		
		//display result
		$this->page->addVar('categories', $categoriesManager->getAllWithInstancesCount());
		
	}
	
	/**
	* 404 action
	*/
	public function redirect404Action()
	{
	}
}

?>