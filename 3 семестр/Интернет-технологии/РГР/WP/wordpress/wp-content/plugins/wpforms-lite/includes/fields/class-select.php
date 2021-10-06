<?php

/**
 * Dropdown field.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */
class WPForms_Field_Select extends WPForms_Field {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		// Define field type information.
		$this->name     = esc_html__( 'Dropdown', 'wpforms-lite' );
		$this->type     = 'select';
		$this->icon     = 'fa-caret-square-o-down';
		$this->order    = 70;
		$this->defaults = array(
			1 => array(
				'label'   => esc_html__( 'First Choice', 'wpforms-lite' ),
				'value'   => '',
				'default' => '',
			),
			2 => array(
				'label'   => esc_html__( 'Second Choice', 'wpforms-lite' ),
				'value'   => '',
				'default' => '',
			),
			3 => array(
				'label'   => esc_html__( 'Third Choice', 'wpforms-lite' ),
				'value'   => '',
				'default' => '',
			),
		);

		// Define additional field properties.
		add_filter( 'wpforms_field_properties_' . $this->type, array( $this, 'field_properties' ), 5, 3 );
	}

	/**
	 * Define additional field properties.
	 *
	 * @since 1.5.0
	 *
	 * @param array $properties Field properties.
	 * @param array $field      Field settings.
	 * @param array $form_data  Form data and settings.
	 *
	 * @return array
	 */
	public function field_properties( $properties, $field, $form_data ) {

		// Remove primary input.
		unset( $properties['inputs']['primary'] );

		// Define data.
		$form_id  = absint( $form_data['id'] );
		$field_id = absint( $field['id'] );
		$choices  = $field['choices'];
		$dynamic  = wpforms_get_field_dynamic_choices( $field, $form_id, $form_data );

		if ( $dynamic ) {
			$choices              = $dynamic;
			$field['show_values'] = true;
		}

		// Set options container (<select>) properties.
		$properties['input_container'] = array(
			'class' => array(),
			'data'  => array(),
			'id'    => "wpforms-{$form_id}-field_{$field_id}",
			'attr'  => array(
				'name' => "wpforms[fields][{$field_id}]",
			),
		);

		// Set properties.
		foreach ( $choices as $key => $choice ) {

			// Used for dynamic choices.
			$depth = isset( $choice['depth'] ) ? absint( $choice['depth'] ) : 1;

			$properties['inputs'][ $key ] = array(
				'container' => array(
					'attr'  => array(),
					'class' => array( "choice-{$key}", "depth-{$depth}" ),
					'data'  => array(),
					'id'    => '',
				),
				'label'     => array(
					'attr'  => array(
						'for' => "wpforms-{$form_id}-field_{$field_id}_{$key}",
					),
					'class' => array( 'wpforms-field-label-inline' ),
					'data'  => array(),
					'id'    => '',
					'text'  => $choice['label'],
				),
				'attr'      => array(
					'name'  => "wpforms[fields][{$field_id}]",
					'value' => isset( $field['show_values'] ) ? $choice['value'] : $choice['label'],
				),
				'class'     => array(),
				'data'      => array(),
				'id'        => "wpforms-{$form_id}-field_{$field_id}_{$key}",
				'required'  => ! empty( $field['required'] ) ? 'required' : '',
				'default'   => isset( $choice['default'] ),
			);
		}

		// Add class that changes the field size.
		if ( ! empty( $field['size'] ) ) {
			$properties['input_container']['class'][] = 'wpforms-field-' . esc_attr( $field['size'] );
		}

		// Required class for pagebreak validation.
		if ( ! empty( $field['required'] ) ) {
			$properties['input_container']['class'][] = 'wpforms-field-required';
		}

		return $properties;
	}

	/**
	 * Field options panel inside the builder.
	 *
	 * @since 1.0.0
	 *
	 * @param array $field Field settings.
	 */
	public function field_options( $field ) {
		/*
		 * Basic field options.
		 */

		// Options open markup.
		$this->field_option(
			'basic-options',
			$field,
			array(
				'markup' => 'open',
			)
		);

		// Label.
		$this->field_option( 'label', $field );

		// Choices.
		$this->field_option( 'choices', $field );

		// Description.
		$this->field_option( 'description', $field );

		// Required toggle.
		$this->field_option( 'required', $field );

		// Options close markup.
		$this->field_option(
			'basic-options',
			$field,
			array(
				'markup' => 'close',
			)
		);

		/*
		 * Advanced field options.
		 */

		// Options open markup.
		$this->field_option(
			'advanced-options',
			$field,
			array(
				'markup' => 'open',
			)
		);

		// Show Values toggle option. This option will only show if already used
		// or if manually enabled by a filter.
		if ( ! empty( $field['show_values'] ) || wpforms_show_fields_options_setting() ) {
			$show_values = $this->field_element(
				'checkbox',
				$field,
				array(
					'slug'    => 'show_values',
					'value'   => isset( $field['show_values'] ) ? $field['show_values'] : '0',
					'desc'    => esc_html__( 'Show Values', 'wpforms-lite' ),
					'tooltip' => esc_html__( 'Check this to manually set form field values.', 'wpforms-lite' ),
				),
				false
			);
			$this->field_element(
				'row',
				$field,
				array(
					'slug'    => 'show_values',
					'content' => $show_values,
				)
			);
		}

		// Size.
		$this->field_option( 'size', $field );

		// Placeholder.
		$this->field_option( 'placeholder', $field );

		// Hide label.
		$this->field_option( 'label_hide', $field );

		// Custom CSS classes.
		$this->field_option( 'css', $field );

		// Dynamic choice auto-populating toggle.
		$this->field_option( 'dynamic_choices', $field );

		// Dynamic choice source.
		$this->field_option( 'dynamic_choices_source', $field );

		// Options close markup.
		$this->field_option(
			'advanced-options',
			$field,
			array(
				'markup' => 'close',
			)
		);
	}

	/**
	 * Field preview inside the builder.
	 *
	 * @since 1.0.0
	 *
	 * @param array $field Field settings.
	 */
	public function field_preview( $field ) {

		// Label.
		$this->field_preview_option( 'label', $field );

		// Choices.
		$this->field_preview_option( 'choices', $field );

		// Description.
		$this->field_preview_option( 'description', $field );
	}

	/**
	 * Field display on the form front-end.
	 *
	 * @since 1.0.0
	 * @since 1.5.0 Converted to a new format, where all the data are taken not from $deprecated, but field properties.
	 *
	 * @param array $field      Field data and settings.
	 * @param array $deprecated Deprecated array of field attributes.
	 * @param array $form_data  Form data and settings.
	 */
	public function field_display( $field, $deprecated, $form_data ) {

		$container = $field['properties']['input_container'];

		$field_placeholder = ! empty( $field['placeholder'] ) ? $field['placeholder'] : '';
		if ( ! empty( $field['required'] ) ) {
			$container['attr']['required'] = 'required';
		}

		$choices     = $field['properties']['inputs'];
		$has_default = false;

		// Check to see if any of the options were selected by default.
		foreach ( $choices as $choice ) {
			if ( ! empty( $choice['default'] ) ) {
				$has_default = true;
				break;
			}
		}

		// Preselect default if no other choices were marked as default.
		printf(
			'<select %s>',
			wpforms_html_attributes( $container['id'], $container['class'], $container['data'], $container['attr'] )
		);

		// Optional placeholder.
		if ( ! empty( $field_placeholder ) ) {
			printf(
				'<option value="" class="placeholder" disabled %s>%s</option>',
				selected( false, $has_default, false ),
				esc_html( $field_placeholder )
			);
		}

		// Build the select options.
		foreach ( $choices as $key => $choice ) {
			printf(
				'<option value="%s" %s>%s</option>',
				esc_attr( $choice['attr']['value'] ),
				selected( true, ! empty( $choice['default'] ), false ),
				esc_html( $choice['label']['text'] )
			);
		}

		echo '</select>';
	}

	/**
	 * Formats and sanitizes field.
	 *
	 * @since 1.0.2
	 *
	 * @param int    $field_id     Field ID.
	 * @param string $field_submit Submitted field value (selected option).
	 * @param array  $form_data    Form data and settings.
	 */
	public function format( $field_id, $field_submit, $form_data ) {

		$field     = $form_data['fields'][ $field_id ];
		$dynamic   = ! empty( $field['dynamic_choices'] ) ? $field['dynamic_choices'] : false;
		$name      = sanitize_text_field( $field['label'] );
		$value_raw = sanitize_text_field( $field_submit );
		$value     = '';

		$data = array(
			'name'      => $name,
			'value'     => '',
			'value_raw' => $value_raw,
			'id'        => absint( $field_id ),
			'type'      => $this->type,
		);

		if ( 'post_type' === $dynamic && ! empty( $field['dynamic_post_type'] ) ) {

			// Dynamic population is enabled using post type.
			$data['dynamic']           = 'post_type';
			$data['dynamic_items']     = absint( $value_raw );
			$data['dynamic_post_type'] = $field['dynamic_post_type'];
			$post                      = get_post( $value_raw );

			if ( ! is_wp_error( $post ) && ! empty( $post ) && $data['dynamic_post_type'] === $post->post_type ) {
				$data['value'] = esc_html( $post->post_title );
			}
		} elseif ( 'taxonomy' === $dynamic && ! empty( $field['dynamic_taxonomy'] ) ) {

			// Dynamic population is enabled using taxonomy.
			$data['dynamic']          = 'taxonomy';
			$data['dynamic_items']    = absint( $value_raw );
			$data['dynamic_taxonomy'] = $field['dynamic_taxonomy'];
			$term                     = get_term( $value_raw, $data['dynamic_taxonomy'] );

			if ( ! is_wp_error( $term ) && ! empty( $term ) ) {
				$data['value'] = esc_html( $term->name );
			}
		} else {

			// Normal processing, dynamic population is off.

			// If show_values is true, that means values posted are the raw values
			// and not the labels. So we need to get the label values.
			if ( ! empty( $field['show_values'] ) && '1' == $field['show_values'] ) {

				foreach ( $field['choices'] as $choice ) {
					if ( $choice['value'] === $field_submit ) {
						$value = $choice['label'];
						break;
					}
				}

				$data['value'] = sanitize_text_field( $value );

			} else {
				$data['value'] = $value_raw;
			}
		}

		// Push field details to be saved.
		wpforms()->process->fields[ $field_id ] = $data;
	}
}

new WPForms_Field_Select();
