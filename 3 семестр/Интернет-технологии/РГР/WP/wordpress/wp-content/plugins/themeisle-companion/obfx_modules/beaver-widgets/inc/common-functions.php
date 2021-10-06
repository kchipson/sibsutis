<?php
/**
 * This file contains common functions that can be used in every Beaver module
 *
 * @package themeisle-companion
 */

// Get the module directory.
$module_directory = $this->get_dir();

// Require custom field.
require_once( $module_directory . '/custom-fields/number-field/number_field.php' );

/**
 * Function to return padding controls.
 *
 * @param array $settings Fields settings.
 *
 * @return array
 */
function themeisle_four_fields_control( $settings ) {
	$default = $settings['default'];
	$prefix = $settings['field_name_prefix'];
	$type = ! empty( $settings['type'] ) ? $settings['type'] : 'padding';
	return array(
		'title'  => $type === 'margin' ? esc_html__( 'Margins', 'themeisle-companion' ) : esc_html__( 'Padding', 'themeisle-companion' ),
		'fields' => array(
			$prefix . 'top' => array(
				'type'        => 'obfx_number',
				'label' => esc_html__( 'Top', 'themeisle-companion' ),
				'description' => esc_html__( 'px', 'themeisle-companion' ),
				'default' => $default['top'],
			),
			$prefix . 'bottom' => array(
				'type'        => 'obfx_number',
				'label' => esc_html__( 'Bottom', 'themeisle-companion' ),
				'description' => esc_html__( 'px', 'themeisle-companion' ),
				'default' => $default['bottom'],
			),
			$prefix . 'left' => array(
				'type'        => 'obfx_number',
				'label' => esc_html__( 'Left', 'themeisle-companion' ),
				'description' => esc_html__( 'px', 'themeisle-companion' ),
				'default' => $default['left'],
			),
			$prefix . 'right' => array(
				'type'        => 'obfx_number',
				'label' => esc_html__( 'Right', 'themeisle-companion' ),
				'description' => esc_html__( 'px', 'themeisle-companion' ),
				'default' => $default['right'],
			),
		),
	);
}

/**
 * Typography controls.
 *
 * @param array $settings Typography settings.
 *
 * @return array
 */
function themeisle_typography_settings( $settings ) {
	$title = ! empty( $settings['title'] ) ? $settings['title'] : esc_html__( 'Typography', 'themeisle-companion' );
	$prefix = $settings['prefix'];
	$font_default = ! empty( $settings['font_size_default'] ) ? $settings['font_size_default'] : '';
	return array(
		'title' => $title,
		'fields' => array(
			$prefix . 'font_size' => array(
				'type'        => 'obfx_number',
				'label' => esc_html__( 'Font size', 'themeisle-companion' ),
				'description' => esc_html__( 'px', 'themeisle-companion' ),
				'default' => $font_default,
			),
			$prefix . 'font_family' => array(
				'type'          => 'font',
				'label'         => esc_html__( 'Font family', 'themeisle-companion' ),
				'default'       => array(
					'family'        => 'Roboto',
					'weight'        => 300,
				),
			),
			$prefix . 'transform' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Transform', 'themeisle-companion' ),
				'default' => 'none',
				'options' => array(
					'none' => esc_html__( 'None', 'themeisle-companion' ),
					'capitalize' => esc_html__( 'Capitalize', 'themeisle-companion' ),
					'uppercase' => esc_html__( 'Uppercase', 'themeisle-companion' ),
					'lowercase' => esc_html__( 'Lowercase', 'themeisle-companion' ),
				),
			),
			$prefix . 'font_style' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Font style', 'themeisle-companion' ),
				'default' => 'normal',
				'options' => array(
					'normal' => esc_html__( 'Normal', 'themeisle-companion' ),
					'italic' => esc_html__( 'Italic', 'themeisle-companion' ),
					'oblique' => esc_html__( 'Oblique', 'themeisle-companion' ),
				),
			),
			$prefix . 'line_height' => array(
				'type'        => 'obfx_number',
				'label' => esc_html__( 'Line height', 'themeisle-companion' ),
				'description' => esc_html__( 'px', 'themeisle-companion' ),
			),
			$prefix . 'letter_spacing' => array(
				'type'        => 'obfx_number',
				'label' => esc_html__( 'Letter spacing', 'themeisle-companion' ),
				'description' => esc_html__( 'px', 'themeisle-companion' ),
			),
		),
	);
}
