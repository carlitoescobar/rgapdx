<?php
/**
 * Plugin Name: Restrict Content Pro - WooCommerce Member Discounts
 * Description: Give members automatic discounts on WooCommerce products based on their membership level.
 * Author: Restrict Content Pro Team
 * Author URI: https://restrictcontentpro.com/
 * Version: 1.0.2
 * Text Domain: rcp-woocommerce-member-discounts
 * Domain Path: languages
 */
namespace RCP\Addon\WooCommerceMemberDiscounts;

defined( 'WPINC' ) or die;

define( 'RCP_WC_MEMBER_DISCOUNTS_VERSION', '1.0.2' );
define( 'RCP_WC_MEMBER_DISCOUNTS_PATH', plugin_dir_path( __FILE__ ) );
define( 'RCP_WC_MEMBER_DISCOUNTS_URL', plugin_dir_url( __FILE__ ) );

/**
 * Loads the plugin files.
 */
function loader() {

	if ( ! defined( 'RCP_PLUGIN_VERSION' ) || version_compare( RCP_PLUGIN_VERSION, 2.6, '<' ) ) {
		add_action( 'admin_notices', '\RCP\Addon\WooCommerceMemberDiscounts\incompatible_version_notice' );
		return;
	}

	if ( ! function_exists( 'WC' ) ) {
		return;
	}

	require_once RCP_WC_MEMBER_DISCOUNTS_PATH . 'settings/coupon-panel.php';
	require_once RCP_WC_MEMBER_DISCOUNTS_PATH . 'class-discounts.php';

	$rcp_woo_discounts = new Discounts;
	$rcp_woo_discounts->hooks();
}
add_action( 'plugins_loaded', '\RCP\Addon\WooCommerceMemberDiscounts\loader', 12 );

/**
 * Displays an admin notice if using an incompatible version of RCP core.
 */
function incompatible_version_notice() {
	echo '<div class="error"><p>' . __( 'Restrict Content Pro - WooCommerce Member Discounts requires Restrict Content Pro version 2.6 or higher. Please upgrade Restrict Content Pro to the latest version.', 'rcp-woocommerce-member-discounts' ) . '</p></div>';
}

/**
 * Loads the plugin translation files.
 */
function textdomain() {
	load_plugin_textdomain( 'rcp-woocommerce-member-discounts', false, RCP_WC_MEMBER_DISCOUNTS_PATH . 'languages' );
}
add_action( 'plugins_loaded', '\RCP\Addon\WooCommerceMemberDiscounts\textdomain' );

/**
 * Loads the plugin updater.
 */
function plugin_updater() {
	if ( is_admin() && class_exists( 'RCP_Add_On_Updater' ) ) {
		new \RCP_Add_On_Updater( 23009, __FILE__, RCP_WC_MEMBER_DISCOUNTS_VERSION );
	}
}
add_action( 'plugins_loaded', '\RCP\Addon\WooCommerceMemberDiscounts\plugin_updater' );