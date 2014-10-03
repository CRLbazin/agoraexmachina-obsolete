<?php
/**
* file for the services of delegations
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
class delegationsService extends \library\baseService
{
	protected   $currentManager;
    protected   $currentEntity;



    /**
    * add a delegation
    * @param \applications\modules\instances\entities\instancesEntity $instance
    * @return boolean
    */
    public function add(\applications\modules\instances\entities\delegationsEntity $delegations)
    {
    	return ($this->currentManager->save($delegations)) ? true : false;
    }


    /**
     * delete a delegation for categories
     * @param array or int of the categories
     * @param int id of the users1 (delegation from)
     * @return booleean
     */
    public function deleteForCategories($categories, $users1)
    {
    	return ($this->currentManager->deleteForCategories($categories, $users1)) ? true : false;
    }
    
    /**
	* delete a delegation for instances
	* @param array or int of the instances
	* @param int id of the users1 (delegation from)
	* @return booleean
	*/
    public function deleteForInstances($instances, $users1)
	{
		return ($this->currentManager->deleteForInstances($instances, $users1)) ? true : false;
	}
	
	/**
	* get delegations given for a category
	* @param int id of the category
	* @param int id of the user1 (delegation from)
	* @return array containing all of the result set rows
	*/
	public function getDelegationGivenForCategories($categories, $users1)
	{
	    return $this->currentManager->getDelegationGivenForCategories($categories, $users1);
	}
	
	
	/**
	* get delegations given for an instance
	* @param int id of the instance
	* @param int id of the users1 (delegation from)
	* @return array containing all of the result set rows
	*/
	public function getDelegationGivenForInstances($instances, $users1)
	{
	    return $this->currentManager->getDelegationGivenForInstances($instances, $users1);
	}
	
	
	/**
	* get delegations receive for a category
	* @param int id of the category
	* @param int id of the users2 (delegation to)
	* @return array containing all of the result set rows
	*/
	public function getDelegationReceiveForCategories($categories, $users2)
	{
	    return $this->currentManager->getDelegationReceiveForCategories($categories, $users2);
	}
	
	/**
	* get delegations receive for an instance
	* @param int id of the category
	* @param int id of the instance
	* @param int id of the users2 (delegation to)
	* @return array containing all of the result set rows
	*/
	public function getDelegationReceiveForInstances($categories, $instances, $users2)
	{
	    return $this->currentManager->getDelegationReceiveForInstances($categories, $instances, $users2);
	}

	/**
	 * get delegations receive for a user
	 * @param int id of the user
	 * @return array containing all of the result set rows
	 */
	public function getDelegationReceive($users2)
	{
	    return $this->currentManager->getDelegationReceive($users2);
	}
	
	/**
	* get delegations given for a user
	* @param int id of the user
	* @return array containing all of the result set rows
	*/
	public function getDelegationGiven($users1)
	{
	    return $this->currentManager->getDelegationGiven($users1);
	}
	
}

?>