<?php
/**
 * Settings API.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.3.7
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2017, WPForms LLC
 */

/**
 * Settings output wrapper.
 *
 * @since 1.3.9
 *
 * @param array $args
 *
 * @return string
 */
function wpforms_settings_output_field( $args ) {

	// Define default callback for this field type.
	$callback = ! empty( $args['type'] ) && function_exists( 'wpforms_settings_' . $args['type'] . '_callback' ) ? 'wpforms_settings_' . $args['type'] . '_callback' : 'wpforms_settings_missing_callback';

	// Allow custom callback to be provided via arg.
	if ( ! empty( $args['callback'] ) && function_exists( $args['callback'] ) ) {
		$callback = $args['callback'];
	}

	// Store returned markup from callback.
	$field = call_user_func( $callback, $args );

	// Allow arg to bypass standard field wrap for custom display.
	if ( ! empty( $args['wrap'] ) ) {
		return $field;
	}

	// Custom row classes.
	$class = ! empty( $args['class'] ) ? wpforms_sanitize_classes( (array) $args['class'], true ) : '';

	// Build standard field markup and return.
	$output = '<div class="wpforms-setting-row wpforms-setting-row-' . sanitize_html_class( $args['type'] ) . ' wpforms-clear ' . $class . '" id="wpforms-setting-row-' . wpforms_sanitize_key( $args['id'] ) . '">';

	if ( ! empty( $args['name'] ) && empty( $args['no_label'] ) ) {
		$output .= '<span class="wpforms-setting-label">';
		$output .= '<label for="wpforms-setting-' . wpforms_sanitize_key( $args['id'] ) . '">' . esc_html( $args['name'] ) . '</label>';
		$output .= '</span>';
	}

	$output .= '<span class="wpforms-setting-field">';
	$output .= $field;
	if ( ! empty( $args['desc_after'] ) ) {
		$output .= '<div class="wpforms-clear">' . $args['desc_after'] . '</div>';
	}
	$output .= '</span>';

	$output .= '</div>';

	return $output;
}

/**
 * Missing Callback.
 *
 * If a function is missing for settings callbacks alert the user.
 *
 * @since 1.3.9
 *
 * @param array $args Arguments passed by the setting.
 *
 * @return string
 */
function wpforms_settings_missing_callback( $args ) {

	return sprintf(
		/* translators: %s - ID of a setting. */
		esc_html__( 'The callback function used for the %s setting is missing.', 'wpforms-lite' ),
		'<strong>' . wpforms_sanitize_key( $args['id'] ) . '</strong>'
	);
}

/**
 * Settings content field callback.
 *
 * @since 1.3.9
 *
 * @param array $args
 *
 * @return string
 */
function wpforms_settings_content_callback( $args ) {
	return ! empty( $args['content'] ) ? $args['content'] : '';
}

/**
 * Settings license field callback.
 *
 * @since 1.3.9
 *
 * @param array $args
 *
 * @return string
 */
function wpforms_settings_license_callback( $args ) {

	// Lite users don't need to worry about license keys.
	if ( ! wpforms()->pro || ! class_exists( 'WPForms_License', false ) ) {

		$output  = '<p>' . esc_html__( 'You\'re using WPForms Lite - no license needed. Enjoy!', 'wpforms-lite' ) . ' 🙂</p>';
		$output .=
			'<p>' .
			sprintf(
				wp_kses(
					/* translators: %s - WPForms.com upgrade URL. */
					__( 'To unlock more features consider <strong><a href="%s" target="_blank" rel="noopener noreferrer" class="wpforms-upgrade-modal">upgrading to PRO</a></strong>.', 'wpforms-lite' ),
					array(
						'a'      => array(
							'href'   => array(),
							'class'  => array(),
							'target' => array(),
							'rel'    => array(),
						),
						'strong' => array(),
					)
				),
				esc_url( wpforms_admin_upgrade_link( 'settings-license' ) )
			) .
			'</p>';
		$output .=
			'<p class="discount-note">' .
				wp_kses(
					__( 'As a valued WPForms Lite user you receive <strong>50% off</strong>, automatically applied at checkout!', 'wpforms-lite' ),
					array(
						'strong' => array(),
						'br'     => array(),
					)
				) .
			'</p>';

		$output .= '<hr><p>' . esc_html__( 'Already purchased?  Simply enter your license key below to connect with WPForms PRO!', 'wpforms-lite' ) . '</p>';
		$output .= '<p>';
		$output .= '<input type="password" id="wpforms-settings-upgrade-license-key" placeholder="' . esc_attr__( 'Paste license key here', 'wpforms-lite' ) . '" value="" />';
		$output .= '<button type="button" class="wpforms-btn wpforms-btn-md wpforms-btn-orange" id="wpforms-settings-connect-btn">' . esc_attr__( 'Connect', 'wpforms-lite' ) . '</button>';
		$output .= '</p>';

		return $output;
	}

	$key  = wpforms_setting( 'key', '', 'wpforms_license' );
	$type = wpforms_setting( 'type', '', 'wpforms_license' );

	$output  = '<input type="password" id="wpforms-setting-license-key" value="' . esc_attr( $key ) . '" />';
	$output .= '<button id="wpforms-setting-license-key-verify" class="wpforms-btn wpforms-btn-md wpforms-btn-orange">' . esc_html__( 'Verify Key', 'wpforms-lite' ) . '</button>';

	// Offer option to deactivate the key.
	$class   = empty( $key ) ? 'wpforms-hide' : '';
	$output .= '<button id="wpforms-setting-license-key-deactivate" class="wpforms-btn wpforms-btn-md wpforms-btn-light-grey ' . $class . '">' . esc_html__( 'Deactivate Key', 'wpforms-lite' ) . '</button>';

	// If we have previously looked up the license type, display it.
	$class   = empty( $type ) ? 'wpforms-hide' : '';
	$output .= '<p class="type ' . $class . '">' .
				sprintf(
					/* translators: $s - license type. */
					esc_html__( 'Your license key type is %s.', 'wpforms-lite' ),
					'<strong>' . esc_html( $type ) . '</strong>'
				) .
				'</p>';
	$output .= '<p class="desc ' . $class . '">' .
				wp_kses(
					__( 'If your license has been upgraded or is incorrect, <a href="#" id="wpforms-setting-license-key-refresh">click here to force a refresh</a>.', 'wpforms-lite' ),
					array(
						'a' => array(
							'href' => array(),
							'id'   => array(),
						),
					)
				) .
				'</p>';

	return $output;
}

/**
 * Settings text input field callback.
 *
 * @since 1.3.9
 *
 * @param array $args
 *
 * @return string
 */
function wpforms_settings_text_callback( $args ) {

	$default = isset( $args['default'] ) ? esc_html( $args['default'] ) : '';
	$value   = wpforms_setting( $args['id'], $default );
	$id      = wpforms_sanitize_key( $args['id'] );

	$output = '<input type="text" id="wpforms-setting-' . $id . '" name="' . $id . '" value="' . esc_attr( $value ) . '">';

	if ( ! empty( $args['desc'] ) ) {
		$output .= '<p class="desc">' . wp_kses_post( $args['desc'] ) . '</p>';
	}

	return $output;
}

/**
 * Settings number input field callback.
 *
 * @since 1.5.3
 *
 * @param array $args Setting field arguments.
 *
 * @return string
 */
function wpforms_settings_number_callback( $args ) {

	$default = isset( $args['default'] ) ? esc_html( $args['default'] ) : '';
	$id      = 'wpforms-setting-' . wpforms_sanitize_key( $args['id'] );
	$attr    =  array(
		'value' => wpforms_setting( $args['id'], $default ),
		'name'  => wpforms_sanitize_key( $args['id'] ),
	);
	$data    = ! empty( $args['data'] ) ? $args['data'] : array();

	if ( ! empty( $args['attr'] ) ) {
		$attr = array_merge( $attr, $args['attr'] );
	}

	$output = sprintf(
		'<input type="number" %s>',
		wpforms_html_attributes( $id, array(), $data, $attr )
	);

	if ( ! empty( $args['desc'] ) ) {
		$output .= '<p class="desc">' . wp_kses_post( $args['desc'] ) . '</p>';
	}

	return $output;
}

/**
 * Settings select field callback.
 *
 * @since 1.3.9
 *
 * @param array $args
 *
 * @return string
 */
function wpforms_settings_select_callback( $args ) {

	$default = isset( $args['default'] ) ? esc_html( $args['default'] ) : '';
	$value   = wpforms_setting( $args['id'], $default );
	$id      = wpforms_sanitize_key( $args['id'] );
	$class   = ! empty( $args['choicesjs'] ) ? 'choicesjs-select' : '';
	$choices = ! empty( $args['choicesjs'] ) ? true : false;
	$data    = '';

	if ( $choices && ! empty( $args['search'] ) ) {
		$data = ' data-search="true"';
	}

	$output  = $choices ? '<span class="choicesjs-select-wrap">' : '';
	$output .= '<select id="wpforms-setting-' . $id . '" name="' . $id . '" class="' . $class . '"' . $data . '>';

	foreach ( $args['options'] as $option => $name ) {
		$selected = selected( $value, $option, false );
		$output  .= '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( $name ) . '</option>';
	}

	$output .= '</select>';
	$output .= $choices ? '</span>' : '';

	if ( ! empty( $args['desc'] ) ) {
		$output .= '<p class="desc">' . wp_kses_post( $args['desc'] ) . '</p>';
	}

	return $output;
}

/**
 * Settings checkbox field callback.
 *
 * @since 1.3.9
 *
 * @param array $args
 *
 * @return string
 */
function wpforms_settings_checkbox_callback( $args ) {

	$value   = wpforms_setting( $args['id'] );
	$id      = wpforms_sanitize_key( $args['id'] );
	$checked = ! empty( $value ) ? checked( 1, $value, false ) : '';

	$output = '<input type="checkbox" id="wpforms-setting-' . $id . '" name="' . $id . '" ' . $checked . '>';

	if ( ! empty( $args['desc'] ) ) {
		$output .= '<p class="desc">' . wp_kses_post( $args['desc'] ) . '</p>';
	}

	return $output;
}

/**
 * Settings radio field callback.
 *
 * @since 1.3.9
 *
 * @param array $args
 *
 * @return string
 */
function wpforms_settings_radio_callback( $args ) {

	$default = isset( $args['default'] ) ? esc_html( $args['default'] ) : '';
	$value   = wpforms_setting( $args['id'], $default );
	$id      = wpforms_sanitize_key( $args['id'] );
	$output  = '';
	$x       = 1;

	foreach ( $args['options'] as $option => $name ) {

		$checked = checked( $value, $option, false );
		$output .= '<label for="wpforms-setting-' . $id . '[' . $x . ']" class="option-' . sanitize_html_class( $option ) . '">';
		$output .= '<input type="radio" id="wpforms-setting-' . $id . '[' . $x . ']" name="' . $id . '" value="' . esc_attr( $option ) . '" ' . $checked . '>';
		$output .= esc_html( $name );
		$output .= '</label>';
		$x ++;
	}

	if ( ! empty( $args['desc'] ) ) {
		$output .= '<p class="desc">' . wp_kses_post( $args['desc'] ) . '</p>';
	}

	return $output;
}

/**
 * Settings image upload field callback.
 *
 * @since 1.3.9
 *
 * @param array $args
 *
 * @return string
 */
function wpforms_settings_image_callback( $args ) {

	$default = isset( $args['default'] ) ? esc_html( $args['default'] ) : '';
	$value   = wpforms_setting( $args['id'], $default );
	$id      = wpforms_sanitize_key( $args['id'] );
	$output  = '';

	if ( ! empty( $value ) ) {
		$output .= '<img src="' . esc_url_raw( $value ) . '">';
	}

	$output .= '<input type="text" id="wpforms-setting-' . $id . '" name="' . $id . '" value="' . esc_url_raw( $value ) . '">';
	$output .= '<button class="wpforms-btn wpforms-btn-md wpforms-btn-light-grey">' . esc_html__( 'Upload Image', 'wpforms-lite' ) . '</button>';

	if ( ! empty( $args['desc'] ) ) {
		$output .= '<p class="desc">' . wp_kses_post( $args['desc'] ) . '</p>';
	}

	return $output;
}

/**
 * Settings color picker field callback.
 *
 * @since 1.3.9
 *
 * @param array $args
 *
 * @return string
 */
function wpforms_settings_color_callback( $args ) {

	$default = isset( $args['default'] ) ? esc_html( $args['default'] ) : '';
	$value   = wpforms_setting( $args['id'], $default );
	$id      = wpforms_sanitize_key( $args['id'] );

	$output = '<input type="text" id="wpforms-setting-' . $id . '" class="wpforms-color-picker" name="' . $id . '" value="' . esc_attr( $value ) . '">';

	if ( ! empty( $args['desc'] ) ) {
		$output .= '<p class="desc">' . wp_kses_post( $args['desc'] ) . '</p>';
	}

	return $output;
}

/**
 * Settings providers field callback - this is for the Integrations tab.
 *
 * @since 1.3.9
 *
 * @param array $args
 *
 * @return string
 */
function wpforms_settings_providers_callback( $args ) {

	$active    = wpforms_get_providers_available();
	$providers = wpforms_get_providers_options();

	$output = '<div id="wpforms-settings-providers">';

	ob_start();
	do_action( 'wpforms_settings_providers', $active, $providers );
	$output .= ob_get_clean();

	$output .= '</div>';

	return $output;
}
