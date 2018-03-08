/*
 *
 *  Field Type Skin's Script
 *
 */

jQuery(document).ready(function(){

	var $global_url = jQuery('.field-url').val();
	var $current_skin = jQuery('.current-skin').val();

	// Call default skin on initial stage
	if($current_skin.length == 0){
		jQuery('.nhp-radio-img-beat-skin:first-child').addClass('nhp-radio-img-selected');
		call_json($global_url,'default','0','','');
	}


	jQuery('.skin-options').on('change', function(){

		var $skin = jQuery(this).val();

		jQuery('.swap-bg-hide-below').each(function(){
			
			var $checkbox = jQuery(this);
			if($checkbox.is(":checked")){
				$checkbox.attr('checked',false);
				var $basic = $checkbox.siblings('.basic-option');
				var $advance = $checkbox.siblings('.advance-option');
				$basic.css('display','block');
				$advance.css('display','none');

			}

		});
		
		call_json($global_url,$skin,'0');
		return false;

	});

	jQuery(".buttonset input").on("click",function(){

		var radio_btn = jQuery(this);
		var id = radio_btn.parent('.buttonset').siblings('.field-id').val();
		var value = radio_btn.val();
		call_json($global_url,'','1',id,value);
       
    });

   

});

function call_json($global_url,$skin,$option,id,value){
	switch($option){
		case "0":
			jQuery.getJSON($global_url+"/json_file/"+$skin+".json",function(data){	
				jQuery.each(data['skin'], function(i,data){
							
					set_value(data.ID,data.TYPE,data.VALUE);
						
				});
			});
			break;
		case '1':
			
			jQuery.getJSON($global_url+"/json_file/scheme.json",function(data)
			{
					jQuery.each(data[id], function(i,data){

							jQuery.each(data[value], function(i,data){

								set_value(data.ID,data.TYPE,data.VALUE);

							});
					
					});
			});
			break;
	}
	
}



function set_value(id,type,value){

	switch(type){
		case "colorpicker":
			var $colorpicker = jQuery("#"+id);
			$colorpicker.val(value);
			break;

		case "buttonset":
			$radio_buttonset = jQuery('.'+id).children('.ui-helper-hidden-accessible');
			$label_buttonset = jQuery('.'+id).children('.ui-button-text-only');
			$label_buttonset.each(function(){
				var $find_btn = jQuery(this) ;
				if($find_btn.hasClass('ui-state-active')){
					$find_btn.removeClass('ui-state-active');
					$find_btn.prev('radio').removeAttr('checked');
				}
			});

			$radio_buttonset.each(function(){
				var $find_btn = jQuery(this) ;
				if($find_btn.val() == value ){
					$find_btn.attr('checked', true);
					$find_btn.next('.ui-button-text-only').addClass('ui-state-active');
				}

			});
			break;

		case "selectbox":
			jQuery("#"+id).val(value);
			break;

		case "pattern-selector":
			pattern_selector = jQuery("#"+id);
			pattern_selector.val(value);
			pattern_selector.closest('.basic-option').siblings('.bgdefault').attr('value' , value);
			var oHandler = jQuery("#"+id).msDropDown({mainCSS:'dd'}).data("dd"); // Set value on image select box
			if (oHandler)
				oHandler.set("value", value);
			
			break;	

		case "slider":
			jQuery('#'+id).each(function(){
				$slider = jQuery(this);
				$slider.slider({
					animate: true,
					range: "max",
					step: 0.1,
					min: 0,
					max: 1,
					value: value
					
				});

			$opacity_txtbox = $slider.prev().children('.opacity');
			$opacity_value = $slider.prev().children('.opacity-value');
			$opacity_txtbox.val( value );
			$opacity_value.val( value );
			});
			break;

		case "checkbox":
			
			if(value == 1){
				if(!jQuery("#"+id).is(":checked")){
					jQuery("#"+id).attr("checked" , true);
					
				}
			}
			else{
				if(jQuery("#"+id).is(":checked")){
					jQuery("#"+id).attr("checked" , false);
					
				}	
			}
			jQuery(this).val(value);
			break;
		case "checkbox_hide_below":
			$hide_chkbox = jQuery("#"+id);
			if(value == 1){
				if(!$hide_chkbox.is(":checked")){
					$hide_chkbox.attr("checked" , true);
					$hide_chkbox.closest('tr').next('tr').show();
				}
			}
			else{
				if($hide_chkbox.is(":checked")){
					$hide_chkbox.attr("checked" , false);
					$hide_chkbox.closest('tr').next('tr').hide();
				}
			}
			break;


		case "radio_image":
			$radio_set = jQuery('.'+id).children('.nhp-radio-img');
			$radio_set.each(function(){
				$this = jQuery(this);
				if($this.hasClass('nhp-radio-img-selected')){
					$this.removeClass('nhp-radio-img-selected');
					$this.children('radio').removeAttr('checked');	
				}
				var $radio = $this.children('input[type="radio"]');
				var element_value = $radio.val();
				if(element_value == value)
					$this.addClass('nhp-radio-img-selected').children('img').trigger('click');
					//$radio.attr('checked','checked');
				
			});
			
			break;		
	}
}

function beat_radio_img_select(relid, labelclass){
	jQuery(this).prev('input[type="radio"]').prop('checked');

	jQuery('.nhp-radio-img-'+labelclass).removeClass('nhp-radio-img-selected');	
	
	jQuery('label[for="'+relid+'"]').addClass('nhp-radio-img-selected');
}//function