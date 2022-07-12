<?php 
add_action('init', 'wb_session_start', 1);
add_action('wp_logout', 'wb_session_destroy');
add_action('wp_login', 'wb_session_destroy');

function wb_session_start() {
	if(!session_id()) {
		session_start();
	}
}

function wb_session_destroy() {
	session_destroy ();
}