<?php
/**
* file for the form class
* @package cu.core
* @copyright GNU GPL
* @filesource
*/
namespace library;

/**
* form class
* @version 1.1
* @author cyril bazin <crlbazin@gmail.com>
*/
class form
{

	protected $fields = array();
	protected $entity;
	protected $errorMsg = array();
	
	/**
	* form class constructor
	* @param object entity linked to the form
	*/
	public function __construct($entity)
	{
		$this->setEntity($entity);
	}
	
	/**
	* set the entity
	* @param object entity linked to the form	
	*/
	public function setEntity($entity)
	{
		$this->entity = $entity;
	}
	
	
	/**
	* get the entity
	* @return object entity linked to the form
	*/
	public function getEntity()
	{
		return $this->entity;
	}
	
	/**
	* add field to the form
	* @param array list of fields
	*/
	public function add(field $field)
	{
		$this->fields[] = $field;
	}
	
	/**
	* check all fields are valid
	* @return bool false=invalid, true=valid	
	*/
	public function isValid()
	{
		foreach($this->fields as $field)
			if(!$field->isValid())
				return false;
				
		return true;
		
	}
	
	/**
	* get errors validation message 
	* @return string error message
	*/
	public function getErrorMsg()
	{
		foreach($this->fields as $field)
			$this->errorMsg[] = $field->getErrorMsg();
			
		return $this->errorMsg;
	}
	
	/*
	* display all error messages
	* @return string error message formatted in html list 
	*/
	public function displayErrorMsg()
	{
		$result = "<ul>";
		foreach($this->getErrorMsg() as $msg)
			foreach($msg as $msg2)
				$result .= "<li>".$msg2."</li>";
				
		$result ."</ul>";
		return $result;
	}
	
	
	/**
	* create a simple form
	* @return string view form formatted in class form html
	*/
	public function createView()
	{
		$view = "
			<form action='#' method='post' name='".uniqid('form')."'  enctype='multipart/form-data'>
			<table class='table'>";
		
		// for all fields of the form
		foreach($this->fields as $field)
		{
			// check if field is an hidden component or a separator component
			// just for presentation
			if(get_class($field) == "library\webComponents\hidden" || get_class($field) == "library\webComponents\separator")
				$view .= "<tr><td colspan='2'>".$field->build()."</td></tr>";
			else
				$view .= "<tr><td>".$field->getTitle()."</td><td>".$field->build()."</td></tr>";
		}
		
		$view .= '
				<tr>
					<td colspan="2">
						<!--<a class="btn btn-default" onClick="this.history.go(-1)">Retour</a>-->
						<input class="btn btn-success" type="submit" />
						<input type="hidden" name="form_entity" value="'.get_class($this->getEntity()).'"/>
					</td>
				</tr>
				</table>
				</form>';
				
		return $view;
	}
	
	
	/**
	* create a survey 
	* @return string view form formatted in survey html
	*/
	public function createSurvey()
	{
		/*
		* init
		*/
		$i = 1;

		$view = '
			<form action="#" method="post" name="'.uniqid('form').'"  enctype="multipart/form-data">';
		
		$view .= '
		
		<div class="tab-content">';
		
		$nbPage = sizeof($this->fields) - 1;
		foreach($this->fields as $field)
		{
			if($field->getPage() == $i)
			{
			
				if($i == 1)
					$view .= '<div class="tab-pane active" id="page'.$i.'">
					<table class="table">';
				else
					$view .= '<div class="tab-pane " id="page'.$i.'">
					<table class="table" >';

				$view .= '<tr><td colspan="2"><h4>Etape '.$i.' / '.$nbPage.'</h4></td></tr>';
				
				foreach($this->fields as $field2)
					if($field2->getPage() == $i)
						$view .= '<tr><td>'.$field2->getTitle().'</td><td>'.$field2->build().'</td></tr>'; 
				
				$im = $i - 1;
				$ip = $i + 1;
				
				$view .= '
				<tr>
					<td colspan="2" style="text-align : center">
						<a href="#page'.$im.'" data-toggle="tab"><i class="icon-arrow-left"></i> Précédent</a>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="#page'.$ip.'" data-toggle="tab">Suivant <i class="icon-arrow-right"></i></a>
					</td>
				</tr>
				';
				
				$view .= '
				</table>			
				</div>';
				
				$i++;
			}
				
		}
		
		$view .= '
				<div class="tab-pane" id="page'.$ip.'">
					<table class="table" >
						<tr><td colspan="2"><h4>Etape '.$nbPage.' / '.$nbPage.'</h4></td></tr>				
						<tr>
							<td >'._TR_ThanksFinish.'</td>
						</tr>
						<tr>
							<td><input type="submit" /></td>
						</tr>
						<tr>
							<td colspan="2" style="text-align : center">
								<a href="#page'.$im.'" data-toggle="tab"><i class="icon-arrow-left"></i> Précédent</a>
							</td>
						</tr>
					</table>
				</div>';
		
		
		$view .= '</div>
		</form>';
		
		return $view;
	}
	
}
?>