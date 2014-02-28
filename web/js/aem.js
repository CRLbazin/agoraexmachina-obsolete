$(document).ready(function()
{
	//init tinyMCE 
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		editor_selector : "tinymce",
		width: "840",
		height: "500",
	});
	
	
	//init datePicker
	 $(function() {
		$( ".datepicker" ).datepicker();
	});
	
	
	//active bootstrap tab
	$('#myTab a').click(function (e) 
	{
		e.preventDefault();
		$(this).tab('show');
    })
	
	
	//show buttons with tabs
	$('#myTab a').on('shown.bs.tab', function (e) {		
		$(e.relatedTarget .hash+"Actions").hide();
		$(e.target.hash+"Actions").show();
	})
	
	
	
	$('#myModal').on('hidden.bs.modal', function () {
		$(this).removeData('bs.modal');
	});
	
});
