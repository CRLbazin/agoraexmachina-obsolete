<?phpnamespace library\webComponents;/*** progress web component* @author cyril bazin* @package cu.core*/class progress extends \library\field{	public function build()	{		$widget = '';				$widget .= '<input  class="form-control" style="float:left;margin-right:20px;width:50px;" type="text" name="'.$this->name.'"';				if (!empty($this->value))			$widget .= ' value="'.htmlspecialchars($this->value).'"';				if (!empty($this->maxLength))			$widget .= ' maxlength="'.$this->maxLength.'"';					if(!empty($this->readonly))			$widget .= ' readonly="'.$this->readonly.'"';				return $widget .= ' />		<div class="progress">		  <div class="progress-bar progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: '.$this->value.'%">		  		'.$this->value.' %		  </div>		</div>';	}}?>