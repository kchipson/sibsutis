<?php
/**
 * Plugin Name: WPForms Lite
 * Plugin URI:  https://wpforms.com
 * Description: Beginner friendly WordPress contact form plugin. Use our Drag & Drop form builder to create your WordPress forms.
 * Author:      WPForms
 * Author URI:  https://wpforms.com
 * Version:     1.5.7
 * Text Domain: wpforms-lite
 * Domain Path: languages
 *
 * WPForms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * WPForms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WPForms. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Plugin version.
if ( ! defined( 'WPFORMS_VERSION' ) ) {
	define( 'WPFORMS_VERSION', '1.5.7' );
}

// Plugin Folder Path.
if ( ! defined( 'WPFORMS_PLUGIN_DIR' ) ) {
	define( 'WPFORMS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

// Plugin Folder URL.
if ( ! defined( 'WPFORMS_PLUGIN_URL' ) ) {
	define( 'WPFORMS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

// Plugin Root File.
if ( ! defined( 'WPFORMS_PLUGIN_FILE' ) ) {
	define( 'WPFORMS_PLUGIN_FILE', __FILE__ );
}

// Don't allow multiple versions to be active.
if ( function_exists( 'wpforms' ) ) {

	if ( ! function_exists( 'wpforms_deactivate' ) ) {
		/**
		 * Deactivate if WPForms already activated.
		 * Called on-premise.
		 *
		 * @since 1.0.0
		 */
		function wpforms_deactivate() {
			deactivate_plugins( plugin_basename( __FILE__ ) );
		}
	}
	add_action( 'admin_init', 'wpforms_deactivate' );

	if ( ! function_exists( 'wpforms_lite_notice' ) ) {
		/**
		 * Display the notice after deactivation.
		 *
		 * @since 1.0.0
		 */
		function wpforms_lite_notice() {

			echo '<div class="notice notice-warning"><p>' . esc_html__( 'Please deactivate WPForms Lite before activating WPForms.', 'wpforms-lite' ) . '</p></div>';

			if ( isset( $_GET['activate'] ) ) { //phpcs:ignore
				unset( $_GET['activate'] );
			}
		}
	}
	add_action( 'admin_notices', 'wpforms_lite_notice' );

	// Do not process the plugin code further.
	return;
}

// We require PHP 5.4 for the whole plugin to work.
if ( version_compare( phpversion(), '5.4', '<' ) ) {

	if ( ! function_exists( 'wpforms_php52_notice' ) ) {
		/**
		 * Display the notice after deactivation.
		 *
		 * @since 1.5.0
		 */
		function wpforms_php52_notice() {
			?>
			<div class="notice notice-error">
				<p>
					<?php
					printf(
						wp_kses(
							/* translators: %1$s - WPBeginner URL for recommended WordPress hosting. */
							__( 'Your site is running an <strong>insecure version</strong> of PHP that is no longer supported. Please contact your web hosting provider to update your PHP version or switch to a <a href="%1$s" target="_blank" rel="noopener noreferrer">recommended WordPress hosting company</a>.', 'wpforms-lite' ),
							array(
								'a'      => array(
									'href'   => array(),
									'target' => array(),
									'rel'    => array(),
								),
								'strong' => array(),
							)
						),
						'https://www.wpbeginner.com/wordpress-hosting/'
					);
					?>
					<br><br>
					<?php
					printf(
						wp_kses(
							/* translators: %1$s - WPForms.com URL for documentation with more details. */
							__( '<strong>Note:</strong> WPForms plugin is disabled on your site until you fix the issue. <a href="%1$s" target="_blank" rel="noopener noreferrer">Read more for additional information.</a>', 'wpforms-lite' ),
							array(
								'a'      => array(
									'href'   => array(),
									'target' => array(),
									'rel'    => array(),
								),
								'strong' => array(),
							)
						),
						'https://wpforms.com/docs/supported-php-version/'
					);
					?>
				</p>
			</div>

			<?php
			// In case this is on plugin activation.
			if ( isset( $_GET['activate'] ) ) { //phpcs:ignore
				unset( $_GET['activate'] );
			}
		}
	}
	add_action( 'admin_notices', 'wpforms_php52_notice' );

	// Do not process the plugin code further.
	return;
}

// Define the class and the function.
require_once dirname( __FILE__ ) . '/src/WPForms.php';

wpforms();
