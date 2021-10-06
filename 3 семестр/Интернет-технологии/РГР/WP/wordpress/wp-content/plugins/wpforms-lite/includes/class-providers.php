<?php

/**
 * Load the providers.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.3.6
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2017, WPForms LLC
 */
class WPForms_Providers {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.3.6
	 */
	public function __construct() {

		$this->init();
	}

	/**
	 * Load and init the base provider class.
	 *
	 * @since 1.3.6
	 */
	public function init() {

		// Parent class template.
		require_once WPFORMS_PLUGIN_DIR . 'includes/providers/class-base.php';

		// Load default templates on WP init.
		add_action( 'wpforms_loaded', array( $this, 'load' ) );
	}

	/**
	 * Load default marketing providers.
	 *
	 * @since 1.3.6
	 */
	public function load() {

		$providers = array(
			'constant-contact',
		);

		$providers = apply_filters( 'wpforms_load_providers', $providers );

		foreach ( $providers as $provider ) {

			$provider = sanitize_file_name( $provider );

			require_once WPFORMS_PLUGIN_DIR . 'includes/providers/class-' . $provider . '.php';
		}
	}
}

new WPForms_Providers;
