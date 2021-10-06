<?php

namespace WPForms\Providers\Provider;

/**
 * Class Status gives ability to check/work with provider statuses.
 * Might be used later to track Provider errors on data-delivery.
 *
 * @package    WPForms\Providers
 * @author     WPForms
 * @since      1.4.8
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2018, WPForms LLC
 */
class Status {

	/**
	 * Provider identifier, its slug.
	 *
	 * @since 1.4.8
	 *
	 * @var string
	 */
	private $provider;

	/**
	 * Form data and settings.
	 *
	 * @since 1.4.8
	 *
	 * @var array
	 */
	protected $form_data = array();

	/**
	 * Status constructor.
	 *
	 * @param string $provider Provider slug.
	 */
	public function __construct( $provider ) {
		$this->provider = sanitize_key( (string) $provider );
	}

	/**
	 * Provide ability to statically init the object.
	 * Useful for inline-invocations.
	 *
	 * @example: Status::init( 'drip' )->is_ready();
	 *
	 * @since 1.4.8
	 *
	 * @param string $provider Provider slug.
	 *
	 * @return \WPForms\Providers\Provider\Status
	 */
	public static function init( $provider ) {
		static $instance;

		if ( ! $instance ) {
			$instance = new self( $provider );
		}

		return $instance;
	}

	/**
	 * Check whether the defined provider is configured or not.
	 * "Configured" means has an account, that might be checked/updated on Settings > Integrations.
	 *
	 * @since 1.4.8
	 *
	 * @return bool
	 */
	public function is_configured() {

		$options = \wpforms_get_providers_options();

		// We meed to leave this filter for BC.
		$is_configured = \apply_filters(
			'wpforms_providers_' . $this->provider . '_configured',
			! empty( $options[ $this->provider ] ) ? true : false
		);

		// Use this filter to change the configuration status of the provider.
		return apply_filters( 'wpforms_providers_status_is_configured', $is_configured, $this->provider );
	}

	/**
	 * Check whether the defined provider is connected to some form.
	 * "Connected" means it has a Connection in Form Builder > Providers > Provider tab.
	 *
	 * @since 1.4.8
	 *
	 * @param int $form_id Form ID to check the status against.
	 *
	 * @return bool
	 */
	public function is_connected( $form_id ) {

		$is_connected = false;

		$this->form_data = \wpforms()->form->get(
			(int) $form_id,
			array(
				'content_only' => true,
			)
		);

		if (
			! empty( $this->form_data['providers'][ $this->provider ] ) ||
			! empty( $this->form_data['payments'][ $this->provider ] )
		) {
			$is_connected = true;
		}

		return apply_filters( 'wpforms_providers_status_is_connected', $is_connected, $this->provider );
	}

	/**
	 * Is the current provider ready to be used?
	 * It means both configured and connected.
	 *
	 * @since 1.4.8
	 *
	 * @param int $form_id Form ID to check the status against.
	 *
	 * @return bool
	 */
	public function is_ready( $form_id ) {
		return $this->is_configured() && $this->is_connected( $form_id );
	}

}
