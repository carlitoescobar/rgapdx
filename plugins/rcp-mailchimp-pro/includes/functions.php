<?php
/**
 * Helper functions
 *
 * @package     RCP\MailChimpPro\Functions
 * @since       1.0.0
 */


// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Get MailChimp subscription lists
 *
 * @since       1.0.0
 * @return      array|false $lists array The list of available lists or false on failure.
 */
function rcp_mailchimp_pro_get_lists() {

	$lists = get_transient( 'rcp_mailchimp_pro_lists' );

	// Return cached lists if it exists.
	if ( ! empty( $lists ) ) {
		return $lists;
	}

	$settings = get_option( 'rcp_mailchimp_pro_settings' );

	$api_key = ! empty( $settings['api_key'] ) ? trim( $settings['api_key'] ) : false;

	// No API key - bail.
	if ( empty( $api_key ) ) {
		return false;
	}

	$data_center = explode( '-', $api_key );
	$data_center = $data_center[1];

	$request_url  = 'https://' . urlencode( $data_center ) . '.api.mailchimp.com/3.0/lists/?count=50';
	$request_args = array(
		'headers' => array(
			'Authorization' => 'Basic ' . base64_encode( 'user:' . $api_key )
		)
	);

	$response = wp_remote_get( $request_url, $request_args );

	if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
		return false;
	}

	$data = json_decode( wp_remote_retrieve_body( $response ), true );

	if ( empty( $data['lists'] ) || ! is_array( $data['lists'] ) ) {
		return false;
	}

	$lists = array();

	foreach ( $data['lists'] as $list_info ) {
		$lists[ $list_info['id'] ] = $list_info['name'];
	}

	set_transient( 'rcp_mailchimp_pro_lists', $lists, DAY_IN_SECONDS );

	return $lists;

}


/**
 * Check if we should show the subscription field
 *
 * @since       1.0.0
 * @param       int $level A specific level to check
 * @return      bool $show True to show, false otherwise
 */
function rcp_mailchimp_pro_show_checkbox() {
	$settings = get_option( 'rcp_mailchimp_pro_settings' );
	$lists    = get_option( 'rcp_mailchimp_pro_subscription_lists' );
	$show     = false;

	if( ! empty( $settings['api_key'] ) ) {
		if( ! empty( $settings['saved_list'] ) ) {
			$show = true;
		}

		if( is_array( $lists ) ) {
			$show = true;
		}
	}

	return $show;
}


/**
 * Get interest groups for MailChimp lists
 *
 * @since       1.2.3
 * @param       string $list
 * @return      object|false Response object from MailChimp or false on failure.
 */
function rcp_mailchimp_pro_get_groups( $list ) {

	$groups = get_transient( 'rcp_mailchimp_pro_list_groups_' . $list );

	// Return cached groups if it exists.
	if ( ! empty( $groups ) ) {
		return $groups;
	}

	$settings = get_option( 'rcp_mailchimp_pro_settings' );

	$api_key = ! empty( $settings['api_key'] ) ? trim( $settings['api_key'] ) : false;

	// No API key - bail.
	if ( empty( $api_key ) ) {
		return false;
	}

	$data_center = explode( '-', $api_key );
	$data_center = $data_center[1];

	$request_url  = 'https://' . urlencode( $data_center ) . '.api.mailchimp.com/3.0/lists/' . urlencode( $list ) . '/interest-categories/?count=100';
	$request_args = array(
		'headers' => array(
			'Authorization' => 'Basic ' . base64_encode( 'user:' . $api_key )
		)
	);

	$response = wp_remote_get( $request_url, $request_args );

	if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
		return false;
	}

	$response_body = json_decode( wp_remote_retrieve_body( $response ) );

	if ( is_object( $response_body ) ) {
		set_transient( 'rcp_mailchimp_pro_list_groups_' . $list, $response_body, DAY_IN_SECONDS );
	}

	return $response_body;
}

/**
 * Get interests in a given interest category
 *
 * @param string $list_id              ID of the list to get interests from.
 * @param string $interest_category_id ID of the interest category to get interests from.
 *
 * @since 1.3.3
 * @return array|false Array of interests (`id` => `name`) or false on failure.
 */
function rcp_mailchimp_pro_get_interests( $list_id, $interest_category_id ) {

	$settings = get_option( 'rcp_mailchimp_pro_settings' );

	$api_key = ! empty( $settings['api_key'] ) ? trim( $settings['api_key'] ) : false;

	// No API key - bail.
	if ( empty( $api_key ) ) {
		return false;
	}

	$data_center = explode( '-', $api_key );
	$data_center = $data_center[1];

	$request_url  = 'https://' . urlencode( $data_center ) . '.api.mailchimp.com/3.0/lists/' . urlencode( $list_id ) . '/interest-categories/' . urlencode( $interest_category_id ) . '/interests/?count=100';
	$request_args = array(
		'headers' => array(
			'Authorization' => 'Basic ' . base64_encode( 'user:' . $api_key )
		)
	);

	$response = wp_remote_get( $request_url, $request_args );

	if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
		return false;
	}

	$response_body = json_decode( wp_remote_retrieve_body( $response ), true );

	$interests = array();

	if ( ! empty( $response_body['interests'] ) && is_array( $response_body['interests'] ) ) {
		foreach ( $response_body['interests'] as $interest ) {
			$interests[ $interest['id'] ] = $interest['name'];
		}
	}

	return $interests;

}