<?php

namespace WPForms\Lite\Admin;

use WP_Error;
use WPForms\Helpers\PluginSilentUpgrader;

/**
 * WPForms Connect.
 *
 * WPForms Connect is our service that makes it easy for non-techy users to
 * upgrade to WPForms Pro without having to manually install WPForms Pro plugin.
 *
 * @since      1.5.5
 * @author     WPForms
 * @package    WPForms\Admin
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2019, WPForms LLC
 */
class Connect {

	/**
	 * Constructor.
	 *
	 * @since 1.5.5
	 */
	public function __construct() {

		$this->hooks();
	}

	/**
	 * Hooks.
	 *
	 * @since 1.5.5
	 */
	public function hooks() {

		\add_action( 'wpforms_settings_enqueue', array( $this, 'settings_enqueues' ) );

		\add_action( 'wp_ajax_wpforms_connect_url', array( $this, 'generate_url' ) );

		\add_action( 'wp_ajax_nopriv_wpforms_connect_process', array( $this, 'process' ) );
	}

	/**
	 * Settings page enqueues.
	 *
	 * @since 1.5.5
	 */
	public function settings_enqueues() {

		$min = \wpforms_get_min_suffix();

		\wp_enqueue_script(
			'wpforms-connect',
			\WPFORMS_PLUGIN_URL . "lite/assets/js/admin/connect{$min}.js",
			array( 'jquery' ),
			\WPFORMS_VERSION,
			true
		);
	}

	/**
	 * Generates and returns WPForms Connect URL.
	 *
	 * @since 1.5.5
	 */
	public function generate_url() {

		$this->init_error_handler();

		try {

			// Run a security check.
			\check_ajax_referer( 'wpforms-admin', 'nonce' );

			// Check for permissions.
			if ( ! \current_user_can( 'install_plugins' ) ) {
				\wp_send_json_error(
					array(
						'message' => \esc_html__( 'Sorry, you do not have permission to install plugins.', 'wpforms-lite' )
					)
				);
			}

			$key = ! empty( $_POST['key'] ) ? \sanitize_text_field( \wp_unslash( $_POST['key'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification

			if ( empty( $key ) ) {
				\wp_send_json_error(
					array(
						'message' => \esc_html__( 'Please enter your license key to connect.', 'wpforms-lite' )
					)
				);
			}

			if ( wpforms()->pro ) {
				\wp_send_json_error(
					array( 'message' => \esc_html__( 'Only the Lite version can upgrade.', 'wpforms-lite' )
					)
				);
			}

			// Verify pro version is not installed.
			$active = \activate_plugin( 'wpforms/wpforms.php', false, false, true );

			if ( ! \is_wp_error( $active ) ) {

				// Deactivate Lite.
				\deactivate_plugins( \plugin_basename( WPFORMS_PLUGIN_FILE ) );

				\wp_send_json_success(
					array(
						'message' => \esc_html__( 'WPForms Pro was already installed and has not been activated.', 'wpforms-lite' ),
						'reload'  => true,
					)
				);
			}

			// Generate URL.
			$oth = hash( 'sha512', \wp_rand() );

			\update_option( 'wpforms_connect_token', $oth );
			\update_option( 'wpforms_connect', $key );

			$version  = WPFORMS_VERSION;
			$endpoint = \admin_url( 'admin-ajax.php' );
			$redirect = \admin_url( 'admin.php?page=wpforms-settings' );
			$url      = \add_query_arg(
				array(
					'key'      => $key,
					'oth'      => $oth,
					'endpoint' => $endpoint,
					'version'  => $version,
					'siteurl'  => \admin_url(),
					'homeurl'  => \home_url(),
					'redirect' => rawurldecode( base64_encode( $redirect ) ), // phpcs:ignore
					'v'        => 2,
				),
				'https://upgrade.wpforms.com'
			);

			\wp_send_json_success(
				array(
					'url'      => $url,
					'back_url' => \add_query_arg(
						array(
							'action' => 'wpforms_connect',
							'oth'    => $oth,
						),
						$endpoint
					),
				)
			);

		} catch ( \Exception $e ) {

			\wp_send_json_error(
				array( 'error' => $e->getMessage() . ' in file ' . $e->getFile() . ', line ' . $e->getLine() )
			);
		}
	}

	/**
	 * Process WPForms Connect.
	 *
	 * @since 1.5.5
	 */
	public function process() {

		$this->init_error_handler();

		try {

			$error = esc_html__( 'Could not install upgrade. Please download from wpforms.com and install manually.', 'wpforms-lite' );

			// Verify params present (oth & download link).
			$post_oth = ! empty( $_REQUEST['oth'] ) ? \sanitize_text_field( \wp_unslash( $_REQUEST['oth'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
			$post_url = ! empty( $_REQUEST['file'] ) ? \esc_url_raw( \wp_unslash( $_REQUEST['file'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification

			if ( empty( $post_oth ) || empty( $post_url ) ) {
				\wp_send_json_error( $error );
			}

			// Verify oth.
			$oth = \get_option( 'wpforms_connect_token' );

			if ( empty( $oth ) || ! hash_equals( $oth, $post_oth ) ) {
				\wp_send_json_error( $error );
			}

			// Delete so cannot replay.
			\delete_option( 'wpforms_connect_token' );

			// Set the current screen to avoid undefined notices.
			\set_current_screen( 'wpforms_page_wpforms-settings' );

			// Prepare variables.
			$url = \esc_url_raw(
				\add_query_arg(
					array(
						'page' => 'wpforms-settings',
					),
					\admin_url( 'admin.php' )
				)
			);

			// Verify pro not activated.
			if ( wpforms()->pro ) {
				\wp_send_json_success( \esc_html__( 'Plugin installed & activated.', 'wpforms-lite' ) );
			}

			// Verify pro not installed.
			$active = \activate_plugin( 'wpforms/wpforms.php', $url, false, true );

			if ( ! \is_wp_error( $active ) ) {
				\deactivate_plugins( plugin_basename( WPFORMS_PLUGIN_FILE ) );
				\wp_send_json_success( esc_html__( 'Plugin installed & activated.', 'wpforms-lite' ) );
			}

			$creds = \request_filesystem_credentials( $url, '', false, false, null );

			// Check for file system permissions.
			$perm_error = \esc_html__( 'Could not install upgrade. Please check for file system permissions and try again. Also you can download plugin from wpforms.com and install manually.', 'wpforms-lite' );

			if ( false === $creds || ! \WP_Filesystem( $creds ) ) {
				\wp_send_json_error( $perm_error );
			}

			/*
			 * We do not need any extra credentials if we have gotten this far, so let's install the plugin.
			 */

			// Do not allow WordPress to search/download translations, as this will break JS output.
			\remove_action( 'upgrader_process_complete', array( 'Language_Pack_Upgrader', 'async_upgrade' ), 20 );

			// Create the plugin upgrader with our custom skin.
			$installer = new PluginSilentUpgrader( new ConnectSkin() );

			// Error check.
			if ( ! method_exists( $installer, 'install' ) ) {
				\wp_send_json_error( $error );
			}

			// Check license key.
			$key = \get_option( 'wpforms_connect', false );

			if ( empty( $key ) ) {
				\wp_send_json_error(
					new WP_Error(
						'403',
						\esc_html__( 'No key provided.', 'wpforms-lite' )
					)
				);
			}

			$installer->install( $post_url ); // phpcs:ignore

			// Flush the cache and return the newly installed plugin basename.
			\wp_cache_flush();

			$plugin_basename = $installer->plugin_info();

			if ( $plugin_basename ) {

				// Deactivate the lite version first.
				\deactivate_plugins( \plugin_basename( WPFORMS_PLUGIN_FILE ) );

				// Activate the plugin silently.
				$activated = \activate_plugin( $plugin_basename, '', false, true );

				if ( ! \is_wp_error( $activated ) ) {
					\add_option( 'wpforms_install', 1 );
					\wp_send_json_success( \esc_html__( 'Plugin installed & activated.', 'wpforms-lite' ) );
				} else {
					// Reactivate the lite plugin if pro activation failed.
					\activate_plugin( \plugin_basename( WPFORMS_PLUGIN_FILE ), '', false, true );
					\wp_send_json_error( \esc_html__( 'Pro version installed but needs to be activated from the Plugins page inside your WordPress admin.', 'wpforms-lite' ) );
				}
			}

			\wp_send_json_error( $error );

		} catch ( \Exception $e ) {

			\wp_send_json_error(
				array( 'error' => $e->getMessage() . ' in file ' . $e->getFile() . ', line ' . $e->getLine() )
			);
		}
	}

	/**
	 * Converting errors to exceptions.
	 *
	 * @since 1.5.5
	 */
	public function init_error_handler() {

		set_error_handler( // phpcs:ignore
			function ( $errno, $errstr, $errfile, $errline, array $errcontex ) {
				throw new \Exception( $errstr );
			}
		);
	}
}
