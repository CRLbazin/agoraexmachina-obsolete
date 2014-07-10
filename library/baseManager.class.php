<?php
/**
* file for the base manager class
* @package cu.core
* @license GNU GPL
* @filesource
*/
namespace library;

/**
* base manager
* provide all basic classes for manage the database.
* @author cyril bazin <crlbazin@gmail.com>
*/
class baseManager
{
	protected  $managers = array();
	protected  $service = array();   
	protected  $db;
	protected  $module;
	
	/**
	* constructor of the base manager class.
	* init the PDO SQL connexion.
	* @return void
	*/
	public function __construct()
	{
		$this->db = new \PDO('mysql:host='.SQL_HOTE.';port='.SQL_PORT.';dbname='.SQL_DB, SQL_USR, SQL_PWD);
	}
	

	/**
	* get the manager of a module
	* @param string name of the module
	* @return object manager of the module
	*/
	public function getManagerOf($module)
	{
		if(!is_string($module) || empty($module))
			throw new \InvalidArgumentException('Le module spécifié est vide');
		else if(!isset($this->managers[$module]))
		{
			preg_match_all('/([\w]*)\\\([\w]*)$/', $module, $modules);
			
			if(!isset($modules[1][0]))
				$manager = "\\applications\\modules\\".$module."\\managers\\".$module."Manager";
			else
				$manager = "\\applications\\modules\\".$modules[1][0]."\\managers\\".$modules[2][0]."Manager";
			
			if(class_exists($manager))
				$this->managers[$module] = new $manager();
		}
		
		if(isset($this->managers[$module]))
			return $this->managers[$module];
		else
			return false;
	}
	
	
	
	/**
	* query get the datas by an id.
	* @param int id of the element
	* @return pdo_object anonymous object with property names that correspond to the column names returned in result set.
	*/
	public function getById($id)
	{
		$req = $this->db->query("SELECT * FROM ".$this->module." WHERE id = '".$id."'");
		$res = $req->fetchAll(\PDO::FETCH_OBJ);
		if(isset($res[0]))
			return $res[0];
		else
			return null;
	}
	
	
	/**
	* query get the datas by codes.
	* @param array|string code or list of codes to retrieve the datas
	* @return pdo_object anonymous object with property names that correspond to the column names returned in result set
	*/
	public function getByCode($code)
	{
		if(is_string($code))
			$req = $this->db->query("SELECT * FROM ".$this->module." WHERE active = 1 AND code = '".$code."' ORDER BY code");
		else if(is_array($code))
		{
			$sql = "SELECT * FROM ".$this->module." WHERE active = 1 ";

			foreach($code as $value)
				$sql .= "OR code = '".$value."' ";
			
			$sql ."  ORDER BY code" ;
			
			$req = $this->db->query($sql);
		}
		return $req->fetchAll(\PDO::FETCH_OBJ);
	}
	
	
	/**
	* query get the datas by names.
	* @param array|string name or list of names to retrieve the datas 
	* @return pdo_object anonymous object with property names that correspond to the column names returned in result set
	*/
	public function getByName($name)
	{
		if(!is_array($name))
			$req = $this->db->query("SELECT * FROM ".$this->module." WHERE active = 1 AND name = '".$name."' ORDER BY name");
		else
		{
			$sql = "SELECT * FROM ".$this->module." WHERE active = 1 ";

			foreach($name as $value)
				$sql .= "OR name = '".$value."' ";
			
			$sql ."  ORDER BY name" ;
			$req = $this->db->query($sql);
		}
		return $req->fetchAll(\PDO::FETCH_OBJ);
	}
	
	
	
	/**
	* get all elements without clause
	* @param array|string name of a column or list of columns to displayed
	* @return pdo_object anonymous object with property names that correspond to the column names returned in result set
	*/
	public function getAll($fields=null)
	{
		if($fields == null || !is_array($fields))
			$req = $this->db->query("SELECT * FROM ".$this->module);
		else
		{
			$sql = "SELECT ";
			for($i = 0; $i < sizeof($fields); $i++)
					$sql .= $fields[$i].", ";
			
			$sql = preg_replace('/(,[\s]*)$/', ' ', $sql);
			
			$sql .= " FROM ".$this->module;
			$req = $this->db->query($sql);
		}
		
		return $req->fetchAll(\PDO::FETCH_OBJ);
	}
	
	
	/**
	* query delete with a filter on the id of the element.
	* @param int id of the row to deleted
	* @return void
	
	public function delete($values)
	{
		if(is_array($values))
			foreach($values as $key=>$value)
				$this->db->exec("DELETE FROM ".$this->module." WHERE ".$key ." = '".$value."'");
		else
			$this->db->exec("DELETE FROM ".$this->module." WHERE id = '".$values."'");
			
	}
	*/
		
}

?>