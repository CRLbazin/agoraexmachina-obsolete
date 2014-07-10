<?php
/**
* file for the forums entity
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\entities;

/**
* forums entities
*/
class forumsEntity extends \library\baseEntity
{
	protected 
		$forumsid,
		$forumsinstances,
		$forumsusers,
		$forumstitle,
		$forumsanswerstitle,
		$forumscreationdate,
		$forumsanswersid,
		$forumsanswersusers,
		$forumsanswersforums,
		$forumsanswerscreationdate,
		$forumsanswersdescr;
		
	/**
	* setter forumsid
	* @param int id of the entity
	* @return void
	*/
	public function setForumsId($id)
	{
		$this->forumsid = $id;
	}

	/**
	* getter forumsid
	* @return int id of the entity
	*/
	public function getForumsId()
	{
		return $this->forumsid;
	}
	
	/**
	* setter forumsinstances
	* @param int instances of the entity
	* @return void
	*/
	public function setForumsInstances($instances)
	{
		$this->forumsinstances = $instances;
	}

	/**
	* getter instances
	* @return int instances of the entity
	*/
	public function getForumsInstances()
	{
		return $this->forumsinstances;
	}
	
	/**
	* setter forumsusers
	* @param int users of the entity
	* @return void
	*/
	public function setForumsUsers($users)
	{
		$this->forumsusers = $users;
	}

	/**
	* getter users
	* @return int users of the entity
	*/
	public function getForumsUsers()
	{
		return $this->forumsusers;
	}

	/**
	* setter forumstitle
	* @param string title of the entity
	* @return void
	*/
	public function setForumsTitle($title)
	{
		$this->forumstitle = $title;
	}
	
	/**
	* getter forumstitle
	* @return string title of the entity
	*/
	public function getForumsTitle()
	{
		return $this->forumstitle;
	}

	/**
	* setter forumsanswerstitle
	* @param string title answer of the entity
	* @return void
	*/
	public function setForumsAnswersTitle($title)
	{
		$this->forumsanswerstitle = $title;
	}
	
	/**
	* getter forumsanswerstitle
	* @return string title answer of the entity
	*/
	public function getForumsAnswersTitle()
	{
		return $this->forumsanswerstitle;
	}
	
	/**
	* setter forumscreationdate
	* @param string ceationdate of the entity
	* @return void
	*/
	public function setForumsCreationDate($date)
	{
		$this->forumscreationdate = $date;
	}

	/**
	* getter creationdate
	* @return string creationdate of the entity
	*/
	public function getForumsCreationDate()
	{
		return $this->forumscreationdate;
	}

	/**
	* setter forumsanswersid
	* @param int forumsanswersid of the entity 
	* @return void
	*/
	public function setForumsAnswersId($id)
	{
		$this->forumsanswersid = $id;
	}
	
	/**
	* getter forumsanswersid
	* @return int forumsanswersid of the entity
	*/
	public function getForumsAnswersId()
	{
		return $this->forumsanswersid;
	}
	

	/**
	* setter $forumsanswersusers,
	* @param int forumsanswersusers of the user
	* @return void
	*/
	public function setForumsAnswersUsers($user)
	{
		$this->forumsanswersusers = $user;
	}
	
	/**
	* getter forumsanswersusers
	* @return int forumsanswersusers the user
	*/
	public function getForumsAnswersUsers()
	{
		return $this->forumsanswersusers;
	}


	/**
	* setter forumanswerscreationdate,
	* @param string forumsanswerscreationdate of the entity
	* @return void
	*/
	public function setForumsAnswersCreationDate($date)
	{
		$this->forumsanswerscreationdate = $date;
	}
	
	/**
	* getter forumsanswerscreationdate
	* @return string forumsanswerscreationdate of the entity
	*/
	public function getForumsAnswersCreationDate()
	{
		return $this->forumsanswerscreationdate;
	}



	/**
	* setter forumanswersdescr
	* @param string forumsanswersdescr of the entity
	* @return void
	*/
	public function setForumsAnswersDescr($descr)
	{
		$this->forumsanswersdescr = $descr;
	}
	
	/**
	* getter forumsanswersdescr
	* @return string forumsanswersdescr of the entity
	*/
	public function getForumsAnswersDescr()
	{
		return $this->forumsanswersdescr;
	}


	/**
	* setter forumanswersforums
	* @param int forumsanswersforums of the entity
	* @return void
	*/
	public function setForumsAnswersForums($forum)
	{
		$this->forumsanswersforums = $forum;
	}
	
	/**
	* getter forumsanswersforums
	* @return int forumsanswersforums of the entity
	*/
	public function getForumsAnswersForums()
	{
		return $this->forumsanswersforums;
	}
	
	
	
	
	
}
?>