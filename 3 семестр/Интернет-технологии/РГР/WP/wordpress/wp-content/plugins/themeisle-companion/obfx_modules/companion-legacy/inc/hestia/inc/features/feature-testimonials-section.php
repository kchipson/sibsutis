<?php
/**
 * Customizer functionality for the Testimonials section.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

if ( ! function_exists( 'hestia_testimonials_customize_register' ) ) :
	/**
	 * Hook controls for Testimonials section to Customizer.
	 *
	 * @since Hestia 1.0
	 * @modified 1.1.49
	 */
	function hestia_testimonials_customize_register( $wp_customize ) {

		$selective_refresh = isset( $wp_customize->selective_refresh ) && function_exists('hestia_display_customizer_shortcut') ? 'postMessage' : 'refresh';

		if ( class_exists( 'Hestia_Hiding_Section' ) ) {
			$wp_customize->add_section(
				new Hestia_Hiding_Section(
					$wp_customize, 'hestia_testimonials', array(
						'title'          => esc_html__( 'Testimonials', 'themeisle-companion' ),
						'panel'          => 'hestia_frontpage_sections',
						'priority'       => apply_filters( 'hestia_section_priority', 40, 'hestia_testimonials' ),
						'hiding_control' => 'hestia_testimonials_hide',
					)
				)
			);
		} else {
			$wp_customize->add_section(
				'hestia_testimonials', array(
					'title'    => esc_html__( 'Testimonials', 'themeisle-companion' ),
					'panel'    => 'hestia_frontpage_sections',
					'priority' => apply_filters( 'hestia_section_priority', 45, 'hestia_testimonials' ),
				)
			);
		}

		$wp_customize->add_setting(
			'hestia_testimonials_hide', array(
				'sanitize_callback' => 'hestia_sanitize_checkbox',
				'default'           => false,
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			'hestia_testimonials_hide', array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Disable section', 'themeisle-companion' ),
				'section'  => 'hestia_testimonials',
				'priority' => 1,
			)
		);

		$wp_customize->add_setting(
			'hestia_testimonials_title', array(
				'sanitize_callback' => 'wp_kses_post',
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			'hestia_testimonials_title', array(
				'label'    => esc_html__( 'Section Title', 'themeisle-companion' ),
				'section'  => 'hestia_testimonials',
				'priority' => 5,
			)
		);

		$wp_customize->add_setting(
			'hestia_testimonials_subtitle', array(
				'sanitize_callback' => 'wp_kses_post',
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			'hestia_testimonials_subtitle', array(
				'label'    => esc_html__( 'Section Subtitle', 'themeisle-companion' ),
				'section'  => 'hestia_testimonials',
				'priority' => 10,
			)
		);

		if ( class_exists( 'Hestia_Repeater' ) ) {
			$wp_customize->add_setting(
				'hestia_testimonials_content', array(
					'sanitize_callback' => 'hestia_repeater_sanitize',
					'transport'         => $selective_refresh,
				)
			);

			$wp_customize->add_control(
				new Hestia_Repeater(
					$wp_customize, 'hestia_testimonials_content', array(
						'label'                                => esc_html__( 'Testimonials Content', 'themeisle-companion' ),
						'section'                              => 'hestia_testimonials',
						'priority'                             => 15,
						'add_field_label'                      => esc_html__( 'Add new Testimonial', 'themeisle-companion' ),
						'item_name'                            => esc_html__( 'Testimonial', 'themeisle-companion' ),
						'customizer_repeater_image_control'    => true,
						'customizer_repeater_title_control'    => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_text_control'     => true,
						'customizer_repeater_link_control'     => true,
					)
				)
			);
		}
	}

	add_action( 'customize_register', 'hestia_testimonials_customize_register' );

endif;

/**
 * Add selective refresh for testimonias section controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since 1.1.31
 * @access public
 */
function hestia_register_testimonials_partials( $wp_customize ) {

	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial(
		'hestia_testimonials_content', array(
			'selector' => '.hestia-testimonials-content',
			'settings' => 'hestia_testimonials_content',
			'render_callback' => 'hestia_testimonials_content_callback',
		)
	);
}
add_action( 'customize_register', 'hestia_register_testimonials_partials' );

/**
 * Callback function for testimonials content selective refresh.
 *
 * @since 1.1.31
 * @access public
 */
function hestia_testimonials_content_callback() {
	$hestia_testimonials_content = get_theme_mod( 'hestia_testimonials_content' );
	hestia_testimonials_content( $hestia_testimonials_content, true );
}
