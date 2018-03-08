<?php

/**
 * The settings/dashboard-specific functionality of the plugin.
 *
 * @link       http://folkhack.com
 * @since      1.0.0
 *
 * @package    GFNoCaptchaReCaptcha
 * @subpackage GFNoCaptchaReCaptcha/admin
 */

/**
 * The settings/dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    GFNoCaptchaReCaptcha
 * @subpackage GFNoCaptchaReCaptcha/admin
 * @author     John Parks <john@folkhack.com>
 */
class GFNoCaptchaReCaptcha_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $GFNoCaptchaReCaptcha    The ID of this plugin.
     */
    private $GFNoCaptchaReCaptcha;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Name for private/public key options
     *
     * @since   1.0.0
     * @access  private
     * @var     string     $options_name    Name for options (ie: Private/public keys)
     */
    private $options_name;

    /**
     * Holds applicable setting option values (ie: private/public keys from settings page)
     *
     * @since   1.0.0
     * @access  private
     * @var     string     $options_values    Applicable setting option values (ie: private/public keys from settings page)
     */
    private $options_values;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     *
     * @param    string    $GFNoCaptchaReCaptcha    The name of this plugin.
     * @param    string    $version                 The version of this plugin.
     * @param    string    $options_name            Name for options (ie: Private/public keys)
     */
    public function __construct( $GFNoCaptchaReCaptcha, $version, $options_name ) {

        $this->GFNoCaptchaReCaptcha = $GFNoCaptchaReCaptcha;
        $this->version              = $version;
        $this->options_name         = $options_name;
        $this->options_values       = get_option( $this->options_name );
    }

    /**
     * Registers plugin settings, settings section, and setting fields
     *
     * @since   1.0.0
     * @access  public
     */
    public function settings_page_init() {

        // Register setting "$this->options_name"
         register_setting(
            'gf_nocaptcha_recaptcha_group',  // Option group
            $this->options_name,             // Option name
            array( $this, 'sanitize_input' ) // Sanitize_input
        );

        // Add section for settings
        add_settings_section(
            'gf_nocaptcha_recaptcha_section',                                        // ID
            __( 'Google No CAPTCHA reCAPTCHA Settings', 'gf-no-captcha-recaptcha' ), // Title
            array( $this, 'section_callback' ),                                      // Callback
            'gf-nocaptcha-settings-admin'                                            // Page
        );

        // Public key setting field
        add_settings_field(
            'public_key',                                             // ID
            __( 'Site (Public) Key:', 'gf-no-captcha-recaptcha' ),    // Title
            array( $this, 'public_key_field_callback' ),              // Callback
            'gf-nocaptcha-settings-admin',                            // Page
            'gf_nocaptcha_recaptcha_section'                          // Section
        );

        // Private key setting field
        add_settings_field(
            'private_key',                                            // ID
            __( 'Secret (Private) Key:', 'gf-no-captcha-recaptcha' ), // Title
            array( $this, 'private_key_field_callback' ),             // Callback
            'gf-nocaptcha-settings-admin',                            // Page
            'gf_nocaptcha_recaptcha_section'                          // Section
        );
    }

    /**
     * Registers settings page in "Settings" sidebar menu
     *
     * @since   1.0.0
     * @access  public
     */
    public function create_settings_menu_item() {

        add_options_page(
            'No CAPTCHA reCAPTCHA Settings',
            'No CAPTCHA reCAPTCHA',
            'manage_options',
            'gf-no-captcha-recaptcha-admin',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Creates plugin settings page by loading in admin display partial
     *
     * @since   1.0.0
     * @access  public
     */
    public function create_admin_page() {

        // Include dashboard partial
        include( 'partials/gf-no-captcha-recaptcha-admin-display.php' );
    }

    /**
     * Sanitizes input by stripping tags from public/private key
     *
     * @param    array    $input    Un-sanitized input array
     *
     * @since   1.0.0
     * @access  public
     *
     * @return   array    Sanitized array with public_key and private_key set
     */
    public function sanitize_input( $input )
    {
        $sanitize_inputd_input = array();

        $sanitize_inputd_input['public_key'] = ( isset( $input['public_key'] ) ) ?
            strip_tags( $input['public_key'] ) :
            '';

        $sanitize_inputd_input['private_key'] = ( isset( $input['private_key'] ) ) ?
            strip_tags( $input['private_key'] ) :
            '';

        return $sanitize_inputd_input;
    }

    /**
     * Renders section content for plugin settings
     *
     * @since   1.0.0
     * @access  public
     */
    public function section_callback() {

        echo __( 'Enter <a href="https://www.google.com/recaptcha" target="_blank">Google No CAPTCHA reCAPTCHA</a> key settings below:', 'gf-no-captcha-recaptcha' );
    }

    /**
     * Renders Public Key input field for plugin settings
     *
     * @since   1.0.0
     * @access  public
     */
    public function public_key_field_callback() {

        $val = isset( $this->options_values['public_key'] ) ?
            esc_attr( $this->options_values['public_key']) :
            '';

        echo '<input type="text" id="public_key" name="' . $this->options_name . '[public_key]" value="' . $val . '" />';
    }

    /**
     * Renders Private Key input field for plugin settings
     *
     * @since   1.0.0
     * @access  public
     */
    public function private_key_field_callback() {

        $val = isset( $this->options_values['private_key'] ) ?
            esc_attr( $this->options_values['private_key']) :
            '';

        echo '<input type="text" id="private_key" name="' . $this->options_name . '[private_key]" value="' . $val . '" />';
    }

    /**
     * Checks for public/private keys properly set, if not then displays an administration notification with link to settings page to set
     *
     * @since   1.0.0
     * @access  public
     */
    public function add_keys_notice() {

        if( is_admin() && current_user_can( 'manage_options' ) ) {

            if( ( ! isset( $this->options_values['public_key'] ) || empty( $this->options_values['public_key'] ) ) || ( ! isset( $this->options_values['private_key'] ) || empty( $this->options_values['private_key'] ) ) ) {

                echo '<div class="updated"><p>';

                // Message
                echo __( 'You must enter a private/public key for Gravity Forms Google No CAPTCHA reCAPTCHA to work! ', 'gf-no-captcha-recaptcha' );

                // Link to settings page
                echo '<a href="' . admin_url( 'options-general.php?page=gf-no-captcha-recaptcha-admin' ) . '">';
                echo __( 'Google No CAPTCHA reCAPTCHA Settings', 'gf-no-captcha-recaptcha' );
                echo '</a>';

                echo '</p></div>';
            }
        }
    }
}