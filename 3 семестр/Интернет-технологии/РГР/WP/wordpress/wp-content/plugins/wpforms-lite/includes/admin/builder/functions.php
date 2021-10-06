<?php
/**
 * Builder related functions.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */

/**
 * Outputs fields to be used on panels (settings etc).
 *
 * @since 1.0.0
 *
 * @param string $option
 * @param string $panel
 * @param string $field
 * @param array $form_data
 * @param string $label
 * @param array $args
 * @param boolean $echo
 *
 * @return string
 */
function wpforms_panel_field( $option, $panel, $field, $form_data, $label, $args = array(), $echo = true ) {

	// Required params.
	if ( empty( $option ) || empty( $panel ) || empty( $field ) ) {
		return '';
	}

	// Setup basic vars.
	$panel       = esc_attr( $panel );
	$field       = esc_attr( $field );
	$panel_id    = sanitize_html_class( $panel );
	$parent      = ! empty( $args['parent'] ) ? esc_attr( $args['parent'] ) : '';
	$subsection  = ! empty( $args['subsection'] ) ? esc_attr( $args['subsection'] ) : '';
	$label       = ! empty( $label ) ? esc_html( $label ) : '';
	$class       = ! empty( $args['class'] ) ? esc_attr( $args['class'] ) : '';
	$input_class = ! empty( $args['input_class'] ) ? esc_attr( $args['input_class'] ) : '';
	$default     = isset( $args['default'] ) ? $args['default'] : '';
	$placeholder = ! empty( $args['placeholder'] ) ? esc_attr( $args['placeholder'] ) : '';
	$data_attr   = '';
	$output      = '';
	$input_id    = sprintf( 'wpforms-panel-field-%s-%s', sanitize_html_class( $panel_id ), sanitize_html_class( $field ) );

	if ( ! empty( $args['input_id'] ) ) {
		$input_id = esc_attr( $args['input_id'] );
	}

	// Check if we should store values in a parent array.
	if ( ! empty( $parent ) ) {
		if ( ! empty( $subsection ) ) {
			$field_name = sprintf( '%s[%s][%s][%s]', $parent, $panel, $subsection, $field );
			$value      = isset( $form_data[ $parent ][ $panel ][ $subsection ][ $field ] ) ? $form_data[ $parent ][ $panel ][ $subsection ][ $field ] : $default;
			$input_id   = sprintf( 'wpforms-panel-field-%s-%s-%s', sanitize_html_class( $panel_id ), sanitize_html_class( $subsection ), sanitize_html_class( $field ) );
			$panel_id   = sanitize_html_class( $panel . '-' . $subsection );
		} else {
			$field_name = sprintf( '%s[%s][%s]', $parent, $panel, $field );
			$value      = isset( $form_data[ $parent ][ $panel ][ $field ] ) ? $form_data[ $parent ][ $panel ][ $field ] : $default;
		}
	} else {
		$field_name = sprintf( '%s[%s]', $panel, $field );
		$value      = isset( $form_data[ $panel ][ $field ] ) ? $form_data[ $panel ][ $field ] : $default;
	}

	if ( isset( $args['field_name'] ) ) {
		$field_name = $args['field_name'];
	}

	if ( isset( $args['value'] ) ) {
		$value = $args['value'];
	}

	// Check for data attributes.
	if ( ! empty( $args['data'] ) ) {
		foreach ( $args['data'] as $key => $val ) {
			if ( is_array( $val ) ) {
				$val = wp_json_encode( $val );
			}
			$data_attr .= ' data-' . $key . '=\'' . $val . '\'';
		}
	}

	// Check for readonly inputs.
	if ( ! empty( $args['readonly' ] ) ) {
		$data_attr .= 'readonly';
	}

	// Determine what field type to output.
	switch ( $option ) {

		// Text input.
		case 'text':
			$output = sprintf(
				'<input type="%s" id="%s" name="%s" value="%s" placeholder="%s" class="%s" %s>',
				! empty( $args['type'] ) ? esc_attr( $args['type'] ) : 'text',
				$input_id,
				$field_name,
				esc_attr( $value ),
				$placeholder,
				$input_class,
				$data_attr
			);
			break;

		// Textarea.
		case 'textarea':
			$output = sprintf(
				'<textarea id="%s" name="%s" rows="%d" placeholder="%s" class="%s" %s>%s</textarea>',
				$input_id,
				$field_name,
				! empty( $args['rows'] ) ? (int) $args['rows'] : '3',
				$placeholder,
				$input_class,
				$data_attr,
				esc_textarea( $value )
			);
			break;

		// TinyMCE.
		case 'tinymce':
			$id                               = str_replace( '-', '_', $input_id );
			$args['tinymce']['textarea_name'] = $field_name;
			$args['tinymce']['teeny']         = true;
			$args['tinymce']                  = wp_parse_args( $args['tinymce'], array(
				'media_buttons' => false,
				'teeny'         => true,
			) );
			ob_start();
			wp_editor( $value, $id, $args['tinymce'] );
			$output = ob_get_clean();
			break;

		// Checkbox.
		case 'checkbox':
			$output  = sprintf(
				'<input type="checkbox" id="%s" name="%s" value="1" class="%s" %s %s>',
				$input_id,
				$field_name,
				$input_class,
				checked( '1', $value, false ),
				$data_attr
			);
			$output .= sprintf(
				'<label for="%s" class="inline">%s',
				$input_id,
				$label
			);
			if ( ! empty( $args['tooltip'] ) ) {
				$output .= sprintf( ' <i class="fa fa-question-circle wpforms-help-tooltip" title="%s"></i>', esc_attr( $args['tooltip'] ) );
			}
			$output .= '</label>';
			break;

		// Radio.
		case 'radio':
			$options       = $args['options'];
			$radio_counter = 1;
			$output        = '';

			foreach ( $options as $key => $item ) {
				if ( empty( $item['label'] ) ) {
					continue;
				}

				$item_value = ! empty( $item['value'] ) ? $item['value'] : $key;

				$output .= '<span class="row">';

				if ( ! empty( $item['pre_label'] ) ) {
					$output .= '<label>' . $item['pre_label'];
				}

				$output .= sprintf(
					'<input type="radio" id="%s-%d" name="%s" value="%s" class="%s" %s %s>',
					$input_id,
					$radio_counter,
					$field_name,
					$item_value,
					$input_class,
					checked( $item_value, $value, false ),
					$data_attr
				);

				if ( empty( $item['pre_label'] ) ) {
					$output .= sprintf(
						'<label for="%s-%d" class="inline">%s',
						$input_id,
						$radio_counter,
						$item['label']
					);
				} else {
					$output .= '<span class="wpforms-panel-field-radio-label">' . $item['label'] . '</span>';
				}

				if ( ! empty( $item['tooltip'] ) ) {
					$output .= sprintf( ' <i class="fa fa-question-circle wpforms-help-tooltip" title="%s"></i>', esc_attr( $item['tooltip'] ) );
				}
				$output .= '</label></span>';
				$radio_counter ++;
			}

			if ( ! empty( $output ) ) {
				$output = '<div class="wpforms-panel-field-radio-container">' . $output . '</div>';
			}
			break;

		// Select.
		case 'select':
			if ( empty( $args['options'] ) && empty( $args['field_map'] ) ) {
				return '';
			}

			if ( ! empty( $args['field_map'] ) ) {
				$options          = array();
				$available_fields = wpforms_get_form_fields( $form_data, $args['field_map'] );
				if ( ! empty( $available_fields ) ) {
					foreach ( $available_fields as $id => $available_field ) {
						$lbl            = ! empty( $available_field['label'] ) ? esc_attr( $available_field['label'] ) : esc_html__( 'Field #' ) . $id;
						$options[ $id ] = $lbl;
					}
				}
				$input_class .= ' wpforms-field-map-select';
				$data_attr   .= ' data-field-map-allowed="' . implode( ' ', $args['field_map'] ) . '"';
				if ( ! empty( $placeholder ) ) {
					$data_attr .= ' data-field-map-placeholder="' . esc_attr( $placeholder ) . '"';
				}
			} else {
				$options = $args['options'];
			}

			$output = sprintf(
				'<select id="%s" name="%s" class="%s" %s>',
				$input_id,
				$field_name,
				$input_class,
				$data_attr
			);

			if ( ! empty( $placeholder ) ) {
				$output .= '<option value="">' . $placeholder . '</option>';
			}

			foreach ( $options as $key => $item ) {
				$output .= sprintf( '<option value="%s" %s>%s</option>', esc_attr( $key ), selected( $key, $value, false ), $item );
			}

			$output .= '</select>';
			break;
	}

	// Put the pieces together.
	$field_open  = sprintf(
		'<div id="%s-wrap" class="wpforms-panel-field %s %s">',
		$input_id,
		$class,
		'wpforms-panel-field-' . sanitize_html_class( $option )
	);
	$field_open .= ! empty( $args['before'] ) ? $args['before'] : '';
	if ( 'checkbox' !== $option && ! empty( $label ) ) {
		$field_label = sprintf(
			'<label for="%s">%s',
			$input_id,
			$label
		);
		if ( ! empty( $args['tooltip'] ) ) {
			$field_label .= sprintf( ' <i class="fa fa-question-circle wpforms-help-tooltip" title="%s"></i>', esc_attr( $args['tooltip'] ) );
		}
		if ( ! empty( $args['after_tooltip'] ) ) {
			$field_label .= $args['after_tooltip'];
		}
		if ( ! empty( $args['smarttags'] ) ) {

			$type   = ! empty( $args['smarttags']['type'] ) ? esc_attr( $args['smarttags']['type'] ) : 'fields';
			$fields = ! empty( $args['smarttags']['fields'] ) ? esc_attr( $args['smarttags']['fields'] ) : '';

			$field_label .= '<a href="#" class="toggle-smart-tag-display" data-type="' . $type . '" data-fields="' . $fields . '"><i class="fa fa-tags"></i> <span>' . esc_html__( 'Show Smart Tags', 'wpforms-lite' ) . '</span></a>';
		}
		$field_label .= '</label>';
		if ( ! empty( $args['after_label'] ) ) {
			$field_label .= $args['after_label'];
		}
	} else {
		$field_label = '';
	}
	$field_close  = ! empty( $args['after'] ) ? $args['after'] : '';
	$field_close .= '</div>';
	$output       = $field_open . $field_label . $output . $field_close;

	// Wash our hands.
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}
}

/**
 * Get notification state, whether it's opened or closed.
 *
 * @since 1.4.1
 * @deprecated 1.4.8
 *
 * @param int $form_id
 * @param int $notification_id
 *
 * @return string
 */
function wpforms_builder_notification_get_state( $form_id, $notification_id ) {
	_deprecated_function( __FUNCTION__, '1.4.8 of WPForms plugin', 'wpforms_builder_settings_block_get_state()' );
	return wpforms_builder_settings_block_get_state( $form_id, $notification_id, 'notification' );
}

/**
 * Get settings block state, whether it's opened or closed.
 *
 * @since 1.4.8
 *
 * @param int $form_id
 * @param int $block_id
 * @param string $block_type
 *
 * @return string
 */
function wpforms_builder_settings_block_get_state( $form_id, $block_id, $block_type ) {

	$form_id    = absint( $form_id );
	$block_id   = absint( $block_id );
	$block_type = sanitize_key( $block_type );
	$state      = 'opened';

	$all_states = get_user_meta( get_current_user_id(), 'wpforms_builder_settings_collapsable_block_states', true );

	if ( empty( $all_states ) ) {
		return $state;
	}

	if (
		is_array( $all_states ) &&
		! empty( $all_states[ $form_id ][ $block_type ][ $block_id ] ) &&
		'closed' === $all_states[ $form_id ][ $block_type ][ $block_id ]
	) {
		$state = 'closed';
	}

	// Backward compatibility for notifications.
	if ( 'notification' === $block_type && 'closed' !== $state ) {
		$notification_states = get_user_meta( get_current_user_id(), 'wpforms_builder_notification_states', true );
	}

	if (
		! empty( $notification_states[ $form_id ][ $block_id ] ) &&
		'closed' === $notification_states[ $form_id ][ $block_id ]
	) {
		$state = 'closed';
	}

	if ( 'notification' === $block_type ) {
		// Backward compatibility for notifications.
		return apply_filters( 'wpforms_builder_notification_get_state', $state, $form_id, $block_id );
	}

	return apply_filters( 'wpforms_builder_settings_block_get_state', $state, $form_id, $block_id, $block_type );
}
