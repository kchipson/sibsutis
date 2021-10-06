<?php
/*
 * Azera Shop Companion
 */

if ( ! function_exists( 'add_action' ) ) {
	die( 'Nothing to do...' );
}

/* Important constants */
define( 'AZERA_SHOP_COMPANION_VERSION', '1.0.7' );
define( 'AZERA_SHOP_COMPANION_URL', plugin_dir_url( __FILE__ ) );
define( 'AZERA_SHOP_COMPANION_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Require section translations
 */
require AZERA_SHOP_COMPANION_PATH . 'inc/translations/general.php';

/* Required helper functions */
include_once( dirname( __FILE__ ) . '/inc/settings.php' );


/* Add new sections in Azera Shop */
function azera_shop_companion_sections() {
	return array(

			'sections/azera_shop_logos_section',
			'azera_shop_our_services_section',
			'sections/azera_shop_shop_section',
			'azera_shop_our_team_section',
			'azera_shop_happy_customers_section',
			'sections/azera_shop_shortcodes_section',
			'sections/azera_shop_ribbon_section',
			'sections/azera_shop_contact_info_section',
			'sections/azera_shop_map_section'

			);
}

/**
 * Load sections form the plugin
 *
 * @since 1.0.0
 */
function azera_shop_companion_load_sections() {

	add_filter('azera_shop_companion_sections_filter', 'azera_shop_companion_sections');
}

add_action( 'plugins_loaded', 'azera_shop_companion_load_sections' );

/*
 * Enqueue styles
 */
function azera_shop_companion_register_plugin_styles() {

	wp_enqueue_style( 'azera-shop-companion-style', trailingslashit( AZERA_SHOP_COMPANION_URL ) . 'css/style.css' );

}

/* Register style sheet. */
add_action( 'wp_enqueue_scripts', 'azera_shop_companion_register_plugin_styles' );
