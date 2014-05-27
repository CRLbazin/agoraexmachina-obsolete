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
*/
class homeController extends \library\baseController
{

	/**
	* index of the home page
	* @return void
	*/
	public function indexAction()
	{
		$this->page->setLayout("front");
		$categoriesManager = $this->baseManager->getManagerOf('instances\categories');
		$this->page->addVar('categories', $categoriesManager->getAllWithInstancesCount());
		
	}
	
	/**
	* 404 action
	* @return void
	*/
	public function redirect404Action()
	{
	}
}

?>