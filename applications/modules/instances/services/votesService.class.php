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
   * add a vote 
   * @param \applications\modules\instances\entities\votesEntity $votes
   * @return boolean
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
    * @return boolean
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
    
    /**
    * check if the user already make a vote
    * @param int id of the vote
    * @param int id of the $user
     */
    public function checkAlreadyVote($id, $user)
    {
    	return $this->currentManager->getByVoteAndUser($id, $user);
    } 
    
    
    /**
    * get all votes for an instance
    * @param int id of the instance
    * @param int id of the currentUser
    * @return array containing all of the result set rows
    */
    public function getByInstances($instance, $currentUser=0)
    {
        return $this->currentManager->getByInstances($instance, $currentUser);
    }
    
    /**
    * get all votes for an instance and a filter in the result
    * @param int id of the $instances
    * @param string result expected
    * @param int quorum
    * @return array containing all votes
    */
    public function getByInstancesAndResults($instancesId, $results, $quorumRequired)
    {
    	$res = array();
    	
    	//get instance
    	$instancesService = $this->getServiceOf('instances');
    	$instance = $instancesService->getById($instancesId);
    	
    	//get votes for the instance
    	$votes = $this->currentManager->getByInstances($instancesId);
    	 
    	//quorum is required
    	if($quorumRequired > 0)
    	{
	    	//all users can vote
	    	if($instance->whoCanVote == "allUsers")
	    	{    	
		    	//get all actives users
		    	$usersService = $this->getServiceOf('users');
		    	$users = $usersService->getAllActiveUsers();	
		    	
	    		foreach($votes as $vote)
	    		{
	    			if($results == "voteFor" or $results == "voteAgainst" or $results == "voteWhite")
	    			{
	    				if($vote->$results >= ($quorumRequired * sizeof($users) / 100))
	    					array_push($res, $vote);
	    			}
	    			else if ($results == "voteStatusQuo")
	    				if($vote->voteFor <= ($quorumRequired * sizeof($users) / 100) && $vote->voteAgainst <= ($quorumRequired * sizeof($users) / 100) && $vote->voteWhite<= ($quorumRequired * sizeof($users) / 100))
	    					array_push($res, $vote);
	    		}
	    	}
	    	//guest users for vote
	    	elseif($instance->whoCanVote == "guests")
	    	{
	    		$usersService = $this->getServiceOf('instances\users');
	    		$users = $usersService->getByInstances($instancesId);
	    		
	    		foreach($votes as $vote)
	    			if($results == "voteFor" or $results == "voteAgainst" or $results == "voteWhite")
	    			{
	    				if($vote->$results >= ($quorumRequired * sizeof($users) / 100))
	    					array_push($res, $vote);
	    			}
	    			else if ($results == "voteStatusQuo")
	    				if($vote->voteFor <= ($quorumRequired * sizeof($users) / 100) && $vote->voteAgainst <= ($quorumRequired * sizeof($users) / 100) && $vote->voteWhite<= ($quorumRequired * sizeof($users) / 100))
	    					array_push($res, $vote);	    					
	    	}
    	}
    	//no quorum required
    	else
    	{
    			//get all actives users
    			$usersService = $this->getServiceOf('users');
    			$users = $usersService->getAllActiveUsers();
    			 
    			if($results == "voteFor" or $results == "voteAgainst" or $results == "voteWhite")
    				foreach($votes as $vote)
    				{
    					if($vote->$results >= $vote->voteFor + $vote->voteAgainst + $vote->voteWhite - $vote->$results)
    						array_push($res, $vote);
    				}
    		
    	}
	    		
    	return sizeof($res) > 0 ? $res : false;
    		
    }
  
}

?>