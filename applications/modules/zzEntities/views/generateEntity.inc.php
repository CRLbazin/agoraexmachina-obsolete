
	<div class="tab-pane active" id="entity">
	
	<?php
	if(isset($_SESSION['entity'][0]))
	{
		echo '<span style="color:green"><?php <br />
		/**<br />
		* file for the '.$_SESSION['entity'][0]['entityName'].' entity<br />
		* @author cyril bazin <crlbazin@gmail.com><br />
		* @package cu.XXX <br />
		* @copyright GNU GPL <br />
		* @filesource <br />
		*/</span> <br />
		<span style="color:blue">namespace</span> applications\modules\XXX\entities;<br />
		<br />
		<span style="color:green">/**<br />
		* '.$_SESSION['entity'][0]['entityName'].' entities<br />
		* @version 1.0<br />
		*/</span><br />
		<span style="color:blue">class</span> '.$_SESSION['entity'][0]['entityName'].'Entity <span style="color:blue">extends</span>  \library\baseEntity<br />
		{<br />
			<span style="color:blue">protected</span> ';
		
		foreach($_SESSION['entity'] as $key=>$value)
		{	
			echo '$'.$value['title'].',<br/>';
		}
		
		foreach($_SESSION['entity'] as $key=>$value)
		{
			echo '
			<span style="color:green">/**<br />
			* setter '.$value['name'].'<br />
			* @param '.$value['typeSQL'].' '.$value['name'].' of the entity<br/>
			*/</span><br/>
			<span style="color:blue">public function</span> set'.ucfirst($value['name']).'($'.$value['name'].')<br />
			{<br />
				$this->'.$value['name'].' = $'.$value['name'].';<br />
			}<br />
			<br />
			<span style="color:green">/**<br />
			* getter '.$value['name'].'<br />
			* @return '.$value['typeSQL'].' '.$value['name'].' of the entity<br/>
			*/</span><br/>
			<span style="color:blue">public function</span> get'.ucfirst($value['name']).'()<br />
			{<br />
				return $this->'.$value['name'].';<br />
			}<br />
			';		
		}
		
		echo "}";
	}
	else
	{
		echo '<span class="label label-warning">The entity doesn\'t exists</span>';
	}
	?>
	</div>
	