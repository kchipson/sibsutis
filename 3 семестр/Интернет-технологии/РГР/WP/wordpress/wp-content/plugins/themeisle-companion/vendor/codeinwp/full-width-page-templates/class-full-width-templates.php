<?php
/**
 * Class ThemeIsle\FullWidthTemplates
 *
 * @package     ThemeIsle\FullWidthTemplates
 * @copyright   Copyright (c) 2017, Andrei Lupu
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

namespace ThemeIsle;

use ThemeIsle\FullWidthTemplates\Elementor;
use ThemeIsle\FullWidthTemplates\None;

if ( ! class_exists( '\ThemeIsle\FullWidthTemplates' ) ) {

	class FullWidthTemplates {
		/**
		 * @var FullWidthTemplates
		 */
		public static $instance = null;

		/**
		 * The version of this library
		 * @var string
		 */
		public static $version = '1.0.1';

		/**
		 * The array of templates injected.
		 */
		protected $templates;

		/**
		 * Defines the library behaviour
		 */
		protected function init() {

			// Add your templates to this array.
			$this->templates = apply_filters( 'fwpt_templates_list', array(
				'templates/builder-fullwidth.php'     => html_entity_decode( '&harr; ' ) . __( 'Page Builder - Full Width - Blank', 'themeisle-companion' ),
				'templates/builder-fullwidth-std.php' => html_entity_decode( '&harr; ' ) . __( 'Page Builder - Full Width', 'themeisle-companion' ),
			) );

			add_filter( 'theme_page_templates', array( $this, 'add_pages_in_dropdown' ) );

			// Add a filter to the template include to determine if the page has our
			// template assigned and return it's path
			add_filter( 'template_include', array( $this, 'redirect_page_template' ) );

			// Add a filter to the save post to inject out template into the page cache
			add_filter( 'wp_insert_post_data', array( $this, 'register_project_templates' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'load_theme_overwrites' ) );

			$this->add_support_for_elementor();
		}

		/**
		 * Adds our template to the page dropdown
		 *
		 * @param $templates
		 *
		 * @return array
		 */
		public function add_pages_in_dropdown( $templates ) {
			$templates = array_merge( $templates, $this->templates );
			return $templates;
		}

		/**
		 * Hook into the page view and change the page template path if the selected page template
		 * comes from our library
		 */
		public function redirect_page_template( $template ) {
			global $post;

			if ( empty( $post ) ) {
				return $template;
			}

			$current_template = get_post_meta( $post->ID, '_wp_page_template', true );

			if ( empty( $this->templates[ $current_template ] ) ) {
				return $template;
			}

			$file = plugin_dir_path( __FILE__ ) . $current_template;

			// Just to be safe, we check if the file exist first
			if ( file_exists( $file ) ) {
				return $file;
			}

			return $template;
		}

		/**
		 * Adds our template to the pages cache in order to trick WordPress
		 * into thinking the template file exists where it doesn't really exist.
		 */
		public function register_project_templates( $atts ) {

			// Create the key used for the themes cache
			$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

			// Retrieve the cache list.
			// If it doesn't exist, or it's empty prepare an array
			$templates = wp_get_theme()->get_page_templates();
			if ( empty( $templates ) ) {
				$templates = array();
			}

			// New cache, therefore remove the old one
			wp_cache_delete( $cache_key, 'themes' );

			// Now add our template to the list of templates by merging our templates
			// with the existing templates array from the cache.
			$templates = array_merge( $templates, $this->templates );

			// Add the modified cache to allow WordPress to pick it up for listing
			// available templates
			wp_cache_add( $cache_key, $templates, 'themes', 1800 );

			return $atts;
		}

		/**
		 * Enqueue CSS for active theme.
		 *
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_theme_overwrites() {
			$theme    = get_option( 'template' );
			$style_filename = plugin_dir_path( __FILE__ ) . 'themes/' . $theme . '/inline-style.php';
			if ( file_exists( $style_filename ) ) {
				include_once( $style_filename );
			}

			$func_filename = plugin_dir_path( __FILE__ ) . 'themes/' . $theme . '/functions.php';
			if ( file_exists( $func_filename ) ) {
				include_once( $func_filename );
			}
		}
		public function is_elementor(){
			if ( defined( 'ELEMENTOR_PATH' ) && class_exists( 'Elementor\Widget_Base' ) ) {
				return true;
			}
			return false;
		}
		/**
		 * Add support for Elementor and call the class
		 */
		public function add_support_for_elementor(){

			// We check if the Elementor plugin has been installed / activated.
			if( $this->is_elementor()){
				require_once( dirname( __FILE__ ) . '/builders/class-elementor-full-width-templates.php' );
				FullWidthTemplates\Elementor::instance();
				return;
			}

			require_once( dirname( __FILE__ ) . '/builders/class-none-full-width-templates.php' );
			FullWidthTemplates\None::instance();
			return;
		}

		/**
		 * @static
		 * @since 1.0.0
		 * @access public
		 * @return FullWidthTemplates
		 */
		public static function instance() {
			if (  null === self::$instance  ) {
				self::$instance = new self();
				self::$instance->init();
			}

			return self::$instance;
		}

		/**
		 * Throw error on object clone
		 *
		 * The whole idea of the singleton design pattern is that there is a single
		 * object therefore, we don't want the object to be cloned.
		 *
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'themeisle-companion' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class
		 *
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'themeisle-companion' ), '1.0.0' );
		}
	}
}