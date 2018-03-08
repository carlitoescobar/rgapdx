jQuery(document).ready(function(){
	
	jQuery('.slider').each(function(event, ui) {

		var $id =this.id;
		var $slider = jQuery('#'+$id);
		var $hidden = $slider.next('.opacity-value');
		var $value = $hidden.val();
		
		if($value == -1 )
			$value = 1;

		$slider.prev('p').find('.opacity').val( $value );
		
		$slider.slider({

			animate: true,
			range: "min",
			step: 0.1,
			min: 0,
			max: 1,
			value: $value,
			slide: function( event, ui ) {
                 $slider.prev('p').find('.opacity').val( ui.value );
            },
            change: function(event, ui) {
               $hidden.attr('value', ui.value);
            }
	
		});

	});
});