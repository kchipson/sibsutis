<?php
/**
 * General functions for translation.
 *
 * @package llorix-one-lite
 */

/**
 * Define Allowed Files to be included.
 */
function llorix_one_companion_filter_translations( $array ) {
	return array_merge( $array, array(
		'translations/translations-services-section',
		'translations/translations-team-section',
		'translations/translations-testimonials-section',
	) );
}

add_filter( 'llorix_one_lite_filter_translations', 'llorix_one_companion_filter_translations' );