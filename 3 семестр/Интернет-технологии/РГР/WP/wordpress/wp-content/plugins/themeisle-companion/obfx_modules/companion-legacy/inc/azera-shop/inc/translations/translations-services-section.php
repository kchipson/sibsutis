<?php
/**
 * Translation functions for services section
 *
 * @package azera-shop-companion
 */

/**
 * Get services section default content.
 */
function azera_shop_companion_sevices_get_default_content() {
	return json_encode( array(
			array(
				'choice'     => 'azera_shop_icon',
				'icon_value' => 'fa-cogs',
				'title'      => esc_html__( 'Lorem Ipsum', 'themeisle-companion' ),
				'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.', 'themeisle-companion' )
			),
			array( 'choice'     => 'azera_shop_icon',
			       'icon_value' => 'fa-bar-chart-o',
			       'title'      => esc_html__( 'Lorem Ipsum', 'themeisle-companion' ),
			       'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo.', 'themeisle-companion' )
			),
			array( 'choice'     => 'azera_shop_icon',
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
function azera_shop_companion_sevices_register_strings() {
	if ( ! defined( 'POLYLANG_VERSION' ) || ! function_exists( 'azera_shop_pll_string_register_helper' ) ) {
		return;
	}

	$default = azera_shop_companion_sevices_get_default_content();
	azera_shop_pll_string_register_helper( 'azera_shop_services_content', $default, 'Services section' );
}
add_action( 'after_setup_theme', 'azera_shop_companion_sevices_register_strings', 11 );
