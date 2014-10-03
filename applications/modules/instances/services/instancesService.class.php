<?php
/**
* file for the services of instances
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.instances
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\instances\services;

use library\baseManager;

/**
* instances services
*/
class instancesService extends \library\baseService
{
	protected   $currentManager;
    protected   $currentEntity;

    /**
     * add an instance
     * @param \applications\modules\instances\entities\instancesEntity $instance
     * @return boolean
     */
    public function add(\applications\modules\instances\entities\instancesEntity $instance)
    {
    	return ($this->currentManager->save($instance)) ? true : false;
    }
    
    /**
    * delete an instance with forums, votes and delegations
    * @param int $id of the instance
    * @return boolean
    */
    public function delete($id)
    {	
    	$this->currentManager->delete($id);

    	$votesServices = new \applications\modules\instances\services\votesService();
    	$votes = $votesServices->getByInstances($id);
    	foreach($votes as $vote)
    	    $votesServices->delete($vote->id);
    	
    	$forumsServices = new \applications\modules\instances\services\forumsService();
    	$forums = $forumsServices->getByInstances($id);
    	foreach($forums as $forum)
    	    $forumsServices->delete($forum->id);
    	;
    	
    	return true;
    	
    }
    
    
    /**
     * delete all instances for a cateogory
     * @param int id of the category
     * @return void
     */
    public function deleteForCategories($category)
    {
    	$instances = $this->currentManager->getByCategories($category);

   	   	foreach($instances as $instance)
   	   	{
   	   	    $this->delete($instance->id);
   	   	}
    }


    /**
     * get instances by categories
     * @param array|int id of the categorie(s)
     * @return array containing all of the result set rows
     */
    public function getByCategories($categories)
    {
        return $this->currentManager->getByCategories($categories);
    }


    /**
     * get instances by categories with users security 
     * @param array|int id of the categorie(s)
     * @param int id of the user
     * @return array containing all of the result set rows
     */
    public function getSecureByCategories($categories, $users)
    {
        return $this->currentManager->getSecureByCategories($categories, $users);
    }
    
    /**
     * get instance by id with users security
     * @param int id of the instance
     * @param int id of the user
     * @return object result
     */
    public function getSecureById($instances, $users)
    {
        return $this->currentManager->getSecureById($instances, $users);
    }
    
    
}

?>