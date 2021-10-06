<?php

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

if (!function_exists('popularis_hub_setup')) :

    /**
     * Global functions.
     */
    function popularis_hub_setup() {

        // Register extra menu for homepage
        register_nav_menus(
                array(
                    'main_menu_home' => esc_html__('Homepage main menu', 'popularis-hub'),
                )
        );
        
        // Child theme language
        load_child_theme_textdomain( 'popularis-hub', get_stylesheet_directory() . '/languages' );
        
    }
    
endif;

add_action('after_setup_theme', 'popularis_hub_setup');

if (!function_exists('popularis_hub_parent_css')):

    /**
     * Enqueue CSS.
     */
    function popularis_hub_parent_css() {
        $parent_style = 'popularis-stylesheet';

        wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css', array('bootstrap'));
        wp_enqueue_style('popularis-hub',
                get_stylesheet_directory_uri() . '/style.css',
                array($parent_style),
                wp_get_theme()->get('Version')
        );
    }

endif;
add_action('wp_enqueue_scripts', 'popularis_hub_parent_css');

/**
 * Move sidebar left.
 */
function popularis_main_content_width_columns() {

    $columns = '12';

    if (is_active_sidebar('sidebar-1')) {
        $columns = '9 col-md-push-3';
    }

    echo esc_attr($columns);
}

if (!function_exists('popularis_hub_excerpt_length')) :

    /**
     * Limit the excerpt.
     */
    function popularis_hub_excerpt_length($length) {
        if (is_home() || is_archive()) { // Make sure to not limit pagebuilders
            return '30';
        } else {
            return $length;
        }
    }

    add_filter('excerpt_length', 'popularis_hub_excerpt_length', 999);

endif;
