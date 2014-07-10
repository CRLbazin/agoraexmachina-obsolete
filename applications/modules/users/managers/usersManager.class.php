<?php
/**
* file for the users manager
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.users
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\users\managers;

/**
* users manager
* @version 1.0
*/
class usersManager extends \library\baseManager
{

	public function __construct()
	{
		//run baseManager constructor
		parent::__construct();
		//define name of the module
		$this->module = 'users';
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
			$this->db->exec("DELETE FROM users WHERE ".$key ." = '".$value."'");
		else
			$this->db->exec("DELETE FROM users WHERE id = '".$values."'");
			
	}
	

	/**
	* add a user
	* @param usersEntity
	* @return true|errorInfo true if the user create successfully or the message error
	*/
	public function save(\applications\modules\users\entities\usersEntity $users)
	{
		if($users->getId() == "")
			$sql = "INSERT INTO users ";
		else
			$sql = "UPDATE users ";
		
		$sql .= "
		SET ";
		
		if($users->getName() <> "")
			$sql .= "name 			= :name";
		
		if($users->getPassword() <> "")
			$sql .= ", password 		= :password";
		
		if($users->getEmail() <> "")
			$sql .= ", email			= :email";
		

		if($users->getActive() <> "")
			$sql .= ", active			= :active";

		if($users->getLevel() <> "")
			$sql .= ", level			= :level";
		
		if($users->getCreationDate() <> "")
			$sql .= ", creationDate			= :creationDate";
		
				
		if($users->getId() != "")
			$sql .= " WHERE id = :id ";
			
		$req = $this->db->prepare($sql);
		
		if($users->getId() != "")
			$req->bindValue(':id', $users->getId());
				
	
		if($users->getName() <> "")
			$req->bindValue(':name', $users->getName());
		
		if($users->getPassword() <> "")
			$req->bindValue(':password', $users->getPassword());
		
		if($users->getEmail() <> "")
			$req->bindValue(':email', $users->getEmail());
		
		if($users->getActive() <> "")
			$req->bindValue(':active', $users->getActive());
		
		if($users->getLevel() <> "")
			$req->bindValue(':level', $users->getLevel());
		

		if($users->getCreationDate() <> "")
			$req->bindValue(':creationDate', $users->getCreationDate());
		

		if(!$req->execute())
			return false;
		else
			return true;
	}
	
	
	
	/**
	* register
	* @param string email of the user
	* @param string password of the user
	* @return bool true or false if the user registers successfully
	*/
	public function register($email, $password)
	{
		$req = $this->db->query("SELECT id, name, email, level FROM users WHERE email = '".$email."' AND password = '".$password."' and active = 1");
		$res = $req->fetchAll(\PDO::FETCH_OBJ);
		if(sizeof($res) == 1) 
			return $res ;
		else
			return false;
	}
	

	/**
	* get a user by an email
	* @param string email of the user
	* @return mixed
	*/
	public function getByEmail($email)
	{
		$req = $this->db->query("SELECT id, name, password, email, level FROM users WHERE email = '".secureString($email)."'");
		$res = $req->fetchAll(\PDO::FETCH_OBJ);
	
		if(sizeof($res) >= 1)
			return $res ;
		else
			return false;
	}
	
	
	/**
	* get all active users
	* @return mixed false or array of object contains all rows
	*/
	public function getAllActiveUsers($excepts = null)
	{
	    $query = "SELECT id, name, password, email, level, active FROM users WHERE active = 1";
	    if($excepts)
	    {
	        if(is_array($excepts))
	            foreach($excepts as $value)
	            $query .= " and id != ".$value;
	        else
	            $query .= " and id != ".$excepts;
	    }
	    
	    
		$req = $this->db->query($query);
		$res = $req->fetchAll(\PDO::FETCH_OBJ);
	
		if(sizeof($res) >= 1)
			return $res ;
		else
			return false;
		
	}
}
?>