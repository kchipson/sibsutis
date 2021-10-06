<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themeisle.com
 * @since             1.0.0
 * @package           Orbit_Fox
 *
 * @wordpress-plugin
 * Plugin Name:       Orbit Fox Companion
 * Plugin URI:        https://orbitfox.com/
 * Description:       This swiss-knife plugin comes with a quality template library, menu/sharing icons modules, Gutenberg blocks, and newly added Elementor/BeaverBuilder page builder widgets on each release.
 * Version:           2.8.14
 * Author:            Themeisle
 * Author URI:        https://orbitfox.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       themeisle-companion
 * Domain Path:       /languages
 * WordPress Available:  yes
 * Requires License:    no
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in core/includes/class-orbit-fox-activator.php
 */
function activate_orbit_fox() {
	$obfx_activator = new Orbit_Fox_Activator();
	$obfx_activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in core/includes/class-orbit-fox-deactivator.php
 */
function deactivate_orbit_fox() {
	$obfx_deactivator = new Orbit_Fox_Deactivator();
	$obfx_deactivator->deactivate();
}

register_activation_hook( __FILE__, 'activate_orbit_fox' );
register_deactivation_hook( __FILE__, 'deactivate_orbit_fox' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_orbit_fox() {
	define( 'OBFX_URL', plugins_url( '/', __FILE__ ) );
	define( 'OBX_PATH', dirname( __FILE__ ) );
	$plugin = new Orbit_Fox();
	$plugin->run();
	$vendor_file = OBX_PATH . '/vendor/autoload.php';
	if ( is_readable( $vendor_file ) ) {
		require_once $vendor_file;
	}
	add_filter(
		'themeisle_sdk_products',
		function ( $products ) {
			$products[] = __FILE__;

			return $products;
		}
	);
	add_filter(
		'themeisle_companion_friendly_name',
		function( $name ) {
			return 'Orbit Fox';
		}
	);
}

require( 'class-autoloader.php' );
Autoloader::set_plugins_path( plugin_dir_path( __DIR__ ) );
Autoloader::define_namespaces( array( 'Orbit_Fox', 'OBFX', 'OBFX_Module' ) );
/**
 * Invocation of the Autoloader::loader method.
 *
 * @since   1.0.0
 */
spl_autoload_register( array( 'Autoloader', 'loader' ) );

/**
 * The start of the app.
 *
 * @since   1.0.0
 */
run_orbit_fox();
