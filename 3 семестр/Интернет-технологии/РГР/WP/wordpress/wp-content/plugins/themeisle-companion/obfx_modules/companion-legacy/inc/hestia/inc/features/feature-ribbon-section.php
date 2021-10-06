<?php
/**
 * Customizer functionality for the Ribbon section.
 *
 * @package Hestia
 * @since 1.1.47
 */


if ( ! function_exists( 'hestia_ribbon_customize_register' ) ) :

	/**
	 * Hook controls for Ribbon section to Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager.
	 * @since 1.1.47
	 * @modified 1.1.49
	 */
	function hestia_ribbon_customize_register( $wp_customize ) {

		$selective_refresh = isset( $wp_customize->selective_refresh ) && function_exists('hestia_display_customizer_shortcut') ? 'postMessage' : 'refresh';

		if ( class_exists( 'Hestia_Hiding_Section' ) ) {
			$wp_customize->add_section(
				new Hestia_Hiding_Section(
					$wp_customize, 'hestia_ribbon', array(
						'title'          => esc_html__( 'Ribbon', 'themeisle-companion' ),
						'panel'          => 'hestia_frontpage_sections',
						'priority'       => apply_filters( 'hestia_section_priority', 35, 'hestia_ribbon' ),
						'hiding_control' => 'hestia_ribbon_hide',
					)
				)
			);
		} else {
			$wp_customize->add_section(
				'hestia_ribbon', array(
					'title'    => esc_html__( 'Ribbon', 'themeisle-companion' ),
					'panel'    => 'hestia_frontpage_sections',
					'priority' => apply_filters( 'hestia_section_priority', 35, 'hestia_ribbon' ),
				)
			);
		}

		$wp_customize->add_setting(
			'hestia_ribbon_hide', array(
				'sanitize_callback' => 'hestia_sanitize_checkbox',
				'default'           => true,
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			'hestia_ribbon_hide', array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Disable section', 'themeisle-companion' ),
				'section'  => 'hestia_ribbon',
				'priority' => 1,
			)
		);

		$default = ( current_user_can( 'edit_theme_options' ) ? get_template_directory_uri() . '/assets/img/contact.jpg' : '' );
		$wp_customize->add_setting(
			'hestia_ribbon_background', array(
				'sanitize_callback' => 'esc_url_raw',
				'default'           => $default,
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize, 'hestia_ribbon_background', array(
					'label'           => esc_html__( 'Background Image', 'themeisle-companion' ),
					'section'         => 'hestia_ribbon',
					'priority'        => 5,
				)
			)
		);

		$default = ( current_user_can( 'edit_theme_options' ) ? esc_html__( 'Subscribe to our Newsletter', 'themeisle-companion' ) : false );
		$wp_customize->add_setting(
			'hestia_ribbon_text', array(
				'sanitize_callback' => 'wp_kses_post',
				'default'           => $default,
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			'hestia_ribbon_text', array(
				'type'  => 'textarea',
				'label'    => esc_html__( 'Text', 'themeisle-companion' ),
				'section'  => 'hestia_ribbon',
				'priority' => 10,
			)
		);

		$default = ( current_user_can( 'edit_theme_options' ) ? esc_html__( 'Subscribe', 'themeisle-companion' ) : false );
		$wp_customize->add_setting(
			'hestia_ribbon_button_text', array(
				'sanitize_callback' => 'sanitize_text_field',
				'default' => $default,
				'transport' => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			'hestia_ribbon_button_text', array(
				'label'    => esc_html__( 'Button Text', 'themeisle-companion' ),
				'section'  => 'hestia_ribbon',
				'priority' => 15,
			)
		);

		$default = ( current_user_can( 'edit_theme_options' ) ? '#' : false );
		$wp_customize->add_setting(
			'hestia_ribbon_button_url', array(
				'sanitize_callback' => 'esc_url_raw',
				'transport'         => $selective_refresh,
				'default' => $default,
			)
		);

		$wp_customize->add_control(
			'hestia_ribbon_button_url', array(
				'label'    => esc_html__( 'Link', 'themeisle-companion' ),
				'section'  => 'hestia_ribbon',
				'priority' => 20,
			)
		);
	}
	add_action( 'customize_register', 'hestia_ribbon_customize_register' );

endif;
