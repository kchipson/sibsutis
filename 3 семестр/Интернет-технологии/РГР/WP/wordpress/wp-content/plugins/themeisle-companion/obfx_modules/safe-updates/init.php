<?php
/**
 * A module to check changes before theme updates.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Theme_Update_Check_OBFX_Module
 */

/**
 * The class defines a new module to be used by Orbit Fox plugin.
 *
 * @package    Theme_Update_Check_OBFX_Module
 * @author     Themeisle <friends@themeisle.com>
 */
class Safe_Updates_OBFX_Module extends Orbit_Fox_Module_Abstract {

	/**
	 * @var string ThemeCheck api endpoint.
	 */
	const API_ENDPOINT = 'https://dashboard.orbitfox.com/api/obfxhq/v1/updates/create/';

	/**
	 * Test_OBFX_Module constructor.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function __construct() {
		parent::__construct();
		$this->beta        = false;
		$this->no_save     = true;
		$this->name        = __( 'Safe Updates', 'themeisle-companion' );
		$this->description = __( 'OrbitFox will give you visual feedback on how your current theme updates will affect your site. For the moment this is available only for wordpress.org themes.', 'themeisle-companion' );
	}

	/**
	 * Method to determine if the module is enabled or not.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return bool
	 */
	public function enable_module() {

		return ( $this->beta ) ? $this->is_lucky_user() : true;
	}

	/**
	 * The method for the module load logic.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return mixed
	 */
	public function load() {
		return;
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
	 * @return array
	 */
	public function admin_enqueue() {
		if ( ! $this->is_safe_updates_active() ) {
			return array();
		}
		$current_screen = get_current_screen();
		if ( $current_screen->id != 'themes' && $current_screen->id != 'update-core' ) {
			return array();
		}
		$info = $this->is_update_available();

		if ( empty( $info ) ) {
			return array();
		}
		$request_data = array(
			'theme'           => $info['theme'],
			'current_version' => $info['current_version'],
			'next_version'    => $info['new_version'],
		);

		$data = $this->get_safe_updates_data( $request_data );
		if ( empty( $data ) ) {
			return array();
		}
		$this->localized = array(
			'theme-update-check' => array(
				'slug' => $this->get_active_theme_dir(),
			),
		);
		$changes_info    = $this->get_message_notice( array(
			'global_diff'     => $data['global_diff'],
			'current_version' => $info['current_version'],
			'new_version'     => $info['new_version'],
			'gallery_url'     => $data['gallery_url'],
		) );

		$this->localized['theme-update-check']['check_msg'] = $changes_info;

		return array(
			'js' => array(
				'theme-update-check' => array( 'jquery', 'wp-lists', 'backbone' ),
			),
		);
	}

	/**
	 * Check if safe updates is turned on.
	 *
	 * @return bool Safe updates status.
	 */
	private function is_safe_updates_active() {

		return (bool) $this->get_option( 'auto_update_checks' );
	}

	/**
	 * Check if there is an update available.
	 *
	 * @param null $transient Transient to check.
	 *
	 * @return bool Is update available?
	 */
	private function is_update_available( $transient = null ) {

		if ( $transient === null ) {
			$transient = get_site_transient( 'update_themes' );
		}

		$slug = $this->get_active_theme_dir();

		if ( ! isset( $transient->response[ $slug ]['new_version'] ) ) {
			return false;
		}
		if ( version_compare( $transient->response[ $slug ]['new_version'], $transient->checked[ $slug ], '>' ) ) {
			$transient->response[ $slug ]['current_version'] = $transient->checked[ $slug ];

			$this->changes_check( $transient->response[ $slug ] );

			return $transient->response[ $slug ];
		}

		return false;
	}

	/**
	 * Check remote api for safe updates data.
	 *
	 * @param array $info Theme details.
	 *
	 * @return array Remote api message.
	 */
	private function changes_check( $info ) {
		if ( ! isset( $info['theme'] ) || empty( $info['theme'] ) ) {
			return array();
		}
		if ( ! isset( $info['new_version'] ) || empty( $info['new_version'] ) ) {
			return array();
		}
		if ( ! isset( $info['current_version'] ) || empty( $info['current_version'] ) ) {
			return array();
		}
		$request_data = array(
			'theme'           => $info['theme'],
			'current_version' => $info['current_version'],
			'next_version'    => $info['new_version'],
		);

		$data = $this->get_safe_updates_data( $request_data );
		if ( ! empty( $data ) ) {
			return $data;
		}
		/**
		 * Set lock and prevent calling the api for the next 30s.
		 */
		ksort( $request_data );
		$cache_key = 'obfx_su_' . md5( serialize( $request_data ) );
		$lock      = get_transient( $cache_key );
		if ( $lock === 'yes' ) {
			return array();
		}
		$response = wp_remote_post( self::API_ENDPOINT, array(
				'method'  => 'POST',
				'timeout' => 2,
				'body'    => $request_data,
			)
		);
		if ( is_wp_error( $response ) ) {
			return array();
		}
		$response_data = json_decode( wp_remote_retrieve_body( $response ), true );
		if ( ! is_array( $response_data ) ) {
			return array();
		}

		set_transient( $cache_key, 'yes', 30 );

		if ( strval( $response_data['code'] ) !== '200' ) {
			return array();
		}
		$response_data = $response_data['data'];
		if ( ! is_array( $response_data ) ) {
			return array();
		}
		$option_data = array(
			$this->get_safe_updates_hash( $request_data ) => $response_data,
		);

		$this->set_option( 'checks', $option_data );

		return $response_data;
	}

	/**
	 * Get cached safe updates api data.
	 *
	 * @param array $args Args to check.
	 *
	 * @return array Api data.
	 */
	private function get_safe_updates_data( $args = array() ) {

		$payload_sha = $this->get_safe_updates_hash( $args );
		$checks      = $this->get_option( 'checks' );

		if ( ! isset( $checks[ $payload_sha ] ) || empty( $checks[ $payload_sha ] ) || ! is_array( $checks[ $payload_sha ] ) || $checks[ $payload_sha ]['theme'] !== $args['theme'] ) {
			return array();
		}

		return $checks[ $payload_sha ];
	}

	/**
	 * Get hash key based on the request data.
	 *
	 * @param array $args Arguments used to generate hash.
	 *
	 * @return string Hash key.
	 */
	private function get_safe_updates_hash( $args = array() ) {
		ksort( $args );

		$payload_sha = hash_hmac( 'sha256', json_encode( $args ), self::API_ENDPOINT );

		return $payload_sha;
	}

	/**
	 * Return message string for safe updates notice.
	 *
	 * @param array $args Message placeholder.
	 *
	 * @return string Message string.
	 */
	public function get_message_notice( $args ) {
		$diff    = floatval( $args['global_diff'] );
		$message = sprintf(
			__( 'According to OrbitFox<sup>&copy;</sup> there is a visual difference of %1$s &#37; between your current version and the latest one. ', 'themeisle-companion' ),
			number_format( $diff, 2 )
		//$args['new_version']
		);
		if ( $diff > 0.1 ) {
			$message .= sprintf( '<a href="%1$s" target="_blank">', add_query_arg( array( 'from_orbitfox' => 'yes' ), $args['gallery_url'] ) ) . __( 'View report', 'themeisle-companion' ) . '</a> ';
		} else {
			$message .= __( 'Is very likely that the update is safe. ', 'themeisle-companion' );
		}

		return $message;

	}

	/**
	 * Method to define the options fields for the module
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public function options() {

		add_filter( 'obfx_custom_control_auto_update_toggle', array( $this, 'render_custom_control' ) );

		add_action( 'admin_footer', array( $this, 'admin_inline_js' ) );
		add_action( 'rest_api_init', array( $this, 'register_endpoints' ) );
		if ( ! $this->get_is_active() ) {
			$this->set_option( 'auto_update_checks', '0' );
		}

		return array(
			array(
				'name'    => 'checks',
				'type'    => 'custom',
				'default' => array(),
			),
			array(
				'id'   => 'auto_update_toggle',
				'name' => 'auto_update_toggle',
				'type' => 'custom',
			),
		);
	}

	/**
	 * Render custom control outpu.
	 *
	 * @return string Custom control output.
	 */
	public function render_custom_control() {

		if ( ! $this->is_wp_available() ) {
			add_action( 'shutdown', function () {
				$this->set_status( 'active', false );
			} );

			return __( 'Unfortunately, our service is available only if your are using an wordpress.org theme. We are still working to extend this feature to custom and premium themes soon. ', 'themeisle-companion' );
		}

		$output = '<label>' . __( 'OrbitFox<sup>&copy;</sup> will need your current theme slug in order to run a visual comparison report between your current and latest version. We will need your consent in order to do this. <br/>Read <a href="https://orbitfox.com/safe-updates/" target="_blank"><b>more</b></a> about this process.', 'themeisle-companion' ) . '';
		if ( ! $this->is_safe_updates_active() ) {
			$output .= '</label></br></br><a  id="obfx-safe-updates-allow" class="btn btn-success" href="#"><span class="dashicons dashicons-yes"></span>   <span>' . __( 'Allow', 'themeisle-companion' ) . '</span></a>';
		} else {
			$output .= '  If want to disable the update feedback, you can disable the module from the upper module list 	&#8593;</label><br/><br/>';
			$output .= $this->get_safe_updates_status();

		}

		return $output;
	}

	/**
	 * Check if theme is available on wp.org.
	 *
	 * @return bool Check result.
	 */
	private function is_wp_available() {

		$slug      = $this->get_active_theme_dir();
		$cache_key = $slug . '_wporg_check';
		$cache     = get_transient( $cache_key );
		if ( $cache !== false ) {
			return $cache === 'yes';
		}
		$response = wp_remote_get( 'http://api.wordpress.org/themes/info/1.1/?action=theme_information&request[slug]=' . $slug );
		if ( is_wp_error( $response ) ) {
			set_transient( $cache_key, 'no', HOUR_IN_SECONDS );

			return false;
		}
		$body = wp_remote_retrieve_body( $response );
		if ( empty( $body ) ) {
			set_transient( $cache_key, 'no', HOUR_IN_SECONDS );

			return false;
		}
		$body = json_decode( $body, true );
		if ( ! is_array( $body ) ) {
			set_transient( $cache_key, 'no', HOUR_IN_SECONDS );

			return false;
		}

		set_transient( $cache_key, 'yes', HOUR_IN_SECONDS );

		return true;
	}

	/**
	 * Get safe update process message.
	 *
	 * @return string Safe updates process message.
	 */
	private function get_safe_updates_status() {
		$theme_data = $this->is_update_available();
		if ( $theme_data === false ) {
			return __( 'For the moment there is no update for your current theme. We will display a notice on the themes page as soon as there is one.', 'themeisle-companion' );

		}
		$changes = $this->changes_check( $theme_data );
		if ( empty( $changes ) ) {
			return __( 'OrbitFox<sup>&copy;</sup> is now running a visual report for your theme update. Please check the themes <a href="' . admin_url( 'themes.php' ) . '" target="_blank">update</a> page in a few minutes to see the result.', 'themeisle-companion' );
		}

		return '<pre class=" obfx-sf-feedback-notice  mb-10">' . $this->get_message_notice( $changes ) . '</pre>';

	}

	/**
	 * Method to define actions and filters needed for the module.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function hooks() {

		if ( ! $this->is_safe_updates_active() ) {
			return;
		}

		$this->loader->add_filter( 'wp_prepare_themes_for_js', $this, 'theme_update_message' );
	}

	/**
	 * Register module safe updates feedback.
	 */
	public function register_endpoints() {
		register_rest_route(
			'obfx', '/enable_safe_updates', array(
				array(
					'methods'             => \WP_REST_Server::CREATABLE,
					'permission_callback' => function ( \WP_REST_Request $request ) {
						return current_user_can( 'manage_options' );
					},
					'callback'            => array( $this, 'safe_updates_enabler' ),
				),
			)
		);
	}

	/**
	 * Enable safe updates feedback.
	 *
	 * @param WP_REST_Request $request Rest request.
	 *
	 * @return WP_REST_Response Feedback response.
	 */
	public function safe_updates_enabler( WP_REST_Request $request ) {
		$status   = $request->get_param( 'status' );
		$response = array(
			'message' => '',
			'data'    => '',
			'code'    => 'error',

		);
		if ( $status !== 'activate' && $status !== 'deactivate' ) {
			return new WP_REST_Response( $response );
		}
		if ( $status === 'deactivate' ) {
			$this->set_option( 'auto_update_checks', '0' );
			$response = wp_parse_args( array(
				'code'    => 'success',
				'message' => __( 'Safe updates disabled', 'themeisle-companion' )
			) );

			return new WP_REST_Response( $response );
		}
		$this->set_option( 'auto_update_checks', '1' );

		$status   = $this->get_safe_updates_status();
		$response = wp_parse_args( array(
			'code'    => 'success',
			'message' => $status
		) );

		return new WP_REST_Response( $response );

	}

	/**
	 * Add logic for module options.
	 */
	public function admin_inline_js() {
		wp_enqueue_script( 'wp-api' );

		$enable_safe_updates = get_rest_url( null, 'obfx/enable_safe_updates' );
		?>
		<script type='text/javascript'>
			(function ($) {
				$('#obfx-safe-updates-allow').on('click', function (event) {
					var btn = $(this);
					btn.addClass('loading');
					$("#obfx-sf-update-error").remove();
					wp.apiRequest({
						url: "<?php echo esc_url( $enable_safe_updates ); ?>",
						data: {status: 'activate'},
						type: 'POST',
						dataType: 'json'
					}).done(function (response) {
						btn.removeClass('loading');
						if (response.code === 'success') {
							btn.hide();
							btn.after(response.message);
						} else {
							btn.after('<p class="label label-error mb-10" id="obfx-sf-update-error">' + response.message + '</p>');
						}

					}).fail(function (e) {
						btn.removeClass('loading');
						$("#obfx-sf-update-error").remove();
						btn.after('<p class="label label-error">Can not activate the option. Please try again later.</p>');
					});
					return false;
				});
			})(jQuery)
		</script>
		<?php
	}

	/**
	 * Alter theme update message.
	 *
	 * @param array $themes List of themes.
	 *
	 * @return mixed Altered message.
	 */
	public function theme_update_message( $themes ) {

		if ( ! $this->is_safe_updates_active() ) {
			return $themes;
		}
		$info = $this->is_update_available();
		if ( empty( $info ) ) {
			return $themes;
		}
		$request_data = array(
			'theme'           => $info['theme'],
			'current_version' => $info['current_version'],
			'next_version'    => $info['new_version'],
		);

		$data = $this->get_safe_updates_data( $request_data );
		if ( empty( $data ) ) {
			return $themes;
		}
		$changes_info = $this->get_message_notice( array(
			'global_diff'     => $data['global_diff'],
			'current_version' => $info['current_version'],
			'new_version'     => $info['new_version'],
			'gallery_url'     => $data['gallery_url'],
		) );

		$themes[ $info['theme'] ]['update'] = $themes[ $info['theme'] ]['update'] . $changes_info;

		return $themes;
	}

}