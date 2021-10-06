<?php
/**
 * Customizer functionality for the Clients bar section.
 *
 * @package Hestia
 * @since Hestia 1.1.47
 */

if ( ! function_exists( 'hestia_clients_bar_customize_register' ) ) :
	/**
	 * Hook controls for Clients bar section to Customizer.
	 *
	 * @since Hestia 1.0
	 * @modified 1.1.49
	 */
	function hestia_clients_bar_customize_register( $wp_customize ) {

		$selective_refresh = isset( $wp_customize->selective_refresh ) && function_exists('hestia_display_customizer_shortcut') ? 'postMessage' : 'refresh';

		if ( class_exists( 'Hestia_Hiding_Section' ) ) {
			$wp_customize->add_section(
				new Hestia_Hiding_Section(
					$wp_customize, 'hestia_clients_bar', array(
						'title'          => esc_html__( 'Clients Bar', 'themeisle-companion' ),
						'panel'          => 'hestia_frontpage_sections',
						'priority'       => apply_filters( 'hestia_section_priority', 50, 'hestia_clients_bar' ),
						'hiding_control' => 'hestia_clients_bar_hide',
					)
				)
			);
		} else {
			$wp_customize->add_section(
				'hestia_clients_bar', array(
					'title'    => esc_html__( 'Clients Bar', 'themeisle-companion' ),
					'panel'    => 'hestia_frontpage_sections',
					'priority' => apply_filters( 'hestia_section_priority', 50, 'hestia_clients_bar' ),
				)
			);
		}

		$wp_customize->add_setting(
			'hestia_clients_bar_hide', array(
				'sanitize_callback' => 'hestia_sanitize_checkbox',
				'default'           => true,
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			'hestia_clients_bar_hide', array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Disable section', 'themeisle-companion' ),
				'section'  => 'hestia_clients_bar',
				'priority' => 1,
			)
		);

		if ( class_exists( 'Hestia_Repeater' ) ) {
			$wp_customize->add_setting(
				'hestia_clients_bar_content', array(
					'sanitize_callback' => 'hestia_repeater_sanitize',
					'transport'         => $selective_refresh,
					'default'           => apply_filters( 'hestia_clients_bar_default_content', false ),
				)
			);

			$wp_customize->add_control(
				new Hestia_Repeater(
					$wp_customize, 'hestia_clients_bar_content', array(
						'label'                            => esc_html__( 'Clients Bar Content', 'themeisle-companion' ),
						'section'                          => 'hestia_clients_bar',
						'priority'                         => 5,
						'add_field_label'                  => esc_html__( 'Add new client', 'themeisle-companion' ),
						'item_name'                        => esc_html__( 'Clients', 'themeisle-companion' ),
						'customizer_repeater_image_control' => true,
						'customizer_repeater_link_control' => true,
					)
				)
			);
		}
	}
	add_action( 'customize_register', 'hestia_clients_bar_customize_register' );
endif;

/**
 * Add selective refresh for clients bar section controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since 1.1.47
 * @access public
 */
function hestia_register_clients_bar_partials( $wp_customize ) {
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial(
		'hestia_clients_bar_content', array(
			'selector'            => '.hestia-clients-bar',
			'container_inclusive' => true,
			'render_callback'     => 'hestia_clients_bar',
		)
	);
}
add_action( 'customize_register', 'hestia_register_clients_bar_partials' );
