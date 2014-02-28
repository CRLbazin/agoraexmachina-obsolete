	<div class="tab-pane" id="manager">
	<?php
	if(isset($_SESSION['entity'][0]))
	{
		echo '<span style="color:green"><?php <br />
		/**<br />
		* file for the '.$_SESSION['entity'][0]['entityName'].' manager<br />
		* @author cyril bazin <crlbazin@gmail.com><br />
		* @package cu.XXX <br />
		* @copyright GNU GPL <br />
		* @filesource <br />
		*/</span> <br />
		<span style="color:blue">namespace</span> applications\modules\XXX\\managers;<br />
		<span style="color:blue">use</span>  applications\modules\XXX\\entities;<br />
		<br />
		<span style="color:green">/**<br />
		* '.$_SESSION['entity'][0]['entityName'].' manager<br />
		* @version 1.0<br />
		*/</span><br />
		<span style="color:blue">class</span> '.$_SESSION['entity'][0]['entityName'].'Manager <span style="color:blue">extends</span>  \library\baseManager<br />
		{<br />
			<span style="color:blue">public function __construct()</span><br />
			{<br />
				<span style="color:green">//run baseManager constructor</span><br />
				parent::__construct();<br />
				<span style="color:green">//define name of the module</span><br />
				$this->module = \''.$_SESSION['entity'][0]['entityName'].'\' ;<br />
			}<br />
			<br />
			<span style="color:green">
			/**<br />
			* add or update a '.$_SESSION['entity'][0]['entityName'].'<br />
			* @param entity '.$_SESSION['entity'][0]['entityName'].'<br />
			*/</span><br />
			<span style="color:blue">public function</span> save(\applications\modules\\'.$_SESSION['entity'][0]['entityName'].'\entities\\'.$_SESSION['entity'][0]['entityName'].'Entity $'.$_SESSION['entity'][0]['entityName'].' )<br />
			{<br />
				<span style="color:blue">if</span>($'.$_SESSION['entity'][0]['entityName'].'->getId() == "")<br />
					$sql = "INSERT INTO '.$_SESSION['entity'][0]['entityName'].'";<br/>
				<span style="color:blue">else</span><br />
					$sql = "UPDATE '.$_SESSION['entity'][0]['entityName'].'";<br/>
				<br />
				$sql .= "<br />
					SET<br />';
		
		foreach($_SESSION['entity'] as $key=>$value)
		{
			if($value['name'] != "id")
			{
				echo $value['name'].' = :'.$value['name'].',<br />';
			}
		}
		
		echo '<span style="color:blue">if</span>($'.$_SESSION['entity'][0]['entityName'].'->getId() != "")<br />
			$sql .= " WHERE id = :id ";<br />
		<br />
		$req = $this->db->prepare($sql);<br />
		<br />
		<span style="color:blue">if</span>($'.$_SESSION['entity'][0]['entityName'].'->getId() != "")<br />
			$req->bindValue(":id", $'.$_SESSION['entity'][0]['entityName'].'->getId());<br />
		<br />
		<br />
		';
		
		foreach($_SESSION['entity'] as $key=>$value)
		{
			if($value['name'] != "id")
			{
				echo '$req->bindValue(":'.$value['name'].'", $'.$_SESSION['entity'][0]['entityName'].'->get'.ucfirst($value['name']).'());<br />';
			}
		}
		
		echo '<span style="color:blue">if</span>(!$req->execute())<br />
			<span style="color:blue">echo</span> $req->errorInfo()[2];<br />
		<span style="color:blue">else</span><br />
			<span style="color:blue">return true ;</span><br />
		}<br/>}';
		
		
	}
	else
	{
		echo '<span class="label label-warning">The entity doesn\'t exists</span>';
	}
	?>
	</div>
	
	