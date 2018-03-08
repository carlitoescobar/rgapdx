jQuery(document).ready(function(){
	
	jQuery('.nhp-opts-checkbox-hide-below').each(function(){
		if(!jQuery(this).is(':checked')){
			jQuery(this).closest('div.settings-form-row').next('div.settings-form-row').hide();
		}
	});
	
	jQuery('.nhp-opts-checkbox-hide-below').click(function(){
		jQuery(this).closest('div.settings-form-row').next('div.settings-form-row').fadeToggle('slow');
	});
	
});