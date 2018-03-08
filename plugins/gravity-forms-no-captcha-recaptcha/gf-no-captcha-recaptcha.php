<?php

/**
 * Gravity Forms No CAPTCHA reCAPTCHA plugin bootstrap file
 *
 * @link              https://github.com/folkhack/Gravity-Forms-No-CAPTCHA-reCAPTCHA
 * @since             1.0.0
 * @package           GFNoCaptchaReCaptcha
 *
 * @wordpress-plugin
 * Plugin Name:       Gravity Forms No CAPTCHA reCAPTCHA
 * Plugin URI:        https://github.com/folkhack/Gravity-Forms-No-CAPTCHA-reCAPTCHA
 * Description:       Adds "No CAPTCHA reCAPTCHA" field to Gravity Forms as an alternative CAPTCHA option
 * Version:           1.0.7
 * Author:            John Parks - Folkhack Studios
 * Author URI:        http://folkhack.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gf-no-captcha-recaptcha
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gf-no-captcha-recaptcha-deactivator.php
 */
function deactivate_GFNoCaptchaReCaptcha() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-gf-no-captcha-recaptcha-deactivator.php';
    GFNoCaptchaReCaptcha_Deactivator::deactivate();
}

register_deactivation_hook( __FILE__, 'deactivate_GFNoCaptchaReCaptcha' );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-gf-no-captcha-recaptcha.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_GFNoCaptchaReCaptcha() {

    $plugin = new GFNoCaptchaReCaptcha();
    $plugin->run();

}
run_GFNoCaptchaReCaptcha();