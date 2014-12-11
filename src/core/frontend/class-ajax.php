<?php
/**
 * All front-end AJAX functionality.
 *
 * @since      0.2.0
 * @package    EasyScroll
 * @subpackage EasyScroll\Frontend\AJAX
 */
namespace EasyScroll\Frontend\AJAX;

// Don't load this file directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Class AJAX
 *
 * This class houses all front-end AJAX functionality within the plugin.
 *
 * @since      0.2.0
 * @package    EasyScroll\
 * @subpackage EasyScroll\Frontend\AJAX
 */
class AJAX {

	/**
	 * The construct function
	 *
	 * @since 0.1
	 */
	function __construct() {

		// Add our ajax function
		add_action( 'wp_ajax_easy_scroll', array( $this, 'easy_scroll_callback' ) );
		add_action( 'wp_ajax_nopriv_easy_scroll', array( $this, 'easy_scroll_callback' ) );
	}

	/**
	 * The main easyscroll callback.
	 *
	 * @since 0.1
	 */
	public function easy_scroll_callback() {
		// Gather our data sent
		$post_offset = $_GET['post_offset'];
		$post_count  = $_GET['post_count'];

		// Get options
		$post_type    = get_option( 'easy_scroll_post_type', EasyScroll_Admin::$option_defaults['post_type'] );
		$post_order   = get_option( 'easy_scroll_post_order', EasyScroll_Admin::$option_defaults['post_order'] );
		$post_orderby = get_option( 'easy_scroll_post_orderby', EasyScroll_Admin::$option_defaults['post_orderby'] );

		// Set up meta value if set
		if ( $post_orderby == 'meta_val' || $post_orderby == 'meta_val_num' ) {
			$post_meta_val = get_option( 'easy_scroll_meta_val', EasyScroll_Admin::$option_defaults['meta_val'] );
		} else {
			$post_meta_val = null;
		}

		// Query our posts based off of the offset and post count
		$posts = get_posts( array(
			'meta_key'       => $post_meta_val,
			'offset'         => $post_offset,
			'posts_per_page' => $post_count,
			'post_type'      => $post_type,
			'order'          => $post_order,
			'orderby'        => $post_orderby
		) );

		// Build and output each post
		if ( ! empty ( $posts ) ) {
			foreach ( $posts as $post ) {
				new EasyScroll_Post( $post->ID );
			}
		} else {
			echo 'false';
		}

		die();
	}
}