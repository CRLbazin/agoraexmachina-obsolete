<h1><?php echo _TR_EditInstance ?></h1>
<hr />
<?php
if(isset($form))
	echo $form;
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