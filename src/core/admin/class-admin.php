<?php
/**
 * Back-end (dashboard) base functionality.
 *
 * @since      0.2.0
 * @package    EasyScroll\
 * @subpackage EasyScroll\Admin
 */
namespace EasyScroll\Admin;

// Don't load this file directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Class Admin
 *
 * Sets up the back-end functionality.
 *
 * @since      0.2.0
 * @package    EasyScroll\
 * @subpackage EasyScroll\Admin
 * @author     Joel Worsham <joelworsham@gmail.com>
 */
class Admin {

	/**
	 * The construct function.
	 *
	 * @since 0.1
	 */
	function __construct() {

		$this->load_dependencies();
		$this->add_actions();
	}

	private function load_dependencies() {

		// Functionality for the admin
		require_once __DIR__ . '/functions.php';

		// Responsible for adding and displaying the settings page
		require_once __DIR__ . '/class-settings.php';
		$plugin_settings = new Settings();
	}

	private function add_actions() {

		// Register and enqueue our back-end scripts
		add_action( 'admin_init', array( $this, 'register_backend_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_backend_scripts' ) );
	}

	/**
	 * Registers back-end scripts.
	 *
	 * @since 0.1
	 */
	public function register_backend_scripts() {
		wp_register_script( 'easy-scroll-admin', EASYSCROLL_URL . '/assets/js/easyscroll-admin.js', array( 'jquery' ), '0.1', true );
		wp_register_style( 'easy-scroll-admin', EASYSCROLL_URL . '/assets/css/easyscroll-admin.css', array(), '0.1' );
	}

	/**
	 * Enqueues back-end scripts.
	 *
	 * @since 0.1
	 */
	public function enqueue_backend_scripts() {

		$data = array(
			'easy_scroll_dir' => EASYSCROLL_PATH
		);

		wp_localize_script( 'easy-scroll-admin', 'easy_scroll_data', $data );

		wp_enqueue_script( 'easy-scroll-admin' );
		wp_enqueue_style( 'easy-scroll-admin' );
	}
}

new Admin();