<?php
/**
 * Customizer Extension for Hestia Companion
 *
 * @package Hestia Companion
 * @since 1.0.0
 */

if ( ! function_exists( 'hestia_companion_customize_register' ) ) :
	/**
	 * Hestia Companion Customize Register
	 */
	function hestia_companion_customize_register( $wp_customize ) {

		// Change defaults for customizer controls for features section.
		$hestia_features_title_control = $wp_customize->get_setting( 'hestia_features_title' );
		if ( ! empty( $hestia_features_title_control ) ) {
			$hestia_features_title_control->default = esc_html__( 'Why our product is the best', 'themeisle-companion' );
		}

		$hestia_features_subtitle_control = $wp_customize->get_setting( 'hestia_features_subtitle' );
		if ( ! empty( $hestia_features_subtitle_control ) ) {
			$hestia_features_subtitle_control->default = esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'themeisle-companion' );
		}

		$hestia_features_content_control = $wp_customize->get_setting( 'hestia_features_content' );
		if ( ! empty( $hestia_features_content_control ) ) {
			$hestia_features_content_control->default = hestia_get_features_default();
		}

		// Change defaults for customizer controls for team section.
		$hestia_team_title_control = $wp_customize->get_setting( 'hestia_team_title' );
		if ( ! empty( $hestia_team_title_control ) ) {
			$hestia_team_title_control->default = esc_html__( 'Meet our team', 'themeisle-companion' );
		}
		$hestia_team_subtitle_control = $wp_customize->get_setting( 'hestia_team_subtitle' );
		if ( ! empty( $hestia_team_subtitle_control ) ) {
			$hestia_team_subtitle_control->default = esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'themeisle-companion' );
		}
		$hestia_team_content_control = $wp_customize->get_setting( 'hestia_team_content' );
		if ( ! empty( $hestia_team_content_control ) ) {
			$hestia_team_content_control->default = hestia_get_team_default();
		}// End if().

		$hestia_testimonials_title_setting = $wp_customize->get_setting( 'hestia_testimonials_title' );
		if ( ! empty( $hestia_testimonials_title_setting ) ) {
			$hestia_testimonials_title_setting->default = esc_html__( 'What clients say', 'themeisle-companion' );
		}
		$hestia_testimonials_subtitle_setting = $wp_customize->get_setting( 'hestia_testimonials_subtitle' );
		if ( ! empty( $hestia_testimonials_subtitle_setting ) ) {
			$hestia_testimonials_subtitle_setting->default = esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'themeisle-companion' );
		}
		$hestia_testimonials_content_setting = $wp_customize->get_setting( 'hestia_testimonials_content' );
		if ( ! empty( $hestia_testimonials_content_setting ) ) {
			$hestia_testimonials_content_setting->default = hestia_get_testimonials_default();
		}

	}

	add_action( 'customize_register', 'hestia_companion_customize_register' );
endif;
