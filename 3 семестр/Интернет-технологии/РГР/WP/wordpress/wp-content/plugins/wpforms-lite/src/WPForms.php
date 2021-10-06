<?php

namespace WPForms {

	/**
	 * Main WPForms class.
	 *
	 * @since 1.0.0
	 *
	 * @package WPForms
	 */
	final class WPForms {

		/**
		 * One is the loneliest number that you'll ever do.
		 *
		 * @since 1.0.0
		 *
		 * @var \WPForms\WPForms
		 */
		private static $instance;

		/**
		 * Plugin version for enqueueing, etc.
		 * The value is got from WPFORMS_VERSION constant.
		 *
		 * @since 1.0.0
		 *
		 * @var string
		 */
		public $version = '';

		/**
		 * The form data handler instance.
		 *
		 * @since 1.0.0
		 *
		 * @var \WPForms_Form_Handler
		 */
		public $form;

		/**
		 * The entry data handler instance (Pro).
		 *
		 * @since 1.0.0
		 *
		 * @var \WPForms_Entry_Handler
		 */
		public $entry;

		/**
		 * The entry fields data handler instance (Pro).
		 *
		 * @since 1.4.3
		 *
		 * @var \WPForms_Entry_Fields_Handler
		 */
		public $entry_fields;

		/**
		 * The entry meta data handler instance (Pro).
		 *
		 * @since 1.1.6
		 *
		 * @var \WPForms_Entry_Meta_Handler
		 */
		public $entry_meta;

		/**
		 * The front-end instance.
		 *
		 * @since 1.0.0
		 *
		 * @var \WPForms_Frontend
		 */
		public $frontend;

		/**
		 * The process instance.
		 *
		 * @since 1.0.0
		 *
		 * @var \WPForms_Process
		 */
		public $process;

		/**
		 * The smart tags instance.
		 *
		 * @since 1.0.0
		 *
		 * @var \WPForms_Smart_Tags
		 */
		public $smart_tags;

		/**
		 * The Logging instance.
		 *
		 * @since 1.0.0
		 *
		 * @var \WPForms_Logging
		 */
		public $logs;

		/**
		 * The License class instance (Pro).
		 *
		 * @since 1.0.0
		 *
		 * @var \WPForms_License
		 */
		public $license;

		/**
		 * Classes registry.
		 *
		 * @since 1.5.7
		 *
		 * @var array
		 */
		private $registry = array();

		/**
		 * Paid returns true, free (Lite) returns false.
		 *
		 * @since 1.3.9
		 *
		 * @var boolean
		 */
		public $pro = false;

		/**
		 * Backward compatibility method for accessing the class registry in an old way
		 * e.g. 'wpforms()->form' or 'wpforms()->entry'
		 *
		 * @since 1.5.7
		 *
		 * @param string $name Name of the object to get.
		 *
		 * @return mixed|null
		 */
		public function __get( $name ) {

			return $this->get( $name );
		}

		/**
		 * Main WPForms Instance.
		 *
		 * Insures that only one instance of WPForms exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @since 1.0.0
		 *
		 * @return WPForms
		 */
		public static function instance() {

			if (
				null === self::$instance ||
				! self::$instance instanceof self
			) {

				self::$instance = new self();
				self::$instance->constants();
				self::$instance->includes();

				// Load Pro or Lite specific files.
				if ( self::$instance->pro ) {
					require_once WPFORMS_PLUGIN_DIR . 'pro/wpforms-pro.php';
				} else {
					require_once WPFORMS_PLUGIN_DIR . 'lite/wpforms-lite.php';
				}

				add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ), 10 );
				add_action( 'plugins_loaded', array( self::$instance, 'objects' ), 10 );
			}

			return self::$instance;
		}

		/**
		 * Setup plugin constants.
		 * All the path/URL related constants are defined in main plugin file.
		 *
		 * @since 1.0.0
		 */
		private function constants() {

			$this->version = WPFORMS_VERSION;

			// Plugin Slug - Determine plugin type and set slug accordingly.
			if ( apply_filters( 'wpforms_allow_pro_version', file_exists( WPFORMS_PLUGIN_DIR . 'pro/wpforms-pro.php' ) ) ) {
				$this->pro = true;
				define( 'WPFORMS_PLUGIN_SLUG', 'wpforms' );
			} else {
				define( 'WPFORMS_PLUGIN_SLUG', 'wpforms-lite' );
			}
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @since 1.0.0
		 * @since 1.5.0 Load only the lite translation.
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'wpforms-lite', false, dirname( plugin_basename( WPFORMS_PLUGIN_FILE ) ) . '/languages/' );
		}

		/**
		 * Include files.
		 *
		 * @since 1.0.0
		 */
		private function includes() {

			$this->includes_magic();

			// Global includes.
			require_once WPFORMS_PLUGIN_DIR . 'includes/functions.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/functions-list.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/class-install.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/class-form.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/class-fields.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/class-frontend.php';
			// TODO: class-templates.php should be loaded in admin area only.
			require_once WPFORMS_PLUGIN_DIR . 'includes/class-templates.php';
			// TODO: class-providers.php should be loaded in admin area only.
			require_once WPFORMS_PLUGIN_DIR . 'includes/class-providers.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/class-process.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/class-smart-tags.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/class-logging.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/class-widget.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/class-conditional-logic-core.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/emails/class-emails.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/integrations.php';
			require_once WPFORMS_PLUGIN_DIR . 'includes/deprecated.php';

			// Admin/Dashboard only includes, also in ajax.
			if ( is_admin() ) {
				require_once WPFORMS_PLUGIN_DIR . 'includes/admin/admin.php';
				require_once WPFORMS_PLUGIN_DIR . 'includes/admin/class-notices.php';
				require_once WPFORMS_PLUGIN_DIR . 'includes/admin/class-menu.php';
				require_once WPFORMS_PLUGIN_DIR . 'includes/admin/overview/class-overview.php';
				require_once WPFORMS_PLUGIN_DIR . 'includes/admin/builder/class-builder.php';
				require_once WPFORMS_PLUGIN_DIR . 'includes/admin/builder/functions.php';
				require_once WPFORMS_PLUGIN_DIR . 'includes/admin/class-settings.php';
				require_once WPFORMS_PLUGIN_DIR . 'includes/admin/class-welcome.php';
				require_once WPFORMS_PLUGIN_DIR . 'includes/admin/class-tools.php';
				require_once WPFORMS_PLUGIN_DIR . 'includes/admin/class-editor.php';
				require_once WPFORMS_PLUGIN_DIR . 'includes/admin/class-review.php';
				require_once WPFORMS_PLUGIN_DIR . 'includes/admin/class-importers.php';
				require_once WPFORMS_PLUGIN_DIR . 'includes/admin/class-about.php';
				require_once WPFORMS_PLUGIN_DIR . 'includes/admin/ajax-actions.php';
				require_once WPFORMS_PLUGIN_DIR . 'includes/admin/class-am-deactivation-survey.php';
			}
		}

		/**
		 * Including the new files with PHP 5.3 style.
		 *
		 * @since 1.4.7
		 */
		private function includes_magic() {

			// Autoload Composer packages.
			require_once WPFORMS_PLUGIN_DIR . 'vendor/autoload.php';

			if ( version_compare( phpversion(), '5.5', '>=' ) ) {
				/*
				 * Load PHP 5.5 email subsystem.
				 */
				add_action( 'wpforms_loaded', array( '\WPForms\Emails\Summaries', 'get_instance' ) );
			}

			/*
			 * Load admin components. Exclude from frontend.
			 */
			if ( is_admin() ) {
				add_action( 'wpforms_loaded', array( '\WPForms\Admin\Loader', 'get_instance' ) );
			}

			/*
			 * Load form components.
			 */
			add_action( 'wpforms_loaded', array( '\WPForms\Forms\Loader', 'get_instance' ) );

			/*
			 * Properly init the providers loader, that will handle all the related logic and further loading.
			 */
			add_action( 'wpforms_loaded', array( '\WPForms\Providers\Loader', 'get_instance' ) );

			/*
			 * Properly init the integrations loader, that will handle all the related logic and further loading.
			 */
			add_action( 'wpforms_loaded', array( '\WPForms\Integrations\Loader', 'get_instance' ) );
		}

		/**
		 * Setup objects.
		 *
		 * @since 1.0.0
		 */
		public function objects() {

			// Global objects.
			$this->form       = new \WPForms_Form_Handler();
			$this->frontend   = new \WPForms_Frontend();
			$this->process    = new \WPForms_Process();
			$this->smart_tags = new \WPForms_Smart_Tags();
			$this->logs       = new \WPForms_Logging();

			if ( is_admin() ) {
				if ( $this->pro || ( ! $this->pro && ! file_exists( WP_PLUGIN_DIR . '/wpforms/wpforms.php' ) ) ) {
					new \AM_Deactivation_Survey( 'WPForms', basename( dirname( __DIR__ ) ) );
				}
			}

			// Hook now that all of the WPForms stuff is loaded.
			do_action( 'wpforms_loaded' );
		}

		/**
		 * Register a class.
		 *
		 * @since 1.5.7
		 *
		 * @param string $class_name Class to register.
		 * @param array  $args       Class registration options.
		 */
		public function register( $class_name, $args = array() ) {

			if ( empty( $class_name ) ) {
				return;
			}

			if ( isset( $args['condition'] ) && empty( $args['condition'] ) ) {
				return;
			}

			$full_name = $this->pro ? '\WPForms\Pro\\' . $class_name : '\WPForms\Lite\\' . $class_name;
			$full_name = class_exists( $full_name ) ? $full_name : '\WPForms\\' . $class_name;

			if ( ! class_exists( $full_name ) ) {
				return;
			}

			$pattern  = '/[^a-zA-Z0-9_\\\-]/';
			$id       = isset( $args['id'] ) ? $args['id'] : '';
			$id       = $id ? preg_replace( $pattern, '', (string) $id ) : $id;
			$hook     = isset( $args['hook'] ) ? $args['hook'] : 'wpforms_loaded';
			$hook     = $hook ? preg_replace( $pattern, '', (string) $hook ) : $hook;
			$run      = isset( $args['run'] ) ? $args['run'] : 'init';
			$priority = isset( $args['priority'] ) && is_int( $args['priority'] ) ? $args['priority'] : 10;

			$callback = function () use ( $full_name, $id, $run ) {

				$instance = new $full_name();
				if ( $id && ! array_key_exists( $id, $this->registry ) ) {
					$this->registry[ $id ] = $instance;
				}
				if ( $run && method_exists( $instance, $run ) ) {
					$instance->{$run}();
				}
			};

			if ( $hook ) {
				add_action( $hook, $callback, $priority );
			} else {
				$callback();
			}
		}

		/**
		 * Register classes in bulk.
		 *
		 * @since 1.5.7
		 *
		 * @param array $classes Classes to register.
		 */
		public function register_bulk( $classes ) {

			if ( ! is_array( $classes ) ) {
				return;
			}

			foreach ( $classes as $class_name => $args ) {
				$this->register( $class_name, $args );
			}
		}

		/**
		 * Get a class instance from a registry.
		 *
		 * @since 1.5.7
		 *
		 * @param string $name Class name or an alias.
		 *
		 * @return mixed|null
		 */
		public function get( $name ) {

			if ( ! empty( $this->registry[ $name ] ) ) {
				return $this->registry[ $name ];
			}

			return null;
		}
	}
}

namespace {

	/**
	 * The function which returns the one WPForms instance.
	 *
	 * @since 1.0.0
	 *
	 * @return WPForms\WPForms
	 */
	function wpforms() {
		return WPForms\WPForms::instance();
	}

	/**
	 * Adding an alias for backward-compatibility with plugins
	 * that still use class_exists('WPForms')
	 * instead of function_exists('wpforms'), which is preferred.
	 *
	 * In 1.5.0 we removed support for PHP 5.2
	 * and moved former WPForms class to a namespace: WPForms\WPForms.
	 *
	 * @since 1.5.1
	 */
	class_alias( 'WPForms\WPForms', 'WPForms' );
}
