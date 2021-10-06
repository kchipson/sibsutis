<?php
/**
 * Translation functions for testimonials section
 *
 * @package llorix-one-companion
 */


/**
 * Get testimonials section default content.
 */
function azera_shop_companion_testimonials_get_default_content() {
	return json_encode(
		array(
			array(
				'image_url' => azera_shop_get_file( '/images/clients/1.jpg' ),
				'title'     => esc_html__( 'Happy Customer', 'themeisle-companion' ),
				'subtitle'  => esc_html__( 'Lorem ipsum', 'themeisle-companion' ),
				'text'      => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.', 'themeisle-companion' )
			),
			array(
				'image_url' => azera_shop_get_file( '/images/clients/2.jpg' ),
				'title'     => esc_html__( 'Happy Customer', 'themeisle-companion' ),
				'subtitle'  => esc_html__( 'Lorem ipsum', 'themeisle-companion' ),
				'text'      => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.', 'themeisle-companion' )
			),
			array(
				'image_url' => azera_shop_get_file( '/images/clients/3.jpg' ),
				'title'     => esc_html__( 'Happy Customer', 'themeisle-companion' ),
				'subtitle'  => esc_html__( 'Lorem ipsum', 'themeisle-companion' ),
				'text'      => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.', 'themeisle-companion' )
			)
		)
	);
}

/**
 * Register strings for polylang.
 */
function azera_shop_companion_testimonials_register_strings() {
	if ( ! defined( 'POLYLANG_VERSION' ) || ! function_exists( 'azera_shop_pll_string_register_helper' ) ) {
		return;
	}

	$default = azera_shop_companion_testimonials_get_default_content();
	azera_shop_pll_string_register_helper( 'azera_shop_testimonials_content', $default, 'Testimonials section' );
}

add_action( 'after_setup_theme', 'azera_shop_companion_testimonials_register_strings', 11 );
