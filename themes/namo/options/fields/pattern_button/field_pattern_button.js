jQuery(document).ready(function(){
	jQuery('.pattern_button').click(function(){
		var id = jQuery(this).attr('id');
		jQuery( "#"+id+"dialog" ).dialog({ 
			modal: true ,  
			width: 360 , 
			position: ['center','center'] ,
			height: 500,
			draggable: false,
			resizable: false,
			buttons: { 
				"Ok": function() 
				{ jQuery(this).dialog("close"); } 
			}
     	});
	});
});