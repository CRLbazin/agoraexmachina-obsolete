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
* @author cyril bazin <crlbazin@gmail.com>
*/
class form
{

	protected $fields = array();
	protected $entity;
	protected $errorMsg = array();
	protected $class = "";
	
	/**
	 * form constructor
	 * @param baseEntity $entity
	 * @eturn void
	 */
	public function __construct(baseEntity $entity)
	{
		$this->setEntity($entity);
	}
	
	/**
	* set the entity associate to the form.
	* @param object entity associate to the form
	* @return void
	*/
	public function setEntity($entity)
	{
		$this->entity = $entity;
	}
	
	
	/**
	* get the entity associate to the form.
	* @return object entity associate to the form
	*/
	public function getEntity()
	{
		return $this->entity;
	}
	
	/**
	* add field to the form.
	* @param object field
	* @return void
	*/
	public function add(field $field)
	{
		$this->fields[] = $field;
	}
	
	/**
	* Check if all fields are valid.
	* @return bool if at least, one field is invalid, retur false. Otherwise return true.
	*/
	public function isValid()
	{
		$res = true;
		foreach($this->fields as $field)
			if(!$field->isValid())
				$res = false;
				
		return $res;
		
	}
	
	/**
	* get errors validation message.
	* @return string error message
	*/
	public function getErrorMsg()
	{
		foreach($this->fields as $field)
			$this->errorMsg[] = $field->getErrorMsg();
			
		return $this->errorMsg;
	}
	
	/**
	* apply CSS class to the form.
	* @param string name of the CSS class
	*/
	public function setClass($value)
	{
		if(isset($value))
		{
			$this->class = $value;
		}
	}
	
	/*
	* display all error messages.
	* @return string error message formatted in HTML list 
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
	* create a simple form.
	* @return string formulary formatted in HTML
	*/
	public function createView()
	{
		$view = "
			<form action='#' method='post' name='".uniqid('form')."'  enctype='multipart/form-data' role='form' class='".$this->class."'>
			<table class='table'>";
		
		// for all fields of the form...
		foreach($this->fields as $field)
		{
			// ... check if the field is an hidden component or a separator component
			if(get_class($field) == "library\webComponents\hidden" || get_class($field) == "library\webComponents\separator")
				$view .= "<tr><td colspan='2'  style='border:0px;'>".$field->build()."</td></tr>";
			else
			{
				$view .= "
						<tr>
							<td style='min-width:100px;'>".$field->getTitle()."</td>
							<td>".$field->build()."</td>
						</tr>";
				
				$errors = \library\handleErrors::getErrorsByDiv("field_error_msg_".$field->getName());
				if(!empty($errors))
				{
					foreach($errors as $error)
					{
						$view .= "<tr>
									<td style='border : 0px;'></td><td style='border : 0px;'><div class='fg-red field_error_msg_".$field->getName()."'>".$error->getMsg()."</div>
								</tr>";
					}
				}
			}
		}
		
		$view .= '
				<tr>
					<td colspan="2">
						<button class="btn btn-primary" type="submit" id="submit"><span class="glyphicon glyphicon-ok"></span> Valider</button>
						<input type="hidden" name="form_entity" value="'.get_class($this->getEntity()).'"/>
					</td>
				</tr>
				</table>
				</form>';
				
		return $view;
	}
	
	
	/**
	* create a survey. 
	* @return string formulary formatted in survey mode
	*/
	public function createSurvey()
	{
		$i = 1;

		$view .= '
			<form action="#" method="post" name="'.uniqid('form').'"  enctype="multipart/form-data">';
		
		$view .= '
		
		<div class="tab-content">';
		
		$nbPage = sizeof($this->fields) - 1;
		foreach($this->fields as $field)
		{
			if($field->getSurveyPannel () == $i)
			{
			
				if($i == 1)
					$view .= '<div class="tab-pane active" id="page'.$i.'">
					<table class="table">';
				else
					$view .= '<div class="tab-pane " id="page'.$i.'">
					<table class="table" >';

				$view .= '<tr><td colspan="2"><h4>Etape '.$i.' / '.$nbPage.'</h4></td></tr>';
				
				foreach($this->fields as $field2)
					if($field2->getSurveyPannel() == $i)
						$view .= '<tr><td>'.$field2->getTitle().'</td><td>'.$field2->build().'</td></tr>'; 
				
				$im = $i - 1;
				$ip = $i + 1;
				
				$view .= '
				<tr>
					<td colspan="2" style="text-align : center">
						<a href="#page'.$im.'" data-toggle="tab"><i class="icon-arrow-left"></i> Pr&eacute;c&eacute;dent</a>
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