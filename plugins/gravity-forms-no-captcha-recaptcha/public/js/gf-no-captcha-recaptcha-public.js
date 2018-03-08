(function( $ ) {

    'use strict';

    $( window ).load( function() {

        // Render the CAPTCHA on "gform_post_render" event (maintains compatibility with AJAX)
        $( document ).bind( 'gform_post_render', function() {

            // Iterate over each "g-recaptcha" div
            $( '.g-recaptcha' ).each( function( index, element ) {

                // Ensure field is empty before rendering CAPTCHA
                if( $( this ).is( ':empty' ) ) {

                    // Site key
                    var site_key = $( this ).attr( 'data-sitekey' );

                    // CAPTCHA theme
                    var theme = $( this ).attr( 'data-theme' );

                    // Native DOM element
                    var element  = $( this ).get( 0 );

                    // Render CAPTCHA
                    grecaptcha.render( element, { 'sitekey': site_key, 'theme': theme } );
                }
            });
        });

        // Manually render CAPTCHA on window load
        $( document ).trigger( 'gform_post_render' );
    });

})( jQuery );