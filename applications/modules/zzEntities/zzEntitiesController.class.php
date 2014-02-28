<?php
/**
* file for the zzEntities controller
* @author cyril bazin <crlbazin@gmail.com>
* @package other
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\zzEntities;

/**
* zzEntities controller
* @version 1.0
*/
class zzEntitiesController extends \library\baseController
{
	public function adminAction()
	{
		/**
		* set layout
		*/
		$this->page->setLayout("back");
		
		/**
		* init
		*/
		if(!isset($_SESSION['entity']))
			$_SESSION['entity'] = array();
		
		/**
		* delete a field
		*/
		if(isset($_POST['deleteAction']) && strstr($_POST['deleteAction'], "del"))
		{
			unset($_SESSION['entity'][substr($_POST['deleteAction'], 3)]);
		}
		/**
		* reset entity
		*/
		elseif(isset($_POST['resetEntity']))
			unset($_SESSION['entity']);
		/**
		* add a column
		*/
		elseif(isset($_POST['addColumn']))
		{
			array_push($_SESSION['entity'], $_POST);
		}
		/**
		*  generate the entity
		*/
		elseif(isset($_POST['validEntity']))
		{
			$this->page->addVar('generateEntity', true);
		}
			
		
	}		
}

?>