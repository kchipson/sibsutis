<?php
/**
 * Analytics panel.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.4.5
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2017, WPForms LLC
 */
class WPForms_Builder_Panel_Analytics extends WPForms_Builder_Panel {

	/**
	 * All systems go.
	 *
	 * @since 1.4.5
	 */
	public function init() {

		// Define panel information.
		$this->name    = esc_html__( 'Analytics', 'wpforms-lite' );
		$this->slug    = 'analytics';
		$this->icon    = 'fa-bar-chart';
		$this->order   = 10;
		$this->sidebar = true;
	}

	/**
	 * Enqueue assets for the Providers panel.
	 *
	 * @since 1.4.5
	 */
	public function enqueues() {

		wp_enqueue_style(
			'wpforms-builder-providers',
			WPFORMS_PLUGIN_URL . 'assets/css/admin-builder-providers.css',
			null,
			WPFORMS_VERSION
		);

		wp_enqueue_script(
			'wpforms-builder-providers',
			WPFORMS_PLUGIN_URL . 'assets/js/admin-builder-providers.js',
			array( 'jquery' ),
			WPFORMS_VERSION,
			false
		);

		wp_localize_script(
			'wpforms-builder-providers',
			'wpforms_builder_providers',
			array(
				'url'                => esc_url( add_query_arg( array( 'view' => 'providers' ) ) ),
				'confirm_save'       => esc_html__( 'We need to save your progress to continue to the Marketing panel. Is that OK?', 'wpforms-lite' ),
				'confirm_connection' => esc_html__( 'Are you sure you want to delete this connection?', 'wpforms-lite' ),
				'prompt_connection'  => esc_html__( 'Enter a %type% nickname', 'wpforms-lite' ),
				'prompt_placeholder' => esc_html__( 'Eg: Newsletter Optin', 'wpforms-lite' ),
				'error_name'         => esc_html__( 'You must provide a connection nickname', 'wpforms-lite' ),
				'required_field'     => esc_html__( 'Field required', 'wpforms-lite' ),
			)
		);
	}

	/**
	 * Outputs the Analytics panel sidebar.
	 *
	 * @since 1.4.5
	 */
	public function panel_sidebar() {

		// Sidebar contents are not valid unless we have a form.
		if ( ! $this->form ) {
			return;
		}

		$this->panel_sidebar_section( esc_html__( 'Default', 'wpforms-lite' ), 'default' );

		do_action( 'wpforms_analytics_panel_sidebar', $this->form );
	}

	/**
	 * Outputs the Analytics panel primary content.
	 *
	 * @since 1.4.5
	 */
	public function panel_content() {

		// An array of all the active analytics addons.
		$analytics_active = apply_filters( 'wpforms_analytics_available', array() );

		if ( ! $this->form ) {

			// Check if there is a form created. When no form has been created
			// yet let the user know we need a form to setup a provider.
			echo '<div class="wpforms-alert wpforms-alert-info">';
			echo wp_kses(
				__( 'You need to <a href="#" class="wpforms-panel-switch" data-panel="setup">setup your form</a> before you can manage these settings.', 'wpforms-lite' ),
				array(
					'a' => array(
						'href'       => array(),
						'class'      => array(),
						'data-panel' => array(),
					),
				)
			);
			echo '</div>';

			return;
		}

		if ( empty( $analytics_active ) ) {

			// Check for active provider addons. When no provider addons are
			// activated let the user know they need to install/activate an
			// addon to setup a provider.
			echo '<div class="wpforms-panel-content-section wpforms-panel-content-section-info">';
			echo '<h5>' . esc_html__( 'Install Your Analytic Integration', 'wpforms-lite' ) . '</h5>';
			echo '<p>' .
				sprintf(
					wp_kses(
						/* translators: %s - plugin admin area Addons page. */
						__( 'It seems you do not have any analytics plugins or addons activated. We recommend <a href="%s">MonsterInsights</a>.', 'wpforms-lite' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					'https://www.monsterinsights.com/'
				) .
				'</p>';
			echo '</div>';
		} else {

			// Everything is good - display default instructions.
			echo '<div class="wpforms-panel-content-section wpforms-panel-content-section-default">';
			echo '<h5>' . esc_html__( 'Select Your Analytics Integration', 'wpforms-lite' ) . '</h5>';
			echo '<p>' . esc_html__( 'Select your analytics plugin or service from the options on the left.', 'wpforms-lite' ) . '</p>';
			echo '</div>';
		}

		do_action( 'wpforms_analytics_panel_content', $this->form );
	}
}

new WPForms_Builder_Panel_Analytics();
