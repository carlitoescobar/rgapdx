<?php
/***************************************
				SITE LOGO			
***************************************/
if ( !function_exists( 'be_themes_get_header_logo_image' ) ) {
	function be_themes_get_header_logo_image() {
		global $be_themes_data;
		$logo = get_template_directory_uri().'/img/logo.png';
		if( ! empty( $be_themes_data['logo'] ) ) {
			$logo = $be_themes_data['logo'];
		}
		if( ! empty( $be_themes_data['logo_transparent'] )) {
			$logo_transparent = $be_themes_data['logo_transparent'];
		} else {
			$logo_transparent = $logo;
		}
		if( ! empty( $be_themes_data['logo_transparent_light'] )) {
			$logo_transparent_light = $be_themes_data['logo_transparent_light'];
		} else {
			$logo_transparent_light = $logo_transparent;
		}
		echo '<a href="'.home_url().'">';
			$post_id = be_get_page_id();
			if(is_singular( 'post' ) && is_single($post_id) && isset($be_themes_data['single_blog_hero_section_from']) && $be_themes_data['single_blog_hero_section_from'] == 'inherit_option_panel') {
				if(!empty($be_themes_data['single_blog_header_transparent']) && isset($be_themes_data['single_blog_header_transparent']) && $be_themes_data['single_blog_header_transparent'] ) {
					$header_transparent = $be_themes_data['single_blog_header_transparent'];
				} else {
					$header_transparent = 0;
				}
			} else if((in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_product($post_id)) && isset($be_themes_data['single_shop_hero_section_from']) && $be_themes_data['single_shop_hero_section_from'] == 'inherit_option_panel') {
				if(!empty($be_themes_data['single_shop_header_transparent']) && isset($be_themes_data['single_shop_header_transparent']) && $be_themes_data['single_shop_header_transparent'] ) {
					$header_transparent = $be_themes_data['single_shop_header_transparent'];
				} else {
					$header_transparent = 0;
				}
			} else {
				$header_transparent = get_post_meta($post_id, 'be_themes_header_transparent', true);
			}
			if(!empty($header_transparent) && isset($header_transparent) && $header_transparent) {
				echo '<img class="transparent-logo dark-scheme-logo" src="'.$logo_transparent.'" alt="" />';
				echo '<img class="transparent-logo light-scheme-logo" src="'.$logo_transparent_light.'" alt="" />';
				echo '<img class="normal-logo" src="'.$logo.'" alt="" />';
			} else {
				echo '<img class="normal-logo" src="'.$logo.'" alt="" />';
			}
		echo '</a>';
	}
}
/***************************************
			Header Cart Widget
***************************************/
if ( ! function_exists( 'be_themes_get_header_woocommerce_cart_widget' ) ) {
	function be_themes_get_header_woocommerce_cart_widget() {
		global $be_themes_data;
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && $be_themes_data['header_cart_widget'] ) {
			global $woocommerce; ?>
			<div class="header-cart-controls">
				<a class="cart-contents font-icon <?php echo ($woocommerce->cart->cart_contents_count) ? 'cart-no-empty' : 'cart-empty'; ?>" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><span><?php echo $woocommerce->cart->cart_contents_count;?></span></a>
				<div class="widget_shopping_cart_wrap">
					<?php the_widget('Be_Themes_WooCommerce_Widget_Cart'); ?>
				</div>
			</div> <?php
		}
	}
}
/***************************************
			Header Search Widget
***************************************/
if ( ! function_exists( 'be_themes_get_header_search_form_widget' ) ) {
	function be_themes_get_header_search_form_widget() {
		global $be_themes_data;
		if( !empty( $be_themes_data['header_search_box'] ) && 1 == $be_themes_data['header_search_box'] ) { ?>
			<div class="header-search-controls">
				<i class="search-button icon-search font-icon"></i>
				<div class="search-box-wrapper">
					<?php get_search_form(); ?>
				</div>
			</div>
			<?php
		}
	}
}
/***************************************
			Add Body Class
***************************************/
if ( ! function_exists( 'be_themes_add_body_class' ) ) {
	function be_themes_add_body_class( $classes ) {
		global $post;	
		global $be_themes_data;
		$post_id = be_get_page_id();
		if(is_singular( 'post' ) && is_single($post_id) && isset($be_themes_data['single_blog_hero_section_from']) && $be_themes_data['single_blog_hero_section_from'] == 'inherit_option_panel') {
			if(!empty($be_themes_data['single_blog_header_transparent']) && isset($be_themes_data['single_blog_header_transparent']) && $be_themes_data['single_blog_header_transparent'] ) {
				$header_transparent = $be_themes_data['single_blog_header_transparent'];
				$header_sticky = $be_themes_data['single_blog_header_sticky'];
			} else {
				$header_transparent = 0;
				$header_sticky = 0;
			}
		} else if((in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_product($post_id)) && isset($be_themes_data['single_shop_hero_section_from']) && $be_themes_data['single_shop_hero_section_from'] == 'inherit_option_panel') {
			if(!empty($be_themes_data['single_shop_header_transparent']) && isset($be_themes_data['single_shop_header_transparent']) && $be_themes_data['single_shop_header_transparent'] ) {
				$header_transparent = $be_themes_data['single_shop_header_transparent'];
				$header_sticky = $be_themes_data['single_shop_header_sticky'];
			} else {
				$header_transparent = 0;
				$header_sticky = 0;
			}
		} else {
			$header_transparent = get_post_meta($post_id, 'be_themes_header_transparent', true);
			$header_sticky = get_post_meta($post_id, 'be_themes_sticky_header', true);
		}
		if($header_sticky == 'inherit' || empty($header_sticky)) {
			if(!empty($header_transparent) && isset($header_transparent) && $header_transparent) {
				if( isset( $be_themes_data['sticky_header'] ) && 1 == $be_themes_data['sticky_header'] )  {
					$classes[] = 'transparent-sticky';
				}
			} else {
				if( isset( $be_themes_data['sticky_header'] ) && 1 == $be_themes_data['sticky_header'] )  {
					$classes[] = 'sticky-header';
				}
			}
		} else if($header_sticky == 'yes') {
			if(!empty($header_transparent) && isset($header_transparent) && $header_transparent) {
				$classes[] = 'transparent-sticky';
			} else {
				$classes[] = 'sticky-header';
			}
		}
		if($post_id == 0) {
			if( isset( $be_themes_data['sticky_header'] ) && 1 == $be_themes_data['sticky_header'] )  {
				$classes[] = 'sticky-header';
			}
		}
		if(!empty($header_transparent) && isset($header_transparent) && $header_transparent) {
			$classes[] = 'header-transparent';
		}
		$section_scroll = get_post_meta($post_id, 'be_themes_section_scroll', true);
		if(!empty($section_scroll) && isset($section_scroll) && $section_scroll) {
			$classes[] = 'section-scroll';
		}
		$single_page_version = get_post_meta($post_id, 'be_themes_single_page_version', true);
		if(!empty($single_page_version) && isset($single_page_version) && $single_page_version) {
			$classes[] = 'single-page-version';
		}
		/*if( isset( $be_themes_data['all_ajax'] ) && 1 == $be_themes_data['all_ajax'] )  {
			$classes[] = 'all-ajax-content';
		}*/
		if( isset( $be_themes_data['remove_smooth_scroll'] ) && 1 == $be_themes_data['remove_smooth_scroll'] )  {
			$classes[] = 'no-smooth-scroll';
		}
		if ( isset($be_themes_data['main_header_style']) && ('left' == $be_themes_data['main_header_style'] ) ) {
			$classes[] = 'left-header';	
		}
		return $classes;
	}
	add_filter('body_class','be_themes_add_body_class');
}

if (!function_exists( 'be_themes_calculate_logo_height' )) {
	function be_themes_calculate_logo_height(){
		global $be_themes_data;
		$result = array();
		$logo_src = $be_themes_data['logo'];
		$logo_transparent_src = $be_themes_data['logo_transparent'];
		if( empty( $logo_transparent_src ) ) {
			$logo_transparent_src = $logo_src;
		}
		$logo_id = get_attachment_id_from_src($logo_src);
		$logo_transparent_id = get_attachment_id_from_src($logo_transparent_src);
		$logo = wp_get_attachment_image_src($logo_id, 'full');
		$logo_transparent = wp_get_attachment_image_src($logo_transparent_id, 'full');
		$logo_height = $logo_transparent_height = 18;
		if( isset( $logo[2] ) || !empty( $logo[2] ) ) {
		  $logo_height = $logo[2];
		}
		if( isset( $logo_transparent[2] ) || !empty( $logo_transparent[2] ) ) {
		  $logo_transparent_height = $logo_transparent[2];
		}
		$result['logo_sticky_height'] = 40+$logo_height;
		$result['logo_height'] = 60+$logo_height;
		$result['logo_transparent_height'] = 60+$logo_transparent_height;
		return $result;
	}
}

/***************************************
			Navigations
***************************************/
if ( ! function_exists( 'be_themes_get_header_navigation' ) ) {
	function be_themes_get_header_navigation() {
		$defaults = array (
			'theme_location'=>'main_nav',
			'depth'=>3,
			'container_class'=>'menu left',
			'menu_id' => 'menu',
			'menu_class' => 'clearfix',
			'echo' => true,
			'fallback_cb' => 'be_themes_fallback_nav_menu',
			'walker' => new Be_Themes_Walker_Nav_Menu()
		);
		wp_nav_menu( $defaults );
	}
}
if ( ! function_exists( 'be_themes_get_header_mobile_navigation' ) ) {
	function be_themes_get_header_mobile_navigation() {
		$defaults = array (
			'theme_location'=> 'main_nav',
			'depth'=> 3,
			'container_class'=> 'mobile-menu',
			'menu_id' => 'mobile-menu',
			'menu_class' => 'clearfix',
			'fallback_cb' => '',
			'walker' => new Be_Themes_Walker_Nav_Mobile_Menu()
		);
		wp_nav_menu( $defaults );
	}
}
if ( ! function_exists( 'be_themes_get_header_sidebar_navigation' ) ) {
	function be_themes_get_header_sidebar_navigation() {
		global $be_themes_data;
		$menu_loc = 'sidebar_nav'; 
		if ( isset($be_themes_data['main_header_style']) && ('left' == $be_themes_data['main_header_style'] ) ) {
			$menu_loc = 'main_nav';
		}
		$defaults = array (
			'theme_location'=> $menu_loc,
			'depth'=> 3,
			'container_class'=> 'menu',
			'menu_id' => 'slidebar-menu',
			'menu_class' => 'clearfix',
			'fallback_cb' => '',
			'walker' => new Be_Themes_Walker_Nav_Menu()
		);
		wp_nav_menu( $defaults );
	}
}
if (!function_exists( 'be_themes_fallback_nav_menu' )) {
	function be_themes_fallback_nav_menu(){
		$args = array (
			'sort_column' => 'menu_order, post_title',
			'menu_class'  => 'menu left',
			'include'     => '',
			'exclude'     => '',
			'echo'        => true,
			'show_home'   => false,
			'link_before' => '',
			'link_after'  => '' 
		);
		wp_page_menu($args);
	}
}
if ( !class_exists('Be_Themes_Walker_Nav_Menu') ) {
    class Be_Themes_Walker_Nav_Menu extends Walker_Nav_Menu {
		function start_lvl(&$output, $depth=0, $args=array()) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<span class=\"mobile-sub-menu-controller\"><i class=\"icon-down-open-mini\"></i></span><ul class=\"sub-menu clearfix\">\n";
		}
	}
}
if ( !class_exists('Be_Themes_Walker_Nav_Mobile_Menu') ) {
    class Be_Themes_Walker_Nav_Mobile_Menu extends Walker_Nav_Menu {
		function start_lvl(&$output, $depth=0, $args=array()) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<span class=\"mobile-sub-menu-controller\"><i class=\"icon-down-open-mini\"></i></span><ul class=\"sub-menu clearfix\">\n";
		}
	}
}
?>