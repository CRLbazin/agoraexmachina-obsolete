<?php 
if(!isset($msgSuccess))
{
	echo "<h1>". _TR_AddDelegation."</h1>
	<hr />";
	
	if(isset($form) && !isset($msgSuccess))
		echo $form;
}
?>

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