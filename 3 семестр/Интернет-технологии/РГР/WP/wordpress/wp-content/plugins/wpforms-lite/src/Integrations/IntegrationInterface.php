<?php

namespace WPForms\Integrations;

/**
 * Interface IntegrationInterface defines required methods for integrations to work properly.
 *
 * @package    WPForms\Integrations
 * @author     WPForms
 * @since      1.4.8
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2018, WPForms LLC
 */
interface IntegrationInterface {

	/**
	 * Indicates if current integration is allowed to load.
	 *
	 * @since 1.4.8
	 *
	 * @return bool
	 */
	public function allow_load();

	/**
	 * Loads an integration.
	 *
	 * @since 1.4.8
	 */
	public function load();
}
