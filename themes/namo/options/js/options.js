jQuery(document).ready(function(){
	var $global_url = jQuery('.field-url').val();
	
	toolTip();

	if(jQuery('#last_tab').val() == ''){

		jQuery('.nhp-opts-group-tab:first').slideDown('fast');
		jQuery('#nhp-opts-group-menu li:first').addClass('active');
	
	}else{
		
		tabid = jQuery('#last_tab').val();
		jQuery('#'+tabid+'_section_group').slideDown('fast');
		jQuery('#'+tabid+'_section_group_li').addClass('active');
		
	}
	
	jQuery('form#nhp-opts-form-wrapper').submit(function(event) {
		var trigger_value =  jQuery("input[type=submit][clicked=true]").attr('id');
		//alert(trigger_value);
		if(trigger_value == 'nhp-opts-import'){
		 	
		 	var imported_options = escape(jQuery('#import-code-value').val());
		 	var data = jQuery(this).serialize()+'&trigger=import';
		 	//console.log(data);
		}
		else if(trigger_value == "be_themes_opt_submit" ){
			var data = jQuery(this).serialize()+'&trigger=save';
		}else if(trigger_value == "be_themes_opt_reset"){
			var data = jQuery(this).serialize()+'&trigger=reset';
		}
		//alert(data);
		jQuery.post(ajaxurl, data, function(response) {
			//alert(response);
			if(response == 1) {
				jQuery.pnotify({title: 'Settings Saved.',  text: 'Theme Options Updated Successfully.',   type: 'success',   icon: true });
				jQuery('#nhp-opts-save').slideDown('slow').delay(50).slideUp('slow');
			}else if(response == 2){
				jQuery('#nhp-opts-field-reset').slideDown('fast');
				jQuery.pnotify({title: 'Settings Reset.',  text: 'Theme Options Reset Successfully.',   type: 'success',   icon: false });
				window.setTimeout('location.reload()', 50);
			}else {
				jQuery.pnotify({title: 'Unable to save changes.',  text: 'Theme Options Could Not Updated.',   type: 'error',   icon: false });
				jQuery('#nhp-opts-field-not-save').slideDown('slow').delay(50).slideUp('slow');
			}
		});
		return false;
	});
	
	jQuery("form input[type=submit]").click(function() {
	    jQuery("input[type=submit]", jQuery(this).parents("form")).removeAttr("clicked");
	    jQuery(this).attr("clicked", "true");
	});

	jQuery('input[name="'+nhp_opts.opt_name+'[defaults]"]').click(function(){
		if(!confirm(nhp_opts.reset_confirm)){
			return false;
		}
	});
	
	jQuery('.nhp-opts-group-tab-link-a').click(function(){
		relid = jQuery(this).attr('data-rel');
		
		jQuery('#last_tab').val(relid);
		
		jQuery('.nhp-opts-group-tab').each(function(){
			if(jQuery(this).attr('id') == relid+'_section_group'){
				jQuery(this).delay(200).fadeIn(200);
			}else{
				jQuery(this).fadeOut('fast');
			}
			
		});
		
		jQuery('.nhp-opts-group-tab-link-li').each(function() {
			if(jQuery(this).attr('id') != relid+'_section_group_li' && jQuery(this).hasClass('active')){
					jQuery(this).removeClass('active');
				}
				if(jQuery(this).attr('id') == relid+'_section_group_li'){
					jQuery(this).addClass('active');
				}
		});
	});
	
	
	
	
	if(jQuery('#nhp-opts-save').is(':visible')){
		jQuery('#nhp-opts-save').delay(4000).slideUp('slow');
	}
	
	if(jQuery('#nhp-opts-imported').is(':visible')){
		jQuery('#nhp-opts-imported').delay(4000).slideUp('slow');
	}	
	
	
	jQuery('#nhp-opts-import-code-button').click(function(){
		if(jQuery('#nhp-opts-import-link-wrapper').is(':visible')){
			jQuery('#nhp-opts-import-link-wrapper').fadeOut('fast');
			jQuery('#import-link-value').val('');
		}
		jQuery('#nhp-opts-import-code-wrapper').fadeIn('slow');
	});
	
	jQuery('#nhp-opts-import-link-button').click(function(){
		if(jQuery('#nhp-opts-import-code-wrapper').is(':visible')){
			jQuery('#nhp-opts-import-code-wrapper').fadeOut('fast');
			jQuery('#import-code-value').val('');
		}
		jQuery('#nhp-opts-import-link-wrapper').fadeIn('slow');
	});
	
	
	
	
	jQuery('#nhp-opts-export-code-copy').click(function(){
		if(jQuery('#nhp-opts-export-link-value').is(':visible')){jQuery('#nhp-opts-export-link-value').fadeOut('slow');}
		jQuery('#nhp-opts-export-code').toggle('fade');
	});
	
	jQuery('#nhp-opts-export-link').click(function(){
		if(jQuery('#nhp-opts-export-code').is(':visible')){jQuery('#nhp-opts-export-code').fadeOut('slow');}
		jQuery('#nhp-opts-export-link-value').toggle('fade');
	});

	jQuery('.tooltip').click(function(event){
		event.preventDefault();
		var img_link = jQuery(this).attr('href');
		var dialog_box = jQuery( "#be-themes-dialog" );
		jQuery(dialog_box.find('img').attr('src',img_link));
		dialog_box.dialog({ 
			modal: true ,  
			width: 500,
			height: 500,
			position: ['center','center'] ,
			draggable: false,
			resizable: false,
			buttons: { 
				"Close": function() 
				{ jQuery(this).dialog("close"); } 
			}
     	});
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

this.toolTip = function(){	
		
	xOffset = 10; // Tooltip distance from cursor
	yOffset = 20;		

	jQuery("a.tooltip").hover(function(e){											  
		
		jQuery("body").append("<p id='tooltip-popup'>Click For Explanation.</p>");
		jQuery("#tooltip-popup")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");		
    },
	function(){
		this.title = this.t;		
		jQuery("#tooltip-popup").remove();
    });	
	jQuery("a.tooltip").mousemove(function(e){
		jQuery("#tooltip-popup")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};

function get_random_color(){

  return '#' + Math.random().toString(16).substring(4);
}

function set_value(id,type,value){

	switch(type){
		case "hidden":
			jQuery("#"+id).val(value);
		break;

		case "colorpicker":
			var $colorpicker = jQuery("#"+id);
			var cssObj = {
		      'background-color' : value,
		      'color' : get_random_color()
		    }
			$colorpicker.val(value).css(cssObj);
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