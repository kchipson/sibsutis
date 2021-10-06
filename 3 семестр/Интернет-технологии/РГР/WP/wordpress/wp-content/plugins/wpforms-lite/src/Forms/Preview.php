<?php

namespace WPForms\Forms;

/**
 * Form preview.
 *
 * @package    WPForms\Forms
 * @author     WPForms
 * @since      1.5.1
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2019, WPForms LLC
 */
class Preview {

	/**
	 * Form data.
	 *
	 * @since 1.5.1
	 *
	 * @var array
	 */
	public $form_data;

	/**
	 * Constructor.
	 *
	 * @since 1.5.1
	 */
	public function __construct() {

		if ( ! $this->is_preview_page() ) {
			return;
		}

		$this->hooks();
	}

	/**
	 * Check if current page request meets requirements for form preview page.
	 *
	 * @since 1.5.1
	 *
	 * @return bool
	 */
	public function is_preview_page() {

		// Only proceed for the form preview page.
		if ( empty( $_GET['wpforms_form_preview'] ) ) { // phpcs:ignore
			return false;
		}

		// Check for logged in user with correct capabilities.
		if ( ! \is_user_logged_in() || ! \wpforms_current_user_can() ) {
			return false;
		}

		// Fetch form details for the entry.
		$this->form_data = \wpforms()->form->get(
			\absint( $_GET['wpforms_form_preview'] ), // phpcs:ignore
			array(
				'content_only' => true,
			)
		);

		// Check valid form was found.
		if ( empty( $this->form_data ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Hooks.
	 *
	 * @since 1.5.1
	 */
	public function hooks() {

		\add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ) );

		\add_filter( 'the_title', array( $this, 'the_title' ), 100, 1 );

		\add_filter( 'the_content', array( $this, 'the_content' ), 999 );

		\add_filter( 'get_the_excerpt', array( $this, 'the_content' ), 999 );

		\add_filter( 'template_include', array( $this, 'template_include' ) );

		\add_filter( 'post_thumbnail_html', '__return_empty_string' );
	}

	/**
	 * Modify query, limit to one post.
	 *
	 * @since 1.5.1
	 *
	 * @param WP_Query $query The WP_Query instance.
	 */
	public function pre_get_posts( $query ) {

		if ( ! is_admin() && $query->is_main_query() ) {
			$query->set( 'posts_per_page', 1 );
		}
	}

	/**
	 * Customize form preview page title.
	 *
	 * @since 1.5.1
	 *
	 * @param string $title Page title.
	 *
	 * @return string
	 */
	public function the_title( $title ) {

		if ( in_the_loop() ) {
			$title = sprintf( /* translators: %s - form title. */
				esc_html__( '%s Preview', 'wpforms-lite' ),
				! empty( $this->form_data['settings']['form_title'] ) ? sanitize_text_field( $this->form_data['settings']['form_title'] ) : esc_html__( 'Form', 'wpforms-lite' )
			);
		}

		return $title;
	}

	/**
	 * Customize form preview page content.
	 *
	 * @since 1.5.1
	 *
	 * @return string
	 */
	public function the_content() {

		// Extra cap check just for fun.
		if ( ! \wpforms_current_user_can() ) {
			return;
		}

		$content = esc_html__( 'This is a preview of your form. This page is not publicly accessible.', 'wpforms-lite' );

		if ( ! empty( $_GET['new_window'] ) ) { // phpcs:ignore
			$content .= ' <a href="javascript:window.close();">' . esc_html__( 'Close this window', 'wpforms-lite' ) . '.</a>';
		}

		$content .= do_shortcode( '[wpforms id="' . absint( $this->form_data['id'] ) . '"]' );

		return $content;
	}

	/**
	 * Force page template types.
	 *
	 * @since 1.5.1
	 *
	 * @return array
	 */
	public function template_include() {

		return locate_template( array( 'page.php', 'single.php', 'index.php' ) );
	}
}
