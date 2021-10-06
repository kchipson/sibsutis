<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Orbit_Fox
 * @subpackage Orbit_Fox/app
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Orbit_Fox
 * @subpackage Orbit_Fox/app
 * @author     Themeisle <friends@themeisle.com>
 */
class Orbit_Fox_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Orbit_Fox_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Orbit_Fox_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$screen = get_current_screen();
		if ( empty( $screen ) ) {
			return;
		}
		if ( in_array( $screen->id, array( 'toplevel_page_obfx_companion' ), true ) ) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../assets/css/orbit-fox-admin.css', array(), $this->version, 'all' );
		}
		do_action( 'obfx_admin_enqueue_styles' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Orbit_Fox_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Orbit_Fox_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$screen = get_current_screen();
		if ( empty( $screen ) ) {
			return;
		}
		if ( in_array( $screen->id, array( 'toplevel_page_obfx_companion' ), true ) ) {
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../assets/js/orbit-fox-admin.js', array( 'jquery' ), $this->version, false );
		}
		do_action( 'obfx_admin_enqueue_scripts' );
	}

	/**
	 * Add admin menu items for orbit-fox.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function menu_pages() {
		add_menu_page(
			__( 'Orbit Fox', 'themeisle-companion' ),
			__( 'Orbit Fox', 'themeisle-companion' ),
			'manage_options',
			'obfx_companion',
			array(
				$this,
				'page_modules_render',
			),
			'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MzQuNjIiIGhlaWdodD0iMzkxLjMzIiB2aWV3Qm94PSIwIDAgNDM0LjYyIDM5MS4zMyI+PGRlZnM+PHN0eWxlPi5he2ZpbGw6I2ZmZjt9PC9zdHlsZT48L2RlZnM+PHRpdGxlPmxvZ28tb3JiaXQtZm94LTI8L3RpdGxlPjxwYXRoIGNsYXNzPSJhIiBkPSJNNzA4LjE1LDM5NS4yM2gwYy0xLjQ5LTEzLjc2LTcuNjEtMjkuMjEtMTUuOTQtNDQuNzZsLTE0LjQ2LDguMzVhNzYsNzYsMCwxLDEtMTQ1LDQyLjd2MUg0OTEuMWE3Niw3NiwwLDEsMS0xNDQuODYtNDMuNjVsLTE0LjQyLTguMzNjLTguMTcsMTUuMjgtMTQuMjIsMzAuNDctMTUuODMsNDQtLjA2LjM3LS4xMS43NS0uMTQsMS4xMnMtLjA2LjQ2LS4wOC42OGguMDVBMTUuNTcsMTUuNTcsMCwwLDAsMzIwLjM1LDQwOEw1MDEsNTU1LjExYTE1LjU0LDE1LjU0LDAsMCwwLDExLDQuNTVoMGExNS41NCwxNS41NCwwLDAsMCwxMS00LjU1TDcwMy42OSw0MDhBMTUuNjMsMTUuNjMsMCwwLDAsNzA4LjE1LDM5NS4yM1pNNDc5LjU5LDQ0MC41MWwyMi4wNSw1LjkxLTIuMDcsNy43My0yMi4wNS01LjkxWm0zLDE4Ljc1LDIyLjA1LDUuOTEtMi4wNyw3LjczTDQ4MC41Miw0NjdabTEsMTguNzUsMjIuMDUsNS45MS0yLjA3LDcuNzMtMjIuMDUtNS45MVptMzEsNjMuMzhhMTIuMzgsMTIuMzgsMCwwLDAtMSwuOTEsMi4yMSwyLjIxLDAsMCwxLTEuNTguNjNoMGEyLjIxLDIuMjEsMCwwLDEtMS41OC0uNjMsMTIuMzgsMTIuMzgsMCwwLDAtMS0uOTFMNDg2Ljg5LDUyM2M4LjItLjUzLDE2LjYzLS44MSwyNS4xMS0uODFzMTYuOTMuMjgsMjUuMTUuODFabTUuODktNDkuNzQtMi4wNy03LjczTDU0MC40OSw0NzhsMi4wNyw3LjczWm0xLTE4Ljc1LTIuMDctNy43MywyMi4wNi01LjkxLDIuMDcsNy43M1ptMy0xOC43NS0yLjA3LTcuNzMsMjIuMDYtNS45MSwyLjA3LDcuNzNaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMjk0LjY5IC0xNjguMzQpIi8+PHBhdGggY2xhc3M9ImEiIGQ9Ik03MjkuMjYsMjA5YTEyMC4xOCwxMjAuMTgsMCwwLDAtMS4xOC0xNC43OGMtLjEzLS44OC0uMjctMS43Mi0uNDItMi41Ni0uMjItMS4yLS40Ni0yLjM1LS43Mi0zLjQ3LS4xOC0uNzktLjM4LTEuNTctLjU4LTIuMzItLjM2LTEuMjgtLjc0LTIuNDgtMS4xNi0zLjYyLS4zNi0uOTUtLjc0LTEuODUtMS4xNS0yLjctLjItLjQzLS40MS0uODQtLjYzLTEuMjRzLS40My0uNzktLjY1LTEuMTVhMTkuNzYsMTkuNzYsMCwwLDAtMS4xNS0xLjY4LDE0LjE5LDE0LjE5LDAsMCwwLTEuMTUtMS4zNiwxMS44NywxMS44NywwLDAsMC0xLS45MWMtLjExLS4xLS4yNS0uMTgtLjM3LS4yN2ExNS4yMSwxNS4yMSwwLDAsMC0yLjU0LTEuNTlsLTEuMDYtLjQ5YTI1LjU3LDI1LjU3LDAsMCwwLTMuODUtMS4yNWMtLjc0LS4xOC0xLjUyLS4zNS0yLjMzLS40OS0xLjExLS4xOS0yLjI4LS4zNS0zLjUtLjQ3cy0yLjY5LS4yMS00LjExLS4yNWMtMi4xNC0uMDctNC4zOSwwLTYuNzMuMDktMS41Ny4wOC0zLjE4LjItNC44Mi4zNmwtMi44MS4zYTE3MSwxNzEsMCwwLDAtMTgsMy4xN2wtMy4xMi43NHEtNC44NywxLjItOS43OSwyLjY0Yy0zLjI3LDEtNi41NCwyLTkuNzcsMy4xMXEtNS4yNCwxLjc4LTEwLjMsNGMtLjg1LjM3LTEuNjkuNzUtMi41MywxLjE0cS0zLjc4LDEuNzYtNy40OCwzLjc4YTE0Mi4zNywxNDIuMzcsMCwwLDAtMTIuOCw3Ljg4Yy0xLjQsMS0yLjgxLDItNC4yLDNhMjAxLjUzLDIwMS41MywwLDAsMC0yMy43LDIwLjc3Yy0yMC4zNy0xNC00Mi4zLTIwLTczLjctMjAuNDZ2MS43N2gwdi0xLjc3Yy0zMS40MS41LTUzLjM1LDYuNDQtNzMuNzIsMjAuNDctMTkuODQtMjAuMS0zOS4yNi0zMy4xNi02MS00MC42LTI5LjU2LTEwLjExLTYyLTE0LjU5LTcyLjc2LTUuNnMtMTEuOTUsNDEuNzYtNy4xMyw3Mi42M2M0LjU1LDI5LjEsMTguODMsNTYsNDQuNzgsODdsMCwuMDYsMTQuNDgsOC4zNkE3Niw3NiwwLDAsMSw0OTIuMjIsMzgyaDM5LjU2QTc2LDc2LDAsMCwxLDY2Ny40LDM0MS4xOWwxNC41Mi04LjM5LDAtLjA3cTMuNTctNC4yNiw2Ljg0LTguNDNjMS41LTEuODksMi45NC0zLjc3LDQuMzQtNS42NHMyLjc2LTMuNzMsNC4wNy01LjU3Yy42Ni0uOTIsMS4zLTEuODQsMS45NC0yLjc2cTEuOS0yLjc2LDMuNjctNS40OCwyLjY3LTQuMSw1LTguMTN0NC40NS04LjA1Yy45Mi0xLjc4LDEuODEtMy41NiwyLjY1LTUuMzRxMS44OS00LDMuNTEtOGMuNzItMS43OCwxLjM5LTMuNTUsMi01LjMzLjMyLS44OC42My0xLjc3LjkzLTIuNjYuNi0xLjc4LDEuMTUtMy41NiwxLjY3LTUuMzRhMTMxLjU0LDEzMS41NCwwLDAsMCwzLjYxLTE2LjIxLDIyMS4yNCwyMjEuMjQsMCwwLDAsMi42OC0zMS40NkM3MjkuMzIsMjEyLjUyLDcyOS4zMSwyMTAuNzMsNzI5LjI2LDIwOVpNMzg5LjMxLDI2OC43OWMtOS4yOSwxMS41OC0yMi4zNywyNy43Ni0zNC45NCw0NS42Ni0xMS42NC0xNi45Mi0yNC43Ni0zOC42MS0yNy40OS01Ny42NS0zLjEzLTIxLjg2LTEuOTQtMzcuNTktLjA3LTQzLjQ4YTMyLjY1LDMyLjY1LDAsMCwxLDQuMjktLjI1YzkuODYsMCwyNC4yOCwyLjkyLDM4LjU5LDcuODEsMTMuNTMsNC42MywyNi4xNSwxMi41NiwzOS4yNiwyNC44NUM0MDIuNjgsMjUyLjU0LDM5Ni4yMSwyNjAuMTksMzg5LjMxLDI2OC43OVptMzA3LjgxLTEyYy0yLjczLDE5LTE1LjgzLDQwLjctMjcuNDYsNTcuNjEtMTIuNTctMTcuODgtMjUuNjQtMzQuMDUtMzQuOTMtNDUuNjItNi45MS04LjYxLTEzLjM4LTE2LjI2LTE5LjY2LTIzLjA4LDEzLjExLTEyLjI4LDI1LjcyLTIwLjIsMzkuMjQtMjQuODMsMTQuMzEtNC44OSwyOC43My03LjgxLDM4LjU5LTcuODFhMzIuNjUsMzIuNjUsMCwwLDEsNC4yOS4yNUM2OTkuMDYsMjE5LjIxLDcwMC4yNSwyMzQuOTQsNjk3LjEyLDI1Ni44WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTI5NC42OSAtMTY4LjM0KSIvPjxwYXRoIGNsYXNzPSJhIiBkPSJNNDE2LjQ0LDMzMS41N0E1Ni41MSw1Ni41MSwwLDEsMCw0NzMsMzg4LjA4LDU2LjU3LDU2LjU3LDAsMCwwLDQxNi40NCwzMzEuNTdabTMxLjYyLDg2LjM2YTIzLjQ0LDIzLjQ0LDAsMSwxLDUtNy4zOCw5LjI1LDkuMjUsMCwwLDEtMS43OSwzLjM5QTIyLjcxLDIyLjcxLDAsMCwxLDQ0OC4wNiw0MTcuOTNaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMjk0LjY5IC0xNjguMzQpIi8+PHBhdGggY2xhc3M9ImEiIGQ9Ik02MDcuNTYsMzMxLjU3YTU2LjUxLDU2LjUxLDAsMSwwLDU2LjUxLDU2LjUxQTU2LjU3LDU2LjU3LDAsMCwwLDYwNy41NiwzMzEuNTdabTEuNTMsODYuMzZhMjMuNDIsMjMuNDIsMCwwLDEtMzMuMTMsMCwyMy4xOCwyMy4xOCwwLDAsMS0zLjE5LTQsOS4wOCw5LjA4LDAsMCwxLTEuNzgtMy4zOSwyMy40MiwyMy40MiwwLDEsMSwzOC4xLDcuMzhaIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMjk0LjY5IC0xNjguMzQpIi8+PC9zdmc+',
			'75'
		);
		add_submenu_page( 'obfx_companion', __( 'Orbit Fox General Options', 'themeisle-companion' ), __( 'General Settings', 'themeisle-companion' ), 'manage_options', 'obfx_companion' );
	}

	/**
	 * Add the initial dashboard notice to guide the user to the OrbitFox admin page.
	 *
	 * @since   2.3.4
	 * @access  public
	 */
	public function visit_dashboard_notice() {
		global $current_user;
		$user_id = $current_user->ID;
		if ( ! get_user_meta( $user_id, 'obfx_ignore_visit_dashboard_notice' ) ) { ?>
			<div class="notice notice-info" style="position:relative;">
				<p><?php echo sprintf( __( 'You have activated Orbit Fox plugin! Go to the %s to get started with the extra features.', 'themeisle-companion' ), sprintf( '<a href="%s">%s</a>', add_query_arg( 'obfx_ignore_visit_dashboard_notice', '0', admin_url( 'admin.php?page=obfx_companion' ) ), __( 'Dashboard Page', 'themeisle-companion' ) ) ); ?></p>
				<a href="<?php echo add_query_arg( 'obfx_ignore_visit_dashboard_notice', '0', admin_url( 'admin.php?page=obfx_companion' ) ); ?>"
				   class="notice-dismiss" style="text-decoration: none;">
					<span class="screen-reader-text">Dismiss this notice.</span>
				</a>
			</div>
			<?php
		}
	}

	/**
	 * Dismiss the initial dashboard notice.
	 *
	 * @since   2.3.4
	 * @access  public
	 */
	function visit_dashboard_notice_dismiss() {
		global $current_user;
		$user_id = $current_user->ID;
		// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
		if ( isset( $_GET['obfx_ignore_visit_dashboard_notice'] ) && '0' == $_GET['obfx_ignore_visit_dashboard_notice'] ) {
			add_user_meta( $user_id, 'obfx_ignore_visit_dashboard_notice', 'true', true );
			wp_safe_redirect( admin_url( 'admin.php?page=obfx_companion' ) );
		}
	}

	/**
	 * Define partners data.
	 */
	public function load_recommended_partners() {
		add_filter(
			'wpforms_upgrade_link',
			function ( $url ) {
				return 'http://www.shareasale.com/r.cfm?B=837827&U=848264&M=64312&urllink=' . rawurlencode( $url );
			}
		);

		if ( get_option( 'translatepress_avg_affiliate_id', false ) === false ) {
			update_option( 'translatepress_avg_affiliate_id', '91096' );
		}

	}

	/**
	 * Calls the orbit_fox_modules hook.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function load_modules() {
		do_action( 'orbit_fox_modules' );
	}

	/**
	 * This method is called via AJAX and processes the
	 * request for updating module options.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function obfx_update_module_options() {
		$json                = stripslashes( str_replace( '&quot;', '"', $_POST['data'] ) );
		$data                = json_decode( $json, true );
		$response['type']    = 'error';
		$response['message'] = __( 'Could not process the request!', 'themeisle-companion' );
		if ( isset( $data['noance'] ) && wp_verify_nonce( $data['noance'], 'obfx_update_module_options_' . $data['module-slug'] ) ) {
			$response = $this->try_module_save( $data );
		}
		echo json_encode( $response );
		wp_die();
	}

	/**
	 * A method used for saving module options data
	 * and returning a well formatted response as an array.
	 *
	 * @codeCoverageIgnore
	 *
	 * @param array $data The options data to try and save via the module model.
	 *
	 * @return array
	 * @since   1.0.0
	 * @access  public
	 */
	public function try_module_save( $data ) {
		$response            = array();
		$global_settings     = new Orbit_Fox_Global_Settings();
		$modules             = $global_settings::$instance->module_objects;
		$response['type']    = 'error';
		$response['message'] = __( 'No module found! No data was updated.', 'themeisle-companion' );
		if ( isset( $modules[ $data['module-slug'] ] ) ) {
			$module = $modules[ $data['module-slug'] ];
			unset( $data['noance'] );
			unset( $data['module-slug'] );
			$response['type']    = 'warning';
			$response['message'] = __( 'Something went wrong, data might not be saved!', 'themeisle-companion' );
			$result              = $module->set_options( $data );
			if ( $result ) {
				$response['type']    = 'success';
				$response['message'] = __( 'Options updated, successfully!', 'themeisle-companion' );
			}
		}

		return $response;
	}

	/**
	 * Define render function for recommended tab.
	 */
	public function load_recommended_plugins() {
		$plugins = [
			'optimole-wp',
			'feedzy-rss-feeds',
			'wpforms-lite',
			'translatepress-multilingual',
			'autoptimize',
			'wordpress-seo',
		];
		shuffle( $plugins );
		add_thickbox();
		echo sprintf( '<div class="obfx-recommended-title-wrapper"><span class="obfx-recommended-title"><span class="dashicons dashicons-megaphone"></span> &nbsp; %s</span><span class="obfx-recommended-disclosure"><i> <span class="dashicons dashicons-editor-help obfx-show-disclosure"></span>Some of these plugins are developed by us and from some others if you use them and upgrade to pro, we might earn a comission.</i></span><div class="clearfix"></div> </div>', 'Orbit Fox recommends' );
		foreach ( $plugins as $plugin ) {
			$current_plugin = $this->call_plugin_api( $plugin );
			if ( ! isset( $current_plugin->name ) ) {
				continue;
			}
			$image = $current_plugin->icons['1x'];
			$name  = $current_plugin->name;
			$desc  = $current_plugin->short_description;
			$url   = add_query_arg(
				array(
					'tab'       => 'plugin-information',
					'plugin'    => $plugin,
					'TB_iframe' => true,
					'width'     => 800,
					'height'    => 800,
				),
				network_admin_url( 'plugin-install.php' )
			);
			echo sprintf(
				'<div class="tile obfx-recommended ">
					<div class="tile-icon">
						<div class="obfx-icon-recommended">
							<img  width="100" src="%s"/>
						</div>
					</div>
					<div class="tile-content">
						<p class="tile-title">%s</p>
						<p class="tile-subtitle">%s</p>
					</div>
					<div class="tile-action">
						<div class="form-group">
							<label class="form-switch activated">
								 <a class="button button-primary thickbox " href="%s"><span class="dashicons dashicons-download"></span>%s</a>
							</label>
						</div>
					</div>
				</div>',
				esc_url( $image ),
				esc_attr( $name ),
				esc_attr( $desc ),
				esc_url( $url ),
				__( 'Install', 'themeisle-companion' )
			);
		}

	}

	/**
	 * Get info from wporg api.
	 *
	 * @param string $slug Plugin slug.
	 *
	 * @return array|mixed|object|WP_Error
	 */
	public function call_plugin_api( $slug ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );

		$call_api = get_transient( 'ti_plugin_info_' . $slug );

		if ( false === $call_api ) {
			$call_api = plugins_api(
				'plugin_information',
				array(
					'slug'   => $slug,
					'fields' => array(
						'downloaded'        => false,
						'rating'            => false,
						'description'       => false,
						'short_description' => true,
						'donate_link'       => false,
						'tags'              => false,
						'sections'          => true,
						'homepage'          => true,
						'added'             => false,
						'last_updated'      => false,
						'compatibility'     => false,
						'tested'            => false,
						'requires'          => false,
						'downloadlink'      => false,
						'icons'             => true,
						'banners'           => true,
					),
				)
			);
			set_transient( 'ti_plugin_info_' . $slug, $call_api, 1 * DAY_IN_SECONDS );
		}

		return $call_api;
	}

	/**
	 * This method is called via AJAX and processes the
	 * request for updating module options.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function obfx_update_module_active_status() {
		$json                = stripslashes( str_replace( '&quot;', '"', $_POST['data'] ) );
		$data                = json_decode( $json, true );
		$response['type']    = 'error';
		$response['message'] = __( 'Could not process the request!', 'themeisle-companion' );
		if ( isset( $data['noance'] ) && wp_verify_nonce( $data['noance'], 'obfx_activate_mod_' . $data['name'] ) ) {
			$response = $this->try_module_activate( $data );
		}
		echo json_encode( $response );
		wp_die();
	}

	/**
	 * A method used for saving module status data
	 * and returning a well formatted response as an array.
	 *
	 * @codeCoverageIgnore
	 *
	 * @param array $data The data to try and update status via the module model.
	 *
	 * @return array
	 * @since   1.0.0
	 * @access  public
	 */
	public function try_module_activate( $data ) {
		$response            = array();
		$global_settings     = new Orbit_Fox_Global_Settings();
		$modules             = $global_settings::$instance->module_objects;
		$response['type']    = 'error';
		$response['message'] = __( 'No module found!', 'themeisle-companion' );
		if ( isset( $modules[ $data['name'] ] ) ) {
			$module              = $modules[ $data['name'] ];
			$response['type']    = 'warning';
			$response['message'] = __( 'Something went wrong, can not change module status!', 'themeisle-companion' );
			$result              = $module->set_status( 'active', $data['checked'] );
			$this->trigger_activate_deactivate( $data['checked'], $module );
			if ( $result ) {
				$response['type']    = 'success';
				$response['message'] = __( 'Module status changed!', 'themeisle-companion' );
			}
		}

		return $response;
	}

	/**
	 * A method to trigger module activation or deavtivation hook
	 * based in active status.
	 *
	 * @codeCoverageIgnore
	 *
	 * @param boolean                   $active_status The active status.
	 * @param Orbit_Fox_Module_Abstract $module The module referenced.
	 *
	 * @since   2.3.3
	 * @access  public
	 */
	public function trigger_activate_deactivate( $active_status, Orbit_Fox_Module_Abstract $module ) {
		if ( $active_status === true ) {
			do_action( $module->get_slug() . '_activate' );
		} else {
			do_action( $module->get_slug() . '_deactivate' );
		}
	}

	/**
	 * Method to display modules page.
	 *
	 * @codeCoverageIgnore
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function page_modules_render() {
		$global_settings = new Orbit_Fox_Global_Settings();

		$modules = $global_settings::$instance->module_objects;

		$rdh           = new Orbit_Fox_Render_Helper();
		$tiles         = '';
		$panels        = '';
		$toasts        = '';
		$count_modules = 0;
		foreach ( $modules as $slug => $module ) {
			if ( $module->enable_module() ) {
				$notices        = $module->get_notices();
				$showed_notices = $module->get_status( 'showed_notices' );
				if ( ! is_array( $showed_notices ) ) {
					$showed_notices = array();
				}
				if ( isset( $showed_notices ) && is_array( $showed_notices ) ) {
					foreach ( $notices as $notice ) {
						$hash = md5( serialize( $notice ) );
						$data = array(
							'notice' => $notice,
						);
						// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
						if ( $notice['display_always'] == false && ! in_array( $hash, $showed_notices, true ) ) {
							$toasts .= $rdh->get_partial( 'module-toast', $data );
							// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
						} elseif ( $notice['display_always'] == true ) {
							$toasts .= $rdh->get_partial( 'module-toast', $data );
						}
					}
				}

				$module->update_showed_notices();
				if ( $module->auto === false ) {
					$count_modules ++;
					$checked = '';
					if ( $module->get_is_active() ) {
						$checked = 'checked';
					}

					$data  = array(
						'slug'           => $slug,
						'name'           => $module->name,
						'description'    => $module->description,
						'checked'        => $checked,
						'beta'           => $module->beta,
						'confirm_intent' => $module->confirm_intent,
					);
					$tiles .= $rdh->get_partial( 'module-tile', $data );
					$tiles .= '<div class="divider"></div>';
				}

				$module_options = $module->get_options();
				$options_fields = '';
				if ( ! empty( $module_options ) ) {
					foreach ( $module_options as $option ) {
						$options_fields .= $rdh->render_option( $option, $module );
					}

					$panels .= $rdh->get_partial(
						'module-panel',
						array(
							'slug'           => $slug,
							'name'           => $module->name,
							'active'         => $module->get_is_active(),
							'description'    => $module->description,
							'show'           => $module->show,
							'no_save'        => $module->no_save,
							'options_fields' => $options_fields,
						)
					);
				}
			}// End if().
		}// End foreach().

		$no_modules = false;
		$empty_tpl  = '';
		if ( $count_modules === 0 ) {
			$no_modules = true;
			$empty_tpl  = $rdh->get_partial(
				'empty',
				array(
					'title'     => __( 'No modules found.', 'themeisle-companion' ),
					'sub_title' => __( 'Please contact support for more help.', 'themeisle-companion' ),
					'show_btn'  => true,
				)
			);
			$panels     = $rdh->get_partial(
				'empty',
				array(
					'title'     => __( 'No active modules.', 'themeisle-companion' ),
					'sub_title' => __( 'Activate a module using the toggles above.', 'themeisle-companion' ),
					'show_btn'  => false,
				)
			);
		}

		$data   = array(
			'no_modules'    => $no_modules,
			'empty_tpl'     => $empty_tpl,
			'count_modules' => $count_modules,
			'tiles'         => $tiles,
			'toasts'        => $toasts,
			'panels'        => $panels,
		);
		$output = $rdh->get_view( 'modules', $data );
		echo $output;
	}

}
