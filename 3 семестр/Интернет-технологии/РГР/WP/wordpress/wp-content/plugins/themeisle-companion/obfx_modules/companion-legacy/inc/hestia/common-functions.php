<?php
/**
 * Functions that are running in both Hestia Lite and Pro
 *
 * @author Themeisle
 * @package themeisle-companion
 */

/**
 * Change default alignment for top bar.
 */
function themeisle_hestia_top_bar_default_alignment(){
	return 'left';
}

/**
 * Add default content to clients section;
 */
function themeisle_hestia_clients_default_content(){
	$plugin_path = plugins_url( 'inc/img/', __FILE__ );
	return json_encode(
		array(
			array( 'image_url' => $plugin_path . 'clients1.png', 'link' => '#'),
			array( 'image_url' => $plugin_path . 'clients2.png', 'link' => '#'),
			array( 'image_url' => $plugin_path . 'clients3.png', 'link' => '#'),
			array( 'image_url' => $plugin_path . 'clients4.png', 'link' => '#'),
			array( 'image_url' => $plugin_path . 'clients5.png', 'link' => '#'),
		)
	);
}

/**
 * Execute this function once to check all widgets and see if there are any duplicates.
 * If there are duplicates, remove that widget and generate a new one with same
 * data but a new id.
 *
 * @since 2.4.5
 */
function themeisle_hestia_fix_duplicate_widgets() {

	$load_default = get_option( 'hestia_fix_duplicate_widgets' );
	if ( $load_default !== false ) {
		return;
	}

	global $wp_registered_widgets;
	$current_sidebars = get_option( 'sidebars_widgets' );

	$duplicates = themeisle_hestia_get_duplicate_widgets();
	if(empty($duplicates)){
		return;
	}
	foreach ($duplicates as $widget){
		$old_widget_id = $widget['widget_id'];
		$old_widget_sidebar = $widget['sidebar'];
		$old_widget_index = array_search($old_widget_id,$current_sidebars[$old_widget_sidebar]);
		if( empty($old_widget_index)){
			return;
		}

		/* Remove the widget id and obtain the widget name */
		$old_widget_name = explode( '-', $old_widget_id );
		array_pop( $old_widget_name );
		$widget_name = implode('-', $old_widget_name);

		/* Get the id of new widget */
		$new_widget_name = themeisle_hestia_generate_unique_widget_name($widget_name);
		$new_widget_index  = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );


		/* Get the options of old widget and update its id */
		$old_widget_options = $wp_registered_widgets[$old_widget_id];
		if(!empty($old_widget_options)) {
			if ( ! empty( $old_widget_options['params'] ) ) {
				unset( $old_widget_options['params'] );
			}
			if ( ! empty( $old_widget_options['callback'] ) ) {
				unset( $old_widget_options['callback'] );
			}
			if ( ! empty( $old_widget_options['id'] ) ) {
				unset( $old_widget_options['id'] );
			}
		} else {
			$old_widget_options = array();
		}

		$current_sidebars[$old_widget_sidebar][$old_widget_index] = $new_widget_name;
		$new_widget[ $new_widget_index ] = $old_widget_options;

		update_option( 'widget_'.$widget_name, $new_widget );
	}
	update_option( 'sidebars_widgets', $current_sidebars );

	update_option( 'hestia_fix_duplicate_widgets', true );
}

/**
 * Generate new unique widget name.
 *
 * @param string $widget_name Widget name.
 *
 * @since 2.4.5
 * @return string
 */
function themeisle_hestia_generate_unique_widget_name( $widget_name ) {
	$current_sidebars = get_option( 'sidebars_widgets' );
	$all_widget_array = array();
	foreach ( $current_sidebars as $sidebar => $widgets ) {
		if ( ! empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
			foreach ( $widgets as $widget ) {
				$all_widget_array[] = $widget;
			}
		}
	}
	$widget_index = 1;
	while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
		$widget_index ++;
	}
	$new_widget_name = $widget_name . '-' . $widget_index;
	return $new_widget_name;
}


/**
 * Get an array of duplicate widgets and their sidebars.
 *
 * @since 2.4.5
 */
function themeisle_hestia_get_duplicate_widgets() {

	$current_sidebars = get_option( 'sidebars_widgets' );
	$all_widget_array = array();
	$duplicate_widgets = array();
	foreach ( $current_sidebars as $sidebar => $widgets ) {
		if ( ! empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
			foreach ( $widgets as $widget ) {
				if( in_array($widget,$all_widget_array)){
					$duplicate_widgets[] = array(
						'widget_id' => $widget,
						'sidebar' => $sidebar
					);
				} else{
					$all_widget_array[] = $widget;
				}
			}
		}
	}
	return $duplicate_widgets;
}