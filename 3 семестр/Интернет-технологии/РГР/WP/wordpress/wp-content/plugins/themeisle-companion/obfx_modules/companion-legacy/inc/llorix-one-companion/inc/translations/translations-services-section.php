<?php
/**
 * Translation functions for services section
 *
 * @package llorix-one-companion
 */


/**
 * Get services section default content.
 */
function llorix_one_companion_sevices_get_default_content() {
	return json_encode(
		array(
			array(
				'choice'     => 'llorix_one_lite_icon',
				'icon_value' => 'fa-cogs',
				'title'      => esc_html__( 'Lorem Ipsum', 'themeisle-companion' ),
				'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.', 'themeisle-companion' )
			),
			array(
				'choice'     => 'llorix_one_lite_icon',
				'icon_value' => 'fa-bar-chart-o',
				'title'      => esc_html__( 'Lorem Ipsum', 'themeisle-companion' ),
				'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.', 'themeisle-companion' )
			),
			array(
				'choice'     => 'llorix_one_lite_icon',
				'icon_value' => 'fa-globe',
				'title'      => esc_html__( 'Lorem Ipsum', 'themeisle-companion' ),
				'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.', 'themeisle-companion' )
			)
		)
	);
}


/**
 * Register strings for polylang.
 */
function llorix_one_companion_sevices_register_strings() {
	if ( ! defined( 'POLYLANG_VERSION' ) || ! function_exists( 'llorix_one_lite_pll_string_register_helper' ) ) {
		return;
	}

	$default = llorix_one_companion_sevices_get_default_content();
	llorix_one_lite_pll_string_register_helper( 'llorix_one_lite_services_content', $default, 'Services section' );
}

add_action( 'after_setup_theme', 'llorix_one_companion_sevices_register_strings', 11 );
