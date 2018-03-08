<?php
/*
Plugin Name: Restrict Content Pro - RGA Custom User Fields
Description: Add custom user RGA•PDX fields to the Restrict Content Pro registration form that can also be edited by the site admins
Version: 1.0
Author: Carlito Escobar
Author URI: http://carlitoescobar.com
Contributors: carlito
*/


/**
 * Adds the custom fields to the registration form and profile editor
 *
 */
function pw_rcp_add_user_fields() {
	
	$rank = get_user_meta( get_current_user_id(), 'rcp_rank', true );
	$location   = get_user_meta( get_current_user_id(), 'rcp_location', true );

	?>
	<p>
		<label for="rcp_rank"><?php _e( 'Your Rank', 'rcp' ); ?></label>
		<input name="rcp_rank" id="rcp_rank" type="text" value="<?php echo esc_attr( $rank ); ?>"/>
	</p>
	<p>
		<label for="rcp_location"><?php _e( 'Your Location', 'rcp' ); ?></label>
		<input name="rcp_location" id="rcp_location" type="text" value="<?php echo esc_attr( $location ); ?>"/>
	</p>
	<?php
}
add_action( 'rcp_after_password_registration_field', 'pw_rcp_add_user_fields' );
add_action( 'rcp_profile_editor_after', 'pw_rcp_add_user_fields' );

/**
 * Adds the custom fields to the member edit screen
 *
 */
function pw_rcp_add_member_edit_fields( $user_id = 0 ) {
	
	$rank = get_user_meta( $user_id, 'rcp_rank', true );
	$location   = get_user_meta( $user_id, 'rcp_location', true );

	?>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_rank"><?php _e( 'Rank', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_rank" id="rcp_rank" type="text" value="<?php echo esc_attr( $rank ); ?>"/>
			<p class="description"><?php _e( 'The member\'s rank', 'rcp' ); ?></p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row" valign="top">
			<label for="rcp_rank"><?php _e( 'Location', 'rcp' ); ?></label>
		</th>
		<td>
			<input name="rcp_location" id="rcp_location" type="text" value="<?php echo esc_attr( $location ); ?>"/>
			<p class="description"><?php _e( 'The member\'s location', 'rcp' ); ?></p>
		</td>
	</tr>
	<?php
}
add_action( 'rcp_edit_member_after', 'pw_rcp_add_member_edit_fields' );
 
/**
 * Determines if there are problems with the registration data submitted
 *
 */
function pw_rcp_validate_user_fields_on_register( $posted ) {

	if( empty( $posted['rcp_rank'] ) ) {
		rcp_errors()->add( 'invalid_rank', __( 'Please enter your rank', 'rcp' ), 'register' );
	}

	if( empty( $posted['rcp_location'] ) ) {
		rcp_errors()->add( 'invalid_location', __( 'Please enter your location', 'rcp' ), 'register' );
	}

}
add_action( 'rcp_form_errors', 'pw_rcp_validate_user_fields_on_register', 10 );

/**
 * Stores the information submitted during registration
 *
 */
function pw_rcp_save_user_fields_on_register( $posted, $user_id ) {

	if( ! empty( $posted['rcp_rank'] ) ) {
		update_user_meta( $user_id, 'rcp_rank', sanitize_text_field( $posted['rcp_rank'] ) );
	}

	if( ! empty( $posted['rcp_location'] ) ) {
		update_user_meta( $user_id, 'rcp_location', sanitize_text_field( $posted['rcp_location'] ) );
	}

}
add_action( 'rcp_form_processing', 'pw_rcp_save_user_fields_on_register', 10, 2 );

/**
 * Stores the information submitted profile update
 *
 */
function pw_rcp_save_user_fields_on_profile_save( $user_id ) {

	if( ! empty( $_POST['rcp_rank'] ) ) {
		update_user_meta( $user_id, 'rcp_rank', sanitize_text_field( $_POST['rcp_rank'] ) );
	}

	if( ! empty( $_POST['rcp_location'] ) ) {
		update_user_meta( $user_id, 'rcp_location', sanitize_text_field( $_POST['rcp_location'] ) );
	}

}
add_action( 'rcp_user_profile_updated', 'pw_rcp_save_user_fields_on_profile_save', 10 );
add_action( 'rcp_edit_member', 'pw_rcp_save_user_fields_on_profile_save', 10 );