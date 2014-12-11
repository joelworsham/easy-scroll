<?php
/**
 * Prepares the plugin for translation.
 *
 * @since      0.2.0
 * @package    EasyScroll
 * @subpackage EasyScroll\Core
 */
namespace EasyScroll\Core;

// Don't load this file directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Class i18n
 *
 * Sets up the internationalization functionality.
 *
 * @since      0.2.0
 * @package    EasyScroll\
 * @subpackage EasyScroll\i18n
 * @author Joel Worsham <joelworsham@gmail.com>
 */
class i18n {

	/**
	 * The domain for this plugin.
	 *
	 * @since  0.2.0
	 * @access private
	 * @var string The domain for this plugin.
	 */
	private $domain;

	/**
	 * Loads the plugin text domain for translation.
	 *
	 * @since 0.2.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			$this->domain,
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}

	/**
	 * Set the domain to the specified domain.
	 *
	 * @since 0.2.0
	 * @param string $domain The domain that represents the locale of this plugin.
	 */
	public function set_domain( $domain ) {
		$this->domain = $domain;
	}
}