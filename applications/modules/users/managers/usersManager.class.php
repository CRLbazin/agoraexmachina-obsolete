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
			SET 
				name 			= :name,
				password 		= :password,
				email			= :email,
				active			= :active,
				level			= :level,
				creationDate	= :creationDate";
				
		if($users->getId() != "")
			$sql .= " WHERE id = :id ";
			
		$req = $this->db->prepare($sql);
		
		if($users->getId() != "")
			$req->bindValue(':id', $users->getId());
				
	
		
		$req->bindValue(':name', $users->getName());
		$req->bindValue(':password', $users->getPassword());
		$req->bindValue(':email', $users->getEmail());
		$req->bindValue(':active', $users->getActive());
		$req->bindValue(':level', $users->getLevel());
		$req->bindValue(':creationDate', date('d/m/Y'));

		if(!$req->execute())
			echo $req->errorInfo()[2];
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
}
?>