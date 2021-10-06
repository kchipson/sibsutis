<?php
$text_position = ! empty( $settings->text_position ) ? $settings->text_position : '';
if ( ! empty( $text_position ) ) {
	echo '.fl-node-' . $id . ' .obfx-pricing-plan > div,.fl-node-' . $id . ' .obfx-pricing-plan li{';
	echo 'text-align:' . $text_position . ';';
	echo '}';
}

$padding_top = ! empty( $settings->top ) ? $settings->top : '';
$padding_bottom = ! empty( $settings->bottom ) ? $settings->bottom : '';
$padding_left = ! empty( $settings->left ) ? $settings->left : '';
$padding_right = ! empty( $settings->right ) ? $settings->right : '';
echo '.fl-node-' . $id . '.obfx-pricing-header{';
	echo ! empty( $padding_top ) ? 'padding-top: ' . $padding_top . 'px;' : '';
	echo ! empty( $padding_bottom ) ? 'padding-bottom: ' . $padding_bottom . 'px;' : '';
	echo ! empty( $padding_left ) ? 'padding-left: ' . $padding_left . 'px;' : '';
	echo ! empty( $padding_right ) ? 'padding-right: ' . $padding_right . 'px;' : '';

	$type = $settings->bg_type;
switch ( $type ) {
	case 'color':
		$bg_color = ! empty( $settings->header_bg_color ) ? $settings->header_bg_color : '';
		if ( ! empty( $bg_color ) ) {
			$bg_color = strpos( $bg_color, 'rgba' ) !== false ? 'background-color:' . $bg_color : 'background-color:#' . $bg_color;
			echo $bg_color . ';';
		}
		break;
	case 'image':
		$bg_image = ! empty( $settings->header_bg_image ) ? $settings->header_bg_image : '';
		if ( ! empty( $bg_image ) ) {
			echo 'background-image:url(' . wp_get_attachment_url( $bg_image ) . ');';
		}
		break;
	case 'gradient':
		$gradient_color1 = ! empty( $settings->gradient_color1 ) ? $settings->gradient_color1 : '';
		$gradient_color2 = ! empty( $settings->gradient_color2 ) ? $settings->gradient_color2 : '';
		$gradient_orientation = ! empty( $settings->gradient_orientation ) ? $settings->gradient_orientation : '';
		$pos1 = 'left';
		$pos2 = 'left';
		$pos3 = 'to right';
		switch ( $gradient_orientation ) {
			case 'vertical':
				$pos1 = 'top';
				$pos2 = 'to bottom';
				$type = 'linear-gradient';
				break;
			case 'diagonal_bottom':
				$pos1 = '-45deg';
				$pos2 = '135deg';
				$type = 'linear-gradient';
				break;
			case 'diagonal_top':
				$pos1 = '45deg';
				$pos2 = '45deg';
				$type = 'linear-gradient';
				break;
			case 'radial':
				$pos1 = 'center, ellipse cover';
				$pos2 = 'ellipse at center';
				$type = 'radial-gradient';
				break;
		}

		if ( ! empty( $gradient_color1 ) ) {
			$gradient_color1 = strpos( $gradient_color1, 'rgba' ) !== false ? $gradient_color1 : '#' . $gradient_color1;
			if ( ! empty( $gradient_color2 ) ) {
				$gradient_color2 = strpos( $gradient_color2, 'rgba' ) !== false ? $gradient_color2 : '#' . $gradient_color2;
				echo '
					background: -moz-' . esc_attr( $type ) . '(' . esc_attr( $pos1 ) . ', ' . esc_attr( $gradient_color1 ) . ' 0%, ' . esc_attr( $gradient_color2 ) . ' 100%); 
					background: -webkit-' . esc_attr( $type ) . '(' . esc_attr( $pos1 ) . ', ' . esc_attr( $gradient_color1 ) . ' 0%, ' . esc_attr( $gradient_color2 ) . ' 100%); 
					background: ' . esc_attr( $type ) . '(' . esc_attr( $pos2 ) . ', ' . esc_attr( $gradient_color1 ) . ' 0%, ' . esc_attr( $gradient_color2 ) . ' 100%);';
			} else {
				echo 'background-color:' . esc_attr( $gradient_color1 ) . ';';
			}
		}
		break;
}
echo '}';

$title_color = ! empty( $settings->title_color ) ? $settings->title_color : '';
if ( ! empty( $title_color ) ) {
	$title_color = strpos( $title_color, 'rgba' ) !== false ? $title_color : '#' . $title_color;
}
$title_font_size = ! empty( $settings->title_font_size ) ? $settings->title_font_size : '';
$title_font_family = ! empty( $settings->title_font_family['family'] ) ? $settings->title_font_family['family'] : '';
$title_font_weight = ! empty( $settings->title_font_family['weight'] ) ? $settings->title_font_family['weight'] : '';
$title_transform = ! empty( $settings->title_transform ) ? $settings->title_transform : '';
$title_font_style = ! empty( $settings->title_font_style ) ? $settings->title_font_style : '';
$title_line_height = ! empty( $settings->title_line_height ) ? $settings->title_line_height : '';
$title_letter_spacing = ! empty( $settings->title_letter_spacing ) ? $settings->title_letter_spacing : '';
echo '.fl-node-' . $id . ' .obfx-pricing-header *:first-child{';
	echo ! empty( $title_color ) ? 'color: ' . $title_color . ';' : '';
	echo ! empty( $title_font_size ) ? 'font-size: ' . $title_font_size . 'px;' : '';
	echo ! empty( $title_font_family ) ? 'font-family: ' . $title_font_family . ';' : '';
	echo ! empty( $title_font_weight ) ? 'font-weight: ' . $title_font_weight . ';' : '';
	echo ! empty( $title_transform ) ? 'text-transform: ' . $title_transform . ';' : '';
	echo ! empty( $title_font_style ) ? 'font-style: ' . $title_font_style . ';' : '';
	echo ! empty( $title_line_height ) ? 'line-height: ' . $title_line_height . 'px;' : '';
	echo ! empty( $title_letter_spacing ) ? 'letter-spacing: ' . $title_letter_spacing . 'px;' : '';
echo '}';


$subtitle_color = ! empty( $settings->subtitle_color ) ? $settings->subtitle_color : '';
if ( ! empty( $subtitle_color ) ) {
	$subtitle_color = strpos( $subtitle_color, 'rgba' ) !== false ? $subtitle_color : '#' . $subtitle_color;
}
$subtitle_font_size = ! empty( $settings->subtitle_font_size ) ? $settings->subtitle_font_size : '';
$subtitle_font_family = ! empty( $settings->subtitle_font_family['family'] ) ? $settings->subtitle_font_family : '';
$subtitle_font_weight = ! empty( $settings->subtitle_font_family['weight'] ) ? $settings->subtitle_font_family : '';
$subtitle_transform = ! empty( $settings->subtitle_transform ) ? $settings->subtitle_transform : '';
$subtitle_font_style = ! empty( $settings->subtitle_font_style ) ? $settings->subtitle_font_style : '';
$subtitle_line_height = ! empty( $settings->subtitle_line_height ) ? $settings->subtitle_line_height : '';
$subtitle_letter_spacing = ! empty( $settings->subtitle_letter_spacing ) ? $settings->subtitle_letter_spacing : '';
echo '.fl-node-' . $id . ' .obfx-pricing-header *:last-child{';
	echo ! empty( $subtitle_color ) ? 'color: ' . $subtitle_color . ';' : '';
	echo ! empty( $subtitle_font_size ) ? 'font-size: ' . $subtitle_font_size . 'px;' : '';
	echo ! empty( $subtitle_font_family ) ? 'font-family: ' . $subtitle_font_family . ';' : '';
	echo ! empty( $subtitle_font_weight ) ? 'font-weight: ' . $subtitle_font_weight . ';' : '';
	echo ! empty( $subtitle_transform ) ? 'text-transform: ' . $subtitle_transform . ';' : '';
	echo ! empty( $subtitle_font_style ) ? 'font-style: ' . $subtitle_font_style . ';' : '';
	echo ! empty( $subtitle_line_height ) ? 'line-height: ' . $subtitle_line_height . 'px;' : '';
	echo ! empty( $subtitle_letter_spacing ) ? 'letter-spacing: ' . $subtitle_letter_spacing . 'px;' : '';
echo '}';

$price_top = ! empty( $settings->price_top ) ? $settings->price_top : '';
$price_bottom = ! empty( $settings->price_bottom ) ? $settings->price_bottom : '';
$price_left = ! empty( $settings->price_left ) ? $settings->price_left : '';
$price_right = ! empty( $settings->price_right ) ? $settings->price_right : '';
$price_font_size = ! empty( $settings->price_font_size ) ? $settings->price_font_size : '';
$price_font_family = ! empty( $settings->price_font_family['family'] ) ? $settings->price_font_family['family'] : '';
$price_font_weight = ! empty( $settings->price_font_family['weight'] ) ? $settings->price_font_family['weight'] : '';
$price_transform = ! empty( $settings->price_transform ) ? $settings->price_transform : '';
$price_font_style = ! empty( $settings->price_font_style ) ? $settings->price_font_style : '';
$price_line_height = ! empty( $settings->price_line_height ) ? $settings->price_line_height : '';
$price_letter_spacing = ! empty( $settings->price_letter_spacing ) ? $settings->price_letter_spacing : '';
echo '.fl-node-' . $id . ' .obfx-pricing-price{';
	echo ! empty( $price_top ) ? 'padding-top: ' . $price_top . 'px;' : '';
	echo ! empty( $price_bottom ) ? 'padding-bottom: ' . $price_bottom . 'px;' : '';
	echo ! empty( $price_left ) ? 'padding-left: ' . $price_left . 'px;' : '';
	echo ! empty( $price_right ) ? 'padding-right: ' . $price_right . 'px;' : '';
	echo ! empty( $price_font_size ) ? 'font-size: ' . $price_font_size . 'px;' : '';
	echo ! empty( $price_font_family ) ? 'font-family: ' . $price_font_family . ';' : '';
	echo ! empty( $price_font_weight ) ? 'font-weight: ' . $price_font_weight . ';' : '';
	echo ! empty( $price_transform ) ? 'text-transform: ' . $price_transform . ';' : '';
	echo ! empty( $price_font_style ) ? 'font-style: ' . $price_font_style . ';' : '';
	echo ! empty( $price_line_height ) ? 'line-height: ' . $price_line_height . 'px;' : '';
	echo ! empty( $price_letter_spacing ) ? 'letter-spacing: ' . $price_letter_spacing . 'px;' : '';
echo '}';

if ( ! empty( $settings->price_color ) ) {
	$price_color = strpos( $settings->price_color, 'rgba' ) !== false ? $settings->price_color : '#' . $settings->price_color;
	echo '.fl-node-' . $id . ' .obfx-pricing-price{';
	echo 'color: ' . $price_color . ';';
	echo '}';
}

if ( ! empty( $settings->currency_color ) ) {
	$currency_color = strpos( $settings->currency_color, 'rgba' ) !== false ? $settings->currency_color : '#' . $settings->currency_color;
	echo '.fl-node-' . $id . ' .obfx-pricing-price sup{';
	echo 'color: ' . $currency_color . ';';
	echo '}';
}

if ( ! empty( $settings->period_color ) ) {
	$period_color = strpos( $settings->period_color, 'rgba' ) !== false ? $settings->period_color : '#' . $settings->period_color;
	echo '.fl-node-' . $id . ' .obfx-pricing-price .obfx-period{';
	echo 'color: ' . $period_color . ';';
	echo '}';
}
$features_top = ! empty( $settings->features_right ) ? $settings->features_right : '';
$features_bottom = ! empty( $settings->features_right ) ? $settings->features_right : '';
$features_left = ! empty( $settings->features_right ) ? $settings->features_right : '';
$features_right = ! empty( $settings->features_right ) ? $settings->features_right : '';
echo '.fl-node-' . $id . ' .obfx-pricing-features .obfx-pricing-feature-content{';
	echo ! empty( $features_top ) ? 'padding-top: ' . $features_top . 'px;' : '';
	echo ! empty( $features_bottom ) ? 'padding-bottom: ' . $features_bottom . 'px;' : '';
	echo ! empty( $features_left ) ? 'padding-left: ' . $features_left . 'px;' : '';
	echo ! empty( $features_right ) ? 'padding-right: ' . $features_right . 'px;' : '';
echo '}';

$feature_font_size  = ! empty( $settings->feature_font_size ) ? $settings->feature_font_size : '';
$feature_transform  = ! empty( $settings->feature_transform ) ? $settings->feature_transform : '';
$feature_font_style  = ! empty( $settings->feature_font_style ) ? $settings->feature_font_style : '';
$feature_line_height  = ! empty( $settings->feature_line_height ) ? $settings->feature_line_height : '';
$feature_letter_spacing  = ! empty( $settings->feature_letter_spacing ) ? $settings->feature_letter_spacing : '';
echo '.fl-node-' . $id . ' .obfx-pricing-features .obfx-pricing-feature-content * {';
	echo ! empty( $feature_font_size ) ? 'font-size: ' . $feature_font_size . 'px;' : '';
	echo ! empty( $feature_transform ) ? 'text-transform: ' . $feature_transform . ';' : '';
	echo ! empty( $feature_font_style ) ? 'font-style: ' . $feature_font_style . ';' : '';
	echo ! empty( $feature_line_height ) ? 'line-height: ' . $feature_line_height . 'px;' : '';
	echo ! empty( $feature_letter_spacing ) ? 'letter-spacing: ' . $feature_letter_spacing . 'px;' : '';
echo '}';

if ( ! empty( $settings->feature_font_family['family'] ) ) {
	echo '.fl-node-' . $id . ' .obfx-pricing-features .obfx-pricing-feature-content:not(i){';
	echo 'font-family: ' . $settings->feature_font_family['family'] . ';';
	echo '}';
}
if ( ! empty( $settings->feature_font_family['weight'] ) ) {
	echo '.fl-node-' . $id . ' .obfx-pricing-features .obfx-pricing-feature-content:not(strong){';
	echo 'font-weight: ' . $settings->feature_font_family['weight'] . ';';
	echo '}';
}

if ( ! empty( $settings->icon_color ) ) {
	$icon_color = strpos( $settings->icon_color, 'rgba' ) !== false ? $settings->icon_color : '#' . $settings->icon_color;
	echo '.fl-node-' . $id . ' .obfx-pricing-feature-content i{';
	echo 'color: ' . $icon_color . ';';
	echo '}';
}

if ( ! empty( $settings->bold_color ) ) {
	$bold_color = strpos( $settings->bold_color, 'rgba' ) !== false ? $settings->bold_color : '#' . $settings->bold_color;
	echo '.fl-node-' . $id . ' .obfx-pricing-feature-content strong{';
	echo 'color: ' . $bold_color . ';';
	echo '}';
}

if ( ! empty( $settings->feature_color ) ) {
	$feature_color = strpos( $settings->feature_color, 'rgba' ) !== false ? $settings->feature_color : '#' . $settings->feature_color;
	echo '.fl-node-' . $id . ' .obfx-pricing-feature-content:not(i):not(strong){';
	echo 'color: ' . $feature_color . ';';
	echo '}';
}

$button_margin_bottom = ! empty( $settings->button_margin_bottom ) ? $settings->button_margin_bottom : '';
$button_margin_left = ! empty( $settings->button_margin_left ) ? $settings->button_margin_left : '';
$button_margin_right = ! empty( $settings->button_margin_right ) ? $settings->button_margin_right : '';
$button_margin_top = ! empty( $settings->button_margin_top ) ? $settings->button_margin_top : '';
echo '.fl-node-' . $id . ' .obfx-plan-bottom{';
	echo ! empty( $button_margin_bottom ) ? 'margin-bottom: ' . $button_margin_bottom . 'px;' : '';
	echo ! empty( $button_margin_left ) ? 'margin-left: ' . $button_margin_left . 'px;' : '';
	echo ! empty( $button_margin_right ) ? 'margin-right: ' . $button_margin_right . 'px;' : '';
	echo ! empty( $button_margin_top ) ? 'margin-top: ' . $button_margin_top . 'px;' : '';
echo '}';

$button_padding_top = ! empty( $settings->button_padding_top ) ? $settings->button_padding_top : '';
$button_padding_bottom = ! empty( $settings->button_padding_bottom ) ? $settings->button_padding_bottom : '';
$button_padding_left = ! empty( $settings->button_padding_left ) ? $settings->button_padding_left : '';
$button_padding_right = ! empty( $settings->button_padding_right ) ? $settings->button_padding_right : '';
$button_font_size = ! empty( $settings->button_font_size ) ? $settings->button_font_size : '';
$button_transform = ! empty( $settings->button_transform ) ? $settings->button_transform : '';
$button_font_style = ! empty( $settings->button_font_style ) ? $settings->button_font_style : '';
$button_line_height = ! empty( $settings->button_line_height ) ? $settings->button_line_height : '';
$button_letter_spacing = ! empty( $settings->button_letter_spacing ) ? $settings->button_letter_spacing : '';
$button_font_family = ! empty( $settings->button_font_family['family'] ) ? $settings->button_font_family['family'] : '';
$button_font_weight = ! empty( $settings->button_font_family['weight'] ) ? $settings->button_font_family['weight'] : '';
$button_text_color = ! empty( $settings->button_text_color ) ? ( strpos( $settings->button_text_color, 'rgba' ) !== false ? $settings->button_text_color : '#' . $settings->button_text_color ) : '';
$button_bg_color = ! empty( $settings->button_bg_color ) ? ( strpos( $settings->button_bg_color, 'rgba' ) !== false ? $settings->button_bg_color : '#' . $settings->button_bg_color ) : '';
echo '.fl-node-' . $id . ' .obfx-plan-button{';
	echo ! empty( $button_padding_top ) ? 'padding-top: ' . $button_padding_top . 'px;' : '';
	echo ! empty( $button_padding_bottom ) ? 'padding-bottom: ' . $button_padding_bottom . 'px;' : '';
	echo ! empty( $button_padding_left ) ? 'padding-left: ' . $button_padding_left . 'px;' : '';
	echo ! empty( $button_padding_right ) ? 'padding-right: ' . $button_padding_right . 'px;' : '';
	echo ! empty( $button_text_color ) ? 'color: ' . $button_text_color . ';' : '';
	echo ! empty( $button_bg_color ) ? 'background-color: ' . $button_bg_color . ';' : '';
	echo ! empty( $button_font_size ) ? 'font-size: ' . $button_font_size . 'px;' : '';
	echo ! empty( $button_transform ) ? 'text-transform: ' . $button_transform . ';' : '';
	echo ! empty( $button_font_style ) ? 'font-style: ' . $button_font_style . ';' : '';
	echo ! empty( $button_line_height ) ? 'line-height: ' . $button_line_height . 'px;' : '';
	echo ! empty( $button_letter_spacing ) ? 'letter-spacing: ' . $button_letter_spacing . 'px;' : '';
	echo ! empty( $button_font_family ) ? 'font-family: ' . $button_font_family . ';' : '';
	echo ! empty( $button_font_weight ) ? 'font-weight: ' . $button_font_weight . ';' : '';
echo '}';

$button_text_color_hover = ! empty( $settings->button_text_color_hover ) ? ( strpos( $settings->button_text_color_hover, 'rgba' ) !== false ? $settings->button_text_color_hover : '#' . $settings->button_text_color_hover ) : '';
$button_bg_color_hover = ! empty( $settings->button_bg_color_hover ) ? ( strpos( $settings->button_bg_color_hover, 'rgba' ) !== false ? $settings->button_bg_color_hover : '#' . $settings->button_bg_color_hover ) : '';
echo '.fl-node-' . $id . ' .obfx-plan-button:hover{';
	echo ! empty( $button_text_color_hover ) ? 'color: ' . $button_text_color_hover . ';' : '';
	echo ! empty( $button_bg_color_hover ) ? 'background-color: ' . $button_bg_color_hover . ';' : '';
echo '}';
