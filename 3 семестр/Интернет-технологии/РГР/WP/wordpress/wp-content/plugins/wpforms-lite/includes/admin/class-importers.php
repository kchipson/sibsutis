<?php

/**
 * Load the different form importers.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.4.2
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2017, WPForms LLC
 */
class WPForms_Importers {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.4.2
	 */
	public function __construct() {

		if ( wpforms_is_admin_page() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			$this->init();
		}
	}

	/**
	 * Load and init the base importer class.
	 *
	 * @since 1.4.2
	 */
	public function init() {

		// Interface with common methods.
		require_once WPFORMS_PLUGIN_DIR . 'includes/admin/importers/interface.php';

		// Abstract class with common functionality.
		require_once WPFORMS_PLUGIN_DIR . 'includes/admin/importers/class-base.php';

		// Load default importers on WP init.
		add_action( 'init', array( $this, 'load' ) );
	}

	/**
	 * Load default form importers.
	 *
	 * @since 1.4.2
	 */
	public function load() {

		$importers = apply_filters( 'wpforms_load_importers', array(
			'contact-form-7',
			'ninja-forms',
			'pirate-forms',
		) );

		foreach ( $importers as $importer ) {

			$importer = sanitize_file_name( $importer );

			if ( file_exists( WPFORMS_PLUGIN_DIR . 'includes/admin/importers/class-' . $importer . '.php' ) ) {
				require_once WPFORMS_PLUGIN_DIR . 'includes/admin/importers/class-' . $importer . '.php';
			}
		}
	}
}

new WPForms_Importers();
