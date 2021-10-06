<?php
/**
 * Beaver builder toggle custom field
 *
 * @package themeisle-companion
 */

/**
 * Render the Toggle Field to the browser
 */
function obfx_toggle_field( $name, $value, $field ) {
	?>
	<p class="btn-switch">
		<input type="radio" 
		<?php
		if ( $value === 'yes' ) {
			echo 'checked';}
		?>
 value="yes" id="<?php echo esc_attr( $name ); ?>_yes" name="<?php echo esc_attr( $name ); ?>" class="btn-switch__radio btn-switch__radio_yes" />
		<input type="radio" 
		<?php
		if ( $value !== 'yes' ) {
			echo 'checked';}
		?>
 value="no" id="<?php echo esc_attr( $name ); ?>_no" name="<?php echo esc_attr( $name ); ?>" class="btn-switch__radio btn-switch__radio_no" />
		<label for="<?php echo esc_attr( $name ); ?>_yes" class="btn-switch__label btn-switch__label_yes"><span class="btn-switch__txt"><?php echo esc_html__( 'Yes', 'themeisle-companion' ); ?></span></label>
		<label for="<?php echo esc_attr( $name ); ?>_no" class="btn-switch__label btn-switch__label_no"><span class="btn-switch__txt"><?php echo esc_html__( 'No', 'themeisle-companion' ); ?></span></label>
	</p>
	<?php
}
add_action( 'fl_builder_control_obfx_toggle', 'obfx_toggle_field', 1, 3 );

/**
 * Enqueue toggle field stylesheet
 *
 * @return void
 */
function obfx_enqueue_toggle_field() {
	if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
		wp_enqueue_style( 'obfx-toggle-css', BEAVER_WIDGETS_URL . 'custom-fields/toggle-field/toggle.css', array(), '1.0.0', 'all' );
		wp_enqueue_script( 'obfx-toggle-js', BEAVER_WIDGETS_URL . 'custom-fields/toggle-field/toggle.js', array(), '1.0.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'obfx_enqueue_toggle_field' );
