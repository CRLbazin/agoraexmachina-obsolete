<?php
/**
* file for the install controller
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.install
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\install;

/**
* install controller
*/
class installController extends \library\baseController
{

	public function indexAction()
	{
		//define the template's attributes
		$this->page->setLayout('install');
	
	}
	
	public function addDbAction()
	{
		//define the template's attributes
		$this->page->setLayout('modal');
		
		$this->currentManager->addDb();
	}
			
}

?>
