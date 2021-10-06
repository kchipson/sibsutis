<?php
/**
 * Customizer functionality for the Features section.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

if ( ! function_exists( 'hestia_features_customize_register' ) ) :
	/**
	 * Hook controls for Features section to Customizer.
	 *
	 * @since Hestia 1.0
	 * @modified 1.1.49
	 */
	function hestia_features_customize_register( $wp_customize ) {

		$selective_refresh = isset( $wp_customize->selective_refresh ) && function_exists('hestia_display_customizer_shortcut') ? 'postMessage' : 'refresh';

		if ( class_exists( 'Hestia_Hiding_Section' ) ) {
			$wp_customize->add_section(
				new Hestia_Hiding_Section(
					$wp_customize, 'hestia_features', array(
						'title'          => esc_html__( 'Features', 'themeisle-companion' ),
						'panel'          => 'hestia_frontpage_sections',
						'priority'       => apply_filters( 'hestia_section_priority', 10, 'hestia_features' ),
						'hiding_control' => 'hestia_features_hide',
					)
				)
			);
		} else {
			$wp_customize->add_section(
				'hestia_features', array(
					'title'    => esc_html__( 'Features', 'themeisle-companion' ),
					'panel'    => 'hestia_frontpage_sections',
					'priority' => apply_filters( 'hestia_section_priority', 10, 'hestia_features' ),
				)
			);
		}

		$wp_customize->add_setting(
			'hestia_features_hide', array(
				'sanitize_callback' => 'hestia_sanitize_checkbox',
				'default'           => false,
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			'hestia_features_hide', array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Disable section', 'themeisle-companion' ),
				'section'  => 'hestia_features',
				'priority' => 1,
			)
		);

		$wp_customize->add_setting(
			'hestia_features_title', array(
				'sanitize_callback' => 'wp_kses_post',
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			'hestia_features_title', array(
				'label'    => esc_html__( 'Section Title', 'themeisle-companion' ),
				'section'  => 'hestia_features',
				'priority' => 5,
			)
		);

		$wp_customize->add_setting(
			'hestia_features_subtitle', array(
				'sanitize_callback' => 'wp_kses_post',
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			'hestia_features_subtitle', array(
				'label'    => esc_html__( 'Section Subtitle', 'themeisle-companion' ),
				'section'  => 'hestia_features',
				'priority' => 10,
			)
		);

		if ( class_exists( 'Hestia_Repeater' ) ) {
			$wp_customize->add_setting(
				'hestia_features_content', array(
					'sanitize_callback' => 'hestia_repeater_sanitize',
					'transport'         => $selective_refresh,
				)
			);

			$wp_customize->add_control(
				new Hestia_Repeater(
					$wp_customize, 'hestia_features_content', array(
						'label'                             => esc_html__( 'Features Content', 'themeisle-companion' ),
						'section'                           => 'hestia_features',
						'priority'                          => 15,
						'add_field_label'                   => esc_html__( 'Add new Feature', 'themeisle-companion' ),
						'item_name'                         => esc_html__( 'Feature', 'themeisle-companion' ),
						'customizer_repeater_icon_control'  => true,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control'  => true,
						'customizer_repeater_link_control'  => true,
						'customizer_repeater_color_control' => true,
					)
				)
			);
		}

	}

	add_action( 'customize_register', 'hestia_features_customize_register' );

endif;

/**
 * Add selective refresh for features section controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since 1.1.31
 * @access public
 */
function hestia_register_features_partials( $wp_customize ) {
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial(
		'hestia_features_content', array(
			'selector' => '.hestia-features-content',
			'settings' => 'hestia_features_content',
			'render_callback' => 'hestia_features_content_callback',
		)
	);
}
add_action( 'customize_register', 'hestia_register_features_partials' );


/**
 * Callback function for features content selective refresh.
 *
 * @since 1.1.31
 * @access public
 */
function hestia_features_content_callback() {
	$hestia_features_content = get_theme_mod( 'hestia_features_content' );
	hestia_features_content( $hestia_features_content, true );
}
