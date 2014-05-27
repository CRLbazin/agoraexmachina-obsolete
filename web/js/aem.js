$(document).ready(function()
{
	//init tinyMCE 
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		editor_selector : "tinymce",
		width: "700",
		height: "250",
	});
	
	
	//init datePicker
	 $(function() {
		$( ".datepicker" ).datepicker();
	});
	
	
	//active bootstrap tab
	$('#myTab a').click(function (e) 
	{
		e.preventDefault();
		  window.location.hash = $(this).attr('href');
		$(this).tab('show');
    })
    
	
	
	//show buttons with tabs
	$('#myTab a').on('shown.bs.tab', function (e) {		
		$(e.relatedTarget .hash+"Actions").hide();
		$(e.target.hash+"Actions").show();
	})
	
	
	
	$('#myModal').on('hidden.bs.modal', function () {
		$(this).removeData('bs.modal');
		window.location.reload(true);
	});
	
	
	if(window.location.hash){
		   $('#myTab').find('a[href="'+window.location.hash+'"]').tab('show');
		}
	
	
	
});
