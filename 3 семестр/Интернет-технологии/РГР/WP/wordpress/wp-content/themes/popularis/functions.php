<?php
/**
 * The current version of the theme.
 */
define('POPULARIS_VERSION', '1.0.5');

add_action('after_setup_theme', 'popularis_setup');

if (!function_exists('popularis_setup')) :

    /**
     * Global functions
     */
    function popularis_setup() {

        // Theme lang.
        load_theme_textdomain('popularis', get_template_directory() . '/languages');

        // Register Menus.
        register_nav_menus(
            array(
                'main_menu' => esc_html__('Main Menu', 'popularis'),
            )
        );

        // Add Custom Background Support.
        $args = array(
            'default-color' => 'ffffff',
        );
        
        add_theme_support('custom-background', $args);

        add_theme_support('custom-logo', array(
            'height' => 60,
            'width' => 170,
            'flex-height' => true,
            'flex-width' => true,
            'header-text' => array('site-title', 'site-description'),
        ));
        
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(300, 300, true);
        add_image_size('popularis-img', 1140, 600, true);
        
        // Set the default content width.
        $GLOBALS['content_width'] = 1140;

        // WooCommerce support.
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        add_theme_support('html5', array('search-form'));
        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style(array('css/bootstrap.css', popularis_fonts_url(), 'css/editor-style.css'));
        
        add_theme_support('automatic-feed-links');

        // Add Title Tag Support.
        add_theme_support('title-tag');
        
        // Recommend plugins.
        add_theme_support('recommend-plugins', array(
            'popularis-extra' => array(
                'name' => 'Popularis Extra',
                'active_filename' => 'popularis-extra/popularis-extra.php',
                /* translators: %s plugin name string */
                'description' => sprintf(esc_html__('To take full advantage of all the features this theme has to offer, please install and activate the %s plugin.', 'popularis'), '<strong>Popularis Extra</strong>'),
            ),
            'elementor' => array(
                'name' => 'Elementor Page Builder',
                'active_filename' => 'elementor/elementor.php',
                /* translators: %s plugin name string */
                'description' => esc_html__('The most advanced frontend drag & drop page builder.', 'popularis'),
            ),
            'woocommerce' => array(
                'name' => 'WooCommerce',
                'active_filename' => 'woocommerce/woocommerce.php',
                /* translators: %s plugin name string */
                'description' => sprintf(esc_attr__('To enable shop features, please install and activate the %s plugin.', 'popularis'), '<strong>WooCommerce</strong>'),
            ),
        ));
    }

endif;

function popularis_body_classes( $classes ) {
    // Add class if the site title and tagline is hidden.
    if ( display_header_text() == true) {
	$classes[] = 'title-tagline-hidden';
    }
    
    return $classes;
    
}
add_filter( 'body_class', 'popularis_body_classes' );


/**
 * Register custom fonts.
 */
function popularis_fonts_url() {
    $fonts_url = '';

    /**
     * Translators: If there are characters in your language that are not
     * supported by Open Sans Condensed, translate this to 'off'. Do not translate
     * into your own language.
     */
    $font = _x('on', 'Open Sans Condensed font: on or off', 'popularis');

    if ('off' !== $font) {
        $font_families = array();

        $font_families[] = 'Open Sans Condensed:300,500,700';

        $query_args = array(
            'family' => urlencode(implode('|', $font_families)),
            'subset' => urlencode('cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese'),
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw($fonts_url);
}

/**
 * Add preconnect for Google Fonts.
 */
function popularis_resource_hints($urls, $relation_type) {
    if (wp_style_is('popularis-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}

add_filter('wp_resource_hints', 'popularis_resource_hints', 10, 2);

/**
 * Enqueue Styles 
 */
function popularis_theme_stylesheets() {
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), '3.3.7');
    wp_enqueue_style('mmenu-light', get_template_directory_uri() . '/assets/css/mmenu-light.css', array(), '1.1');
    // Theme stylesheet.
    wp_enqueue_style('popularis-stylesheet', get_stylesheet_uri(), array('bootstrap'), POPULARIS_VERSION);
    // Load Font Awesome css.
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7.0');
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style('popularis-fonts', popularis_fonts_url(), array(), null);
    if (class_exists('WooCommerce')) {
        wp_enqueue_style('popularis-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', array('bootstrap'), POPULARIS_VERSION);
    }
}

add_action('wp_enqueue_scripts', 'popularis_theme_stylesheets');

/**
 * Register Bootstrap JS with jquery
 */
function popularis_theme_js() {
    wp_enqueue_script('mmenu', get_template_directory_uri() . '/assets/js/mmenu-light.min.js', array('jquery'), '1.1', true);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '3.3.7', true);
    wp_enqueue_script('popularis-theme-js', get_template_directory_uri() . '/assets/js/customscript.js', array('jquery'), POPULARIS_VERSION, true);
}

add_action('wp_enqueue_scripts', 'popularis_theme_js');

/**
 * Set Content Width
 */
function popularis_content_width() {

    $content_width = $GLOBALS['content_width'];

    if (is_active_sidebar('sidebar-1')) {
        $content_width = 750;
    } else {
        $content_width = 1040;
    }

    /**
     * Filter content width of the theme.
     */
    $GLOBALS['content_width'] = apply_filters('popularis_content_width', $content_width);
}

add_action('template_redirect', 'popularis_content_width', 0);

/**
 * Register Custom Navigation Walker include custom menu widget to use walkerclass
 */
require_once( trailingslashit(get_template_directory()) . 'inc/wp_bootstrap_navwalker.php' );

/**
 * Register Theme Extra Functions
 */
require_once( trailingslashit(get_template_directory()) . 'inc/extra.php' );

/**
 *  Theme Page
 */
require_once( trailingslashit(get_template_directory()) . 'inc/admin/dashboard.php' );

/**
 *  Customizer
 */
require_once( trailingslashit(get_template_directory()) . 'inc/admin/customizer.php' );

/**
 * Register WooCommerce functions
 */
if (class_exists('WooCommerce')) {
    require_once( trailingslashit(get_template_directory()) . 'inc/woocommerce.php' );
}

add_action('widgets_init', 'popularis_widgets_init');

/**
 * Register the Sidebar(s)
 */
function popularis_widgets_init() {
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'popularis'),
            'id' => 'sidebar-1',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title"><h3>',
            'after_title' => '</h3></div>',
        )
    );
    register_sidebar(
        array(
            'name' => esc_html__('Top Bar Section', 'popularis'),
            'id' => 'popularis-top-bar-area',
            'before_widget' => '<div id="%1$s" class="widget %2$s col-sm-4">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title"><h3>',
            'after_title' => '</h3></div>',
        )
    );
    register_sidebar(
        array(
            'name' => esc_html__('Footer Section', 'popularis'),
            'id' => 'popularis-footer-area',
            'before_widget' => '<div id="%1$s" class="widget %2$s col-md-3">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title"><h3>',
            'after_title' => '</h3></div>',
        )
    );
}

if ( ! function_exists( 'wp_body_open' ) ) :
    /**
     * Fire the wp_body_open action.
     *
     * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
     *
     */
    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         *
         */
        do_action( 'wp_body_open' );
    }
endif;

/**
 * Include a skip to content link at the top of the page so that users can bypass the header.
 */
function popularis_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . esc_html__( 'Skip to the content', 'popularis' ) . '</a>';
}

add_action( 'wp_body_open', 'popularis_skip_link', 5 );