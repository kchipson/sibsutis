<?php
/**
 * Ninja Forms Importer class.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.4.2
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2017, WPForms LLC
 */
class WPForms_Ninja_Forms extends WPForms_Importer {

	/**
	 * @inheritdoc
	 */
	public function init() {

		$this->name = 'Ninja Forms';
		$this->slug = 'ninja-forms';
		$this->path = 'ninja-forms/ninja-forms.php';
	}

	/**
	 * Get ALL THE FORMS.
	 *
	 * @since 1.4.2
	 *
	 * @return NF_Database_Models_Form[]
	 */
	public function get_forms() {

		$forms_final = array();

		if ( ! $this->is_active() ) {
			return $forms_final;
		}

		$forms = Ninja_Forms()->form()->get_forms();

		if ( ! empty( $forms ) ) {
			foreach ( $forms as $form ) {

				if ( ! $form instanceof NF_Database_Models_Form ) {
					continue;
				}

				$forms_final[ $form->get_id() ] = $form->get_setting( 'title' );
			}
		}

		return $forms_final;
	}

	/**
	 * @inheritdoc
	 */
	public function get_form( $id ) {

		$form             = array();
		$form['settings'] = Ninja_Forms()->form( $id )->get()->get_settings();
		$fields           = Ninja_Forms()->form( $id )->get_fields();
		$actions          = Ninja_Forms()->form( $id )->get_actions();

		foreach ( $fields as $field ) {

			if ( ! $field instanceof NF_Database_Models_Field ) {
				continue;
			}

			$form['fields'][] = array_merge(
				array(
					'id' => $field->get_id(),
				),
				$field->get_settings()
			);
		}

		foreach ( $actions as $action ) {

			if ( ! $action instanceof NF_Database_Models_Action ) {
				continue;
			}

			$form['actions'][] = $action->get_settings();
		}

		return $form;
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
		$analyze            = isset( $_POST['analyze'] );
		$nf_id              = ! empty( $_POST['form_id'] ) ? (int) $_POST['form_id'] : 0;
		$nf_form            = $this->get_form( $nf_id );
		$nf_form_name       = $nf_form['settings']['title'];
		$nf_recaptcha       = false;
		$nf_recaptcha_type  = 'v2';
		$fields_pro_plain   = array( 'phone', 'date' );
		$fields_pro_omit    = array( 'html', 'divider' );
		$fields_unsupported = array( 'spam', 'starrating', 'listmultiselect', 'hidden', 'total', 'shipping', 'quantity', 'product' );
		$upgrade_plain      = array();
		$upgrade_omit       = array();
		$unsupported        = array();
		$form               = array(
			'id'       => '',
			'field_id' => '',
			'fields'   => array(),
			'settings' => array(
				'form_title'             => $nf_form_name,
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
						'subject'           => sprintf( esc_html__( 'New Entry: %s', 'wpforms-lite' ), $nf_form_name ),
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
				'import_form_id'         => $nf_id,
			),
		);

		// If form does not contain fields, bail.
		if ( empty( $nf_form['fields'] ) ) {
			wp_send_json_success( array(
				'error' => true,
				'name'  => sanitize_text_field( $nf_form_name ),
				'msg'   => esc_html__( 'No form fields found.', 'wpforms-lite' ),
			) );
		}

		// Convert fields.
		foreach ( $nf_form['fields'] as $nf_field ) {

			// Try to determine field label to use.
			$label = $this->get_field_label( $nf_field );

			// Next, check if field is unsupported. If unsupported make note and
			// then continue to the next field.
			if ( in_array( $nf_field['type'], $fields_unsupported, true ) ) {
				$unsupported[] = $label;
				continue;
			}

			// Now check if this install is Lite. If it is Lite and it's a
			// field type not included, make a note then continue to the next
			// field.
			if ( ! wpforms()->pro && in_array( $nf_field['type'], $fields_pro_plain, true ) ) {
				$upgrade_plain[] = $label;
			}
			if ( ! wpforms()->pro && in_array( $nf_field['type'], $fields_pro_omit, true ) ) {
				$upgrade_omit[] = $label;
				continue;
			}

			// Determine next field ID to assign.
			if ( empty( $form['fields'] ) ) {
				$field_id = 1;
			} else {
				$field_id = (int) max( array_keys( $form['fields'] ) ) + 1;
			}

			switch ( $nf_field['type'] ) {

				// Single line text, address, city, first name, last name,
				// zipcode, email, number, textarea fields.
				case 'textbox':
				case 'address':
				case 'city':
				case 'firstname':
				case 'lastname':
				case 'zip':
				case 'email':
				case 'number':
				case 'textarea':
					$type = 'text';

					if ( 'email' === $nf_field['type'] ) {
						$type = 'email';
					} elseif ( 'number' === $nf_field['type'] ) {
						$type = 'number';
					} elseif ( 'textarea' === $nf_field['type'] ) {
						$type = 'textarea';
					}

					$form['fields'][ $field_id ] = array(
						'id'            => $field_id,
						'type'          => $type,
						'label'         => $label,
						'description'   => ! empty( $nf_field['desc_text'] ) ? $nf_field['desc_text'] : '',
						'size'          => 'medium',
						'required'      => ! empty( $nf_field['required'] ) ? '1' : '',
						'placeholder'   => ! empty( $nf_field['placeholder'] ) ? $nf_field['placeholder'] : '',
						'default_value' => ! empty( $nf_field['default'] ) ? $nf_field['default'] : '',
						'nf_key'        => $nf_field['key'],
					);
					break;

				// Single checkbox field.
				case 'checkbox':
					$form['fields'][ $field_id ] = array(
						'id'          => $field_id,
						'type'        => 'checkbox',
						'label'       => esc_html__( 'Single Checkbox Field', 'wpforms-lite' ),
						'choices'     => array(
							1 => array(
								'label' => $label,
								'value' => '',
							),
						),
						'description' => ! empty( $nf_field['desc_text'] ) ? $nf_field['desc_text'] : '',
						'size'        => 'medium',
						'required'    => ! empty( $nf_field['required'] ) ? '1' : '',
						'label_hide'  => '1',
						'nf_key'      => $nf_field['key'],
					);
					break;

				// Multi-check field, radio, select, state, and country fields.
				case 'listcheckbox':
				case 'listradio':
				case 'listselect':
				case 'liststate':
				case 'listcountry':
					$type = 'select';
					if ( 'listcheckbox' === $nf_field['type'] ) {
						$type = 'checkbox';
					} elseif ( 'listradio' === $nf_field['type'] ) {
						$type = 'radio';
					}

					$choices = array();
					if ( 'listcountry' === $nf_field['type'] ) {
						$countries = wpforms_countries();
						foreach ( $countries as $key => $country ) {
							$choices[] = array(
								'label'   => $country,
								'value'   => $key,
								'default' => isset( $nf_field['default'] ) && $nf_field['default'] === $key ? '1' : '',
							);
						}
					} else {
						foreach ( $nf_field['options'] as $option ) {
							$choices[] = array(
								'label' => $option['label'],
								'value' => $option['value'],
							);
						}
					}

					$form['fields'][ $field_id ] = array(
						'id'          => $field_id,
						'type'        => $type,
						'label'       => $label,
						'choices'     => $choices,
						'description' => ! empty( $nf_field['desc_text'] ) ? $nf_field['desc_text'] : '',
						'size'        => 'medium',
						'required'    => ! empty( $nf_field['required'] ) ? '1' : '',
						'nf_key'      => $nf_field['key'],
					);
					break;

				// HTML field.
				case 'html':
					$form['fields'][ $field_id ] = array(
						'id'            => $field_id,
						'type'          => 'html',
						'code'          => ! empty( $nf_field['default'] ) ? $nf_field['default'] : '',
						'label_disable' => '1',
						'nf_key'        => $nf_field['key'],
					);
					break;

				// Divider field.
				case 'hr':
					$form['fields'][ $field_id ] = array(
						'id'            => $field_id,
						'type'          => 'divider',
						'label'         => '',
						'description'   => '',
						'label_disable' => '1',
						'nf_key'        => $nf_field['key'],
					);
					break;

				// Phone number field.
				case 'phone':
					$type = wpforms()->pro ? 'phone' : 'text';

					$form['fields'][ $field_id ] = array(
						'id'            => $field_id,
						'type'          => $type,
						'label'         => $label,
						'format'        => ! empty( $nf_field['mask'] ) && '(999) 999-9999' === $nf_field['mask'] ? 'us' : 'international',
						'description'   => ! empty( $nf_field['desc_text'] ) ? $nf_field['desc_text'] : '',
						'size'          => 'medium',
						'required'      => ! empty( $nf_field['required'] ) ? '1' : '',
						'placeholder'   => ! empty( $nf_field['placeholder'] ) ? $nf_field['placeholder'] : '',
						'default_value' => ! empty( $nf_field['default'] ) ? $nf_field['default'] : '',
						'nf_key'        => $nf_field['key'],
					);
					break;

				// Date field.
				case 'date':
					$type = wpforms()->pro ? 'date-time' : 'text';

					$form['fields'][ $field_id ] = array(
						'id'               => $field_id,
						'type'             => $type,
						'label'            => $label,
						'description'      => ! empty( $nf_field['desc_text'] ) ? $nf_field['desc_text'] : '',
						'format'           => 'date',
						'size'             => 'medium',
						'required'         => ! empty( $nf_field['required'] ) ? '1' : '',
						'date_placeholder' => '',
						'date_format'      => 'm/d/Y',
						'date_type'        => 'datepicker',
						'time_format'      => 'g:i A',
						'time_interval'    => 30,
						'nf_key'           => $nf_field['key'],
					);
					break;

				// ReCAPTCHA field.
				case 'recaptcha':
					$nf_recaptcha = true;
					if ( 'invisible' === $nf_field['size'] ) {
						$nf_recaptcha_type = 'invisible';
					}
			}
		}

		// If we are only analyzing the form, we can stop here and return the
		// details about this form.
		if ( $analyze ) {
			wp_send_json_success( array(
				'name'          => $nf_form_name,
				'upgrade_plain' => $upgrade_plain,
				'upgrade_omit'  => $upgrade_omit,
			) );
		}

		// Settings.
		// Confirmation message.
		foreach ( $nf_form['actions'] as $action ) {
			if ( 'successmessage' === $action['type'] ) {
				$form['settings']['confirmations'][1]['message'] = $this->get_smarttags( $action['message'], $form['fields'] );
			}
		}

		// ReCAPTCHA.
		if ( $nf_recaptcha ) {
			// If the user has already defined v2 reCAPTCHA keys in the WPForms
			// settings, use those.
			$site_key   = wpforms_setting( 'recaptcha-site-key', '' );
			$secret_key = wpforms_setting( 'recaptcha-secret-key', '' );

			// Try to abstract keys from NF.
			if ( empty( $site_key ) || empty( $secret_key ) ) {
				$nf_settings = get_option( 'ninja_forms_settings' );
				if ( ! empty( $nf_settings['recaptcha_site_key'] ) && ! empty( $nf_settings['recaptcha_secret_key'] ) ) {
					$wpforms_settings                         = get_option( 'wpforms_settings', array() );
					$wpforms_settings['recaptcha-site-key']   = $nf_settings['recaptcha_site_key'];
					$wpforms_settings['recaptcha-secret-key'] = $nf_settings['recaptcha_secret_key'];
					$wpforms_settings['recaptcha-type']       = $nf_recaptcha_type;
					update_option( 'wpforms_settings', $wpforms_settings );
				}
			}

			if ( ! empty( $site_key ) && ! empty( $secret_key ) ) {
				$form['settings']['recaptcha'] = '1';
			}
		}

		// Setup email notifications.
		$action_count    = 1;
		$action_defaults = array(
			'notification_name' => esc_html__( 'Notification', 'wpforms-lite' ) . " $action_count",
			'email'             => '{admin_email}',
			/* translators: %s - form name. */
			'subject'           => sprintf( esc_html__( 'New Entry: %s', 'wpforms-lite' ), $nf_form_name ),
			'sender_name'       => get_bloginfo( 'name' ),
			'sender_address'    => '{admin_email}',
			'replyto'           => '',
			'message'           => '{all_fields}',
		);

		foreach ( $nf_form['actions'] as $action ) {

			if ( 'email' !== $action['type'] ) {
				continue;
			}

			$action_defaults['notification_name'] = esc_html__( 'Notification', 'wpforms-lite' ) . " $action_count";

			$form['settings']['notifications'][ $action_count ] = $action_defaults;

			if ( ! empty( $action['label'] ) ) {
				$form['settings']['notifications'][ $action_count ]['notification_name'] = $action['label'];
			}

			if ( ! empty( $action['to'] ) ) {
				$form['settings']['notifications'][ $action_count ]['email'] = $this->get_smarttags( $action['to'], $form['fields'] );
			}

			if ( ! empty( $action['reply_to'] ) ) {
				$form['settings']['notifications'][ $action_count ]['replyto'] = $this->get_smarttags( $action['reply_to'], $form['fields'] );
			}

			if ( ! empty( $action['email_subject'] ) ) {
				$form['settings']['notifications'][ $action_count ]['subject'] = $this->get_smarttags( $action['email_subject'], $form['fields'] );
			}

			if ( ! empty( $action['email_message'] ) ) {
				$form['settings']['notifications'][ $action_count ]['message'] = $this->get_smarttags( $action['email_message'], $form['fields'] );
			}

			if ( ! empty( $action['from_name'] ) ) {
				$form['settings']['notifications'][ $action_count ]['sender_name'] = $this->get_smarttags( $action['from_name'], $form['fields'] );
			}

			if ( ! empty( $action['from_address'] ) ) {
				$form['settings']['notifications'][ $action_count ]['sender_address'] = $this->get_smarttags( $action['from_address'], $form['fields'] );
			}

			$action_count ++;
		}

		$this->add_form( $form, $unsupported, $upgrade_plain, $upgrade_omit );
	}

	/**
	 * Get the field label.
	 *
	 * @since 1.4.2
	 *
	 * @param array $field
	 *
	 * @return string
	 */
	public function get_field_label( $field ) {

		if ( ! empty( $field['label'] ) ) {
			$label = sanitize_text_field( $field['label'] );
		} else {
			$label = sprintf(
				/* translators: %1$s - field type; %2$s - field name if available. */
				esc_html__( '%1$s Field', 'wpforms-lite' ),
				ucfirst( $field['type'] )
			);
		}

		return trim( $label );
	}

	/**
	 * @inheritdoc
	 */
	public function get_smarttags( $string, $fields ) {

		preg_match_all( '/\{(.+?)\}/', $string, $tags );

		if ( empty( $tags[1] ) ) {
			return $string;
		}

		foreach ( $tags[1] as $tag ) {

			$tag_formatted = str_replace( 'field:', '', $tag );

			foreach ( $fields as $field ) {
				if ( ! empty( $field['nf_key'] ) && $field['nf_key'] === $tag_formatted ) {
					$string = str_replace( '{' . $tag . '}', '{field_id="' . $field['id'] . '"}', $string );
				}
			}

			if ( 'wp:admin_email' === $tag ) {
				$string = str_replace( '{wp:admin_email}', '{admin_email}', $string );
			}

			if ( 'all_fields_table' === $tag || 'fields_table' === $tag ) {
				$string = str_replace( '{' . $tag . '}', '{all_fields}', $string );
			}
		}

		return $string;
	}
}

new WPForms_Ninja_Forms();
