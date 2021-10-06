<?php
/**
 * Popularis Customizer Notification Section Class.
 *
 * @package Popularis
 */

/**
 * Popularis_Customizer_Notice_Section class
 */
class Popularis_Customizer_Notice_Section extends WP_Customize_Section {
	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'customizer-plugin-notice-section';
	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $recommended_actions = '';
	/**
	 * Recommended Plugins.
	 *
	 * @var string
	 */
	public $recommended_plugins = '';
	/**
	 * Total number of required actions.
	 *
	 * @var string
	 */
	public $total_actions = '';
	/**
	 * Plugin text.
	 *
	 * @var string
	 */
	public $plugin_text = '';
	/**
	 * Dismiss button.
	 *
	 * @var string
	 */
	public $dismiss_button = '';

	/**
	 * Check if plugin is installed/activated
	 *
	 * @param plugin-slug $slug the plugin slug.
	 *
	 * @return array
	 */
	public function check_active( $slug ) {
		if ( file_exists( ABSPATH . 'wp-content/plugins/' . $slug . '/' . $slug . '.php' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			$needs = is_plugin_active( $slug . '/' . $slug . '.php' ) ? 'deactivate' : 'activate';

			return array(
				'status' => is_plugin_active( $slug . '/' . $slug . '.php' ),
				'needs' => $needs,
			);
		}

		return array(
			'status' => false,
			'needs' => 'install',
		);
	}

	/**
	 * Create the install/activate button link for plugins
	 *
	 * @param plugin-state $state The plugin state (not installed/inactive/active).
	 * @param plugin-slug  $slug The plugin slug.
	 *
	 * @return mixed
	 */
	public function create_action_link( $state, $slug ) {
		switch ( $state ) {
			case 'install':
				return wp_nonce_url(
					add_query_arg(
						array(
							'action' => 'install-plugin',
							'plugin' => $slug,
						),
						network_admin_url( 'update.php' )
					),
					'install-plugin_' . $slug
				);
				break;
			case 'deactivate':
				return add_query_arg(
					array(
						'action'        => 'deactivate',
						'plugin'        => rawurlencode( $slug . '/' . $slug . '.php' ),
						'plugin_status' => 'all',
						'paged'         => '1',
						'_wpnonce'      => wp_create_nonce( 'deactivate-plugin_' . $slug . '/' . $slug . '.php' ),
					), network_admin_url( 'plugins.php' )
				);
				break;
			case 'activate':
				return add_query_arg(
					array(
						'action'        => 'activate',
						'plugin'        => rawurlencode( $slug . '/' . $slug . '.php' ),
						'plugin_status' => 'all',
						'paged'         => '1',
						'_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $slug . '/' . $slug . '.php' ),
					), network_admin_url( 'plugins.php' )
				);
				break;
		}// End switch().
	}

	/**
	 * Call plugin API to get plugins info
	 *
	 * @param plugin-slug $slug The plugin slug.
	 *
	 * @return mixed
	 */
	public function call_plugin_api( $slug ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
		$call_api = get_transient( 'cust_notice_plugin_info_' . $slug );
		if ( false === $call_api ) {
			$call_api = plugins_api(
				'plugin_information', array(
					'slug'   => $slug,
					'fields' => array(
						'downloaded'        => false,
						'rating'            => false,
						'description'       => false,
						'short_description' => true,
						'donate_link'       => false,
						'tags'              => false,
						'sections'          => false,
						'homepage'          => false,
						'added'             => false,
						'last_updated'      => false,
						'compatibility'     => false,
						'tested'            => false,
						'requires'          => false,
						'downloadlink'      => false,
						'icons'             => false,
					),
				)
			);
			set_transient( 'cust_notice_plugin_info_' . $slug, $call_api, 30 * MINUTE_IN_SECONDS );
		}

		return $call_api;
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function json() {
		$json = parent::json();
		global $popularis_recommended_plugins;

		global $install_button_label;
		global $activate_button_label;
		global $deactivate_button_label;
        
        $customize_plugins = array();

		$show_recommended_plugins = get_option( 'popularis_show_recommended_plugins' );

		foreach ( $popularis_recommended_plugins as $slug => $plugin_opt ) {

			if ( ! $plugin_opt['recommended'] ) {
				continue;
			}

			if ( isset( $show_recommended_plugins[ $slug ] ) && $show_recommended_plugins[ $slug ] ) {
				continue;
			}

			$active = $this->check_active( $slug );

			if ( ! empty( $active['needs'] ) && ( $active['needs'] == 'deactivate' ) ) {
				continue;
			}

			$popularis_recommended_plugin['url']    = $this->create_action_link( $active['needs'], $slug );
			if ( $active['needs'] !== 'install' && $active['status'] ) {
				$popularis_recommended_plugin['class'] = 'active';
			} else {
				$popularis_recommended_plugin['class'] = '';
			}

			switch ( $active['needs'] ) {
				case 'install':
					$popularis_recommended_plugin['button_class'] = 'install-now button';
					$popularis_recommended_plugin['button_label'] = $install_button_label;
					break;
				case 'activate':
					$popularis_recommended_plugin['button_class'] = 'activate-now button button-primary';
					$popularis_recommended_plugin['button_label'] = $activate_button_label;
					break;
				case 'deactivate':
					$popularis_recommended_plugin['button_class'] = 'deactivate-now button';
					$popularis_recommended_plugin['button_label'] = $deactivate_button_label;
					break;
			}
			$info   = $this->call_plugin_api( $slug );
			$popularis_recommended_plugin['id'] = $slug;
			$popularis_recommended_plugin['plugin_slug'] = $slug;

			if ( ! empty( $plugin_opt['description'] ) ) {
				$popularis_recommended_plugin['description'] = $plugin_opt['description'];
			} else {
				$popularis_recommended_plugin['description'] = $info->short_description;
			}

			$popularis_recommended_plugin['title'] = $info->name;

			$customize_plugins[] = $popularis_recommended_plugin;

		}// End foreach().

		$json['recommended_plugins'] = $customize_plugins;
		$json['plugin_text']         = $this->plugin_text;
		$json['dismiss_button']      = $this->dismiss_button;
		return $json;

	}
	/**
	 * Outputs the structure for the customizer control
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() {
	?>
		<# if( data.recommended_plugins.length > 0 ){ #>
			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

				<h3 class="accordion-section-title">
					<span class="section-title" data-plugin_text="{{ data.plugin_text }}">
						<# if( data.recommended_plugins.length > 0 ){ #>
							{{ data.plugin_text }}
						<# } #>
					</span>					
				</h3>
				<div class="recomended-actions_container" id="plugin-filter">
					<# if( data.recommended_plugins.length > 0 ){ #>
						<# for (action in data.recommended_plugins) { #>
							<div class="popularis-recommeded-actions-container popularis-recommended-plugins" data-index="{{ data.recommended_plugins[action].index }}">
								<# if( !data.recommended_plugins[action].check ){ #>
									<div class="popularis-recommeded-actions">
										<p class="title">{{ data.recommended_plugins[action].title }}</p>
										<span data-action="dismiss" class="dashicons dashicons-no dismiss-button-recommended-plugin" id="{{ data.recommended_plugins[action].id }}"></span>
										<div class="description">{{{ data.recommended_plugins[action].description }}}</div>
										<# if( data.recommended_plugins[action].plugin_slug ){ #>
											<div class="custom-action">
												<p class="plugin-card-{{ data.recommended_plugins[action].plugin_slug }} action_button {{ data.recommended_plugins[action].class }}">
													<a data-slug="{{ data.recommended_plugins[action].plugin_slug }}"
													   class="{{ data.recommended_plugins[action].button_class }}"
													   href="{{ data.recommended_plugins[action].url }}">{{ data.recommended_plugins[action].button_label }}</a>
												</p>
											</div>
										<# } #>
										<# if( data.recommended_plugins[action].help ){ #>
											<div class="custom-action">{{{ data.recommended_plugins[action].help }}}</div>
										<# } #>
									</div>
								<# } #>
							</div>
						<# } #>
					<# } #>
				</div>
			</li>
		<# } #>
	<?php
	}
}