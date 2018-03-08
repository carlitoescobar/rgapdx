<?php
namespace RCP\Addon\WooCommerceMemberDiscounts;

class Discounts {

	private $user_id;
	private $sub_id;
	private $coupons = array();
	private $members_only;

	public function __construct() {
		$this->user_id = wp_get_current_user()->ID;
		$this->sub_id  = (int) rcp_get_subscription_id( $this->user_id );
	}

	/**
	 * Adds the plugin hooks.
	 */
	public function hooks() {
		add_action( 'template_redirect', array( $this, 'apply_coupon' ) );
		add_filter( 'woocommerce_coupon_is_valid', array( $this, 'validate_members_only_coupon' ), 10, 2 );
	}

	/**
	 * Applies applicable coupons on the checkout page.
	 */
	public function apply_coupon() {

		if ( empty( $this->user_id ) || empty( $this->sub_id ) || ( ! is_checkout() && ! is_cart() ) ) {
			return;
		}

		if ( rcp_is_expired( $this->user_id ) ) {
			return;
		}

		global $rcp_levels_db;

		$this->coupons = $rcp_levels_db->get_meta( $this->sub_id, 'member_discount_coupon_woo', false );

		if ( empty( $this->coupons ) ) {
			return;
		}

		foreach ( $this->coupons as $key => $coupon ) {

			$coupon_object = get_post( $coupon );

			if ( ! is_object( $coupon_object ) || ! is_a( $coupon_object, 'WP_Post' ) ) {
				return;
			}

			$wc_coupon = new \WC_Coupon( $coupon_object->post_title );

			if ( ! WC()->cart->has_discount( $coupon_object->post_title ) && $wc_coupon->is_valid() ) {
				WC()->cart->add_discount( $coupon_object->post_title );
			}

		}
	}

	/**
	 * Validates members only coupons.
	 */
	public function validate_members_only_coupon( $valid, $obj ) {

		$this->members_only = get_post_meta( $obj->id, 'rcp_woo_member_discount_coupon_active_members_only', true );

		// If not a member's only coupon, return early.
		if ( empty( $this->members_only ) ) {
			return $valid;
		}

		// If user not logged in or is an expired member, coupon is not valid.
		if ( ! is_user_logged_in() || empty( $this->sub_id ) || rcp_is_expired( $this->user_id ) ) {
			return false;
		}

		return $valid;
	}
}