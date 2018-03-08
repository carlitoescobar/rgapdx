<?php

/*
* Add your own functions here. You can also copy some of the theme functions into this file. 
* Wordpress will use those functions instead of the original functions then.
*/

add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

function child_function() {
    remove_action('wp_enqueue_scripts', 'avia_add_gravity_scripts');
}
add_action( 'wp_loaded', 'child_function', 25 );