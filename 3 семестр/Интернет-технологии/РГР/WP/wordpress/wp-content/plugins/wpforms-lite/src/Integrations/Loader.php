<?php

namespace WPForms\Integrations;

/**
 * Class Loader gives ability to track/load all integrations.
 *
 * @package    WPForms\Integrations
 * @author     WPForms
 * @since      1.4.8
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2018, WPForms LLC
 */
class Loader {

	/**
	 * Get the instance of a class and store it in itself.
	 *
	 * @since 1.4.8
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
	 * @since 1.4.8
	 */
	public function __construct() {

		$core_class_names = array(
			'Gutenberg\FormSelector',
			'SiteHealth\SiteHealth',
			'WPMailSMTP\Notifications',
			'WPorg\Translations',
		);

		$class_names = \apply_filters( 'wpforms_integrations_available', $core_class_names );

		foreach ( $class_names as $class_name ) {
			$integration = $this->register_class( $class_name );
			if ( ! empty( $integration ) ) {
				$this->load_integration( $integration );
			}
		}
	}

	/**
	 * Load an integration.
	 *
	 * @param IntegrationInterface $integration Instance of an integration class.
	 *
	 * @since 1.4.8
	 */
	protected function load_integration( IntegrationInterface $integration ) {

		if ( $integration->allow_load() ) {
			$integration->load();
		}
	}

	/**
	 * Register a new class.
	 *
	 * @since 1.5.6
	 *
	 * @param string $class_name Class name to register.
	 *
	 * @return IntegrationInterface Instance of class.
	 */
	public function register_class( $class_name ) {

		$class_name = \sanitize_text_field( $class_name );

		// Load Lite class if exists.
		if ( ! \wpforms()->pro && \class_exists( 'WPForms\Lite\Integrations\\' . $class_name ) ) {
			$class_name = 'WPForms\Lite\Integrations\\' . $class_name;
			return new $class_name();
		}

		// Load Pro class if exists.
		if ( \wpforms()->pro && \class_exists( 'WPForms\Pro\Integrations\\' . $class_name ) ) {
			$class_name = 'WPForms\Pro\Integrations\\' . $class_name;
			return new $class_name();
		}

		// Load general class if neither Pro nor Lite class exists.
		if ( \class_exists( __NAMESPACE__ . '\\' . $class_name ) ) {
			$class_name = __NAMESPACE__ . '\\' . $class_name;
			return new $class_name();
		}
	}
}
