<?php

$post_width = $settings->display_type === 'list' ? 100 : ( ! empty( $settings->columns ) ? 100 / (int) $settings->columns : 33.3333 );
$card_vertical_align = ! empty( $settings->card_vertical_align ) ? $settings->card_vertical_align : 'top';
echo '.fl-node-' . $id . ' .obfx-post-grid-wrapper{
	width: ' . $post_width . '%;
	vertical-align: ' . $card_vertical_align . ';
}';


$post_bg_color = ! empty( $settings->post_bg_color ) ? $settings->post_bg_color : '';
if ( ! empty( $post_bg_color ) ) {
	$post_bg_color = strpos( $post_bg_color, 'rgba' ) !== false ? 'background-color:' . $post_bg_color : 'background-color:#' . $post_bg_color;
	echo '.fl-node-' . $id . ' .obfx-post-grid{
	' . $post_bg_color . ';
	}';
}

$post_link_color = ! empty( $settings->post_link_color ) ? $settings->post_link_color : '';
if ( ! empty( $post_link_color ) ) {
	$post_link_color = strpos( $post_link_color, 'rgba' ) !== false ? 'color:' . $post_link_color : 'color:#' . $post_link_color;
	echo '.fl-node-' . $id . ' .obfx-post-grid a, .fl-node-' . $id . ' .obfx-post-grid-pagination a {
	' . $post_link_color . ';
	}';
}

$post_text_color = ! empty( $settings->post_text_color ) ? $settings->post_text_color : '';
if ( ! empty( $post_text_color ) ) {
	$post_text_color = strpos( $post_text_color, 'rgba' ) !== false ? 'color:' . $post_text_color : 'color:#' . $post_text_color;
	echo '.fl-node-' . $id . ' .obfx-post-grid, .fl-node-' . $id . ' .obfx-post-grid-pagination{
	' . $post_text_color . ';
	}';
}


$card_margin_top = ! empty( $settings->card_margin_top ) ? $settings->card_margin_top : '0';
$card_margin_bottom = ! empty( $settings->card_margin_bottom ) ? $settings->card_margin_bottom : '0';
echo '.fl-node-' . $id . ' .obfx-post-grid{
	margin-top: ' . $card_margin_top . 'px;
	margin-bottom: ' . $card_margin_bottom . 'px;
}
';

$thumbnail_margin_top = ! empty( $settings->thumbnail_margin_top ) ? $settings->thumbnail_margin_top : '0';
$thumbnail_margin_bottom = ! empty( $settings->thumbnail_margin_bottom ) ? $settings->thumbnail_margin_bottom : '0';
$thumbnail_margin_left = ! empty( $settings->thumbnail_margin_left ) ? $settings->thumbnail_margin_left : '0';
$thumbnail_margin_right = ! empty( $settings->thumbnail_margin_right ) ? $settings->thumbnail_margin_right : '0';
$image_alignment = ! empty( $settings->image_alignment ) ? $settings->image_alignment : 'center';

echo '.fl-node-' . $id . ' .obfx-post-grid-thumbnail{
	margin-top: ' . $thumbnail_margin_top . 'px;
	margin-bottom: ' . $thumbnail_margin_bottom . 'px;
	margin-left: ' . $thumbnail_margin_left . 'px;
	margin-right: ' . $thumbnail_margin_right . 'px;';

switch ( $image_alignment ) {
	case 'center':
		echo 'text-align:center; width:100%;';
		break;
	case 'left':
		echo 'float:left';
		break;
	case 'right':
		echo 'float:right';
		break;
}
echo '}';


$title_padding_top = ! empty( $settings->title_padding_top ) ? $settings->title_padding_top : '0';
$title_padding_bottom = ! empty( $settings->title_padding_bottom ) ? $settings->title_padding_bottom : '0';
$title_padding_left = ! empty( $settings->title_padding_left ) ? $settings->title_padding_left : '0';
$title_padding_right = ! empty( $settings->title_padding_right ) ? $settings->title_padding_right : '0';
$title_alignment = ! empty( $settings->title_alignment ) ? $settings->title_alignment : 'center';
$title_font_size = ! empty( $settings->title_font_size ) ? $settings->title_font_size : '0';
$title_font_family = ! empty( $settings->title_font_family['family'] ) ? $settings->title_font_family['family'] : 'Roboto';
$title_font_weight = ! empty( $settings->title_font_family['weight'] ) ? $settings->title_font_family['weight'] : '400';
$title_transform = ! empty( $settings->title_transform ) ? $settings->title_transform : 'none';
$title_font_style = ! empty( $settings->title_font_style ) ? $settings->title_font_style : 'none';
$title_line_height = ! empty( $settings->title_line_height ) ? $settings->title_line_height : 'inherit';
$title_letter_spacing = ! empty( $settings->title_letter_spacing ) ? $settings->title_letter_spacing : '0';
echo '.fl-node-' . $id . ' .obfx-post-grid-title{
	padding-top: ' . $title_padding_top . 'px;
	padding-bottom: ' . $title_padding_bottom . 'px;
	padding-left: ' . $title_padding_left . 'px;
	padding-right: ' . $title_padding_right . 'px;
	text-align: ' . $title_alignment . ';
	font-size:' . $title_font_size . 'px;
	font-family:' . $title_font_family . ';
	font-weight:' . $title_font_weight . ';
	text-transform:' . $title_transform . ';
	font-style:' . $title_font_style . ';
	line-height:' . $title_line_height . 'px;
	letter-spacing:' . $title_letter_spacing . 'px;
} ';

$meta_padding_top = ! empty( $settings->meta_padding_top ) ? $settings->meta_padding_top : '0';
$meta_padding_bottom = ! empty( $settings->meta_padding_bottom ) ? $settings->meta_padding_bottom : '0';
$meta_padding_left = ! empty( $settings->meta_padding_left ) ? $settings->meta_padding_left : '0';
$meta_padding_right = ! empty( $settings->meta_padding_right ) ? $settings->meta_padding_right : '0';
$meta_alignment = ! empty( $settings->meta_alignment ) ? $settings->meta_alignment : 'center';
$meta_font_size = ! empty( $settings->meta_font_size ) ? $settings->meta_font_size : '0';
$meta_font_family = ! empty( $settings->meta_font_family['family'] ) ? $settings->meta_font_family['family'] : 'Roboto';
$meta_font_weight = ! empty( $settings->meta_font_family['weight'] ) ? $settings->meta_font_family['weight'] : '400';
$meta_transform = ! empty( $settings->meta_transform ) ? $settings->meta_transform : 'none';
$meta_font_style = ! empty( $settings->meta_font_style ) ? $settings->meta_font_style : 'none';
$meta_line_height = ! empty( $settings->meta_line_height ) ? $settings->meta_line_height : 'inherit';
$meta_letter_spacing = ! empty( $settings->meta_letter_spacing ) ? $settings->meta_letter_spacing : '0';
echo '.fl-node-' . $id . ' .obfx-post-grid-meta{
	padding-top: ' . $meta_padding_top . 'px;
	padding-bottom: ' . $meta_padding_bottom . 'px;
	padding-left: ' . $meta_padding_left . 'px;
	padding-right: ' . $meta_padding_right . 'px;
	font-size:' . $meta_font_size . 'px;
	font-family:' . $meta_font_family . ';
	font-weight:' . $meta_font_weight . ';
	text-transform:' . $meta_transform . ';
	font-style:' . $meta_font_style . ';
	line-height:' . $meta_line_height . 'px;
	letter-spacing:' . $meta_letter_spacing . 'px;
	text-align: ' . $meta_alignment . ';
} ';


$content_padding_top = ! empty( $settings->content_padding_top ) ? $settings->content_padding_top : '0';
$content_padding_bottom = ! empty( $settings->content_padding_bottom ) ? $settings->content_padding_bottom : '0';
$content_padding_left = ! empty( $settings->content_padding_left ) ? $settings->content_padding_left : '0';
$content_padding_right = ! empty( $settings->content_padding_right ) ? $settings->content_padding_right : '0';
$content_alignment = ! empty( $settings->content_alignment ) ? $settings->content_alignment : 'center';
$content_font_size = ! empty( $settings->content_font_size ) ? $settings->content_font_size : '0';
$content_font_family = ! empty( $settings->content_font_family['family'] ) ? $settings->content_font_family['family'] : 'Roboto';
$content_font_weight = ! empty( $settings->content_font_family['weight'] ) ? $settings->content_font_family['weight'] : '400';
$content_transform = ! empty( $settings->content_transform ) ? $settings->content_transform : 'none';
$content_font_style = ! empty( $settings->content_font_style ) ? $settings->content_font_style : 'none';
$content_line_height = ! empty( $settings->content_line_height ) ? $settings->content_line_height : 'inherit';
$content_letter_spacing = ! empty( $settings->content_letter_spacing ) ? $settings->content_letter_spacing : '0';

echo '.fl-node-' . $id . ' .obfx-post-content{
	padding-top: ' . $content_padding_top . 'px;
	padding-bottom: ' . $content_padding_bottom . 'px;
	padding-left: ' . $content_padding_left . 'px;
	padding-right: ' . $content_padding_right . 'px;
	text-align: ' . $content_alignment . ';
	font-size:' . $content_font_size . 'px;
	font-family:' . $content_font_family . ';
	font-weight:' . $content_font_weight . ';
	text-transform:' . $content_transform . ';
	font-style:' . $content_font_style . ';
	line-height:' . $content_line_height . 'px;
	letter-spacing:' . $content_letter_spacing . 'px;
} ';

$pagination_font_size = ! empty( $settings->pagination_font_size ) ? $settings->pagination_font_size : '0';
$pagination_font_family = ! empty( $settings->pagination_font_family['family'] ) ? $settings->pagination_font_family['family'] : 'Roboto';
$pagination_font_weight = ! empty( $settings->pagination_font_family['weight'] ) ? $settings->pagination_font_family['weight'] : '400';
$pagination_transform = ! empty( $settings->pagination_transform ) ? $settings->pagination_transform : 'none';
$pagination_font_style = ! empty( $settings->pagination_font_style ) ? $settings->pagination_font_style : 'none';
$pagination_line_height = ! empty( $settings->pagination_line_height ) ? $settings->pagination_line_height : 'inherit';
$pagination_letter_spacing = ! empty( $settings->pagination_letter_spacing ) ? $settings->pagination_letter_spacing : '0';
$pagination_alignment = ! empty( $settings->pagination_alignment ) ? $settings->pagination_alignment : 'center';
echo '.fl-node-' . $id . ' .obfx-post-grid-pagination li a, .fl-node-' . $id . ' .obfx-post-grid-pagination li {
	font-size:' . $pagination_font_size . 'px;
	font-family:' . $pagination_font_family . ';
	font-weight:' . $pagination_font_weight . ';
	text-transform:' . $pagination_transform . ';
	font-style:' . $pagination_font_style . ';
	line-height:' . $pagination_line_height . 'px;
	letter-spacing:' . $pagination_letter_spacing . 'px;
}';

echo '.fl-node-' . $id . ' .obfx-post-grid-pagination{
	text-align: ' . $pagination_alignment . ';
}';
