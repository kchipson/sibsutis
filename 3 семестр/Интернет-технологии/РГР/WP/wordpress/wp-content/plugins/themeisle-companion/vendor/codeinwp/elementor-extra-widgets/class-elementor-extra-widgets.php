<?php
/**
 * Class ThemeIsle\ElementorExtraWidgets
 *
 * @package     ThemeIsle\ElementorExtraWidgets
 * @copyright   Copyright (c) 2017, Andrei Lupu
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */

namespace ThemeIsle;

use Elementor\Plugin;

if ( ! class_exists( '\ThemeIsle\ElementorExtraWidgets' ) ) {

	class ElementorExtraWidgets {
		/**
		 * @var ElementorExtraWidgets
		 */
		public static $instance = null;

		/**
		 * The version of this library
		 * @var string
		 */
		public static $version = '1.0.3';

		/**
		 * Defines the library behaviour
		 */
		protected function init() {

			add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'register_styles' ) );
			add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_scripts' ] );

			add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_category' ) );

			add_action( 'widgets_init', array( $this, 'register_woo_widgets' ) );
			add_action( 'widgets_init', array( $this, 'register_posts_widgets' ) );

			add_action( 'elementor/widgets/widgets_registered', array( $this, 'add_elementor_widgets' ) );
			if ( ! defined( 'EAW_PRO_VERSION' ) ) {
				add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'enqueue_sidebar_css' ) );
			}
		}

		/**
		 * Add the Category for Orbit Fox Widgets.
		 *
		 * @param \Elementor\Elements_Manager $elements_manager Elementor elements manager.
		 */
		public function add_elementor_category( $elements_manager ) {

			$category_args = apply_filters( 'elementor_extra_widgets_category_args', array(
				'slug'  => 'obfx-elementor-widgets',
				'title' => __( 'Orbit Fox Addons', 'themeisle-companion' ),
				'icon'  => 'fa fa-plug',
			) );

			// add a separate category for the premium widgets
			$elements_manager->add_category(
				$category_args['slug'] . '-pro',
				array(
					'title' => 'Premium ' . $category_args['title'],
					'icon'  => $category_args['slug'],
				)
			);

			$elements_manager->add_category(
				$category_args['slug'],
				array(
					'title' => $category_args['title'],
					'icon'  => $category_args['slug'],
				)
			);
		}

		/**
		 * Register style.
		 */
		public function register_styles() {
			wp_register_style( 'eaw-elementor', plugins_url( '/css/public.css', __FILE__ ), array(), $this::$version );
			wp_register_style( 'font-awesome-5-all', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.min.css', false, $this::$version );
		}

		/**
		 * Register js scripts.
		 */
		public function register_scripts() {
			wp_register_script( 'obfx-grid-js', plugins_url( '/js/obfx-grid.js', __FILE__ ), array(), $this::$version, true );
		}

		public function enqueue_sidebar_css() {
			wp_enqueue_style( 'eaw-elementor-admin', plugins_url( '/css/admin.css', __FILE__ ), array(), $this::$version );
		}
		/**
		 * Require and instantiate Elementor Widgets and Premium Placeholders.
		 *
		 * @param $widgets_manager
		 */
		public function add_elementor_widgets( $widgets_manager ) {
			$elementor_widgets = $this->get_dir_files( __DIR__ . '/widgets/elementor' );

			foreach ( $elementor_widgets as $widget ) {
				require_once $widget;

				$widget = basename( $widget, ".php" );

				if ( $widget === 'premium-placeholder' ) {// avoid instantiate an abstract class
					continue;
				}

				$classname = $this->convert_filename_to_classname( $widget );

				if ( class_exists( $classname ) ) {
					$widget_object = new $classname();
					$widgets_manager->register_widget_type( $widget_object );
				}
			}

			if ( apply_filters( 'eaw_should_load_placeholders', false ) ) {
				$placeholders = $this->get_dir_files( __DIR__ . '/widgets/elementor/placeholders' );
				foreach ( $placeholders as $widget ) {
					require_once $widget;
				}

				do_action( 'eaw_before_pro_widgets', $placeholders, $widgets_manager );

				foreach ( $placeholders as $widget ) {
					$widget = basename( $widget, ".php" );

					$classname = $this->convert_filename_to_classname( $widget );

					// Maybe Premium Elements
					if ( ! class_exists( $classname ) ) {
						$classname = $classname . '_Placeholder';
					}

					if ( class_exists( $classname ) ) {
						$widget_object = new $classname();
						$widgets_manager->register_widget_type( $widget_object );
					}
				}
			}
		}

		/**
		 * WooCommerce Widget section
		 *
		 * @since   1.0.0
		 * @return  void
		 */
		public function register_woo_widgets() {
			if ( ! class_exists( 'woocommerce' ) ) { // Lets not do anything unless WooCommerce is active!
				return null;
			}

			include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/class-eaw-wp-widget.php' );
			include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/products-categories.php' );
			include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/recent-products.php' );
			include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/featured-products.php' );
			include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/popular-products.php' );
			include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/sale-products.php' );
			include_once( plugin_dir_path( __FILE__ ) . 'widgets/woo/best-products.php' );

			register_widget( 'Woo_Product_Categories' );
			register_widget( 'Woo_Recent_Products' );
			register_widget( 'Woo_Featured_Products' );
			register_widget( 'Woo_Popular_Products' );
			register_widget( 'Woo_Sale_Products' );
			register_widget( 'Woo_Best_Products' );
		}

		/**
		 * Posts Widget section
		 *
		 * @since   1.0.0
		 * @return  void
		 */
		public function register_posts_widgets() {
			include_once( plugin_dir_path( __FILE__ ) . 'widgets/wp/eaw-posts-widget.php' );
			register_widget( 'EAW_Recent_Posts' );

			include_once( plugin_dir_path( __FILE__ ) . 'widgets/wp/eaw-posts-widget-plus.php' );
			register_widget( 'EAW_Recent_Posts_Plus' );
		}

		/**
		 * Returns an array of all PHP files in the specified absolute path.
		 * Inspired from jetpack's glob_php
		 *
		 * @param string $absolute_path The absolute path of the directory to search.
		 *
		 * @return array Array of absolute paths to the PHP files.
		 */
		protected function get_dir_files( $absolute_path ) {
			if ( function_exists( 'glob' ) ) {
				return glob( "$absolute_path/*.php" );
			}

			$absolute_path = untrailingslashit( $absolute_path );
			$files         = array();
			if ( ! $dir = @opendir( $absolute_path ) ) {
				return $files;
			}

			while ( false !== $file = readdir( $dir ) ) {
				if ( '.' == substr( $file, 0, 1 ) || '.php' != substr( $file, - 4 ) ) {
					continue;
				}

				$file = "$absolute_path/$file";

				if ( ! is_file( $file ) ) {
					continue;
				}

				$files[] = $file;
			}

			closedir( $dir );

			return $files;
		}

		protected function convert_filename_to_classname( $widget ) {
			$classname = ucwords( $widget, "-" );
			$classname = str_replace( '-', '_', $classname );
			$classname = '\\ThemeIsle\\ElementorExtraWidgets\\' . $classname;

			return $classname;
		}

		/**
		 *
		 * @static
		 * @since 1.0.0
		 * @access public
		 * @return ElementorExtraWidgets
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
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
