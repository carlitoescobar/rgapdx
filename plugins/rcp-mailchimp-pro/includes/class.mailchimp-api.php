<?php
/**
 * MailChimp API Handler
 *
 * @package     RCP\MailChimpPro\API
 * @since       1.0.1
 */


// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * MailChimp API handler class
 *
 * @since       1.0.1
 */
class RCP_MailChimp_Pro_API {


	/**
	 * @var         array $settings MailChimp Pro settings
	 * @since       1.0.1
	 */
	public $settings;


	/**
	 * @var         array $lists Per-level list settings
	 * @since       1.0.1
	 */
	public $lists;


	/**
	 * @var         array $groups Per-level group settings
	 * @since       1.2.3
	 */
	public $groups;


	/**
	 * Get things started
	 *
	 * @access      public
	 * @since       1.0.1
	 * @return      void
	 */
	public function __construct() {
		$this->setup_api();

		// Maybe set a flag to sign up the user
		add_action( 'rcp_form_processing', array( $this, 'maybe_signup' ), 10, 2 );

		// Add to list.
		add_action( 'rcp_set_status', array( $this, 'maybe_add_to_list' ), 10, 4 );

		// E-Commerce 360 integration
		add_action( 'rcp_update_payment_status_complete', array( $this, 'insert_payment' ), 5 );

		// Update user status
		add_action( 'rcp_set_status', array( $this, 'set_status' ), 10, 4 );

		// Update MailChimp when user changes email
		add_action( 'profile_update', array( $this, 'update_subscription' ), 10, 2 );
	}


	/**
	 * Setup the API object
	 *
	 * @access      private
	 * @since       1.0.1
	 * @return      void
	 */
	private function setup_api() {
		if( ! $this->settings ) {
			$this->settings = get_option( 'rcp_mailchimp_pro_settings' );
			$this->lists    = get_option( 'rcp_mailchimp_pro_subscription_lists' );
			$this->groups   = get_option( 'rcp_mailchimp_pro_subscription_groups' );
		}
	}


	/**
	 * Retrieve the list to signup for
	 *
	 * @access      public
	 * @since       1.0.1
	 * @param       int $level_id The ID of the subscription level to lookup
	 * @return      string $list The MailChimp list to signup for
	 */
	public function get_list( $level_id ) {
		if( is_array( $this->lists ) && array_key_exists( $level_id, $this->lists ) && $this->lists[$level_id] !== 'inherit' ) {
			$list = $this->lists[$level_id];
		} else {
			$list = $this->settings['saved_list'];
		}

		return apply_filters( 'rcp_mailchimp_pro_get_list', $list, $level_id );
	}


	/**
	 * Retrieve the group to signup for
	 *
	 * @access      public
	 * @since       1.2.3
	 * @param        int|string $level_id The ID of the subscription level to lookup, or "default" for the default group in settings.
	 * @param string $mailchimp_list_id   ID of the MailChimp list. For backwards compatibility.
	 * @return      string $group The MailChimp group to signup for
	 */
	public function get_group( $level_id = 'default', $mailchimp_list_id = '' ) {
		$group = 0;

		if ( 'default' == $level_id ) {

			// Default group saved in settings.
			$group = array_key_exists( 'saved_group', $this->settings ) ? $this->settings['saved_group'] : 0;

		} else {

			// Get the group for an individual subscription level.
			if ( is_array( $this->groups ) && array_key_exists( $level_id, $this->groups ) && 'inherit' !== $this->groups[ $level_id ] ) {
				$group = $this->groups[ $level_id ];
			} elseif ( array_key_exists( 'saved_group', $this->settings ) && $mailchimp_list_id == $this->settings['saved_list'] ) {
				// Fall back to global setting if subscription level is set to "inherit".
				$group = $this->settings['saved_group'];
			}

		}

		/*
		 * If the group ID includes a slash, it's the old method of saving and is no longer valid.
		 * We need to do another API request to try to get the interest ID from the group ID and
		 * interest name.
		 */
		if ( false !== strpos( $group, '/' ) ) {

			$group_pieces  = explode( '/', $group );
			$group_id      = $group_pieces[0];
			$interest_name = $group_pieces[1];

			$group = 0; // Set back to zero in case we can't find the interest ID.

			$data_center = explode( '-', $this->settings['api_key'] );
			$data_center = $data_center[1];

			$request_url  = 'https://' . urlencode( $data_center ) . '.api.mailchimp.com/3.0/lists/' . urlencode( $mailchimp_list_id ) . '/interest-categories/' . urlencode( $group_id ) . '/interests/?count=100';
			$request_args = array(
				'headers' => array(
					'Authorization' => 'Basic ' . base64_encode( 'user:' . $this->settings['api_key'] )
				)
			);

			$response  = wp_remote_get( $request_url, $request_args );
			$interests = json_decode( wp_remote_retrieve_body( $response ) );

			if ( is_object( $interests ) && $interests->total_items > 0 ) {
				foreach ( $interests->interests as $interest ) {
					if ( $interest->name == $interest_name ) {
						$group = $interest->id;
						break;
					}
				}
			}

			// If we were able to get an interest ID, let's update the settings.
			if ( ! empty( $group ) ) {

				if ( 'default' == $level_id ) {

					// Update the group ID in the main settings.
					$this->settings['saved_group'] = sanitize_text_field( $group );
					update_option( 'rcp_mailchimp_pro_settings', $this->settings );

				} else {

					// Update the individual subscription level.
					if ( is_array( $this->groups ) ) {
						$this->groups[ $level_id ] = sanitize_text_field( $group );
						update_option( 'rcp_mailchimp_pro_subscription_groups', $this->groups );
					}

				}

			}
		}

		return apply_filters( 'rcp_mailchimp_pro_get_group', $group, $level_id );
	}

	/**
	 * Create the grouping args
	 *
	 * @since 1.2.3
	 * @param int|string $level_id          The ID of the subscription level to lookup, or "default" for the default group in settings.
	 * @param string     $mailchimp_list_id ID of the MailChimp list. For backwards compatibility.
	 *
	 * @return array|false
	 */
	public function get_grouping( $level_id = 'default', $mailchimp_list_id = '' ) {
		$groupings = false;

		if( ! $group = $this->get_group( $level_id, $mailchimp_list_id ) ) {
			return $groupings;
		}

		$groupings = array(
			$group => true
		);

		return $groupings;
	}


	/**
	 * Check if a given member is subscribed on MailChimp
	 *
	 * @access      public
	 * @since       1.0.1
	 * @param       string $email The email address to lookup
	 * @param       string $list The list to check
	 * @return      array|false $member_exists Array of subscriber data from MailChimp if subscribed, false otherwise.
	 */
	public function member_exists( $email, $list ) {

		$api_key  = trim( $this->settings['api_key'] );

		if ( empty( $api_key ) ) {
			return false;
		}

		$data_center = explode( '-', $api_key );
		$data_center = $data_center[1];

		$request_url = 'https://' . urlencode( $data_center ) . '.api.mailchimp.com/3.0/lists/' . urlencode( $list ) . '/members/' . urlencode( md5( strtolower( $email ) ) );

		$args = array(
			'headers' => array(
				'Authorization' => 'Basic ' . base64_encode( 'user:' . $api_key )
			)
		);

		$response = wp_remote_get( $request_url, $args );

		if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
			return false;
		}

		return json_decode( wp_remote_retrieve_body( $response ), true );

	}


	/**
	 * Create our status merge var
	 *
	 * @access      public
	 * @since       1.0.1
	 * @param       string $list The list ID to create for
	 * @return      void
	 */
	public function create_merge_var( $list ) {

		$set_vars = get_option( 'rcp_mailchimp_pro_set_merge_vars' );

		// We've already created the merge var - bail.
		if ( is_array( $set_vars ) && array_key_exists( $list, $set_vars ) ) {
			return;
		}

		$api_key  = trim( $this->settings['api_key'] );

		if ( empty( $api_key ) ) {
			return;
		}

		$data_center = explode( '-', $api_key );
		$data_center = $data_center[1];

		// Double check to see if merge var already exists before trying to create it.
		$request_url = 'https://' . urlencode( $data_center ) . '.api.mailchimp.com/3.0/lists/' . urlencode( $list ) . '/merge-fields/';

		$args = array(
			'headers' => array(
				'Authorization' => 'Basic ' . base64_encode( 'user:' . $api_key )
			)
		);

		$response = wp_remote_get( $request_url, $args );

		if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
			rcp_log( sprintf( 'Failed to create MailChimp merge var(s).' ) );

			return;
		}

		$merge_vars = json_decode( wp_remote_retrieve_body( $response ), true );

		foreach ( $merge_vars['merge_fields'] as $var ) {
			// Bail if the STATUS tag already exists.
			if ( 'STATUS' == $var['tag'] ) {
				return;
			}
		}

		// At this point we haven't found the STATUS merge var so we need to create it.
		$args['body'] = json_encode( array(
			'tag'  => 'STATUS',
			'name' => __( 'RCP Status', 'rcp-mailchimp-pro' ),
			'type' => 'text'
		) );

		$request_url = 'https://' . urlencode( $data_center ) . '.api.mailchimp.com/3.0/lists/' . urlencode( $list ) . '/merge-fields/';

		$response = wp_remote_post( $request_url, $args );

		if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
			rcp_log( sprintf( 'Failed to create MailChimp merge var(s).' ) );

			return;
		}

		// Success!
		$set_vars[ $list ] = true;

		update_option( 'rcp_mailchimp_pro_set_merge_vars', $set_vars );

	}


	/**
	 * Subscribe an email to MailChimp
	 *
	 * @access      public
	 * @since       1.0.1
	 * @param       string $email The email address to subscribe
	 * @param       int $user_id The ID of the user to subscribe
	 * @return      bool True if added successfully, false otherwise
	 */
	public function subscribe( $email, $user_id ) {

		$member            = new RCP_Member( $user_id );
		$level_id          = $member->get_subscription_id();
		$double_opt_in     = ( isset( $this->settings['bypass_optin'] ) ? false : true );
		$saved_list        = $this->settings['saved_list'];
		$list              = $this->get_list( $level_id );
		$level_groupings   = $this->get_grouping( $level_id, $list );
		$default_groupings = $this->get_grouping( 'default', $saved_list );
		$fname             = sanitize_text_field( $member->first_name );
		$lname             = sanitize_text_field( $member->last_name );
		$status            = $member->get_status();
		$subscribed_lists  = get_user_meta( $user_id, 'rcp_mailchimp_pro_subscribed_lists', true );

		if ( ! is_array( $subscribed_lists ) ) {
			$subscribed_lists = array();
		}

		$this->create_merge_var( $list );

		$api_key  = trim( $this->settings['api_key'] );

		if ( empty( $api_key ) ) {
			return false;
		}

		// Set up which lists to add users to.
		$lists = array(
			$list => array(
				'id'    => $list,
				'group' => $level_groupings
			)
		);

		// Maybe add a second list.
		if ( ! empty( $this->settings['double_subscribe'] ) && $saved_list != $list ) {
			$lists[ $saved_list ] = array(
				'id'    => $saved_list,
				'group' => $default_groupings
			);
		}

		$data_center = explode( '-', $api_key );
		$data_center = $data_center[1];

		foreach ( $lists as $list_id => $list_info ) {
			$is_subscribed = $this->member_exists( $email, $list_id );

			if ( $is_subscribed && 'subscribed' == $is_subscribed['status'] ) {
				$has_all_interests = true;

				if ( ! empty( $list_info['group'] ) ) {
					foreach ( $list_info['group'] as $group_id => $group ) {
						if ( empty( $is_subscribed['interests'][ $group_id ] ) ) {
							$has_all_interests = false;
						}
					}
				}

				// If the member is already subscribed and has all the required interests, we can skip adding them.
				if ( $has_all_interests ) {
					rcp_log( sprintf( 'MailChimp Pro: Skipping adding user ID #%d, as they are already subscribed to list ID %s.', $user_id, $list_id ) );

					if ( ! in_array( $list_id, $subscribed_lists ) ) {
						$subscribed_lists[] = sanitize_text_field( $list_id );
					}

					continue;
				}
			}

			$request_url = 'https://' . urlencode( $data_center ) . '.api.mailchimp.com/3.0/lists/' . urlencode( $list_id ) . '/members/' . urlencode( md5( strtolower( $email ) ) );

			$request_body = array(
				'email_address' => sanitize_email( $email ),
				'email_type'    => 'html',
				'status_if_new' => $double_opt_in ? 'pending' : 'subscribed',
				'status'        => ( ( $is_subscribed && 'subscribed' == $is_subscribed['status'] ) || ! $double_opt_in ) ? 'subscribed' : 'pending',
				'merge_fields'  => array(
					'FNAME'  => $fname,
					'LNAME'  => $lname,
					'STATUS' => $status
				)
			);

			if ( ! empty( $list_info['group'] ) ) {
				$request_body['interests'] = $list_info['group'];
			}

			$args = array(
				'method'  => 'PUT',
				'headers' => array(
					'Authorization' => 'Basic ' . base64_encode( 'user:' . $api_key )
				),
				'body'    => json_encode( $request_body )
			);

			$response = wp_remote_post( $request_url, $args );

			if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
				rcp_log( sprintf( 'Failed to subscribe user to MailChimp. Response code: %d. Response: %s', wp_remote_retrieve_response_code( $response ), wp_remote_retrieve_body( $response ) ) );

				return false;
			}

			if ( ! in_array( $list_id, $subscribed_lists ) ) {
				$subscribed_lists[] = sanitize_text_field( $list_id );
			}

			rcp_log( sprintf( 'MailChimp Pro: Successfully added user #%d to list %s.', $user_id, $list_id ) );
		}

		// Update lists user is subscribed to.
		update_user_meta( $user_id, 'rcp_mailchimp_pro_subscribed_lists', $subscribed_lists );

		return true;

	}


	/**
	 * Checks whether a user should be signed up for the MailChimp list, and if so, sets a flag.
	 *
	 * @access      public
	 * @since       1.0.1
	 * @param       array $posted The fields posted by the submission form
	 * @param       int $user_id The ID of this user
	 * @return      void
	 */
	public function maybe_signup( $posted, $user_id ) {
		if( isset( $posted['rcp_mailchimp_pro_signup'] ) ) {
			// Set a flag so we know to add them to the list after account activation.
			update_user_meta( $user_id, 'rcp_pending_mailchimp_signup', true );
		} else {
			delete_user_meta( $user_id, 'rcp_pending_mailchimp_signup' );
		}
	}

	/**
	 * Add member to the MailChimp list when their account is activated.
	 *
	 * @param string     $status     New status.
	 * @param int        $user_id    ID of the user.
	 * @param string     $old_status Previous status.
	 * @param RCP_Member $member     Member object.
	 *
	 * @since  1.3.2
	 * @return void
	 */
	public function maybe_add_to_list( $status, $user_id, $old_status, $member ) {

		if ( ! in_array( $status, array( 'active', 'free' ) ) ) {
			return;
		}

		if ( ! get_user_meta( $user_id, 'rcp_pending_mailchimp_signup', true ) ) {
			return;
		}

		$subscribed = $this->subscribe( $member->user_email, $user_id );

		if ( $subscribed ) {
			update_user_meta( $user_id, 'rcp_subscribed_to_mailchimp', 'yes' );
			delete_user_meta( $user_id, 'rcp_pending_mailchimp_signup' );
		}

	}


	/**
	 * Update subscription when user changes their email
	 *
	 * @access      public
	 * @since       1.0.2
	 * @param       int $user_id The ID of the user
	 * @param       object $old_user_data The old data for the user
	 * @return      void
	 */
	public function update_subscription( $user_id, $old_user_data ) {

		// No API key - bail.
		if ( empty( $this->settings['api_key'] ) ) {
			return;
		}

		$api_key     = trim( $this->settings['api_key'] );
		$data_center = explode( '-', $api_key );
		$data_center = $data_center[1];

		$user_data = get_userdata( $user_id );

		$new_email = $user_data->user_email;
		$old_email = $old_user_data->user_email;

		// Email hasn't changed - bail.
		if ( $new_email == $old_email ) {
			return;
		}

		$lists = rcp_mailchimp_pro_get_lists();

		if ( ! is_array( $lists ) ) {
			return;
		}

		foreach( $lists as $list_id => $list_name ) {
			$subscribed = $this->member_exists( $old_email, $list_id );

			if ( ! $subscribed ) {
				continue;
			}

			$request_url = 'https://' . urlencode( $data_center ) . '.api.mailchimp.com/3.0/lists/' . urlencode( $list_id ) . '/members/' . urlencode( md5( strtolower( $old_email ) ) );

			$args = array(
				'method'  => 'PATCH',
				'headers' => array(
					'Authorization' => 'Basic ' . base64_encode( 'user:' . $api_key )
				),
				'body'    => json_encode( array(
					'email_address' => $new_email
				) )
			);

			wp_remote_request( $request_url, $args );
		}

	}


	/**
	 * E-Commerce 360 integration
	 *
	 * @access      public
	 * @since       1.0.1
	 * @param       int $payment_id The payment ID
	 * @param       array $args The payment data for a given purchase
	 * @param       double $amount The purchase amount
	 * @return      void
	 */
	public function insert_payment( $payment_id ) {

		/**
		 * @var RCP_Payments $rcp_payments_db
		 */
		global $rcp_payments_db;

		$payment = $rcp_payments_db->get_payment( $payment_id );

		$list_id      = $this->settings['saved_list'];
		$member       = new RCP_Member( $payment->user_id );
		$subscription = rcp_get_subscription_details( $payment->object_id );

		if ( function_exists( 'rcp_log' ) ) {
			rcp_log( sprintf( 'MailChimp Pro: Beginning to process e-commerce order for payment ID #%d.', $payment_id ) );
		}

		// Get or create store.
		$store_id = $this->create_mailchimp_store( $list_id );

		if ( empty( $store_id ) ) {
			return;
		}

		// Maybe create product for the subscription level.
		$this->create_mailchimp_product( $subscription, $store_id );

		$api_key  = trim( $this->settings['api_key'] );

		if ( empty( $api_key ) ) {
			return;
		}

		$data_center = explode( '-', $api_key );
		$data_center = $data_center[1];

		$request_url = 'https://' . urlencode( $data_center ) . '.api.mailchimp.com/3.0/ecommerce/stores/' . urlencode( $store_id ) . '/orders/';

		$order_args = apply_filters( 'rcp_mailchimp_pro_ecommerce_data', array(
			'id'       => (string) $payment_id,
			'customer' => array(
				'id'            => (string) $member->ID,
				'email_address' => $member->user_email,
				'opt_in_status' => false,
				'first_name'    => $member->first_name,
				'last_name'     => $member->last_name,
				// 'orders_count'  => '', // @todo
				// 'total_spent'   => ''
			),
			'financial_status'     => 'pending',
			'fulfillment_status'   => 'pending',
			'currency_code'        => rcp_get_currency(),
			'order_total'          => $payment->amount,
			'discount_total'       => $payment->discount_amount,
			'processed_at_foreign' => $payment->date,
			'lines'                => array(
				array(
					'id'                 => $payment_id . '_' . $payment->subscription_key, // @todo should this be something else?
					'product_id'         => $subscription->id,
					'product_variant_id' => $subscription->id,
					'quantity'           => 1,
					'price'              => $payment->amount,
					'discount'           => $payment->discount_amount
				)
			)
		), $payment_id, (array) $payment );

		$args = array(
			'headers' => array(
				'Authorization' => 'Basic ' . base64_encode( 'user:' . $api_key )
			),
			'body'    => json_encode( $order_args )
		);

		$response = wp_remote_post( $request_url, $args );

		if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
			if ( function_exists( 'rcp_log' ) ) {
				rcp_log( sprintf( 'MailChimp Pro: Error creating e-commerce order. Response code: %d. Response: %s.', wp_remote_retrieve_response_code( $response ), wp_remote_retrieve_body( $response ) ) );
			}

			return;
		}

		if ( function_exists( 'rcp_log' ) ) {
			rcp_log( sprintf( 'MailChimp Pro: Successfully created e-commerce order #%d.', $payment_id ) );
		}
	}

	/**
	 * Retrieve or create the e-commerce store for a MailChimp list.
	 *
	 * @param string $list_id ID of the MailChimp list to create the store for.
	 *
	 * @access public
	 * @since 1.3.3
	 * @return string|false ID of the store on success, false on failure.
	 */
	public function create_mailchimp_store( $list_id ) {

		// The store ID is a combination of the home URL hash and the list ID.
		$store_id = md5( home_url() ) . '-' . $list_id;

		$api_key  = trim( $this->settings['api_key'] );

		if ( empty( $api_key ) ) {
			return false;
		}

		if ( function_exists( 'rcp_log' ) ) {
			rcp_log( sprintf( 'MailChimp Pro: Getting or creating MailChimp store ID %s.', $store_id ) );
		}

		$data_center = explode( '-', $api_key );
		$data_center = $data_center[1];

		// Check if the store ID already exists.
		$request_url = 'https://' . urlencode( $data_center ) . '.api.mailchimp.com/3.0/ecommerce/stores/' . urlencode( $store_id );

		$args = array(
			'headers' => array(
				'Authorization' => 'Basic ' . base64_encode( 'user:' . $api_key )
			)
		);

		$response = wp_remote_get( $request_url, $args );

		// The store already exists!
		if ( ! is_wp_error( $response ) && 200 == wp_remote_retrieve_response_code( $response ) ) {
			if ( function_exists( 'rcp_log' ) ) {
				rcp_log( sprintf( 'MailChimp Pro: Store ID %s already exists.', $store_id ) );
			}

			return $store_id;
		}

		// If the store doesn't exist, we need to create it.
		$request_url = 'https://' . urlencode( $data_center ) . '.api.mailchimp.com/3.0/ecommerce/stores/';

		$body = array(
			'id'             => $store_id,
			'list_id'        => $list_id,
			'name'           => get_bloginfo( 'name' ),
			'platform'       => __( 'Restrict Content Pro', 'rcp' ),
			'domain'         => home_url(),
			'is_syncing'     => false, // @todo enable syncing?
			'email_address'  => get_site_option( 'admin_email' ),
			'currency_code'  => rcp_get_currency(),
			'money_format'   => rcp_currency_filter( '' ),
			'primary_locale' => substr( get_locale(), 0, 2 ),
			'timezone'       => get_option( 'timezone_string' ) // @todo this may not be set?
		);

		$args['body'] = json_encode( $body );

		$response = wp_remote_post( $request_url, $args );

		// Successfully created.
		if ( ! is_wp_error( $response ) && 200 == wp_remote_retrieve_response_code( $response ) ) {
			if ( function_exists( 'rcp_log' ) ) {
				rcp_log( sprintf( 'MailChimp Pro: Successfully created new store ID %s.', $store_id ) );
			}

			return $store_id;
		}

		if ( function_exists( 'rcp_log' ) ) {
			rcp_log( sprintf( 'MailChimp Pro: Failed to create new store ID %s. Response code: %d. Response: %s', $store_id, wp_remote_retrieve_response_code( $response ), wp_remote_retrieve_body( $response ) ) );
		}

		return false;

	}

	/**
	 * Create product in MailChimp e-commerce.
	 *
	 * @param object $subscription_level Subscription level object.
	 * @param string $store_id           ID of the store in MailChimp.
	 *
	 * @access public
	 * @since 1.3.3
	 * @return void
	 */
	public function create_mailchimp_product( $subscription_level, $store_id ) {

		$api_key  = trim( $this->settings['api_key'] );

		if ( empty( $api_key ) ) {
			return;
		}

		if ( function_exists( 'rcp_log' ) ) {
			rcp_log( sprintf( 'MailChimp Pro: Checking for MailChimp product ID %d.', $subscription_level->id ) );
		}

		$data_center = explode( '-', $api_key );
		$data_center = $data_center[1];

		// Check if the store ID already exists.
		$request_url = 'https://' . urlencode( $data_center ) . '.api.mailchimp.com/3.0/ecommerce/stores/' . urlencode( $store_id ) . '/products/' . urlencode( $subscription_level->id );

		$args = array(
			'headers' => array(
				'Authorization' => 'Basic ' . base64_encode( 'user:' . $api_key )
			)
		);

		$response = wp_remote_get( $request_url, $args );

		// The product already exists!
		if ( ! is_wp_error( $response ) && 200 == wp_remote_retrieve_response_code( $response ) ) {
			if ( function_exists( 'rcp_log' ) ) {
				rcp_log( sprintf( 'MailChimp Pro: Product ID %s already exists.', $subscription_level->id ) );
			}

			return;
		}

		// If the store doesn't exist, we need to create it.
		$request_url = 'https://' . urlencode( $data_center ) . '.api.mailchimp.com/3.0/ecommerce/stores/' . urlencode( $store_id ) . '/products/';

		$product_args = array(
			'id'          => (string) $subscription_level->id,
			'title'       => $subscription_level->name,
			'description' => stripslashes( $subscription_level->description ),
			'vendor'      => get_bloginfo( 'name' ),
			'variants'    => array(
				array(
					'id'    => (string) $subscription_level->id,
					'title' => $subscription_level->name,
					'price' => $subscription_level->price
				)
			)
		);

		$args['body'] = json_encode( $product_args );

		$response = wp_remote_post( $request_url, $args );

		// Successfully created.
		if ( ! is_wp_error( $response ) && 200 == wp_remote_retrieve_response_code( $response ) ) {
			if ( function_exists( 'rcp_log' ) ) {
				rcp_log( sprintf( 'MailChimp Pro: Successfully created new product ID %s.', $subscription_level->id ) );
			}

			return;
		}

		if ( function_exists( 'rcp_log' ) ) {
			rcp_log( sprintf( 'MailChimp Pro: Failed to create new product ID %d. Response code: %d. Response: %s', $subscription_level->id, wp_remote_retrieve_response_code( $response ), wp_remote_retrieve_body( $response ) ) );
		}

	}


	/**
	 * Set the status for a user with MailChimp
	 *
	 * @access      public
	 * @since       1.0.1
	 * @param       string     $status     The status to set
	 * @param       int        $id         The user ID
	 * @param       string     $old_status Previous status.
	 * @param       RCP_Member $member     Member object.
	 * @return      void
	 */
	public function set_status( $status, $id, $old_status, $member ) {

		$email     = $member->user_email;
		$level_id  = rcp_get_subscription_id( $id );

		// Bail if no level ID.
		if ( empty( $level_id ) ) {
			return;
		}

		$list     = $this->get_list( $level_id );
		$api_key  = trim( $this->settings['api_key'] );

		// Bail if no API key.
		if ( empty( $api_key ) ) {
			return;
		}

		$subscribed_lists = get_user_meta( $member->ID, 'rcp_mailchimp_pro_subscribed_lists', true );

		if ( empty( $subscribed_lists ) || ! is_array( $subscribed_lists ) ) {
			$subscribed_lists = array( $list );
		}

		foreach ( $subscribed_lists as $list_id ) {
			// Maybe create our custom merge var
			$this->create_merge_var( $list_id );

			$data_center = explode( '-', $api_key );
			$data_center = $data_center[1];

			$request_url = 'https://' . urlencode( $data_center ) . '.api.mailchimp.com/3.0/lists/' . urlencode( $list_id ) . '/members/' . urlencode( md5( strtolower( $email ) ) );

			$request_body = array(
				'email_address' => sanitize_email( $email ),
				'email_type'    => 'html',
				'merge_fields'  => array(
					'FNAME'  => $member->first_name,
					'LNAME'  => $member->last_name,
					'STATUS' => $status
				)
			);

			$args = array(
				'method'  => 'PATCH',
				'headers' => array(
					'Authorization' => 'Basic ' . base64_encode( 'user:' . $api_key )
				),
				'body'    => json_encode( $request_body )
			);

			rcp_log( sprintf( 'Updating MailChimp STATUS merge var to %s on list ID %s for user ID #%d.', $status, $list_id, $member->ID ) );

			$response = wp_remote_request( $request_url, $args );

			if ( is_wp_error( $response ) ) {
				rcp_log( sprintf( 'MailChimp Error: Failed to update user on status change for list ID %s: %s', $level_id, $response->get_error_message() ) );
			} else {
				rcp_log( sprintf( 'Successfully updated STATUS merge var on list ID %s for user ID #%d.', $list_id, $member->ID ) );
			}
		}
	}

}
