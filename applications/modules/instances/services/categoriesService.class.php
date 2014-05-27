<?php
/**
* file for the services of categories
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.instances.categories
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\instances\services;

use library\baseManager;
/**
* instances categories services
*/
class categoriesService extends \library\baseService
{
	protected 	$baseManager;
    protected   $currentManager;
    protected   $currentEntity;
    
   /**
    * delete element
    * @param int id of the element
    */
    public function delete($id)
    {
    	$this->currentManager->delete($id);
    }
    
  
}

?>