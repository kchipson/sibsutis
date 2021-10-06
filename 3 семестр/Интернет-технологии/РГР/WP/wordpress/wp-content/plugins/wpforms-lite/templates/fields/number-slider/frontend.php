<input
	type="range"
	<?php echo $html_atts; ?>
	<?php echo $required; ?>
	value="<?php echo esc_attr( $default_value ); ?>"
	min="<?php echo esc_attr( $min ); ?>"
	max="<?php echo esc_attr( $max ); ?>"
	step="<?php echo esc_attr( $step ); ?>">

<div class="wpforms-field-number-slider-hint"
	data-hint="<?php echo esc_attr( wp_kses_post( $value_display ) ); ?>">
	<?php echo wp_kses_post( $value_hint ); ?>
</div>
