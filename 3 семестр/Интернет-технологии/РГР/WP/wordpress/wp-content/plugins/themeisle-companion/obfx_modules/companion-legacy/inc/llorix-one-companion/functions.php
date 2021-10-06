<?php
/*
Plugin Name: Llorix One Companion
Plugin URI: https://github.com/Codeinwp/llorix-one-companion
Description: Add Our team, Our Services and Testimonials sections to Llorix One Lite theme.
Version: 1.1.4
Author: Themeisle
Author URI: http://themeisle.com
Text Domain: llorix-one-companion
Domain Path: /languages
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! function_exists( 'add_action' ) ) {
	die( 'Nothing to do...' );
}

/* Important constants */
define( 'LLORIX_ONE_COMPANION_VERSION', '1.1.4' );
define( 'LLORIX_ONE_COMPANION_URL', plugin_dir_url( __FILE__ ) );
define( 'LLORIX_ONE_COMPANION_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Require section translations
 */
require LLORIX_ONE_COMPANION_PATH . 'inc/translations/general.php';

/* Required helper functions */
include_once( dirname( __FILE__ ) . '/inc/settings.php' );


/* Add new sections in Llorix One */
function llorix_one_companion_sections() {
	return array(
		'sections/llorix_one_lite_logos_section',
		'our-services-section',
		'sections/llorix_one_lite_our_story_section',
		'our-team-section',
		'happy-customers-section',
		'sections/llorix_one_lite_content_section',
		'sections/llorix_one_lite_ribbon_section',
		'sections/llorix_one_lite_latest_news_section',
		'sections/llorix_one_lite_contact_info_section',
		'sections/llorix_one_lite_map_section'
	);
}

/**
 * Load sections
 */
function llorix_one_companion_load_sections() {

	add_filter('llorix_one_companion_sections_filter', 'llorix_one_companion_sections');
}

/* Register style sheet. */
function llorix_one_companion_register_plugin_styles() {
	
	wp_enqueue_style( 'llorix-one-companion-style', LLORIX_ONE_COMPANION_URL.'css/style.css' );
	
}
