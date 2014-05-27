<?php
/**
* file for the instances entity interface
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.interfaces
* @copyright GNU GPL
* @filesource
*/
namespace applications\modules\instances\interfaces;

/**
* interface instances entity
*/
interface IInstancesEntity
{

	function setId($id);

	function getId();
	
	function setName($name);

	function getName();
	
	function setDescr($descr);

	function getDescr();
	
	function setImage($image);

	function getImage();
	
	function setdeadline($deadline);

	function getdeadline();
	
	function setUsers($users);

	function getUsers();
	
	function setCategories($categories);

	function getCategories();
	
	
}
?>