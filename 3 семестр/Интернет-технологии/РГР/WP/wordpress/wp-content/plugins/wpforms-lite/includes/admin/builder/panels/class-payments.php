<?php

/**
 * Payments panel.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */
class WPForms_Builder_Panel_Payments extends WPForms_Builder_Panel {

	/**
	 * All systems go.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		// Define panel information.
		$this->name    = esc_html__( 'Payments', 'wpforms-lite' );
		$this->slug    = 'payments';
		$this->icon    = 'fa-usd';
		$this->order   = 10;
		$this->sidebar = true;
	}

	/**
	 * Outputs the Payments panel sidebar.
	 *
	 * @since 1.0.0
	 */
	public function panel_sidebar() {

		// Sidebar contents are not valid unless we have a form.
		if ( ! $this->form ) {
			return;
		}

		$this->panel_sidebar_section( esc_html__( 'Default', 'wpforms-lite' ), 'default' );

		do_action( 'wpforms_payments_panel_sidebar', $this->form );
	}

	/**
	 * Outputs the Payments panel primary content.
	 *
	 * @since 1.0.0
	 */
	public function panel_content() {

		// An array of all the active provider addons.
		$payments_active = apply_filters( 'wpforms_payments_available', array() );

		if ( ! $this->form ) {

			// Check if there is a form created. When no form has been created
			// yet let the user know we need a form to setup a payment.
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

		if ( ! wpforms()->pro ) {

			// WPForms Lite users.
			echo '<div class="wpforms-panel-content-section wpforms-panel-content-section-info">';
			echo '<p>Payment integrations are not available on your plan.</p>';
			echo '<p>Please upgrade to PRO to unlock all the payment integrations and more awesome features.</p>';
			echo '<a href="' . esc_url( wpforms_admin_upgrade_link( 'builder-payments' ) ) . '" class="wpforms-btn wpforms-btn-orange wpforms-btn-lg" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Upgrade to PRO', 'wpforms-lite' ) . '</a>';
			echo '</div>';

		} elseif ( empty( $payments_active ) ) {

			// Check for active payment addons. When no payment addons are
			// activated let the user know they need to install/activate an
			// addon to setup a payment.
			echo '<div class="wpforms-panel-content-section wpforms-panel-content-section-info">';
			echo '<h5>' . esc_html__( 'Install Your Payment Integration', 'wpforms-lite' ) . '</h5>';
			echo
				'<p>' .
				sprintf(
					wp_kses(
						/* translators: %s - Addons page URL. */
						__( 'It seems you do not have any payment addons activated. You can head over to the <a href="%s">Addons page</a> to install and activate the addon for your payment service.', 'wpforms-lite' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'admin.php?page=wpforms-addons' ) )
				) .
				'</p>';
			echo '</div>';
		} else {

			// Everything is good - display default instructions.
			echo '<div class="wpforms-panel-content-section wpforms-panel-content-section-default">';
			echo '<h5>' . esc_html__( 'Select Your Payment Integration', 'wpforms-lite' ) . '</h5>';
			echo '<p>' . esc_html__( 'Select your payment provider from the options on the left. If you don\'t see your payment service listed, then let us know and we\'ll do our best to get it added as fast as possible.', 'wpforms-lite' ) . '</p>';
			echo '</div>';
		}

		do_action( 'wpforms_payments_panel_content', $this->form );
	}
}
new WPForms_Builder_Panel_Payments();
