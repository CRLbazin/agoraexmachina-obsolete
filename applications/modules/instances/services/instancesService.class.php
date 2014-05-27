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
   * @return void
   */
    public function add(\applications\modules\instances\entities\instancesEntity $instance)
    {
    	return ($this->currentManager->save($instance)) ? true : false;    	
    }
  
}

?>