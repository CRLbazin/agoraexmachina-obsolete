<?php
/**
* file for the services of forums
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.instances.forums
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\instances\services;

use library\baseManager;

/**
* instances forums services
*/
class forumsService extends \library\baseService
{
	protected   $currentManager;
    protected   $currentEntity;

    /**
     * add a forum
     * @param \applications\modules\instances\entities\forumsEntity $forum
     * @return boolean
     */
    public function add(\applications\modules\instances\entities\forumsEntity $forum)
    {
    	return ($this->currentManager->save($forum)) ? true : false;
    }

    /**
     * add an answers
     * @param \applications\modules\instances\entities\forumsEntity $forum
     * @return boolean
     */
    public function addAnswers(\applications\modules\instances\entities\forumsEntity $forum)
    {
    	return ($this->currentManager->saveForumsAnswers($forum)) ? true : false;
    }
    
    /**
    * delete a forum
    * @param int id of the forum
    * @return boolean
    */
    public function delete($id)
    {
    	return ($this->currentManager->delete($id)) ? true : false;
    }
    
    
    /**
    * get all forums for an instance
    * @param int id of the instance
    * @return array containing all of the result set rows
    */
    public function getByInstances($instance)
    {
        return $this->currentManager->getByInstances($instance);
    }
    
    
    /**
     * get all forums and answers for an instance
     * @param int id of the instance
     * @return array containing all of the result set rows
     */
    public function getByInstancesWithAnswers($instance)
    {
        return $this->currentManager->getByInstancesWithAnswers($instance);
    }
    
    
}

?>