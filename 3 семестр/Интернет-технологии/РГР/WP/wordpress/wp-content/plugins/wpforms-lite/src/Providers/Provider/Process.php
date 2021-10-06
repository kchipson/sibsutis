<?php

namespace WPForms\Providers\Provider;

/**
 * Class Process handles entries processing using the provider settings and configuration.
 *
 * @package    WPForms\Providers\Provider
 * @author     WPForms
 * @since      1.4.7
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2018, WPForms LLC
 */
abstract class Process {

	/**
	 * Get the Core loader class of a provider.
	 *
	 * @since 1.4.7
	 *
	 * @var Core
	 */
	protected $core;

	/**
	 * Array of form fields.
	 *
	 * @since 1.4.7
	 *
	 * @var array
	 */
	protected $fields = array();

	/**
	 * Submitted form content.
	 *
	 * @since 1.4.7
	 *
	 * @var array
	 */
	protected $entry = array();
	/**
	 * Form data and settings.
	 *
	 * @since 1.4.7
	 *
	 * @var array
	 */
	protected $form_data = array();
	/**
	 * ID of a saved entry.
	 *
	 * @since 1.4.7
	 *
	 * @var int
	 */
	protected $entry_id;

	/**
	 * Process constructor.
	 *
	 * @since 1.4.7
	 *
	 * @param Core $core Provider core class.
	 */
	public function __construct( Core $core ) {
		$this->core = $core;
	}

	/**
	 * Receive all wpforms_process_complete params and do the actual processing.
	 *
	 * @since 1.4.7
	 *
	 * @param array $fields    Array of form fields.
	 * @param array $entry     Submitted form content.
	 * @param array $form_data Form data and settings.
	 * @param int   $entry_id  ID of a saved entry.
	 */
	abstract public function process( $fields, $entry, $form_data, $entry_id );

	/**
	 * Process conditional logic for a connection.
	 *
	 * @since 1.4.7
	 *
	 * @param array $fields     Array of form fields.
	 * @param array $form_data  Form data and settings.
	 * @param array $connection All connection data.
	 *
	 * @return bool
	 */
	protected function process_conditionals( $fields, $form_data, $connection ) {

		if (
			empty( $connection['conditional_logic'] ) ||
			empty( $connection['conditionals'] )
		) {
			return true;
		}

		$process = wpforms_conditional_logic()->process( $fields, $form_data, $connection['conditionals'] );

		if (
			! empty( $connection['conditional_type'] ) &&
			'stop' === $connection['conditional_type']
		) {
			$process = ! $process;
		}

		return $process;
	}

	/**
	 * Get provider options, saved on Settings > Integrations page.
	 *
	 * @since 1.4.7
	 *
	 * @return array
	 */
	protected function get_options() {
		return \wpforms_get_providers_options( $this->core->slug );
	}
}
