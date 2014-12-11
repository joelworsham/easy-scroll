<?php
/**
 * Defines the plugin core class.
 *
 * @since 0.2.0
 * @package EasyScroll
 * @subpackage EasyScroll\Core
 */
namespace EasyScroll\Core;

// Don't load this file directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Class Core
 *
 * The main class for EasyScroll. This class will get things started off by
 * adding scripts and localizing variables.
 *
 * @since 0.1
 */
class Core {

	/**
	 * Prevent cloning of this instance.
	 *
	 * @since 0.2.0
	 */
	private function __clone() {
	}

	/**
	 * Prevent unserializing of this instance.
	 *
	 * @since 0.2.0
	 */
	private function __wakeup() {
	}

	/**
	 * Used to get the instance of this class, but only once!
	 *
	 * @since 0.2.0
	 *
	 * @return Core The object's instance.
	 */
	public static function getInstance() {

		static $instance = null;

		if ( $instance === null ) {
			$instance = new self;
		}

		return $instance;
	}

	/**
	 * The construct function for the class.
	 *
	 * @since 0.1
	 */
	private function __construct() {

		$this->load_dependencies();
		$this->set_locale();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * @since  0.2.0
	 * @access private
	 */
	private function load_dependencies() {

		// Responsible for setting up this plugin internationalization functionality
		require_once __DIR__ . '/class-i18n.php';

		// Responsible for all core plugin functionality
		require_once __DIR__ . '/core-functionality.php';

		if ( ! is_admin() ) {
			require_once __DIR__ . '/frontend/class-frontend.php';
		} else {
			require_once __DIR__ . '/admin/class-admin.php';
		}
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Plugin_Name_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since  0.2.0
	 * @access private
	 */
	private function set_locale() {

		$plugin_i18n = new i18n();
		$plugin_i18n->set_domain( EASYSCROLL_NAME );

		add_action( 'plugins_loaded', array( $plugin_i18n, 'load_plugin_textdomain' ) );
	}
}

