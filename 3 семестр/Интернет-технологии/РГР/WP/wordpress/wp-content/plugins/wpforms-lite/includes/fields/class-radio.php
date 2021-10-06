<?php

/**
 * Multiple Choice field.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */
class WPForms_Field_Radio extends WPForms_Field {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		// Define field type information.
		$this->name     = esc_html__( 'Multiple Choice', 'wpforms-lite' );
		$this->type     = 'radio';
		$this->icon     = 'fa-list-ul';
		$this->order    = 110;
		$this->defaults = array(
			1 => array(
				'label'   => esc_html__( 'First Choice', 'wpforms-lite' ),
				'value'   => '',
				'image'   => '',
				'default' => '',
			),
			2 => array(
				'label'   => esc_html__( 'Second Choice', 'wpforms-lite' ),
				'value'   => '',
				'image'   => '',
				'default' => '',
			),
			3 => array(
				'label'   => esc_html__( 'Third Choice', 'wpforms-lite' ),
				'value'   => '',
				'image'   => '',
				'default' => '',
			),
		);

		// Customize HTML field values.
		add_filter( 'wpforms_html_field_value', array( $this, 'field_html_value' ), 10, 4 );

		// Define additional field properties.
		add_filter( 'wpforms_field_properties_radio', array( $this, 'field_properties' ), 5, 3 );
	}

	/**
	 * Return images, if any, for HTML supported values.
	 *
	 * @since 1.4.5
	 *
	 * @param string $value     Field value.
	 * @param array  $field     Field settings.
	 * @param array  $form_data Form data and settings.
	 * @param string $context   Value display context.
	 *
	 * @return string
	 */
	public function field_html_value( $value, $field, $form_data = array(), $context = '' ) {

		// Only use HTML formatting for radio fields, with image choices
		// enabled, and exclude the entry table display. Lastly, provides a
		// filter to disable fancy display.
		if (
			! empty( $field['value'] ) &&
			'radio' === $field['type'] &&
			! empty( $field['image'] ) &&
			'entry-table' !== $context &&
			apply_filters( 'wpforms_radio_field_html_value_images', true, $context )
		) {

			if ( ! empty( $field['image'] ) ) {
				return sprintf(
					'<span style="max-width:200px;display:block;margin:0 0 5px 0;"><img src="%s" style="max-width:100%%;display:block;margin:0;"></span>%s',
					esc_url( $field['image'] ),
					$value
				);
			}
		}

		return $value;
	}

	/**
	 * Define additional field properties.
	 *
	 * @since 1.4.5
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

		// Set input container (ul) properties.
		$properties['input_container'] = array(
			'class' => array( ! empty( $field['random'] ) ? 'wpforms-randomize' : '' ),
			'data'  => array(),
			'attr'  => array(),
			'id'    => "wpforms-{$form_id}-field_{$field_id}",
		);

		// Set input properties.
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
				'image'     => isset( $choice['image'] ) ? $choice['image'] : '',
				'required'  => ! empty( $field['required'] ) ? 'required' : '',
				'default'   => isset( $choice['default'] ),
			);
		}

		// Required class for pagebreak validation.
		if ( ! empty( $field['required'] ) ) {
			$properties['input_container']['class'][] = 'wpforms-field-required';
		}

		// Custom properties if image choices is enabled.
		if ( ! $dynamic && ! empty( $field['choices_images'] ) ) {

			$properties['input_container']['class'][] = 'wpforms-image-choices';
			$properties['input_container']['class'][] = 'wpforms-image-choices-' . sanitize_html_class( $field['choices_images_style'] );

			foreach ( $properties['inputs'] as $key => $inputs ) {
				$properties['inputs'][ $key ]['container']['class'][] = 'wpforms-image-choices-item';

				if ( in_array( $field['choices_images_style'], array( 'modern', 'classic' ), true ) ) {
					$properties['inputs'][ $key ]['class'][] = 'wpforms-screen-reader-element';
				}
			}
		}

		// Add selected class for choices with defaults.
		foreach ( $properties['inputs'] as $key => $inputs ) {
			if ( ! empty( $inputs['default'] ) ) {
				$properties['inputs'][ $key ]['container']['class'][] = 'wpforms-selected';
			}
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

		// Choices Images.
		$this->field_option( 'choices_images', $field );

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

		// Randomize order of choices.
		$this->field_element(
			'row',
			$field,
			array(
				'slug'    => 'random',
				'content' => $this->field_element(
					'checkbox',
					$field,
					array(
						'slug'    => 'random',
						'value'   => isset( $field['random'] ) ? '1' : '0',
						'desc'    => esc_html__( 'Randomize Choices', 'wpforms-lite' ),
						'tooltip' => esc_html__( 'Check this option to randomize the order of the choices.', 'wpforms-lite' ),
					),
					false
				),
			)
		);

		// Show Values toggle option. This option will only show if already used
		// or if manually enabled by a filter.
		if ( ! empty( $field['show_values'] ) || wpforms_show_fields_options_setting() ) {
			$this->field_element(
				'row',
				$field,
				array(
					'slug'    => 'show_values',
					'content' => $this->field_element(
						'checkbox',
						$field,
						array(
							'slug'    => 'show_values',
							'value'   => isset( $field['show_values'] ) ? $field['show_values'] : '0',
							'desc'    => esc_html__( 'Show Values', 'wpforms-lite' ),
							'tooltip' => esc_html__( 'Check this to manually set form field values.', 'wpforms-lite' ),
						),
						false
					),
				)
			);
		}

		// Choices Images Style (theme).
		$this->field_option( 'choices_images_style', $field );

		// Display format.
		$this->field_option( 'input_columns', $field );

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
	 *
	 * @param array $field      Field settings.
	 * @param array $deprecated Deprecated array.
	 * @param array $form_data  Form data and settings.
	 */
	public function field_display( $field, $deprecated, $form_data ) {
		$using_image_choices = empty( $field['dynamic_choices'] ) && ! empty( $field['choices_images'] );

		// Define data.
		$container = $field['properties']['input_container'];
		$choices   = $field['properties']['inputs'];

		$amp_state_id = '';
		if ( wpforms_is_amp() && $using_image_choices ) {
			$amp_state_id = str_replace( '-', '_', sanitize_key( $container['id'] ) ) . '_state';
			$state        = array(
				'selected' => null,
			);
			foreach ( $choices as $key => $choice ) {
				if ( $choice['default'] ) {
					$state['selected'] = $choice['attr']['value'];
					break;
				}
			}
			printf(
				'<amp-state id="%s"><script type="application/json">%s</script></amp-state>',
				esc_attr( $amp_state_id ),
				wp_json_encode( $state )
			);
		}

		printf(
			'<ul %s>',
			wpforms_html_attributes( $container['id'], $container['class'], $container['data'], $container['attr'] )
		); // WPCS: XSS ok.

			foreach ( $choices as $key => $choice ) {

				if ( wpforms_is_amp() && $using_image_choices ) {
					$choice['container']['attr']['[class]'] = sprintf(
						'%s + ( %s == %s ? " wpforms-selected" : "")',
						wp_json_encode( implode( ' ', $choice['container']['class'] ) ),
						$amp_state_id,
						wp_json_encode( $choice['attr']['value'] )
					);
				}

				printf(
					'<li %s>',
					wpforms_html_attributes( $choice['container']['id'], $choice['container']['class'], $choice['container']['data'], $choice['container']['attr'] )
				); // WPCS: XSS ok.

					if ( $using_image_choices ) {

						// Make sure the image choices are keyboard-accessible.
						$choice['label']['attr']['tabindex'] = 0;

						if ( wpforms_is_amp() ) {
							$choice['label']['attr']['on']   = sprintf(
								'tap:AMP.setState(%s)',
								wp_json_encode( array( $amp_state_id => $choice['attr']['value'] ) )
							);
							$choice['label']['attr']['role'] = 'button';
						}

						// Image choices.
						printf(
							'<label %s>',
							wpforms_html_attributes( $choice['label']['id'], $choice['label']['class'], $choice['label']['data'], $choice['label']['attr'] )
						); // WPCS: XSS ok.

							if ( ! empty( $choice['image'] ) ) {
								printf(
									'<span class="wpforms-image-choices-image"><img src="%s" alt="%s"%s></span>',
									esc_url( $choice['image'] ),
									esc_attr( $choice['label']['text'] ),
									! empty( $choice['label']['text'] ) ? ' title="' . esc_attr( $choice['label']['text'] ) . '"' : ''
								);
							}

							if ( 'none' === $field['choices_images_style'] ) {
								echo '<br>';
							}

							$choice['attr']['tabindex'] = '-1';

							if ( wpforms_is_amp() ) {
								$choice['attr']['[checked]'] = sprintf(
									'%s == %s',
									$amp_state_id,
									wp_json_encode( $choice['attr']['value'] )
								);
							}

							printf(
								'<input type="radio" %s %s %s>',
								wpforms_html_attributes( $choice['id'], $choice['class'], $choice['data'], $choice['attr'] ),
								esc_attr( $choice['required'] ),
								checked( '1', $choice['default'], false )
							); // WPCS: XSS ok.

							echo '<span class="wpforms-image-choices-label">' . wp_kses_post( $choice['label']['text'] ) . '</span>';

						echo '</label>';

					} else {
						// Normal display.
						printf(
							'<input type="radio" %s %s %s>',
							wpforms_html_attributes( $choice['id'], $choice['class'], $choice['data'], $choice['attr'] ),
							esc_attr( $choice['required'] ),
							checked( '1', $choice['default'], false )
						); // WPCS: XSS ok.

						printf(
							'<label %s>%s</label>',
							wpforms_html_attributes( $choice['label']['id'], $choice['label']['class'], $choice['label']['data'], $choice['label']['attr'] ),
							wp_kses_post( $choice['label']['text'] )
						); // WPCS: XSS ok.
					}

				echo '</li>';
			}

		echo '</ul>';
	}

	/**
	 * Formats and sanitizes field.
	 *
	 * @since 1.0.2
	 *
	 * @param int    $field_id     Field ID.
	 * @param string $field_submit Submitted form data.
	 * @param array  $form_data    Form data and settings.
	 */
	public function format( $field_id, $field_submit, $form_data ) {

		$field     = $form_data['fields'][ $field_id ];
		$dynamic   = ! empty( $field['dynamic_choices'] ) ? $field['dynamic_choices'] : false;
		$name      = sanitize_text_field( $field['label'] );
		$value_raw = sanitize_text_field( $field_submit );

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

			if ( ! empty( $post ) && ! is_wp_error( $post ) && $data['dynamic_post_type'] === $post->post_type ) {
				$data['value'] = esc_html( $post->post_title );
			}
		} elseif ( 'taxonomy' === $dynamic && ! empty( $field['dynamic_taxonomy'] ) ) {

			// Dynamic population is enabled using taxonomy.
			$data['dynamic']          = 'taxonomy';
			$data['dynamic_items']    = absint( $value_raw );
			$data['dynamic_taxonomy'] = $field['dynamic_taxonomy'];
			$term                     = get_term( $value_raw, $data['dynamic_taxonomy'] );

			if ( ! empty( $term ) && ! is_wp_error( $term ) ) {
				$data['value'] = esc_html( $term->name );
			}
		} else {

			// Normal processing, dynamic population is off.
			$choice_key = '';

			// If show_values is true, that means value posted is the raw value
			// and not the label. So we need to set label value. Also store
			// the choice key.
			if ( ! empty( $field['show_values'] ) ) {
				foreach ( $field['choices'] as $key => $choice ) {
					if ( $choice['value'] === $field_submit ) {
						$data['value'] = sanitize_text_field( $choice['label'] );
						$choice_key    = $key;
						break;
					}
				}
			} else {

				$data['value'] = $value_raw;

				// Determine choice key, this is needed for image choices.
				foreach ( $field['choices'] as $key => $choice ) {
					if ( $choice['label'] === $field_submit ) {
						$choice_key = $key;
						break;
					}
				}
			}

			// Images choices are enabled, lookup and store image URL.
			if ( ! empty( $choice_key ) && ! empty( $field['choices_images'] ) ) {

				$data['image'] = ! empty( $field['choices'][ $choice_key ]['image'] ) ? esc_url_raw( $field['choices'][ $choice_key ]['image'] ) : '';
			}
		}

		// Push field details to be saved.
		wpforms()->process->fields[ $field_id ] = $data;
	}
}

new WPForms_Field_Radio();
