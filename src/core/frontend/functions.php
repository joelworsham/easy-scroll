<?php
/**
 * Public facing functions.
 *
 * @since      0.2.0
 * @package    EasyScroll
 * @subpackage EasyScroll\FrontEnd\Functions
 */
namespace EasyScroll\FrontEnd\Functions;

// Don't load this file directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Determines if EasyScroll is enabled on current page.
 *
 * @since 0.1
 *
 * @return bool True if enabled on current page, false if not.
 */
function is_enabled() {

	global $post;

	// Get options
	$use_pages = explode( ',', str_replace( ' ', '', get_option( 'easy_scroll_pages' ) ) );
	$use_home  = get_option( 'easy_scroll_home', EasyScroll_Admin::$option_defaults['home'] );

	// Bail if parameters not met
	if ( isset( $post ) && $use_pages && ! in_array( $post->ID, $use_pages ) ) {
		return false;
	}

	if ( ! $use_home && is_home() ) {
		return false;
	}

	return true;
}