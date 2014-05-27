<div class="tab-pane" id="forum">
	<div class="row">
		<div class="col-md-4">
			<div class="listview-outlook" data-role="listview">
				<?php 
				foreach($forums as $forum)
				{
					?>
					<a class="list list-summary" id="<?php echo $forum->id?>" style="cursor:pointer;">
							<div class="list-content">
								<span class="list-remark"><?php echo strtoupper($forum->title);?></span>
							</div>
						</a>
					<?php 				
				}?>
			</div>
		</div>
		<br />
		<?php 
		foreach($forums as $forum)
		{
			$i = 0;
			?>
							
			<div id="forums-<?php echo $forum->id ?>" class="col-md-7 col-md-offset-1" style="display:none;">
			<div class="listview-outlook" data-role="listview">	
			<?php 
			foreach($forumsanswers as $answer)
			{
				if($answer->answersforums == $forum->id)
				{
					if($i == 0)
					{
						$i++;
						?>			
	
						<div class="list">
							<div style="position : absolute;top:5px;right : 15px;z-index:999;font-size:13px;">
							<?php 
							if(isset($_SESSION['users']))
							{
								if($answer->users == $_SESSION['users']->id or $_SESSION['users']->level == 8)
								{
									?>
									
										<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->getId() ?>-<?php echo url($instances->getName());?>/forums/<?php echo $forum->id;?>/editAnswers/<?php echo $answer->answersid;?>"  alt="editer"><span class="glyphicon glyphicon-edit"></span></a>
										<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->getId() ?>-<?php echo url($instances->getName());?>/forums/<?php echo $forum->id;?>/deleteAnswers/<?php echo $answer->answersid;?>"  alt="supprimer"><span class="glyphicon glyphicon-trash"></span></a>
									<?php									 
								} 
								?>
								<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->getId() ?>-<?php echo url($instances->getName());?>/forums/<?php echo $forum->id;?>/addAnswers/<?php echo $answer->answersid;?>"  alt="repondre"><span class="glyphicon glyphicon-share-alt"></span></a>
								<?php
							}
							?>
							</div>
										
							<div class="list-content">
								<span class="list-title fg-blue" style="width:90%" title="<?php echo $answer->answerstitle; ?>"><?php echo $answer->answerstitle; ?><br /><i class="small">Par <?php echo $forum->usersname; ?> - Le <?php echo $forum->creationdate; ?></i></span>
								<span class="list-remark no-overflow no-padding;text-align : justify">
									<?php echo $answer->answersdescr; ?>
									<br /><br />
								</span>
							</div>	
						</div>	
						<h5>R&eacute;ponses...</h5>
						<?php
					}
					else
					{
						?>
						<div class="list">
							<div style="position : absolute;top:5px;right : 15px;z-index:999;font-size:13px;">
							<?php 
							if(isset($_SESSION['users']))
							{
								if($answer->users == $_SESSION['users']->id or $_SESSION['users']->level == 8)
								{
									?>
									
										<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->getId() ?>-<?php echo url($instances->getName());?>/forums/<?php echo $forum->id;?>/editAnswers/<?php echo $answer->answersid;?>"  alt="editer"><span class="glyphicon glyphicon-edit"></span></a>
										<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->getId() ?>-<?php echo url($instances->getName());?>/forums/<?php echo $forum->id;?>/deleteAnswers/<?php echo $answer->answersid;?>"  alt="supprimer"><span class="glyphicon glyphicon-trash"></span></a>
									<?php									 
								} 
								?>
								<a data-toggle="modal" data-target="#myModal" href="<?php echo WEBSITE_ROOT ."/". $categories->id ."-". url($categories->name)?>/instances/<?php echo $instances->getId() ?>-<?php echo url($instances->getName());?>/forums/<?php echo $forum->id;?>/addAnswers/<?php echo $answer->answersid;?>"  alt="repondre"><span class="glyphicon glyphicon-share-alt"></span></a>
								<?php
							}
							?>
							</div>
							<blockquote style="font-size : 13px;text-align : justify">
								<span class="list-title fg-blue" style="width:90%"><span class="glyphicon glyphicon-share-alt"></span> RE : <?php echo $answer->answerstitle; ?><br /><i class="small">Par <?php echo $answer->answersusersname; ?> - Le <?php echo $answer->creationdate; ?></i></span>
								<span class="list-remark"><?php echo $answer->answersdescr; ?></span>
							</blockquote>
						</div>
						<?php 
					}
				}
			}
			?>
			</div>
			</div>
			<?php
		}
		?>		
	</div>
</div>



		<script>
		$('#forums-<?php echo $forums[0]->id?>').show();

		$('.list-summary').click(function()
		{
			<?php 
			foreach($forums as $forum)
			{
				?>
				$('#forums-<?php echo $forum->id?>').hide();
				<?php 
			}?>

			forumId = $(this).attr('id');
			$('#forums-'+forumId).show();
		});
		</script>