<?php
/**
 * Beaver Builder modules Orbit Fox Module.
 *
 * @link       https://themeisle.com
 * @since      2.2.5
 */

use ThemeIsle\ContentForms\Form_Manager;

define( 'BEAVER_WIDGETS_PATH', plugin_dir_path( __FILE__ ) );
define( 'BEAVER_WIDGETS_URL', plugins_url( '/', __FILE__ ) );

/**
 * Class Beaver_Widgets_OBFX_Module
 */
class Beaver_Widgets_OBFX_Module extends Orbit_Fox_Module_Abstract {

	/**
	 * Beaver_Widgets_OBFX_Module constructor.
	 *
	 * @since   2.2.5
	 * @access  public
	 */
	public function __construct() {
		parent::__construct();
		$this->name        = __( 'Page builder widgets', 'themeisle-companion' );
		$this->description = __( 'Adds widgets to the most popular builders: Elementor or Beaver. More to come!', 'themeisle-companion' );
		$this->active_default = true;
	}

	/**
	 * Determine if module should be loaded.
	 *
	 * @since   2.2.5
	 * @access  public
	 * @return bool
	 */
	public function enable_module() {
		require_once( ABSPATH . 'wp-admin' . '/includes/plugin.php' );
		return is_plugin_active( 'beaver-builder-lite-version/fl-builder.php' ) || is_plugin_active('bb-plugin/fl-builder.php');
	}

	/**
	 * The loading logic for the module.
	 *
	 * @since   2.2.5
	 * @access  public
	 */
	public function load() {
	}

	/**
	 * Method to define hooks needed.
	 *
	 * @since   2.2.5
	 * @access  public
	 */
	public function hooks() {
		$this->loader->add_action( 'init', $this, 'load_content_forms' );
		$this->loader->add_action( 'init', $this, 'load_widgets_modules' );
	}

	/**
	 * Method that returns an array of scripts and styles to be loaded
	 * for the front end part.
	 *
	 * @since   2.2.5
	 * @access  public
	 * @return array
	 */
	public function public_enqueue() {
		return array();
	}

	/**
	 * Method that returns an array of scripts and styles to be loaded
	 * for the admin part.
	 *
	 * @since   2.2.5
	 * @access  public
	 * @return array
	 */
	public function admin_enqueue() {
		return array();
	}

	/**
	 * Method to define the options fields for the module
	 *
	 * @since   2.2.5
	 * @access  public
	 * @return array
	 */
	public function options() {
		return array();
	}

	/**
	 * If the content-forms library is available we should make the forms available for elementor
	 */
	public function load_content_forms() {
		if ( ! class_exists( '\ThemeIsle\ContentForms\Form_Manager' ) ) {
			return false;
		}
		$content_forms = new Form_Manager();
		$content_forms->instance();

		return true;
	}
	/**
	 * Require Beaver Builder modules
	 *
	 * @since   2.2.5
	 * @access  public
	 */
	public function load_widgets_modules(){
		if ( class_exists( 'FLBuilder' ) ) {
			require_once 'modules/pricing-table/pricing-table.php';
			require_once 'modules/services/services.php';
			require_once 'modules/post-grid/post-grid.php';
		}
	}
}
