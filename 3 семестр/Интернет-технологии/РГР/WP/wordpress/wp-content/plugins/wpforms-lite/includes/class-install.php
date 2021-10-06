<?php
/**
 * Handles plugin installation upon activation.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */
class WPForms_Install {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// When activated, trigger install method.
		register_activation_hook( WPFORMS_PLUGIN_FILE, array( $this, 'install' ) );

		// Watch for new multisite blogs.
		add_action( 'wpmu_new_blog', array( $this, 'new_multisite_blog' ), 10, 6 );

		// Watch for delayed admin install.
		add_action( 'admin_init', array( $this, 'admin' ) );
	}

	/**
	 * Let's get the party started.
	 *
	 * @since 1.0.0
	 *
	 * @param boolean $network_wide
	 */
	public function install( $network_wide = false ) {

		// Check if we are on multisite and network activating.
		if ( is_multisite() && $network_wide ) {

			// Multisite - go through each subsite and run the installer.
			if ( function_exists( 'get_sites' ) && class_exists( 'WP_Site_Query', false ) ) {

				// WP 4.6+.
				$sites = get_sites();

				foreach ( $sites as $site ) {
					switch_to_blog( $site->blog_id );
					$this->run();
					restore_current_blog();
				}
			} else {

				$sites = wp_get_sites( array( 'limit' => 0 ) );

				foreach ( $sites as $site ) {
					switch_to_blog( $site['blog_id'] );
					$this->run();
					restore_current_blog();
				}
			}
		} else {

			// Normal single site.
			$this->run();
		}

		// Abort so we only set the transient for single site installs.
		if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
			return;
		}

		// Add transient to trigger redirect to the Welcome screen.
		set_transient( 'wpforms_activation_redirect', true, 30 );
	}

	/**
	 * Runs manual install.
	 *
	 * @since 1.5.4.2
	 *
	 * @param bool $silent Silent install, disables welcome page.
	 */
	public function manual( $silent = false ) {

		$this->install( is_plugin_active_for_network( plugin_basename( WPFORMS_PLUGIN_FILE ) ) );

		if ( $silent ) {
			delete_transient( 'wpforms_activation_redirect' );
		}
	}

	/**
	 * Watch for delayed install procedure from WPForms admin.
	 *
	 * @since 1.5.4.2
	 */
	public function admin() {

		if ( ! is_admin() ) {
			return;
		}

		$install = get_option( 'wpforms_install', false );

		if ( empty( $install ) ) {
			return;
		}

		$this->manual( true );

		delete_option( 'wpforms_install' );
	}

	/**
	 * Run the actual installer.
	 *
	 * @since 1.5.4.2
	 */
	protected function run() {

		// Hook for Pro users.
		do_action( 'wpforms_install' );

		// Set current version, to be referenced in future updates.
		update_option( 'wpforms_version', WPFORMS_VERSION );

		// Store the date when the initial activation was performed.
		$type      = class_exists( 'WPForms_Lite', false ) ? 'lite' : 'pro';
		$activated = get_option( 'wpforms_activated', array() );
		if ( empty( $activated[ $type ] ) ) {
			$activated[ $type ] = time();
			update_option( 'wpforms_activated', $activated );
		}
	}

	/**
	 * When a new site is created in multisite, see if we are network activated,
	 * and if so run the installer.
	 *
	 * @since 1.3.0
	 *
	 * @param int    $blog_id Blog ID.
	 * @param int    $user_id User ID.
	 * @param string $domain  Site domain.
	 * @param string $path    Site path.
	 * @param int    $site_id Site ID. Only relevant on multi-network installs.
	 * @param array  $meta    Meta data. Used to set initial site options.
	 */
	public function new_multisite_blog( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {

		if ( is_plugin_active_for_network( plugin_basename( WPFORMS_PLUGIN_FILE ) ) ) {
			switch_to_blog( $blog_id );
			$this->run();
			restore_current_blog();
		}
	}
}

new WPForms_Install();
