
	<div class="tab-pane" id="form">
	<?php
	if(isset($_SESSION['entity'][0]))
	{
		echo '<span style="color:green"><?php <br />
		/**<br />
		* file for the '.$_SESSION['entity'][0]['entityName'].' form<br />
		* @author cyril bazin <crlbazin@gmail.com><br />
		* @package cu.XXX <br />
		* @copyright GNU GPL <br />
		* @filesource <br />
		*/</span> <br />
		<span style="color:blue">namespace</span> applications\modules\XXX\\forms;<br />
		<br />
		<span style="color:green">/**<br />
		* '.$_SESSION['entity'][0]['entityName'].' form<br />
		* @version 1.0<br />
		*/</span><br />
		<span style="color:blue">class</span> '.$_SESSION['entity'][0]['entityName'].'Form <span style="color:blue">extends</span>  \library\baseFormBuilder<br />
		{<br />';
		
		echo '
			<span style="color:green">/**<br />
			* build '.$value['name'].' form<br />
			*/</span><br />
			<span style="color:blue">public function build()<br />
			{ </span><br />
			';
		
		foreach($_SESSION['entity'] as $key=>$value)
		{
		echo '
				$this->form->add(<span style="color:blue">new</span> \library\webComponents\\'.$value['typeWEB'].'(<br />
					<span style="color:blue">array</span>(
						"title" => "'.$value['title'].'", <br />
						"name" => "'.$value['name'].'", <br />
						"value" => $this->form->getEntity()->get'.ucfirst($value['name']).'(), <br />
					)));<br /><br />';
		}
		
		echo '}';
	}
	else
	{
		echo '<span class="label label-warning">The entity doesn\'t exists</span>';
	}
	?>
	</div>
	
	