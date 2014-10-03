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
*/
class categoriesManager extends \library\baseManager
{
	/**
    * ctor
    * @return void
    */
	public function __construct()
	{
		//run baseManager constructor
		parent::__construct();
		//define name of the module
		$this->module = 'categories' ;
	}
	
	/**
	 * delete a category
	 * @param array|int id(s) of the row to deleted
	 * @return void
	 */
	public function delete($values)
	{
		if(is_array($values))
			foreach($values as $key=>$value)
				$this->db->exec("DELETE FROM categories WHERE ".$key ." = '".$value."'");
		else
			$this->db->exec("DELETE FROM categories WHERE id = '".$values."'");
			
	}
	

	/**
	* add or update categories
	* @param \applications\modules\instances\entities\categoriesEntity $categories
	* @return boolean
	*/
	public function save(\applications\modules\instances\entities\categoriesEntity $categories )
	{
		print_r($categories);
		if($categories->getId() == "")
			$sql = "INSERT INTO categories";
		else
			$sql = "UPDATE categories";

		$sql .= "
			SET
			name = :name,
			sizeW = :sizeW,
			sizeH = :sizeH,
			color = :color";
		
		if($categories->getId() != "")
			$sql .= " WHERE id = :id ";

		$req = $this->db->prepare($sql);

		if($categories->getId() != "")
			$req->bindValue(":id", $categories->getId());
		
		$req->bindValue(":sizeW", $categories->getSizeW());
		$req->bindValue(":sizeH", $categories->getSizeH());
		$req->bindValue(":color", $categories->getColor());


		$req->bindValue(":name", $categories->getName());
		
		return $req->execute() ? true : false;
	}
	
	
	/**
	* get all categories with count of instances inside
	* @return array containing all of the result set rows
	*/
	public function getAllWithInstancesCount()
	{
		$sql = "
			SELECT 
				a.*,
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