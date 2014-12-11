<?php
/**
 * The plugin bootstrap file.
 *
 * @link    https://github.com/joelworsham/easy-scroll
 * @since   0.2.0
 * @package EasyScroll
 *
 * @wordpress-plugin
 * Plugin Name: EasyScroll
 * Plugin URI:  https://wordpress.org/plugins/easy-scroll/
 * Description: An infinite scroll plugin that allows posts to be output on any page without the need for a page
 * refresh.
 * Version:     0.2.0
 * Author:      Joel Worsham
 * Author URI:  http://joelworsham.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: Easy Scroll
 * Domain Path: /languages
 */

namespace EasyScroll;

// Don't load this file directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

define( 'EASYSCROLL_VER', '0.2.0' );
define( 'EASYSCROLL_NAME', 'Easy Scroll' );
define( 'EASYSCROLL_PATH', plugin_dir_path( __FILE__ ) );
define( 'EASYSCROLL_URL', plugin_dir_url( __FILE__ ) );

// Make sure the server is running PHP 5.3 or higher (required for many functions, including namespacing)
if ( version_compare( phpversion(), '5.3.0', '<' ) ) {

	add_action( 'admin_notices', 'php_version_nag' );

	function php_version_nag() {
		?>
		<div class="update-nag">
			<?php printf(
				__(
					'%s requires PHP to be at least version 5.3. You are currently running %s. Please contact your system administrator so you can upgrade your server to at least PHP version 5.3',
					EASYSCROLL_NAME
				),
				EASYSCROLL_NAME,
				phpversion()
			); ?>
		</div>
	<?php
	}
}

// Require the main plugin class and then run it.
require_once __DIR__ . '/core/class-core.php';

$plugin = Core\Core::getInstance();