<h1>
	<?php 
	
	if($instances->getImage() != "")
	{ ?>
		<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT."/img/".$instances->getImage() ?>"><img style="height:65px;" src="<?php echo WEBSITE_ROOT."/images/".$instances->getImage() ?>"  class="img-thumbnail " /> </a>
		<?php
	}
	else
	{?>
		<span class='glyphicon glyphicon-play-circle icon'></span>
	<?php
	}
	echo $instances->getName() ?>
</h1>
<hr />
<div class="row">
	<div class="col-md-9">
		<!-- onglets -->
			<ul class="nav nav-tabs" id="myTab">
				<li class="active"><a href="#content" data-toggle="tab"><?php echo _TR_Content ?></a></li>
				<li><a href="#votes" data-toggle="tab"><span class="badge pull-right"><?php echo sizeof($votes)?></span><?php echo "Propositions"; ?>&nbsp;&nbsp;</a></li>
				<li><a href="#forum" data-toggle="tab"><span class="badge pull-right"><?php echo sizeof($forums)?></span><?php echo _TR_Forum ?>&nbsp;&nbsp;</a></li>
			</ul>

			<div class="tab-content">
				<?php
					require("displayContent.inc.php");
					require("displayVotes.inc.php");
					require("displayForums.inc.php");
				?>
			</div>

	</div>
	
	<div class="col-md-3">
		
		<div class="alert alert-warning">
			<strong><?php echo _TR_Help ?></strong> <?php echo _TR_InstancesDisplayHelp ?>
		</div>
		<br />
		
		<?php
		if(isset($_SESSION['users']))
		{
			?>
			<h3><?php echo _TR_Actions ?></h3>
			<?php
			if($instances->getUsers() == $_SESSION['users']->id or $_SESSION['users']->level >= 8)
			{
				?>
				<div id="contentActions">
				<a class="btn btn-default"  data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->getId() ?>/edit"><span class="glyphicon glyphicon-edit"></span> <?php echo _TR_EditInstance ?></a>
				<br /><br />
				<a class="btn btn-danger" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->getId() ?>/delete" onclick="confirm(\'Voulez vous vraiment supprimer ?\')"><span class="glyphicon glyphicon-trash"></span> <?php echo _TR_DeleteInstance ?></a>
				<br />
				</div>
				<?php
			} 
			?>
			<div id="votesActions" style="display:none;">
				<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->getId() ?>-<?php echo url($instances->getName())	 ?>/votes/add" class="btn btn-primary"><span class="glyphicon glyphicon glyphicon-plus"></span> <?php echo _TR_AddVotes ?></a>
			</div>
			
			<div id="forumActions" style="display:none;">
				<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->getId() ?>-<?php echo url($instances->getName())	 ?>/forums/add" class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span> Ajouter un sujet</a>
			</div>
			<?php 
		}
		else
		{
			echo msgAlert(_TR_MustBeConnectedForInstanceAction);
		}
		?>
	</div>
</div>
