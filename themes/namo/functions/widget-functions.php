<?php
/********************************************
			REGISTER WIDGET AREA
*********************************************/


add_action( 'widgets_init', 'be_themes_widgets_init' );
function be_themes_widgets_init() {
	global $be_themes_data;

	register_sidebar(
		array(
           'name' => __( 'Default Sidebar', 'be-themes' ),
           'id'   => 'default-sidebar',
           'description'   => __( 'Widget area of Sidebar template pages', 'be-themes' ),
           'before_widget' => '<div class="%2$s widget">', 
           'after_widget'  => '</div>',
           'before_title'  => '<h6>',
           'after_title'   => '</h6>',
		)
	);
	register_sidebar(
		array(
           'name' => __( 'Footer Column 1', 'be-themes' ),
           'id'   => 'footer-widget-1',
           'description'   => __( 'Footer widget area', 'be-themes' ),
           'before_widget' => '<div class="%2$s widget">', 
           'after_widget'  => '</div>',
           'before_title'  => '<h6>',
           'after_title'   => '</h6>',
		)
	);
	register_sidebar(
		array(
           'name' => __( 'Footer Column 2', 'be-themes' ),
           'id'   => 'footer-widget-2',
           'description'   => __( 'Footer widget area', 'be-themes' ),
           'before_widget' => '<div class="%2$s widget">', 
           'after_widget'  => '</div>',
           'before_title'  => '<h6>',
           'after_title'   => '</h6>',
		)
	);
	register_sidebar(
		array(
           'name' => __( 'Footer Column 3', 'be-themes' ),
           'id'   => 'footer-widget-3',
           'description'   => __( 'Footer widget area', 'be-themes' ),
           'before_widget' => '<div class="%2$s widget">', 
           'after_widget'  => '</div>',
           'before_title'  => '<h6>',
           'after_title'   => '</h6>',
		)
	);
	register_sidebar(
		array(
           'name' => __( 'Footer Column 4', 'be-themes' ),
           'id'   => 'footer-widget-4',
           'description'   => __( 'Footer widget area', 'be-themes' ),
           'before_widget' => '<div class="%2$s widget">', 
           'after_widget'  => '</div>',
           'before_title'  => '<h6>',
           'after_title'   => '</h6>',
		)
	);
	register_sidebar(
		array (
           'name' => __( 'Slidebar', 'be-themes' ),
           'id'   => 'sliderbar-area',
           'description'   => __( 'Widget area of Slidebar', 'be-themes' ),
           'before_widget' => '<div class="%2$s widget">', 
           'after_widget'  => '</div>',
           'before_title'  => '<h6>',
           'after_title'   => '</h6>',
		)
	);
	if( isset($be_themes_data['custom_sidebars']) && sizeof( $be_themes_data['custom_sidebars'] ) > 0 && !empty($be_themes_data['custom_sidebars'])) {
		foreach( $be_themes_data['custom_sidebars'] as $sidebar ) {
			register_sidebar( 
				array(
				'name' => $sidebar,
				'id' => generateSlug( $sidebar, 45 ),
	            'description'   => '',
	            'before_widget' => '<div class="%2$s widget">', 
	            'after_widget'  => '</div>',
	            'before_title'  => '<h6>',
	            'after_title'   => '</h6>',
				) 
			);
		}
	}
}

/********************************************
			INCLUDE WIDGET FUNCTIONS
*********************************************/
	require_once( get_template_directory() .'/functions/widgets/recent_post_widget.php' );
	require_once( get_template_directory() .'/functions/widgets/brankic-photostream-widget/bra_photostream_widget.php' );	
?>