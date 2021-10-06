<?php

namespace WPForms\Lite\Admin;

/**
 * WPForms admin pages changes and enhancements to educate Lite users on what is available in WPForms Pro.
 *
 * @since 1.5.7
 */
class Education {

	/**
	 * WPForms admin page slug.
	 *
	 * @since 1.5.7
	 *
	 * @var string
	 */
	public $page;

	/**
	 * Constructor.
	 *
	 * @since 1.5.7
	 */
	public function __construct() {

		$this->hooks();
	}

	/**
	 * Hooks.
	 *
	 * @since 1.5.7
	 */
	public function hooks() {

		if ( ! \wpforms_is_admin_page() && ! \wp_doing_ajax() ) {
			return;
		}

		if ( ! \apply_filters( 'wpforms_lite_admin_education', true ) ) {
			return;
		}

		// Admin page slug.
		$this->page = str_replace( 'wpforms-', '', filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING ) );

		\add_action( 'admin_init', array( $this, 'notice_bar_init' ) );
	}

	/**
	 * Notice bar init.
	 *
	 * @since 1.5.7
	 */
	public function notice_bar_init() {

		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueues' ) );
		\add_action( 'wpforms_admin_header_before', array( $this, 'notice_bar_display' ) );
		\add_action( 'wp_ajax_wpforms_notice_bar_dismiss', array( $this, 'notice_bar_ajax_dismiss' ) );
	}

	/**
	 * Notice bar display message.
	 *
	 * @since 1.5.7
	 */
	public function notice_bar_display() {

		$current_user = \wp_get_current_user();
		$dismissed    = \get_user_meta( $current_user->ID, 'wpforms_dismissed', true );

		if ( ! empty( $dismissed['lite-notice-bar'] ) ) {
			return;
		}

		$msg = sprintf(
			/* translators: %s - WPForms.com Upgrade page URL. */
			__( 'You’re using WPForms Lite. To unlock more features consider <a href="%s" target="_blank" rel="noopener noreferrer">upgrading to Pro</a>.', 'wpforms-lite' ),
			\wpforms_admin_upgrade_link( 'notice-bar' )
		);

		printf(
			'<div id="wpforms-notice-bar">
				<span class="wpforms-notice-bar-message">%s</span>
				<button type="button" class="dismiss" title="%s" data-page="%s" />
			</div>',
			\wp_kses(
				$msg,
				array(
					'a' => array(
						'href'   => array(),
						'rel'    => array(),
						'target' => array(),
					),
				)
			),
			\esc_attr__( 'Dismiss this message.', 'wpforms-lite' ),
			\esc_attr( $this->page )
		);
	}

	/**
	 * Ajax handler for dismissing DYK notices.
	 *
	 * @since 1.5.7
	 */
	public function notice_bar_ajax_dismiss() {

		// Run a security check.
		\check_ajax_referer( 'wpforms-admin', 'nonce' );

		// Check for permissions.
		if ( ! \wpforms_current_user_can() ) {
			\wp_send_json_error(
				array(
					'error' => \esc_html__( 'You do not have permission to perform this action.', 'wpforms-lite' ),
				)
			);
		}

		$current_user = \wp_get_current_user();
		$dismissed    = \get_user_meta( $current_user->ID, 'wpforms_dismissed', true );

		if ( empty( $dismissed ) ) {
			$dismissed = array();
		}

		$dismissed['lite-notice-bar'] = time();

		\update_user_meta( $current_user->ID, 'wpforms_dismissed', $dismissed );
		\wp_send_json_success();
	}

	/**
	 * Load enqueues.
	 *
	 * @since 1.5.7
	 */
	public function enqueues() {

		$min = \wpforms_get_min_suffix();

		\wp_enqueue_script(
			'wpforms-lite-admin-education',
			\WPFORMS_PLUGIN_URL . "lite/assets/js/admin/education{$min}.js",
			array( 'jquery' ),
			\WPFORMS_VERSION,
			false
		);
	}
}
