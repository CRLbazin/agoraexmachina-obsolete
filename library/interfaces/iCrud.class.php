<?php
namespace library\interfaces;

/**
* crud interface
* @author cyril bazin
* @package cu.core
* @version 1.0
*/
interface iCrud
{
	public function deleteAction($id);
	public function addAction(\library\httpRequest $request);
	public function editAction(\library\httpRequest $request);
}

?>