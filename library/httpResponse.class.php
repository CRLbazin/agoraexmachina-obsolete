<?php
/**
* file for the httpResponse class
* @author cyril bazin <crlbazin@gmail.com>
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* http response manager class
* @version 1.1
*/
class httpResponse
{
	protected $page;

	/**
	* send a http response
	*/
	public function send()
	{
		exit($this->page->getGeneratedPage());
	}
	
	
	/**
	* set page
	* @param object page
	*/
	public function setPage(Page $page)
	{
		$this->page = $page;
	}
	
	/**
	* redirect error 404 page not found
	*/
	public function redirect404()
	{
		if(VAR_ENABLE_REDIRECT_404 == "1")
			header("location:".WEBSITE_404);	
	}
}

?>