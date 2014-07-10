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
    * @return void
    */
    public function delete($id)
    {
    	$this->currentManager->delete($id);
    	
    	$instancesService = new \applications\modules\instances\services\instancesService();
    	$instancesService->deleteForCategories($id);
    }
    
    
    /**
    * get all categories with count of instances inside
    * @return array containing all categories with count of instances inside
    */
    public function getAllWithInstancesCount()
    {
        return $this->currentManager->getAllWithInstancesCount(); 
    }

    /**
     * add a category
     * @param \applications\modules\instances\entities\categoriesEntity $categories
     * @return boolean
     */
    public function add(\applications\modules\instances\entities\categoriesEntity $categories)
    {
        return $this->currentManager->save($categories);
    }
    
    
    /**
    * edit a category
    * @param \applications\modules\instances\entities\categoriesEntity $categories
    * @return boolean
    */
    public function edit(\applications\modules\instances\entities\categoriesEntity $categories)
    {
        return $this->currentManager->save($categories);
    }
    
    
    
}

?>