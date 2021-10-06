<?php
/**
 * Base Importer class.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.4.2
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2017, WPForms LLC
 */
abstract class WPForms_Importer implements WPForms_Importer_Interface {

	/**
	 * Importer name.
	 *
	 * @since 1.4.2
	 *
	 * @var string
	 */
	public $name;

	/**
	 * Importer name in slug format.
	 *
	 * @since 1.4.2
	 *
	 * @var string
	 */
	public $slug;

	/**
	 * Importer plugin path.
	 *
	 * @since 1.4.2
	 *
	 * @var string
	 */
	public $path;

	/**
	 * Primary class constructor.
	 *
	 * @since 1.4.2
	 */
	public function __construct() {

		$this->init();

		// Add to list of available importers.
		add_filter( 'wpforms_importers', array( $this, 'register' ), 10, 1 );

		// Return array of all available forms.
		add_filter( "wpforms_importer_forms_{$this->slug}", array( $this, 'get_forms' ), 10, 1 );

		// Import a specific form with AJAX.
		add_action( "wp_ajax_wpforms_import_form_{$this->slug}", array( $this, 'import_form' ) );
	}

	/**
	 * Add to list of registered importers.
	 *
	 * @since 1.4.2
	 *
	 * @param array $importers List of supported importers.
	 *
	 * @return array
	 */
	public function register( $importers = array() ) {

		$importers[ $this->slug ] = array(
			'name'      => $this->name,
			'slug'      => $this->slug,
			'path'      => $this->path,
			'installed' => file_exists( trailingslashit( WP_PLUGIN_DIR ) . $this->path ),
			'active'    => $this->is_active(),
		);

		return $importers;
	}

	/**
	 * If the importer source is available.
	 *
	 * @since 1.4.2
	 *
	 * @return bool
	 */
	protected function is_active() {
		return is_plugin_active( $this->path );
	}

	/**
	 * Add the new form to the database and return AJAX data.
	 *
	 * @since 1.4.2
	 *
	 * @param array $form Form to import.
	 * @param array $unsupported List of unsupported fields.
	 * @param array $upgrade_plain List of fields, that are supported inside the paid WPForms, but not in Lite.
	 * @param array $upgrade_omit No field alternative in WPForms.
	 */
	public function add_form( $form, $unsupported = array(), $upgrade_plain = array(), $upgrade_omit = array() ) {

		// Create empty form so we have an ID to work with.
		$form_id = wp_insert_post( array(
			'post_status' => 'publish',
			'post_type'   => 'wpforms',
		) );

		if ( empty( $form_id ) || is_wp_error( $form_id ) ) {
			wp_send_json_success( array(
				'error' => true,
				'name'  => sanitize_text_field( $form['settings']['form_title'] ),
				'msg'   => esc_html__( 'There was an error while creating a new form.', 'wpforms-lite' ),
			) );
		}

		$form['id']       = $form_id;
		$form['field_id'] = count( $form['fields'] ) + 1;

		// Update the form with all our compiled data.
		wpforms()->form->update( $form_id, $form );

		// Make note that this form has been imported.
		$this->track_import( $form['settings']['import_form_id'], $form_id );

		// Build and send final AJAX response!
		wp_send_json_success( array(
			'name'          => $form['settings']['form_title'],
			'edit'          => esc_url_raw( admin_url( 'admin.php?page=wpforms-builder&view=fields&form_id=' . $form_id ) ),
			'preview'       => wpforms_get_form_preview_url( $form_id ),
			'unsupported'   => $unsupported,
			'upgrade_plain' => $upgrade_plain,
			'upgrade_omit'  => $upgrade_omit,
		) );
	}

	/**
	 * After a form has been successfully imported we track it, so that in the
	 * future we can alert users if they try to import a form that has already
	 * been imported.
	 *
	 * @since 1.4.2
	 *
	 * @param int $source_id Imported plugin form ID.
	 * @param int $wpforms_id WPForms form ID.
	 */
	public function track_import( $source_id, $wpforms_id ) {

		$imported = get_option( 'wpforms_imported', array() );

		$imported[ $this->slug ][ $wpforms_id ] = $source_id;

		update_option( 'wpforms_imported', $imported, false );
	}
}
