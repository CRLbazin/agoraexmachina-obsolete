<?php
/**
* file for the forums manager
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\managers;
use applications\modules\instances\entities;

/**
* forums manager
*/
class forumsManager extends \library\baseManager
{
	public function __construct()
	{
		//run baseManager constructor
		parent::__construct();
		//define name of the module
		$this->module = 'forums' ;
	}

	/**
	* get all forums for an instance
	* @param int id of the instance
	* @return array containing all of the result set rows
	*/
	public function getByInstances($instance)
	{
		$req = $this->db->query("
		SELECT 
				a.id,
				a.instances,
				a.users,
				a.title,
				a.creationdate,
				b.name as usersname,
				b.password as userspassword,
				b.email as usersemail,
				b.active as usersactive,
				b.level as userslevel
		FROM 
			forums a 
				LEFT JOIN users b
				ON a.users = b.id
		WHERE  a.instances = ".$instance);
		
		return $req->fetchAll(\PDO::FETCH_OBJ);
	}
	
	
	/**
	* get all forums and answers for an instance
	* @param int id of the instance
	* @return array containing all of the result set rows 
	*/
	public function getByInstancesWithAnswers($instance)
	{
		$req = $this->db->query("
		SELECT
				a.id,
				a.instances,
				a.users,
				a.title,
				a.creationdate,
				b.id as answersid,
				b.title as answerstitle,
				b.forums as answersforums,
				b.users as answersusers,
				b.creationdate as answerscreationdate,
				b.descr as answersdescr,
				c.name as answersusersname
		FROM 
				forums a 
				LEFT JOIN forumsanswers b 
					INNER JOIN users c
					ON b.users = c.id
				ON a.id = b.forums 
				AND a.instances = '".$instance."'
				ORDER BY b.id");
		
		
		return $req->fetchAll(\PDO::FETCH_OBJ);
	}

	/*
	* save a forum (forums and answers)
	* @param \applications\modules\instances\entities\forumsEntity $forum
	* @return boolean
	*/
	public function save(\applications\modules\instances\entities\forumsEntity $forum)
	{
		if($this->saveForums($forum))
		{
			if($this->db->lastInsertId() > 0)
			{
				$forum->setForumsId($this->db->lastInsertId());
				$forum->setForumsAnswersForums($this->db->lastInsertId());
			}
			
			if($this->saveForumsAnswers($forum))
				return true;
		}
		return false;
	}

	/**
	* add or update forums
	* @param \applications\modules\instances\entities\forumsEntity $forum
	* @return boolean
	*/
	public function saveForums(\applications\modules\instances\entities\forumsEntity $forums)
	{
		if($forums->getForumsId() == "")
			$sql = "INSERT INTO forums";
		else
			$sql = "UPDATE forums";
	
		$sql .= "
			SET
			instances = :instances,
			users = :users,
			title = :title,
			creationdate = :creationdate";
	
		if($forums->getForumsId() != "")
			$sql .= " WHERE id = :id ";
	
		$req = $this->db->prepare($sql);
	
		if($forums->getForumsId() != "")
			$req->bindValue(":id", $forums->getForumsId());
	
	
		$req->bindValue(":instances", $forums->getForumsInstances());
		$req->bindValue(":users", $forums->getForumsUsers());
		$req->bindValue(":title", $forums->getForumsTitle());
		$req->bindValue(":creationdate", $forums->getForumsCreationDate());
	
		return $req->execute() ? true : false;
	}
	
	
	/**
	* add or update forums answers
	* @param \applications\modules\instances\entities\forumsEntity $forum
	* @return boolean
	*/
	public function saveForumsAnswers(\applications\modules\instances\entities\forumsEntity $forums)
	{
		if($forums->getForumsAnswersId() == "")
			$sql = "INSERT INTO forumsanswers";
		else
			$sql = "UPDATE forumsanswers";
	
		$sql .= "
			SET
			title = :title,
			forums = :forums,
			users = :users,
			descr = :descr,
			creationdate = :creationdate";
	
		if($forums->getForumsAnswersId() != "")
			$sql .= " WHERE id = :id ";
	
		
		$req = $this->db->prepare($sql);
	
		if($forums->getForumsAnswersId() != "")
			$req->bindValue(":id", $forums->getForumsAnswersId());
		
		
		$req->bindValue(":title", $forums->getForumsAnswersTitle());
		$req->bindValue(":forums", $forums->getForumsAnswersForums());
		$req->bindValue(":users", $forums->getForumsAnswersUsers());
		$req->bindValue(":descr", $forums->getForumsAnswersDescr());
		$req->bindValue(":creationdate", $forums->getForumsAnswersCreationDate());
		
		
		return $req->execute() ? true : false;
	}
	
	
	/**
	* get answers by id 
	* @param int id of the answer
	* @return array containing all of the result set rows
	 */
	public function getAnswersById($id)
	{
		$req = $this->db->query("
				SELECT
					a.id as forumsid,
					a.instances as forumsinstances,
					a.users as forumsusers,
					a.title as forumstitle,
					a.creationdate as forumscreationdate,
					b.id as forumsanswersid,
					b.title as forumsanswerstitle,
					b.forums as forumsanswersforums,
					b.users as forumsanswersusers,
					b.creationdate as forumsanswerscreationdate,
					b.descr as forumsanswersdescr
				FROM 
					forums a
				LEFT JOIN forumsanswers b
					ON a.id = b.forums				
				WHERE b.id = '".$id."'");
	
		
		$res = $req->fetchAll(\PDO::FETCH_OBJ);
		
		return !empty($res) ? $res[0] : null;
	}
	
	
	/**
	* delete an element 
	* @param array|int id or list of id to delete
	* @return void
	*/
	public function delete($values)
	{	
		$answers = $this->getAnswersById($values);
		
		if(is_array($values))
			foreach($values as $key=>$value)
				$this->db->exec("DELETE FROM forumsanswers WHERE ".$key ." = '".$value."'");
		else
			$this->db->exec("DELETE FROM forumsanswers WHERE id = '".$values."'");
		
		
		
		$res = $this->getByInstancesWithAnswers($answers->forumsinstances);
		if($res[0]->answersid == "")
		{
			$this->db->exec("DELETE FROM forums WHERE id = '".$answers->forumsid."'");
		}
		
	}
	
	
}
?>