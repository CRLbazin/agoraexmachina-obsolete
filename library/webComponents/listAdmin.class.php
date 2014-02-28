<?php

namespace library\webComponents;

/**
* admin list web component
* @author cyril bazin
* @package cu.core
* @version 1.1
*/
class listAdmin extends \library\field
{
	public function build()
	{
		$paramAdd = (isset($this->param['add'])) ? '?'.$this->param['add'] : '';
	
		//display action button 
		$widget = '
		<!-- boutons action -->
		<div class="btn-group primary" style="float:left;margin-right : 10px;">
			<button class="btn btn-primary dropdown-toggle btn-small" data-toggle="dropdown">Actions <span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a href="'.WEBSITE_ROOT.'/admin/'.encodeHtmlString($this->module).'/add'.encodeHtmlString($paramAdd).'"><i class="icon-plus"></i> Ajouter</a></li>
				<li><a href="#" onclick="if(confirm(\'Voulez vous vraiment supprimer ?\')){$(\'#formAction\').val(\'delete\'); window.document.form'.str_replace("\\", "", $this->module).'.submit();}"><i class="icon-trash"></i> Supprimer</a></li>
			</ul>
		</div><!-- /btn-group -->';
		
		
		//display table header
		$widget .= '<br /><br />
		<form name="form'.str_replace("\\", "", $this->module).'" action="#" method="post">
		<table class="table"><thead>';
		
		//display name of the columns
		$widget .= '<tr><th></th>';
		foreach($this->columns as $column)
			$widget .= '<th>'.$column.'</th>';
		$widget .= '</tr></thead><tbody>';
		
		
		//display result
		foreach($this->data as $value)
		{
			$widget .= '<tr><td width="20px"><input type="checkbox" name="id[]" value="'.$value->id.'"/></td>';
			
			foreach($value as $key => $val)
			{
				//convert result when the type of the field is highlight, status or active
				if($key == "highlight" || $key == "status" || $key == "active")
					$widget .= '<td>'.convertCodes($val).'</td>';
				//set html link when the type of the field is name
				else if($key == "name")
					$widget .= '<td><a href="'.WEBSITE_ROOT.'/admin/'.encodeHtmlString($this->module).'/edit/'.$value->id.'">'.$val.'</a></td>';
				//don't show result when the type of field is id
				//else if($key == "id")
				//	{}
				else
					$widget .= '<td>'.$val.'</td>';
			}
			$widget .= '</tr>';
		}
		
		//display footer and hidden fields
		$widget .= '</tbody></table>
		<input type="hidden" name="formAction" id="formAction" value="" />
		<input type="hidden" name="formName" id="formName" value="form'.str_replace("\\", "", $this->module).'" />
		</form>';
		
		//return result
		return $widget;
	}
}
?>