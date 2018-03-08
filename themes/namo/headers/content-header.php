<?php 
global $be_themes_data; 
$post_id = be_get_page_id();
if(is_singular( 'post' ) && is_single($post_id) && isset($be_themes_data['single_blog_hero_section_from']) && $be_themes_data['single_blog_hero_section_from'] == 'inherit_option_panel') {
	if(!empty($be_themes_data['single_blog_header_transparent']) && isset($be_themes_data['single_blog_header_transparent']) && $be_themes_data['single_blog_header_transparent'] ) {
		$header_transparent = $be_themes_data['single_blog_header_transparent'];
	} else {
		$header_transparent = 0;
	}
	if(!empty($be_themes_data['single_blog_header_transparent_color_scheme']) && isset($be_themes_data['single_blog_header_transparent_color_scheme']) && $be_themes_data['single_blog_header_transparent_color_scheme'] ) {
		$color_scheme = $be_themes_data['single_blog_header_transparent_color_scheme'];
	} else {
		$color_scheme = 'dark';
	}
	$hero_section = $be_themes_data['single_blog_hero_section'];
} else if((in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_product($post_id)) && isset($be_themes_data['single_shop_hero_section_from']) && $be_themes_data['single_shop_hero_section_from'] == 'inherit_option_panel') {
	if(!empty($be_themes_data['single_shop_header_transparent']) && isset($be_themes_data['single_shop_header_transparent']) && $be_themes_data['single_shop_header_transparent'] ) {
		$header_transparent = $be_themes_data['single_shop_header_transparent'];
	} else {
		$header_transparent = 0;
	}
	if(!empty($be_themes_data['single_shop_header_transparent_color_scheme']) && isset($be_themes_data['single_shop_header_transparent_color_scheme']) && $be_themes_data['single_shop_header_transparent_color_scheme'] ) {
		$color_scheme = $be_themes_data['single_shop_header_transparent_color_scheme'];
	} else {
		$color_scheme = 'dark';
	}
	$hero_section = $be_themes_data['single_shop_hero_section'];
} else {
	$header_transparent = get_post_meta($post_id, 'be_themes_header_transparent', true);
	$hero_section = get_post_meta($post_id, 'be_themes_hero_section', true);
	$color_scheme = get_post_meta($post_id, 'be_themes_header_transparent_color_scheme', true);
}
$header_class = $full_screen_header_scheme = '';
if((!empty($header_transparent) && isset($header_transparent) && $header_transparent) && (!empty($hero_section) && isset($hero_section) && $hero_section == 'custom')) {
	if(!empty($color_scheme) && isset($color_scheme) && $color_scheme) {
		if($color_scheme == 'dark') {
			$header_class = 'transparent background--light';
			$full_screen_header_scheme = 'data-headerscheme="background--light"';
		} else {
			$header_class = 'transparent background--dark';
			$full_screen_header_scheme = 'data-headerscheme="background--dark"';
		}
	}
}
?>
<header id="header">
	<div id="header-inner-wrap" class="<?php echo $header_class; ?>" <?php echo $full_screen_header_scheme; ?>>
		<?php
			extract(be_themes_calculate_logo_height());
			if((!empty($header_transparent) && isset($header_transparent) && $header_transparent)) {
				$default_header_height = $logo_transparent_height;
			} else {
				$default_header_height = $logo_height;
			}
		?>
		<div id="header-wrap" class="be-wrap clearfix" data-default-height="<?php echo $default_header_height; ?>" data-sticky-height="<?php echo $logo_sticky_height; ?>">
			<div id="logo">
				<?php be_themes_get_header_logo_image(); ?>
			</div>
			<div class="header-controls">
				<?php if(!isset($be_themes_data['show_sliderbar']) || $be_themes_data['show_sliderbar'] != 'no') { ?>
						<div class="menu-controls sliderbar-menu-controller right" title="Sidebar Menu Controller"><i class="font-icon icon-menu"></i></div>
				<?php } ?>
				<?php be_themes_get_header_woocommerce_cart_widget(); ?>
				<?php be_themes_get_header_search_form_widget(); ?>
				<?php if(!isset($be_themes_data['show_main_nav']) ||$be_themes_data['show_main_nav'] != 'no') { ?>
						<div class="mobile-nav-controller-wrap">
							<div class="menu-controls mobile-nav-controller" title="Mobile Menu Controller"><i class="font-icon icon-menu"></i></div>
						</div>
				<?php } ?>
			</div>
			<nav id="navigation" class="clearfix">	
				<?php 
					if(!isset($be_themes_data['show_main_nav']) || $be_themes_data['show_main_nav'] != 'no') {
						be_themes_get_header_navigation();
					}
				?>
			</nav><!-- End Navigation -->
		</div>
		<div class="clearfix">
			<?php  
				if(!isset($be_themes_data['show_main_nav']) || $be_themes_data['show_main_nav'] != 'no') {
					be_themes_get_header_mobile_navigation();
				}
			?>
		</div>
	</div>
</header> <!-- END HEADER -->