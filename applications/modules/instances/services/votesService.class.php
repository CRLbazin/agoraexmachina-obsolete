<?php
/**
* file for the services of votes
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.instances.votes
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\instances\services;

use library\baseManager;
/**
* instances votes services
*/
class votesService extends \library\baseService
{
	protected   $currentManager;
    protected   $currentEntity;
    
   /**
   * add an instance
   * @param \applications\modules\instances\entities\votesEntity $votes
   * @return void
   */
    public function add(\applications\modules\instances\entities\votesEntity $votes)
    {
    	return ($this->currentManager->save($votes)) ? true : false;    	
    }
    
    /**
    * delete a vote
    * @param int id of the vote
    * @return boolean
    */
    public function delete($id)
    {
    	return ($this->currentManager->delete($id)) ? true : false;
    }
    
    /**
    * register a vote for a proposition
    * @param int id of the vote
    * @param int id of the current user
    * @param int id of the voter decision
    * @return void
    */
    public function vote($id, $users, $result)
    {
    	$votesusersEntity = new \applications\modules\instances\entities\votesusersEntity();
    	$votesusersEntity->setVotes($id);
    	$votesusersEntity->setUsers($users);
    	$votesusersEntity->setValues($result);
    	
    	//check if user already vote
    	if($res = $this->checkAlreadyVote($id, $users))
    		$votesusersEntity->setId($res[0]->id);
    	
    	return $this->currentManager->saveVotesusers($votesusersEntity);
    }
    
    public function checkAlreadyVote($id, $user)
    {
    	return $this->currentManager->getByVoteAndUser($id, $user);
    } 
  
}

?>