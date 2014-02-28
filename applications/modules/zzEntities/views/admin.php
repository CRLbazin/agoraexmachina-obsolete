<?php echo msgAlert(_TR_TechnicalAlert); ?>
<h5>Create a new entity</h5>
<hr />
<form name="form" action="#" method="post">
	<h6>Name of the entity :</h6> <br /><input type="text" name="entityName" value="<?php if(isset($_SESSION['entity'][0]['entityName'])){echo $_SESSION['entity'][0]['entityName'];}?>" />
	<br /><br />
	<table class="table">
	<tr>
		<th></th>
		<th>Id</th>
		<th>Name</th>
		<th>Title</th>
		<th>TypeSQL</th>
		<th>TypeWEB</th>
		<th>MaxLength</th>
		<th>Readonly</th>
		<th>Value</th>
		<th>Data</th>
		<th>Module</th>
		<th>Class</th>
	</tr>
	<?php
	if(isset($_SESSION['entity']))
	foreach($_SESSION['entity'] as $key=>$value)
	{	?>
		<tr>
			<td><a href="#" onclick="if(confirm('Voulez vous vraiment supprimer ?')){$('#deleteAction').val('del<?php echo $key;?>');window.document.form.submit();}"><i class="icon-trash"></i></a>
			<td><?php echo $key?></td>
			<td><?php echo $value['name']?></td>
			<td><?php echo $value['title']?></td>
			<td><?php echo $value['typeSQL']?></td>
			<td><?php echo $value['typeWEB']?></td>
			<td><?php echo $value['maxlength']?></td>
			<td><?php echo $value['readonly']?></td>
			<td><?php echo $value['value']?></td>
			<td><?php echo $value['data']?></td>
			<td><?php echo $value['module']?></td>
			<td><?php echo $value['class']?></td>
		</tr>
		<?php
	}
			
	?>
	</table>
	<br /><br />
	<table class="table">
	<tr>
		<td colspan="2"><h6>Add a column</h6>
	</tr>	
	<tr>
		<td>Name*</td>
		<td><input type="text" name="name" value="" /></td>
	</tr>
	<tr>
		<td>Title*</td>
		<td><input type="text" name="title" value="" /></td>
	</tr>
	<tr>
		<td>TypeSQL*</td>
		<td><input type="text" name="typeSQL" value="" /></td>
	</tr>
	<tr>
		<td>TypeWEB*</td>
		<td><input type="text" name="typeWEB" value="" /></td>
	</tr>
	<tr>
		<td>MaxLength</td>
		<td><input type="text" name="maxlength" value="" /></td>
	</tr>
	<tr>
		<td>Readonly</td>
		<td><input type="text" name="readonly" value="" /></td>
	</tr>
	<tr>
		<td>Value</td>
		<td><input type="text" name="value" value="" /></td>
	</tr>
	<tr>
		<td>Data</td>
		<td><input type="text" name="data" value="" /></td>
	</tr>
	<tr>
		<td>Module</td>
		<td><input type="text" name="module" value="" /></td>
	</tr>
	<tr>
		<td>Class</td>
		<td><input type="text" name="class" value="" /></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" value="Add column" name="addColumn" class="btn"/></td>
	</tr>
	</table>
<input type="hidden" name="deleteAction" id="deleteAction" value="" />
<input type="submit" name="validEntity" value="Generate entity" class="btn"/>
<input type="submit" name="resetEntity" value="Reset entity" class="btn"/>
</form>
<br /><br /><br /><br />
<!-- onglets -->
<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#entity" data-toggle="tab">Entities</a></li>
	<li><a href="#form" data-toggle="tab">Forms</a></li>
	<li><a href="#manager" data-toggle="tab">Managers</a></li>
</ul>

<div class="tab-content">
<?php
if(isset($generateEntity))
{
	require("generateEntity.inc.php");
	require("generateForm.inc.php");
	require("generateManager.inc.php");
}
else
	echo "You must generate the entity...";
?>
</div>
