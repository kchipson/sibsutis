<?php
/**
 * Beaver builder number custom field
 *
 * @package themeisle-companion
 */

/**
 * Render the Number Field to the browser
 */
function obfx_number_field( $name, $value, $field ) {
	$min = ! empty( $field['min'] ) ? 'min="' . esc_attr( $field['min'] ) . '"' : '';
	$max = ! empty( $field['max'] ) ? 'max="' . esc_attr( $field['max'] ) . '"' : ''; ?>
	<input type="number" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" class="obfx-number-field" <?php echo $min; ?> <?php echo $max; ?> />
	<?php
}

add_action( 'fl_builder_control_obfx_number', 'obfx_number_field', 1, 3 );

/**
 * Enqueue number field stylesheet
 *
 * @return void
 */
function obfx_enqueue_field() {
	if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
		wp_enqueue_script( 'obfx-number-js', BEAVER_WIDGETS_URL . 'custom-fields/number-field/number.js', array(), '1.0.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'obfx_enqueue_field' );
