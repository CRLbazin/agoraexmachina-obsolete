<?php
/**
* file for the votes manager
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\managers;
use applications\modules\instances\entities;

/**
* votes manager
* @version 1.0
*/
class votesManager extends \library\baseManager
{
	public function __construct()
	{
		//run baseManager constructor
		parent::__construct();
		//define name of the module
		$this->module = 'votes' ;
	}
	
	
	/**
	 * delete
	 * execute a query "delete" with a filter on id
	 * @param int id of the row to deleted
	 */
	public function delete($values)
	{
		if(is_array($values))
		foreach($values as $key=>$value)
			$this->db->exec("DELETE FROM votes WHERE ".$key ." = '".$value."'");
		else
			$this->db->exec("DELETE FROM votes WHERE id = '".$values."'");
			
	}
	

	/**
	* add or update a votes
	* @param entity votes
	*/
	public function save(\applications\modules\instances\entities\votesEntity $votes )
	{
		if($votes->getId() == "")
			$sql = "INSERT INTO votes";
		else
			$sql = "UPDATE votes";

		$sql .= "
			SET
			instances = :instances,
			users = :users,
			name = :name,
			descr = :descr";
		
		if($votes->getId() != "")
			$sql .= " WHERE id = :id ";

		$req = $this->db->prepare($sql);

		if($votes->getId() != "")
			$req->bindValue(":id", $votes->getId());


		$req->bindValue(":instances", $votes->getInstances());
		$req->bindValue(":users", $votes->getUsers());
		$req->bindValue(":name", $votes->getName());
		$req->bindValue(":descr", $votes->getDescr());
		if(!$req->execute())
			return false;
		else
			return true ;
	}
	
	/**
	* get all votes of an instance
	* @param int id of the instance
	* @return array PDOStatement::fetchAll
	*/
	public function getByInstances($instance, $currentUser=0)
	{
		$req = $this->db->query("
		SELECT 
		    a.*,
		    SUM(IF(b.values > 0, 1, 0)) as voteFor,
		    SUM(IF(b.values < 0, 1, 0)) as voteAgainst,
		    SUM(IF(b.values = 0, 1, 0)) as voteWhite,
		    c.values as voteUser
			
		FROM 
			votes a
		LEFT JOIN votesusers b
		    ON a.id = b.votes
		    
		LEFT JOIN votesusers c
			ON b.votes = c.votes
		    AND c.users = ".$currentUser."
		WHERE a.instances = ".$instance."
		GROUP BY a.id");
		
		$res = $req->fetchAll(\PDO::FETCH_OBJ);
		return (!empty($res)) ? $res : array();
	}
	
	
	/**
	* get a vote with id of the vote and a user
	* @param int id of the vote
	* @param int id of the user
	* @return multitype:|boolean
	*/
	public function getByVoteAndUser($vote, $user)
	{
		$req = $this->db->query("SELECT id, votes, users, `values` FROM votesusers WHERE votes = '".$vote."' and users = '".$user."'");
		$res = $req->fetchAll(\PDO::FETCH_OBJ);
		
		if(sizeof($res) >= 1)
			return $res ;
		else
			return false;
	}
	
	/**
	* save a user vote
	* @param \applications\modules\instances\entities\votesusersEntity $votesusers
	* @return boolean
	*/
	public function saveVotesusers(\applications\modules\instances\entities\votesusersEntity $votesusers )
	{
		if($votesusers->getId() == "")
			$sql = "INSERT INTO votesusers";
		else
			$sql = "UPDATE votesusers";
	
		$sql .= "
			SET
			`votes` = :votes,
			`users` = :users,
			`values` = :values";
	
		if($votesusers->getId() != "")
			$sql .= " WHERE id = :id ";
	
		$req = $this->db->prepare($sql);
	
		if($votesusers->getId() != "")
			$req->bindValue(":id", $votesusers->getId());
	
	
		$req->bindValue(":votes", $votesusers->getVotes());
		$req->bindValue(":users", $votesusers->getUsers());
		$req->bindValue(":values", $votesusers->getValues());
		
		
		if(!$req->execute())
			return false;
		else
			return true ;
	}
}
?>