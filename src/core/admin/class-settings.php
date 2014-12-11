<?php
/**
 * Back-end (dashboard) base functionality.
 *
 * @since      0.2.0
 * @package    EasyScroll
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
class Settings {

	/**
	 * All of the settings page's options.
	 *
	 * @since 0.1
	 */
	public $options;

	/**
	 * All option defaults.
	 *
	 * @since 0.1
	 */
	private $option_defaults;

	public function __construct() {

		$this->add_actions();
		$this->establish_option_defaults();
		$this->get_options();
	}

	private function add_actions() {

		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Adds the options page to the admin menu.
	 *
	 * @since 0.1
	 */
	public function add_options_page() {

		add_options_page(
			'EasyScroll Settings',
			'EasyScroll',
			'manage_options',
			'easy-scroll',
			array( $this, 'output' )
		);
	}

	/**
	 * Registers all of EasyScroll's settings.
	 *
	 * @since 0.1
	 */
	public function register_settings() {

		register_setting( 'easy_scroll', 'easy_scroll_inject_location' );
		register_setting( 'easy_scroll', 'easy_scroll_post_container' );
		register_setting( 'easy_scroll', 'easy_scroll_window_offset' );
		register_setting( 'easy_scroll', 'easy_scroll_template' );
		register_setting( 'easy_scroll', 'easy_scroll_footer' );

		register_setting( 'easy_scroll', 'easy_scroll_home' );
		register_setting( 'easy_scroll', 'easy_scroll_pages' );

		register_setting( 'easy_scroll', 'easy_scroll_post_count' );
		register_setting( 'easy_scroll', 'easy_scroll_post_type' );
		register_setting( 'easy_scroll', 'easy_scroll_post_order' );
		register_setting( 'easy_scroll', 'easy_scroll_post_orderby' );
		register_setting( 'easy_scroll', 'easy_scroll_meta_val' );

		register_setting( 'easy_scroll', 'easy_scroll_loader' );
		register_setting( 'easy_scroll', 'easy_scroll_loader_width' );
		register_setting( 'easy_scroll', 'easy_scroll_loader_height' );
		register_setting( 'easy_scroll', 'easy_scroll_loader_opacity' );
	}

	private function establish_option_defaults() {

		$this->option_defaults = array(
			'post_count'      => 1,
			'window_offset'   => '0',
			'inject_location' => 'content',
			'post_container'  => 'post',
			'loader'          => 'pulse',
			'loader_width'    => 100,
			'loader_height'   => 100,
			'loader_opacity'  => 0.8,
			'home'            => '1',
			'pages'           => null,
			'footer'          => 'true',
			'post_type'       => 'post',
			'post_order'      => 'DSC',
			'post_orderby'    => 'date',
			'meta_val'        => null,
			'template'        => file_get_contents( EASYSCROLL_PATH . 'core/admin/views/html-post-template.php' ),
		);
	}

	private function get_options() {

		// Set up all of our options
		foreach ( $this->option_defaults as $option => $default ) {
			$this->options[ $option ] = get_option( 'easy_scroll_inject_location', $default );
		}
	}

	public function output() {
		include __DIR__ . '/views/html-settings.php';
	}
}