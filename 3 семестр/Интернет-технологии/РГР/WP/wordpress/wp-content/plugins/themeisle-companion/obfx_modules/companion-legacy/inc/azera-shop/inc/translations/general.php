<?php
/**
 * General functions for translation.
 *
 * @package azera-shop-companion
 */

/**
 * Define Allowed Files to be included.
 */
function azera_shop_companion_filter_translations( $array ) {
	return array_merge( $array, array(
		'translations/translations-services-section',
		'translations/translations-team-section',
		'translations/translations-testimonials-section',
	) );
}
add_filter( 'azera_shop_filter_translations', 'azera_shop_companion_filter_translations' );