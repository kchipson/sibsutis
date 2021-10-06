<?php

/**
 * Number text field.
 *
 * @since 1.0.0
 */
class WPForms_Field_Number extends WPForms_Field {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		// Define field type information.
		$this->name  = esc_html__( 'Numbers', 'wpforms-lite' );
		$this->type  = 'number';
		$this->icon  = 'fa-hashtag';
		$this->order = 130;
	}

	/**
	 * Field options panel inside the builder.
	 *
	 * @since 1.0.0
	 *
	 * @param array $field Field data.
	 */
	public function field_options( $field ) {
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

		// Placeholder.
		$this->field_option( 'placeholder', $field );

		// Hide label.
		$this->field_option( 'label_hide', $field );

		// Default value.
		$this->field_option( 'default_value', $field );

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
	 * @param array $field Field data.
	 */
	public function field_preview( $field ) {

		// Define data.
		$placeholder = ! empty( $field['placeholder'] ) ? $field['placeholder'] : '';

		// Label.
		$this->field_preview_option( 'label', $field );

		// Primary input.
		echo '<input type="text" placeholder="' . esc_attr( $placeholder ) . '" class="primary-input" disabled>';

		// Description.
		$this->field_preview_option( 'description', $field );
	}

	/**
	 * Field display on the form front-end.
	 *
	 * @since 1.0.0
	 *
	 * @param array $field      Field data.
	 * @param array $deprecated Deprecated, not used.
	 * @param array $form_data  Form data.
	 */
	public function field_display( $field, $deprecated, $form_data ) {

		// Define data.
		$primary = $field['properties']['inputs']['primary'];

		// Primary field.
		printf(
			'<input type="number" pattern="[0-9]*" %s %s>',
			wpforms_html_attributes( $primary['id'], $primary['class'], $primary['data'], $primary['attr'] ),
			$primary['required']
		);
	}

	/**
	 * Validates field on form submit.
	 *
	 * @since 1.0.0
	 *
	 * @param int    $field_id     Field id.
	 * @param string $field_submit Submitted value.
	 * @param array  $form_data    Form data.
	 */
	public function validate( $field_id, $field_submit, $form_data ) {

		$form_id = $form_data['id'];

		$value = $this->sanitize_value( $field_submit );

		// If field is marked as required, check for entry data.
		if (
			! empty( $form_data['fields'][ $field_id ]['required'] ) &&
			empty( $value ) &&
			'0' != $value
		) {
			wpforms()->process->errors[ $form_id ][ $field_id ] = wpforms_get_required_label();
		}

		// Check if value is numeric.
		if ( ! empty( $value ) && ! is_numeric( $value ) ) {
			wpforms()->process->errors[ $form_id ][ $field_id ] = apply_filters( 'wpforms_valid_number_label', esc_html__( 'Please enter a valid number.', 'wpforms-lite' ) );
		}
	}

	/**
	 * Formats and sanitizes field.
	 *
	 * @since 1.3.5
	 *
	 * @param int    $field_id     Field id.
	 * @param string $field_submit Submitted value.
	 * @param array  $form_data    Form data.
	 */
	public function format( $field_id, $field_submit, $form_data ) {

		// Define data.
		$name = ! empty( $form_data['fields'][ $field_id ]['label'] ) ? $form_data['fields'][ $field_id ]['label'] : '';

		// Set final field details.
		wpforms()->process->fields[ $field_id ] = array(
			'name'  => sanitize_text_field( $name ),
			'value' => $this->sanitize_value( $field_submit ),
			'id'    => absint( $field_id ),
			'type'  => $this->type,
		);
	}

	/**
	 * Sanitize the value.
	 *
	 * @since 1.5.7
	 *
	 * @param string $value The number field submitted value.
	 *
	 * @return float|int|string
	 */
	private function sanitize_value( $value ) {

		// Some browsers allow other non-digit/decimal characters to be submitted
		// with the num input, which then trips the is_numeric validation below.
		// To get around this we remove all chars that are not expected.
		$signed_value = preg_replace( '/[^-0-9.]/', '', $value );
		$abs_value    = abs( $signed_value );
		$value        = strpos( $signed_value, '-' ) === 0 ? '-' . $abs_value : $abs_value;

		return $value;
	}
}

new WPForms_Field_Number();
