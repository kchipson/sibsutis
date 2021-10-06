<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Orbit_Fox
 * @subpackage Orbit_Fox/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Orbit_Fox
 * @subpackage Orbit_Fox/includes
 * @author     Themeisle <friends@themeisle.com>
 */
class Orbit_Fox {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Orbit_Fox_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'orbit-fox';

		$this->version = '2.8.14';

		$this->load_dependencies();
		$this->set_locale();
		$this->prepare_modules();
		$this->define_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Orbit_Fox_Loader. Orchestrates the hooks of the plugin.
	 * - Orbit_Fox_i18n. Defines internationalization functionality.
	 * - Orbit_Fox_Admin. Defines all hooks for the admin area.
	 * - Orbit_Fox_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		$this->loader = new Orbit_Fox_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Orbit_Fox_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Orbit_Fox_I18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Check Modules and register them.
	 *
	 * @since   1.0.0
	 * @access  private
	 */
	private function prepare_modules() {
		$global_settings = new Orbit_Fox_Global_Settings();
		$modules_to_load = $global_settings->instance()->get_modules();
		$obfx_model      = new Orbit_Fox_Model();

		$module_factory = new Orbit_Fox_Module_Factory();
		foreach ( $modules_to_load as $module_name ) {
			$module = $module_factory::build( $module_name );
			$global_settings->register_module_reference( $module_name, $module );
			if ( $module->enable_module() ) {
				$module->register_loader( $this->get_loader() );
				$module->register_model( $obfx_model );
				if ( $module->get_is_active() ) {
					$module->set_enqueue( $this->get_version() ); // @codeCoverageIgnore
					$module->hooks(); // @codeCoverageIgnore
				}
				$this->loader->add_action( 'orbit_fox_modules', $module, 'load' );
			}
		}
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Orbit_Fox_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Register all of the hooks related to the functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_hooks() {

		$plugin_admin = new Orbit_Fox_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_init', $plugin_admin, 'load_modules' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'visit_dashboard_notice_dismiss' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'menu_pages' );
		$this->loader->add_action( 'admin_notices', $plugin_admin, 'visit_dashboard_notice' );
		$this->loader->add_action( 'obfx_recommended_plugins', $plugin_admin, 'load_recommended_plugins' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'load_recommended_partners' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_ajax_obfx_update_module_options', $plugin_admin, 'obfx_update_module_options' );
		$this->loader->add_action( 'wp_ajax_obfx_update_module_active_status', $plugin_admin, 'obfx_update_module_active_status' );

		$plugin_public = new Orbit_Fox_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_action( 'init', Orbit_Fox_Neve_Dropin::instance(), 'init' );

		// Fix update checks on themeisle.com for non-premium themes
		add_filter( 'neve_enable_licenser', '__return_false' );
		add_filter( 'hestia_enable_licenser', '__return_false' );
		add_filter( 'orfeo_enable_licenser', '__return_false' );
		add_filter( 'fagri_enable_licenser', '__return_false' );
		add_filter( 'capri_lite_enable_licenser', '__return_false' );
		add_filter( 'belise_lite_enable_licenser', '__return_false' );
		add_filter( 'themotion_lite_enable_licenser', '__return_false' );
		add_filter( 'capri_lite_enable_licenser', '__return_false' );
		add_filter( 'visualizer_enable_licenser', '__return_false' );
		add_filter( 'wp_product_review_enable_licenser', '__return_false' );
		add_filter( 'feedzy_rss_feeds_licenser', '__return_false' );

	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

}
