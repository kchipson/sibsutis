<?php
/**
 * The factory logic for creating modules for plugin.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Orbit_Fox
 * @subpackage Orbit_Fox/app
 */

/**
 * The class responsible for instantiating new OBFX_Module classes.
 *
 * @package    Orbit_Fox
 * @subpackage Orbit_Fox/app
 * @author     Themeisle <friends@themeisle.com>
 */
class Orbit_Fox_Module_Factory {

	/**
	 * The build method for creating a new OBFX_Module class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @param   string $module_name The name of the module to instantiate.
	 * @return mixed
	 * @throws Exception Thrown if no module class exists for provided $module_name.
	 */
	public static function build( $module_name ) {
		$module = str_replace( '-', '_', ucwords( $module_name ) ) . '_OBFX_Module';
		if ( class_exists( $module ) ) {
			return new $module;
		}
		// @codeCoverageIgnoreStart
		throw new Exception( 'Invalid module name given.' );
		// @codeCoverageIgnoreEnd
	}
}
