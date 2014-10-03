<?php if(!isset($msgSuccess) && !isset($msgError))
{
	?>
	<form action="#" method="post" name="form">
		<?php 
		//user have delegations and delegationType is procuration
		if(sizeof($_SESSION['delegations']['receiveForInstances']) > 0 && $instances->typeOfDelegation == "procuration")
		{
			?>
			<h1><?php echo _TR_ChooseADelegation;?></h1>
			<center>
			<select name="userDelegationVote[]" class="selectpicker" multiple>
				<option value="<?php echo $_SESSION['users']->id;?>"><?php echo _TR_You ?></option>
				<?php 
				foreach($_SESSION['delegations']['receiveForInstances'] as $delegation)
				{
					echo "<option value='".$delegation->users1."'>".$delegation->users1Name."</option>";
				}
				?>
			</select>
			</center>
			<?php 
		}
		else if(sizeof($_SESSION['delegations']['receiveForInstances']) > 0 && $instances->typeOfDelegation != "procuration")
		{
		    //user have delegatiosn and delegationType is delegation
		    ?>
		    <h1><?php echo _TR_VoteConfirmForAll;?></h1>
			<center>
			<select name="userDelegationVote[]" class="selectpicker" multiple readonly="readonly">
				<option selected=selected  style="display:none;" value="<?php echo $_SESSION['users']->id;?>"><?php echo _TR_You ?></option>
				<?php 
				foreach($_SESSION['delegations']['receiveForInstances'] as $delegation)
				{
					echo "<option selected=selected style='display:none;' value='".$delegation->users1."'>".$delegation->users1Name."</option>";
				}
				?>
			</select>
			</center>
		    <?php 
		    
		}
		else if (sizeof($_SESSION['delegations']['receiveForInstances']) == 0)
		{
		    //user don't have delegations
			?>
			<h1><?php echo _TR_VoteConfirm;?></h1>
			<input type="hidden" name="userDelegationVote" value="<?php echo $_SESSION['users']->id;?>" />
			<?php 
		}		
		?>
		<br /><br />
		<input type="submit" name="submit" class="btn btn-primary"/>
		<br /><br /><br />
	</form>
	
	
	
	<script>

	
	$('form').submit(function(e)
	{
		e.preventDefault();
		tinyMCE.triggerSave();
	
		
		$.ajax({
	        url: "<?php echo $_SERVER["REQUEST_URI"];?>",
	        type: "POST",
	        data: $('form').serialize(),
	
	        success: function(data){
	        	$('.modal-content').html(data);
	        }
	    });
	});
	</script>
	<?php 
}?>