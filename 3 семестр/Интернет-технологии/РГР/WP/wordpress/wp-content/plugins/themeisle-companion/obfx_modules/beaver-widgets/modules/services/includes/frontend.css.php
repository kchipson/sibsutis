<?php
$columns = $settings->column_number;
$column_width = 100 / (int) $columns;

echo '.fl-node-' . $id . ' .obfx-service-wrapper{';
	echo 'display:inline-block;';
if ( ! empty( $column_width ) ) {
	echo 'width:' . $column_width . '%;';
}
	echo 'padding: 0 10px;';
echo '}';

$bg_color = $settings->background_color;
echo '.fl-node-' . $id . ' .obfx-service{';
if ( ! empty( $bg_color ) ) {
	echo 'background:#' . $bg_color . ';';
}
echo '}';


$icon_size = $settings->icon_size;
$padding_top = $settings->icon_top;
$padding_bottom = $settings->icon_bottom;
$padding_left = $settings->icon_left;
$padding_right = $settings->icon_right;
$icon_position = $settings->icon_position;

echo '.fl-node-' . $id . ' .obfx-service-icon{';
if ( ! empty( $icon_size ) ) {
	echo 'font-size:' . $icon_size . 'px;';
}
if ( ! empty( $padding_top ) ) {
	echo 'padding-top:' . $padding_top . 'px;';
}
if ( ! empty( $padding_bottom ) ) {
	echo 'padding-bottom:' . $padding_bottom . 'px;';
}
if ( ! empty( $padding_left ) ) {
	echo 'padding-left:' . $padding_left . 'px;';
}
if ( ! empty( $padding_right ) ) {
	echo 'padding-right:' . $padding_right . 'px;';
}
if ( ! empty( $icon_position ) && $icon_position !== 'center' ) {
	echo 'float:' . $icon_position . ';';
}

echo '}';


$title_color = $settings->title_color;
$title_size = $settings->title_font_size;
$font_family = $settings->title_font_family['family'];
$font_weight = $settings->title_font_family['weight'];
$font_style = $settings->title_font_style;
$transform = $settings->title_transform;
$line_height = $settings->title_line_height;
$letter_spacing = $settings->title_letter_spacing;
echo '.fl-node-' . $id . ' .obfx-service-title{';
if ( ! empty( $title_color ) ) {
	echo 'color: #' . $title_color . ';';
}
if ( ! empty( $title_size ) ) {
	echo 'font-size:' . $title_size . 'px;';
}
if ( ! empty( $font_family ) ) {
	echo 'font-family:' . $font_family . ';';
}
if ( ! empty( $font_weight ) ) {
	echo 'font-weight:' . $font_weight . ';';
}
if ( ! empty( $font_style ) ) {
	echo 'font-style:' . $font_style . ';';
}
if ( ! empty( $transform ) ) {
	echo 'text-transform:' . $transform . ';';
}
if ( ! empty( $line_height ) ) {
	echo 'line-height:' . $line_height . 'px;';
}
if ( ! empty( $letter_spacing ) ) {
	echo 'letter-spacing:' . $letter_spacing . 'px;';
}
echo '}';


$content_color = $settings->content_color;
$content_size = $settings->content_font_size;
$font_family = $settings->content_font_family['family'];
$font_weight = $settings->content_font_family['weight'];
$font_style = $settings->content_font_style;
$transform = $settings->content_transform;
$line_height = $settings->content_line_height;
$alignment = $settings->content_alignment;
$letter_spacing = $settings->content_letter_spacing;
echo '.fl-node-' . $id . ' .obfx-service-content{';
if ( ! empty( $content_color ) ) {
	echo 'color: #' . $content_color . ';';
}
if ( ! empty( $content_size ) ) {
	echo 'font-size:' . $content_size . 'px;';
}
if ( ! empty( $font_family ) ) {
	echo 'font-family:' . $font_family . ';';
}
if ( ! empty( $font_weight ) ) {
	echo 'font-weight:' . $font_weight . ';';
}
if ( ! empty( $font_style ) ) {
	echo 'font-style:' . $font_style . ';';
}
if ( ! empty( $transform ) ) {
	echo 'text-transform:' . $transform . ';';
}
if ( ! empty( $line_height ) ) {
	echo 'line-height:' . $line_height . 'px;';
}
if ( ! empty( $alignment ) ) {
	echo 'text-align:' . $alignment . ';';
}
if ( ! empty( $letter_spacing ) ) {
	echo 'letter-spacing:' . $letter_spacing . 'px;';
}
echo '}';
