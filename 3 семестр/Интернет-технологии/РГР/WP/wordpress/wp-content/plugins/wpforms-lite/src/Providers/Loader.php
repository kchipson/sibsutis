<?php

namespace WPForms\Providers;

/**
 * Class Loader gives ability to track/load all providers.
 *
 * @package    WPForms\Providers
 * @author     WPForms
 * @since      1.4.7
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2018, WPForms LLC
 */
class Loader {

	/**
	 * Get the instance of a class and store it in itself.
	 * Later we will be able to use this class as $providers_loader = \WPForms\Providers\Loader::get_instance();
	 *
	 * @since 1.4.7
	 */
	public static function get_instance() {

		static $instance;

		if ( ! $instance ) {
			$instance = new Loader();
		}

		return $instance;
	}

	/**
	 * Loader constructor.
	 *
	 * @since 1.4.7
	 */
	public function __construct() {
	}

	/**
	 * Register a provider.
	 *
	 * @since 1.4.7
	 *
	 * @param \WPForms\Providers\Provider\Core $provider The core class of a single provider.
	 */
	public function register( Provider\Core $provider ) {

		\add_filter( 'wpforms_providers_available', array( $provider, 'register_provider' ) );

		// WPForms > Settings > Integrations page.
		$integration = $provider->get_page_integrations();
		if ( null !== $integration ) {
			\add_action( 'wpforms_settings_providers', array( $integration, 'display' ), $provider::PRIORITY, 2 );
		}

		// Editing Single Form > Form Builder.
		$form_builder = $provider->get_form_builder();
		if ( null !== $form_builder ) {
			\add_action( 'wpforms_providers_panel_sidebar', array( $form_builder, 'display_sidebar' ), $provider::PRIORITY );
			\add_action( 'wpforms_providers_panel_content', array( $form_builder, 'display_content' ), $provider::PRIORITY );
		}

		// Process entry submission.
		$process = $provider->get_process();
		if ( null !== $process ) {
			\add_action( 'wpforms_process_complete', array( $process, 'process' ), 5, 4 );
		}
	}

}
