<?php

/**
 * Primary overview page inside the admin which lists all forms.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */
class WPForms_Overview {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Maybe load overview page.
		add_action( 'admin_init', array( $this, 'init' ) );
	}

	/**
	 * Determine if the user is viewing the overview page, if so, party on.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		// Only load if we are actually on the overview page.
		if ( ! wpforms_is_admin_page( 'overview' ) ) {
			return;
		}

		// Setup screen options.
		add_action( 'load-toplevel_page_wpforms-overview', array( $this, 'screen_options' ) );
		add_filter( 'set-screen-option', array( $this, 'screen_options_set' ), 10, 3 );

		// Bulk actions.
		add_action( 'load-toplevel_page_wpforms-overview', array( $this, 'notices' ) );
		add_action( 'load-toplevel_page_wpforms-overview', array( $this, 'process_bulk_actions' ) );
		add_filter( 'removable_query_args', array( $this, 'removable_query_args' ) );

		// The overview page leverages WP_List_Table so we must load it.
		if ( ! class_exists( 'WP_List_Table', false ) ) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
		}

		// Load the class that builds the overview table.
		require_once WPFORMS_PLUGIN_DIR . 'includes/admin/overview/class-overview-table.php';

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueues' ) );
		add_action( 'wpforms_admin_page', array( $this, 'output' ) );

		// Provide hook for addons.
		do_action( 'wpforms_overview_init' );
	}

	/**
	 * Add per-page screen option to the Forms table.
	 *
	 * @since 1.0.0
	 */
	public function screen_options() {

		$screen = get_current_screen();

		if ( null === $screen || 'toplevel_page_wpforms-overview' !== $screen->id ) {
			return;
		}

		add_screen_option(
			'per_page',
			array(
				'label'   => esc_html__( 'Number of forms per page:', 'wpforms-lite' ),
				'option'  => 'wpforms_forms_per_page',
				'default' => apply_filters( 'wpforms_overview_per_page', 20 ),
			)
		);
	}

	/**
	 * Forms table per-page screen option value.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed  $status
	 * @param string $option
	 * @param mixed  $value
	 *
	 * @return mixed
	 */
	public function screen_options_set( $status, $option, $value ) {

		if ( 'wpforms_forms_per_page' === $option ) {
			return $value;
		}

		return $status;
	}

	/**
	 * Enqueue assets for the overview page.
	 *
	 * @since 1.0.0
	 */
	public function enqueues() {

		// Hook for addons.
		do_action( 'wpforms_overview_enqueue' );
	}

	/**
	 * Build the output for the overview page.
	 *
	 * @since 1.0.0
	 */
	public function output() {

		?>
		<div id="wpforms-overview" class="wrap wpforms-admin-wrap">

			<h1 class="page-title">
				<?php esc_html_e( 'Forms Overview', 'wpforms-lite' ); ?>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=wpforms-builder&view=setup' ) ); ?>" class="add-new-h2 wpforms-btn-orange">
					<?php esc_html_e( 'Add New', 'wpforms-lite' ); ?>
				</a>
			</h1>

			<?php
			$overview_table = new WPForms_Overview_Table();
			$overview_table->prepare_items();
			?>

			<div class="wpforms-admin-content">

				<form id="wpforms-overview-table" method="get" action="<?php echo esc_url( admin_url( 'admin.php?page=wpforms-overview' ) ); ?>">

					<input type="hidden" name="post_type" value="wpforms" />

					<input type="hidden" name="page" value="wpforms-overview" />

					<?php $overview_table->views(); ?>
					<?php $overview_table->display(); ?>

				</form>

			</div>

		</div>
		<?php
	}

	/**
	 * Add admin action notices and process bulk actions.
	 *
	 * @since 1.5.7
	 */
	public function notices() {

		$deleted    = ! empty( $_REQUEST['deleted'] ) ? sanitize_key( $_REQUEST['deleted'] ) : false; // phpcs:ignore WordPress.Security.NonceVerification
		$duplicated = ! empty( $_REQUEST['duplicated'] ) ? sanitize_key( $_REQUEST['duplicated'] ) : false; // phpcs:ignore WordPress.Security.NonceVerification
		$notice     = array();

		if ( $deleted && 'error' !== $deleted ) {
			$notice = array(
				'type' => 'info',
				/* translators: %s - Deleted forms count. */
				'msg'  => sprintf( _n( '%s form was successfully deleted.', '%s forms were successfully deleted.', $deleted, 'wpforms-lite' ), $deleted ),
			);
		}

		if ( $duplicated && 'error' !== $duplicated ) {
			$notice = array(
				'type' => 'info',
				/* translators: %s - Duplicated forms count. */
				'msg'  => sprintf( _n( '%s form was successfully duplicated.', '%s forms were successfully duplicated.', $duplicated, 'wpforms-lite' ), $duplicated ),
			);
		}

		if ( 'error' === $deleted || 'error' === $duplicated ) {
			$notice = array(
				'type' => 'error',
				'msg'  => esc_html__( 'Security check failed. Please try again.', 'wpforms-lite' ),
			);
		}

		if ( ! empty( $notice ) ) {
			WPForms_Admin_Notice::add( $notice['msg'], $notice['type'] );
		}
	}

	/**
	 * Process the bulk table actions.
	 *
	 * @since 1.5.7
	 */
	public function process_bulk_actions() {

		$ids    = isset( $_GET['form_id'] ) ? array_map( 'absint', (array) $_GET['form_id'] ) : array(); // phpcs:ignore WordPress.Security.NonceVerification
		$action = ! empty( $_REQUEST['action'] ) ? sanitize_key( $_REQUEST['action'] ) : false; // phpcs:ignore WordPress.Security.NonceVerification

		// Checking the sortable column link.
		$is_orderby_link = ! empty( $_REQUEST['orderby'] ) && ! empty( $_REQUEST['order'] );

		if ( empty( $ids ) || empty( $action ) || $is_orderby_link ) {
			return;
		}

		// Check exact action values.
		if ( ! in_array( $action, [ 'delete', 'duplicate' ], true ) ) {
			return;
		}

		// Check the nonce.
		if (
			empty( $_GET['_wpnonce'] ) ||
			(
				! wp_verify_nonce( sanitize_key( $_GET['_wpnonce'] ), 'bulk-forms' ) &&
				! wp_verify_nonce( sanitize_key( $_GET['_wpnonce'] ), 'wpforms_' . $action . '_form_nonce' )
			)
		) {
			return;
		}

		// Check that we have a method for this action.
		if ( ! method_exists( $this, 'bulk_action_' . $action . '_forms' ) ) {
			return;
		}

		$processed_forms = count( $this->{'bulk_action_' . $action . '_forms'}( $ids ) );

		if ( ! empty( $action ) ) {
			// Unset get vars and perform redirect to avoid action reuse.
			wp_safe_redirect(
				add_query_arg(
					$action . 'd',
					$processed_forms,
					remove_query_arg( array( 'action', 'action2', '_wpnonce', 'form_id', 'paged', '_wp_http_referer' ) )
				)
			);
			exit;
		}
	}

	/**
	 * Delete forms.
	 *
	 * @since 1.5.7
	 *
	 * @param array $ids Form ids to delete.
	 *
	 * @return array List of deleted forms.
	 */
	private function bulk_action_delete_forms( $ids ) {

		if ( ! is_array( $ids ) ) {
			return [];
		}

		$deleted = [];

		foreach ( $ids as $id ) {
			$deleted[ $id ] = wpforms()->form->delete( $id );
		}

		return array_keys( array_filter( $deleted ) );
	}

	/**
	 * Duplicate forms.
	 *
	 * @since 1.5.7
	 *
	 * @param array $ids Form ids to duplicate.
	 *
	 * @return array List of duplicated forms.
	 */
	private function bulk_action_duplicate_forms( $ids ) {

		if ( ! is_array( $ids ) ) {
			return [];
		}

		$duplicated = [];

		foreach ( $ids as $id ) {
			$duplicated[ $id ] = wpforms()->form->duplicate( $id );
		}

		return array_keys( array_filter( $duplicated ) );
	}

	/**
	 * Remove certain arguments from a query string that WordPress should always hide for users.
	 *
	 * @since 1.5.7
	 *
	 * @param array $removable_query_args An array of parameters to remove from the URL.
	 *
	 * @return array Extended/filtered array of parameters to remove from the URL.
	 */
	public function removable_query_args( $removable_query_args ) {

		if ( wpforms_is_admin_page( 'overview' ) ) {
			$removable_query_args[] = 'duplicated';
		}

		return $removable_query_args;
	}
}

new WPForms_Overview();
