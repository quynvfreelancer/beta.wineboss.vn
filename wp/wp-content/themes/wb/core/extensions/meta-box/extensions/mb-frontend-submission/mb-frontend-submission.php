<?php
/**
 * Plugin Name: MB Frontend Submission
 * Plugin URI:  https://metabox.io/plugins/mb-frontend-submission
 * Description: Submit posts and custom fields in the frontend.
 * Version:     2.0.6
 * Author:      MetaBox.io
 * Author URI:  https://metabox.io
 * License:     GPL2+
 * Text Domain: mb-frontend-submission
 * Domain Path: /languages/
 *
 * @package    Meta Box
 * @subpackage MB Frontend Submission
 */

// Prevent loading this file directly.
defined( 'ABSPATH' ) || die;

if ( ! function_exists( 'mb_frontend_submission_load' ) ) {
	if ( file_exists( __DIR__ . '/vendor' ) ) {
		require __DIR__ . '/vendor/autoload.php';
	}

	/**
	 * Hook to 'init' with priority 10 to make sure all meta boxes are registered.
	 */
	add_action( 'init', 'mb_frontend_submission_load', 20 );

	/**
	 * Load plugin files after Meta Box is loaded
	 */
	function mb_frontend_submission_load() {
		if ( ! defined( 'RWMB_VER' ) ) {
			return;
		}

		define( 'MBFS_DIR', __DIR__ );
		list( , $url ) = RWMB_Loader::get_path( MBFS_DIR );
		define( 'MBFS_URL', $url );

		load_plugin_textdomain( 'mb-frontend-submission', false, basename( MBFS_DIR ) . '/languages' );

		new MBFS\Shortcode;
	}
}
