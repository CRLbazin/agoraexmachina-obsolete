<h1>
	<?php 
	
	//logo 
	if($instances->image!= "")
	{ 
	    ?>
		<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT."/img/".$instances->image ?>"><img style="height:50px;" src="<?php echo WEBSITE_ROOT."/images/".$instances->image ?>"  class="img-thumbnail " /> </a>
		<?php
	}
	else
	{
	    ?>
		<span class='glyphicon glyphicon-play-circle icon'></span>
		<?php
	}
	
	//title
	echo $instances->name;

	?>
	
</h1>
<hr />
<div class="row">
	<div class="col-md-9">
		<!-- onglets -->
		<ul class="nav nav-tabs" id="myTab">
		    <?php 
		    if(date('Y-m-d') > $instances->deadline)
		    { ?>
		        <li><a href="#result" data-toggle="tab" class="fg-green"><span class="glyphicon glyphicon-ok"></span> L'instance est terminée ! Voir la synthèse</a></li>
		        <?php 
		    }?>
			<li class="active"><a href="#content" data-toggle="tab"><?php echo _TR_Content ?></a></li>
			<li><a href="#forum" data-toggle="tab"><span class="badge pull-right"><?php echo sizeof($forums)?></span><?php echo _TR_Forums ?>&nbsp;&nbsp;</a></li>
			<li><a href="#votes" data-toggle="tab"><span class="badge pull-right"><?php echo sizeof($votes)?></span><?php echo _TR_Proposals; ?>&nbsp;&nbsp;</a></li>
			<li><a href="#users" data-toggle="tab"><span class="badge pull-right"><?php echo sizeof($users)?></span><?php echo _TR_Users; ?>&nbsp;&nbsp;</a></li>
		</ul>

		<div class="tab-content">
			<?php
				require("displayContent.inc.php");
				require("displayVotes.inc.php");
				require("displayForums.inc.php");
				require("displayUsers.inc.php");
				require("displayResult.inc.php");
			?>
		</div>
	</div>
	
	<div class="col-md-3">
		
		<div class="alert alert-warning">
			<strong><?php echo _TR_Help ?></strong> <?php echo _TR_InstancesDisplayHelp ?>
		</div>
		
		<br />
		<?php
		//msg delegations		
		if(sizeof($delegationsInstances) > 0)
		    echo msgDelegations($delegationsInstances);
		
		?>
		
		
		<?php
		//***** actions buttons block ******
		//deadline
		if(date('Y-m-d') > $instances->deadline)
		{
		    echo '<div class="alert alert-success">
		        <span class="glyphicon glyphicon-ok"></span> '._TR_InstanceDeadlineOver.'
		   		</div><br />';
		}
		//not deadline
		elseif(isset($_SESSION['users']))
		{
			?>
			<h3><?php echo _TR_Actions ?></h3>
			<div id="contentActions">
			    <?php
    			
    			//delete and edit buttons
    			if($instances->users == $_SESSION['users']->id or $_SESSION['users']->level >= 8)
    			{
    				?>
    				<a class="btn btn-default"  data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->id ?>/edit"><span class="glyphicon glyphicon-edit"></span> <?php echo _TR_EditInstance ?></a>
    				<br /><br />
    				<a class="btn btn-danger" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->id ?>/delete" onclick="confirm(\'Voulez vous vraiment supprimer ?\')"><span class="glyphicon glyphicon-trash"></span> <?php echo _TR_DeleteInstance ?></a>
    				<br /><br />
    				<?php 
    			}
				
				//delete delegation button
				if(isset($_SESSION['delegations']['instances']))
				{
				    ?>
					<div class="btn-group">
						<span class="btn btn-mauve cursor-pointer">
					  		<span class='glyphicon glyphicon glyphicon-user'></span>
					  		<?php echo _TR_DelegationGivenTo."<br />".$_SESSION['delegations']['instances']->users2Name; ?>
						</span>
						<button type="button" class="btn btn-mauve dropdown-toggle" data-toggle="dropdown" >
					    	<span class="caret"></span>
					    	<span class="sr-only">Toggle Dropdown</span>
					    </button>
					    <ul class="dropdown-menu" role="menu">
    					    <li>
    					        <a data-toggle="modal" data-target="#myModal"  id="addInstanceButton" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->id ?>/deleteDelegation">
    					            <span class='glyphicon glyphicon-remove'></span>
    					            <?php echo _TR_DeleteDelegation; ?>
    					        </a>
    					    </li>
					    </ul>
					 </div>
					 <?php 
				}
				//add delegation button
				else
				{
					?>
					<a class="btn btn-mauve"  data-toggle="modal" data-target="#myModal"  id="addInstanceButton" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->id ?>/addDelegation">
						<span class='glyphicon glyphicon glyphicon-user'></span>
						<?php echo _TR_AddDelegation ?>
					</a>
					<?php 
				}
				?>
			</div>
			 
            <!--  votes action tab -->
            <div id="votesActions" style="display:none;">
                <?php 
                if($instances->whoCanWriteVote == "allUsers" or $instances->userCanWriteVote == 1 or $instances->users == $_SESSION['users']->id or $_SESSION['users']->level >= 8)
                {
                    ?><a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->id ?>-<?php echo url($instances->name)	 ?>/votes/add" class="btn btn-primary"><span class="glyphicon glyphicon glyphicon-envelope"></span> <?php echo _TR_AddVotes ?></a><?php 
                }
                else
                	echo _TR_NoAction;
                ?>
            </div>
                
            
            <!--  forums action tab -->
            <div id="forumActions" style="display:none;">
            	<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->id ?>-<?php echo url($instances->name)	 ?>/forums/add" class="btn btn-primary "><span class="glyphicon glyphicon-share-alt"></span> <?php echo _TR_AddForum ?></a>
            </div>
            
            <!--  users action tab -->
            <div id="usersActions" style="display:none;">
            	<?php
           		if(($instances->users == $_SESSION['users']->id or $_SESSION['users']->level >= 8) and ($instances->whoCanSeeTheInstance == "guests" or $instances->whoCanVote == "guests" or $instances->whoCanWriteVote == "guests"))
            	{
            		?>
            		<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->id ?>-<?php echo url($instances->name)	 ?>/users/add" class="btn btn-primary "><span class="glyphicon glyphicon-user"></span> <?php echo _TR_AddUsers ?></a>
            		<?php 
            	}
            	else
            		echo _TR_NoAction;
            	?>
            </div>
            <br />
			<?php
		} 
		else
		{
			echo msgAlert(_TR_MustBeConnectedForInstanceAction);
		}
		?>
			
		
	</div>
</div>
