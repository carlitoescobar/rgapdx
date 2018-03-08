<?php
namespace RCP\Addon\WooCommerceMemberDiscounts;

/**
 * Adds the coupon settings panel.
 */
function coupon_data_tab( $tabs ) {
	$tabs['rcp_member_discounts'] = array(
		'label'  => __( 'RCP Member Discounts', 'rcp-woocommerce-member-discounts' ),
		'target' => 'rcp-member-discounts',
		'class'  => ''
	);
	return $tabs;
}
add_filter( 'woocommerce_coupon_data_tabs', '\RCP\Addon\WooCommerceMemberDiscounts\coupon_data_tab' );

/**
 * Displays the coupon panel settings fields.
 */
function coupon_data_panel() {
	global $post;
	$saved = (array) get_post_meta( $post->ID, 'rcp_woo_member_discount_coupon_levels', true );
	$active = get_post_meta( $post->ID, 'rcp_woo_member_discount_coupon_active_members_only', true );
	?>
	<div id="rcp-member-discounts" class="panel woocommerce_options_panel">
		<div class="options_group">
		<p><?php _e( 'Active members of the selected subscription levels below will have this coupon automatically applied to their orders during checkout.', 'rcp-woocommerce-member-discounts' ); ?></p>
			<p class="form-field">
				<label><?php _e( 'Membership levels', 'woocommerce' ); ?></label>
				<?php
					$levels = rcp_get_subscription_levels();
					foreach( $levels as $key => $level ) {
						echo '<p class="form-field">';
						echo '<label for="rcp-woo-member-discount-coupon-levels['.$level->id.']">' . $level->name . '</label>';
						echo '<input type="checkbox" id="rcp-woo-member-discount-coupon-levels['.$level->id.']" name="rcp-woo-member-discount-coupon-levels['.$level->id.']" value="1" ' . checked( in_array( $level->id, $saved ), true, false ) . '>';
						echo '</p>';
					}
				?>
			</p>

			<p class="form-field">
				<label for="rcp-woo-member-discount-active-members-only"><?php _e( 'Active members only', 'rcp-woocommerce-member-discounts' ); ?></label>
				<input id="rcp-woo-member-discount-active-members-only" name="rcp-woo-member-discount-active-members-only" type="checkbox" value="1" <?php checked( $active, 1 ); ?>>
				<span class="description"><?php _e( 'Check this box to allow only active members to use this coupon. Useful for preventing other buyers from using it manually.', 'rcp-woocommerce-member-discounts' ); ?></span>
			</p>
		</div>
	</div>
	<?php
	wp_nonce_field( 'rcp_woo_member_discount_coupon_nonce', 'rcp_woo_member_discount_coupon_nonce' );
}
add_action( 'woocommerce_coupon_data_panels', '\RCP\Addon\WooCommerceMemberDiscounts\coupon_data_panel' );

/**
 * Saves the member discounts settings for the coupon.
 */
function coupon_data_panel_save( $post_id, $post ) {

	if ( empty( $_POST['rcp_woo_member_discount_coupon_nonce'] ) || ! wp_verify_nonce( $_POST['rcp_woo_member_discount_coupon_nonce'], 'rcp_woo_member_discount_coupon_nonce' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post' ) ) {
		return;
	}

	global $rcp_levels_db, $wpdb;

	$level_ids = ! empty( $_POST['rcp-woo-member-discount-coupon-levels'] ) ? $_POST['rcp-woo-member-discount-coupon-levels'] : false;
	$active    = ! empty( $_POST['rcp-woo-member-discount-active-members-only'] ) ? $_POST['rcp-woo-member-discount-active-members-only'] : false;

	// Remove existing level meta
	$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->levelmeta} WHERE meta_key = 'member_discount_coupon_woo' AND meta_value = %d", absint( $post_id ) ) );

	if ( $level_ids ) {

		$level_ids = array_keys( array_map( 'absint', $level_ids ) );

		update_post_meta( $post_id, 'rcp_woo_member_discount_coupon_levels', $level_ids );

		foreach ( $level_ids as $level_id ) {
			$rcp_levels_db->add_meta( $level_id, 'member_discount_coupon_woo', absint( $post_id ) );
		}

	} else {

		delete_post_meta( $post_id, 'rcp_woo_member_discount_coupon_levels' );

	}

	if ( $active ) {

		add_post_meta( $post_id, 'rcp_woo_member_discount_coupon_active_members_only', true, true );

	} else {

		delete_post_meta( $post_id, 'rcp_woo_member_discount_coupon_active_members_only' );

	}
}
add_action( 'save_post_shop_coupon', '\RCP\Addon\WooCommerceMemberDiscounts\coupon_data_panel_save', 10, 2 );

/**
 * Deletes the coupon ID from level meta when it's deleted.
 */
function remove_coupon_id_from_level_meta( $post_id ) {

	if ( ! current_user_can( 'delete_posts' ) ) {
		return;
	}

	$post = get_post( $post_id );

	if ( 'shop_coupon' !== $post->post_type ) {
		return;
	}

	global $wpdb;

	$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->levelmeta} WHERE meta_key = 'member_discount_coupon_woo' AND meta_value = %d", absint( $post_id ) ) );
}
add_action( 'wp_trash_post', '\RCP\Addon\WooCommerceMemberDiscounts\remove_coupon_id_from_level_meta' );
add_action( 'delete_post', '\RCP\Addon\WooCommerceMemberDiscounts\remove_coupon_id_from_level_meta' );