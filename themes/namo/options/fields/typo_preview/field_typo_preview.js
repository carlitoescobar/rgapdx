jQuery(document).ready(function(){
	
	$font_selector = jQuery('.font-family');
	$font_selector.on('change' , function(){

		var $font = $font_selector.val();
		var $font_selector_id = $font_selector.attr("id");
		
		var $root = $font_selector.offsetParent('.farb-popup-wrapper').find('.hidden-url').val();
		var $id = $font_selector.offsetParent('.farb-popup-wrapper').find('.hidden-id').val();
		var $iframe = jQuery("#"+$id+"-preview");
		
			$param = $root+'?font='+$font;
			jQuery("#"+$id+"-preview").attr('src',$param);

	});
	
	var $iframe = jQuery('iframe');
	$iframe.each(
		function(){
			var $this = jQuery(this);
			var $root = $this.closest('.farb-popup-wrapper').find('.hidden-url').val(); // Get base root of preview.php
			var $id = $this.closest('.farb-popup-wrapper').find('.hidden-id').val(); // Get Current field id
 			var $font = jQuery("#"+$id+"family").val();
 			
 				$param = $root+'?font='+$font;
				$this.attr('src',$param);
	});
});
	