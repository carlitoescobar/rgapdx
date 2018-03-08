<?php
/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'be_themes_';

global $meta_boxes;

$meta_boxes = array();
$meta_boxes[] = array (
	'id' => 'portfolio',
	'title' => 'Portfolio Post Type',
	'pages' => array( 'portfolio' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array (
			'name'		=> __('Client Name','be-themes'),
			'id'	=> "{$prefix}portfolio_client_name",
			'desc'		=> '',
			'type'		=> 'text',
			'std'		=> ''
		),		
		array (
			'name'		=> __('Project Date','be-themes'),
			'id'	=> "{$prefix}portfolio_project_date",
			'desc'		=> '',
			'type'		=> 'text',
			'std'		=> ''
		),
		array (
			'name'		=> __('Project url','be-themes'),
			'id'	=> "{$prefix}portfolio_visitsite_url",
			'desc'		=> '',
			'type'		=> 'text'
		),
		array (
			'name'		=> __('Link Thumbnail To','be-themes'),
			'id'	=> "{$prefix}portfolio_link_to",
			'desc'		=> 'Portfolio thumbnail & Title will be linked to ?',
			'type' => 'radio',
			'options'	=> array (
				'single_portfolio' => 'Single Portfolio Page',
				'external_url' => 'External Url',
			),
			'std'  => 'single_portfolio'
		),
		array (
			'name'		=> __('External Url to linked to the thumbnail','be-themes'),
			'id'	=> "{$prefix}portfolio_external_url",
			'desc'		=> '',
			'type'		=> 'text'
		),
		array (
			'name' => __('Double Width','be-themes'),
			'id'   => "{$prefix}width_wide",
			'type' => 'checkbox',
			'std'  => ''
		),
		array (
			'name' => __('Double Height','be-themes'),
			'id'   => "{$prefix}height_wide",
			'type' => 'checkbox',
			'std'  => ''
		),
		array (
			'name'	=> __('Portfolio Single Page Style','be-themes'),
			'id'	=> "{$prefix}portfolio_single_page_style",
			'desc'	=> '',
			'type' 	=> 'select',
			'options'	=> array (
				'normal' => 'Single Page - Page Builder',
				'lightbox' => 'LightBox',
				'style1' => 'Horizontal Carousel Slider',
				'style2' => 'Centered Slider',
				'style3' => 'Full Screen Slider',
				//'style4' => 'Single Page LightBox',
				'floting-right' => 'Single Page - Floating Right Sidebar',
				'floting-left' => 'Single Page - Floating Left Sidebar',
				'normal-right' => 'Single Page - Normal Right Sidebar',
				'normal-left' => 'Single Page - Normal Left Sidebar',
				'none' => 'None',
			),
			'std'  => 'normal'
		),
		array (
			'name'		=> __('Slider Images','be-themes'),
			'id'	=> "{$prefix}single_portfolio_slider_images",
			'desc'		=> '',
			'type'		=> 'image_advanced',
			'max_file_uploads' => 100,
		),
	)
);





$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box
	'id' => 'page_portfolio',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => 'Page Sidebar Options',

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'page' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'advanced',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name' => __('Page Sidebar Layout','be-themes'),
			'id'   => "{$prefix}page_layout",
			'type' => 'select',
			'options'=>array('right'=>'Right Sidebar','left'=>'Left Sidebar'),
			'std'  => 'right',
			'desc' => '',
		),									
		array (
			'name' => __('Sidebar','be-themes'),
			'id'   => "{$prefix}sidebar",
			'type' => 'sidebar_select',
			'std'  => '',
			'desc' => '',
		),
		array (
			'name' => __('Blog Style','be-themes'),
			'id'   => "{$prefix}blog_style",
			'type' => 'select',
			'options'=> array('style1'=>'Style1', 'style2'=>'Style2', 'style3'=>'Style3 Masonry'),
			'std'  => 'style-1',
			'desc' => '',
		),
		array (
			'name' => __('Blog Column If Masonry Layout','be-themes'),
			'id'   => "{$prefix}blog_column",
			'type' => 'select',
			'options'=> array('two-col'=>'Two Column', 'three-col'=>'Three Column', 'four-col'=>'Four Column'),
			'std'  => 'three-col',
			'desc' => '',
		),
		array (
			'name' => __('Single Page Version','be-themes'),
			'id'   => "{$prefix}single_page_version",
			'type' => 'checkbox',
			'std'  => '',
		),
	)
);

$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box
	'id' => 'page_portfolio_common',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => 'Other Layout Options',

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'page','portfolio' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'advanced',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array (
			'name' => __('Show Bottom Widgets','be-themes'),
			'id'   => "{$prefix}bottom_widgets",
			'type' => 'select',
			'options'=> array('yes'=>'Yes', 'no'=>'No'),
			'std'  => 'yes',
			'desc' => '',
		),
		array (
			'name' => __('Show Footer','be-themes'),
			'id'   => "{$prefix}footer_area",
			'type' => 'select',
			'options'=> array('yes'=>'Yes', 'no'=>'No'),
			'std'  => 'yes',
			'desc' => '',
		),
		array (
			'name' => __('Scroll To Sections','be-themes'),
			'id'   => "{$prefix}section_scroll",
			'type' => 'checkbox',
			'std'  => '',
		),
	)
);

$meta_boxes[] = array (
	'id' => 'header_hero_section',
	'title' => 'Header Hero Section Options',
	'pages' => array( 'post', 'page','portfolio', 'product' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array (
		array (
			'name' => __('Header Hero Section Type','be-themes'),
			'id'   => "{$prefix}hero_section",
			'type' => 'radio',
			'options'=> array('slider'=>'Slider', 'custom'=>'Image/Video', 'none' => 'None'),
			'std'  => 'none',
			'desc' => '',
		),
		array (
			'name'		=> __('Add Revolution Slider','be-themes'),
			'id'	=> "{$prefix}hero_section_slider_shortcode",
			'desc'		=> '',
			'type'		=> 'textarea',
			'std'		=> ''
		),
		array (
			'name' => __('Transparent Header','be-themes'),
			'id'   => "{$prefix}header_transparent",
			'type' => 'checkbox',
			'std'  => ''
		),
		array (
			'name' => __('Sticky Header','be-themes'),
			'id'   => "{$prefix}sticky_header",
			'type' => 'select',
			'options'=> array('inherit' => 'Inherit From Option panel', 'yes' => 'Yes', 'no' => 'No'),
			'std'  => 'inherit',
			'desc' => '',
		),
		array (
			'name' => __('Transparent Header Color Scheme<br><i style="color:red;">Applicable only for Transparent header</i></br>','be-themes'),
			'id'   => "{$prefix}header_transparent_color_scheme",
			'type' => 'radio',
			'options'=> array('dark' => 'Dark Scheme', 'light' => 'Light Scheme'),
			'std'  => 'dark'
		),
		array (
			'name' => __('Hero Section Position <br><i style="color:red;">Applicable only for non-transparent header</i></br>','be-themes'),
			'id'   => "{$prefix}hero_section_position",
			'type' => 'radio',
			'options'=> array('before' => 'Before Header', 'after' => 'After Header'),
			'std'  => 'after',
			'desc' => '',
		),
		array (
			'name' => __('Hero Section Seen With Header<br><i style="color:red;">Applicable only if header is non-transparent, Hero Section position is Before Header and no Custom Height is defined</i></br>','be-themes'),
			'id'   => "{$prefix}hero_section_with_header",
			'type' => 'radio',
			'options'=> array('yes' => 'Yes', 'no' => 'No'),
			'std'  => 'no',
			'desc' => '',
		),
		array (
			'name' => __('Hero Section Custom Height','be-themes'),
			'id'   => "{$prefix}hero_section_custom_height",
			'type' => 'text',
			'std'  => ''
		),
		array (
			'name'		=> __('Hero Section Background Color','be-themes'),
			'id'	=> "{$prefix}hero_section_bg_color",
			'desc'		=> '',
			'type'		=> 'color',
			'std'		=> ''
		),
		array (
			'name'		=> __('Hero Section Background Image','be-themes'),
			'id'	=> "{$prefix}hero_section_bg_image",
			'desc'		=> '',
			'type'		=> 'image_advanced',
			'max_file_uploads' => 1,
		),
		array (
			'name' => __('Hero Section Background Repeat','be-themes'),
			'id'   => "{$prefix}hero_section_bg_repeat",
			'type' => 'select',
			'options'=> array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'four' => 'Four', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No Repeat'),
			'std'  => 'repeat',
			'desc' => '',
		),
		array (
			'name' => __('Hero Section Background Attachment','be-themes'),
			'id'   => "{$prefix}hero_section_bg_attachment",
			'type' => 'select',
			'options'=> array('scroll' => 'Scroll', 'fixed' => 'Fixed'),
			'std'  => 'scroll',
			'desc' => '',
		),
		array (
			'name' => __('Hero Section Background Position','be-themes'),
			'id'   => "{$prefix}hero_section_bg_position",
			'type' => 'select',
			'options'=> array('top left' => 'Top Left', 'top right' => 'Top Right', 'top center' => 'Top Center', 'center left' => 'Center Left', 'center right' => 'Center Right', 'center center' => 'Center Center', 'bottom left' => 'Bottom Left', 'bottom right' => 'Bottom Right', 'bottom center' => 'Bottom Center'),
			'std'  => 'top left',
			'desc' => '',
		),
		array (
			'name' => __('Hero Section Center Scale Image to occupy container','be-themes'),
			'id'   => "{$prefix}hero_section_bg_scale",
			'type' => 'checkbox',
			'std'  => ''
		),
		array (
			'name' => __('Hero Section Enable Parallax','be-themes'),
			'id'   => "{$prefix}hero_section_bg_parallax",
			'type' => 'checkbox',
			'std'  => ''
		),
		array (
			'name' => __('Hero Section Enable MouseMove Parallax','be-themes'),
			'id'   => "{$prefix}hero_section_bg_mouse_move_parallax",
			'type' => 'checkbox',
			'std'  => ''
		),
		array (
			'name' => __('Hero Section Enable Background Video','be-themes'),
			'id'   => "{$prefix}hero_section_bg_video",
			'type' => 'checkbox',
			'std'  => ''
		),
		array (
			'name' => __('Hero Section Video .MP4 Video File','be-themes'),
			'id'   => "{$prefix}hero_section_bg_video_mp4",
			'type' => 'text',
			'std'  => ''
		),
		array (
			'name' => __('Hero Section Video .OGG Video File','be-themes'),
			'id'   => "{$prefix}hero_section_bg_video_ogg",
			'type' => 'text',
			'std'  => ''
		),
		array (
			'name' => __('Hero Section Video .Webm Video File','be-themes'),
			'id'   => "{$prefix}hero_section_bg_video_webm",
			'type' => 'text',
			'std'  => ''
		),
		array (
			'name' => __('Hero Section Enable Background Overlay','be-themes'),
			'id'   => "{$prefix}hero_section_overlay",
			'type' => 'checkbox',
			'std'  => ''
		),
		array (
			'name'		=> __('Hero Section Background Overlay Color','be-themes'),
			'id'	=> "{$prefix}hero_section_bg_overlay_color",
			'desc'		=> '',
			'type'		=> 'color',
			'std'		=> ''
		),
		array (
			'name' => __('Hero Section Background Overlay Opacity','be-themes'),
			'id'   => "{$prefix}hero_section_bg_overlay_opacity",
			'type' => 'text',
			'std'  => ''
		),
		array (
			'name' => __('Container Wrap','be-themes'),
			'id'   => "{$prefix}hero_section_container_wrap",
			'type' => 'radio',
			'options'=> array('yes' => 'Yes', 'no' => 'No'),
			'std'  => 'yes',
			'desc' => 'no',
		),
		array (
			'name'		=> __('Hero Section content','be-themes'),
			'id'	=> "{$prefix}hero_section_content",
			'desc'		=> '',
			'type'		=> 'wysiwyg',
			'std'		=> ''
		),
	)
);

$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box
	'id' => 'post_format_options',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => 'Post Format Options',

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'post' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array (
			// Field name - Will be used as label
			'name'		=> __('Youtube / Vimeo Video Url','be-themes'),
			// Field ID, i.e. the meta key
			'id'	=> "{$prefix}video_url",
			// Field description (optional)
			'desc'		=> '',
			
			'type'		=> 'text',
			// Default value (optional)
			'std'		=> ''
		),
		array (
			// Field name - Will be used as label
			'name'		=> __('Audio Embed Code Or Link to an Audio File','be-themes'),
			// Field ID, i.e. the meta key
			'id'	=> "{$prefix}audio_url",
			// Field description (optional)
			'desc'		=> '',
			
			'type'		=> 'text',
			// Default value (optional)
			'std'		=> ''
		),
		array (
			// Field name - Will be used as label
			'name'		=> __('Link Post Format URL','be-themes'),
			// Field ID, i.e. the meta key
			'id'	=> "{$prefix}link_format",
			// Field description (optional)
			'desc'		=> '',
			
			'type'		=> 'text',
			// Default value (optional)
			'std'		=> ''
		),						
		array (
			// Field name - Will be used as label
			'name'		=> __('Gallery Post Format Images','be-themes'),
			// Field ID, i.e. the meta key
			'id'	=> "{$prefix}gal_post_format",
			// Field description (optional)
			'desc'		=> '',
			
			'type'		=> 'thickbox_image',
			// Default value (optional)
			'max_file_uploads' => 10,
		)					


	)
);


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function be_themes_register_meta_boxes()
{
	global $meta_boxes;
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'be_themes_register_meta_boxes' );