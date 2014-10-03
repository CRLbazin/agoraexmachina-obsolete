<?php 
/**
* file for the instances entity
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\entities;

/**
* instances entities
*/
class instancesEntity extends \library\baseEntity implements \applications\modules\instances\interfaces\IInstancesEntity
{
	protected 
		$id,
		$name,
		$descr,
		$image,
		$deadline,
		$users,
		$categories,
		$whoCanSeeTheInstance,
		$whoCanVote,
		$whoCanWriteVote,
		$typeOfDelegation,
		$quorumRequired,
		$voteAccountingMethod;
		
	/**
	* setter id
	* @param int id of the entity
	* @return void
	*/
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	* getter id
	* @return int id of the entity
	*/
	public function getId()
	{
		return $this->id;
	}
	/**
	* setter name
	* @param string name of the entity
	* @return void
	*/
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	* getter name
	* @return string name of the entity
	*/
	public function getName()
	{
		return $this->name;
	}
	/**
	* setter descr
	* @param string description of the entity
	* @return void
	*/
	public function setDescr($descr)
	{
		$this->descr = $descr;
	}

	/**
	* getter descr
	* @return string description of the entity
	*/
	public function getDescr()
	{
		return $this->descr;
	}
	/**
	* setter image
	* @param string image name of the entity
	* @return void
	*/
	public function setImage($image)
	{
		$this->image = $image;
	}

	/**
	* getter image
	* @return string image name of the entity
	*/
	public function getImage()
	{
		return $this->image;
	}
	/**
	* setter deadline
	* @param string deadline of the entity
	* @return void
	*/
	public function setdeadline($deadline)
	{
		$this->deadline = $deadline;
	}

	/**
	* getter deadline
	* @return string deadline of the entity
	*/
	public function getdeadline()
	{
		return $this->deadline;
	}
	/**
	* setter users
	* @param int users of the entity
	* @return void
	*/
	public function setUsers($users)
	{
		$this->users = $users;
	}

	/**
	* getter users
	* @return int users of the entity
	*/
	public function getUsers()
	{
		return $this->users;
	}
	/**
	* setter categories
	* @param int categories of the entity
	* @return void
	*/
	public function setCategories($categories)
	{
		$this->categories = $categories;
	}

	/**
	* getter categories
	* @return int categories of the entity
	*/
	public function getCategories()
	{
		return $this->categories;
	}

	/**
	 * setter whoCanSeeTheInstance
	 * @param string who can see the instance
	 */
	public function setWhoCanSeeTheInstance($whoCanSeeTheInstance)
	{
	    $this->whoCanSeeTheInstance = $whoCanSeeTheInstance;
	}
	
	
	/**
	 * getter whoCanSeeTheInstance
	 * @return string who can see the instance
	 */
	public function getWhoCanSeeTheInstance()
	{
	    return $this->whoCanSeeTheInstance;
	}

	/**
	 * setter whoCanVote
	 * @param string who can vote
	 */
	public function setWhoCanVote($whoCanVote)
	{
	    $this->whoCanVote = $whoCanVote;
	}
	
	
	/**
	 * getter whoCanVote
	 * @return string who can vote
	 */
	public function getWhoCanVote()
	{
	    return $this->whoCanVote;
	}
	
	
	/**
	* setter whoCanWriteVote
	* @param string who can write vote 
	*/
	public function setWhoCanWriteVote($whoCanWriteVote)
	{
	    $this->whoCanWriteVote = $whoCanWriteVote; 
	}
	
	
	/**
	* getter whoCanWriteVote
	* @return string who can write a vote 
	*/
	public function getWhoCanWriteVote()
	{
	    return $this->whoCanWriteVote;
	}
	
	
	/**
	* get type of delegation
	* @return string type of delegation  
	*/
	public function getTypeOfDelegation()
	{
	    return $this->typeOfDelegation;
	}
	
	
	/**
	* setter type of delegation
	* @param string type of delegation
	* @return void
	*/
	public function setTypeOfDelegation($typeOfDelegation)
	{
	    $this->typeOfDelegation = $typeOfDelegation;
	}

	
	/**
	* get quorum
	* @return string quorum pourcent  
	*/
	public function getQuorumRequired()
	{
	    return $this->quorumRequired;
	}
	
	
	/**
	* setter quorum
	* @param string quorum
	* @return void
	*/
	public function setQuorumRequired($quorumRequired)
	{ 
	    $this->quorumRequired = $quorumRequired;
	}
	
	
	/**
	* get vote accounting method
	* @return string vote accounting method  
	*/
	public function getVoteAccountingMethod()
	{
	    return $this->voteAccountingMethod;
	}
	
	/**
	* setter vote accounting method
	* @param string vote accounting method
	* @return void
	*/
	public function setVoteAccountingMethod($voteAccountingMethod)
	{ 
	    $this->voteAccountingMethod = $voteAccountingMethod;
	}
	
}	
?>