<?php
/**
* file for the categories entity
* @author cyril bazin 
* @package cu.instances 
* @copyright GNU GPL 
* @filesource 
*/ 
namespace applications\modules\instances\entities;

/**
* categories entities
*/
class categoriesEntity extends \library\baseEntity
{
	protected 
		$id,
		$name,
		$code,
		$sizeW,
		$sizeH,
		$color;
		
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
	* @param varchar name of the entity
	* @return void
	*/
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	* getter name
	* @return varchar name of the entity
	*/
	public function getName()
	{
		return $this->name;
	}
	

	/**
	 * size W getter
	 * @return string sizeW
	 */
	public function getSizeW()
	{
		return $this->sizeW;
	}
	
	/**
	 * sizeW setter
	 * @param string $sizeW
	 */
	public function setSizeW($sizeW)
	{
		$this->sizeW = $sizeW;
	}
	
	
	/**
	* size H getter
	* @return string sizeH 
	*/
	public function getSizeH()
	{
		return $this->sizeH;
	}
	
	/**
	* sizeH setter
	* @param string $sizeH
	*/
	public function setSizeH($sizeH)
	{
		$this->sizeH = $sizeH;
	}
	
	/**
	* get color
	* @return string color
	*/
	public function getColor()
	{
		return $this->color;
	}
	
	/**
	* color setter
	* @param string $color
	*/
	public function setColor($color)
	{
		$this->color = $color;
	}
}	

?>