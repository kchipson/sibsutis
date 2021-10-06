<?php

namespace OrbitFox;

/**
 * The class defines way of connecting this user to the OrbitFox Dashboard.
 *
 * @package    \OrbitFox\Connector
 * @author     Themeisle <friends@themeisle.com>
 */
class Connector {
	/**
	 * Option key name for OrbitFox site account.
	 */
	const API_DATA_KEY = 'obfx_connect_data';

	/**
	 * The instance object.
	 *
	 * @var Connector
	 */
	protected static $instance = null;

	/**
	 * The Root URL of the OrbitFox dashboard.
	 *
	 * @var string
	 */
	protected $connect_url = 'https://dashboard.orbitfox.com/api/obfxhq/v1';

	/**
	 * The CDN details path.
	 *
	 * @var string
	 */
	protected $cdn_path = '/image/details';

	/**
	 * The instance init method.
	 *
	 * @static
	 * @since 1.0.0
	 * @access public
	 * @return Connector
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->init();
		}

		return self::$instance;
	}

	/**
	 * Init hooks.
	 */
	function init() {
		$this->connect_url = apply_filters( 'obfx_dashboard_url', $this->connect_url );

		add_action( 'admin_footer', array( $this, 'admin_inline_js' ) );
	}


	/**
	 * Sync quota data.
	 */
	public function daily_check() {

		$current_data = get_option( self::API_DATA_KEY );
		if ( empty( $current_data ) ) {
			return;
		}
		if ( ! isset( $current_data['api_key'] ) || empty( $current_data['api_key'] ) && strlen( $current_data['api_key'] ) > 10 ) {
			return;
		}
		$request             = new \OrbitFox\Request( $this->connect_url . $this->cdn_path, 'POST', $current_data['api_key'] );
		$response            = $request->get_response();
		$response['api_key'] = $current_data['api_key'];

		update_option( self::API_DATA_KEY, $response );

	}

	/**
	 * When a user requests an url we request a set of temporary token credentials and build a link with them.
	 * We also save them because we'll need them with the verifier.
	 *
	 * @return \WP_REST_Response|\WP_Error The connection handshake.
	 */
	public function rest_handle_connector_url( \WP_REST_Request $request ) {
		$disconnect_flag = $request->get_param( 'disconnect' );
		if ( ! empty( $disconnect_flag ) ) {
			delete_option( self::API_DATA_KEY );

			return new \WP_REST_Response( array( 'code' => 200, 'message' => 'Disconnected' ), 200 );
		}
		$api_key = $request->get_param( 'api_key' );
		if ( empty( $api_key ) ) {
			return new \WP_REST_Response( array( 'code' => 'error', 'data' => 'Empty api key provided' ) );
		}
		$request = new \OrbitFox\Request( $this->connect_url . $this->cdn_path, 'POST', $api_key );

		$response = $request->get_response();

		if ( $response === false ) {
			return new \WP_REST_Response(
				array(
					'code'    => 'error',
					'message' => 'Error connecting to the OrbitFox api. Invalid API key.',
				)
			);
		}
		$response['api_key'] = $api_key;
		update_option( self::API_DATA_KEY, $response );

		return new \WP_REST_Response( array( 'code' => 'success', 'data' => $response ), 200 );
	}

	/**
	 * Print the inline script which get's the url for the Connector button.
	 */
	function admin_inline_js() {
		$connect_endpoint = get_rest_url( null, 'obfx/connector-url' );
		$update_replacer  = get_rest_url( null, 'obfx/update_replacer' );
		wp_enqueue_script( 'wp-api' ); ?>
		<script type='text/javascript'>
			(function ($) {
				$('#obfx_connect').on('click', function (event) {
					event.preventDefault();

					$('#obfx_connect').parent().addClass('loading');
					var api_key = $('#obfx_connect_api_key').val();

					wp.apiRequest({
						url: "<?php echo $connect_endpoint; ?>",
						type: 'POST',
						data: {api_key: api_key},
						dataType: 'json'
					}).done(function (response) {
						$("#obfx-error-api").remove();
						$('#obfx_connect').parent().removeClass('loading');
						var elements = $("#obfx-module-form-image-cdn .obfx-loggedin-show, #obfx-module-form-image-cdn .obfx-loggedin-hide");
						switch (response.code) {

							case 'error':
								$("#obfx-module-form-image-cdn").append('<p class="label label-error" id="obfx-error-api">' + response.message + '</p>');
								elements.removeClass('obfx-img-logged-in');
								break;
							case 'success':

								$("#obfx_connect_api_key").val(response.data.api_key);
								$("#obfx-img-display-name").text(response.data.display_name);
								$("#obfx-img-cdn-url").text(response.data.image_cdn.key + '.i.optimole.com');
								$("#obfx-img-traffic-usage").text((parseInt(response.data.image_cdn.usage) / 1000).toFixed(3) + 'GB');
								$(".obfx-img-traffic-quota").text((parseInt(response.data.image_cdn.quota) / 1000).toFixed(0) + 'GB');
								elements.addClass('obfx-img-logged-in');
								break;
						}

					}).fail(function (e) {
						$('#obfx_connect').parent().removeClass('loading');
					});
				});

				$("input[name='enable_cdn_replacer'").on('change', function (event) {
					event.preventDefault();
					var flag_replacer = $(this).is(":checked");
					wp.apiRequest({
						url: "<?php echo $update_replacer; ?>",
						type: 'POST',
						data: {update_replacer: flag_replacer ? 'yes' : 'no'},
						dataType: 'json'
					}).done(function(){
						$("#obfx-module-form-image-cdn").append('<p class="label label-success" id="obfx-feedback-api">Image replacer option saved.</p>');
						setTimeout(function(){
							$("#obfx-feedback-api").remove();
						},1000);
					});
				});
				$('#obfx_disconnect').on('click', function (event) {
					event.preventDefault();
					$('#obfx_connect').parent().addClass('loading');
					wp.apiRequest({
						url: "<?php echo $connect_endpoint; ?>",
						type: 'POST',
						data: {disconnect: true},
						dataType: 'json'
					}).done(function (response) {
						location.reload();
					}).fail(function (e) {
						$('#obfx_disconnect').parent().removeClass('loading');
					});
				});

			})(jQuery)
		</script>
		<?php
	}


	/**
	 * Throw error on object clone
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'themeisle-companion' ), '1.0.0' );
	}

	/**
	 * Disable unserializing of the class
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'themeisle-companion' ), '1.0.0' );
	}
}
