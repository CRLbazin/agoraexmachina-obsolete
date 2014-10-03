<?php
/**
* file for the services of users 
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.instances.users
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\instances\services;

use library\baseManager;

/**
* instances users services
*/
class usersService extends \library\baseService
{
	protected   $currentManager;
    protected   $currentEntity;

    /**
     * add a user
     * @param \applications\modules\instances\entities\usersEntity $users
     * @return boolean
     */
    public function add(\applications\modules\instances\entities\usersEntity $users)
    {
    	return ($this->currentManager->save($users)) ? true : false;
    }

    
    /**
    * delete a users
    * @param int id of the user
    * @return boolean
    */
    public function delete($id)
    {
    	return ($this->currentManager->delete($id)) ? true : false;
    }
    
    
    /**
    * get all users for an instance
    * @param int id of the instance
    * @return array containing all of the result set rows
    */
    public function getByInstances($instance)
    {
        return $this->currentManager->getByInstances($instance);
    }    
    
    
    /**
    * check if a user can access to instance or propositions
    */
    public function canAccess($context, $users, $values)
    {
        if($context == "instances")
            $this->currentManager->canSeeTheInstance($users, $values);   
    }
}

?>