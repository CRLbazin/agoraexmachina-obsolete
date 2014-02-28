<?php
	
/**
* file for the categories manager
* @author cyril bazin 
* @package cu.instances
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\managers;
use applications\modules\instances\entities;

/**
* categories manager
* @version 1.0
*/
class categoriesManager extends \library\baseManager
{
	public function __construct()
	{
		//run baseManager constructor
		parent::__construct();
		//define name of the module
		$this->module = 'categories' ;
	}

	/**
	* add or update a categories
	* @param entity categories
	*/
	public function save(\applications\modules\instances\entities\categoriesEntity $categories )
	{
		if($categories->getId() == "")
			$sql = "INSERT INTO categories";
		else
			$sql = "UPDATE categories";

		$sql .= "
			SET
			name = :name";
		
		if($categories->getId() != "")
			$sql .= " WHERE id = :id ";

		$req = $this->db->prepare($sql);

		if($categories->getId() != "")
			$req->bindValue(":id", $categories->getId());


		$req->bindValue(":name", $categories->getName());
		
		if(!$req->execute())
			echo $req->errorInfo()[2];
		else
			return true ;
	}
	
	public function getAllWithInstancesCount()
	{
		$sql = "
			SELECT 
				a.id,
				a.name,
				count(b.id) as instancesCount
			FROM 
				categories a
				left join instances b
					on a.id = b.categories
			GROUP BY
				a.id
			";
			
			
		$req = $this->db->query($sql);
		
		return $req->fetchAll(\PDO::FETCH_OBJ);;
	}
}

?>