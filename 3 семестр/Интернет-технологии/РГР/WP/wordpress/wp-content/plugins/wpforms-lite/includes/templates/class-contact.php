<?php

/**
 * Contact form template.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */
class WPForms_Template_Contact extends WPForms_Template {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		$this->name        = esc_html__( 'Simple Contact Form', 'wpforms-lite' );
		$this->slug        = 'contact';
		$this->description = esc_html__( 'Allow your users to contact you with this simple contact form. You can add and remove fields as needed.', 'wpforms-lite' );
		$this->includes    = '';
		$this->icon        = '';
		$this->modal       = '';
		$this->core        = true;
		$this->data        = array(
			'field_id' => '3',
			'fields'   => array(
				'0' => array(
					'id'       => '0',
					'type'     => 'name',
					'format'   => 'first-last',
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
				'2' => array(
					'id'          => '2',
					'type'        => 'textarea',
					'label'       => esc_html__( 'Comment or Message', 'wpforms-lite' ),
					'description' => '',
					'required'    => '1',
					'size'        => 'medium',
					'placeholder' => '',
					'css'         => '',
				),
			),
			'settings' => array(
				'notification_enable'    => '1',
				'notifications'          => array(
					'1' => array(
						'email'          => '{admin_email}',
						'sender_address' => '{admin_email}',
						'replyto'        => '{field_id="1"}',
						'message'        => '{all_fields}',
					),
				),
				'confirmations'          => array(
					'1' => array(
						'type'           => 'message',
						'message'        => esc_html__( 'Thanks for contacting us! We will be in touch with you shortly.', 'wpforms-lite' ),
						'message_scroll' => '1',
					),
				),
				'honeypot'               => '1',
				'submit_text'            => esc_html__( 'Submit', 'wpforms-lite' ),
				'submit_text_processing' => esc_html__( 'Sending...', 'wpforms-lite' ),
			),
			'meta'     => array(
				'template' => $this->slug,
			),
		);
	}
}

new WPForms_Template_Contact;
