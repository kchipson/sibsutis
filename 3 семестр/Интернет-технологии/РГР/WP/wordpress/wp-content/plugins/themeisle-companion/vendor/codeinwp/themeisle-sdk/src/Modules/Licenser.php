<?php
/**
 * The main loader class for license handling.
 *
 * @package     ThemeIsleSDK
 * @subpackage  Modules
 * @copyright   Copyright (c) 2017, Marius Cristea
 * @license     http://opensource.org/licenses/gpl-3.0.php GNU Public License
 * @since       1.0.0
 */

namespace ThemeisleSDK\Modules;

// Exit if accessed directly.
use ThemeisleSDK\Common\Abstract_Module;
use ThemeisleSDK\Product;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Licenser module for ThemeIsle SDK.
 */
class Licenser extends Abstract_Module {

	/**
	 * Number of max failed checks before showing the license message.
	 *
	 * @var int $max_failed Maximum failed checks allowed before show the notice
	 */
	private static $max_failed = 5;
	/**
	 * License key string.
	 *
	 * @var string $license_key The license key string
	 */
	public $license_key;
	/**
	 * This ensures that the custom API request only runs on the second time that WP fires the update check.
	 *
	 * @var bool $do_check Flag for request.
	 */
	private $do_check = false;
	/**
	 * Number of failed checks to the api endpoint.
	 *
	 * @var bool $failed_checks
	 */
	private $failed_checks = 0;
	/**
	 * The product update response key.
	 *
	 * @var string $product_key Product key.
	 */
	private $product_key;

	/**
	 * Disable wporg updates for premium products.
	 *
	 * @param string $r Update payload.
	 * @param string $url The api url.
	 *
	 * @return mixed List of themes to check for update.
	 */
	function disable_wporg_update( $r, $url ) {

		if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/' ) ) {
			return $r;
		}

		// Decode the JSON response.
		$themes = json_decode( $r['body']['themes'] );

		unset( $themes->themes->{$this->product->get_slug()} );

		// Encode the updated JSON response.
		$r['body']['themes'] = json_encode( $themes );

		return $r;
	}

	/**
	 * Register the setting for the license of the product.
	 *
	 * @return bool
	 */
	public function register_settings() {
		if ( ! is_admin() ) {
			return false;
		}
		if ( apply_filters( $this->product->get_key() . '_hide_license_field', false ) ) {
			return;
		}
		add_settings_field(
			$this->product->get_key() . '_license',
			$this->product->get_name() . ' license',
			array( $this, 'license_view' ),
			'general'
		);
	}

	/**
	 *  The license view field.
	 */
	public function license_view() {
		$status = $this->get_license_status();
		$value  = $this->license_key;

		$activate_string   = apply_filters( $this->product->get_key() . '_lc_activate_string', 'Activate' );
		$deactivate_string = apply_filters( $this->product->get_key() . '_lc_deactivate_string', 'Deactivate' );
		$valid_string      = apply_filters( $this->product->get_key() . '_lc_valid_string', 'Valid' );
		$invalid_string    = apply_filters( $this->product->get_key() . '_lc_invalid_string', 'Invalid' );
		$license_message   = apply_filters( $this->product->get_key() . '_lc_license_message', 'Enter your license from %s purchase history in order to get %s updates' );
		$error_message     = $this->get_error();
		?>
		<style type="text/css">
			input.themeisle-sdk-text-input-valid {
				border: 1px solid #7ad03a;
			}

			input.themeisle-sdk-license-input {
				width: 300px;
				padding: 0 8px;
				line-height: 2;
				min-height: 30px;
			}

			.themeisle-sdk-license-deactivate-cta {
				color: #fff;
				background: #7ad03a;
				display: inline-block;
				text-decoration: none;
				font-size: 13px;
				line-height: 30px;
				height: 26px;
				margin-left: 5px;
				padding: 0 10px 3px;
				-webkit-border-radius: 3px;
				border-radius: 3px;
			}

			.themeisle-sdk-license-activate-cta {
				color: #fff;
				background: #dd3d36;
				display: inline-block;
				text-decoration: none;
				font-size: 13px;
				line-height: 30px;
				height: 26px;
				margin-left: 5px;
				padding: 0 10px 3px;
				-webkit-border-radius: 3px;
				border-radius: 3px;
			}

			button.button.themeisle-sdk-licenser-button-cta {
				line-height: 26px;
				height: 29px;
				vertical-align: top;
			}

		</style>
		<?php
		echo sprintf(
			'<p>%s<input class="themeisle-sdk-license-input %s" type="text" id="%s_license" name="%s_license" value="%s" /><a class="%s">%s</a>&nbsp;&nbsp;&nbsp;<button name="%s_btn_trigger" class="button button-primary themeisle-sdk-licenser-button-cta" value="yes" type="submit" >%s</button></p><p class="description">%s</p>%s',
			( ( 'valid' === $status ) ? sprintf( '<input type="hidden" value="%s" name="%s_license" />', $value, $this->product->get_key() ) : '' ),
			( ( 'valid' === $status ) ? 'themeisle-sdk-text-input-valid' : '' ),
			$this->product->get_key(),
			( ( 'valid' === $status ) ? $this->product->get_key() . '_mask' : $this->product->get_key() ),
			( ( 'valid' === $status ) ? ( str_repeat( '*', 30 ) . substr( $value, - 5 ) ) : $value ),
			( 'valid' === $status ? 'themeisle-sdk-license-deactivate-cta' : 'themeisle-sdk-license-activate-cta' ),
			( 'valid' === $status ? $valid_string : $invalid_string ),
			$this->product->get_key(),
			( 'valid' === $status ? $deactivate_string : $activate_string ),
			sprintf( $license_message, '<a  href="' . $this->get_api_url() . '">' . $this->get_distributor_name() . '</a> ', $this->product->get_type() ),
			empty( $error_message ) ? '' : sprintf( '<p style="color:#dd3d36">%s</p>', $error_message )
		);

	}

	/**
	 * Return the license status.
	 *
	 * @return string The License status.
	 */
	public function get_license_status() {

		$license_data = get_option( $this->product->get_key() . '_license_data', '' );

		if ( '' === $license_data ) {
			return get_option( $this->product->get_key() . '_license_status', 'not_active' );
		}

		return isset( $license_data->license ) ? $license_data->license : get_option( $this->product->get_key() . '_license_status', 'not_active' );

	}

	/**
	 * Get remote api url.
	 *
	 * @return string Remote api url.
	 */
	public function get_api_url() {
		if ( $this->is_from_partner( $this->product ) ) {
			return 'https://themeisle.com';
		}

		return $this->product->get_store_url();
	}

	/**
	 * Get remote api url.
	 *
	 * @return string Remote api url.
	 */
	public function get_distributor_name() {
		if ( $this->is_from_partner( $this->product ) ) {
			return 'ThemeIsle';
		}

		return $this->product->get_store_name();
	}

	/**
	 *  Show the admin notice regarding the license status.
	 *
	 * @return bool Should we show the notice ?
	 */
	function show_notice() {
		if ( ! is_admin() ) {
			return false;
		}

		if ( apply_filters( $this->product->get_key() . '_hide_license_notices', false ) ) {
			return;
		}
		$status                = $this->get_license_status();
		$no_activations_string = apply_filters( $this->product->get_key() . '_lc_no_activations_string', 'No activations left for %s !!!. You need to upgrade your plan in order to use %s on more websites. Please ask the %s Staff for more details.' );
		$no_valid_string       = apply_filters( $this->product->get_key() . '_lc_no_valid_string', 'In order to benefit from updates and support for %s, please add your license code from your  <a href="%s" target="_blank">purchase history</a> and validate it <a href="%s">here</a>. ' );

		// No activations left for this license.
		if ( 'valid' != $status && $this->check_activation() ) {
			?>
			<div class="error">
				<p><strong>
						<?php
						echo sprintf(
							$no_activations_string,
							$this->product->get_name(),
							$this->product->get_name(),
							'<a href="' . $this->get_api_url() . '" target="_blank">' . $this->get_distributor_name() . '</a>'
						);
						?>
					</strong>
				</p>
			</div>
			<?php
			return false;
		}
		// Invalid license key.
		if ( 'valid' != $status ) {
			?>
			<div class="error">
				<p>
					<strong><?php echo sprintf( $no_valid_string, $this->product->get_name() . ' ' . $this->product->get_type(), $this->get_api_url(), admin_url( 'options-general.php' ) . '#' . $this->product->get_key() . '_license' ); ?> </strong>
				</p>
			</div>
			<?php

			return false;
		}

		return true;
	}

	/**
	 *  Check if the license is active or not.
	 *
	 * @return bool
	 */
	public function check_activation() {
		$license_data = get_option( $this->product->get_key() . '_license_data', '' );
		if ( '' === $license_data ) {
			return false;
		}

		return isset( $license_data->error ) ? ( 'no_activations_left' == $license_data->error ) : false;

	}

	/**
	 *  Check if the license is about to expire in the next month.
	 *
	 * @return bool
	 */
	function check_expiration() {
		$license_data = get_option( $this->product->get_key() . '_license_data', '' );
		if ( '' === $license_data ) {
			return false;
		}
		if ( ! isset( $license_data->expires ) ) {
			return false;
		}
		if ( strtotime( $license_data->expires ) - time() > 30 * 24 * 3600 ) {
			return false;
		}

		return true;
	}

	/**
	 * Return the renew url from the store used.
	 *
	 * @return string The renew url.
	 */
	function renew_url() {
		$license_data = get_option( $this->product->get_key() . '_license_data', '' );
		if ( '' === $license_data ) {
			return $this->get_api_url();
		}
		if ( ! isset( $license_data->download_id ) || ! isset( $license_data->key ) ) {
			return $this->get_api_url();
		}

		return $this->get_api_url() . '/checkout/?edd_license_key=' . $license_data->key . '&download_id=' . $license_data->download_id;
	}

	/**
	 * Run the license check call.
	 */
	public function product_valid() {
		if ( false !== ( $license = get_transient( $this->product->get_key() . '_license_data' ) ) ) {
			return;
		}
		$license = $this->check_license();
		set_transient( $this->product->get_key() . '_license_data', $license, 12 * HOUR_IN_SECONDS );
		update_option( $this->product->get_key() . '_license_data', $license );
	}

	/**
	 *  Check the license status.
	 *
	 * @return object The license data.
	 */
	public function check_license() {
		$status = $this->get_license_status();
		if ( 'not_active' == $status ) {
			$license_data          = new \stdClass();
			$license_data->license = 'not_active';

			return $license_data;
		}
		$license    = trim( $this->license_key );
		$api_params = array(
			'edd_action' => 'check_license',
			'license'    => $license,
			'item_name'  => rawurlencode( $this->product->get_name() ),
			'url'        => rawurlencode( home_url() ),
		);
		// Call the custom API.
		$response = wp_remote_get(
			add_query_arg( $api_params, $this->get_api_url() ),
			array(
				'timeout'   => 15,
				'sslverify' => false,
			)
		);
		if ( is_wp_error( $response ) ) {
			$license_data          = new \stdClass();
			$license_data->license = 'valid';

		} else {
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );
			if ( ! is_object( $license_data ) ) {
				$license_data          = new \stdClass();
				$license_data->license = 'valid';
			}
		}
		$license_old = get_option( $this->product->get_key() . '_license_data', '' );
		if ( 'valid' == $license_old->license && ( $license_data->license != $license_old->license ) ) {
			$this->increment_failed_checks();
		} else {
			$this->reset_failed_checks();
		}

		if ( $this->failed_checks <= self::$max_failed ) {
			return $license_old;
		}

		if ( isset( $license_old->hide_valid ) ) {
			$license_data->hide_valid = true;
		}

		if ( ! isset( $license_data->key ) ) {
			$license_data->key = isset( $license_old->key ) ? $license_old->key : '';
		}

		if ( isset( $license_old->hide_expiration ) ) {
			$license_data->hide_expiration = true;
		}

		if ( isset( $license_old->hide_activation ) ) {
			$license_data->hide_activation = true;
		}

		return $license_data;

	}

	/**
	 * Increment the failed checks.
	 */
	private function increment_failed_checks() {
		$this->failed_checks ++;
		update_option( $this->product->get_key() . '_failed_checks', $this->failed_checks );
	}

	/**
	 * Reset the failed checks
	 */
	private function reset_failed_checks() {
		$this->failed_checks = 1;
		update_option( $this->product->get_key() . '_failed_checks', $this->failed_checks );
	}

	/**
	 * Set license validation error message.
	 *
	 * @param string $message Error message.
	 */
	public function set_error( $message = '' ) {
		set_transient( $this->product->get_key() . 'act_err', $message, MINUTE_IN_SECONDS );

		return;
	}

	/**
	 * Return the last error message.
	 *
	 * @return mixed Error message.
	 */
	public function get_error() {
		return get_transient( $this->product->get_key() . 'act_err' );
	}

	/**
	 * Activate the license remotely.
	 */
	function activate_license() {
		// listen for our activate button to be clicked.
		if ( ! isset( $_POST[ $this->product->get_key() . '_btn_trigger' ] ) ) {
			return;
		}
		$status = $this->get_license_status();
		// retrieve the license from the database.
		$license    = $_POST[ $this->product->get_key() . '_license' ];
		$api_params = array(
			'license'   => $license,
			'item_name' => rawurlencode( $this->product->get_name() ),
			'url'       => rawurlencode( home_url() ),
		);
		if ( 'valid' != $status ) {
			// data to send in our API request.
			$api_params['edd_action'] = 'activate_license';
		} else {
			$api_params['edd_action'] = 'deactivate_license';
		}
		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, $this->get_api_url() ) );
		// make sure the response came back okay.
		if ( is_wp_error( $response ) ) {
			$this->set_error( sprintf( 'ERROR: Failed to connect to the license service. Please try again later. Reason: %s', $response->get_error_message() ) );

			return;
		}

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		if ( ! is_object( $license_data ) ) {
			$this->set_error( 'ERROR: Failed to validate license. Please try again in one minute.' );

			return;
		}
		if ( ! isset( $license_data->license ) ) {
			$license_data->license = 'invalid';
		}

		if ( ! isset( $license_data->key ) ) {
			$license_data->key = $license;
		}
		if ( 'valid' == $license_data->license ) {
			$this->reset_failed_checks();
		}

		$this->set_error( '' );

		if ( 'deactivate_license' === $api_params['edd_action'] ) {

			delete_option( $this->product->get_key() . '_license_data' );
			delete_option( $this->product->get_key() . '_license_plan' );
			delete_transient( $this->product->get_key() . '_license_data' );

			return;
		}
		if ( isset( $license_data->plan ) ) {
			update_option( $this->product->get_key() . '_license_plan', $license_data->plan );
		}
		update_option( $this->product->get_key() . '_license_data', $license_data );
		set_transient( $this->product->get_key() . '_license_data', $license_data, 12 * HOUR_IN_SECONDS );

	}

	/**
	 * Load the Themes screen.
	 */
	function load_themes_screen() {
		add_thickbox();
		add_action( 'admin_notices', array( &$this, 'update_nag' ) );
	}

	/**
	 * Alter the nag for themes update.
	 */
	function update_nag() {
		$theme        = wp_get_theme( $this->product->get_slug() );
		$api_response = get_transient( $this->product_key );
		if ( false === $api_response || ! isset( $api_response->new_version ) ) {
			return;
		}
		$update_url     = wp_nonce_url( 'update.php?action=upgrade-theme&amp;theme=' . urlencode( $this->product->get_slug() ), 'upgrade-theme_' . $this->product->get_slug() );
		$update_message = apply_filters( 'themeisle_sdk_license_update_message', 'Updating this theme will lose any customizations you have made. Cancel to stop, OK to update.' );
		$update_onclick = ' onclick="if ( confirm(\'' . esc_js( $update_message ) . '\') ) {return true;}return false;"';
		if ( version_compare( $this->product->get_version(), $api_response->new_version, '<' ) ) {
			echo '<div id="update-nag">';
			printf(
				'<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.',
				$theme->get( 'Name' ),
				$api_response->new_version,
				sprintf( '%s&TB_iframe=true&amp;width=1024&amp;height=800', $this->product->get_changelog() ),
				$theme->get( 'Name' ),
				$update_url,
				$update_onclick
			);
			echo '</div>';
			echo '<div id="' . $this->product->get_slug() . '_' . 'changelog" style="display:none;">';
			echo wpautop( $api_response->sections['changelog'] );
			echo '</div>';
		}
	}

	/**
	 * Alter update transient.
	 *
	 * @param mixed $value The transient data.
	 *
	 * @return mixed
	 */
	function theme_update_transient( $value ) {
		$update_data = $this->check_for_update();
		if ( $update_data ) {
			$value->response[ $this->product->get_slug() ] = $update_data;
		}

		return $value;
	}

	/**
	 * Check for updates
	 *
	 * @return array|bool Either the update data or false in case of failure.
	 */
	function check_for_update() {
		$update_data = get_transient( $this->product_key );

		if ( false === $update_data ) {
			$failed      = false;
			$update_data = $this->get_version_data();
			if ( empty( $update_data ) ) {
				$failed = true;
			}
			// If the response failed, try again in 30 minutes.
			if ( $failed ) {
				$data              = new \stdClass();
				$data->new_version = $this->product->get_version();
				set_transient( $this->product_key, $data, 30 * MINUTE_IN_SECONDS );

				return false;
			}
			$update_data->sections = isset( $update_data->sections ) ? maybe_unserialize( $update_data->sections ) : null;

			set_transient( $this->product_key, $update_data, 12 * HOUR_IN_SECONDS );
		}
		if ( ! isset( $update_data->new_version ) ) {
			return false;
		}
		if ( version_compare( $this->product->get_version(), $update_data->new_version, '>=' ) ) {
			return false;
		}

		return (array) $update_data;
	}

	/**
	 * Check remote api for latest version.
	 *
	 * @return bool|mixed Update api response.
	 */
	private function get_version_data() {
		$api_params = array(
			'edd_action' => 'get_version',
			'version'    => $this->product->get_version(),
			'license'    => empty( $this->license_key ) ? 'free' : $this->license_key,
			'name'       => rawurlencode( $this->product->get_name() ),
			'slug'       => $this->product->get_slug(),
			'author'     => rawurlencode( $this->get_distributor_name() ),
			'url'        => rawurlencode( home_url() ),
		);
		$response   = wp_remote_get(
			add_query_arg( $api_params, $this->get_api_url() ),
			array(
				'timeout'   => 15,
				'sslverify' => false,
			)
		);
		if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
			return false;
		}
		$update_data = json_decode( wp_remote_retrieve_body( $response ) );
		if ( ! is_object( $update_data ) ) {
			return false;
		}

		return $update_data;
	}

	/**
	 * Delete the update transient
	 */
	function delete_theme_update_transient() {
		delete_transient( $this->product_key );
	}

	/**
	 * Check for Updates at the defined API endpoint and modify the update array.
	 *
	 * @param array $_transient_data Update array build by WordPress.
	 *
	 * @return mixed Modified update array with custom plugin data.
	 */
	public function pre_set_site_transient_update_plugins_filter( $_transient_data ) {
		if ( empty( $_transient_data ) || ! $this->do_check ) {
			$this->do_check = true;

			return $_transient_data;
		}
		$api_response = $this->api_request();
		if ( false !== $api_response && is_object( $api_response ) && isset( $api_response->new_version ) ) {
			if ( version_compare( $this->product->get_version(), $api_response->new_version, '<' ) ) {
				$_transient_data->response[ $this->product->get_slug() . '/' . $this->product->get_file() ] = $api_response;
			}
		}

		return $_transient_data;
	}

	/**
	 * Calls the API and, if successfull, returns the object delivered by the API.
	 *
	 * @param string $_action The requested action.
	 * @param array  $_data Parameters for the API action.
	 *
	 * @return false||object
	 */
	private function api_request( $_action = '', $_data = '' ) {
		$update_data = $this->get_version_data();
		if ( empty( $update_data ) ) {
			return false;
		}
		if ( $update_data && isset( $update_data->sections ) ) {
			$update_data->sections = maybe_unserialize( $update_data->sections );
		}

		return $update_data;
	}

	/**
	 * Updates information on the "View version x.x details" page with custom data.
	 *
	 * @param mixed  $_data Plugin data.
	 * @param string $_action Action to send.
	 * @param object $_args Arguments to use.
	 *
	 * @return object $_data
	 */
	public function plugins_api_filter( $_data, $_action = '', $_args = null ) {
		if ( ( 'plugin_information' != $_action ) || ! isset( $_args->slug ) || ( $_args->slug != $this->product->get_slug() ) ) {
			return $_data;
		}
		$api_response = $this->api_request();
		if ( false !== $api_response ) {
			$_data = $api_response;
		}

		return $_data;
	}

	/**
	 * Disable SSL verification in order to prevent download update failures.
	 *
	 * @param array  $args Http args.
	 * @param string $url Url to check.
	 *
	 * @return array $array
	 */
	function http_request_args( $args, $url ) {
		// If it is an https request and we are performing a package download, disable ssl verification.
		if ( strpos( $url, 'https://' ) !== false && strpos( $url, 'edd_action=package_download' ) ) {
			$args['sslverify'] = false;
		}

		return $args;
	}

	/**
	 * Check if we should load the module for this product.
	 *
	 * @param Product $product Product data.
	 *
	 * @return bool Should we load the module?
	 */
	public function can_load( $product ) {

		if ( $product->is_wordpress_available() ) {
			return false;
		}

		return ( apply_filters( $product->get_key() . '_enable_licenser', true ) === true );

	}

	/**
	 * Load module logic.
	 *
	 * @param Product $product Product to load the module for.
	 *
	 * @return Licenser Module object.
	 */
	public function load( $product ) {
		$this->product = $product;

		$this->product_key = $this->product->get_key() . '-update-response';

		$this->license_key = $this->product->get_license();
		if ( $this->product->requires_license() ) {
			$this->failed_checks = intval( get_option( $this->product->get_key() . '_failed_checks', 0 ) );
			$this->register_license_hooks();
		}

		if ( $this->product->is_plugin() ) {
			add_filter(
				'pre_set_site_transient_update_plugins',
				[
					$this,
					'pre_set_site_transient_update_plugins_filter',
				]
			);
			add_filter( 'plugins_api', array( $this, 'plugins_api_filter' ), 10, 3 );
			add_filter( 'http_request_args', array( $this, 'http_request_args' ), 10, 2 );

			return $this;
		}
		if ( $this->product->is_theme() ) {
			add_filter( 'site_transient_update_themes', array( &$this, 'theme_update_transient' ) );
			add_filter( 'delete_site_transient_update_themes', array( &$this, 'delete_theme_update_transient' ) );
			add_action( 'load-update-core.php', array( &$this, 'delete_theme_update_transient' ) );
			add_action( 'load-themes.php', array( &$this, 'delete_theme_update_transient' ) );
			add_action( 'load-themes.php', array( &$this, 'load_themes_screen' ) );
			add_filter( 'http_request_args', array( $this, 'disable_wporg_update' ), 5, 2 );

			return $this;

		}

		return $this;
	}

	/**
	 * Register license fields for the products.
	 */
	public function register_license_hooks() {
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_init', array( $this, 'activate_license' ) );
		add_action( 'admin_init', array( $this, 'product_valid' ), 99999999 );
		add_action( 'admin_notices', array( $this, 'show_notice' ) );
		add_filter( $this->product->get_key() . '_license_status', array( $this, 'get_license_status' ) );
	}
}
