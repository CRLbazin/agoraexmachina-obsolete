<?phpnamespace library\webComponents;/*** status web component* @author cyril bazin* @package cu.core*/class status extends \library\field{	private $selected100, $selected101, $selected102, $selected103 = ''; 		public function build()	{		switch($this->value)		{			case 100:				$this->selected100 = "selected=selected";				break;			case 101:				$this->selected101 = "selected=selected";				break;			case 102:				$this->selected102 = "selected=selected";				break;			case 103:				$this->selected103 = "selected=selected";				break;		}				$readonly = (!empty($this->readonly)) ? ' readonly="'.$this->readonly.'"' : null;						$widget = '';				$widget .= '				<select class="form-control" name="'.$this->name.'" '.$readonly.'>					<option value="100" '.$this->selected100.'>'.convertCodes(100).'</option>					<option value="101"' .$this->selected101.'>'.convertCodes(101).'</option>					<option value="102"' .$this->selected102.'>'.convertCodes(102).'</option>					<option value="103"' .$this->selected103.'>'.convertCodes(103).'</option>			';				if (!empty($this->value))			$widget .= ''.htmlspecialchars($this->value).'';						$widget .= " </select>";				return $widget;	}}?>