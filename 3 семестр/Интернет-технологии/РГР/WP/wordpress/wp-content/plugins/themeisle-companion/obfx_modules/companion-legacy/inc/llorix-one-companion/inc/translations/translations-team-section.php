<?php
/**
 * Translation functions for team section
 *
 * @package llorix-one-companion
 */


/**
 * Get team section default content.
 */
function llorix_one_companion_team_get_default_content() {
	return json_encode( array(
			array(
				'image_url' => llorix_one_lite_get_file( '/images/team/1.jpg' ),
				'title'     => esc_html__( 'Albert Jacobs', 'themeisle-companion' ),
				'subtitle'  => esc_html__( 'Founder & CEO', 'themeisle-companion' )
			),
			array(
				'image_url' => llorix_one_lite_get_file( '/images/team/2.jpg' ),
				'title'     => esc_html__( 'Tonya Garcia', 'themeisle-companion' ),
				'subtitle'  => esc_html__( 'Account Manager', 'themeisle-companion' )
			),
			array(
				'image_url' => llorix_one_lite_get_file( '/images/team/3.jpg' ),
				'title'     => esc_html__( 'Linda Guthrie', 'themeisle-companion' ),
				'subtitle'  => esc_html__( 'Business Development', 'themeisle-companion' )
			)
		)
	);
}

/**
 * Register strings for polylang.
 */
function llorix_one_companion_team_register_strings() {
	if ( ! defined( 'POLYLANG_VERSION' ) || ! function_exists( 'llorix_one_lite_pll_string_register_helper' ) ) {
		return;
	}

	$default = llorix_one_companion_team_get_default_content();
	llorix_one_lite_pll_string_register_helper( 'llorix_one_lite_team_content', $default, 'Team section' );
}

add_action( 'after_setup_theme', 'llorix_one_companion_team_register_strings', 11 );
