<div class="tab-pane" id="votes">
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
						<div class="col-md-2">
								 <div class="tile shalf ribbed-green fg-white">12
									<div class="brand">
										<div class="badge newMessage">&nbsp;</div>
									</div>
								</div>
								<div class="tile shalf ribbed-red fg-white">15</div>
								<div class="tile shalf ribbed-grayLight fg-white">7</div>
						</div>
						<div class="col-md-10">
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