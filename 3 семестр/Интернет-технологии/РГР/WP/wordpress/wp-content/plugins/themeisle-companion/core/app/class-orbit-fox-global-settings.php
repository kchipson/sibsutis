<?php
/**
 * The global settings of the plugin.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Orbit_Fox
 * @subpackage Orbit_Fox/app
 */

/**
 * The global settings of the plugin.
 *
 * Defines the plugin global settings instance and modules.
 *
 * @package    Orbit_Fox
 * @subpackage Orbit_Fox/app
 * @author     Themeisle <friends@themeisle.com>
 */
class Orbit_Fox_Global_Settings {

	/**
	 * The main instance var.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     Orbit_Fox_Global_Settings $instance The instance of this class.
	 */
	public static $instance;

	/**
	 * Stores the default modules data.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     array $modules Modules List.
	 */
	public $modules = array();

	/**
	 * Stores an array of module objects.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     array $module_objects Stores references to modules Objects.
	 */
	public $module_objects = array();

	/**
	 * The instance method for the static class.
	 * Defines and returns the instance of the static class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return Orbit_Fox_Global_Settings
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Orbit_Fox_Global_Settings ) ) {
			self::$instance          = new Orbit_Fox_Global_Settings;
			self::$instance->modules = apply_filters(
				'obfx_modules',
				array(
					'social-sharing',
					'gutenberg-blocks',
					'uptime-monitor',
					'google-analytics',
					'companion-legacy',
					'elementor-widgets',
					'template-directory',
					'menu-icons',
					'mystock-import',
					'policy-notice',
					'beaver-widgets',
					'image-cdn',
				)
			);
		}// End if().

		return self::$instance;
	}

	/**
	 * Registers a module object reference in the $module_objects array.
	 *
	 * @since   1.0.0
	 * @access  public
	 *
	 * @param   string                    $name The name of the module from $modules array.
	 * @param   Orbit_Fox_Module_Abstract $module The module object.
	 */
	public function register_module_reference( $name, Orbit_Fox_Module_Abstract $module ) {
		self::$instance->module_objects[ $name ] = $module;
	}

	/**
	 * Method to retrieve instance of modules.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public function get_modules() {
		return self::instance()->modules;
	}

	/**
	 * Method to destroy singleton.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public static function destroy_instance() {
		static::$instance = null;
	}
}
