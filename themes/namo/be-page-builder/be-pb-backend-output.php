<?php

function be_pb_text_output($m){
	return wpautop($m[5]);
}

function be_pb_blockquote_output($m){
	return do_shortcode($m[0]);
}

function be_pb_special_heading_output($m){
	return do_shortcode($m[0]);
}

function be_pb_title_icon_output($m){
	return do_shortcode($m[0]);
}

function be_pb_button_output($m){
	return do_shortcode($m[0]);
}

function be_pb_dropcap_output($m){
	return do_shortcode($m[0]);
}

function be_pb_notifications_output($m){
	return do_shortcode($m[0]);
}

function be_pb_services_output($m){
	return do_shortcode($m[0]);
}

function be_pb_team_output($m){
	return do_shortcode($m[0]);
}
function be_pb_call_to_action_output($m){
	return do_shortcode($m[0]);
}
?>