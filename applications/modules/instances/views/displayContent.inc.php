<div class="tab-pane active" id="content" style="text-align : justify">
	<br />
	<?php
	echo $instances->descr;
	?>
	<hr />
	
	<div class="tile double bg-grayLighter no-cursor">
	    <div style="float : left;margin : 0px 10px 10px 0px;font-size:28px;"><span class="glyphicon glyphicon-time"></span></div>
	    <?php echo "<h5>"._TR_Deadline .'</h5>'.$instances->deadline;?> 
	</div>
	<div class="tile triple bg-grayLighter no-cursor">
	    <div style="float : left;margin : 0px 10px 10px 0px;font-size:28px;"><span class="glyphicon glyphicon-envelope"></span></div>
	    <?php echo "<h5>"._TR_WhoCanVote .'</h5>'.convertCodes($instances->whoCanVote);?>
	</div>
	<div class="tile double bg-grayLighter no-cursor">
	    <div style="float : left;margin : 0px 10px 10px 0px;font-size:28px;"><span class="glyphicon glyphicon-eye-open"></span></div>
	    <?php echo "<h5>"._TR_WhoCanSeeTheInstance .'</h5>'.convertCodes($instances->whoCanSeeTheInstance);?>
	</div>
	<div class="tile triple bg-grayLighter no-cursor">
	    <div style="float : left;margin : 0px 10px 10px 0px;font-size:28px;"><span class="glyphicon glyphicon-pencil"></span></div>
	    <?php echo "<h5>"._TR_WhoCanWriteVote .'</h5>'.convertCodes($instances->whoCanWriteVote);?>
	</div>
</div>