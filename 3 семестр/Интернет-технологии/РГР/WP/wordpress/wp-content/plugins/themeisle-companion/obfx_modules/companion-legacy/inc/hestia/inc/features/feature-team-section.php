<?php
/**
 * Customizer functionality for the Team section.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

if ( ! function_exists( 'hestia_team_customize_register' ) ) :
	/**
	 * Hook controls for Team section to Customizer.
	 *
	 * @since Hestia 1.0
	 * @modified 1.1.49
	 */
	function hestia_team_customize_register( $wp_customize ) {

		$selective_refresh = isset( $wp_customize->selective_refresh ) && function_exists('hestia_display_customizer_shortcut') ? 'postMessage' : 'refresh';

		if ( class_exists( 'Hestia_Hiding_Section' ) ) {
			$wp_customize->add_section(
				new Hestia_Hiding_Section(
					$wp_customize, 'hestia_team', array(
						'title'          => esc_html__( 'Team', 'themeisle-companion' ),
						'panel'          => 'hestia_frontpage_sections',
						'priority'       => apply_filters( 'hestia_section_priority', 30, 'hestia_team' ),
						'hiding_control' => 'hestia_team_hide',
					)
				)
			);
		} else {
			$wp_customize->add_section(
				'hestia_team', array(
					'title'    => esc_html__( 'Team', 'themeisle-companion' ),
					'panel'    => 'hestia_frontpage_sections',
					'priority' => apply_filters( 'hestia_section_priority', 30, 'hestia_team' ),
				)
			);
		}

		$wp_customize->add_setting(
			'hestia_team_hide', array(
				'sanitize_callback' => 'hestia_sanitize_checkbox',
				'default'           => false,
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			'hestia_team_hide', array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Disable section', 'themeisle-companion' ),
				'section'  => 'hestia_team',
				'priority' => 1,
			)
		);

		$wp_customize->add_setting(
			'hestia_team_title', array(
				'sanitize_callback' => 'wp_kses_post',
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			'hestia_team_title', array(
				'label'    => esc_html__( 'Section Title', 'themeisle-companion' ),
				'section'  => 'hestia_team',
				'priority' => 5,
			)
		);

		$wp_customize->add_setting(
			'hestia_team_subtitle', array(
				'sanitize_callback' => 'wp_kses_post',
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			'hestia_team_subtitle', array(
				'label'    => esc_html__( 'Section Subtitle', 'themeisle-companion' ),
				'section'  => 'hestia_team',
				'priority' => 10,
			)
		);

		if ( class_exists( 'Hestia_Repeater' ) ) {
			$wp_customize->add_setting(
				'hestia_team_content', array(
					'sanitize_callback' => 'hestia_repeater_sanitize',
					'transport'         => $selective_refresh,
				)
			);

			$wp_customize->add_control(
				new Hestia_Repeater(
					$wp_customize, 'hestia_team_content', array(
						'label'                                => esc_html__( 'Team Content', 'themeisle-companion' ),
						'section'                              => 'hestia_team',
						'priority'                             => 15,
						'add_field_label'                      => esc_html__( 'Add new Team Member', 'themeisle-companion' ),
						'item_name'                            => esc_html__( 'Team Member', 'themeisle-companion' ),
						'customizer_repeater_image_control'    => true,
						'customizer_repeater_title_control'    => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_text_control'     => true,
						'customizer_repeater_link_control'     => true,
						'customizer_repeater_repeater_control' => true,
					)
				)
			);
		}
	}

	add_action( 'customize_register', 'hestia_team_customize_register' );

endif;


/**
 * Add selective refresh for team section controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since 1.1.31
 * @access public
 */
function hestia_register_team_partials( $wp_customize ) {
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}
	
	$wp_customize->selective_refresh->add_partial(
		'hestia_team_content', array(
			'selector' => '.hestia-team-content',
			'settings' => 'hestia_team_content',
			'render_callback' => 'hestia_team_content_callback',
		)
	);
}
add_action( 'customize_register', 'hestia_register_team_partials' );

/**
 * Callback function for team content selective refresh.
 *
 * @since 1.1.31
 * @access public
 */
function hestia_team_content_callback() {
	$hestia_team_content = get_theme_mod( 'hestia_team_content' );
	hestia_team_content( $hestia_team_content, true );
}
