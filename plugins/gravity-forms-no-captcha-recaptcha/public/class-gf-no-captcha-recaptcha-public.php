<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://folkhack.com
 * @since      1.0.0
 *
 * @package    GFNoCaptchaReCaptcha
 * @subpackage GFNoCaptchaReCaptcha/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    GFNoCaptchaReCaptcha
 * @subpackage GFNoCaptchaReCaptcha/public
 * @author     John Parks <john@folkhack.com>
 */
class GFNoCaptchaReCaptcha_Public {

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
     * Name for Gravity Forms new field type
     *
     * @since   1.0.0
     * @access  private
     * @var     string     $gravity_forms_field_type    Gravity Forms new field type
     */
    private $gravity_forms_field_type;

    /**
     * Public Google No CAPTCHA reCAPTCHA key
     *
     * @since   1.0.0
     * @access  private
     * @var     string     $google_public_key    Public Google No CAPTCHA reCAPTCHA key
     */
    private $google_public_key;

    /**
     * Private Google No CAPTCHA reCAPTCHA key
     *
     * @since   1.0.0
     * @access  private
     * @var     string     $google_public_key    Private Google No CAPTCHA reCAPTCHA key
     */
    private $google_private_key;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     *
     * @param    string    $GFNoCaptchaReCaptcha    The name of the plugin.
     * @param    string    $version                 The version of this plugin.
     * @param    string    $options_name            Name for options (ie: Private/public keys)
     *
     */
    public function __construct( $GFNoCaptchaReCaptcha, $version, $options_name ) {

        $this->GFNoCaptchaReCaptcha     = $GFNoCaptchaReCaptcha;
        $this->version                  = $version;
        $this->options_name             = $options_name;
        $this->options_values           = get_option( $options_name );
        $this->google_public_key        = $this->options_values['public_key'];
        $this->google_private_key       = $this->options_values['private_key'];
        $this->gravity_forms_field_type = 'gf_no_captcha_recaptcha';
    }

    /**
     * Filter to add "No CAPTCHA" button to "Advanced Fields" section in Gravity Forms form editor
     *
     * @since    1.0.0
     * @access   public
     *
     * @param    array    $field_groups    The array to be filtered. It contains the field groups (i.e. Standard Fields, Advanced Fields, etc...)
     *
     * @return   array    $field_groups with "No CAPTCHA" button array added
     */
    public function gravity_forms_field( $field_groups ) {

        foreach( $field_groups as &$group ){

            if( $group['name'] == 'advanced_fields' ) {

                $group['fields'][] = array(
                    'class'   => 'button',
                    'value'   => __( 'No CAPTCHA', 'gf-no-captcha-recaptcha'),
                    'onclick' => 'StartAddField(\'' . $this->gravity_forms_field_type . '\');'
                );

                break;
            }
        }

        return $field_groups;
    }

    /**
     * Filter to configure field title for "No CAPTCHA" field within Gravity Forms form editor
     *
     * @since     1.0.0
     * @access    public
     *
     * @param     string    $type    Title to be filtered. Defaults to the field type
     *
     * @return    string    New title of field type
     */
    public function gravity_forms_field_title( $type ) {

        if ( $type == $this->gravity_forms_field_type ) {

            return __( 'No CAPTCHA reCAPTCHA', 'gf-no-captcha-recaptcha' );
        }
    }

    /**
     * Action to override "No CAPTCHA" input field output. Outputs "g-recaptcha" div wrapped in ginput_container if not logged in (needs CAPTCHA)
     *
     * @since    1.0.0
     * @access   public
     *
     * @param    string   $input      Input tag string to be filtered
     * @param    array    $field      (Field Object) The Field Object that this input tag applies to
     * @param    string   $value      Default/initial value that the field should be pre-populated with
     * @param    int      $lead_id    On entry detail screen, $lead_id will be populated with the Entry ID. Otherwise, it will be 0
     * @param    int      $form_id    The current Form ID
     *
     * @return   string   Returns either Google reCAPTCHA div wrapped in ginput_container div if non-admin or nothing if admin
     */
    public function gravity_forms_field_input( $input, $field, $value, $lead_id, $form_id ) {

        if ( $field['type'] == $this->gravity_forms_field_type ) {

            // Ensure not admin, and public/private keys exist before adding in form DIV
            if( ! is_admin() && ! empty( $this->google_public_key ) && ! empty( $this->google_private_key ) ) {

                // Public site key
                $site_key = esc_html( $this->google_public_key );

                // CAPTCHA Theme
                $theme = ( isset( $field['recaptcha_theme'] ) && ! empty( $field['recaptcha_theme'] ) ) ?
                    esc_html( $field['recaptcha_theme'] ) :
                    'light';

                // Public sees CAPTCHA field
                return '<div class="ginput_container"><div class="g-recaptcha" data-sitekey="' . $site_key . '" data-theme="' . $theme . '"></div></div>';

            } else {

                // Do not display field if admin or missing public/private keys
                return '';
            }
        }

        return $input;
    }

    /**
     *
     * Action to inject "No CAPTCHA" field JS into the Gravity Forms editor page
     *
     * @since    1.0.0
     * @access   public
     *
     */
    public function gravity_forms_field_editor_js() {

        include 'partials/gf-no-captcha-recaptcha-public-gforms-editor-js.php';
    }

    /**
     *
     * Action to add "theme" dropdown to Gravity Forms editor page for CAPTCHA theme setting
     *
     * @since    1.0.2
     * @access   public
     *
     */
    public function gravity_forms_add_theme_setting( $position, $form_id ) {

        // Create setting on position 0 (first item on "Advanced" tab)
        if( $position == 0 ) {

            // Include the dropdown partial
            include 'partials/gf-no-captcha-recaptcha-public-theme-dropdown.php';
        }
    }

    /**
     * Action to enque Google reCAPTCHA external API JS if there is a "No CAPTCHA" field in current form
     *
     * @since    1.0.0
     * @access   public
     *
     * @param    array      $form    (Form Object) Current Form Object
     * @param    boolean    $ajax    Specifies if form is configured to be submitted via AJAX
     *
     */
    public function gravity_forms_recaptcha_api_enqueue_script( $form, $ajax ) {

        // cycle through fields to see if tos is being used
        foreach( $form['fields'] as $field ) {

            if( ( $field['type'] == $this->gravity_forms_field_type ) && ! empty( $this->google_public_key ) ) {

                // Enqueue External API JS
                wp_enqueue_script( 'no_captcha_recaptcha_api', 'https://www.google.com/recaptcha/api.js?render=explicit', array(), '', true );

                // Enqueue Internal JS (renders CAPTCHA explicitly - maintains AJAX submission compatibility)
                wp_enqueue_script( 'no_captcha_recaptcha_internal', plugin_dir_url( __FILE__ ) . 'js/gf-no-captcha-recaptcha-public.js', array( 'jquery', 'no_captcha_recaptcha_api' ) );

                break;
            }
        }
    }

    /**
     * Filter to add custom validation logic for "No CAPTCHA" input
     *
     * @since    1.0.0
     * @access   public
     *
     * @param    array     $result    The validation result to be filtered
     * @param    string    $value     The field value to be validated
     * @param    array     $form      (Form Object) Current Form object
     * @param    array     $field     (Field Object) Current Field object
     *
     * @return   array     $result with 'is_valid' set to true on success or 'message' and 'is_valid' as error message and false respectively
     */
    public function gravity_forms_validate( $result, $value, $form, $field ) {

        if( $field['type'] == $this->gravity_forms_field_type ) {

            // Check to ensure POST challenge is included
            if( isset( $_POST['g-recaptcha-response'] ) && ! empty( $_POST['g-recaptcha-response'] ) && ! empty( $this->google_private_key ) ) {

                $recaptcha_response = urlencode( $_POST['g-recaptcha-response'] );
                $user_ip            = $_SERVER['REMOTE_ADDR'];
                $verify_url         = $this->sanitize_url( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $this->google_private_key . '&response=' . $recaptcha_response . '&remoteip=' . $user_ip );
                $json_response      = file_get_contents( $verify_url );

                if( ! empty( $json_response ) && $result = json_decode( $json_response, true ) ) {

                    if( isset( $result['success'] ) && $result['success'] == true ) {

                        $result['is_valid'] = true;

                        return $result;
                    }
                }
            }

            $result['message']  = __( 'CAPTCHA failed. Please try again!', 'gf-no-captcha-recaptcha' );
            $result['is_valid'] = false;
        }

        return $result;
    }

    /**
     * Sanitize/filter URL helper function
     *
     * @since     1.0.0
     * @access    private
     *
     * @param     string    $url    URL to be sanitized
     *
     * @return    string    Sanitized URL via "filter_var" FILTER_SANITIZE_URL
     */
    private function sanitize_url( $url ) {

        return filter_var( $url, FILTER_SANITIZE_URL, FILTER_FLAG_SCHEME_REQUIRED );
    }
}
