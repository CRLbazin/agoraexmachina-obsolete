<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo WEBSITE_TITLE ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<link rel="stylesheet" href="<?php echo WEBSITE_ROOT ?>/css/bootstrap.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php echo WEBSITE_ROOT ?>/css/bootstrap.cu.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php echo WEBSITE_ROOT ?>/css/jquery-ui.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php echo WEBSITE_ROOT ?>/css/aem.css" type="text/css" media="all" />
	
</head>
<body>
	<?php
	require "header.php";		
	require "modal.php";
	require "menu.php";
	?>

	<div class="container">        
		<?php require "breadcrumb.php"; ?>
		<?php
			if(isset($msgError))
				echo msgError($msgError);
			if(isset($msgSuccess))
				echo msgSuccess($msgSuccess);
			if(isset($content))
				echo $content;
		?>
	
		
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	<?php
	require "footer.php";	
	?>
	</div>
	
	
	
	<!-- Placed at the end of the document so the pages load faster -->
	<script type="text/javascript" src="<?php echo WEBSITE_ROOT ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo WEBSITE_ROOT ?>/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo WEBSITE_ROOT ?>/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo WEBSITE_ROOT ?>/js/aem.js"></script>
</body>
</html>