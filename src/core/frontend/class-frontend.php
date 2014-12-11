<?php
/**
 * Front-end base functionality.
 *
 * @since      0.2.0
 * @package    EasyScroll
 * @subpackage EasyScroll\Frontend
 */
namespace EasyScroll\Frontend;

// Don't load this file directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Class FrontEnd
 *
 * Sets up the front-end functionality.
 *
 * @since      0.2.0
 * @package    EasyScroll\
 * @subpackage EasyScroll\FrontEnd
 * @author     Joel Worsham <joelworsham@gmail.com>
 */
class FrontEnd {

	public function __construct() {

		$this->load_dependencies();
		$this->add_actions();
	}

	/**
	 * Load the required dependencies for the front-end.
	 *
	 * @since  0.2.0
	 * @access private
	 */
	private function load_dependencies() {

		// Supplies all front-end helper functions
		require_once __DIR__ . '/functions.php';

		// Responsible for front-end AJAX functionality
		require_once __DIR__ . '/class-ajax.php';

		// Responsible for loading the post in the infinite scroll
		require_once __DIR__ . '/class-post.php';
	}

	private function add_actions() {

		// Displays the Easy Scroll footer
		add_action( 'wp_footer', array( $this, 'the_footer' ) );

		// Register and enqueue our front-end scripts
		add_action( 'init', array( $this, 'register_frontend_scripts' ) );

		// Add scripts only if easyscroll is enabled on current page
		if ( Functions\is_enabled() ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_scripts' ) );
		}
	}

	/**
	 * Registers front-end scripts.
	 *
	 * @since 0.1
	 */
	public function register_frontend_scripts() {
		wp_register_script( 'easy-scroll-main', plugins_url( 'js/easyscroll-main.js', __FILE__ ), array( 'jquery' ), '0.1', true );
		wp_register_style( 'easy-scroll-main', plugins_url( 'css/easyscroll-main.css', __FILE__ ), array(), '0.1' );
	}

	/**
	 * Enqueues front-end scripts.
	 *
	 * @since 0.1
	 */
	public function enqueue_frontend_scripts() {
		$data = array(
			'easy_scroll_dir' => EASYSCROLL_PATH,
			'loader'          => get_option( 'easy_scroll_loader', EasyScroll_Admin::$option_defaults['loader'] ),
			'loader_width'    => get_option( 'easy_scroll_loader_width', EasyScroll_Admin::$option_defaults['loader_width'] ),
			'loader_height'   => get_option( 'easy_scroll_loader_height', EasyScroll_Admin::$option_defaults['loader_height'] ),
			'loader_opacity'  => get_option( 'easy_scroll_loader_opacity', EasyScroll_Admin::$option_defaults['loader_opacity'] ),
			'post_count'      => get_option( 'easy_scroll_post_count', EasyScroll_Admin::$option_defaults['post_count'] ),
			'ajax_url'        => admin_url( 'admin-ajax.php' ),
			'base_url'        => 'http://' . $_SERVER['SERVER_NAME'],
			'inject_location' => get_option( 'easy_scroll_inject_location', EasyScroll_Admin::$option_defaults['inject_location'] ),
			'post_container'  => get_option( 'easy_scroll_post_container', EasyScroll_Admin::$option_defaults['post_container'] ),
			'window_offset'   => get_option( 'easy_scroll_window_offset', EasyScroll_Admin::$option_defaults['window_offset'] )
		);

		wp_localize_script( 'easy-scroll-main', 'easy_scroll_data', $data );

		wp_enqueue_script( 'easy-scroll-main' );
		wp_enqueue_style( 'easy-scroll-main' );
	}

	/**
	 * Outputs the arrows at the bottom of the page, signaling
	 * the viewer to scroll down to reveal more posts
	 *
	 * @since 0.1
	 */
	public function the_footer() {

		global $EasyScroll;

		// Bail if not enabled on current page
		if ( ! Functions\is_enabled() ) {
			return;
		}

		// Bail if option set to off
		if ( ! get_option( 'easy_scroll_footer', EasyScroll_Admin::$option_defaults['footer'] ) ) {
			return;
		}
	}
}