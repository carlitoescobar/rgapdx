jQuery(document).ready(function(){
	
	$preset_heading = jQuery('.preset-heading');
	$preset_heading.on('click',function(){
		$this = jQuery(this);
		$font = $this.siblings('.select-wrapper:first').find('select').val();
		$actual_value = $this.attr('id');
		$this.closest('.settings-form-wrapper').find('.settings-form-row').each(function(){
			$group_value_container = jQuery(this).children('.typo').children('.heading-group');
		 	$group_value = $group_value_container.val();
		 	if($actual_value == $group_value){
		 		$id = $group_value_container.siblings('.hidden-id').val();
		 		jQuery('#'+$id+'family').val($font);
		 	}
		});
		
	});

});