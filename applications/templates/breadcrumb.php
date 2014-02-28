<div class="breadcrumb bg-transparent">
	<a style="cursor:pointer;" onClick="window.history.go(-1)"><span class="glyphicon glyphicon-chevron-left"></span></a>
	<?php
	if(isset($breadcrumb))
	{
		$cptLink = 1;
		
		foreach($breadcrumb as $route)
		{
			$res = $route->getUrl();
			
			if(sizeof($breadcrumb) == $cptLink )
				echo ucfirst($route->getName())." ";
			else
			{
				echo "<a href='".$route->getUrl()."'>".ucfirst($route->getName())."</a><span class='divider'> \ </span>";		
			}
			$cptLink++;
		}
		echo "</ul>";
	}	
	?>
</div>