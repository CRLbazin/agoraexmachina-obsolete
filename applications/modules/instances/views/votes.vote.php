<?php if(!isset($msgSuccess) && !isset($msgError))
{
	?>
	<form action="#" method="post" name="form">
		<?php 
		if($_SESSION['delegations']['receiveForInstances'] != "")
		{
			?>
			<h1><?php echo _TR_ChooseADelegation;?></h1>
			<select name="userDelegationVote" class="form-control">
				<option value="<?php echo $_SESSION['users']->id;?>"><?php echo _TR_You ?></option>
				<?php 
				foreach($_SESSION['delegations']['receiveForInstances'] as $delegation)
				{
					echo "<option value='".$delegation->users1."'>".$delegation->users1Name."</option>";
				}
				?>
			</select>
			<?php 
		}
		else
		{
			?>
			<h1><?php echo _TR_VoteConfirm;?></h1>
			<input type="hidden" name="userDelegationVote" value="<?php echo $_SESSION['users']->id;?>" />
			<?php 
		}?>
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