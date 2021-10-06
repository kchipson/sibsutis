<?php

/**
 * Suggestion form template.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.1.3.2
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */
class WPForms_Template_Suggestion extends WPForms_Template {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		$this->name        = esc_html__( 'Suggestion Form', 'wpforms-lite' );
		$this->slug        = 'suggestion';
		$this->description = esc_html__( 'Ask your users for suggestions with this simple form template. You can add and remove fields as needed.', 'wpforms-lite' );
		$this->includes    = '';
		$this->icon        = '';
		$this->modal       = '';
		$this->core        = true;
		$this->data        = array(
			'field_id' => '5',
			'fields'   => array(
				'0' => array(
					'id'       => '0',
					'type'     => 'name',
					'label'    => esc_html__( 'Name', 'wpforms-lite' ),
					'required' => '1',
					'size'     => 'medium',
				),
				'1' => array(
					'id'          => '1',
					'type'        => 'email',
					'label'       => esc_html__( 'Email', 'wpforms-lite' ),
					'description' => esc_html__( 'Please enter your email, so we can follow up with you.', 'wpforms-lite' ),
					'required'    => '1',
					'size'        => 'medium',
				),
				'2' => array(
					'id'       => '2',
					'type'     => 'radio',
					'label'    => esc_html__( 'Which department do you have a suggestion for?', 'wpforms-lite' ),
					'choices'  => array(
						'1' => array(
							'label' => esc_html__( 'Sales', 'wpforms-lite' ),
						),
						'2' => array(
							'label' => esc_html__( 'Customer Support', 'wpforms-lite' ),
						),
						'3' => array(
							'label' => esc_html__( 'Product Development', 'wpforms-lite' ),
						),
						'4' => array(
							'label' => esc_html__( 'Other', 'wpforms-lite' ),
						),
					),
					'required' => '1',
				),
				'3' => array(
					'id'       => '3',
					'type'     => 'text',
					'label'    => esc_html__( 'Subject', 'wpforms-lite' ),
					'required' => '1',
					'size'     => 'medium',
				),
				'4' => array(
					'id'       => '4',
					'type'     => 'textarea',
					'label'    => esc_html__( 'Message', 'wpforms-lite' ),
					'required' => '1',
					'size'     => 'medium',
				),
			),
			'settings' => array(
				'notifications'               => array(
					'1' => array(
						'replyto'        => '{field_id="1"}',
						'sender_name'    => '{field_id="0"}',
						'sender_address' => '{admin_email}',
					),
				),
				'honeypot'                    => '1',
				'confirmation_message_scroll' => '1',
				'submit_text_processing'      => esc_html__( 'Sending...', 'wpforms-lite' ),
			),
			'meta'     => array(
				'template' => $this->slug,
			),
		);
	}
}

new WPForms_Template_Suggestion;
