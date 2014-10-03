<div class="tab-pane" id="users">
<table class="table">
<thead>
<tr>
	<th style="width:20px;"></th>
	<th style="width:20px;"></th>
	<th style="width:20px;"></th>
	<th style="width : 80%;"><?php echo _TR_Name?></th>
	<th><?php echo _TR_Edit;?></th>
	<th><?php echo _TR_Delete ?></th>
</tr>
</thead>
<tbody>
<!--  all users -->
<tr>
	<td><?php if($instances->whoCanSeeTheInstance== "allUsers"){echo "<span class='glyphicon glyphicon-eye-open' title='"._TR_CanSeeTheInstance."'></span>";}else{echo "<span class='glyphicon glyphicon-eye-close' title='"._TR_CantSeeTheInstance."'></span>";}?></td>
	<td><?php if($instances->whoCanVote== "allUsers"){echo "<span class='glyphicon glyphicon-envelope' title='"._TR_CanVote."'></span>";}else{echo "<span class='glyphicon glyphicon-envelope fg-grayLighter' title='"._TR_CantVote."'></span>";}?></td>
    <td><?php if($instances->whoCanWriteVote== "allUsers"){echo "<span class='glyphicon glyphicon-pencil' title='"._TR_CanWriteVote."'></span>";}else{echo "<span class='glyphicon glyphicon-pencil fg-grayLighter' title='"._TR_CantWriteVote."'></span>";}?></td>
    <td><?php echo _TR_AllUsers;?></td>
    <?php
    if(isset($_SESSION['users']) && $_SESSION['users']->id == $instances->users || $_SESSION['users']->level == 8)
    {
    	?>
    	<td><a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->id ?>/edit"><span class="glyphicon glyphicon-edit"></span></a></td>
    	<td></td>
    	<?php 
    }?>
</tr>
<?php foreach($users as $user)
{
	?>
	<tr>
		<td><?php if($user->whoCanSeeTheInstance== "1"){echo "<span class='glyphicon glyphicon-eye-open' title='"._TR_CanSeeTheInstance."'></span>";}else{echo "<span class='glyphicon glyphicon-eye-close' title='"._TR_CantSeeTheInstance."'></span>";}?></td>
		<td><?php if($user->whoCanVote== "1"){echo "<span class='glyphicon glyphicon-envelope' title='"._TR_CanVote."'></span>";}else{echo "<span class='glyphicon glyphicon-envelope fg-grayLighter' title='"._TR_CantVote."'></span>";}?></td>
	    <td><?php if($user->whoCanWriteVote== "1"){echo "<span class='glyphicon glyphicon-pencil' title='"._TR_CanWriteVote."'></span>";}else{echo "<span class='glyphicon glyphicon-pencil fg-grayLighter' title='"._TR_CantWriteVote."'></span>";}?></td>
	    <td><?php echo $user->name;?></td>
	    <?php
	    if(isset($_SESSION['users']) && $_SESSION['users']->id == $instances->users || $_SESSION['users']->level == 8)
	    {
	    	?>
	    	<td><a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->id ?>/users/<?php echo $user->id ;?>/edit"><span class="glyphicon glyphicon-edit"></span></a></td>
	    	<td><a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->id ?>/users/<?php echo $user->id ;?>/delete"><span class="glyphicon glyphicon-remove"></span></a></td>
	    	<?php 
	    }?>
    </tr>
	<?php 
	
}?>
</tbody>
</table>
</div>