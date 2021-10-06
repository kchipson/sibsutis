<?php
/**
 * This file is used to render each pricing module instance.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 */

$class_to_add = $settings->card_layout === 'yes' ? 'obfx-card' : '';

echo '<div class="obfx-pricing-plan ' . esc_attr( $class_to_add ) . '">';
	echo '<div class="obfx-pricing-header">';
		echo '<' . $settings->plan_title_tag . ' class="obfx-plan-title text-center">' . wp_kses_post( $settings->plan_title ) . '</' . $settings->plan_title_tag . '>';
		echo '<' . $settings->plan_subtitle_tag . ' class="obfx-plan-subtitle text-center">' . wp_kses_post( $settings->plan_subtitle ) . '</' . $settings->plan_subtitle_tag . '>';
	echo '</div>';
	echo '<div class="obfx-pricing-price text-center">';
switch ( $settings->currency_position ) {
	case 'after':
		echo '<span class="obfx-price">' . wp_kses_post( $settings->price ) . '</span><sup class="obfx-currency">' . wp_kses_post( $settings->currency ) . '</sup><span class="obfx-period">' . wp_kses_post( $settings->period ) . '</span>';
		break;
	case 'before':
		echo '<sup>' . wp_kses_post( $settings->currency ) . '</sup><span class="obfx-price">' . wp_kses_post( $settings->price ) . '</span><span class="obfx-period">' . wp_kses_post( $settings->period ) . '</span>';
		break;
}
	echo '</div>';

	$features = $settings->features;
if ( ! empty( $features ) ) {
	echo '<ul class="obfx-pricing-features text-center">';
	foreach ( $features as $feature ) {
		$icon = ! empty( $feature->icon ) ? $feature->icon : '';
		$bold_text = ! empty( $feature->bold_text ) ? $feature->bold_text : '';
		$text = ! empty( $feature->text ) ? $feature->text : '';
		$section_is_empty = empty( $icon ) && empty( $bold_text ) && empty( $text );
		if ( ! $section_is_empty ) {
			echo '<li><span class="obfx-pricing-feature-content">';
			if ( ! empty( $icon ) ) {
				echo '<i class="fa ' . esc_attr( $icon ) . '"></i>';
			}
			if ( ! empty( $bold_text ) ) {
				echo '<strong>' . wp_kses_post( $bold_text ) . ' </strong> ';
			}
			if ( ! empty( $text ) ) {
				echo wp_kses_post( $text );
			}
			echo '</span><hr>';
			echo '</li>';
		}
	}
	echo '</ul>';
}

	$button_text = ! empty( $settings->text ) ? $settings->text : '';
	$button_link = ! empty( $settings->link ) ? $settings->link : '';
if ( ! empty( $button_text ) ) {
	echo '<div class="obfx-plan-bottom text-center">';
	echo '<a class="btn obfx-plan-button" href="' . esc_url( $button_link ) . '">' . wp_kses_post( $button_text ) . '</a>';
	echo '</div>';
}
echo '</div>';
