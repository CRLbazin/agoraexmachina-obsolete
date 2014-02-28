<h1>
	<?php if($instances[0]->image != "")
	{ ?>
		<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT."/img/".$instances[0]->image ?>"><img style="height:65px;" src="<?php echo WEBSITE_ROOT."/images/".$instances[0]->image ?>"  class="img-thumbnail " /> </a>
		<?php
	}
	else
	{?>
		<span class='glyphicon glyphicon-play-circle icon'></span>
	<?php
	}
	echo $instances[0]->name ?>
</h1>
<hr />
<div class="row">
	<div class="col-md-9">
		<!-- onglets -->
			<ul class="nav nav-tabs" id="myTab">
				<li class="active"><a href="#content" data-toggle="tab"><?php echo _TR_Content ?></a></li>
				<li><a href="#votes" data-toggle="tab"><span class="badge pull-right"><?php echo sizeof($votes)?></span><?php echo _TR_Votes ?>&nbsp;&nbsp;</a></li>
				<li><a href="#forum" data-toggle="tab"><span class="badge pull-right">8</span><?php echo _TR_Forum ?>&nbsp;&nbsp;</a></li>
			</ul>

			<div class="tab-content">
				<?php
					require("displayContent.inc.php");
					require("displayVotes.inc.php");
					require("displayForum.inc.php");
				?>
			</div>

	</div>
	
	<div class="col-md-2 col-md-offset-1">
		<div class="alert alert-info">
			<strong><?php echo _TR_Help ?></strong> <?php echo _TR_InstancesDisplayHelp ?>
		</div>
		<br />
		<?php
		if(isset($_SESSION['users']))
		{
			?>
			<?php
			if($instances[0]->users == $_SESSION['users']->id or $_SESSION['users']->level >= 8)
			{
				?>
				<a class="btn btn-default"  data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories[0]->id ."-". url($categories[0]->name)?>/instances/<?php echo $instances[0]->id ?>/edit"><?php echo _TR_EditInstance ?></a>
				<br /><br />
				<a class="btn btn-danger" href="<?php echo WEBSITE_ROOT ."/". $categories[0]->id ."-". url($categories[0]->name)?>/instances/<?php echo $instances[0]->id ?>/delete" onclick="confirm(\'Voulez vous vraiment supprimer ?\')"><?php echo _TR_DeleteInstance ?></a>
				<br />
				<?php
			} 
		} ?>
			<div id="votesActions" style="display:none;">
				<hr />
				<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories[0]->id ."-". url($categories[0]->name)?>/instances/<?php echo $instances[0]->id ?>-<?php echo url($instances[0]->name) ?>/votes/add" class="btn btn-primary"><?php echo _TR_AddVotes ?></a>
			</div>
			<div id="forumActions" style="display:none;">
				<hr />
				<a class="btn btn-primary ">Ajouter un sujet</a>
				<br /><br />
				<a class="btn btn-primary ">Ajouter une réponse</a>
			</div>
		</div>
</div>
