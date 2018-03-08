jQuery(document).ready(function(){

	
	jQuery('.ie-pattern-show').on("click", function(event){
		jQuery(this).next('.pattern-collections').css('display','block');
		return false;
	});
	
	jQuery('.popup-colorpicker').each(function () {
		
		var color_picker = jQuery(this);
		var val = color_picker.val();
		var cssObj = {
		      'background-color' : '#000000',
		      'color' : '#000'
		    } 
		
	});
	
	jQuery('.be-img-select').on('change' , function(){
		
		var $pattern_selectbox = jQuery(this);
		var url = $pattern_selectbox.val();
		var $pattern_selectbox_id = $pattern_selectbox.attr('id');
		var $pattern_value = $pattern_selectbox.val();
		var id = $pattern_selectbox.parent('.ddOutOfVision').parent('.basic-option').siblings('.field-id').val();

		var $pattern_array = jQuery('#'+$pattern_selectbox_id+$pattern_value).val();
		
		jQuery('#'+id+'background').attr('value' , url);

		if($pattern_array != null){
			var $pattern_array_values = $pattern_array.split('/');
			var color = $pattern_array_values[0];
			var recur = $pattern_array_values[1];
			var attach = $pattern_array_values[2];
			var position = $pattern_array_values[3];
			var opacity = $pattern_array_values[4];
			var scheme = $pattern_array_values[5];
			
			if(color.length != 0){
				jQuery('#'+id).each(function(){
					jQuery(this).attr('value',color).css('background-color',color);
				});
			}
			
			if(recur.length != 0)
				assign_selectbox_value(id,recur,'recur');
						
			if(attach.length != 0)
				assign_selectbox_value(id,attach,'attach')
			
			if(position.length != 0)
				assign_selectbox_value(id,position,'position')
			
			
			if(opacity.length != 0){
				jQuery('#'+id+'slider').each(function(){
					$slider = jQuery(this);
					$slider.slider({
						animate: true,
						range: "max",
						min: 1,
						max: 100,
						value: opacity
						
					});

					assign_opacity($id , opacity);	
					
				});
			}
			
			if(scheme.length != 0){
				$radio_buttonset = $pattern_selectbox.parent().parent().siblings('.buttonset').children('.ui-helper-hidden-accessible');
				$label_buttonset = $pattern_selectbox.parent().parent().siblings('.buttonset').children('.ui-button-text-only');
				$label_buttonset.each(function(){
					$this = jQuery(this);
					if($this.hasClass('ui-state-active')){
						$this.removeClass('ui-state-active');
						$this.prev('radio').removeAttr('checked');
					}
					if($this.val() == scheme ){
						$this.attr('checked','checked');
						$this.next('.ui-button-text-only').addClass('ui-state-active');
					}
				});

			}
		}
		
	});

	
	jQuery('.bg-hide-below').each(function(event, ui){
		var id = jQuery(this).attr('id');
		hide_options(id);
	});
	
	
	jQuery('.bg-hide-below').on('click',function(event, ui){
		var id = event.target.id;
		hide_options(id);
	}); 
	
	jQuery( ".slider" ).bind( "slide", function(event, ui) {

 		$id = event.target.id;
 		assign_opacity($id , ui.value);	

	});

	jQuery( ".slider" ).bind( "slidechange", function(event, ui) {

 		$id = event.target.id;
 		assign_opacity($id , ui.value);		
		
	});

	
});

function assign_opacity(id , value){
	$slider = jQuery('#'+id);
	$opacity_txtbox = $slider.prev().children('.opacity');
	$opacity_value = $slider.prev().children('.opacity-value');
	$opacity_txtbox.val( value );
	$opacity_value.val( value );
}

function hide_options(id){
	
	$chkbox = jQuery('#'+id);
	var $basic = $chkbox.siblings('.basic-option');
	var $advance = $chkbox.siblings('.advance-option');
	var $field_id = $chkbox.siblings('.field-id').val();
	var $url = jQuery('#'+$field_id+'bgpattern').val();
	
	if($chkbox.is(':checked')){
		
		$basic.hide();
		$advance.show();
		if($url.length == 0)
			jQuery('#'+$field_id+'bgoptions').fadeOut('slow');	
	}
	else{
		
		$advance.hide();
		$basic.show();
		jQuery('#'+$field_id+'bgoptions:hidden').fadeIn('slow');		
	}

}

function assign_selectbox_value(id,value,element){
	selectbox = jQuery('#'+id+'-'+element);
	selectbox.children('option:selected').removeAttr('selected');
    selectbox.children('option[value="'+value+'"]').attr('selected','selected'); 
	selectbox.val(value);
}

