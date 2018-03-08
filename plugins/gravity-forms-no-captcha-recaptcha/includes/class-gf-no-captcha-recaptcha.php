<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @link       http://folkhack.com
 * @since      1.0.0
 *
 * @package    GFNoCaptchaReCaptcha
 * @subpackage GFNoCaptchaReCaptcha/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, dashboard-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    GFNoCaptchaReCaptcha
 * @subpackage GFNoCaptchaReCaptcha/includes
 * @author     John Parks <john@folkhack.com>
 */
class GFNoCaptchaReCaptcha {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      GFNoCaptchaReCaptcha_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $GFNoCaptchaReCaptcha    The string used to uniquely identify this plugin.
     */
    protected $GFNoCaptchaReCaptcha;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Name for private/public key options
     *
     * @since   1.0.0
     * @access  private
     * @var     string     $options_name    Name for options (ie: Private/public keys)
     */
    private $options_name;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the Dashboard and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {

        $this->GFNoCaptchaReCaptcha = 'gf-no-captcha-recaptcha';
        $this->version              = '1.0.0';
        $this->options_name         = 'gf_nocaptcha_recaptcha_options';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - GFNoCaptchaReCaptcha_Loader. Orchestrates the hooks of the plugin.
     * - GFNoCaptchaReCaptcha_i18n. Defines internationalization functionality.
     * - GFNoCaptchaReCaptcha_Admin. Defines all hooks for the dashboard.
     * - GFNoCaptchaReCaptcha_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-gf-no-captcha-recaptcha-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-gf-no-captcha-recaptcha-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the Dashboard.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-gf-no-captcha-recaptcha-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gf-no-captcha-recaptcha-public.php';

        $this->loader = new GFNoCaptchaReCaptcha_Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the GFNoCaptchaReCaptcha_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {

        $plugin_i18n = new GFNoCaptchaReCaptcha_i18n();
        $plugin_i18n->set_domain( $this->get_GFNoCaptchaReCaptcha() );

        $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

    }

    /**
     * Register all of the hooks related to the dashboard functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {

        $plugin_admin = new GFNoCaptchaReCaptcha_Admin( $this->get_GFNoCaptchaReCaptcha(), $this->get_version(), $this->get_options_name() );

        // Hook into correct admnistrative actions for settings page (private/public key options):
        $this->loader->add_action( 'admin_init',    $plugin_admin, 'settings_page_init' );
        $this->loader->add_action( 'admin_menu',    $plugin_admin, 'create_settings_menu_item' );
        $this->loader->add_action( 'admin_notices', $plugin_admin, 'add_keys_notice' );
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {

        $plugin_public = new GFNoCaptchaReCaptcha_Public( $this->get_GFNoCaptchaReCaptcha(), $this->get_version(), $this->get_options_name() );

        // Hook into correct filters/actions for Gravity Forms application logic:
        $this->loader->add_filter( 'gform_add_field_buttons',       $plugin_public, 'gravity_forms_field' );
        $this->loader->add_filter( 'gform_field_type_title' ,       $plugin_public, 'gravity_forms_field_title' );
        $this->loader->add_action( 'gform_field_input',             $plugin_public, 'gravity_forms_field_input', 10, 5 );
        $this->loader->add_action( 'gform_editor_js',               $plugin_public, 'gravity_forms_field_editor_js' );
        $this->loader->add_action( 'gform_field_advanced_settings', $plugin_public, 'gravity_forms_add_theme_setting', 10, 2 );
        $this->loader->add_action( 'gform_enqueue_scripts' ,        $plugin_public, 'gravity_forms_recaptcha_api_enqueue_script' , 10 , 2 );
        $this->loader->add_filter( 'gform_field_validation',        $plugin_public, 'gravity_forms_validate', 10, 4 );
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_GFNoCaptchaReCaptcha() {
        return $this->GFNoCaptchaReCaptcha;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    GFNoCaptchaReCaptcha_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

    /**
     * Return options name for reCAPTCHA private/public key settings
     *
     * @since     1.0.0
     * @return    string    Name for private/public key options
     */
    public function get_options_name() {
        return $this->options_name;
    }
}
