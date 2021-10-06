<?php
/**
 * The abstract class for Orbit Fox Modules.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Orbit_Fox
 * @subpackage Orbit_Fox/app/abstract
 */

/**
 * The class that defines the required methods and variables needed by a OBFX_Module.
 *
 * @package    Orbit_Fox
 * @subpackage Orbit_Fox/app/abstract
 * @author     Themeisle <friends@themeisle.com>
 */
abstract class Orbit_Fox_Module_Abstract {

	/**
	 * Holds the name of the module
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     string $name The name of the module.
	 */
	public $name;
	/**
	 * Holds the description of the module
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     string $description The description of the module.
	 */
	public $description;
	/**
	 * Confirm intent array. It should contain a title and a subtitle for the confirm intent modal.
	 *
	 * @since   2.4.1
	 * @access  public
	 * @var     array $confirm_intent Stores an array of the modal with 'title' and 'subtitle' keys.
	 */
	public $confirm_intent = array();
	/**
	 * Flags if module should autoload.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     bool $auto The flag for automatic activation.
	 */
	public $auto = false;
	/**
	 * Flags module should have the section open.
	 *
	 * @since   2.5.0
	 * @access  public
	 * @var     bool $show The flag for section opened.
	 */
	public $show = false;
	/**
	 * Holds the module slug.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     string $slug The module slug.
	 */
	protected $slug;
	/**
	 * Holds the default setting activation state of the module.
	 *
	 * @since   2.1.0
	 * @access  protected
	 * @var     boolean $active_default The default active state of the module.
	 */
	protected $active_default = false;
	/**
	 * Stores an array of notices
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     array $notices Stores an array of notices to be displayed on the admin panel.
	 */
	protected $notices = array();
	/**
	 * Has an instance of the Orbit_Fox_Loader class used for adding actions and filters.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     Orbit_Fox_Loader $loader A instance of Orbit_Fox_Loader.
	 */
	protected $loader;

	/**
	 * Has an instance of the Orbit_Fox_Model class used for interacting with DB data.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     Orbit_Fox_Model $model A instance of Orbit_Fox_Model.
	 */
	protected $model;

	/**
	 * Stores the curent version of Orbit fox for use during the enqueue.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     string $version The current version of Orbit Fox.
	 */
	protected $version;

	/**
	 * Enable module in beta mode..
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     boolean $beta Is module in beta.
	 */
	public $beta;

	/**
	 * Module needs save buttons.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     boolean $no_save Should we show the save buttons.
	 */
	public $no_save = false;

	/**
	 * Stores the localized arrays for both public and admin JS files that need to be loaded.
	 *
	 * @access  protected
	 * @var     array $localized The localized arrays for both public and admin JS files that need to be loaded.
	 */
	protected $localized = array();

	/**
	 * Orbit_Fox_Module_Abstract constructor.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function __construct() {
		$this->slug = str_replace( '_', '-', strtolower( str_replace( '_OBFX_Module', '', get_class( $this ) ) ) );
	}

	/**
	 * Registers the loader.
	 * And setup activate and deactivate hooks. Added in v2.3.3.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @updated 2.3.3
	 * @access  public
	 *
	 * @param Orbit_Fox_Loader $loader The loader class used to register action hooks and filters.
	 */
	public function register_loader( Orbit_Fox_Loader $loader ) {
		$this->loader = $loader;
		$this->loader->add_action( $this->get_slug() . '_activate', $this, 'activate' );
		$this->loader->add_action( $this->get_slug() . '_deactivate', $this, 'deactivate' );
	}

	/**
	 * Getter method for slug.
	 *
	 * @since   2.3.3
	 * @access  public
	 * @return mixed|string
	 */
	public function get_slug() {
		return $this->slug;
	}

	/**
	 * Registers the loader.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 *
	 * @param Orbit_Fox_Model $model The loader class used to register action hooks and filters.
	 */
	public function register_model( Orbit_Fox_Model $model ) {
		$this->model = $model;
	}

	/**
	 * Method to return the notices array
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public function get_notices() {
		return $this->notices;
	}

	/**
	 * Utility method to updated showed notices array.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function update_showed_notices() {
		$showed_notices = $this->get_status( 'showed_notices' );
		// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
		if ( $showed_notices == false ) {
			$showed_notices = array();
		}
		foreach ( $this->notices as $notice ) {
			// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
			if ( $notice['display_always'] == false ) {
				$hash = md5( serialize( $notice ) );
				if ( ! in_array( $hash, $showed_notices, true ) ) {
					$showed_notices[] = $hash;
				}
			}
		}
		$this->set_status( 'showed_notices', $showed_notices );
	}

	/**
	 * Method to retrieve from model the module status for
	 * the provided key.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 *
	 * @param   string $key Key to look for.
	 *
	 * @return bool
	 */
	final public function get_status( $key ) {
		return $this->model->get_module_status( $this->slug, $key );
	}

	/**
	 * Method to update in model the module status for
	 * the provided key value pair.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 *
	 * @param   string $key Key to update.
	 * @param   string $value The new value.
	 *
	 * @return mixed
	 */
	final public function set_status( $key, $value ) {
		return $this->model->set_module_status( $this->slug, $key, $value );
	}

	/**
	 * Method to determine if the module is enabled or not.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return bool
	 */
	public abstract function enable_module();

	/**
	 * The method for the module load logic.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return mixed
	 */
	public abstract function load();

	/**
	 * Method to define actions and filters needed for the module.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public abstract function hooks();

	/**
	 * Method to check if module status is active.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return bool
	 */
	final public function get_is_active() {
		if ( $this->auto === true ) {
			return true;
		}
		if ( ! isset( $this->model ) ) {
			return false;
		}
		return $this->model->get_is_module_active( $this->slug, $this->active_default );
	}

	/**
	 * Method to update an option key value pair.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 *
	 * @param   string $key The key name.
	 * @param   string $value The new value.
	 *
	 * @return mixed
	 */
	final public function set_option( $key, $value ) {
		if ( ! isset( $this->model ) ) {
			return false;
		}
		return $this->model->set_module_option( $this->slug, $key, $value );
	}

	/**
	 * Stub for activate hook.
	 *
	 * @since   2.3.3
	 * @access  public
	 */
	public function activate() {
	}

	/**
	 * Stub for deactivate hook.
	 *
	 * @since   2.3.3
	 * @access  public
	 */
	public function deactivate() {
	}

	/**
	 * Method to update a set of options.
	 * Added in v2.3.3 actions for before and after options save.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @updated 2.3.3
	 * @access  public
	 *
	 * @param   array $options An associative array of options to be
	 *                         updated. Eg. ( 'key' => 'new_value' ).
	 *
	 * @return mixed
	 */
	final public function set_options( $options ) {
		do_action( $this->get_slug() . '_before_options_save', $options );
		$result = $this->model->set_module_options( $this->slug, $options );
		do_action( $this->get_slug() . '_after_options_save' );

		return $result;
	}

	/**
	 * Method to retrieve the options for the module.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	final public function get_options() {
		$model_options = $this->options();
		$options       = array();
		$index         = 0;
		foreach ( $model_options as $opt ) {
			$options[ $index ]          = $opt;
			$options[ $index ]['value'] = $this->get_option( $opt['name'] );
			$index ++;
		}

		return $options;
	}

	/**
	 * Method to define the options fields for the module
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public abstract function options();

	/**
	 * Method to retrieve an option value from model.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 *
	 * @param   string $key The option key to retrieve.
	 *
	 * @return bool
	 */
	final public function get_option( $key ) {
		$default_options = $this->get_options_defaults();
		$db_option       = $this->model->get_module_option( $this->slug, $key );
		$value           = $db_option;
		if ( $db_option === false ) {
			$value = isset( $default_options[ $key ] ) ? $default_options[ $key ] : '';
		}

		return $value;
	}

	/**
	 * Method to define the default model value for options, based on
	 * the options array if not set DB.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	final public function get_options_defaults() {
		$options  = $this->options();
		$defaults = array();
		foreach ( $options as $opt ) {
			if ( ! isset( $opt['default'] ) ) {
				$opt['default'] = '';
			}
			$defaults[ $opt['name'] ] = $opt['default'];
		}

		return $defaults;
	}

	/**
	 * Adds the hooks for amdin and public enqueue.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 *
	 * @param   string $version The version for the files.
	 */
	final public function set_enqueue( $version ) {
		$this->version = $version;
		$this->loader->add_action( 'obfx_admin_enqueue_styles', $this, 'set_admin_styles' );
		$this->loader->add_action( 'obfx_admin_enqueue_scripts', $this, 'set_admin_scripts' );

		$this->loader->add_action( 'obfx_public_enqueue_styles', $this, 'set_public_styles' );
		$this->loader->add_action( 'obfx_public_enqueue_scripts', $this, 'set_public_scripts' );
	}

	/**
	 * Sets the styles for admin from the module array.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function set_admin_styles() {
		$this->set_styles( $this->admin_enqueue(), 'adm' );
	}

	/**
	 * Actually sets the styles.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  private
	 *
	 * @param   array  $enqueue The array of files to enqueue.
	 * @param   string $prefix The string to prefix in the enqueued name.
	 */
	private function set_styles( $enqueue, $prefix ) {
		$module_dir = $this->slug;
		if ( ! empty( $enqueue ) ) {
			if ( isset( $enqueue['css'] ) && ! empty( $enqueue['css'] ) ) {
				$order = 0;
				$map   = array();
				foreach ( $enqueue['css'] as $file_name => $dependencies ) {
					if ( $dependencies === false ) {
						$dependencies = array();
					} else {
						// check if any dependency has been loaded by us. If yes, then use that id as the dependency.
						foreach ( $dependencies as $index => $dep ) {
							if ( array_key_exists( $dep, $map ) ) {
								unset( $dependencies[ $index ] );
								$dependencies[ $index ] = $map[ $dep ];
							}
						}
					}
					$url      = filter_var( $file_name, FILTER_SANITIZE_URL );
					$resource = plugin_dir_url( $this->get_dir() ) . $module_dir . '/css/' . $file_name . '.css';
					if ( ! filter_var( $url, FILTER_VALIDATE_URL ) === false ) {
						$resource = $url;
					}
					$id                = 'obfx-module-' . $prefix . '-css-' . str_replace( ' ', '-', strtolower( $this->name ) ) . '-' . $order;
					$map[ $file_name ] = $id;
					wp_enqueue_style(
						$id,
						$resource,
						$dependencies,
						$this->version,
						'all'
					);
					$order ++;
				}
			}
		}
	}

	/**
	 * Method that returns an array of scripts and styles to be loaded
	 * for the admin part.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public abstract function admin_enqueue();

	/**
	 * Sets the scripts for admin from the module array.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function set_admin_scripts() {
		$this->set_scripts( $this->admin_enqueue(), 'adm' );
	}

	/**
	 * Actually sets the scripts.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  private
	 *
	 * @param   array  $enqueue The array of files to enqueue.
	 * @param   string $prefix The string to prefix in the enqueued name.
	 */
	private function set_scripts( $enqueue, $prefix ) {
		$sanitized = str_replace( ' ', '-', strtolower( $this->name ) );

		$module_dir = $this->slug;

		if ( ! empty( $enqueue ) ) {
			if ( isset( $enqueue['js'] ) && ! empty( $enqueue['js'] ) ) {
				$order = 0;
				$map   = array();
				foreach ( $enqueue['js'] as $file_name => $dependencies ) {
					if ( $dependencies === false ) {
						$dependencies = array();
					} else {
						// check if any dependency has been loaded by us. If yes, then use that id as the dependency.
						foreach ( $dependencies as $index => $dep ) {
							if ( array_key_exists( $dep, $map ) ) {
								unset( $dependencies[ $index ] );
								$dependencies[ $index ] = $map[ $dep ];
							}
						}
					}
					$url      = filter_var( $file_name, FILTER_SANITIZE_URL );
					$resource = plugin_dir_url( $this->get_dir() ) . $module_dir . '/js/' . $file_name . '.js';
					if ( ! filter_var( $url, FILTER_VALIDATE_URL ) === false ) {
						$resource = $url;
					}
					$id                = 'obfx-module-' . $prefix . '-js-' . $sanitized . '-' . $order;
					$map[ $file_name ] = $id;

					wp_enqueue_script(
						$id,
						$resource,
						$dependencies,
						$this->version,
						true
					);

					// check if we need to enqueue or localize.
					if ( array_key_exists( $file_name, $this->localized ) ) {
						wp_localize_script(
							$id,
							str_replace( '-', '_', $sanitized ),
							$this->localized[ $file_name ]
						);
					}
					$order ++;
				}// End foreach().
			}// End if().
		}// End if().
	}

	/**
	 * Sets the styles for public from the module array.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function set_public_styles() {
		$this->set_styles( $this->public_enqueue(), 'pub' );
	}

	/**
	 * Method that returns an array of scripts and styles to be loaded
	 * for the front end part.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public abstract function public_enqueue();

	/**
	 * Sets the scripts for public from the module array.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function set_public_scripts() {
		$this->set_scripts( $this->public_enqueue(), 'pub' );
	}

	/**
	 * Method to return URL to child class in a Reflective Way.
	 *
	 * @codeCoverageIgnore
	 *
	 * @access  protected
	 * @return string
	 */
	protected function get_url() {
		return plugin_dir_url( $this->get_dir() ) . $this->slug;
	}

	/**
	 * Method to return path to child class in a Reflective Way.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @return string
	 */
	protected function get_dir() {
		$reflector = new ReflectionClass( get_class( $this ) );

		return dirname( $reflector->getFileName() );
	}

	/**
	 * Utility method to return active theme dir name.
	 *
	 * @since   1.0.0
	 * @access  protected
	 *
	 * @param   boolean $is_child Flag for child themes.
	 *
	 * @return string
	 */
	protected function get_active_theme_dir( $is_child = false ) {
		if ( $is_child ) {
			return basename( get_stylesheet_directory() );
		}

		return basename( get_template_directory() );
	}

	/**
	 * Utility method to render a view from module.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  protected
	 *
	 * @param   string $view_name The view name w/o the `-tpl.php` part.
	 * @param   array  $args An array of arguments to be passed to the view.
	 *
	 * @return string
	 */
	protected function render_view( $view_name, $args = array() ) {
		ob_start();
		$file = $this->get_dir() . '/views/' . $view_name . '-tpl.php';
		if ( ! empty( $args ) ) {
			foreach ( $args as $obfx_rh_name => $obfx_rh_value ) {
				$$obfx_rh_name = $obfx_rh_value;
			}
		}
		if ( file_exists( $file ) ) {
			include $file;
		}

		return ob_get_clean();
	}
	/**
	 * Check if the users is choosen to show this in beta.
	 *
	 * @param int $percent Amount of users to show.
	 *
	 * @return bool Random result.
	 */
	protected function is_lucky_user( $percent = 10 ) {
		$force_beta = isset( $_GET['force_beta'] ) && $_GET['force_beta'] === 'yes';
		if ( $force_beta ) {
			update_option( 'obfx_beta_show_' . $this->get_slug(), 'yes' );

			return true;
		}
		$luck = get_option( 'obfx_beta_show_' . $this->get_slug() );
		if ( ! empty( $luck ) ) {
			return $luck === 'yes';
		}
		$luck = rand( 1, 100 );

		$luck = $luck <= $percent;
		update_option( 'obfx_beta_show_' . $this->get_slug(), $luck ? 'yes' : 'no' );

		return $luck;
	}
}
