<?php
/**
 * This file is used to render services module.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 */

$columns = $settings->column_number;
$services = $settings->services;
$services_nb = sizeof( $services );
$card_layout = $settings->card_layout;
$container_class = $card_layout === 'yes' ? 'obfx-card obfx-service' : 'obfx-service';
if ( ! empty( $columns ) ) {
	echo '<div class="obfx-services-section">';
	foreach ( $services as $service ) {
		echo '<div class="obfx-service-wrapper">';
			echo '<div class="' . esc_attr( $container_class ) . '">';
				$title = $service->title;
				$text = $service->text;
				$icon = $service->icon;
				$link = $service->link;

		if ( ! empty( $icon ) ) {
			$icon_color = ! empty( $service->icon_color ) ? '#' . $service->icon_color : '#d6d6d6';
			echo '<div class="obfx-service-icon" style="color:' . esc_attr( $icon_color ) . '"><i class="' . esc_attr( $icon ) . '"></i></div>';
		}
		if ( ! empty( $title ) ) {
			if ( ! empty( $link ) ) {
				echo '<a class="obfx-service-title" href="' . esc_url( $link ) . '" target="_blank">';
			}
			echo '<h4 class="obfx-service-title">' . wp_kses_post( $title ) . '</h4>';
			if ( ! empty( $link ) ) {
				echo '</a>';
			}
		}

		if ( ! empty( $text ) ) {
			echo '<p class="obfx-service-content">' . wp_kses_post( $text ) . '</p>';
		}

			echo '</div>';
		echo '</div>';
	}
	echo '</div>';

}
