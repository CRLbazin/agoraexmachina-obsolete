<div class="tab-pane" id="votes">
<br />
<?php
if(sizeof($votes) >= 1)
{
	foreach($votes as $vote)
	{
		?>
		<div class="listview-outlook" data-role="listview">
			<div class="list" href="#">
				<div class="list-content">
					<div class="row">
						<div class="col-md-3">
								 <a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->getId() ?>-<?php echo url($instances->getName())?>/votes/<?php echo $vote->id?>/voteFor">
								 <div class="tile shalf ribbed-green fg-white"><?php echo $vote->voteFor;?>
									<?php 
									if($vote->voteUser == 1)
									{
										?>
										<div class="brand">
											<div class="badge newMessage">&nbsp;</div>
										</div>
										<?php 
									}
									?>
								</div>
								</a>
								<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->getId() ?>-<?php echo url($instances->getName())?>/votes/<?php echo $vote->id?>/voteAgainst">
								<div class="tile shalf ribbed-red fg-white"><?php echo $vote->voteAgainst;?>
									<?php 
									if($vote->voteUser == -1)
									{
										?>
										<div class="brand">
											<div class="badge newMessage">&nbsp;</div>
										</div>
										<?php 
									}
									?>
								</div>
								</a>
								<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->getId() ?>-<?php echo url($instances->getName())?>/votes/<?php echo $vote->id?>/voteWhite">
								<div class="tile shalf ribbed-grayLight fg-white"><?php echo $vote->voteWhite;?>
									<?php 
									if($vote->voteUser == '0')
									{
										?>
										<div class="brand">
											<div class="badge newMessage">&nbsp;</div>
										</div>
										<?php 
									}
									?>
								</div>
								</a>
						</div>
						<div class="col-md-9">
							<?php 
							if(isset($_SESSION['users']))
								if($vote->users == $_SESSION['users']->id or $_SESSION['users']->level == 8)
								{
									?>
									<div style="position : absolute;right : 10px;font-size:13px;">
										<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->getId() ?>/votes/<?php echo $vote->id ?>/edit"><span class="glyphicon glyphicon-edit"></span></a>
										<a href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->getId() ?>/votes/<?php echo $vote->id ?>/delete"><span class="glyphicon glyphicon-trash"></span></a>
									</div>
									<?php 
								}
							?>
							<span class="list-title fg-blue"><?php echo ucfirst($vote->name); ?></span>
							<span class="list-remark no-overflow"><?php echo ucfirst($vote->descr); ?></span>
								
						</div>
					</div>	
				</div>
			</div> 		                                 
		</div>
		<?php
	}
}
else
	echo _TR_NoData;
?>
</div>