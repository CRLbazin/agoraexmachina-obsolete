<?php
/**
* file for the images controller
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.images
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\images;

/**
* images controller
* @version 1.1
*/
class imagesController extends \library\baseController
{

	/**
	* display an image
	*/
	public function displayAction(\library\httpRequest $request)
	{
		// define the layout
		$this->page->setLayout('none');
		
		// send variables to the view
		$this->page->addVar('path', $request->getGET('path'));
	}
	
	
}

?>