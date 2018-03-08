<?php
/**
 * Settings
 *
 * @package     RCP\MailChimp_Pro\Admin\Settings\Register
 * @since       1.0.0
 */

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Create the setting menu item
 *
 * @since       1.0.0
 * @param       array $menu The default menu args
 * @return      array $menu Our defined menu args
 */
function rcp_mailchimp_pro_create_menu( $menu ) {
	$menu['type']       = 'submenu';
	$menu['parent']     = 'rcp-members';
	$menu['page_title'] = __( 'RCP MailChimp Pro Settings', 'rcp-mailchimp-pro' );
	$menu['menu_title'] = __( 'MailChimp Pro', 'rcp-mailchimp-pro' );

	return $menu;
}
add_filter( 'rcp_mailchimp_pro_menu', 'rcp_mailchimp_pro_create_menu' );


/**
 * Define our settings tabs
 *
 * @since       1.0.0
 * @param       array $tabs The default tabs
 * @return      array $tabs Our defined tabs
 */
function rcp_mailchimp_pro_settings_tabs( $tabs ) {
	$tabs['general'] = __( 'General', 'rcp-mailchimp-pro' );

	return $tabs;
}
add_filter( 'rcp_mailchimp_pro_settings_tabs', 'rcp_mailchimp_pro_settings_tabs' );


/**
 * Define settings sections
 *
 * @since       1.0.0
 * @param       array $sections The default sections
 * @return      array $sections Our defined sections
 */
function rcp_mailchimp_pro_registered_settings_sections( $sections ) {
	$sections = array(
		'general' => apply_filters( 'rcp_mailchimp_pro_settings_sections_general', array(
			'main' => __( 'General', 'rcp-mailchimp-pro' )
		) )
	);

	return $sections;
}
add_filter( 'rcp_mailchimp_pro_registered_settings_sections', 'rcp_mailchimp_pro_registered_settings_sections' );


/**
 * Define our settings
 *
 * @since       1.0.0
 * @param       array $settings The default settings
 * @return      array $settings Our defined settings
 */
function rcp_mailchimp_pro_registered_settings( $settings ) {
	$new_settings = array(
		// General Settings
		'general' => apply_filters( 'rcp_mailchimp_pro_settings_general', array(
			'main' => array(
				'api_header' => array(
					'id'   => 'api_header',
					'type' => 'header',
					'name' => __( 'MailChimp API', 'rcp-mailchimp-pro' ),
					'desc' => ''
				),
				'api_key' => array(
					'id'   => 'api_key',
					'type' => 'text',
					'name' => __( 'API Key', 'rcp-mailchimp-pro' ),
					'desc' => __( 'Enter your MailChimp API key to enable a newsletter signup option with the registration form.', 'rcp-mailchimp-pro' )
				),
				'saved_list' => array(
					'id'      => 'saved_list',
					'type'    => 'selectlist',
					'name'    => __( 'Default List', 'rcp-mailchimp-pro' ),
					'desc'    => __( 'Choose the list to subscribe users to if no per-level list is selected.', 'rcp-mailchimp-pro' ),
					'options' => rcp_mailchimp_pro_get_lists()
				),
				'saved_group' => array(
					'id'      => 'saved_group',
					'type'    => 'selectgroup',
					'name'    => __( 'Default Group', 'rcp-mailchimp-pro' ),
					'desc'    => __( 'Choose the group to subscribe users to if no per-level group is selected.', 'rcp-mailchimp-pro' ),
				),
				'subscription_header' => array(
					'id'   => 'subscription_header',
					'type' => 'header',
					'name' => __( 'Subscription Details', 'rcp-mailchimp-pro' ),
					'desc' => ''
				),
				'double_subscribe' => array(
					'id'   => 'double_subscribe',
					'type' => 'checkbox',
					'name' => __( 'Double Subscribe', 'rcp-mailchimp-pro' ),
					'desc' => __( 'Check to subscribe to BOTH the default and per-level lists when possible.', 'rcp-mailchimp-pro' )
				),
				'signup_label' => array(
					'id'   => 'signup_label',
					'type' => 'text',
					'name' => __( 'Form Label', 'rcp-mailchimp-pro' ),
					'desc' => __( 'Enter the label to be used for the "Signup for Newsletter" checkbox.', 'rcp-mailchimp-pro' ),
					'std'  => __( 'Signup for Newsletter', 'rcp-mailchimp-pro' )
				),
				'bypass_optin' => array(
					'id'   => 'bypass_optin',
					'type' => 'checkbox',
					'name' => __( 'No Double Opt-In', 'rcp-mailchimp-pro' ),
					'desc' => __( 'Check to disable double opt-in.', 'rcp-mailchimp-pro' )
				),
				'auto_subscribe' => array(
					'id'   => 'auto_subscribe',
					'type' => 'checkbox',
					'name' => __( 'Auto Subscribe', 'rcp-mailchimp-pro' ),
					'desc' => __( 'Check to hide the subscribe checkbox and automatically subscribe users.', 'rcp-mailchimp-pro' )
				)
			)
		) )
	);

	return array_merge( $settings, $new_settings );
}
add_filter( 'rcp_mailchimp_pro_registered_settings', 'rcp_mailchimp_pro_registered_settings' );

/**
 * Delete MailChimp list transient when API key is saved to ensure lists are always loaded.
 *
 * @param string $value Value of the setting being saved.
 * @param string $id    ID of the setting being saved.
 *
 * @since 1.3.2
 * @return string
 */
function rcp_mailchimp_pro_clear_list_transient( $value, $id ) {

	if ( 'api_key' != $id ) {
		return $value;
	}

	// Clear MailChimp list transient.
	delete_transient( 'rcp_mailchimp_pro_lists' );

	return $value;

}
add_filter( 'rcp_mailchimp_pro_settings_sanitize', 'rcp_mailchimp_pro_clear_list_transient', 10, 2 );


/**
 * Callback for group select
 *
 * @since       1.2.3
 * @param       array $args The args for the callback
 * @return      void
 */
function rcp_mailchimp_pro_selectgroup_callback( $args ) {
	global $rcp_mailchimp_pro_options;

	if( isset( $rcp_mailchimp_pro_options[$args['id']] ) ) {
		$value = $rcp_mailchimp_pro_options[$args['id']];
	} else {
		$value = isset( $args['std'] ) ? $args['std'] : '';
	}

	$saved_list = isset( $rcp_mailchimp_pro_options['saved_list'] ) ? $rcp_mailchimp_pro_options['saved_list'] : null;

	$placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
	$select2     = isset( $args['select2'] ) ? ' class="s214-select2"' : '';
	$hidden      = ! $saved_list ? ' style="display: none;"' : '';

	if( isset( $args['multiple'] ) && $args['multiple'] === true ) {
		$html = '<select id="rcp_mailchimp_pro_settings[' . $args['id'] . ']" name="rcp_mailchimp_pro_settings[' . $args['id'] . '][]"' . $select2 . ' data-placeholder="' . $placeholder . '" multiple="multiple"' . $hidden . ' />';
	} else {
		$html = '<select id="rcp_mailchimp_pro_settings[' . $args['id'] . ']" name="rcp_mailchimp_pro_settings[' . $args['id'] . ']"' . $select2 . ' data-placeholder="' . $placeholder . '"' . $hidden . ' />';
	}

	if ( $saved_list ) {
		$html .= rcp_mailchimp_pro_get_group_options( $saved_list, $value );
	}

	$html .= '</select>&nbsp;';

	if ( $saved_list ) {
		$html .= '<span class="description"><label for="rcp_mailchimp_pro_settings[' . $args['id'] . ']">' . $args['desc'] . '</label></span>';
	} else {
		$html .= '<span id="rcp_mailchimp_pro_no_api_key_groups" class="description">' . __( 'Enter an API key to select a default group.', 'rcp-mailchimp-pro' ) . '</span>';
	}

	echo $html;
}
add_action( 'rcp_mailchimp_pro_selectgroup_callback', 'rcp_mailchimp_pro_selectgroup_callback' );


/**
 * Callback for list select
 *
 * @since       1.2.0
 * @param       array $args The args for the callback
 * @return      void
 */
function rcp_mailchimp_pro_selectlist_callback( $args ) {
	global $rcp_mailchimp_pro_options;

	if( $args['options'] && is_array( $args['options'] ) ) {
		if( isset( $rcp_mailchimp_pro_options[$args['id']] ) ) {
			$value = $rcp_mailchimp_pro_options[$args['id']];
		} else {
			$value = isset( $args['std'] ) ? $args['std'] : '';
		}

		$placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
		$select2     = isset( $args['select2'] ) ? ' class="s214-select2"' : '';

		if( isset( $args['multiple'] ) && $args['multiple'] === true ) {
			$html = '<select id="rcp_mailchimp_pro_settings[' . $args['id'] . ']" name="rcp_mailchimp_pro_settings[' . $args['id'] . '][]"' . $select2 . ' data-placeholder="' . $placeholder . '" multiple="multiple" />';
		} else {
			$html = '<select id="rcp_mailchimp_pro_settings[' . $args['id'] . ']" name="rcp_mailchimp_pro_settings[' . $args['id'] . ']"' . $select2 . ' data-placeholder="' . $placeholder . '" />';
		}

		foreach( $args['options'] as $option => $name ) {
			if( isset( $args['multiple'] ) && $args['multiple'] === true ) {
				if( is_array( $value ) ) {
					$selected = ( in_array( $option, $value ) ? 'selected="selected"' : '' );
				} else {
					$selected = '';
				}
			} else {
				if( is_string( $value ) ) {
					$selected = selected( $option, $value, false );
				} else {
					$selected = '';
				}
			}

			$html .= '<option value="' . $option . '" ' . $selected . '>' . $name . '</option>';
		}

		$html .= '</select>&nbsp;';
		$html .= '<span class="description"><label for="rcp_mailchimp_pro_settings[' . $args['id'] . ']">' . $args['desc'] . '</label></span>';
	} elseif( $args['options'] && ! is_array( $args['options'] ) ) {
		$html = '<span class="description">' . sprintf( __( 'Error: %s', 'rcp-mailchimp-pro' ), $args['options'] ) . '</span>';
	} else {
		$html = '<span class="description">' . __( 'Enter an API key to select a default list.', 'rcp-mailchimp-pro' ) . '</span>';
	}

	echo $html;
}
add_action( 'rcp_mailchimp_pro_selectlist_callback', 'rcp_mailchimp_pro_selectlist_callback' );


/**
 * Add per-level setting fields
 *
 * @since       1.1.0
 * @return      void
 */
function rcp_mailchimp_pro_add_subscription_settings() {
	?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="rcp-mailchimp-pro-list"><?php _e( 'MailChimp List', 'rcp-mailchimp-pro' ); ?></label>
			</th>
			<td>
				<?php
				$lists = rcp_mailchimp_pro_get_lists();

				if( isset( $_GET['edit_subscription'] ) ) {
					$subscription_lists = get_option( 'rcp_mailchimp_pro_subscription_lists' );

					if( is_array( $subscription_lists ) && array_key_exists( $_GET['edit_subscription'], $subscription_lists ) ) {
						$saved_list = $subscription_lists[$_GET['edit_subscription']];
					} else {
						$saved_list = '';
					}
				} else {
					$saved_list = '';
				}

				if( $lists ) {
					if( ! is_array( $lists ) ) {
						echo '<strong>' . __( 'Error:', 'rcp-mailchimp-pro' ) . '</strong> ' . $lists;
					} else { ?>
						<select name="mailchimp-list" id="rcp-mailchimp-pro-list">
							<option value="inherit"<?php echo selected( $saved_list, 'inherit', false ); ?>><?php _e( 'Use System Default', 'rcp-mailchimp-pro' ); ?></option>
							<?php
							foreach( $lists as $list_id => $list_name ) {
								echo '<option value="' . esc_attr( $list_id ) . '"' . selected( $saved_list, $list_id, false ) . '>' . esc_html( $list_name ) . '</option>';
							} ?>
						</select>
						<p class="description"><?php _e( 'The MailChimp list to subscribe users to at this level.', 'rcp-mailchimp-pro' ); ?></p>
					<?php }
				} else {
					echo __( 'Enter an API key to select a default list.', 'rcp-mailchimp-pro' );
				}
				?>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="rcp-mailchimp-pro-group"><?php _e( 'MailChimp Group', 'rcp-mailchimp-pro' ); ?></label>
			</th>
			<td>
				<?php
				$saved_group = '';

				if( isset( $_GET['edit_subscription'] ) ) {
					$subscription_groups = get_option( 'rcp_mailchimp_pro_subscription_groups' );

					if( is_array( $subscription_groups ) && array_key_exists( $_GET['edit_subscription'], $subscription_groups ) ) {
						$saved_group = $subscription_groups[$_GET['edit_subscription']];
					}
				} ?>

				<select name="mailchimp-group" id="rcp-mailchimp-pro-group">
					<?php echo rcp_mailchimp_pro_get_group_options( $saved_list, $saved_group ); ?>
				</select>
				<p class="description"><?php _e( 'The MailChimp group to subscribe users to at this level.', 'rcp-mailchimp-pro' ); ?></p>
			</td>
		</tr>
	<?php
}
add_action( 'rcp_add_subscription_form', 'rcp_mailchimp_pro_add_subscription_settings' );
add_action( 'rcp_edit_subscription_form', 'rcp_mailchimp_pro_add_subscription_settings' );


/**
 * Store the MailChimp list and group in subscription meta
 *
 * @since       1.1.0
 * @param       int $level_id The subscription ID
 * @param       array $args Arguements passed to the action
 */
function rcp_mailchimp_pro_save_subscription( $level_id = 0, $args ) {
	$subscription_lists  = get_option( 'rcp_mailchimp_pro_subscription_lists', array() );
	$subscription_groups = get_option( 'rcp_mailchimp_pro_subscription_groups', array() );

	// Save lists
	if( ! empty( $_POST['mailchimp-list'] ) ) {
		$subscription_lists[ $level_id ] = sanitize_text_field( $_POST['mailchimp-list'] );
	} else {
		unset( $subscription_lists[ $level_id ] );
	}
	if ( ! empty( $subscription_lists ) ) {
		update_option( 'rcp_mailchimp_pro_subscription_lists', $subscription_lists );
	} else {
		delete_option( 'rcp_mailchimp_pro_subscription_lists' );
	}

	// Save interest group
	if( ! empty( $_POST['mailchimp-group'] ) ) {
		$subscription_groups[ $level_id ] = sanitize_text_field( $_POST['mailchimp-group'] );
	} else {
		unset( $subscription_groups[ $level_id ] );
	}
	if ( ! empty( $subscription_groups ) ) {
		update_option( 'rcp_mailchimp_pro_subscription_groups', $subscription_groups );
	} else {
		delete_option( 'rcp_mailchimp_pro_subscription_groups' );
	}
}
add_action( 'rcp_add_subscription', 'rcp_mailchimp_pro_save_subscription', 10, 2 );
add_action( 'rcp_edit_subscription_level', 'rcp_mailchimp_pro_save_subscription', 10, 2 );


/**
 * Generate the correct options for the Group Select
 *
 * @since       1.2.3
 * @param       string $list The list to set options for
 * @param       null $selected
 * @return      string
 */
function rcp_mailchimp_pro_get_group_options( $list, $selected = null ) {
	if( 'inherit' === $list || empty( $list ) ) {
		return sprintf( '<option value="inherit">%s</option>', __( 'Use System Default', 'rcp-mailchimp-pro' ) );
	}

	$groups = rcp_mailchimp_pro_get_groups( $list );

	if( ! is_object( $groups ) || $groups->total_items < 1 ) {
		return sprintf( '<option value="0">%s</option>', __( 'No Groups Found', 'rcp-mailchimp-pro' ) );
	}

	ob_start(); ?>

	<option value="0"><?php _e( 'No Group', 'rcp-mailchimp-pro' ); ?></option>

	<?php foreach( $groups->categories as $grouping ) : ?>
		<?php $interests = rcp_mailchimp_pro_get_interests( $list, $grouping->id ); ?>
		<?php if ( is_array( $interests ) && ! empty( $interests ) ) { ?>
			<optgroup label="<?php echo esc_html( $grouping->title ); ?>">
				<?php foreach( $interests as $interest_id => $interest_name ) : ?>
					<option value="<?php echo esc_attr( $interest_id ); ?>" <?php selected( $interest_id, $selected ); ?>><?php echo esc_html( $interest_name ); ?></option>
				<?php endforeach; ?>
			</optgroup>
		<?php } ?>
	<?php endforeach;

	return ob_get_clean();
}


/**
 * Handle generating the options for the group select when the list changes.
 *
 * @since       1.2.3
 * @return      void
 */
function rcp_mailchimp_pro_get_groups_ajax() {
	check_ajax_referer( 'settings', 'nonce' );

	if( empty( $_POST[ 'list' ] ) ) {
		wp_send_json_error();
	}

	$list = sanitize_text_field( $_POST[ 'list' ] );

	wp_send_json_success( rcp_mailchimp_pro_get_group_options( $list ) );
}
add_action( 'wp_ajax_rcpmp_get_groups', 'rcp_mailchimp_pro_get_groups_ajax' );


/**
 * Add our data to the Sysinfo field
 *
 * @since       1.2.0
 * @param       string $sysinfo The current sysinfo data
 * @return      string $sysinfo The updated sysinfo data
 */
function rcp_mailchimp_pro_sysinfo( $sysinfo ) {
	$sysinfo .= "\n" . '-- RCP MailChimp Pro Configuration' . "\n\n";
	$sysinfo .= 'Version:                  ' . RCP_MAILCHIMP_PRO_VER . "\n";

	return $sysinfo;
}
add_filter( 'rcp_mailchimp_pro_sysinfo_after_wordpress_config', 'rcp_mailchimp_pro_sysinfo' );