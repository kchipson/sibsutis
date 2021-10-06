<?php

/**
 * Name text field.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */
class WPForms_Field_Name extends WPForms_Field {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		// Define field type information.
		$this->name  = esc_html__( 'Name', 'wpforms-lite' );
		$this->type  = 'name';
		$this->icon  = 'fa-user';
		$this->order = 150;

		// Define additional field properties.
		add_filter( 'wpforms_field_properties_name', array( $this, 'field_properties' ), 5, 3 );

		// Set field to default to required.
		add_filter( 'wpforms_field_new_required', array( $this, 'default_required' ), 10, 2 );
	}

	/**
	 * Define additional field properties.
	 *
	 * @since 1.3.7
	 *
	 * @param array $properties Field properties.
	 * @param array $field      Field data and settings.
	 * @param array $form_data  Form data and settings.
	 *
	 * @return array
	 */
	public function field_properties( $properties, $field, $form_data ) {

		$format = ! empty( $field['format'] ) ? esc_attr( $field['format'] ) : 'first-last';

		// Simple format.
		if ( 'simple' === $format ) {
			$properties['inputs']['primary']['attr']['placeholder'] = ! empty( $field['simple_placeholder'] ) ? $field['simple_placeholder'] : '';
			$properties['inputs']['primary']['attr']['value']       = ! empty( $field['simple_default'] ) ? apply_filters( 'wpforms_process_smart_tags', $field['simple_default'], $form_data ) : '';

			return $properties;
		}

		// Expanded formats.
		// Remove primary for expanded formats since we have first, middle, last.
		unset( $properties['inputs']['primary'] );

		$form_id  = absint( $form_data['id'] );
		$field_id = absint( $field['id'] );

		$props = array(
			'inputs' => array(
				'first'  => array(
					'attr'     => array(
						'name'        => "wpforms[fields][{$field_id}][first]",
						'value'       => ! empty( $field['first_default'] ) ? apply_filters( 'wpforms_process_smart_tags', $field['first_default'], $form_data ) : '',
						'placeholder' => ! empty( $field['first_placeholder'] ) ? $field['first_placeholder'] : '',
					),
					'block'    => array(
						'wpforms-field-row-block',
						'wpforms-first',
					),
					'class'    => array(
						'wpforms-field-name-first',
					),
					'data'     => array(),
					'id'       => "wpforms-{$form_id}-field_{$field_id}",
					'required' => ! empty( $field['required'] ) ? 'required' : '',
					'sublabel' => array(
						'hidden' => ! empty( $field['sublabel_hide'] ),
						'value'  => esc_html__( 'First', 'wpforms-lite' ),
					),
				),
				'middle' => array(
					'attr'     => array(
						'name'        => "wpforms[fields][{$field_id}][middle]",
						'value'       => ! empty( $field['middle_default'] ) ? apply_filters( 'wpforms_process_smart_tags', $field['middle_default'], $form_data ) : '',
						'placeholder' => ! empty( $field['middle_placeholder'] ) ? $field['middle_placeholder'] : '',
					),
					'block'    => array(
						'wpforms-field-row-block',
						'wpforms-one-fifth',
					),
					'class'    => array(
						'wpforms-field-name-middle',
					),
					'data'     => array(),
					'id'       => "wpforms-{$form_id}-field_{$field_id}-middle",
					'required' => '',
					'sublabel' => array(
						'hidden' => ! empty( $field['sublabel_hide'] ),
						'value'  => esc_html__( 'Middle', 'wpforms-lite' ),
					),
				),
				'last'   => array(
					'attr'     => array(
						'name'        => "wpforms[fields][{$field_id}][last]",
						'value'       => ! empty( $field['last_default'] ) ? apply_filters( 'wpforms_process_smart_tags', $field['last_default'], $form_data ) : '',
						'placeholder' => ! empty( $field['last_placeholder'] ) ? $field['last_placeholder'] : '',
					),
					'block'    => array(
						'wpforms-field-row-block',

					),
					'class'    => array(
						'wpforms-field-name-last',
					),
					'data'     => array(),
					'id'       => "wpforms-{$form_id}-field_{$field_id}-last",
					'required' => ! empty( $field['required'] ) ? 'required' : '',
					'sublabel' => array(
						'hidden' => ! empty( $field['sublabel_hide'] ),
						'value'  => esc_html__( 'Last', 'wpforms-lite' ),
					),
				),
			),
		);

		$properties = array_merge_recursive( $properties, $props );

		// Input First: add error class if needed.
		if ( ! empty( $properties['error']['value']['first'] ) ) {
			$properties['inputs']['first']['class'][] = 'wpforms-error';
		}

		// Input First: add required class if needed.
		if ( ! empty( $field['required'] ) ) {
			$properties['inputs']['first']['class'][] = 'wpforms-field-required';
		}

		// Input First: add column class.
		$properties['inputs']['first']['block'][] = 'first-last' === $format ? 'wpforms-one-half' : 'wpforms-two-fifths';

		// Input Last: add error class if needed.
		if ( ! empty( $properties['error']['value']['last'] ) ) {
			$properties['inputs']['last']['class'][] = 'wpforms-error';
		}

		// Input Last: add required class if needed.
		if ( ! empty( $field['required'] ) ) {
			$properties['inputs']['last']['class'][] = 'wpforms-field-required';
		}

		// Input Last: add column class.
		$properties['inputs']['last']['block'][] = 'first-last' === $format ? 'wpforms-one-half' : 'wpforms-two-fifths';

		return $properties;
	}

	/**
	 * Name fields should default to being required.
	 *
	 * @since 1.0.8
	 *
	 * @param bool  $required
	 * @param array $field
	 *
	 * @return bool
	 */
	public function default_required( $required, $field ) {

		if ( 'name' === $field['type'] ) {
			return true;
		}
		return $required;
	}

	/**
	 * Field options panel inside the builder.
	 *
	 * @since 1.0.0
	 *
	 * @param array $field
	 */
	public function field_options( $field ) {

		// Define data.
		$format = ! empty( $field['format'] ) ? esc_attr( $field['format'] ) : 'first-last';

		/*
		 * Basic field options.
		 */

		// Options open markup.
		$args = array(
			'markup' => 'open',
		);
		$this->field_option( 'basic-options', $field, $args );

		// Label.
		$this->field_option( 'label', $field );

		// Format.
		$lbl = $this->field_element(
			'label',
			$field,
			array(
				'slug'    => 'format',
				'value'   => esc_html__( 'Format', 'wpforms-lite' ),
				'tooltip' => esc_html__( 'Select format to use for the name form field', 'wpforms-lite' ),
			),
			false
		);
		$fld = $this->field_element(
			'select',
			$field,
			array(
				'slug'    => 'format',
				'value'   => $format,
				'options' => array(
					'simple'            => esc_html__( 'Simple', 'wpforms-lite' ),
					'first-last'        => esc_html__( 'First Last', 'wpforms-lite' ),
					'first-middle-last' => esc_html__( 'First Middle Last', 'wpforms-lite' ),
				),
			),
			false
		);
		$args = array(
			'slug'    => 'format',
			'content' => $lbl . $fld,
		);
		$this->field_element( 'row', $field, $args );

		// Description.
		$this->field_option( 'description', $field );

		// Required toggle.
		$this->field_option( 'required', $field );

		// Options close markup.
		$args = array(
			'markup' => 'close',
		);
		$this->field_option( 'basic-options', $field, $args );

		/*
		 * Advanced field options.
		 */

		// Options open markup.
		$args = array(
			'markup' => 'open',
		);
		$this->field_option( 'advanced-options', $field, $args );

		// Size.
		$this->field_option( 'size', $field );

		echo '<div class="format-selected-' . $format . ' format-selected">';

			// Simple.
			$simple_placeholder = ! empty( $field['simple_placeholder'] ) ? esc_attr( $field['simple_placeholder'] ) : '';
			$simple_default     = ! empty( $field['simple_default'] ) ? esc_attr( $field['simple_default'] ) : '';
			printf( '<div class="wpforms-clear wpforms-field-option-row wpforms-field-option-row-simple" id="wpforms-field-option-row-%d-simple" data-subfield="simple" data-field-id="%d">', $field['id'], $field['id'] );
				$this->field_element( 'label', $field, array( 'slug' => 'simple_placeholder', 'value' => esc_html__( 'Name', 'wpforms-lite' ), 'tooltip' => esc_html__( 'Name field advanced options.', 'wpforms-lite' ) ) );
				echo '<div class="placeholder">';
					printf( '<input type="text" class="placeholder" id="wpforms-field-option-%d-simple_placeholder" name="fields[%d][simple_placeholder]" value="%s">', $field['id'], $field['id'], $simple_placeholder );
					printf( '<label for="wpforms-field-option-%d-simple_placeholder" class="sub-label">%s</label>', $field['id'], esc_html__( 'Placeholder', 'wpforms-lite' ) );
				echo '</div>';
				echo '<div class="default">';
					printf( '<input type="text" class="default" id="wpforms-field-option-%d-simple_default" name="fields[%d][simple_default]" value="%s">', $field['id'], $field['id'], $simple_default );
					printf( '<label for="wpforms-field-option-%d-simple_default" class="sub-label">%s</label>', $field['id'], esc_html__( 'Default Value', 'wpforms-lite' ) );
				echo '</div>';
			echo '</div>';

			// First.
			$first_placeholder = ! empty( $field['first_placeholder'] ) ? esc_attr( $field['first_placeholder'] ) : '';
			$first_default     = ! empty( $field['first_default'] ) ? esc_attr( $field['first_default'] ) : '';
			printf( '<div class="wpforms-clear wpforms-field-option-row wpforms-field-option-row-first" id="wpforms-field-option-row-%d-first" data-subfield="first-name" data-field-id="%d">', $field['id'], $field['id'] );
				$this->field_element( 'label', $field, array( 'slug' => 'first_placeholder', 'value' => esc_html__( 'First Name', 'wpforms-lite' ), 'tooltip' => esc_html__( 'First name field advanced options.', 'wpforms-lite' ) ) );
				echo '<div class="placeholder">';
					printf( '<input type="text" class="placeholder" id="wpforms-field-option-%d-first_placeholder" name="fields[%d][first_placeholder]" value="%s">', $field['id'], $field['id'], $first_placeholder );
					printf( '<label for="wpforms-field-option-%d-first_placeholder" class="sub-label">%s</label>', $field['id'], esc_html__( 'Placeholder', 'wpforms-lite' ) );
				echo '</div>';
				echo '<div class="default">';
					printf( '<input type="text" class="default" id="wpforms-field-option-%d-first_default" name="fields[%d][first_default]" value="%s">', $field['id'], $field['id'], $first_default );
					printf( '<label for="wpforms-field-option-%d-first_default" class="sub-label">%s</label>', $field['id'], esc_html__( 'Default Value', 'wpforms-lite' ) );
				echo '</div>';
			echo '</div>';

			// Middle.
			$middle_placeholder = ! empty( $field['middle_placeholder'] ) ? esc_attr( $field['middle_placeholder'] ) : '';
			$middle_default     = ! empty( $field['middle_default'] ) ? esc_attr( $field['middle_default'] ) : '';
			printf( '<div class="wpforms-clear wpforms-field-option-row wpforms-field-option-row-middle" id="wpforms-field-option-row-%d-middle" data-subfield="middle-name" data-field-id="%d">', $field['id'], $field['id'] );
				$this->field_element( 'label', $field, array( 'slug' => 'middle_placeholder', 'value' => esc_html__( 'Middle Name', 'wpforms-lite' ), 'tooltip' => esc_html__( 'Middle name field advanced options.', 'wpforms-lite' ) ) );
				echo '<div class="placeholder">';
					printf( '<input type="text" class="placeholder" id="wpforms-field-option-%d-middle_placeholder" name="fields[%d][middle_placeholder]" value="%s">', $field['id'], $field['id'], $middle_placeholder );
					printf( '<label for="wpforms-field-option-%d-middle_placeholder" class="sub-label">%s</label>', $field['id'], esc_html__( 'Placeholder', 'wpforms-lite' ) );
				echo '</div>';
				echo '<div class="default">';
					printf( '<input type="text" class="default" id="wpforms-field-option-%d-middle_default" name="fields[%d][middle_default]" value="%s">', $field['id'], $field['id'], $middle_default );
					printf( '<label for="wpforms-field-option-%d-middle_default" class="sub-label">%s</label>', $field['id'], esc_html__( 'Default Value', 'wpforms-lite' ) );
				echo '</div>';
			echo '</div>';

			// Last.
			$last_placeholder = ! empty( $field['last_placeholder'] ) ? esc_attr( $field['last_placeholder'] ) : '';
			$last_default     = ! empty( $field['last_default'] ) ? esc_attr( $field['last_default'] ) : '';
			printf( '<div class="wpforms-clear wpforms-field-option-row wpforms-field-option-row-last" id="wpforms-field-option-row-%d-last" data-subfield="last-name" data-field-id="%d">', $field['id'], $field['id'] );
				$this->field_element( 'label', $field, array( 'slug' => 'last_placeholder', 'value' => esc_html__( 'Last Name', 'wpforms-lite' ), 'tooltip' => esc_html__( 'Last name field advanced options.', 'wpforms-lite' ) ) );
				echo '<div class="placeholder">';
					printf( '<input type="text" class="placeholder" id="wpforms-field-option-%d-last_placeholder" name="fields[%d][last_placeholder]" value="%s">', $field['id'], $field['id'], $last_placeholder );
					printf( '<label for="wpforms-field-option-%d-last_placeholder" class="sub-label">%s</label>', $field['id'], esc_html__( 'Placeholder', 'wpforms-lite' ) );
				echo '</div>';
				echo '<div class="default">';
					printf( '<input type="text" class="default" id="wpforms-field-option-%d-last_default" name="fields[%d][last_default]" value="%s">', $field['id'], $field['id'], $last_default );
					printf( '<label for="wpforms-field-option-%d-last_default" class="sub-label">%s</label>', $field['id'], esc_html__( 'Default Value', 'wpforms-lite' ) );
				echo '</div>';
			echo '</div>';

		echo '</div>';

		// Hide Label.
		$this->field_option( 'label_hide', $field );

		// Hide sub-labels.
		$this->field_option( 'sublabel_hide', $field );

		// Custom CSS classes.
		$this->field_option( 'css', $field );

		// Options close markup.
		$args = array(
			'markup' => 'close',
		);
		$this->field_option( 'advanced-options', $field, $args );
	}

	/**
	 * Field preview inside the builder.
	 *
	 * @since 1.0.0
	 *
	 * @param array $field Field information.
	 */
	public function field_preview( $field ) {

		// Define data.
		$simple_placeholder = ! empty( $field['simple_placeholder'] ) ? esc_attr( $field['simple_placeholder'] ) : '';
		$first_placeholder  = ! empty( $field['first_placeholder'] ) ? esc_attr( $field['first_placeholder'] ) : '';
		$middle_placeholder = ! empty( $field['middle_placeholder'] ) ? esc_attr( $field['middle_placeholder'] ) : '';
		$last_placeholder   = ! empty( $field['last_placeholder'] ) ? esc_attr( $field['last_placeholder'] ) : '';
		$format             = ! empty( $field['format'] ) ? esc_attr( $field['format'] ) : 'first-last';

		// Label.
		$this->field_preview_option( 'label', $field );
		?>

		<div class="format-selected-<?php echo $format; ?> format-selected">

			<div class="wpforms-simple">
				<input type="text" placeholder="<?php echo $simple_placeholder; ?>" class="primary-input" disabled>
			</div>

			<div class="wpforms-first-name">
				<input type="text" placeholder="<?php echo $first_placeholder; ?>" class="primary-input" disabled>
				<label class="wpforms-sub-label"><?php esc_html_e( 'First', 'wpforms-lite' ); ?></label>
			</div>

			<div class="wpforms-middle-name">
				<input type="text" placeholder="<?php echo $middle_placeholder; ?>" class="primary-input" disabled>
				<label class="wpforms-sub-label"><?php esc_html_e( 'Middle', 'wpforms-lite' ); ?></label>
			</div>

			<div class="wpforms-last-name">
				<input type="text" placeholder="<?php echo $last_placeholder; ?>" class="primary-input" disabled>
				<label class="wpforms-sub-label"><?php esc_html_e( 'Last', 'wpforms-lite' ); ?></label>
			</div>

		</div>

		<?php
		// Description.
		$this->field_preview_option( 'description', $field );
	}

	/**
	 * Field display on the form front-end.
	 *
	 * @since 1.0.0
	 *
	 * @param array $field Field information.
	 * @param array $deprecated Deprecated parameter, not used anymore.
	 * @param array $form_data Form data and settings.
	 */
	public function field_display( $field, $deprecated, $form_data ) {

		// Define data.
		$format  = ! empty( $field['format'] ) ? esc_attr( $field['format'] ) : 'first-last';
		$primary = ! empty( $field['properties']['inputs']['primary'] ) ? $field['properties']['inputs']['primary'] : '';
		$first   = ! empty( $field['properties']['inputs']['first'] ) ? $field['properties']['inputs']['first'] : '';
		$middle  = ! empty( $field['properties']['inputs']['middle'] ) ? $field['properties']['inputs']['middle'] : '';
		$last    = ! empty( $field['properties']['inputs']['last'] ) ? $field['properties']['inputs']['last'] : '';

		// Simple format.
		if ( 'simple' === $format ) {

			// Primary field (Simple).
			printf(
				'<input type="text" %s %s>',
				wpforms_html_attributes( $primary['id'], $primary['class'], $primary['data'], $primary['attr'] ),
				$primary['required']
			);

		// Expanded formats.
		} else {

			// Row wrapper.
			echo '<div class="wpforms-field-row wpforms-field-' . sanitize_html_class( $field['size'] ) . '">';

				// First name.
				echo '<div ' . wpforms_html_attributes( false, $first['block'] ) . '>';
					$this->field_display_sublabel( 'first', 'before', $field );
					printf(
						'<input type="text" %s %s>',
						wpforms_html_attributes( $first['id'], $first['class'], $first['data'], $first['attr'] ),
						$first['required']
					);
					$this->field_display_sublabel( 'first', 'after', $field );
					$this->field_display_error( 'first', $field );
				echo '</div>';

				// Middle name.
				if ( 'first-middle-last' === $format ) {
					echo '<div ' . wpforms_html_attributes( false, $middle['block'] ) . '>';
						$this->field_display_sublabel( 'middle', 'before', $field );
						printf(
							'<input type="text" %s %s>',
							wpforms_html_attributes( $middle['id'], $middle['class'], $middle['data'], $middle['attr'] ),
							$middle['required']
						);
						$this->field_display_sublabel( 'middle', 'after', $field );
						$this->field_display_error( 'middle', $field );
					echo '</div>';
				}

				// Last name.
				echo '<div ' . wpforms_html_attributes( false, $last['block'] ) . '>';
					$this->field_display_sublabel( 'last', 'before', $field );
					printf(
						'<input type="text" %s %s>',
						wpforms_html_attributes( $last['id'], $last['class'], $last['data'], $last['attr'] ),
						$last['required']
					);
					$this->field_display_sublabel( 'last', 'after', $field );
					$this->field_display_error( 'last', $field );
				echo '</div>';

			echo '</div>';

		}
	}

	/**
	 * Validates field on form submit.
	 *
	 * @since 1.0.0
	 *
	 * @param int   $field_id
	 * @param array $field_submit
	 * @param array $form_data
	 */
	public function validate( $field_id, $field_submit, $form_data ) {

		// Extended validation needed for the different name fields.
		if ( ! empty( $form_data['fields'][ $field_id ]['required'] ) ) {

			$form_id  = $form_data['id'];
			$format   = $form_data['fields'][ $field_id ]['format'];
			$required = wpforms_get_required_label();

			if ( 'simple' === $format && empty( $field_submit ) ) {
				wpforms()->process->errors[ $form_id ][ $field_id ] = $required;
			}

			if ( ( 'first-last' === $format || 'first-middle-last' === $format ) && empty( $field_submit['first'] ) ) {
				wpforms()->process->errors[ $form_id ][ $field_id ]['first'] = $required;
			}

			if ( ( 'first-last' === $format || 'first-middle-last' === $format ) && empty( $field_submit['last'] ) ) {
				wpforms()->process->errors[ $form_id ][ $field_id ]['last'] = $required;
			}
		}
	}

	/**
	 * Formats field.
	 *
	 * @since 1.0.0
	 *
	 * @param int   $field_id
	 * @param array $field_submit
	 * @param array $form_data
	 */
	public function format( $field_id, $field_submit, $form_data ) {

		// Define data.
		$name   = ! empty( $form_data['fields'][ $field_id ]['label'] ) ? $form_data['fields'][ $field_id ]['label'] : '';
		$first  = ! empty( $field_submit['first'] ) ? $field_submit['first'] : '';
		$middle = ! empty( $field_submit['middle'] ) ? $field_submit['middle'] : '';
		$last   = ! empty( $field_submit['last'] ) ? $field_submit['last'] : '';

		if ( is_array( $field_submit ) ) {
			$value = implode( ' ', array_filter( array( $first, $middle, $last ) ) );
		} else {
			$value = $field_submit;
		}

		// Set final field details.
		wpforms()->process->fields[ $field_id ] = array(
			'name'   => sanitize_text_field( $name ),
			'value'  => sanitize_text_field( $value ),
			'id'     => absint( $field_id ),
			'type'   => $this->type,
			'first'  => sanitize_text_field( $first ),
			'middle' => sanitize_text_field( $middle ),
			'last'   => sanitize_text_field( $last ),
		);
	}
}

new WPForms_Field_Name();
