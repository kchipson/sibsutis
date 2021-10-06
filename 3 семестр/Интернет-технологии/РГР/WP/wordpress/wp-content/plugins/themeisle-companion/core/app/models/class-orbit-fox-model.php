<?php
/**
 * The core model class for Orbit Fox.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Orbit_Fox
 * @subpackage Orbit_Fox/app/models
 */

/**
 * The class that defines a model for interacting with data.
 * Provides utility methods for saving and retrieving data.
 *
 * @package    Orbit_Fox
 * @subpackage Orbit_Fox/app/models
 * @author     Themeisle <friends@themeisle.com>
 */
class Orbit_Fox_Model {

	/**
	 * The model namespace.
	 *
	 * @since   1.0.0
	 * @access  private
	 * @var     string $namespace The model namespace.
	 */
	private $namespace = 'obfx_data';

	/**
	 * Holds the core settings.
	 *
	 * @since   1.0.0
	 * @access  private
	 * @var     array $core_settings Stores the core settings.
	 */
	private $core_settings;

	/**
	 * Holds all enabled modules statuses.
	 *
	 * @since   1.0.0
	 * @access  private
	 * @var     array $module_status Stores the modules statuses.
	 */
	private $module_status;

	/**
	 * Holds all enabled modules options.
	 *
	 * @since   1.0.0
	 * @access  private
	 * @var     array $module_settings Stores the modules options.
	 */
	private $module_settings;

	/**
	 * Orbit_Fox_Model constructor.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function __construct() {
		$this->core_settings = array();
	}

	/**
	 * Defines the modules data.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @param   array $modules The modules array passed by Orbit_Fox.
	 */
	public function register_modules_data( $modules = array() ) {
		$module_status   = array();
		$module_settings = array();
		if ( ! empty( $modules ) ) {
			foreach ( $modules as $slug => $module ) {
				$is_enabled     = $module->enable_module();
				$is_auto        = $module->auto;
				$active         = false;
				$showed_notices = array();

				$module_status[ $slug ] = array(
					'enabled'        => $is_enabled,
					'autoload'       => $is_auto,
					'showed_notices' => $showed_notices,
					'active'         => $active,
				);

				$module_settings[ $slug ] = $module->get_options_defaults();
			}
		}

		$this->module_status   = $module_status;
		$this->module_settings = $module_settings;

	}

	/**
	 * Defines a default data array.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public function default_data() {
		$data = array(
			'core_settings'   => $this->core_settings,
			'module_status'   => $this->module_status,
			'module_settings' => $this->module_settings,
		);

		return $data;
	}

	/**
	 * Utility method to return the active status of a module.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @param   string  $slug The module slug.
	 * @param   boolean $default The default active state.
	 * @return bool
	 */
	public function get_is_module_active( $slug, $default ) {
		$data = $this->get();
		if ( isset( $data['module_status'][ $slug ]['active'] ) ) {
			return $data['module_status'][ $slug ]['active'];
		}
		return $default; // @codeCoverageIgnore
	}

	/**
	 * Utility method to retrieve a module option.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @param   string $slug The module slug.
	 * @param   string $key Key to lookup.
	 * @return bool
	 */
	public function get_module_option( $slug, $key ) {
		$data = $this->get();
		if ( isset( $data['module_settings'][ $slug ][ $key ] ) ) {
			return $data['module_settings'][ $slug ][ $key ];
		}
		return false;
	}

	/**
	 * Utility method to set a module option.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @param   string $slug The module slug.
	 * @param   string $key Key to lookup.
	 * @param   mixed  $value The new value.
	 * @return mixed
	 */
	public function set_module_option( $slug, $key, $value ) {
		$new                                     = array();
		$new['module_settings'][ $slug ][ $key ] = $value;
		return $this->save( $new );
	}

	/**
	 * Utility method to set batch module options.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @param   string $slug The module slug.
	 * @param   array  $options The associative options array.
	 * @return mixed
	 */
	public function set_module_options( $slug, $options = array() ) {
		$new['module_settings'][ $slug ] = $options;
		return $this->save( $new );
	}

	/**
	 * Utility method to get a module status value.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @param   string $slug The module slug.
	 * @param   string $key Key to lookup.
	 * @return bool
	 */
	public function get_module_status( $slug, $key ) {
		$data = $this->get();
		if ( isset( $data['module_status'][ $slug ][ $key ] ) ) {
			return $data['module_status'][ $slug ][ $key ];
		}
		return false; // @codeCoverageIgnore
	}

	/**
	 * Utility method to set a module status.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @param   string $slug The module slug.
	 * @param   string $key Key to lookup.
	 * @param   mixed  $value The new value.
	 * @return mixed
	 */
	public function set_module_status( $slug, $key, $value ) {
		$new                                   = array();
		$new['module_status'][ $slug ][ $key ] = $value;
		return $this->save( $new );
	}

	/**
	 * Base model method to save data to DB.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @param   array $new The new data array to be saved.
	 * @return mixed
	 */
	public function save( $new = array() ) {
		$old_data = $this->get();
		$new_data = array_replace_recursive( $old_data, $new );
		return update_option( $this->namespace, $new_data );
	}

	/**
	 * Base model method to retrieve data from DB.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return mixed
	 */
	public function get() {
		return get_option( $this->namespace, $this->default_data() );
	}

	/**
	 * Method used for resetting model and clearing the DB.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return mixed
	 */
	public function destroy_model() {
		return delete_option( $this->namespace );
	}
}
