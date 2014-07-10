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
		$categoriesService = new \applications\modules\instances\services\categoriesService();
		$this->page->addVar('categories', $categoriesService->getAllWithInstancesCount());
		
	}
	
	/**
	* 404 action redirect
	* @return void
	*/
	public function redirect404Action(){}
}

?>