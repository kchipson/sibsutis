<?php

namespace WPForms\Integrations\SiteHealth;

use WPForms\Integrations\IntegrationInterface;

/**
 * Site Health WPForms Info.
 *
 * @since      1.5.5
 * @author     WPForms
 * @package    WPForms\Integrations\SiteHealth
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2019, WPForms LLC
 */
class SiteHealth implements IntegrationInterface {

	/**
	 * Indicates if current integration is allowed to load.
	 *
	 * @since 1.5.5
	 *
	 * @return bool
	 */
	public function allow_load() {

		global $wp_version;

		return version_compare( $wp_version, '5.2', '>=' );
	}

	/**
	 * Loads an integration.
	 *
	 * @since 1.5.5
	 */
	public function load() {

		$this->hooks();
	}

	/**
	 * Integration hooks.
	 *
	 * @since 1.5.5
	 */
	protected function hooks() {

		\add_filter( 'debug_information', array( $this, 'add_info_section' ) );
	}

	/**
	 * Add WPForms section to .
	 *
	 * @since 1.5.5
	 *
	 * @param array $debug_info Array of all information.
	 *
	 * @return array Array with added WPForms info section.
	 */
	public function add_info_section( $debug_info ) {

		$wpforms = array(
			'label'  => 'WPForms',
			'fields' => array(
				'version' => array(
					'label' => esc_html__( 'Version', 'wpforms-lite' ),
					'value' => WPFORMS_VERSION,
				),
			),
		);

		// License key type.
		$wpforms['fields']['license'] = array(
			'label' => esc_html__( 'License key type', 'wpforms-lite' ),
			'value' => wpforms_setting( 'type', '', 'wpforms_license' ),
		);

		// Install date.
		$activated = get_option( 'wpforms_activated', array() );
		if ( ! empty( $activated['lite'] ) ) {
			$date = $activated['lite'] + ( get_option( 'gmt_offset' ) * 3600 );

			$wpforms['fields']['lite'] = array(
				'label' => esc_html__( 'Lite install date', 'wpforms-lite' ),
				'value' => date_i18n( esc_html__( 'M j, Y @ g:ia' ), $date ),
			);
		}
		if ( ! empty( $activated['pro'] ) ) {
			$date = $activated['pro'] + ( get_option( 'gmt_offset' ) * 3600 );

			$wpforms['fields']['pro'] = array(
				'label' => esc_html__( 'Pro install date', 'wpforms-lite' ),
				'value' => date_i18n( esc_html__( 'M j, Y @ g:ia' ), $date ),
			);
		}

		// DB tables.
		global $wpdb;
		$results   = $wpdb->get_results( "SHOW TABLES LIKE '" . $wpdb->prefix . "wpforms_%'", 'ARRAY_N' ); // phpcs:ignore
		$results   = wp_list_pluck( $results, 0 );
		$db_tables = empty( $results ) ? esc_html__( 'Not found', 'wpforms-lite' ) : implode( ', ', $results );

		$wpforms['fields']['db_tables'] = array(
			'label' => esc_html__( 'DB tables', 'wpforms-lite' ),
			'value' => $db_tables,
		);

		// Total forms.
		$wpforms['fields']['total_forms'] = array(
			'label' => esc_html__( 'Total forms', 'wpforms-lite' ),
			'value' => wp_count_posts( 'wpforms' )->publish,
		);

		// Total entries.
		if ( wpforms()->pro ) {
			$wpforms['fields']['total_entries'] = array(
				'label' => esc_html__( 'Total entries', 'wpforms-lite' ),
				'value' => wpforms()->entry->get_entries( array(), true ),
			);
		} else {
			$forms = \wpforms()->form->get( '', array( 'fields' => 'ids' ) );

			if ( empty( $forms ) || ! \is_array( $forms ) ) {
				$forms = array();
			}

			$count = 0;

			foreach ( $forms as $form_id ) {
				$count += (int) \get_post_meta( $form_id, 'wpforms_entries_count', true );
			}

			$wpforms['fields']['total_entries'] = array(
				'label' => esc_html__( 'Total submissions (since v1.5.0)', 'wpforms-lite' ),
				'value' => $count,
			);
		}

		$debug_info[] = $wpforms;

		return $debug_info;
	}
}
