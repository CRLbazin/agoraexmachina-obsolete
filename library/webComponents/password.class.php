<?phpnamespace library\webComponents;/*** password web component* @author cyril bazin* @package cu.core*/class password extends \library\field{	public function build()	{		$widget = '';				$widget .= '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>';				$widget .= '<input class="form-control" placeholder="'._TR_Password.'" type="password" name="'.$this->name.'"';						if(!empty($this->required))			$widget .= 'required ';				if (!empty($this->value))			$widget .= ' value="'.htmlspecialchars($this->value).'"';				return $widget .= ' /></div>';	}}?>