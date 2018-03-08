<?php
/**
 * Plugin Name:     Restrict Content Pro - MailChimp Pro
 * Plugin URI:      https://restrictcontentpro.com/downloads/mailchimp-pro/
 * Description:     Include a MailChimp signup option with your RCP registration form
 * Version:         1.4.1
 * Author:          Restrict Content Pro Team
 * Text Domain:     rcp-mailchimp-pro
 *
 * @package         RCP\MailChimpPro
 * @author          Daniel J Griffiths <dgriffiths@section214.com>
 * @copyright       Copyright (c) 2015, Daniel J Griffiths
 */


// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
	exit;
}


if( ! class_exists( 'RCP_MailChimp_Pro' ) ) {


	/**
	 * Main RCP_MailChimp_Pro class
	 *
	 * @since       1.0.0
	 */
	class RCP_MailChimp_Pro {


		/**
		 * @var         RCP_MailChimp_Pro $instance The one true RCP_MailChimp_Pro
		 * @since       1.0.0
		 */
		private static $instance;


		/**
		 * @var         object $api_helper The MailChimp API helper object
		 * @since       1.0.0
		 */
		public $api_helper;


		/**
		 * @var         object $settings The settings object
		 * @since       1.2.3
		 */
		public $settings;


		/**
		 * Get active instance
		 *
		 * @access      public
		 * @since       1.0.0
		 * @return      object self::$instance The one true RCP_MailChimp_Pro
		 */
		public static function instance() {
			if( ! self::$instance ) {
				self::$instance = new RCP_MailChimp_Pro();
				self::$instance->setup_constants();
				self::$instance->includes();
				self::$instance->load_textdomain();
				self::$instance->hooks();
				self::$instance->api_helper = new RCP_MailChimp_Pro_API();
			}

			return self::$instance;
		}


		/**
		 * Setup plugin constants
		 *
		 * @access      private
		 * @since       1.0.0
		 * @return      void
		 */
		public function setup_constants() {
			// Plugin version
			define( 'RCP_MAILCHIMP_PRO_VER', '1.4.1' );

			// Plugin path
			define( 'RCP_MAILCHIMP_PRO_DIR', plugin_dir_path( __FILE__ ) );

			// Plugin URL
			define( 'RCP_MAILCHIMP_PRO_URL', plugin_dir_url( __FILE__ ) );

			// Plugin file
			define( 'RCP_MAILCHIMP_PRO_FILE', __FILE__ );
		}


		/**
		 * Include necessary files
		 *
		 * @access      private
		 * @since       1.0.0
		 * @return      void
		 */
		private function includes() {
			global $rcp_mailchimp_pro_options;

			// Load settings
			require_once RCP_MAILCHIMP_PRO_DIR . 'includes/admin/settings/register.php';

			if( ! class_exists( 'S214_Settings' ) ) {
				require_once RCP_MAILCHIMP_PRO_DIR . 'includes/libraries/s214-settings/class.s214-settings.php';
			}
			$this->settings            = new S214_Settings( 'rcp_mailchimp_pro' );
			$rcp_mailchimp_pro_options = $this->settings->get_settings();

			require_once RCP_MAILCHIMP_PRO_DIR . 'includes/functions.php';
			require_once RCP_MAILCHIMP_PRO_DIR . 'includes/class.mailchimp-api.php';
		}


		/**
		 * Run action and filter hooks
		 *
		 * @access      private
		 * @since       1.0.0
		 * @return      void
		 */
		private function hooks() {
			// Add the subscription checkbox
			add_action( 'rcp_before_registration_submit_field', array( $this, 'add_fields' ), 100 );

			// Display the signed up notice
			add_action( 'rcp_edit_member_after', array( $this, 'display_signup_notice' ) );

			// Enqueue Scripts
			add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );

			// Set up updater.
			if( class_exists( 'RCP_Add_On_Updater' ) ) {
				$updater = new RCP_Add_On_Updater( 133, __FILE__, RCP_MAILCHIMP_PRO_VER );
			}
		}


		/**
		 * Internationalization
		 *
		 * @access      public
		 * @since       1.0.0
		 * @return      void
		 */
		public static function load_textdomain() {
			// Set filter for language directory
			$lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
			$lang_dir = apply_filters( 'rcp_mailchimp_pro_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'rcp-mailchimp-pro' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'rcp-mailchimp-pro', $locale );

			// Setup paths to current locale file
			$mofile_local  = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/rcp-mailchimp-pro/' . $mofile;

			if( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/rcp-mailchimp-pro/ folder
				load_textdomain( 'rcp-mailchimp-pro', $mofile_global );
			} elseif( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/rcp-mailchimp-pro/languages/ folder
				load_textdomain( 'rcp-mailchimp-pro', $mofile_local );
			} else {
				// Load the default language files
				load_plugin_textdomain( 'rcp-mailchimp-pro', false, $lang_dir );
			}
		}


		/**
		 * Enqueue scripts
		 *
		 * @access      public
		 * @since       1.2.3
		 * @return      void
		 */
		public function scripts() {
			wp_enqueue_script( 'rcp-mailchimp-pro', RCP_MAILCHIMP_PRO_URL . '/assets/js/admin.js', array( 'wp-util', 'jquery' ), RCP_MAILCHIMP_PRO_VER );
			wp_localize_script( 'rcp-mailchimp-pro', 'rcp_mailchimp_pro_vars', array(
				'nonce' => wp_create_nonce( 'settings' )
			) );
		}


		/**
		 * Add the subscription field to the registration form
		 *
		 * @access      public
		 * @since       1.0.0
		 * @return      void
		 */
		public function add_fields() {
			ob_start();
			if( rcp_mailchimp_pro_show_checkbox() ) {
				$settings = get_option( 'rcp_mailchimp_pro_settings' );

				if( isset( $settings['auto_subscribe'] ) ) {
					echo '<input id="rcp_mailchimp_pro_signup" name="rcp_mailchimp_pro_signup" type="hidden" value="true" />';
				} else {
					echo '<p>';
					echo '<input id="rcp_mailchimp_pro_signup" name="rcp_mailchimp_pro_signup" type="checkbox" checked="checked" />';
					echo '<label for="rcp_mailchimp_pro_signup">' . ( isset( $settings['signup_label'] ) && ! empty( $settings['signup_label'] ) ? $settings['signup_label'] : __( 'Signup for Newsletter', 'rcp-mailchimp-pro' ) ) . '</label>';
					echo '</p>';
				}
			}
			echo ob_get_clean();
		}


		/**
		 * Display a signed up notice if user has subscribed
		 *
		 * @access      public
		 * @since       1.0.0
		 * @param       int $user_id The user ID of this user
		 * @return      void
		 */
		public function display_signup_notice( $user_id ) {
			$signed_up = get_user_meta( $user_id, 'rcp_subscribed_to_mailchimp', true );
			$signed_up = ( $signed_up ? __( 'Yes', 'rcp-mailchimp-pro' ) : __( 'No', 'rcp-mailchimp-pro' ) );

			echo '<tr class="form-field">';
			echo '<th scope="row" valign="top">' . __( 'MailChimp', 'rcp-mailchimp-pro' ) . '</th>';
			echo '<td>' . $signed_up . '</td>';
			echo '</tr>';
		}
	}
}


/**
 * The main function responsible for returning the one true RCP_MailChimp_Pro
 * instance to functions everywhere
 *
 * @since       1.0.0
 * @return      RCP_MailChimp_Pro The one true RCP_MailChimp_Pro
 */
function rcp_mailchimp_pro() {
	if ( ! defined( 'RCP_PLUGIN_VERSION' ) || version_compare( RCP_PLUGIN_VERSION, '2.9', '<' ) ) {
		add_action( 'admin_notices', 'rcp_mailchimp_pro_rcp_requirements_notice' );
		return;
	}
	return RCP_MailChimp_Pro::instance();
}
add_action( 'plugins_loaded', 'rcp_mailchimp_pro' );

/**
 * Displays an admin notice if using an incompatible version of RCP core.
 *
 * @since 1.4
 */
function rcp_mailchimp_pro_rcp_requirements_notice() {
	echo '<div class="error"><p>' . __( 'MailChimp Pro requires Restrict Content Pro version 2.9 or higher. Please upgrade Restrict Content Pro to the latest version.', 'rcp-mailchimp-pro' ) . '</p></div>';
}