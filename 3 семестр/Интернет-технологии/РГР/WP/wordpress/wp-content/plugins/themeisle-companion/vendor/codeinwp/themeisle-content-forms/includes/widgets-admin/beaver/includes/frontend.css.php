<?php
$module_type = $module->get_type();

$fieldset_selector = '.fl-node-' . $id . ' .content-form-' . $module_type . ' fieldset';
echo $fieldset_selector . '{';
	echo $module->check_numeric_property( $settings, 'column_gap' ) ? 'padding: 0 ' . $settings->column_gap . 'px 0 ' . $settings->column_gap . 'px;' : '';
	echo $module->check_numeric_property( $settings, 'row_gap' ) ? 'margin-bottom:' . $settings->row_gap . 'px;' : '';
echo '}';

$fieldset_label_selector = '.fl-node-' . $id . ' .content-form-' . $module_type . ' fieldset label';
echo $fieldset_label_selector . '{';
	echo $module->check_color_property( $settings, 'label_color' ) ? 'color: #' . $settings->label_color : '';
echo '}';

$required_mark_selector = '.fl-node-' . $id . ' .content-form-' . $module_type . ' fieldset label .required-mark';
echo $required_mark_selector . '{';
	echo $module->check_color_property( $settings, 'mark_required_color' ) ? 'color: #' . $settings->mark_required_color . ';' : '';
echo '}';

if ( property_exists( $settings, 'label_typography' ) ) {
	FLBuilderCSS::typography_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'label_typography',
			'selector'     => $fieldset_label_selector,
		)
	);
}

$input_field_selector    = '.fl-node-' . $id . ' .content-form-' . $module_type . ' fieldset input';
$textarea_field_selector = '.fl-node-' . $id . ' .content-form-' . $module_type . ' fieldset textarea';
$select_field_selector   = '.fl-node-' . $id . ' .content-form-' . $module_type . ' fieldset select';

if ( property_exists( $settings, 'field_typography' ) ) {
	FLBuilderCSS::typography_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'field_typography',
			'selector'     => $input_field_selector . ',' . $textarea_field_selector . ',' . $select_field_selector,
		)
	);
}

echo $input_field_selector . ',' . $input_field_selector . '::placeholder,' . $textarea_field_selector . ',' . $textarea_field_selector . '::placeholder,' . $select_field_selector . ',' . $select_field_selector . '::placeholder{';
	echo $module->check_color_property( $settings, 'field_text_color' ) ? 'color: #' . $settings->field_text_color . ';' : '';
echo '}';

echo $input_field_selector . ',' . $textarea_field_selector . ',' . $select_field_selector . '{';
	echo $module->check_color_property( $settings, 'field_background_color' ) ? 'background-color: #' . $settings->field_background_color . ';' : '';
echo '}';

if ( property_exists( $settings, 'field_border' ) ) {
	FLBuilderCSS::border_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'field_border',
			'selector'     => $input_field_selector . ',' . $textarea_field_selector . ',' . $select_field_selector,
		)
	);
}

$fieldset_button_selector = '.fl-node-' . $id . ' .content-form-' . $module_type . ' fieldset.submit-field';
$button_selector          = '.fl-node-' . $id . ' .content-form-' . $module_type . ' fieldset button[name="submit"]';
$button_hover_selector    = '.fl-node-' . $id . ' .content-form-' . $module_type . ' fieldset button[name="submit"]:hover';

echo $button_selector . '{';
	echo $module->check_numeric_property( $settings, 'button_width' ) ? 'width: ' . $settings->button_width . $settings->button_width_unit . ';' : '';
	echo $module->check_numeric_property( $settings, 'button_height' ) ? 'height: ' . $settings->button_height . $settings->button_height_unit . ';' : '';
echo '}';

echo $fieldset_button_selector . '{';
	echo $module->check_not_empty_property( $settings, 'submit_position' ) ? 'text-align: ' . $settings->submit_position . ';' : '';
echo '}';

echo $button_selector . '{';
	echo $module->check_color_property( $settings, 'button_background_color' ) ? 'background-color: #' . $settings->button_background_color . ';' : '';
	echo $module->check_color_property( $settings, 'button_text_color' ) ? 'color: #' . $settings->button_text_color . ';' : '';
echo '}';

echo $button_hover_selector . '{';
	echo $module->check_color_property( $settings, 'button_background_color_hover' ) ? 'background-color: #' . $settings->button_background_color_hover . ';' : '';
	echo $module->check_color_property( $settings, 'button_text_color_hover' ) ? 'color: #' . $settings->button_text_color_hover . ';' : '';
echo '}';

if ( property_exists( $settings, 'button_typography' ) ) {
	FLBuilderCSS::typography_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'button_typography',
			'selector'     => $button_selector,
		)
	);
}

if ( property_exists( $settings, 'button_typography_hover' ) ) {
	FLBuilderCSS::typography_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'button_typography_hover',
			'selector'     => $button_hover_selector,
		)
	);
}

if ( property_exists( $settings, 'button_border' ) ) {
	FLBuilderCSS::border_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'button_border',
			'selector'     => $button_selector,
		)
	);
}

if ( property_exists( $settings, 'button_border_hover' ) ) {
	FLBuilderCSS::border_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'button_border_hover',
			'selector'     => $button_hover_selector,
		)
	);
}

$notification_selector         = '.fl-node-' . $id . ' .ti-cf-module .content-form-notice';
$notification_success_selector = '.fl-node-' . $id . ' .ti-cf-module .content-form-success';
$notification_error_selector   = '.fl-node-' . $id . ' .ti-cf-module .content-form-error';
echo $notification_selector . '{';
	echo $module->check_numeric_property( $settings, 'notification_margin_top' ) ? 'margin-top: ' . $settings->notification_margin_top . 'px;' : '';
	echo $module->check_numeric_property( $settings, 'notification_margin_bottom' ) ? 'margin-bottom: ' . $settings->notification_margin_bottom . 'px;' : '';
	echo $module->check_numeric_property( $settings, 'notification_margin_left' ) ? 'margin-left: ' . $settings->notification_margin_left . 'px;' : '';
	echo $module->check_numeric_property( $settings, 'notification_margin_right' ) ? 'margin-right: ' . $settings->notification_margin_right . 'px;' : '';
	echo $module->check_numeric_property( $settings, 'notification_text_padding_top' ) ? 'padding-top: ' . $settings->notification_text_padding_top . 'px;' : '';
	echo $module->check_numeric_property( $settings, 'notification_text_padding_bottom' ) ? 'padding-bottom: ' . $settings->notification_text_padding_bottom . 'px;' : '';
	echo $module->check_numeric_property( $settings, 'notification_text_padding_left' ) ? 'padding-left: ' . $settings->notification_text_padding_left . 'px;' : '';
	echo $module->check_numeric_property( $settings, 'notification_text_padding_right' ) ? 'padding-right: ' . $settings->notification_text_padding_right . 'px;' : '';
	echo $module->check_numeric_property( $settings, 'notification_width' ) ? 'width: ' . $settings->notification_width . '%;' : '';
if ( property_exists( $settings, 'notification_box_shadow' ) ) {
	echo 'box-shadow:' . FLBuilderColor::shadow( $settings->notification_box_shadow ) . ';';
}
echo '}';

echo $notification_success_selector . '{';
	echo $module->check_color_property( $settings, 'notification_success_background_color' ) ? 'background-color: #' . $settings->notification_success_background_color . ';' : '';
	echo $module->check_color_property( $settings, 'notification_success_text_color' ) ? 'color: #' . $settings->notification_success_text_color . ';' : '';
echo '}';

echo $notification_error_selector . '{';
	echo $module->check_color_property( $settings, 'notification_error_background_color' ) ? 'background-color: #' . $settings->notification_error_background_color . ';' : '';
	echo $module->check_color_property( $settings, 'notification_error_text_color' ) ? 'color: #' . $settings->notification_error_text_color . ';' : '';
echo '}';

if ( property_exists( $settings, 'notification_error_border' ) ) {
	FLBuilderCSS::border_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'notification_error_border',
			'selector'     => $notification_error_selector,
		)
	);
}

if ( property_exists( $settings, 'notification_success_border' ) ) {
	FLBuilderCSS::border_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'notification_success_border',
			'selector'     => $notification_success_selector,
		)
	);
}

if ( property_exists( $settings, 'notification_alignment' ) ) {
	$style = 'margin-left:0; margin-right:auto;';
	if ( $settings->notification_alignment === 'center' ) {
		$style = 'margin-left:auto; margin-right:auto;';
	}
	if ( $settings->notification_alignment === 'right' ) {
		$style = 'margin-left:auto; margin-right:0;';
	}
	echo $notification_selector . '{';
	echo $style;
	echo '}';
}


if ( property_exists( $settings, 'notification_typography' ) ) {
	FLBuilderCSS::typography_field_rule(
		array(
			'settings'     => $settings,
			'setting_name' => 'notification_typography',
			'selector'     => $notification_selector,
		)
	);
}

echo '@media (max-width: 1024px) {';
echo $fieldset_selector . '{';
	echo $module->check_numeric_property( $settings, 'column_gap_medium' ) ? 'padding: 0 ' . $settings->column_gap_medium . 'px 0 ' . $settings->column_gap_medium . 'px;' : '';
	echo $module->check_numeric_property( $settings, 'row_gap_medium' ) ? 'margin-bottom:' . $settings->row_gap_medium . 'px;' : '';
echo '}';

echo $button_selector . '{';
	echo $module->check_numeric_property( $settings, 'button_width_medium' ) ? 'width: ' . $settings->button_width_medium . $settings->button_width_medium_unit . ';' : '';
	echo $module->check_numeric_property( $settings, 'button_height_medium' ) ? 'height: ' . $settings->button_height_medium . $settings->button_height_medium_unit . ';' : '';
echo '}';
echo '}';

echo '@media (max-width: 768px) {';
echo $fieldset_selector . '{';
	echo $module->check_numeric_property( $settings, 'column_gap_responsive' ) ? 'padding: 0 ' . $settings->column_gap_responsive . 'px 0 ' . $settings->column_gap_responsive . 'px;' : '';
	echo $module->check_numeric_property( $settings, 'row_gap_responsive' ) ? 'margin-bottom:' . $settings->row_gap_responsive . 'px;' : '';
echo '}';
echo $button_selector . '{';
	echo $module->check_numeric_property( $settings, 'button_width_responsive' ) ? 'width: ' . $settings->button_width_responsive . $settings->button_width_responsive_unit . ';' : '';
	echo $module->check_numeric_property( $settings, 'button_height_responsive' ) ? 'height: ' . $settings->button_height_responsive . $settings->button_height_responsive_unit . ';' : '';
echo '}';
echo '}';
