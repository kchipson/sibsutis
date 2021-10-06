<?php
/**
 * Sanitize functions.
 *
 * @package Hestia
 */

/**
 * Sanitize alignment control.
 *
 * @since 1.1.34
 *
 * @param string $value Control output.
 *
 * @return string
 */
function hestia_sanitize_alignment_options( $value ) {
	$valid_values = array(
		'video',
		'parallax',
		'left',
		'center',
		'right',
		'true',
		'false',
		'slider',
		'extra',
	);

	if ( ! in_array( $value, $valid_values ) ) {
		wp_die( 'Invalid value, go back and try again.' );
	}

	return $value;
}

/**
 * Sanitize Footer Layout control.
 *
 * @since 1.1.59
 *
 * @param string $value Control output.
 *
 * @return string
 */
function hestia_sanitize_footer_layout_control( $value ) {
	$value        = sanitize_text_field( $value );
	$valid_values = array(
		'white_footer',
		'black_footer',
	);

	if ( ! in_array( $value, $valid_values ) ) {
		wp_die( 'Invalid value, go back and try again.' );
	}

	return $value;
}

/**
 * Sanitize Blog Layout control.
 *
 * @since 1.1.59
 *
 * @param string $value Control output.
 *
 * @return string
 */
function hestia_sanitize_blog_layout_control( $value ) {
	$value        = sanitize_text_field( $value );
	$valid_values = array(
		'blog_alternative_layout',
		'blog_alternative_layout2',
		'blog_normal_layout',
	);

	if ( ! in_array( $value, $valid_values ) ) {
		wp_die( 'Invalid value, go back and try again.' );
	}

	return $value;
}

/**
 * Sanitize arrays.
 *
 * @since 1.1.40
 *
 * @param mixed $value Control output.
 *
 * @return array
 */
function hestia_sanitize_array( $value ) {
	$output = $value;

	if ( ! is_array( $value ) ) {
		$output = explode( ',', $value );
	}

	if ( ! empty( $output ) ) {
		return array_map( 'sanitize_text_field', $output );
	}

	return array();
}

/**
 * Function to sanitize alpha color.
 *
 * @param string $value Hex or RGBA color.
 *
 * @return string
 */
function hestia_sanitize_colors( $value ) {
	// Is this an rgba color or a hex?
	$mode = ( false === strpos( $value, 'rgba' ) ) ? 'hex' : 'rgba';

	if ( 'rgba' === $mode ) {
		return hestia_sanitize_rgba( $value );
	} else {
		return sanitize_hex_color( $value );
	}
}

/**
 * Sanitize big title type
 */
function hestia_sanitize_big_title_type( $input ) {
	$options = array( 'image', 'parallax', 'video' );
	if ( in_array( $input, $options ) ) {
		return $input;
	}
	return 'image';
}

/**
 * Sanitize rgba color.
 *
 * @param string $value Color in rgba format.
 *
 * @return string
 */
function hestia_sanitize_rgba( $value ) {
	$red   = 'rgba(0,0,0,0)';
	$green = 'rgba(0,0,0,0)';
	$blue  = 'rgba(0,0,0,0)';
	$alpha = 'rgba(0,0,0,0)';   // If empty or an array return transparent
	if ( empty( $value ) || is_array( $value ) ) {
		return '';
	}

	// By now we know the string is formatted as an rgba color so we need to further sanitize it.
	$value = str_replace( ' ', '', $value );
	sscanf( $value, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );

	return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
}

/**
 * Sanitize repeater control.
 *
 * @param object $value Control output.
 *
 * @return object
 */
function hestia_repeater_sanitize( $value ) {
	$value_decoded = json_decode( $value, true );

	if ( ! empty( $value_decoded ) ) {
		foreach ( $value_decoded as $boxk => $box ) {
			foreach ( $box as $key => $value ) {

				$value_decoded[ $boxk ][ $key ] = wp_kses_post( force_balance_tags( $value ) );

			}
		}

		return json_encode( $value_decoded );
	}

	return $value;
}

/**
 * Allowed HTML tags for text controls
 *
 * @param string $value the string to be sanitized.
 *
 * @return string
 */
function hestia_sanitize_string( $value ) {

	$allowed_html = apply_filters(
		'hestia_sanitize_html_tags',
		array(
			'a'      => array(
				'href'  => array(),
				'title' => array(),
				'class' => array(),
			),
			'br'     => array(),
			'em'     => array(),
			'strong' => array(),
			'i'      => array(
				'class' => array(),
			),
			'b'      => array(),
			'p'      => array(),
		)
	);

	$value = force_balance_tags( $value );

	return wp_kses( $value, $allowed_html );
}

/**
 * Sanitize checkbox output.
 *
 * @param bool $value value to be sanitized.
 *
 * @return string
 * @since Hestia 1.0
 */
function hestia_sanitize_checkbox( $value ) {
	return isset( $value ) && true === (bool) $value;
}

/**
 * Sanitize multi select output.
 *
 * @param string $value value to be sanitized.
 *
 * @return array
 * @since Hestia 1.0
 */
function hestia_sanitize_multiselect( $value ) {
	if ( ! is_array( $value ) ) {
		$value = explode( ',', $value );
	}

	return ! empty( $value ) ? array_map( 'sanitize_text_field', $value ) : array();
}

/**
 * Check if a string is in json format
 *
 * @param  string $string Input.
 *
 * @since 1.1.38
 * @return bool
 */
function hestia_is_json( $string ) {
	return is_string( $string ) && is_array( json_decode( $string, true ) ) ? true : false;
}

/**
 * Sanitize values for range inputs.
 *
 * @param string $input Control input.
 *
 * @since 1.1.38
 * @return float
 */
function hestia_sanitize_range_value( $input ) {
	if ( ! hestia_is_json( $input ) ) {
		return floatval( $input );
	}
	$range_value            = json_decode( $input, true );
	$range_value['desktop'] = ! empty( $range_value['desktop'] ) || $range_value['desktop'] === '0' ? floatval( $range_value['desktop'] ) : '';
	$range_value['tablet']  = ! empty( $range_value['tablet'] ) || $range_value['tablet'] === '0' ? floatval( $range_value['tablet'] ) : '';
	$range_value['mobile']  = ! empty( $range_value['mobile'] ) || $range_value['mobile'] === '0' ? floatval( $range_value['mobile'] ) : '';

	return json_encode( $range_value );
}

/**
 * Dimension sanitization callback
 *
 * @param string $val Input value.
 */
function hestia_sanitize_dimension( $val ) {
	$decoded_array = json_decode( $val );
	if ( empty( $decoded_array ) ) {
		return '';
	}
	foreach ( $decoded_array as $array_item ) {
		$array_item_decoded = json_decode( $array_item );
		if ( empty( $array_item_decoded ) ) {
			return '';
		}
		foreach ( $array_item_decoded as $dimension ) {
			if ( ! empty( $dimension ) && ! is_numeric( $dimension ) ) {
				return '';
			}
		}
	}
	return $val;
}
