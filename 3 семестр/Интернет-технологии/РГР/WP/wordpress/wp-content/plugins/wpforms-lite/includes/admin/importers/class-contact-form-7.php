<?php
/**
 * Contact Form 7 Importer class.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.4.2
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2017, WPForms LLC
 */
class WPForms_Contact_Form_7 extends WPForms_Importer {

	/**
	 * @inheritdoc
	 */
	public function init() {

		$this->name = 'Contact Form 7';
		$this->slug = 'contact-form-7';
		$this->path = 'contact-form-7/wp-contact-form-7.php';
	}

	/**
	 * @inheritdoc
	 */
	public function get_forms() {

		$forms_final = array();

		if ( ! $this->is_active() ) {
			return $forms_final;
		}

		$forms = WPCF7_ContactForm::find( array(
			'posts_per_page' => - 1,
		) );

		if ( ! empty( $forms ) ) {
			foreach ( $forms as $form ) {
				if ( ! empty( $form ) && ( $form instanceof WPCF7_ContactForm ) ) {
					$forms_final[ $form->id() ] = $form->title();
				}
			}
		}

		return $forms_final;
	}

	/**
	 * Get a single form.
	 *
	 * @since 1.4.2
	 *
	 * @param int $id Form ID.
	 *
	 * @return WPCF7_ContactForm|bool
	 */
	public function get_form( $id ) {

		$form = WPCF7_ContactForm::find( array(
			'posts_per_page' => 1,
			'p'              => $id,
		) );

		if ( ! empty( $form[0] ) && ( $form[0] instanceof WPCF7_ContactForm ) ) {
			return $form[0];
		}

		return false;
	}

	/**
	 * @inheritdoc
	 */
	public function import_form() {

		// Run a security check.
		check_ajax_referer( 'wpforms-admin', 'nonce' );

		// Check for permissions.
		if ( ! wpforms_current_user_can() ) {
			wp_send_json_error();
		}

		// Define some basic information.
		$analyze  = isset( $_POST['analyze'] );
		$cf7_id   = ! empty( $_POST['form_id'] ) ? (int) $_POST['form_id'] : 0;
		$cf7_form = $this->get_form( $cf7_id );

		if ( ! $cf7_form ) {
			wp_send_json_error( array(
				'error' => true,
				'name'  => esc_html__( 'Unknown Form', 'wpforms-lite' ),
				'msg'   => esc_html__( 'The form you are trying to import does not exist.', 'wpforms-lite' ),
			) );
		}

		$cf7_form_name      = $cf7_form->title();
		$cf7_fields         = $cf7_form->scan_form_tags();
		$cf7_properties     = $cf7_form->get_properties();
		$cf7_recaptcha      = false;
		$fields_pro_plain   = array( 'url', 'tel', 'date' );
		$fields_pro_omit    = array( 'file' );
		$fields_unsupported = array( 'quiz', 'hidden' );
		$upgrade_plain      = array();
		$upgrade_omit       = array();
		$unsupported        = array();
		$form               = array(
			'id'       => '',
			'field_id' => '',
			'fields'   => array(),
			'settings' => array(
				'form_title'             => $cf7_form_name,
				'form_desc'              => '',
				'submit_text'            => esc_html__( 'Submit', 'wpforms-lite' ),
				'submit_text_processing' => esc_html__( 'Sending', 'wpforms-lite' ),
				'honeypot'               => '1',
				'notification_enable'    => '1',
				'notifications'          => array(
					1 => array(
						'notification_name' => esc_html__( 'Notification 1', 'wpforms-lite' ),
						'email'             => '{admin_email}',
						/* translators: %s - form name. */
						'subject'           => sprintf( esc_html__( 'New Entry: %s', 'wpforms-lite' ), $cf7_form_name ),
						'sender_name'       => get_bloginfo( 'name' ),
						'sender_address'    => '{admin_email}',
						'replyto'           => '',
						'message'           => '{all_fields}',
					),
				),
				'confirmations'          => array(
					1 => array(
						'type'           => 'message',
						'message'        => esc_html__( 'Thanks for contacting us! We will be in touch with you shortly.', 'wpforms-lite' ),
						'message_scroll' => '1',
					),
				),
				'import_form_id'         => $cf7_id,
			),
		);

		// If form does not contain fields, bail.
		if ( empty( $cf7_fields ) ) {
			wp_send_json_success( array(
				'error' => true,
				'name'  => sanitize_text_field( $cf7_form_name ),
				'msg'   => esc_html__( 'No form fields found.', 'wpforms-lite' ),
			) );
		}

		// Convert fields.
		foreach ( $cf7_fields as $cf7_field ) {

			if ( ! $cf7_field instanceof WPCF7_FormTag ) {
				continue;
			}

			// Try to determine field label to use.
			$label = $this->get_field_label( $cf7_properties['form'], $cf7_field->type, $cf7_field->name );

			// Next, check if field is unsupported. If supported make note and
			// then continue to the next field.
			if ( in_array( $cf7_field->basetype, $fields_unsupported, true ) ) {
				$unsupported[] = $label;
				continue;
			}

			// Now check if this install is Lite. If it is Lite and it's a
			// field type not included, make a note then continue to the next
			// field.
			if ( ! wpforms()->pro && in_array( $cf7_field->basetype, $fields_pro_plain, true ) ) {
				$upgrade_plain[] = $label;
			}
			if ( ! wpforms()->pro && in_array( $cf7_field->basetype, $fields_pro_omit, true ) ) {
				$upgrade_omit[] = $label;
				continue;
			}

			// Determine next field ID to assign.
			if ( empty( $form['fields'] ) ) {
				$field_id = 1;
			} else {
				$field_id = (int) max( array_keys( $form['fields'] ) ) + 1;
			}

			switch ( $cf7_field->basetype ) {

				// Plain text, email, URL, number, and textarea fields.
				case 'text':
				case 'email':
				case 'url':
				case 'number':
				case 'textarea':
					$type = $cf7_field->basetype;
					if ( 'url' === $type && ! wpforms()->pro ) {
						$type = 'text';
					}
					$form['fields'][ $field_id ] = array(
						'id'            => $field_id,
						'type'          => $type,
						'label'         => $label,
						'size'          => 'medium',
						'required'      => $cf7_field->is_required() ? '1' : '',
						'placeholder'   => $this->get_field_placeholder_default( $cf7_field ),
						'default_value' => $this->get_field_placeholder_default( $cf7_field, 'default' ),
						'cf7_name'      => $cf7_field->name,
					);
					break;

				// Phone number field.
				case 'tel':
					$form['fields'][ $field_id ] = array(
						'id'            => $field_id,
						'type'          => 'phone',
						'label'         => $label,
						'format'        => 'international',
						'size'          => 'medium',
						'required'      => $cf7_field->is_required() ? '1' : '',
						'placeholder'   => $this->get_field_placeholder_default( $cf7_field ),
						'default_value' => $this->get_field_placeholder_default( $cf7_field, 'default' ),
						'cf7_name'      => $cf7_field->name,
					);
					break;

				// Date field.
				case 'date':
					$type = wpforms()->pro ? 'date-time' : 'text';

					$form['fields'][ $field_id ] = array(
						'id'               => $field_id,
						'type'             => $type,
						'label'            => $label,
						'format'           => 'date',
						'size'             => 'medium',
						'required'         => $cf7_field->is_required() ? '1' : '',
						'date_placeholder' => '',
						'date_format'      => 'm/d/Y',
						'date_type'        => 'datepicker',
						'time_format'      => 'g:i A',
						'time_interval'    => 30,
						'cf7_name'         => $cf7_field->name,
					);
					break;

				// Select, radio, and checkbox fields.
				case 'select':
				case 'radio':
				case 'checkbox':
					$choices = array();
					$options = (array) $cf7_field->labels;

					foreach ( $options as $option ) {
						$choices[] = array(
							'label' => $option,
							'value' => '',
						);
					}

					$form['fields'][ $field_id ] = array(
						'id'       => $field_id,
						'type'     => $cf7_field->basetype,
						'label'    => $label,
						'choices'  => $choices,
						'size'     => 'medium',
						'required' => $cf7_field->is_required() ? '1' : '',
						'cf7_name' => $cf7_field->name,
					);

					if ( 'select' === $cf7_field->basetype && $cf7_field->has_option( 'include_blank' ) ) {
						$form['fields'][ $field_id ]['placeholder'] = '---';
					}
					break;

				// File upload field.
				case 'file':
					$extensions = '';
					$max_size   = '';
					$file_types = $cf7_field->get_option( 'filetypes' );
					$limit      = $cf7_field->get_option( 'limit' );

					if ( ! empty( $file_types[0] ) ) {
						$extensions = implode( ',', explode( '|', strtolower( preg_replace( '/[^A-Za-z0-9|]/', '', strtolower( $file_types[0] ) ) ) ) );
					}

					if ( ! empty( $limit[0] ) ) {
						$limit = $limit[0];
						$mb    = ( strpos( $limit, 'm' ) !== false );
						$kb    = ( strpos( $limit, 'kb' ) !== false );
						$limit = (int) preg_replace( '/[^0-9]/', '', $limit );
						if ( $mb ) {
							$max_size = $limit;
						} elseif ( $kb ) {
							$max_size = round( $limit / 1024, 1 );
						} else {
							$max_size = round( $limit / 1048576, 1 );
						}
					}

					$form['fields'][ $field_id ] = array(
						'id'         => $field_id,
						'type'       => 'file-upload',
						'label'      => $label,
						'size'       => 'medium',
						'extensions' => $extensions,
						'max_size'   => $max_size,
						'required'   => $cf7_field->is_required() ? '1' : '',
						'cf7_name'   => $cf7_field->name,
					);
					break;

				// Acceptance field.
				case 'acceptance':
					$form['fields'][ $field_id ] = array(
						'id'         => $field_id,
						'type'       => 'checkbox',
						'label'      => esc_html__( 'Acceptance Field', 'wpforms-lite' ),
						'choices'    => array(
							1 => array(
								'label' => $label,
								'value' => '',
							),
						),
						'size'       => 'medium',
						'required'   => '1',
						'label_hide' => '1',
						'cf7_name'   => $cf7_field->name,
					);
					break;

				// ReCAPTCHA field.
				case 'recaptcha':
					$cf7_recaptcha = true;
			}
		}

		// If we are only analyzing the form, we can stop here and return the
		// details about this form.
		if ( $analyze ) {
			wp_send_json_success( array(
				'name'          => $cf7_form_name,
				'upgrade_plain' => $upgrade_plain,
				'upgrade_omit'  => $upgrade_omit,
			) );
		}

		// Settings.
		// Confirmation message.
		if ( ! empty( $cf7_properties['messages']['mail_sent_ok'] ) ) {
			$form['settings']['confirmation_message'] = $cf7_properties['messages']['mail_sent_ok'];
		}
		// ReCAPTCHA.
		if ( $cf7_recaptcha ) {
			// If the user has already defined v2 reCAPTCHA keys in the WPForms
			// settings, use those.
			$site_key   = wpforms_setting( 'recaptcha-site-key', '' );
			$secret_key = wpforms_setting( 'recaptcha-secret-key', '' );
			$type       = wpforms_setting( 'recaptcha-type', 'v2' );

			// Try to abstract keys from CF7.
			if ( empty( $site_key ) || empty( $secret_key ) ) {
				$cf7_settings = get_option( 'wpcf7' );
				if ( ! empty( $cf7_settings['recaptcha'] ) && is_array( $cf7_settings['recaptcha'] ) ) {
					foreach ( $cf7_settings['recaptcha'] as $key => $val ) {
						if ( ! empty( $key ) && ! empty( $val ) ) {
							$site_key   = $key;
							$secret_key = $val;
						}
					}
					$wpforms_settings                         = get_option( 'wpforms_settings', array() );
					$wpforms_settings['recaptcha-site-key']   = $site_key;
					$wpforms_settings['recaptcha-secret-key'] = $secret_key;
					update_option( 'wpforms_settings', $wpforms_settings );
				}
			}

			// Don't enable reCAPTCHA if user had configured invisible reCAPTCHA.
			if ( 'v2' === $type && ! empty( $site_key ) && ! empty( $secret_key ) ) {
				$form['settings']['recaptcha'] = '1';
			}
		}

		// Setup email notifications.
		if ( ! empty( $cf7_properties['mail']['subject'] ) ) {
			$form['settings']['notifications'][1]['subject'] = $this->get_smarttags( $cf7_properties['mail']['subject'], $form['fields'] );
		}

		if ( ! empty( $cf7_properties['mail']['recipient'] ) ) {
			$form['settings']['notifications'][1]['email'] = $this->get_smarttags( $cf7_properties['mail']['recipient'], $form['fields'] );
		}

		if ( ! empty( $cf7_properties['mail']['body'] ) ) {
			$form['settings']['notifications'][1]['message'] = $this->get_smarttags( $cf7_properties['mail']['body'], $form['fields'] );
		}

		if ( ! empty( $cf7_properties['mail']['additional_headers'] ) ) {
			$form['settings']['notifications'][1]['replyto'] = $this->get_replyto( $cf7_properties['mail']['additional_headers'], $form['fields'] );
		}

		if ( ! empty( $cf7_properties['mail']['sender'] ) ) {
			$sender = $this->get_sender_details( $cf7_properties['mail']['sender'], $form['fields'] );
			if ( $sender ) {
				$form['settings']['notifications'][1]['sender_name']    = $sender['name'];
				$form['settings']['notifications'][1]['sender_address'] = $sender['address'];
			}
		}

		if ( ! empty( $cf7_properties['mail_2'] ) && '1' == $cf7_properties['mail_2']['active'] ) {
			// Check if a secondary notification is enabled, if so set defaults
			// and set it up.
			$form['settings']['notifications'][2] = array(
				'notification_name' => esc_html__( 'Notification 2', 'wpforms-lite' ),
				'email'             => '{admin_email}',
				/* translators: %s - form name. */
				'subject'           => sprintf( esc_html__( 'New Entry: %s', 'wpforms-lite' ), $cf7_form_name ),
				'sender_name'       => get_bloginfo( 'name' ),
				'sender_address'    => '{admin_email}',
				'replyto'           => '',
				'message'           => '{all_fields}',
			);

			if ( ! empty( $cf7_properties['mail_2']['subject'] ) ) {
				$form['settings']['notifications'][2]['subject'] = $this->get_smarttags( $cf7_properties['mail_2']['subject'], $form['fields'] );
			}

			if ( ! empty( $cf7_properties['mail_2']['recipient'] ) ) {
				$form['settings']['notifications'][2]['email'] = $this->get_smarttags( $cf7_properties['mail_2']['recipient'], $form['fields'] );
			}

			if ( ! empty( $cf7_properties['mail_2']['body'] ) ) {
				$form['settings']['notifications'][2]['message'] = $this->get_smarttags( $cf7_properties['mail_2']['body'], $form['fields'] );
			}

			if ( ! empty( $cf7_properties['mail_2']['additional_headers'] ) ) {
				$form['settings']['notifications'][2]['replyto'] = $this->get_replyto( $cf7_properties['mail_2']['additional_headers'], $form['fields'] );
			}

			if ( ! empty( $cf7_properties['mail_2']['sender'] ) ) {
				$sender = $this->get_sender_details( $cf7_properties['mail_2']['sender'], $form['fields'] );
				if ( $sender ) {
					$form['settings']['notifications'][2]['sender_name']    = $sender['name'];
					$form['settings']['notifications'][2]['sender_address'] = $sender['address'];
				}
			}
		}

		$this->add_form( $form, $unsupported, $upgrade_plain, $upgrade_omit );
	}

	/**
	 * Lookup and return the placeholder or default value.
	 *
	 * @since 1.4.2
	 *
	 * @param object $field Field object.
	 * @param string $type Type of the field.
	 *
	 * @return string
	 */
	public function get_field_placeholder_default( $field, $type = 'placeholder' ) {

		$placeholder   = '';
		$default_value = (string) reset( $field->values );

		if ( $field->has_option( 'placeholder' ) || $field->has_option( 'watermark' ) ) {
			$placeholder   = $default_value;
			$default_value = '';
		}

		if ( 'placeholder' === $type ) {
			return $placeholder;
		}

		return $default_value;
	}

	/**
	 * Get the field label.
	 *
	 * @since 1.4.2
	 *
	 * @param string $form Form data and settings.
	 * @param string $type Field type.
	 * @param string $name Field name.
	 *
	 * @return string
	 */
	public function get_field_label( $form, $type, $name = '' ) {

		preg_match_all( '/<label>([ \w\S\r\n\t]+?)<\/label>/', $form, $matches );

		foreach ( $matches[1] as $match ) {

			$match = trim( str_replace( "\n", '', $match ) );

			preg_match( '/\[(?:' . preg_quote( $type ) . ') ' . $name . '(?:[ ](.*?))?(?:[\r\n\t ](\/))?\]/', $match, $input_match );

			if ( ! empty( $input_match[0] ) ) {
				return strip_shortcodes( sanitize_text_field( str_replace( $input_match[0], '', $match ) ) );
			}
		}

		$label = sprintf(
			/* translators: %1$s - field type; %2$s - field name if available. */
			esc_html__( '%1$s Field %2$s', 'wpforms-lite' ),
			ucfirst( $type ),
			! empty( $name ) ? "($name)" : ''
		);

		return trim( $label );
	}

	/**
	 * @inheritdoc
	 */
	public function get_smarttags( $string, $fields ) {

		preg_match_all( '/\[(.+?)\]/', $string, $tags );

		if ( empty( $tags[1] ) ) {
			return $string;
		}

		foreach ( $tags[1] as $tag ) {
			foreach ( $fields as $field ) {
				if ( ! empty( $field['cf7_name'] ) && $field['cf7_name'] === $tag ) {
					$string = str_replace( '[' . $tag . ']', '{field_id="' . $field['id'] . '"}', $string );
				}
			}
		}

		return $string;
	}

	/**
	 * Find Reply-To in headers if provided.
	 *
	 * @since 1.4.2
	 *
	 * @param string $headers CF7 email headers.
	 * @param array  $fields List of fields.
	 *
	 * @return string
	 */
	public function get_replyto( $headers, $fields ) {

		if ( strpos( $headers, 'Reply-To:' ) !== false ) {

			preg_match( '/Reply-To: \[(.+?)\]/', $headers, $tag );

			if ( ! empty( $tag[1] ) ) {
				foreach ( $fields as $field ) {
					if ( ! empty( $field['cf7_name'] ) && $field['cf7_name'] === $tag[1] ) {
						return '{field_id="' . $field['id'] . '"}';
					}
				}
			}
		}

		return '';
	}

	/**
	 * Sender information.
	 *
	 * @since 1.4.2
	 *
	 * @param string $sender Sender strings in "Name <email@example.com>" format.
	 * @param array  $fields List of fields.
	 *
	 * @return bool|array
	 */
	public function get_sender_details( $sender, $fields ) {

		preg_match( '/(.+?)\<(.+?)\>/', $sender, $tag );

		if ( ! empty( $tag[1] ) && ! empty( $tag[2] ) ) {
			return array(
				'name'    => $this->get_smarttags( $tag[1], $fields ),
				'address' => $this->get_smarttags( $tag[2], $fields ),
			);
		}

		return false;
	}
}

new WPForms_Contact_Form_7();
