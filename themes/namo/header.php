<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> 
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
	<![endif]-->

	<title><?php wp_title('&laquo;', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
	<?php
	global $be_themes_data; // Get Backend Options
		if($be_themes_data['favicon']) {
			echo '<link rel="icon" type="image/png" href="'.$be_themes_data['favicon'].'">';
		}
	?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri() ?>">

    <?php 
    	if ( is_singular() ) { 
    		wp_enqueue_script( 'comment-reply' );
    	}
    	wp_head(); 
    ?>
</head>
<?php
	$sidebar_class = 'sb-right'; 
	if ( isset($be_themes_data['main_header_style']) && ('left' == $be_themes_data['main_header_style'] ) ) {
		$sidebar_class = 'sb-left';
	}
?>
<body <?php body_class(); ?>>		
	<div class="sb-slidebar <?php echo $sidebar_class; ?>">
		<?php if (('sb-left' == $sidebar_class) || (('sb-right' == $sidebar_class) && (!isset($be_themes_data['show_sliderbar']) || $be_themes_data['show_sliderbar'] != 'no') ) ) { ?>
			<div id="sb-slidebar-content" class="sb-slidebar-content ajaxable">
				<?php 
					if( ! empty( $be_themes_data['logo_sidebar'] )) {
						$logo_sidebar = $be_themes_data['logo_sidebar'];
						echo '<div id="logo-sidebar"><a href="'.home_url().'"><img class="transparent-logo dark-scheme-logo" src="'.$logo_sidebar.'" alt="" /></a></div>';
					}
					be_themes_get_header_sidebar_navigation();
					if (is_active_sidebar( 'sliderbar-area' ) ) {
						dynamic_sidebar( 'sliderbar-area' );
					}
				?>
			</div>
		<?php } ?>
	</div>
	<div id="main-wrapper">
		<div id="main" class="ajaxable <?php echo $be_themes_data['layout']; ?>" >
			<?php
				$post_id = be_get_page_id();
				if(is_singular( 'post' ) && is_single($post_id) && isset($be_themes_data['single_blog_hero_section_from']) && $be_themes_data['single_blog_hero_section_from'] == 'inherit_option_panel') {
					if(!empty($be_themes_data['single_blog_hero_section_position']) && isset($be_themes_data['single_blog_hero_section_position']) && $be_themes_data['single_blog_hero_section_position'] ) {
						$top_section_position = $be_themes_data['single_blog_hero_section_position'];
					} else {
						$top_section_position = 'after';
					}
					if(!empty($be_themes_data['single_blog_header_transparent']) && isset($be_themes_data['single_blog_header_transparent']) && $be_themes_data['single_blog_header_transparent'] ) {
						$header_transparent = $be_themes_data['single_blog_header_transparent'];
					} else {
						$header_transparent = 0;
					}
				} else if((in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_product($post_id)) && isset($be_themes_data['single_shop_hero_section_from']) && $be_themes_data['single_shop_hero_section_from'] == 'inherit_option_panel') {
					if(!empty($be_themes_data['single_shop_hero_section_position']) && isset($be_themes_data['single_shop_hero_section_position']) && $be_themes_data['single_shop_hero_section_position'] ) {
						$top_section_position = $be_themes_data['single_shop_hero_section_position'];
					} else {
						$top_section_position = 'after';
					}
					if(!empty($be_themes_data['single_shop_header_transparent']) && isset($be_themes_data['single_shop_header_transparent']) && $be_themes_data['single_shop_header_transparent'] ) {
						$header_transparent = $be_themes_data['single_shop_header_transparent'];
					} else {
						$header_transparent = 0;
					}
				} else {
					$top_section_position = get_post_meta($post_id, 'be_themes_hero_section_position', true);
					$header_transparent = get_post_meta($post_id, 'be_themes_header_transparent', true);
				}
				if($top_section_position == 'before' && !(!empty($header_transparent) && isset($header_transparent) && $header_transparent)) {
					get_template_part( 'headers/top', 'section' );
				}
				get_template_part( 'headers/content', 'header' );
				if($top_section_position != 'before' || (!empty($header_transparent) && isset($header_transparent) && $header_transparent)) {
					get_template_part( 'headers/top', 'section' );
				}
			?>