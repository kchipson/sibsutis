<?php

namespace WPForms\Lite\Reports;

/**
 * Generates form submissions reports.
 *
 * @package    WPForms\Lite\Reports
 * @author     WPForms
 * @since      1.5.4
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2019, WPForms LLC
 */
class EntriesCount {

	/**
	 * Constructor.
	 *
	 * @since 1.5.4
	 */
	public function __construct() {}

	/**
	 * Get entries count grouped by form.
	 * Main point of entry to fetch form entry count data from DB.
	 * Caches the result.
	 *
	 * @since 1.5.4
	 *
	 * @return array
	 */
	public function get_by_form() {

		$forms = \wpforms()->form->get( '', array( 'fields' => 'ids' ) );

		if ( empty( $forms ) || ! \is_array( $forms ) ) {
			return array();
		}

		$result = array();

		foreach ( $forms as $form_id ) {
			$count = \absint( \get_post_meta( $form_id, 'wpforms_entries_count', true ) );
			if ( empty( $count ) ) {
				continue;
			}
			$result[ $form_id ] = array(
				'form_id' => $form_id,
				'count'   => $count,
				'title'   => \get_the_title( $form_id ),
			);
		}

		if ( ! empty( $result ) ) {
			// Sort forms by entries count (desc).
			\uasort(
				$result,
				function ( $a, $b ) {
					return ( $a['count'] > $b['count'] ) ? -1 : 1;
				}
			);
		}

		return $result;
	}
}
