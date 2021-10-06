<?php
/**
 * The Mock-up to demonstrate and test module use.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Uptime_Monitor_OBFX_Module
 */

/**
 * The class defines a new module to be used by Orbit Fox plugin.
 *
 * @package    Uptime_Monitor_OBFX_Module
 * @author     Themeisle <friends@themeisle.com>
 */
class Uptime_Monitor_OBFX_Module extends Orbit_Fox_Module_Abstract {
	/**
	 * @var string Uptime api endpoint.
	 */
	private $monitor_url = 'https://monitor.orbitfox.com';

	/**
	 * Test_OBFX_Module constructor.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function __construct() {
		parent::__construct();
		$this->name           = __( 'Uptime Monitor', 'themeisle-companion' );
		$this->description    = __( 'A module to notify when you website goes down.', 'themeisle-companion' );
		$this->confirm_intent = '<h4>' . __( 'One more step...', 'themeisle-companion' ) . '</h4><p>' . __( 'In order to use the uptime service, we will need your e-mail address, where we will send downtime alerts.', 'themeisle-companion' ) . '</p>';
	}

	/**
	 * Determine if module should be loaded.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return bool
	 */
	public function enable_module() {
		return true;
	}

	/**
	 * The loading logic for the module.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function load() {
	}

	/**
	 * Method called on module activation.
	 * Calls the API to register an url to monitor.
	 *
	 * @since   2.3.3
	 * @access  public
	 */
	public function after_options_save() {
		$this->activate();
	}

	/**
	 * Method invoked after options save.
	 *
	 * @since   2.3.3
	 * @access  public
	 */
	public function activate() {
		$email = sanitize_email( $this->get_option( 'monitor_email' ) );
		if ( ! is_email( $email ) ) {
			return;
		}

		$monitor_url = $this->monitor_url . '/api/monitor/create';
		$url         = home_url();
		$args        = array(
			'body' => array( 'url' => $url, 'email' => $email )
		);
		$response    = wp_remote_post( $monitor_url, $args );
	}

	/**
	 * Method invoked before options save.
	 *
	 * @since   2.3.3
	 * @access  public
	 */
	public function before_options_save( $options ) {
		$this->deactivate();
	}

	/**
	 * Method called on module deactivation.
	 * Calls the API to unregister an url from the monitor.
	 *
	 * @since   2.3.3
	 * @access  public
	 */
	public function deactivate() {
		$this->set_option( 'monitor_email', '' );
		$monitor_url  = $this->monitor_url . '/api/monitor/remove';
		$url          = home_url();
		$args         = array(
			'body' => array( 'url' => $url )
		);
		$response     = wp_remote_post( $monitor_url, $args );
		$api_response = json_decode( $response['body'] );
	}

	/**
	 * Method to define hooks needed.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function hooks() {
		$this->loader->add_action( $this->get_slug() . '_before_options_save', $this, 'before_options_save', 10, 1 );
		$this->loader->add_action( $this->get_slug() . '_after_options_save', $this, 'after_options_save' );
	}

	/**
	 * Method that returns an array of scripts and styles to be loaded
	 * for the front end part.
	 *
	 * @since   1.0.0
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
	 * @since   1.0.0
	 * @access  public
	 * @return array|boolean
	 */
	public function admin_enqueue() {
		$current_screen = get_current_screen();

		if ( ! isset( $current_screen->id ) ) {
			return array();
		}
		if ( $current_screen->id != 'dashboard' ) {
			return array();
		}

		return array(
			'js'  => array(
				'stats' => array( 'jquery' ),
			),
			'css' => array(
				'stats' => false,
			),
		);
	}

	/**
	 * Method to define the options fields for the module
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public function options() {
		return array(
			array(
				'id'          => 'monitor_email',
				'name'        => 'monitor_email',
				'title'       => 'Notification email',
				'description' => 'Email where we should notify you when the site goes down.',
				'type'        => 'email',
				'default'     => '',
				'placeholder' => 'Add your email.',
			)
		);
	}
}