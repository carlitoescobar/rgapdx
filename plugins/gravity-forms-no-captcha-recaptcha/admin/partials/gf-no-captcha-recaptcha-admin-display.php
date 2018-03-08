<?php

/**
 * Provide a settings page for the plugin
 *
 * @link       http://folkhack.com
 * @since      1.0.0
 *
 * @package    GFNoCaptchaReCaptcha
 * @subpackage GFNoCaptchaReCaptcha/admin/partials
 */
?>

<div class="wrap">

    <h2><?php echo __( 'Gravity Forms No CAPTCHA reCAPTCHA Settings', 'gf-no-captcha-recaptcha' ); ?></h2>

    <form method="post" action="options.php">

    <?php

        // This prints out all hidden setting fields
        settings_fields( 'gf_nocaptcha_recaptcha_group' );

        // Display setting sections
        do_settings_sections( 'gf-nocaptcha-settings-admin' );

        // Display submit button
        submit_button();
    ?>

    </form>

</div>
