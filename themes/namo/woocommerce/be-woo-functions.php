<?php
if( class_exists('Woocommerce') ) {
	if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	} else {
		define( 'WOOCOMMERCE_USE_CSS', false );
	}


	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
	remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 11 );

	$be_themes_data = get_option(PREMIUM_THEME_NAME);

	if (!function_exists('be_themes_add_custom_styles_scripts')) {
		function be_themes_add_custom_styles_scripts() {
			wp_register_style( 'be-themes-woocommerce-css', get_template_directory_uri() . '/woocommerce/woocommerce.css' );
			wp_enqueue_style( 'be-themes-woocommerce-css' );
			
			wp_deregister_script( 'be-themes-woocommerce-js' );
			wp_register_script( 'be-themes-woocommerce-js', get_template_directory_uri() . '/woocommerce/woocommerce.js', array( 'jquery','be-themes-plugins-js'), FALSE, TRUE );
			wp_enqueue_script( 'be-themes-woocommerce-js' );
		}
		add_action( 'wp_enqueue_scripts', 'be_themes_add_custom_styles_scripts' );
	}
	if ( ! function_exists('be_woo_remove_default_lightbox_js')) {
		function be_woo_remove_default_lightbox_js() {
			remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
	        wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
	        wp_dequeue_script( 'prettyPhoto' );
	        wp_dequeue_script( 'prettyPhoto-init' );
		}
		add_action( 'wp_print_scripts', 'be_woo_remove_default_lightbox_js', 99 );
	}

	if( !empty( $be_themes_data['show_sidebar_on_shop_page'] ) && 1 == $be_themes_data['show_sidebar_on_shop_page'] ) {
		add_action('woocommerce_after_main_content', 'woocommerce_get_sidebar', 11);
		add_action('woocommerce_after_main_content', 'be_woo_after_main_content', 10);
	}


	if ( ! function_exists('be_woo_before_shop_loop')) {
		function be_woo_before_shop_loop() {
			echo '<div class="clear"></div><div class="products-wrap"><hr class="separator style-1">';
		}
		add_action('woocommerce_before_shop_loop', 'be_woo_before_shop_loop', 30);
	}
	if ( ! function_exists('be_woo_after_shop_loop')) {
		function be_woo_after_shop_loop() {
			echo '</div>';
		}
		add_action('woocommerce_after_shop_loop', 'be_woo_after_shop_loop', 30);
	}

	if ( ! function_exists('be_woo_before_main_content_shop_page_content')) {
		function be_woo_before_main_content_shop_page_content() {
			$shop_query = new WP_Query( array('page_id' => get_option('woocommerce_shop_page_id')));
		    while ( $shop_query->have_posts() ) : $shop_query->the_post();
		   		if( is_shop()) {
		        	the_content();
		        }
		    endwhile;
		    wp_reset_query();
		}
		add_action('woocommerce_before_main_content', 'be_woo_before_main_content_shop_page_content', 10);
	}
	if ( ! function_exists('be_woo_before_main_content_start')) {
		function be_woo_before_main_content_start() {
		    global $be_themes_data;
			echo '<section id="content" class="right-sidebar-page">';
			echo '<div id="content-wrap" class="be-wrap clearfix">';
			if((!empty($be_themes_data['show_sidebar_on_shop_page']) && 1 == $be_themes_data['show_sidebar_on_shop_page'] ) && ! is_product()) {
				echo '<section id="page-content" class="content-single-sidebar three-col-product">';
			} else {
				echo '<section>';
			}
		}
		add_action('woocommerce_before_main_content', 'be_woo_before_main_content_start', 10);
	}
	if ( ! function_exists('be_woo_after_main_content_end')) {
		function be_woo_after_main_content_end() {
			echo '</section></div></section>';
		}
		add_action('woocommerce_after_main_content', 'be_woo_after_main_content_end', 11);
	}
	if ( ! function_exists('be_woo_single_product_before_images')) {
		function be_woo_single_product_before_images() {
			echo '<div class="clearfix product-single-boxed-content">';
		}
		add_action('woocommerce_before_single_product_summary', 'be_woo_single_product_before_images', 1 );
	}

	if ( ! function_exists('be_woo_single_product_after_summmary')) {
		function be_woo_single_product_after_summmary() {
			echo '</div>';
		}
		add_action('woocommerce_after_single_product_summary', 'be_woo_single_product_after_summmary', 9);
	}
	if ( ! function_exists('be_woo_before_ajax_add_to_cart')) {
		function be_woo_before_ajax_add_to_cart() {
			echo '</a><div class="button_ajax_wrapper clearfix">';
		}
		add_action('woocommerce_after_shop_loop_item_title', 'be_woo_before_ajax_add_to_cart', 10);
	}
	if ( ! function_exists('be_woo_after_main_content')) {
		function be_woo_after_main_content() {
			echo '</section><section id="right-sidebar" class="sidebar-widgets">';
		}
	}
	if ( ! function_exists('be_woo_after_shop_loop_item')) {
		function be_woo_after_shop_loop_item() {
			echo '</div>';
		}
		add_action('woocommerce_after_shop_loop_item', 'be_woo_after_shop_loop_item', 10);
	}
	if ( ! function_exists('be_woo_before_shop_loop_item_title_before_thumbnail')) {
		function be_woo_before_shop_loop_item_title_before_thumbnail() {
			echo '</a><div class="product-thumbnail-image-wrap"><a href="'.get_permalink(get_the_ID()).'">';
		}
		add_action('woocommerce_before_shop_loop_item_title', 'be_woo_before_shop_loop_item_title_before_thumbnail', 9);
	}
	if ( ! function_exists('be_woo_before_shop_loop_item_title')) {
		function be_woo_before_shop_loop_item_title() {
			echo '</a></div><div class="product-meta-data"><a href="'.get_permalink(get_the_ID()).'">';
		}
		add_action('woocommerce_before_shop_loop_item_title', 'be_woo_before_shop_loop_item_title', 10);
	}
	if ( ! function_exists('be_woo_after_shop_loop_item_title')) {
		function be_woo_after_shop_loop_item_title() {
			echo '</div><a href="#">';
		}
		add_action('woocommerce_after_shop_loop_item_title', 'be_woo_after_shop_loop_item_title', 12);
	}
	if ( ! function_exists('be_woo_product_add_to_cart_text')) {
		function be_woo_product_add_to_cart_text() {
			return __( '', 'woocommerce' );
		}
		add_action('woocommerce_product_add_to_cart_text', 'be_woo_product_add_to_cart_text');
	}


	if (!function_exists('be_woo_product_loop_row_columns')) {
		function be_woo_product_loop_row_columns() {
			global $be_themes_data;
			if( !empty($be_themes_data['show_sidebar_on_shop_page']) && 1 == $be_themes_data['show_sidebar_on_shop_page'] ) {
				return 3;
			} else {
				return 4;
			}
		}
		add_filter('loop_shop_columns', 'be_woo_product_loop_row_columns');
	}
	if (!function_exists('be_woo_single_product_images_columns')) {
		function be_woo_single_product_images_columns() {
			return 5;
		}
		add_filter('woocommerce_product_thumbnails_columns', 'be_woo_single_product_images_columns');
	}


	if (!function_exists('be_woo_ajax_fragment')) {
		function be_woo_ajax_fragment( $fragments ) {
			global $woocommerce;
			ob_start(); ?>
			<a class="cart-contents font-icon <?php echo ($woocommerce->cart->cart_contents_count) ? 'cart-no-empty' : 'cart-empty'; ?>" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><span><?php echo $woocommerce->cart->cart_contents_count;?></span></a> <?php
			$fragments['a.cart-contents'] = ob_get_clean();
			return $fragments;
		}
		add_filter('add_to_cart_fragments', 'be_woo_ajax_fragment');
	}
	if($be_themes_data['number_of_products_per_page']) {
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.intval($be_themes_data['number_of_products_per_page']).';' ), 20 );
	}
	if (!function_exists('be_themes_add_dropdown_styles')) {
		function be_themes_add_dropdown_styles() {
			global $woocommerce;
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			wp_enqueue_script( 'wc-chosen', $woocommerce->plugin_url() . '/assets/js/frontend/chosen-frontend' . $suffix . '.js', array( 'chosen' ), FALSE, true );
			wp_enqueue_style( 'woocommerce_chosen_styles', $woocommerce->plugin_url() . '/assets/css/chosen.css' );
		}
		add_action( 'wp_enqueue_scripts', 'be_themes_add_dropdown_styles', 99 );
	}

	add_action( 'widgets_init', 'override_woocommerce_widgets', 15 );
	function override_woocommerce_widgets() { 
	  	if ( class_exists( 'WC_Widget_Cart' ) ) {
	    	require_once( get_template_directory() .'/woocommerce/class-wc-widget-cart.php' );
	    	register_widget( 'Be_Themes_WooCommerce_Widget_Cart' );
	  	} 
	}
	if (!function_exists('be_related_products_args')) {
			function be_related_products_args( $args ) {

			$args['posts_per_page'] = 4; // 4 related products
			$args['columns'] = 4; // arranged in 2 columns
			return $args;
		}
		add_filter( 'woocommerce_output_related_products_args', 'be_related_products_args' );
	}
}
?>