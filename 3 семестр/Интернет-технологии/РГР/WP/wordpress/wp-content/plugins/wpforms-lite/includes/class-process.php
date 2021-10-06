<?php
/**
 * Process and validate form entries.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */
class WPForms_Process {

	/**
	 * Holds errors.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public $errors;

	/**
	 * Confirmation message.
	 *
	 * @var string
	 */
	public $confirmation_message;

	/**
	 * Holds formatted fields.
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	public $fields;

	/**
	 * Holds the ID of a successful entry.
	 *
	 * @since 1.2.3
	 *
	 * @var int
	 */
	public $entry_id = 0;

	/**
	 * Form data and settings.
	 *
	 * @since 1.4.5
	 *
	 * @var array
	 */
	public $form_data;

	/**
	 * If a valid return has was processed.
	 *
	 * @since 1.4.5
	 *
	 * @var bool
	 */
	public $valid_hash = false;

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		add_action( 'wp', array( $this, 'listen' ) );
		add_action( 'wp_ajax_wpforms_submit', array( $this, 'ajax_submit' ) );
		add_action( 'wp_ajax_nopriv_wpforms_submit', array( $this, 'ajax_submit' ) );
	}

	/**
	 * Listen to see if this is a return callback or a posted form entry.
	 *
	 * @since 1.0.0
	 */
	public function listen() {

		// Catch the post_max_size overflow.
		if ( $this->post_max_size_overflow() ) {
			return;
		}

		if ( ! empty( $_GET['wpforms_return'] ) ) { // phpcs:ignore
			$this->entry_confirmation_redirect( '', $_GET['wpforms_return'] ); // phpcs:ignore
		}

		if ( ! empty( $_POST['wpforms']['id'] ) ) { // phpcs:ignore
			$this->process( stripslashes_deep( $_POST['wpforms'] ) ); // phpcs:ignore

			$form_id = wp_unslash( $_POST['wpforms']['id'] );
			if ( wpforms_is_amp() ) {
				// Send 400 Bad Request when there are errors.
				if ( ! empty( $this->errors[ $form_id ] ) ) {
					$message = $this->errors[ $form_id ]['header'];
					if ( ! empty( $this->errors[ $form_id ]['footer'] ) ) {
						$message .= ' ' . $this->errors[ $form_id ]['footer'];
					}
					wp_send_json(
						array(
							'message' => $message,
						),
						400
					);
				} else {
					wp_send_json(
						array(
							'message' => $this->get_confirmation_message( $this->form_data, $this->fields, $this->entry_id ),
						),
						200
					);
				}
			}
		}
	}

	/**
	 * Process the form entry.
	 *
	 * @since 1.0.0
	 *
	 * @param array $entry $_POST object.
	 */
	public function process( $entry ) {

		$this->errors = array();
		$this->fields = array();
		$form_id      = absint( $entry['id'] );
		$form         = wpforms()->form->get( $form_id );
		$honeypot     = false;

		// Validate form is real and active (published).
		if ( ! $form || 'publish' !== $form->post_status ) {
			$this->errors[ $form_id ]['header'] = esc_html__( 'Invalid form.', 'wpforms-lite' );
			return;
		}

		// Formatted form data for hooks.
		$this->form_data = apply_filters( 'wpforms_process_before_form_data', wpforms_decode( $form->post_content ), $entry );

		// Pre-process/validate hooks and filter.
		// Data is not validated or cleaned yet so use with caution.
		$entry = apply_filters( 'wpforms_process_before_filter', $entry, $this->form_data );

		do_action( 'wpforms_process_before', $entry, $this->form_data );
		do_action( "wpforms_process_before_{$form_id}", $entry, $this->form_data );

		// Validate fields.
		foreach ( $this->form_data['fields'] as $field_properties ) {

			$field_id     = $field_properties['id'];
			$field_type   = $field_properties['type'];
			$field_submit = isset( $entry['fields'][ $field_id ] ) ? $entry['fields'][ $field_id ] : '';

			do_action( "wpforms_process_validate_{$field_type}", $field_id, $field_submit, $this->form_data );
		}

		// reCAPTCHA check.
		$site_key   = wpforms_setting( 'recaptcha-site-key', '' );
		$secret_key = wpforms_setting( 'recaptcha-secret-key', '' );
		$type       = wpforms_setting( 'recaptcha-type', 'v2' );
		if (
			! empty( $site_key ) &&
			! empty( $secret_key ) &&
			isset( $this->form_data['settings']['recaptcha'] ) &&
			'1' == $this->form_data['settings']['recaptcha'] &&
			! isset( $_POST['__amp_form_verify'] ) // phpcs:ignore WordPress.Security.NonceVerification.Missing -- No need to check reCAPTCHA until form is submitted.
			&&
			( 'v3' === $type || ! wpforms_is_amp() ) // AMP requires v3.
		) {
			$error = wpforms_setting( 'recaptcha-fail-msg', esc_html__( 'Google reCAPTCHA verification failed, please try again later.', 'wpforms-lite' ) );
			$token = ! empty( $_POST['g-recaptcha-response'] ) ? $_POST['g-recaptcha-response'] : false;

			if ( 'v3' === $type ) {
				$token = ! empty( $_POST['wpforms']['recaptcha'] ) ? $_POST['wpforms']['recaptcha'] : false;
			}

			$response = json_decode( wp_remote_retrieve_body( wp_remote_get( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $token ) ) );

			if (
				empty( $response->success ) ||
				( 'v3' === $type && $response->score <= wpforms_setting( 'recaptcha-v3-threshold', '0.4' ) )
			) {
				if ( 'v3' === $type ) {
					if ( isset( $response->score ) ) {
						$error .= ' (' . esc_html( $response->score ) . ')';
					}
					$this->errors[ $form_id ]['footer'] = $error;
				} else {
					$this->errors[ $form_id ]['recaptcha'] = $error;
				}
			}
		}

		// Check if combined upload size exceeds allowed maximum.
		$upload_fields = wpforms_get_form_fields( $form, array( 'file-upload' ) );
		if ( ! empty( $upload_fields ) && ! empty( $_FILES ) ) {

			// Get $_FILES keys generated by WPForms only.
			$files_keys = preg_filter( '/^/', 'wpforms_' . $form_id . '_', array_keys( $upload_fields ) );

			// Filter uploads without errors. Individual errors are handled by WPForms_Field_File_Upload class.
			$files          = wp_list_filter( wp_array_slice_assoc( $_FILES, $files_keys ), array( 'error' => 0 ) );
			$files_size     = array_sum( wp_list_pluck( $files, 'size' ) );
			$files_size_max = wpforms_max_upload( true );

			if ( $files_size > $files_size_max ) {

				// Add new header error preserving previous ones.
				$this->errors[ $form_id ]['header']  = ! empty( $this->errors[ $form_id ]['header'] ) ? $this->errors[ $form_id ]['header'] . '<br>' : '';
				$this->errors[ $form_id ]['header'] .= esc_html__( 'Uploaded files combined size exceeds allowed maximum.', 'wpforms-lite' );
			}
		}

		// Initial error check.
		// Don't proceed if there are any errors thus far. We provide a filter
		// so that other features, such as conditional logic, have the ability
		// to adjust blocking errors.
		$errors = apply_filters( 'wpforms_process_initial_errors', $this->errors, $this->form_data );

		if ( isset( $_POST['__amp_form_verify'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			if ( empty( $errors[ $form_id ] ) ) {
				wp_send_json( array(), 200 );
			} else {
				$verify_errors = array();

				foreach ( $errors[ $form_id ] as $field_id => $error_fields ) {
					$field            = $this->form_data['fields'][ $field_id ];
					$field_properties = wpforms()->frontend->get_field_properties( $field, $this->form_data );

					if ( is_string( $error_fields ) ) {

						if ( 'checkbox' === $field['type'] || 'radio' === $field['type'] || 'select' === $field['type'] ) {
							$first = current( $field_properties['inputs'] );
							$name  = $first['attr']['name'];
						} elseif ( isset( $field_properties['inputs']['primary']['attr']['name'] ) ) {
							$name = $field_properties['inputs']['primary']['attr']['name'];
						}

						$verify_errors[] = array(
							'name'    => $name,
							'message' => $error_fields,
						);
					} else {
						foreach ( $error_fields as $error_field => $error_message ) {

							if ( isset( $field_properties['inputs'][ $error_field ]['attr']['name'] ) ) {
								$name = $field_properties['inputs'][ $error_field ]['attr']['name'];
							}

							$verify_errors[] = array(
								'name'    => $name,
								'message' => $error_message,
							);
						}
					}
				}

				wp_send_json(
					array(
						'verifyErrors' => $verify_errors,
					),
					400
				);
			}
			return;
		}

		if ( ! empty( $errors[ $form_id ] ) ) {
			if ( empty( $errors[ $form_id ]['header'] ) ) {
				$errors[ $form_id ]['header'] = esc_html__( 'Form has not been submitted, please see the errors below.', 'wpforms-lite' );
			}
			$this->errors = $errors;
			return;
		}

		// Validate honeypot early - before actual processing.
		if (
			! empty( $this->form_data['settings']['honeypot'] ) &&
			'1' == $this->form_data['settings']['honeypot'] &&
			! empty( $entry['hp'] )
		) {
			$honeypot = esc_html__( 'WPForms honeypot field triggered.', 'wpforms-lite' );
		}

		$honeypot = apply_filters( 'wpforms_process_honeypot', $honeypot, $this->fields, $entry, $this->form_data );

		// If spam - return early.
		if ( $honeypot ) {
			// Logs spam entry depending on log levels set.
			wpforms_log(
				'Spam Entry ' . uniqid(),
				array( $honeypot, $entry ),
				array(
					'type'    => array( 'spam' ),
					'form_id' => $this->form_data['id'],
				)
			);

			return;
		}

		// Pass the form created date into the form data.
		$this->form_data['created'] = $form->post_date;

		// Format fields.
		foreach ( (array) $this->form_data['fields'] as $field_properties ) {

			$field_id     = $field_properties['id'];
			$field_type   = $field_properties['type'];
			$field_submit = isset( $entry['fields'][ $field_id ] ) ? $entry['fields'][ $field_id ] : '';

			do_action( "wpforms_process_format_{$field_type}", $field_id, $field_submit, $this->form_data );
		}

		// This hook is for internal purposes and should not be leveraged.
		do_action( 'wpforms_process_format_after', $this->form_data );

		// Process hooks/filter - this is where most addons should hook
		// because at this point we have completed all field validation and
		// formatted the data.
		$this->fields = apply_filters( 'wpforms_process_filter', $this->fields, $entry, $this->form_data );

		do_action( 'wpforms_process', $this->fields, $entry, $this->form_data );
		do_action( "wpforms_process_{$form_id}", $this->fields, $entry, $this->form_data );

		$this->fields = apply_filters( 'wpforms_process_after_filter', $this->fields, $entry, $this->form_data );

		// One last error check - don't proceed if there are any errors.
		if ( ! empty( $this->errors[ $form_id ] ) ) {
			if ( empty( $this->errors[ $form_id ]['header'] ) ) {
				$this->errors[ $form_id ]['header'] = esc_html__( 'Form has not been submitted, please see the errors below.', 'wpforms-lite' );
			}
			return;
		}

		// Success - add entry to database.
		$this->entry_id = $this->entry_save( $this->fields, $entry, $this->form_data['id'], $this->form_data );

		// Success - send email notification.
		$this->entry_email( $this->fields, $entry, $this->form_data, $this->entry_id, 'entry' );

		// Pass completed and formatted fields in POST.
		$_POST['wpforms']['complete'] = $this->fields;

		// Pass entry ID in POST.
		$_POST['wpforms']['entry_id'] = $this->entry_id;

		// Logs entry depending on log levels set.
		wpforms_log(
			$this->entry_id ? "Entry {$this->entry_id}" : 'Entry',
			$this->fields,
			array(
				'type'    => array( 'entry' ),
				'parent'  => $this->entry_id,
				'form_id' => $this->form_data['id'],
			)
		);

		// Post-process hooks.
		do_action( 'wpforms_process_complete', $this->fields, $entry, $this->form_data, $this->entry_id );
		do_action( "wpforms_process_complete_{$form_id}", $this->fields, $entry, $this->form_data, $this->entry_id );

		$this->entry_confirmation_redirect( $this->form_data );
	}

	/**
	 * Validate the form return hash.
	 *
	 * @since 1.0.0
	 *
	 * @param string $hash
	 * @return mixed false for invalid or form id
	 */
	public function validate_return_hash( $hash = '' ) {

		$query_args = base64_decode( $hash );

		parse_str( $query_args, $output );

		// Verify hash matches.
		if ( wp_hash( $output['form_id'] . ',' . $output['entry_id'] ) !== $output['hash'] ) {
			return false;
		}

		// Get lead and verify it is attached to the form we received with it.
		$entry = wpforms()->entry->get( $output['entry_id'] );

		if ( $output['form_id'] != $entry->form_id ) {
			return false;
		}

		return array(
			'form_id'  => absint( $output['form_id'] ),
			'entry_id' => absint( $output['form_id'] ),
			'fields'   => null !== $entry && isset( $entry->fields ) ? $entry->fields : array(),
		);
	}

	/**
	 * Redirects user to a page or URL specified in the form confirmation settings.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $form_data Form data and settings.
	 * @param string $hash
	 */
	public function entry_confirmation_redirect( $form_data = array(), $hash = '' ) {

		// Maybe process return hash.
		if ( ! empty( $hash ) ) {

			$hash_data = $this->validate_return_hash( $hash );

			if ( ! $hash_data || ! is_array( $hash_data ) ) {
				return;
			}

			$this->valid_hash = true;
			$this->entry_id   = absint( $hash_data['entry_id'] );
			$this->fields     = json_decode( $hash_data['fields'], true );
			$this->form_data  = wpforms()->form->get(
				absint( $hash_data['form_id'] ),
				array(
					'content_only' => true,
				)
			);

		} else {

			$this->form_data = $form_data;
		}

		// Backward compatibility.
		if ( empty( $this->form_data['settings']['confirmations'] ) ) {
			$this->form_data['settings']['confirmations'][1]['type']           = ! empty( $this->form_data['settings']['confirmation_type'] ) ? $this->form_data['settings']['confirmation_type'] : 'message';
			$this->form_data['settings']['confirmations'][1]['message']        = ! empty( $this->form_data['settings']['confirmation_message'] ) ? $this->form_data['settings']['confirmation_message'] : esc_html__( 'Thanks for contacting us! We will be in touch with you shortly.', 'wpforms-lite' );
			$this->form_data['settings']['confirmations'][1]['message_scroll'] = ! empty( $this->form_data['settings']['confirmation_message_scroll'] ) ? $this->form_data['settings']['confirmation_message_scroll'] : 1;
			$this->form_data['settings']['confirmations'][1]['page']           = ! empty( $this->form_data['settings']['confirmation_page'] ) ? $this->form_data['settings']['confirmation_page'] : '';
			$this->form_data['settings']['confirmations'][1]['redirect']       = ! empty( $this->form_data['settings']['confirmation_redirect'] ) ? $this->form_data['settings']['confirmation_redirect'] : '';
		}

		if ( empty( $this->form_data['settings']['confirmations'] ) || ! is_array( $this->form_data['settings']['confirmations'] ) ) {
			return;
		}

		$confirmations = $this->form_data['settings']['confirmations'];

		// Reverse sort confirmations by id to process newer ones first.
		krsort( $confirmations );

		$default_confirmation_key = min( array_keys( $confirmations ) );

		foreach ( $confirmations as $confirmation_id => $confirmation ) {
			// Last confirmation should execute in any case.
			if ( $default_confirmation_key === $confirmation_id ) {
				break;
			}
			$process_confirmation = apply_filters( 'wpforms_entry_confirmation_process', true, $this->fields, $form_data, $confirmation_id );
			if ( $process_confirmation ) {
				break;
			}
		}

		$url = '';
		// Redirect if needed, to either a page or URL, after form processing.
		if ( ! empty( $confirmations[ $confirmation_id ]['type'] ) && 'message' !== $confirmations[ $confirmation_id ]['type'] ) {

			if ( 'redirect' === $confirmations[ $confirmation_id ]['type'] ) {
				add_filter( 'wpforms_field_smart_tag_value', 'rawurlencode' );
				$url = apply_filters( 'wpforms_process_smart_tags', $confirmations[ $confirmation_id ]['redirect'], $this->form_data, $this->fields, $this->entry_id );
			}

			if ( 'page' === $confirmations[ $confirmation_id ]['type'] ) {
				$url = get_permalink( (int) $confirmations[ $confirmation_id ]['page'] );
			}
		}

		if ( ! empty( $url ) ) {
			$url = apply_filters( 'wpforms_process_redirect_url', $url, $this->form_data['id'], $this->fields, $this->form_data, $this->entry_id );
			if ( wpforms_is_amp() ) {
				/** This filter is documented in wp-includes/pluggable.php */
				$url = apply_filters( 'wp_redirect', $url, 302 );
				$url = wp_sanitize_redirect( $url );
				header( sprintf( 'AMP-Redirect-To: %s', $url ) );
				header( 'Access-Control-Expose-Headers: AMP-Redirect-To', false );
				wp_send_json(
					array(
						'message'     => __( 'Redirecting…', 'wpforms-lite' ),
						'redirecting' => true,
					),
					200
				);
			} else {
				wp_redirect( esc_url_raw( $url ) ); // phpcs:ignore
			}
			do_action( 'wpforms_process_redirect', $this->form_data['id'] );
			do_action( "wpforms_process_redirect_{$this->form_data['id']}", $this->form_data['id'] );
			exit;
		}

		// Pass a message to a frontend if no redirection happened.
		if ( ! empty( $confirmations[ $confirmation_id ]['type'] ) && 'message' === $confirmations[ $confirmation_id ]['type'] ) {
			$this->confirmation_message = $confirmations[ $confirmation_id ]['message'];

			if ( ! empty( $confirmations[ $confirmation_id ]['message_scroll'] ) ) {
				wpforms()->frontend->confirmation_message_scroll = true;
			}
		}
	}

	/**
	 * Get confirmation message.
	 *
	 * @param array $form_data Form data and settings.
	 * @param array $fields    Sanitized field data.
	 * @param int   $entry_id  Entry id.
	 * @return string Confirmation message.
	 */
	public function get_confirmation_message( $form_data, $fields, $entry_id ) {
		if ( empty( $this->confirmation_message ) ) {
			return '';
		}
		$confirmation_message = apply_filters( 'wpforms_process_smart_tags', $this->confirmation_message, $form_data, $fields, $entry_id );
		$confirmation_message = apply_filters( 'wpforms_frontend_confirmation_message', wpautop( $confirmation_message ), $form_data, $fields, $entry_id );
		return $confirmation_message;
	}

	/**
	 * Catch the post_max_size overflow.
	 *
	 * @since 1.5.2
	 *
	 * @return boolean
	 */
	public function post_max_size_overflow() {

		if ( empty( $_SERVER['CONTENT_LENGTH'] ) || empty( $_GET['wpforms_form_id'] ) ) { // phpcs:ignore
			return false;
		}

		$form_id       = (int) $_GET['wpforms_form_id'];
		$total_size    = (int) $_SERVER['CONTENT_LENGTH'];
		$post_max_size = wpforms_size_to_bytes( ini_get( 'post_max_size' ) );

		if ( ! ( $total_size > $post_max_size && empty( $_POST ) && $form_id > 0 ) ) {
			return false;
		}

		$total_size    = number_format( $total_size / 1048576, 3 );
		$post_max_size = number_format( $post_max_size / 1048576, 3 );
		$error_msg     = esc_html__( 'Form has not been submitted, please see the errors below.', 'wpforms-lite' );
		$error_msg    .= '<br>' . esc_html__( 'The total size of the selected files {totalSize} Mb exceeds the allowed limit {maxSize} Mb.', 'wpforms-lite' );
		$error_msg     = str_replace( '{totalSize}', $total_size, $error_msg );
		$error_msg     = str_replace( '{maxSize}', $post_max_size, $error_msg );

		$this->errors[ $form_id ]['header'] = $error_msg;

		return true;
	}

	/**
	 * Sends entry email notifications.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $fields    List of fields.
	 * @param array  $entry     Submitted form entry.
	 * @param array  $form_data Form data and settings.
	 * @param int    $entry_id  Saved entry id.
	 * @param string $context   In which context this email is sent.
	 */
	public function entry_email( $fields, $entry, $form_data, $entry_id, $context = '' ) {

		// Check that the form was configured for email notifications.
		if (
			empty( $form_data['settings']['notification_enable'] ) ||
			'1' != $form_data['settings']['notification_enable']
		) {
			return;
		}

		// Provide the opportunity to override via a filter.
		if ( ! apply_filters( 'wpforms_entry_email', true, $fields, $entry, $form_data ) ) {
			return;
		}

		// Make sure we have and entry id.
		if ( empty( $this->entry_id ) ) {
			$this->entry_id = (int) $entry_id;
		}

		$fields = apply_filters( 'wpforms_entry_email_data', $fields, $entry, $form_data );

		// Backwards compatibility for notifications before v1.2.3.
		if ( empty( $form_data['settings']['notifications'] ) ) {
			$notifications[1] = array(
				'email'          => $form_data['settings']['notification_email'],
				'subject'        => $form_data['settings']['notification_subject'],
				'sender_name'    => $form_data['settings']['notification_fromname'],
				'sender_address' => $form_data['settings']['notification_fromaddress'],
				'replyto'        => $form_data['settings']['notification_replyto'],
				'message'        => '{all_fields}',
			);
		} else {
			$notifications = $form_data['settings']['notifications'];
		}

		foreach ( $notifications as $notification_id => $notification ) :

			if ( empty( $notification['email'] ) ) {
				continue;
			}

			$process_email = apply_filters( 'wpforms_entry_email_process', true, $fields, $form_data, $notification_id, $context );

			if ( ! $process_email ) {
				continue;
			}

			$email = array();

			// Setup email properties.
			/* translators: %s - form name. */
			$email['subject']        = ! empty( $notification['subject'] ) ? $notification['subject'] : sprintf( esc_html__( 'New %s Entry', 'wpforms-lite' ), $form_data['settings']['form_title'] );
			$email['address']        = explode( ',', apply_filters( 'wpforms_process_smart_tags', $notification['email'], $form_data, $fields, $this->entry_id ) );
			$email['address']        = array_map( 'sanitize_email', $email['address'] );
			$email['sender_address'] = ! empty( $notification['sender_address'] ) ? $notification['sender_address'] : get_option( 'admin_email' );
			$email['sender_name']    = ! empty( $notification['sender_name'] ) ? $notification['sender_name'] : get_bloginfo( 'name' );
			$email['replyto']        = ! empty( $notification['replyto'] ) ? $notification['replyto'] : false;
			$email['message']        = ! empty( $notification['message'] ) ? $notification['message'] : '{all_fields}';
			$email                   = apply_filters( 'wpforms_entry_email_atts', $email, $fields, $entry, $form_data, $notification_id );

			// Create new email.
			$emails = new WPForms_WP_Emails();
			$emails->__set( 'form_data', $form_data );
			$emails->__set( 'fields', $fields );
			$emails->__set( 'notification_id', $notification_id );
			$emails->__set( 'entry_id', $this->entry_id );
			$emails->__set( 'from_name', $email['sender_name'] );
			$emails->__set( 'from_address', $email['sender_address'] );
			$emails->__set( 'reply_to', $email['replyto'] );

			// Maybe include CC.
			if ( ! empty( $notification['carboncopy'] ) && wpforms_setting( 'email-carbon-copy', false ) ) {
				$emails->__set( 'cc', $notification['carboncopy'] );
			}

			$emails = apply_filters( 'wpforms_entry_email_before_send', $emails );

			// Go.
			foreach ( $email['address'] as $address ) {
				$emails->send( trim( $address ), $email['subject'], $email['message'] );
			}
		endforeach;
	}

	/**
	 * Saves entry to database.
	 *
	 * @since 1.0.0
	 *
	 * @param array $fields    List of form fields.
	 * @param array $entry     User submitted data.
	 * @param int   $form_id   Form ID.
	 * @param array $form_data Prepared form settings.
	 *
	 * @return int
	 */
	public function entry_save( $fields, $entry, $form_id, $form_data = array() ) {

		do_action( 'wpforms_process_entry_save', $fields, $entry, $form_id, $form_data );

		return $this->entry_id;
	}

	/**
	 * Process AJAX form submit.
	 *
	 * @since 1.5.3
	 */
	public function ajax_submit() {

		$form_id = isset( $_POST['wpforms']['id'] ) ? absint( $_POST['wpforms']['id'] ) : 0; // phpcs:ignore

		if ( empty( $form_id ) ) {
			wp_send_json_error();
		}

		add_filter( 'wp_redirect', array( $this, 'ajax_process_redirect' ), 999 );

		do_action( 'wpforms_ajax_submit_before_processing', $form_id );

		// If redirect happens in listen(), ajax_process_redirect() gets executed because of the filter on `wp_redirect`.
		// The code, that is below listen(), runs only if no redirect happened.
		$this->listen();

		$form_data = $this->form_data;

		if ( empty( $form_data ) ) {
			$form_data = wpforms()->form->get( $form_id, array( 'content_only' => true ) );
			$form_data = apply_filters( 'wpforms_frontend_form_data', $form_data );
		}

		if ( ! empty( $this->errors[ $form_id ] ) ) {
			$this->ajax_process_errors( $form_id, $form_data );
			wp_send_json_error();
		}

		ob_start();

		wpforms()->frontend->confirmation( $form_data );

		$response = apply_filters( 'wpforms_ajax_submit_success_response', array( 'confirmation' => ob_get_clean() ), $form_id, $form_data );

		do_action( 'wpforms_ajax_submit_completed', $form_id, $response );

		wp_send_json_success( $response );
	}

	/**
	 * Process AJAX errors.
	 *
	 * @since 1.5.3
	 * @todo This should be re-used/combined for AMP verify-xhr requests.
	 *
	 * @param int   $form_id   Form ID.
	 * @param array $form_data Form data and settings.
	 */
	protected function ajax_process_errors( $form_id, $form_data ) {

		$errors = isset( $this->errors[ $form_id ] ) ? $this->errors[ $form_id ] : array();

		$errors = apply_filters( 'wpforms_ajax_submit_errors', $errors, $form_id, $form_data );

		if ( empty( $errors ) ) {
			wp_send_json_error();
		}

		// General errors are errors that cannot be populated with jQuery Validate plugin.
		$general_errors = array_intersect_key( $errors, array_flip( array( 'header', 'footer', 'recaptcha' ) ) );

		foreach ( $general_errors as $key => $error ) {
			ob_start();
			wpforms()->frontend->form_error( $key, $error );
			$general_errors[ $key ] = ob_get_clean();
		}

		$fields = isset( $form_data['fields'] ) ? $form_data['fields'] : array();

		// Get registered fields errors only.
		$field_errors = array_intersect_key( $errors, $fields );

		// Transform field ids to field names for jQuery Validate plugin.
		foreach ( $field_errors as $key => $error ) {

			$props = wpforms()->frontend->get_field_properties( $fields[ $key ], $form_data );
			$name  = isset( $props['inputs']['primary']['attr']['name'] ) ? $props['inputs']['primary']['attr']['name'] : '';

			if ( $name ) {
				$field_errors[ $name ] = $error;
			}

			unset( $field_errors[ $key ] );
		}

		$response = array();

		if ( $general_errors ) {
			$response['errors']['general'] = $general_errors;
		}

		if ( $field_errors ) {
			$response['errors']['field'] = $field_errors;
		}

		$response = apply_filters( 'wpforms_ajax_submit_errors_response', $response, $form_id, $form_data );

		do_action( 'wpforms_ajax_submit_completed', $form_id, $response );

		wp_send_json_error( $response );
	}

	/**
	 * Process AJAX redirect.
	 *
	 * @since 1.5.3
	 *
	 * @param string $url Redirect URL.
	 */
	public function ajax_process_redirect( $url ) {

		$form_id = isset( $_POST['wpforms']['id'] ) ? absint( $_POST['wpforms']['id'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification

		if ( empty( $form_id ) ) {
			wp_send_json_error();
		}

		$response = array(
			'form_id'      => $form_id,
			'redirect_url' => $url,
		);

		$response = apply_filters( 'wpforms_ajax_submit_redirect', $response, $form_id, $url );

		do_action( 'wpforms_ajax_submit_completed', $form_id, $response );

		wp_send_json_success( $response );
	}
}
