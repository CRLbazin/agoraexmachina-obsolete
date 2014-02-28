<h1><?php echo _TR_CategoriesList ?></h1>
<hr/>

<?php
foreach($categories as $category)
{
	?>
	<a href="./<?php echo $category->id ?>-<?php echo url($category->name) ?>/instances" class="shortcut shadow">
		<span class="glyphicon glyphicon-play-circle"></span>
			<?php echo ucfirst($category->name);?>
		<small class="bg-black fg-white"><?php echo $category->instancesCount ?></small>
	</a>
	<?php
}
?>

