<?php

/**
 * The Orbit Fox Image CDN Module.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Image_CDN_OBFX_Module
 */

/**
 * The class defines a new module to be used by Orbit Fox plugin.
 *
 * @package    Image_CDN_OBFX_Module
 * @author     Themeisle <friends@themeisle.com>
 */
class Image_CDN_OBFX_Module extends Orbit_Fox_Module_Abstract {
	/**
	 * Dashboard related data.
	 *
	 * @var null|array Dashboard related data.
	 */
	protected $connect_data = null;
	/**
	 * @var \OrbitFox\Connector $connector Orbitfox Api connector.
	 */
	private $connector;

	/**
	 * Image_CDN_OBFX_Module constructor.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function __construct() {
		parent::__construct();
		if ( isset( $_GET['loggedin'] ) && $_GET['loggedin'] == 'true' ) {
			$this->show = true;
		}
		$this->no_save     = true;
		$this->name        = sprintf( __( 'Image Optimization &amp; CDN Module', 'themeisle-companion' ).' <sup class="obfx-title-deprecated">DEPRECATED<sup>' );
		$this->description = sprintf( __( 'We are deprecating this module in favor of %sOptimole%s plugin for a more in depth integration and maintainability. You can safely disable this module and further use the dedicated plugin.', 'themeisle-companion' ), '<span class="dashicons dashicons-external"></span><a href="http://wordpress.org/plugins/optimole-wp"   target="_blank">', '</a>' );
		add_action( 'obfx_module_tile_after', [ $this, 'tryout' ], 10, 2 );
	}

	public function tryout( $slug = '', $active = false ) {
		if ( $slug !== 'image-cdn' ) {
			return;
		}
		if ( $active ) {
			return;
		}
		echo sprintf( __( '%sTest your site%s','themeisle-companion' ), '<span class="obfx-tryout-message"><a href="' . esc_url( sprintf( 'https://speedtest.optimole.com/?url=%s', get_site_url() ) ) . '" target="_blank">', '</a></span>' );
	}

	/**
	 * Determine if module should be loaded.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return bool
	 */
	public function enable_module() {
		require_once( ABSPATH . 'wp-admin' . '/includes/plugin.php' );
		// Bail if we optimole already.
		if ( is_plugin_active( 'optimole-wp/optimole-wp.php' ) ) {
			return false;
		}
		return $this->is_replacer_enabled();
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
	 * Add top admin bar notice of traffic quota/usage.
	 *
	 * @param WP_Admin_Bar $wp_admin_bar Admin bar resource.
	 */
	public function add_traffic_node( $wp_admin_bar ) {
		if ( ! is_user_logged_in() ) {
			return;
		}
		$obfx_user_data = $this->get_api_data();
		$args           = array(
			'id'    => 'obfx_img_quota',
			'title' => 'OrbitFox' . __( ' Image Traffic', 'themeisle-companion' ) . ': ' .
			           number_format( floatval( (
			           isset( $obfx_user_data['image_cdn']['usage'] ) ? $obfx_user_data['image_cdn']['usage'] : 0 / 1000 ) ), 3 ) . ' / ' .
			           number_format( floatval( ( isset( $obfx_user_data['image_cdn']['quota'] ) ? $obfx_user_data['image_cdn']['quota'] : 0 / 1000 ) ), 0 ) . 'GB',
			'href'  => 'https://dashboard.orbitfox.com/',
			'meta'  => array( 'target' => '_blank' )
		);
		$wp_admin_bar->add_node( $args );

	}

	/**
	 * Return api data.
	 *
	 * @return mixed|string APi data.
	 */
	private function get_api_data() {

		if ( ! $this->get_is_active() ) {
			return '';
		}

		return class_exists( '\OrbitFox\Connector' ) ? get_option( \OrbitFox\Connector::API_DATA_KEY, '' ) : '';
	}

	/**
	 * Render data from dashboard of orbitfox.com.
	 */
	public function render_connect_data( $html ) {

		$obfx_user_data = $this->get_api_data();
		$class          = '';
		if ( ! empty( $obfx_user_data ) ) {
			$class = 'obfx-img-logged-in';
		}
		$display_name = isset( $obfx_user_data['display_name'] ) ? $obfx_user_data['display_name'] : '';
		$usage        = ( isset( $obfx_user_data['image_cdn'] ) && isset( $obfx_user_data['image_cdn']['usage'] ) ) ? $obfx_user_data['image_cdn']['usage'] : 0;
		$quota        = ( isset( $obfx_user_data['image_cdn'] ) && isset( $obfx_user_data['image_cdn']['quota'] ) ) ? $obfx_user_data['image_cdn']['quota'] : 0;
		$html         = '<div class="obfx-img-logged-in-data obfx-loggedin-show ' . $class . '" > ';
		$html         .= '<h5>' . __( 'Logged in as', 'themeisle-companion' ) . ' : <b id="obfx-img-display-name">' . esc_attr( $display_name ) . '</b></h5>';
		$html         .= '<p>' . __( 'Your private CDN url', 'themeisle-companion' ) . ' : <code id="obfx-img-cdn-url">' . $this->get_cdn_url() . '</code></p> ';
		$html         .= '<p>' . __( 'This month traffic usage', 'themeisle-companion' ) . ' : <code id="obfx-img-traffic-usage">' . number_format( floatval( ( $usage / 1000 ) ), 3 ) . ' GB</code>';
		$html         .= ' ' . __( 'Your traffic quota', 'themeisle-companion' ) . ' : <code class="obfx-img-traffic-quota">' . number_format( floatval( ( $quota / 1000 ) ), 3 ) . ' GB / month</code></p>';
		$html         .= '<p><i>' . __( 'You can use our image service and CDN in the limit of <span class="obfx-img-traffic-quota">', 'themeisle-companion' ) . number_format( floatval( ( $quota / 1000 ) ), 0 ) . '</span> per month.  </i></p>';
		$html         .= '</div>';

		return $html;
	}

	/**
	 * Get CDN private url.
	 *
	 * @return string Get CDN private url.
	 */
	private function get_cdn_url() {
		$obfx_user_data = $this->get_api_data();
		if ( empty( $obfx_user_data ) ) {
			return '';
		}
		if ( ! isset( $obfx_user_data['image_cdn']['key'] ) ) {
			return '';
		}

		return sprintf( '%s.i.optimole.com', strtolower( $obfx_user_data['image_cdn']['key'] ) );

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
		return array();
	}

	/**
	 * Options array for the Orbit Fox module.
	 *
	 * @return array
	 */
	public function options() {
		//Hack to allow binding of img module connect button as the view for the module options is loaded either if the module is active or not.

		//TODO Remove this when we have a way of loading module options async.
		if ( is_admin() ) {
			$this->hooks();
		}
		$obfx_user_data = $this->get_api_data();
		if ( empty( $obfx_user_data ) ) {
			$this->set_option( 'obfx_connect_api_key', '' );
			$this->set_option( 'enable_cdn_replacer', '0' );

		}
		$class = '';
		if ( ! empty( $obfx_user_data ) ) {
			$class = 'obfx-img-logged-in';
		}
		$fields   = array(
			array(
				'type'  => 'title',
				'name'  => 'Tooltip',
				'title' => sprintf( 'In order to get access to free image optimization service you will need an account on <a href="https://dashboard.orbitfox.com/register" target="_blank">orbitfox.com</a>. You will get access to our image optimization and CDN service for free in the limit of 1GB traffic per month.<br/> <i>Note: This is just a basic integration of the <a href="%s" target="_blank"> Optimole </a> service. For a more in-depth experience, try out the dedicated <a href="%s" target="_blank" >plugin</a>.</i>', 'https://optimole.com', 'http://wordpress.org/plugins/optimole-wp' )
			),
			array(
				'id'          => 'obfx_connect_api_key',
				'name'        => 'obfx_connect_api_key',
				'type'        => 'password',
				'default'     => isset( $obfx_user_data['api_key'] ) ? $obfx_user_data['api_key'] : '',
				'placeholder' => __( 'Your OrbitFox api key', 'themeisle-companion' ),
				'text'        => '<span class="dashicons dashicons-share"></span>' . __( 'Connect with Orbitfox', 'themeisle-companion' ),
			),
			array(
				'id'     => 'obfx-register-service',
				'type'   => 'link',
				'target' => '_blank',
				'class'  => 'obfx-loggedin-hide ' . $class,
				'url'    => 'https://dashboard.orbitfox.com/register',
				'text'   => ' Sign-Up for your API key',
				'name'   => 'obfx-register-service',
			),

		);
		$fields[] = array(
			'id'         => 'obfx_connect',
			'name'       => 'obfx_connect',
			'type'       => 'link',
			'url'        => '#',
			'class'      => 'obfx-loggedin-hide ' . $class,
			'link-class' => 'btn btn-success',
			'text'       => '<span class="dashicons dashicons-share"></span>' . __( 'Connect to OrbitFox service', 'themeisle-companion' ),
		);
		$fields[] = array(
			'type' => 'custom',
			'id'   => 'cdn_logged_in_data',
			'name' => 'cdn_logged_in_data',
		);
		$fields[] = array(
			'id'         => 'obfx_disconnect',
			'name'       => 'obfx_disconnect',
			'type'       => 'link',
			'class'      => 'obfx-loggedin-show ' . $class,
			'url'        => '#',
			'link-class' => 'btn btn-danger float-right  mb-10 obfx-img-logout ',
			'text'       => '<span class="dashicons dashicons-share"></span>' . __( 'Clear OrbitFox API key', 'themeisle-companion' ),
		);

		$fields[] = array(
			'id'      => 'enable_cdn_replacer',
			'title'   => '',
			'name'    => 'enable_cdn_replacer',
			'type'    => 'toggle',
			'class'   => ' obfx-img-cdn-replacer-switch obfx-loggedin-show ' . $class,
			'label'   => 'Serve all images optimised through OrbitFox CDN for a boost in speed.',
			'default' => '0',
		);

		return $fields;
	}

	/**
	 * Method to define hooks needed.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function hooks() {
		/**
		 * Init the connector object and load deps.
		 */
		require_once __DIR__ . '/inc/class-request.php';
		require_once __DIR__ . '/inc/class-orbit-fox-connector.php';
		add_filter( 'obfx_custom_control_cdn_logged_in_data', array( $this, 'render_connect_data' ) );
		$this->connector = \OrbitFox\Connector::instance();

		$this->loader->add_action( 'rest_api_init', $this, 'register_url_endpoints' );
		if ( ! $this->get_is_active() ) {
			$this->set_option( 'enable_cdn_replacer', '0' );
			$this->clear_api_data();
		}
		/**
		 * Load the image replacement logic if we are on the frontend,
		 * connected to the api and the replacement options is on.
		 */
		if ( ! is_admin() && $this->is_replacer_enabled() && $this->is_connected() ) {
			require_once __DIR__ . '/inc/class-orbit-fox-image-replacer.php';
			\OrbitFox\Image_CDN_Replacer::instance();
			$this->loader->add_filter( 'wp_resource_hints', $this, 'add_dns_prefetch', 10, 2 );

		}
		/**
		 * Adds top admin bar notice of traffic, if the module is connected.
		 */
		if ( $this->is_connected() ) {
			$this->loader->add_action( 'obfx_img_quota_sync', $this->connector, 'daily_check' );

			if ( ! wp_next_scheduled( 'obfx_img_quota_sync' ) ) {
				wp_schedule_event( time() + 10, 'daily', 'obfx_img_quota_sync', array() );
			}
			$this->loader->add_action( 'admin_bar_menu', $this, 'add_traffic_node', 9999 );
		}

	}

	/**
	 * Return api data.
	 *
	 * @return mixed|string APi data.
	 */
	private function clear_api_data() {


		return update_option( \OrbitFox\Connector::API_DATA_KEY, '' );
	}

	/**
	 * Check if the image replacement is enabled.
	 *
	 * @return bool Connection status.
	 */
	private function is_replacer_enabled() {
		if ( ! $this->get_is_active() ) {
			return false;
		}
		$enabled = $this->get_option( 'enable_cdn_replacer' );

		return boolval( $enabled );

	}

	/**
	 * Check if the module is connected to the api.
	 *
	 * @return bool Connection status.
	 */
	private function is_connected() {

		$obfx_user_data = $this->get_api_data();

		return ! empty( $obfx_user_data );

	}

	/**
	 * Adds cdn url for prefetch.
	 *
	 * @param array  $hints Hints array.
	 * @param string $relation_type Type of relation.
	 *
	 * @return array Altered hints array.
	 */
	public function add_dns_prefetch( $hints, $relation_type ) {
		if ( 'dns-prefetch' !== $relation_type ) {
			return $hints;
		}
		$cdn_url = $this->get_cdn_url();
		if ( empty( $cdn_url ) ) {
			return $hints;
		}
		$hints[] = sprintf( '//%s', $cdn_url );

		return $hints;
	}

	/**
	 * Update replacer callback.
	 */
	public function update_replacer( WP_REST_Request $request ) {
		$flag = $request->get_param( 'update_replacer' );
		$this->set_option( 'enable_cdn_replacer', $flag === 'yes' ? '1' : '0' );

		return new WP_REST_Response( 'Replacer updated' );
	}

	/**
	 * Register module rest methods.
	 */
	public function register_url_endpoints() {
		register_rest_route(
			'obfx', '/connector-url', array(
				array(
					'methods'             => \WP_REST_Server::CREATABLE,
					'permission_callback' => function ( \WP_REST_Request $request ) {
						return current_user_can( 'manage_options' );
					},
					'callback'            => array( $this->connector, 'rest_handle_connector_url' ),
				),
			)
		);
		register_rest_route(
			'obfx', '/update_replacer', array(
				array(
					'methods'             => \WP_REST_Server::CREATABLE,
					'permission_callback' => function ( \WP_REST_Request $request ) {
						return current_user_can( 'manage_options' );
					},
					'callback'            => array( $this, 'update_replacer' ),
				),
			)
		);
	}

}
