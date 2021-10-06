<?php
/*
Plugin Name: Shop Isle Companion
Plugin URI: https://github.com/Codeinwp/shop-isle-companion
Description: Add a slider to the front page, add new sections to the about page template in Shop Isle.
Version: 1.0.8
Author: Themeisle
Author URI: http://themeisle.com
Text Domain: shop-isle-companion
Domain Path: /languages
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


/**
 * Filter to replace big title section with slider.
 */
add_filter ( 'shop-isle-subheader', 'shop_isle_companion_slider');

/**
 * Function used for subheader filter/
 * @return string
 */
function shop_isle_companion_slider() {
    return plugin_dir_path( __FILE__ ) . 'content-slider.php';
}

/**
 * Include customizer controls.
 */
require plugin_dir_path( __FILE__ ) . 'customizer.php';

/**
 * Include template loader.
 */
require plugin_dir_path( __FILE__ ) . 'class-template-loader.php';


add_action('shop-isle-about-page-after-content', 'shop_isle_companion_about_addon');
