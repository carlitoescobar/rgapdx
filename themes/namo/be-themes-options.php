<?php
/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 * Also if running on windows you may have url problems, which can be fixed by defining the framework url first
 *
 */
//define('NHP_OPTIONS_URL', site_url('path the options folder'));
if(!class_exists('NHP_Options')){
	get_template_part( 'options/options' );
}
/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constants for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections) {
	$sections[] = array (
		'title' => __('A Section added by hook', 'be-themes'),
		'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'be-themes'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array()
	);
	return $sections;
}
//function
//add_filter('nhp-opts-sections-twenty_eleven', 'add_another_section');
/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	$args['dev_mode'] = false;
	return $args;
}
/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */
function setup_framework_options() {
$args = array();

//Set it to dev mode to view the class settings/info in the form - default is false
$args['dev_mode'] = false;


$args['intro_text'] = __('<p>Welcome to the Namo Theme Options panel. You will find that its very simple to do what you want and yet powerful enough to do whatever you want, with our wide variety of options. </p>', 'be-themes');


//Choose to disable the import/export feature
//$args['show_import_export'] = false;

//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$args['opt_name'] = PREMIUM_THEME_NAME;


$args['menu_title'] = __('Namo Options', 'be-themes');

//Custom Page Title for options page - default is "Options"
$args['page_title'] = __('Namo Theme Options', 'be-themes');

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
$args['page_slug'] = PREMIUM_THEME_NAME.'_theme_options';



//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = 29;

//Custom page icon class (used to override the page icon next to heading)
$args['page_icon'] = PREMIUM_THEME_NAME.'-logo';
$args['help_tabs'][] = array (
	'id' => 'nhp-opts-1',
	'title' => __('Theme Information 1', 'be-themes'),
	'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'be-themes')
);
$args['help_tabs'][] = array (
	'id' => 'nhp-opts-2',
	'title' => __('Theme Information 2', 'be-themes'),
	'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'be-themes')
);
//Set the Help Sidebar for the options page - no sidebar by default										
$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'be-themes');
global $sections;
$sections = array();
global $pattern_array;
global $background_array;
$pattern_array = array (
	'None' => array('title' => 'None', 'img' => NHP_OPTIONS_URL.'images/pattern/None.png'),
	'Style-1' => array('title' => 'Style-1', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-1.png'),
	'Style-2' => array('title' => 'Style-2', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-2.png'),
	'Style-3' => array('title' => 'Style-3', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-3.png'),
	'Style-4' => array('title' => 'Style-4', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-4.png'),
	'Style-5' => array('title' => 'Style-5', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-5.png'),
	'Style-6' => array('title' => 'Style-6', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-6.png'),
	'Style-7' => array('title' => 'Style-7', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-7.png'),
	'Style-8' => array('title' => 'Style-8', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-8.png'),
	'Style-9' => array('title' => 'Style-9', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-9.png'),
	'Style-10' => array('title' => 'Style-10', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-10.png'),
	'Style-11' => array('title' => 'Style-11', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-11.png'),
	'Style-12' => array('title' => 'Style-12', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-12.png'),
	'Style-13' => array('title' => 'Style-13', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-13.png'),
	'Style-14' => array('title' => 'Style-14', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-14.png'),
	'Style-15' => array('title' => 'Style-15', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-15.png'),
	'Style-16' => array('title' => 'Style-16', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-16.png'),
	'Style-17' => array('title' => 'Style-17', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-17.png'),
	'Style-18' => array('title' => 'Style-18', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-18.png'),
	'Style-19' => array('title' => 'Style-19', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-19.png'),
	'Style-20' => array('title' => 'Style-20', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-20.png'),
	'Style-21' => array('title' => 'Style-21', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-21.png'),
);
$background_array = array (
	'None' => array('title' => 'None', 'img' => NHP_OPTIONS_URL.'images/pattern/None.png'),
	'Style-1' => array('title' => 'Style-1', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-1.png'),
	'Style-2' => array('title' => 'Style-2', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-2.png'),
	'Style-3' => array('title' => 'Style-3', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-3.png'),
	'Style-4' => array('title' => 'Style-4', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-4.png'),
	'Style-5' => array('title' => 'Style-5', 'img' => NHP_OPTIONS_URL.'images/pattern/Style-5.png')
);
$sections[] = array (
	'icon' => NHP_OPTIONS_URL.'images/icon/general.png',
	'title' => __('General', 'be-themes'),
	'desc' => __('<p class="description"></p>', 'be-themes'),
	'fields' =>	array (
		array (
			'id' => 'dev_or_deploy',
			'type' => 'button_set',
			'title' => __('Status of the Website', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('It is important to set this to "deploy" after you have finished playing with options panel and ready to launch the website. It will help us cache the css and optimize performance of the website', 'be-themes'),
			'options' => array('dev' => 'Develop','deploy' => 'Deploy'),//Must provide key => value pairs for radio options
			'std' => 'dev'
		),
		array (
			'id' => 'enable_pb',
			'type' => 'checkbox',
			'title' => __('Enable Pagebuilder ?', 'be-themes'),
			'sub_desc' => __('Check this box if you would like to use the page builder for constructing your pages and portfolio posts. Page Builder is not available for blog posts. You can still disable the page builder per page if you would like to use the default wordpress content editor', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 1
		),
		array (
			'id' => 'logo',
			'type' => 'upload',
			'title' => __('Your Logo', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('Please upload your logo here.', 'be-themes')
		),
		array (
			'id' => 'logo_transparent',
			'type' => 'upload',
			'title' => __('Logo on Transparent Header Dark Scheme', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('Please upload the logo that needs to be displayed in transparent header sections.', 'be-themes')
		),
		array (
			'id' => 'logo_transparent_light',
			'type' => 'upload',
			'title' => __('Logo on Transparent Header Light Scheme', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('Please upload the logo that needs to be displayed in transparent header sections with light backgrounds.', 'be-themes')
		),
		array (
			'id' => 'logo_sidebar',
			'type' => 'upload',
			'title' => __('Logo on Sidebar', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('Please upload the logo that needs to be displayed in the slidebar', 'be-themes')
		),
		array (
			'id' => 'favicon',
			'type' => 'upload',
			'title' => __('Your Favicon', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('Please upload a favicon here.', 'be-themes')
		),
		array (
			'id' => 'copyright_text',
			'type' => 'textarea',
			'title' => __('Copyright Text', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'validate' => 'html', 
			'std' => '&copy; Copyright 2014 Brand Exponents. All Rights Reserved'
		),
		array (
			'id' => 'google_analytics_code',
			'type' => 'text',
			'title' => __('Google Analytics Code', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('Please enter your Google analytics tracking ID here.', 'be-themes'),
			'validate' => 'js', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
			'std' => ''
		),
		array (
			'id' => 'custom_css',
			'type' => 'textarea',
			'title' => __('Custom CSS', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('Please add your custom CSS here.', 'be-themes'),
			'validate' => 'html_custom', 
			'std' => ''
		),
		array (
			'id' => 'custom_js',
			'type' => 'textarea',
			'title' => __('Custom Javascript', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('Please add your custom js code here.', 'be-themes'),
			'validate' => 'html_custom', 
			'std' => ''
		)											
	)
);
$sections[] = array (
	'title' => __('Background', 'be-themes'),
	'desc' => __('<p class="description">Control the Appearance of the site from this tab by uploading your own patterns and images or by choosing from one of the plethora of presets available</p>', 'be-themes'),
	'icon' => NHP_OPTIONS_URL.'images/icon/bg.png',
	'fields' => array (
		array (
			'id' => 'header',
			'type' => 'background',
			'title' => __('Header', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'defaults' => $pattern_array,
			'patterns' => array('dark' => 'Dark','light' => 'Light'),
			'std' =>    array (            
				'background' =>'', 
				'scale' => 0,
				'bgdefault' => '',
				'bgpattern' => '',
				'color' => '#ffffff', 
				'opacity' => '1'
			)
		),
		array (
			'id' => 'body',
			'type' => 'background',
			'title' => __('Body', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'defaults' => $pattern_array,
			'patterns' => array('dark' => 'Dark','light' => 'Light'),
			'std' =>    array (            
				'background' =>'', 
				'scale' => 0,
				'bgdefault' => '',
				'bgpattern' => '',
				'color' => '#ffffff', 
				'opacity' => '1'
			)
		),
		array (
			'id' => 'content',
			'type' => 'background',
			'title' => __('Content Area', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'defaults' => $pattern_array,
			'patterns' => array('dark' => 'Dark','light' => 'Light'),
			'std' =>    array (            
				'background' =>'', 
				'scale' => 0,
				'bgdefault' => '',
				'bgpattern' => '',
				'color' => '#ffffff', 
				'opacity' => '1'
			)
		),
		array (
			'id' => 'bottom_widgets',
			'type' => 'background',
			'title' => __('Bottom Widget Area', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'defaults' => $pattern_array,
			'patterns' => array('dark' => 'Dark','light' => 'Light'),
			'std' =>    array (            
				'background' =>'', 
				'scale' => 0,
				'bgdefault' => '',
				'bgpattern' => '',
				'color' => '#202020', 
				'opacity' => '1'
			)
		),
		array (
			'id' => 'footer_background',
			'type' => 'background',
			'title' => __('Footer', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'defaults' => $pattern_array,
			'patterns' => array('dark' => 'Dark','light' => 'Light'),
			'std' =>    array (            
				'background' =>'', 
				'scale' => 0,
				'bgdefault' => '',
				'bgpattern' => '',
				'color' => '#000000', 
				'opacity' => '1'
			)
		),		
		array (
			'id' => 'header_title_module',
			'type' => 'background',
			'title' => __('Header Title Module', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'defaults' => $pattern_array,
			'patterns' => array('dark' => 'Dark','light' => 'Light'),
			'std' =>    array (            
				'background' =>'', 
				'scale' => 0,
				'bgdefault' => '',
				'bgpattern' => '',
				'color' => '#e8e8e8', 
				'opacity' => '1'
			)
		),
		array (
			'id' => 'submenu_bg_color',
			'type' => 'color',
			'title' => __('Submenu & Mobile Menu Background Color', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => '#141414'
		),
		array (
			'id' => 'sidebar_menu_bg_color',
			'type' => 'color',
			'title' => __('Sidebar menu / Left Header Background Color', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => '#141414'
		),				
	)
);
$sections[] = array (
	'title' => __('Typography', 'be-themes'),
	'desc' => __('<p class="description"></p>', 'be-themes'),
	'icon' => NHP_OPTIONS_URL.'images/icon/typo.png',
	'fields' => array (
		array (
			'id' => 'h1',
			'type' => 'typo',
			'title' => __('H1', 'be-themes'), 
			'sub_desc' => __('Heading Tag 1', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'group' => 'typo',
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '6px',
				'size' => '47px',
				'line_height' => '68px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'uppercase',
				'color' => '#000000',
			)
		),
		array (
			'id' => 'h2',
			'type' => 'typo',
			'title' => __('H2', 'be-themes'), 
			'sub_desc' => __('Heading Tag 2', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'group' => 'typo',
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '6px',
				'size' => '38px',
				'line_height' => '50px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'uppercase',
				'color' => '#000000'
			)
		),
		array (
			'id' => 'h3',
			'type' => 'typo',
			'title' => __('H3', 'be-themes'), 
			'sub_desc' => __('Heading Tag 3', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'group' => 'typo',
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '3px',
				'size' => '30px',
				'line_height' => '45px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'uppercase',
				'color' => '#000000'
			)
		),
		array (
			'id' => 'h4',
			'type' => 'typo',
			'title' => __('H4', 'be-themes'), 
			'sub_desc' => __('Heading Tag 4', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'group' => 'typo',
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '0px',
				'size' => '20px',
				'line_height' => '36px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'none',
				'color' => '#000000'
			)
		),
		array (
			'id' => 'h5',
			'type' => 'typo',
			'title' => __('H5', 'be-themes'), 
			'sub_desc' => __('Heading Tag 5', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'group' => 'typo',
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '2px',
				'size' => '20px',
				'line_height' => '36px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'uppercase',
				'color' => '#000000'
			)
		),
		array (
			'id' => 'h6',
			'type' => 'typo',
			'title' => __('H6', 'be-themes'), 
			'sub_desc' => __('Heading Tag 6', 'be-themes'), 
			'desc' => __('', 'be-themes'),
			'group' => 'typo',
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '2px',
				'size' => '13px',
				'line_height' => '29px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'uppercase',
				'color' => '#000000'
			)
		),
		array (
			'id' => 'body_text',
			'type' => 'typo',
			'title' => __('Body Text', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '0px',
				'size' => '14px',
				'line_height' => '29px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'none',
				'color' => '#7e7e7e'
			)
		),
		array (
			'id' => 'sidebar_widget_title',
			'type' => 'typo',
			'title' => __('Sidebar Widget Title', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'), 
			'desc' => __('', 'be-themes'),
			'group' => 'typo',
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '2px',
				'size' => '13px',
				'line_height' => '22px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'uppercase',
				'color' => '#000000'
			)
		),
		array (
			'id' => 'sidebar_widget_text',
			'type' => 'typo',
			'title' => __('Sidebar Widget Text', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'), 
			'desc' => __('', 'be-themes'),
				'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '0px',
				'size' => '14px',
				'line_height' => '25px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'none',
				'color' => '#7e7e7e;'
			)
		),
		array (
			'id' => 'bottom_widget_title',
			'type' => 'typo',
			'title' => __('Footer Widget Title', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'), 
			'desc' => __('', 'be-themes'),
			'group' => 'typo',
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '2px',
				'size' => '13px',
				'line_height' => '22px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'uppercase',
				'color' => '#ffffff'
			)
		),
		array (
			'id' => 'bottom_widget_text',
			'type' => 'typo',
			'title' => __('Footer Widget Text', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'), 
			'desc' => __('', 'be-themes'),
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '0px',
				'size' => '14px',
				'line_height' => '25px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'none',
				'color' => '#9f9f9f'
			)
		),
		array (
			'id' => 'slidebar_widget_title',
			'type' => 'typo',
			'title' => __('Slidebar Menu Widget Title', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'), 
			'desc' => __('', 'be-themes'),
			'group' => 'typo',
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '2px',
				'size' => '13px',
				'line_height' => '22px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'uppercase',
				'color' => '#ffffff'
			)
		),
		array (
			'id' => 'slidebar_widget_text',
			'type' => 'typo',
			'title' => __('Slidebar Menu Widget Text', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'), 
			'desc' => __('', 'be-themes'),
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '0px',
				'size' => '14px',
				'line_height' => '25px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'none',
				'color' => '#9f9f9f'
			)
		),		
		array (
			'id' => 'footer_text', 
			'type' => 'typo',
			'title' => __('Footer Copyright Text', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '0px',
				'size' => '14px',
				'line_height' => '14px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'none',
				'color' => '#868686'
			)
		),
		array (
			'id' => 'navigation_text',
			'type' => 'typo',
			'title' => __('Navigation Menu', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'), 
			'desc' => __('', 'be-themes'),
			'std' => array (
				'family' => 'google/Open Sans:600',
				'letter_spacing' => '2px',
				'size' => '11px',
				'line_height' => '24px',
				'style' => 'normal',
				'weight' => '600',
				'transform' => 'uppercase',
				'color' => '#8D8D8D'
			)
		),
		array (
			'id' => 'button_font',
			'type' => 'font',
			'title' => __('Font Family of Buttons', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'std' => 'google/Open Sans:regular'
		),
		array (
			'id' => 'portfolio_title',
			'type' => 'typo',
			'title' => __('Portfolio Title', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'), 
			'desc' => __('', 'be-themes'),
			'group' => 'typo',
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '3px',
				'size' => '13px',
				'line_height' => '30px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'uppercase',
				'color' => '#000000'
			)
		),
		array (
			'id' => 'submenu_text',
			'type' => 'typo',
			'title' => __('Navigation Submenu & Mobile Menu Text', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '1px',
				'size' => '11px',
				'line_height' => '32px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'uppercase',
				'color' => '#a2a2a2'
			)
		),
		array (
			'id' => 'sidebar_menu_text',
			'type' => 'typo',
			'title' => __('Sidebar Menu Text', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '2px',
				'size' => '11px',
				'line_height' => '50px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'uppercase',
				'color' => '#a9a9a9'
			)
		),
		array (
			'id' => 'page_title_module_typo',
			'type' => 'typo',
			'title' => __('Page Title Module', 'be-themes'), 
			'sub_desc' => __('Page Title Module Title', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'group' => 'typo',
			'std' => array (
				'family' => 'google/Open Sans:regular',
				'letter_spacing' => '2px',
				'size' => '20px',
				'line_height' => '36px',
				'style' => 'normal',
				'weight' => 'normal',
				'transform' => 'uppercase',
				'color' => '#000000'
			)
		),
		
	)
);
$sections[] = array (
	'icon' => NHP_OPTIONS_URL.'images/icon/layout-new.png',
	'title' => __('Layout', 'be-themes'),
	'desc' => __('<p class="description">', 'be-themes'),
	'fields' =>	array (
		array (
			'id' => 'layout',
			'type' => 'radio_img',
			'title' => __('Layout', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'options' => array (
				'layout-box' => array('title' => 'Boxed Layout', 'img' => NHP_OPTIONS_URL.'images/boxed.jpg'),
				'layout-wide' => array('title' => 'Wide Layout', 'img' => NHP_OPTIONS_URL.'images/wide.jpg')
			),
			'std' => 'layout-wide'
		),
		array (
			'id' => 'bottom_widgets_layout',
			'type' => 'radio_img',
			'title' => __('Number of Columns in Bottom Widget Area', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'options' => array (
				'three-col' => array('title' => 'Three Column', 'img' => NHP_OPTIONS_URL.'images/3col.jpg'),
				'four-col' => array('title' => 'Four Column', 'img' => NHP_OPTIONS_URL.'images/4col.jpg')
			),
			'std' => 'four-col'
		),
		array (
			'id' => 'main_header_style',
			'type' => 'radio',
			'title' => __('Header Style', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'options'=> array('left'=>'Left Header', 'top'=>'Top Header'),
			'std' => 'top'
		),
		array (
			'id' => 'sticky_header',
			'type' => 'checkbox',
			'title' => __('Enable Sticky Header', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 0
		),
		array (
			'id' => 'header_search_box',
			'type' => 'checkbox',
			'title' => __('Show Search in Header', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 1
		),
		array (
			'id' => 'header_cart_widget',
			'type' => 'checkbox',
			'title' => __('Show Cart in Header', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 1
		),
		array (
			'id' => 'comments_on_page',
			'type' => 'checkbox',
			'title' => __('Display Comments on Pages', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 1
		),	
		array (
			'id' => 'show_main_nav',
			'type' => 'radio',
			'title' => __('Show Main Navigation', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'options'=> array('yes'=>'Yes', 'no'=>'No'),
			'std' => 'yes'
		),
		array (
			'id' => 'show_sliderbar',
			'type' => 'radio',
			'title' => __('Show Slidebar', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'options'=> array('yes'=>'Yes', 'no'=>'No'),
			'std' => 'yes'
		),							
		array (
			'id' => 'custom_sidebars',
			'type' => 'multi_text',
			'title' => __('Custom Sidebars', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'remove_smooth_scroll',
			'type' => 'checkbox',
			'title' => __('Remove Smooth Scroll', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 0
		),
		/*array (
			'id' => 'all_ajax',
			'type' => 'checkbox',
			'title' => __('Enable All Ajax', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 1
		),*/

	)
);			

$sections[] = array (
	'icon' => NHP_OPTIONS_URL.'images/icon/brush.png',
	'title' => __('Colors', 'be-themes'),
	'desc' => __('<p class="description">', 'be-themes'),
	'fields' =>	array (
		array (
			'id' => 'color_scheme',
			'type' => 'color',
			'title' => __('Color Scheme', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => '#26cda4'
		),
		array (
			'id' => 'alt_bg_text_color',
			'type' => 'color',
			'title' => __('Text Color on a background which has the above Color Scheme', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => '#ffffff'
		),
		array (
			'id' => 'sec_bg',
			'type' => 'color',
			'title' => __('Secondary Background Color', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => '#efefef'
		),
		array (
			'id' => 'sec_color',
			'type' => 'color',
			'title' => __('Secondary Text Color', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => '#555555'
		),
		array (
			'id' => 'sec_border',
			'type' => 'color',
			'title' => __('Secondary Border Color', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => '#dedede'
		),
		array (
			'id' => 'header_cart_count_background',
			'type' => 'color',
			'title' => __('Header Cart Number Background Color', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => '#141414'
		),
		array (
			'id' => 'header_cart_count_color',
			'type' => 'color',
			'title' => __('Header Cart Number Text Color', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => '#ffffff'
		),
		array (
			'id' => 'submenu_mobile_border',
			'type' => 'color',
			'title' => __('Sub Menu & Mobile Menu Border Color', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => '#303030'
		),
		array (
			'id' => 'slidebar_menu_border',
			'type' => 'color',
			'title' => __('Slidebar Menu / Left Header Menu Border Color', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => '#303030'
		),							
	)
);
 $sections[] = array (
	'icon' => NHP_OPTIONS_URL.'images/icon/contact.png',
	'title' => __('Contact Settings', 'be-themes'),
	'desc' => __('<p class="description"></p>', 'be-themes'),
	'fields' => array (
		array (
			'id' => 'mail_id',
			'type' => 'text',
			'title' => __('Email Address', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('Please enter your email address.', 'be-themes'),
			'std' => ''
		)
	)
);
$sections[] = array (
	'icon' => NHP_OPTIONS_URL.'images/icon/blog.png',
	'title' => __('Blog Settings', 'be-themes'),
	'desc' => __('<p class="description"></p>', 'be-themes'),
	'fields' => array (
		array (
			'id' => 'open_to_lightbox',
			'type' => 'checkbox',
			'title' => __('Thumbnail Open to Lightbox', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 1
		),
		array (
			'id' => 'blog_style',
			'type' => 'select',
			'title' => __('Blog Style', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('style1'=>'Large Thumbnail', 'style2'=>'Small Thumbnail', 'style3'=>'Masonry'),
			'std' => 'style1'
		),
		array (
			'id' => 'blog_sidebar',
			'type' => 'select',
			'title' => __('Blog Sidebar Position', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('left'=>'Left Sidebar','right'=>'Right Sidebar'),
			'std' => 'right'
		),
		array (
			'id' => 'blog_column',
			'type' => 'select',
			'title' => __('Blog Column', 'be-themes'), 
			'sub_desc' => __('Affects only Masonry Layout', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('two-col'=>'Two Column', 'three-col'=>'Three Column', 'four-col'=>'Four Column'),
			'std' => 'three-col'
		),
		array (
			'id' => 'show_bottom_widgets',
			'type' => 'select',
			'title' => __('Show Bottom Widgets', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('yes'=>'Yes', 'no'=>'No'),
			'std' => 'yes'
		),			
	)					
);

$sections[] = array (
	'icon' => NHP_OPTIONS_URL.'images/icon/blog.png',
	'title' => __('Portfolio Settings', 'be-themes'),
	'desc' => __('<p class="description">Portfolio Taxonomy Settings</p>', 'be-themes'),
	'fields' => array (
		array (
			'id' => 'portfolio_style',
			'type' => 'select',
			'title' => __('Portfolio Taxonomy Pages Style', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('portfolio_full_screen'=>'Full Screen Portfolio', 'portfolio_full_screen_with_gutter'=>'Full Screen With Gutter', 'portfolio'=>'Normal Portfolio'),
			'std' => 'portfolio'
		),
		array (
			'id' => 'portfolio_col',
			'type' => 'select',
			'title' => __('Portfolio Portfolio Taxonomy Pages Column', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('two'=>'Two Column', 'three'=>'Three Column', 'four'=>'Four Column', 'five'=>'Five Column'),
			'std' => 'three'
		),
		array (
			'id' => 'portfolio_hover_color',
			'type' => 'color',
			'title' => __('Portfolio Taxonomy Pages hover Color', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => '#26cda4'
		),
		array (
			'id' => 'portfolio_hover_opacity',
			'type' => 'text',
			'title' => __('Portfolio Taxonomy Pages hover Color Opacity', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'std' => 85
		),		
	)					
);

$sections[] = array (
	'icon' => NHP_OPTIONS_URL.'images/icon/cart.png',
	'title' => __('Shop', 'be-themes'),
	'desc' => __('<p class="description">', 'be-themes'),
	'fields' =>	array (	
		array (
			'id' => 'show_sidebar_on_shop_page',
			'type' => 'checkbox',
			'title' => __('Shop with Sidebar ?', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 0
		),
		array (
			'id' => 'number_of_products_per_page',
			'type' => 'text',
			'title' => __('Number of products per page', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 9
		),
	)
);
$sections[] = array (
	'icon' => NHP_OPTIONS_URL.'images/icon/cog.png',
	'title' => __('Single blog Hero Section', 'be-themes'),
	'desc' => __('<p class="description">Single blog Hero Section Content</p>', 'be-themes'),
	'fields' => array (
		array (
			'id' => 'single_blog_hero_section_from',
			'type' => 'radio',
			'title' => __('Header Hero Section from', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('inherit_option_panel'=>'Options Panel - Here', 'single_page'=>'Single Page', 'none' => 'None'),
			'std' => 'inherit_option_panel'
		),
		array (
			'id' => 'single_blog_hero_section',
			'type' => 'radio',
			'title' => __('Header Hero Section Type', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('slider'=>'Slider', 'custom'=>'Image/Video', 'none' => 'None'),
			'std' => 'none'
		),
		array (
			'id' => 'single_blog_hero_section_slider_shortcode',
			'type' => 'textarea',
			'title' => __('Add Revolution Slider', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_blog_header_transparent',
			'type' => 'checkbox',
			'title' => __('Transparent Header ?', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 0
		),
		array (
			'id' => 'single_blog_header_sticky',
			'type' => 'select',
			'title' => __('Header Sticky', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('inherit' => 'Inherit From Option panel', 'yes' => 'Yes', 'no' => 'No'),
			'std' => 'inherit'
		),
		array (
			'id' => 'single_blog_header_transparent_color_scheme',
			'type' => 'radio',
			'title' => __('Transparent Header Navigation Color Scheme', 'be-themes'), 
			'sub_desc' => __('Applicable only for Transparent header', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('dark' => 'Dark Scheme', 'light' => 'Light Scheme'),
			'std' => 'dark'
		),
		array (
			'id' => 'single_blog_hero_section_position',
			'type' => 'radio',
			'title' => __('Hero Section Position', 'be-themes'), 
			'sub_desc' => __('Applicable only for non-transparent header', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('before' => 'Before Header', 'after' => 'After Header'),
			'std' => 'after'
		),
		array (
			'id' => 'single_blog_hero_section_with_header',
			'type' => 'radio',
			'title' => __('Hero Section With Header ?', 'be-themes'), 
			'sub_desc' => __('Applicable only if header is non-transparent, Hero Section position is Before Header and no Custom Height is defined', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('yes' => 'Yes', 'no' => 'No'),
			'std' => 'no'
		),
		array (
			'id' => 'single_blog_hero_section_custom_height',
			'type' => 'text',
			'title' => __('Hero Section Custom Height', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_blog_hero_section_bg_color',
			'type' => 'color',
			'title' => __('Hero Section Background Color', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_blog_hero_section_bg_image',
			'type' => 'upload',
			'title' => __('Hero Section Background Image', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_blog_hero_section_bg_repeat',
			'type' => 'select',
			'title' => __('Hero Section Background Repeat', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'four' => 'Four', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No Repeat'),
			'std' => 'repeat'
		),
		array (
			'id' => 'single_blog_hero_section_bg_attachment',
			'type' => 'select',
			'title' => __('Hero Section Background Attachment', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('scroll' => 'Scroll', 'fixed' => 'Fixed'),
			'std' => 'scroll'
		),
		array (
			'id' => 'single_blog_hero_section_bg_position',
			'type' => 'select',
			'title' => __('Hero Section Background Position', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('top left' => 'Top Left', 'top right' => 'Top Right', 'top center' => 'Top Center', 'center left' => 'Center Left', 'center right' => 'Center Right', 'center center' => 'Center Center', 'bottom left' => 'Bottom Left', 'bottom right' => 'Bottom Right', 'bottom center' => 'Bottom Center'),
			'std' => 'center center'
		),
		array (
			'id' => 'single_blog_hero_section_bg_scale',
			'type' => 'checkbox',
			'title' => __('Hero Section Center Scale Image to occupy container', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 0
		),
		array (
			'id' => 'single_blog_hero_section_bg_parallax',
			'type' => 'checkbox',
			'title' => __('Hero Section Enable Parallax', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 0
		),
		array (
			'id' => 'single_blog_hero_section_bg_video',
			'type' => 'checkbox',
			'title' => __('Hero Section Enable Background Video', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 0
		),
		array (
			'id' => 'single_blog_hero_section_bg_video_mp4',
			'type' => 'text',
			'title' => __('Hero Section Video .MP4 Video File', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_blog_hero_section_bg_video_ogg',
			'type' => 'text',
			'title' => __('Hero Section Video .OGG Video File', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_blog_hero_section_bg_video_webm',
			'type' => 'text',
			'title' => __('Hero Section Video .Webm Video File', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_blog_hero_section_overlay',
			'type' => 'checkbox',
			'title' => __('Hero Section Enable Background Overlay', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 0
		),
		array (
			'id' => 'single_blog_hero_section_bg_overlay_color',
			'type' => 'color',
			'title' => __('Hero Section Background Overlay Color', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_blog_hero_section_bg_overlay_opacity',
			'type' => 'text',
			'title' => __('Hero Section Background Overlay Opacity', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_blog_hero_section_container_wrap',
			'type' => 'radio',
			'title' => __('Wrap Content ?', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('yes' => 'Yes', 'no' => 'No'),
			'std' => 'yes'
		),
		array (
			'id' => 'single_blog_hero_section_content',
			'type' => 'textarea',
			'title' => __('Hero Section content', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'validate' => 'html_custom',
			'std' => ''
		),
	)					
);
$sections[] = array (
	'icon' => NHP_OPTIONS_URL.'images/icon/cog.png',
	'title' => __('Single Shop Hero Section', 'be-themes'),
	'desc' => __('<p class="description">Single Shop Hero Section Content</p>', 'be-themes'),
	'fields' => array (
		array (
			'id' => 'single_shop_hero_section_from',
			'type' => 'radio',
			'title' => __('Header Hero Section from', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('inherit_option_panel'=>'Options Panel - Here', 'single_page'=>'Single Post', 'none' => 'None'),
			'std' => 'inherit_option_panel'
		),
		array (
			'id' => 'single_shop_hero_section',
			'type' => 'radio',
			'title' => __('Header Hero Section Type', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('slider'=>'Slider', 'custom'=>'Image/Video', 'none' => 'None'),
			'std' => 'none'
		),
		array (
			'id' => 'single_shop_hero_section_slider_shortcode',
			'type' => 'textarea',
			'title' => __('Add Revolution Slider', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_shop_header_transparent',
			'type' => 'checkbox',
			'title' => __('Transparent Header', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 0
		),
		array (
			'id' => 'single_shop_header_sticky',
			'type' => 'select',
			'title' => __('Header Sticky', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('inherit' => 'Inherit From Option panel', 'yes' => 'Yes', 'no' => 'No'),
			'std' => 'inherit'
		),
		array (
			'id' => 'single_shop_header_transparent_color_scheme',
			'type' => 'radio',
			'title' => __('Transparent Header Color Scheme', 'be-themes'), 
			'sub_desc' => __('Applicable only for Transparent header', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('dark' => 'Dark Scheme', 'light' => 'Light Scheme'),
			'std' => 'dark'
		),
		array (
			'id' => 'single_shop_hero_section_position',
			'type' => 'radio',
			'title' => __('Hero Section Position', 'be-themes'), 
			'sub_desc' => __('Applicable only for non-transparent header', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('before' => 'Before Header', 'after' => 'After Header'),
			'std' => 'after'
		),
		array (
			'id' => 'single_shop_hero_section_with_header',
			'type' => 'radio',
			'title' => __('Hero Section With Header ?', 'be-themes'), 
			'sub_desc' => __('Applicable only if header is non-transparent, Hero Section position is Before Header and no Custom Height is defined', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('yes' => 'Yes', 'no' => 'No'),
			'std' => 'no'
		),
		array (
			'id' => 'single_shop_hero_section_custom_height',
			'type' => 'text',
			'title' => __('Hero Section Custom Height', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_shop_hero_section_bg_color',
			'type' => 'color',
			'title' => __('Hero Section Background Color', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_shop_hero_section_bg_image',
			'type' => 'upload',
			'title' => __('Hero Section Background Image', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_shop_hero_section_bg_repeat',
			'type' => 'select',
			'title' => __('Hero Section Background Repeat', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('repeat' => 'Repeat', 'repeat-x' => 'Repeat-x', 'four' => 'Four', 'repeat-y' => 'Repeat-y', 'no-repeat' => 'No Repeat'),
			'std' => 'repeat'
		),
		array (
			'id' => 'single_shop_hero_section_bg_attachment',
			'type' => 'select',
			'title' => __('Hero Section Background Attachment', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('scroll' => 'Scroll', 'fixed' => 'Fixed'),
			'std' => 'scroll'
		),
		array (
			'id' => 'single_shop_hero_section_bg_position',
			'type' => 'select',
			'title' => __('Hero Section Background Position', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('top left' => 'Top Left', 'top right' => 'Top Right', 'top center' => 'Top Center', 'center left' => 'Center Left', 'center right' => 'Center Right', 'center center' => 'Center Center', 'bottom left' => 'Bottom Left', 'bottom right' => 'Bottom Right', 'bottom center' => 'Bottom Center'),
			'std' => 'center center'
		),
		array (
			'id' => 'single_shop_hero_section_bg_scale',
			'type' => 'checkbox',
			'title' => __('Hero Section Center Scale Image to occupy container', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 0
		),
		array (
			'id' => 'single_shop_hero_section_bg_parallax',
			'type' => 'checkbox',
			'title' => __('Hero Section Enable Parallax', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 0
		),
		array (
			'id' => 'single_shop_hero_section_bg_video',
			'type' => 'checkbox',
			'title' => __('Hero Section Enable Background Video', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 0
		),
		array (
			'id' => 'single_shop_hero_section_bg_video_mp4',
			'type' => 'text',
			'title' => __('Hero Section Video .MP4 Video File', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_shop_hero_section_bg_video_ogg',
			'type' => 'text',
			'title' => __('Hero Section Video .OGG Video File', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_shop_hero_section_bg_video_webm',
			'type' => 'text',
			'title' => __('Hero Section Video .Webm Video File', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_shop_hero_section_overlay',
			'type' => 'checkbox',
			'title' => __('Hero Section Enable Background Overlay', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => 0
		),
		array (
			'id' => 'single_shop_hero_section_bg_overlay_color',
			'type' => 'color',
			'title' => __('Hero Section Background Overlay Color', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_shop_hero_section_bg_overlay_opacity',
			'type' => 'text',
			'title' => __('Hero Section Background Overlay Opacity', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'std' => ''
		),
		array (
			'id' => 'single_shop_hero_section_container_wrap',
			'type' => 'radio',
			'title' => __('Wrap Content ?', 'be-themes'), 
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('' , 'be-themes'),
			'options'=> array('yes' => 'Yes', 'no' => 'No'),
			'std' => 'yes'
		),
		array (
			'id' => 'single_shop_hero_section_content',
			'type' => 'textarea',
			'title' => __('Hero Section content', 'be-themes'),
			'sub_desc' => __('', 'be-themes'),
			'desc' => __('', 'be-themes'),
			'validate' => 'html_custom',
			'std' => ''
		),
	)					
);
$tabs = array();

	global $NHP_Options;
	$NHP_Options = new NHP_Options($sections, $args, $tabs);

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';
	/*
	do your validation
	
	if(something){
		$value = $value;
	}elseif(somthing else){
		$error = true;
		$value = $existing_value;
		$field['msg'] = 'your custom error message';
	}
	*/
	
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function
?>