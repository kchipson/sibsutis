<?php

/**
 * Scribe to Email list form template.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */
class WPForms_Template_Subscribe extends WPForms_Template {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		$this->name        = esc_html__( 'Newsletter Signup Form', 'wpforms-lite' );
		$this->slug        = 'subscribe';
		$this->description = esc_html__( 'Add subscribers and grow your email list with this newsletter signup form. You can add and remove fields as needed.', 'wpforms-lite' );
		$this->includes    = '';
		$this->icon        = '';
		$this->core        = true;
		$this->modal       = array(
			'title'   => esc_html__( 'Don&#39;t Forget', 'wpforms-lite' ),
			'message' => esc_html__( 'Click the marketing tab to configure your newsletter service provider', 'wpforms-lite' ),
		);
		$this->data        = array(
			'field_id' => '2',
			'fields'   => array(
				'0' => array(
					'id'       => '0',
					'type'     => 'name',
					'label'    => esc_html__( 'Name', 'wpforms-lite' ),
					'required' => '1',
					'size'     => 'medium',
				),
				'1' => array(
					'id'       => '1',
					'type'     => 'email',
					'label'    => esc_html__( 'Email', 'wpforms-lite' ),
					'required' => '1',
					'size'     => 'medium',
				),
			),
			'settings' => array(
				'honeypot'                    => '1',
				'confirmation_message_scroll' => '1',
				'submit_text_processing'      => esc_html__( 'Sending...', 'wpforms-lite' ),
			),
			'meta'     => array(
				'template' => $this->slug,
			),
		);
	}

	/**
	 * Conditional to determine if the template informational modal screens
	 * should display.
	 *
	 * @since 1.0.0
	 *
	 * @param array $form_data Form data and settings.
	 *
	 * @return boolean
	 */
	public function template_modal_conditional( $form_data ) {

		// If we do not have provider data, then we can assume a provider
		// method has not yet been configured, so we display the modal to
		// remind the user they need to set it up for the form to work
		// correctly.
		if ( empty( $form_data['providers'] ) ) {
			return true;
		}

		return false;
	}
}

new WPForms_Template_Subscribe();
