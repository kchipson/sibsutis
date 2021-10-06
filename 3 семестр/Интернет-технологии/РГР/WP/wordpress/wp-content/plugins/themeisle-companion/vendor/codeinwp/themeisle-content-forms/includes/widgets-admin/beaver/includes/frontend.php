<?php
$module->render_form_header( $module->node );
$has_error        = $module->maybe_render_form_errors( $module->node );
$fields           = $settings->fields;
$label_visibility = property_exists( $settings, 'hide_label' ) ? $settings->hide_label : 'show';
foreach ( $fields as $key => $field ) {
	$field        = (array) $field;
	$field['_id'] = $key;
	$module->render_form_field( $field, $label_visibility );
	$module->maybe_render_newsletter_address( $field, $module->node );
}

$btn_label    = ! empty( $settings->submit_label ) ? $settings->submit_label : esc_html__( 'Submit', 'themeisle-companion' );
$submit_class = property_exists( $settings, 'submit_display' ) && $settings->submit_display === 'block' ? 'class="submit-field submit-form ' . esc_attr( $module->get_type() ) . '"' : 'class="submit-field"';
echo '<fieldset ' . $submit_class . '>';
echo '<button type="submit" name="submit" value="submit-' . esc_attr( $module->get_type() ) . '-' . esc_attr( $module->node ) . '">';
echo $btn_label;
echo '</button>';
echo  '</fieldset>';

$module->render_form_footer();
