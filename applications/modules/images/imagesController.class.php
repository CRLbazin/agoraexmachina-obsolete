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
*/
class imagesController extends \library\baseController
{

	/**
	* display an image
	* @param \library\httpRequest $request
	* return void
	*/
	public function displayAction(\library\httpRequest $request)
	{
		// define the layout
		$this->page->setLayout('none');
		
		$this->page->addVar('path', $request->getGET('path'));
	}
	
	
}

?>