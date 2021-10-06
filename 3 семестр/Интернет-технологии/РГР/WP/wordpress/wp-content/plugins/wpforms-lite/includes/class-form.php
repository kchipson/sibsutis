<?php

/**
 * All the form goodness and basics.
 *
 * Contains a bunch of helper methods as well.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */
class WPForms_Form_Handler {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Register wpforms custom post type.
		$this->register_cpt();

		// Add wpforms to new-content admin bar menu.
		add_action( 'admin_bar_menu', array( $this, 'admin_bar' ), 99 );

	}

	/**
	 * Registers the custom post type to be used for forms.
	 *
	 * @since 1.0.0
	 */
	public function register_cpt() {

		// Custom post type arguments, which can be filtered if needed.
		$args = apply_filters(
			'wpforms_post_type_args',
			array(
				'label'               => 'WPForms',
				'public'              => false,
				'exclude_from_search' => true,
				'show_ui'             => false,
				'show_in_admin_bar'   => false,
				'rewrite'             => false,
				'query_var'           => false,
				'can_export'          => false,
				'supports'            => array( 'title' ),
				'capability_type'     => wpforms_get_capability_manage_options(),
			)
		);

		// Register the post type.
		register_post_type( 'wpforms', $args );
	}

	/**
	 * Adds "WPForm" item to new-content admin bar menu item.
	 *
	 * @since 1.1.7.2
	 *
	 * @param WP_Admin_Bar $wp_admin_bar WP_Admin_Bar instance, passed by reference.
	 */
	public function admin_bar( $wp_admin_bar ) {

		if ( ! is_admin_bar_showing() || ! wpforms_current_user_can() ) {
			return;
		}

		$args = array(
			'id'     => 'wpforms',
			'title'  => esc_html__( 'WPForms', 'wpforms-lite' ),
			'href'   => admin_url( 'admin.php?page=wpforms-builder' ),
			'parent' => 'new-content',
		);
		$wp_admin_bar->add_node( $args );
	}

	/**
	 * Fetches forms
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $id   Form ID.
	 * @param array $args Additional arguments array.
	 *
	 * @return array|bool|null|WP_Post
	 */
	public function get( $id = '', $args = array() ) {

		$args = apply_filters( 'wpforms_get_form_args', $args );

		if ( false === $id ) {
			return false;
		}

		if ( ! empty( $id ) ) {

			// @todo add $id array support
			// If ID is provided, we get a single form
			$forms = get_post( absint( $id ) );

			if ( ! empty( $args['content_only'] ) ) {
				$forms = ! empty( $forms ) && 'wpforms' === $forms->post_type ? wpforms_decode( $forms->post_content ) : false;
			}
		} else {

			// No ID provided, get multiple forms.
			$defaults = array(
				'post_type'     => 'wpforms',
				'orderby'       => 'id',
				'order'         => 'ASC',
				'no_found_rows' => true,
				'nopaging'      => true,
			);

			$args = wp_parse_args( $args, $defaults );

			$args['post_type'] = 'wpforms';

			$forms = get_posts( $args );
		}

		if ( empty( $forms ) ) {
			return false;
		}

		return $forms;
	}

	/**
	 * Delete forms.
	 *
	 * @since 1.0.0
	 *
	 * @param array $ids Form IDs.
	 *
	 * @return boolean
	 */
	public function delete( $ids = array() ) {

		// Check for permissions.
		if ( ! wpforms_current_user_can() ) {
			return false;
		}

		if ( ! is_array( $ids ) ) {
			$ids = array( $ids );
		}

		$ids = array_map( 'absint', $ids );

		foreach ( $ids as $id ) {

			$form = wp_delete_post( $id, true );

			if ( class_exists( 'WPForms_Entry_Handler', false ) ) {
				wpforms()->entry->delete_by( 'form_id', $id );
				wpforms()->entry_meta->delete_by( 'form_id', $id );
				wpforms()->entry_fields->delete_by( 'form_id', $id );
			}

			if ( ! $form ) {
				return false;
			}
		}

		do_action( 'wpforms_delete_form', $ids );

		return true;
	}

	/**
	 * Add new form.
	 *
	 * @since 1.0.0
	 *
	 * @param string $title
	 * @param array $args
	 * @param array $data
	 *
	 * @return mixed
	 */
	public function add( $title = '', $args = array(), $data = array() ) {

		// Check for permissions.
		if ( ! wpforms_current_user_can() ) {
			return false;
		}

		// Must have a title.
		if ( empty( $title ) ) {
			return false;
		}

		// This filter breaks forms if they contain HTML.
		remove_filter( 'content_save_pre', 'balanceTags', 50 );

		// Add filter of the link rel attr to avoid JSON damage.
		add_filter( 'wp_targeted_link_rel', '__return_empty_string', 50, 1 );

		$args = apply_filters( 'wpforms_create_form_args', $args, $data );

		$form_content = array(
			'field_id' => '0',
			'settings' => array(
				'form_title' => sanitize_text_field( $title ),
				'form_desc'  => '',
			),
		);

		// Merge args and create the form.
		$form    = wp_parse_args(
			$args,
			array(
				'post_title'   => esc_html( $title ),
				'post_status'  => 'publish',
				'post_type'    => 'wpforms',
				'post_content' => wpforms_encode( $form_content ),
			)
		);
		$form_id = wp_insert_post( $form );

		// If the form is created outside the context of the WPForms form
		// builder, then we define some additional default values.
		if ( ! empty( $form_id ) && isset( $data['builder'] ) && $data['builder'] === false ) {
			$form_data                                       = json_decode( wp_unslash( $form['post_content'] ), true );
			$form_data['id']                                 = $form_id;
			$form_data['settings']['submit_text']            = esc_html__( 'Submit', 'wpforms-lite' );
			$form_data['settings']['submit_text_processing'] = esc_html__( 'Sending...', 'wpforms-lite' );
			$form_data['settings']['notification_enable']    = '1';
			$form_data['settings']['notifications']          = array(
				'1' => array(
					'email'          => '{admin_email}',
					'subject'        => sprintf( esc_html__( 'New Entry: %s', 'wpforms-lite' ), esc_html( $title ) ),
					'sender_name'    => get_bloginfo( 'name' ),
					'sender_address' => '{admin_email}',
					'replyto'        => '{field_id="1"}',
					'message'        => '{all_fields}',
				),
			);
			$form_data['settings']['confirmations']          = array(
				'1' => array(
					'type'           => 'message',
					'message'        => esc_html__( 'Thanks for contacting us! We will be in touch with you shortly.', 'wpforms-lite' ),
					'message_scroll' => '1',
				),
			);

			$this->update( $form_id, $form_data );
		}

		do_action( 'wpforms_create_form', $form_id, $form, $data );

		return $form_id;
	}

	/**
	 * Updates form
	 *
	 * @since 1.0.0
	 *
	 * @param string $form_id Form ID.
	 * @param array  $data Data retrieved from $_POST and processed.
	 * @param array  $args Empty by default, may have custom data not intended to be saved.
	 *
	 * @return mixed
	 * @internal param string $title
	 */
	public function update( $form_id = '', $data = array(), $args = array() ) {

		// This filter breaks forms if they contain HTML.
		remove_filter( 'content_save_pre', 'balanceTags', 50 );

		// Add filter of the link rel attr to avoid JSON damage.
		add_filter( 'wp_targeted_link_rel', '__return_empty_string', 50, 1 );

		// Check for permissions.
		if ( ! wpforms_current_user_can() ) {
			return false;
		}

		if ( empty( $data ) ) {
			return false;
		}

		if ( empty( $form_id ) ) {
			$form_id = $data['id'];
		}

		$data = wp_unslash( $data );

		if ( ! empty( $data['settings']['form_title'] ) ) {
			$title = $data['settings']['form_title'];
		} else {
			$title = get_the_title( $form_id );
		}

		if ( ! empty( $data['settings']['form_desc'] ) ) {
			$desc = $data['settings']['form_desc'];
		} else {
			$desc = '';
		}

		$data['field_id'] = ! empty( $data['field_id'] ) ? absint( $data['field_id'] ) : '0';

		// Preserve form meta.
		$meta = $this->get_meta( $form_id );
		if ( $meta ) {
			$data['meta'] = $meta;
		}

		// Preserve field meta.
		if ( isset( $data['fields'] ) ) {
			foreach ( $data['fields'] as $i => $field_data ) {
				if ( isset( $field_data['id'] ) ) {
					$field_meta = $this->get_field_meta( $form_id, $field_data['id'] );
					if ( $field_meta ) {
						$data['fields'][ $i ]['meta'] = $field_meta;
					}
				}
			}
		}

		// Sanitize - don't allow tags for users who do not have appropriate cap.
		// If we don't do this, forms for these users can get corrupt due to
		// conflicts with wp_kses().
		if ( ! current_user_can( 'unfiltered_html' ) ) {
			$data = map_deep( $data, 'wp_strip_all_tags' );
		}

		// Sanitize notification names.
		if ( isset( $data['settings']['notifications'] ) ) {
			foreach ( $data['settings']['notifications'] as $id => &$notification ) {
				if ( ! empty( $notification['notification_name'] ) ) {
					$notification['notification_name'] = sanitize_text_field( $notification['notification_name'] );
				}
			}
		}
		unset( $notification );

		$form = apply_filters(
			'wpforms_save_form_args',
			array(
				'ID'           => $form_id,
				'post_title'   => esc_html( $title ),
				'post_excerpt' => $desc,
				'post_content' => wpforms_encode( $data ),
			),
			$data,
			$args
		);

		$form_id = wp_update_post( $form );

		do_action( 'wpforms_save_form', $form_id, $form );

		return $form_id;
	}

	/**
	 * Duplicate forms.
	 *
	 * @since 1.1.4
	 *
	 * @param array $ids Form IDs to duplicate.
	 *
	 * @return boolean
	 */
	public function duplicate( $ids = array() ) {

		// Add filter of the link rel attr to avoid JSON damage.
		add_filter( 'wp_targeted_link_rel', '__return_empty_string', 50, 1 );

		// This filter breaks forms if they contain HTML.
		remove_filter( 'content_save_pre', 'balanceTags', 50 );

		// Check for permissions.
		if ( ! wpforms_current_user_can() ) {
			return false;
		}

		if ( ! is_array( $ids ) ) {
			$ids = array( $ids );
		}

		$ids = array_map( 'absint', $ids );

		foreach ( $ids as $id ) {

			// Get original entry.
			$form = get_post( $id );

			// Confirm form exists.
			if ( ! $form || empty( $form ) ) {
				return false;
			}

			// Get the form data.
			$new_form_data = wpforms_decode( $form->post_content );

			// Remove form ID from title if present.
			$new_form_data['settings']['form_title'] = str_replace( '(ID #' . absint( $id ) . ')', '', $new_form_data['settings']['form_title'] );

			// Create the duplicate form.
			$new_form    = array(
				'post_author'  => $form->post_author,
				'post_content' => wpforms_encode( $new_form_data ),
				'post_excerpt' => $form->post_excerpt,
				'post_status'  => $form->post_status,
				'post_title'   => $new_form_data['settings']['form_title'],
				'post_type'    => $form->post_type,
			);
			$new_form_id = wp_insert_post( $new_form );

			if ( ! $new_form_id || is_wp_error( $new_form_id ) ) {
				return false;
			}

			// Set new form name.
			$new_form_data['settings']['form_title'] .= ' (ID #' . absint( $new_form_id ) . ')';

			// Set new form ID.
			$new_form_data['id'] = absint( $new_form_id );

			// Update new duplicate form.
			$new_form_id = $this->update( $new_form_id, $new_form_data );

			if ( ! $new_form_id || is_wp_error( $new_form_id ) ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Get the next available field ID and increment by one.
	 *
	 * @since 1.0.0
	 *
	 * @param int $form_id
	 *
	 * @return mixed int or false
	 */
	public function next_field_id( $form_id ) {

		// Check for permissions.
		if ( ! wpforms_current_user_can() ) {
			return false;
		}

		if ( empty( $form_id ) ) {
			return false;
		}

		$form = $this->get( $form_id, array(
			'content_only' => true,
		) );

		if ( ! empty( $form['field_id'] ) ) {

			$field_id = absint( $form['field_id'] );

			if ( ! empty( $form['fields'] ) && max( array_keys( $form['fields'] ) ) > $field_id ) {
				$field_id = max( array_keys( $form['fields'] ) ) + 1;
			}

			$form['field_id'] = $field_id + 1;

		} else {
			$field_id         = '0';
			$form['field_id'] = '1';
		}

		$this->update( $form_id, $form );

		return $field_id;
	}

	/**
	 * Get private meta information for a form.
	 *
	 * @since 1.0.0
	 *
	 * @param string $form_id Form ID.
	 * @param string $field   Field.
	 *
	 * @return false|array
	 */
	public function get_meta( $form_id, $field = '' ) {

		if ( empty( $form_id ) ) {
			return false;
		}

		$data = $this->get(
			$form_id,
			array(
				'content_only' => true,
			)
		);

		if ( isset( $data['meta'] ) ) {
			if ( empty( $field ) ) {
				return $data['meta'];
			} elseif ( isset( $data['meta'][ $field ] ) ) {
				return $data['meta'][ $field ];
			}
		}

		return false;
	}

	/**
	 * Update or add form meta information to a form.
	 *
	 * @since 1.4.0
	 *
	 * @param int $form_id
	 * @param string $meta_key
	 * @param mixed $meta_value
	 *
	 * @return bool
	 */
	public function update_meta( $form_id, $meta_key, $meta_value ) {

		// Add filter of the link rel attr to avoid JSON damage.
		add_filter( 'wp_targeted_link_rel', '__return_empty_string', 50, 1 );

		// This filter breaks forms if they contain HTML.
		remove_filter( 'content_save_pre', 'balanceTags', 50 );

		// Check for permissions.
		if ( ! wpforms_current_user_can() ) {
			return false;
		}

		if ( empty( $form_id ) || empty( $meta_key ) ) {
			return false;
		}

		$form = get_post( absint( $form_id ) );

		if ( empty( $form ) ) {
			return false;
		}

		$data     = wpforms_decode( $form->post_content );
		$meta_key = wpforms_sanitize_key( $meta_key );

		$data['meta'][ $meta_key ] = $meta_value;

		$form    = array(
			'ID'           => $form_id,
			'post_content' => wpforms_encode( $data ),
		);
		$form    = apply_filters( 'wpforms_update_form_meta_args', $form, $data );
		$form_id = wp_update_post( $form );

		do_action( 'wpforms_update_form_meta', $form_id, $form, $meta_key, $meta_value );

		return $form_id;
	}

	/**
	 * Delete form meta information from a form.
	 *
	 * @since 1.4.0
	 *
	 * @param int $form_id
	 * @param string $meta_key
	 *
	 * @return bool
	 */
	public function delete_meta( $form_id, $meta_key ) {

		// Add filter of the link rel attr to avoid JSON damage.
		add_filter( 'wp_targeted_link_rel', '__return_empty_string', 50, 1 );

		// This filter breaks forms if they contain HTML.
		remove_filter( 'content_save_pre', 'balanceTags', 50 );

		// Check for permissions.
		if ( ! wpforms_current_user_can() ) {
			return false;
		}

		if ( empty( $form_id ) || empty( $meta_key ) ) {
			return false;
		}

		$form = get_post( absint( $form_id ) );

		if ( empty( $form ) ) {
			return false;
		}

		$data     = wpforms_decode( $form->post_content );
		$meta_key = wpforms_sanitize_key( $meta_key );

		unset( $data['meta'][ $meta_key ] );

		$form    = array(
			'ID'           => $form_id,
			'post_content' => wpforms_encode( $data ),
		);
		$form    = apply_filters( 'wpforms_delete_form_meta_args', $form, $data );
		$form_id = wp_update_post( $form );

		do_action( 'wpforms_delete_form_meta', $form_id, $form, $meta_key );

		return $form_id;
	}

	/**
	 * Get private meta information for a form field.
	 *
	 * @since 1.0.0
	 *
	 * @param string $form_id
	 * @param string $field_id
	 *
	 * @return bool
	 */
	public function get_field( $form_id, $field_id = '' ) {

		if ( empty( $form_id ) ) {
			return false;
		}

		$data = $this->get( $form_id, array(
			'content_only' => true,
		) );

		return isset( $data['fields'][ $field_id ] ) ? $data['fields'][ $field_id ] : false;
	}

	/**
	 * Get private meta information for a form field.
	 *
	 * @since 1.0.0
	 *
	 * @param string $form_id
	 * @param string $field
	 *
	 * @return bool
	 */
	public function get_field_meta( $form_id, $field = '' ) {

		$field = $this->get_field( $form_id, $field );
		if ( ! $field ) {
			return false;
		}

		return isset( $field['meta'] ) ? $field['meta'] : false;
	}
}
