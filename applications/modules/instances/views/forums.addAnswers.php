<?php 
if(!isset($msgSuccess) && isset($form))
{
	echo "<h2>Ajouter une r&eacute;ponse</h2>";
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