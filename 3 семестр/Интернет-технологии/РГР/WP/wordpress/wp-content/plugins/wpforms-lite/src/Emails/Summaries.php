<?php
namespace WPForms\Emails;

/**
 * Email Summaries main class.
 *
 * @package    WPForms\Emails
 * @author     WPForms
 * @since      1.5.4
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2019, WPForms LLC
 */
class Summaries {

	/**
	 * Constructor.
	 *
	 * @since 1.5.4
	 */
	public function __construct() {

		$this->hooks();

		$summaries_disabled = $this->is_disabled();

		if ( $summaries_disabled && \wp_next_scheduled( 'wpforms_email_summaries_cron' ) ) {
			\wp_clear_scheduled_hook( 'wpforms_email_summaries_cron' );
		}

		if ( ! $summaries_disabled && ! \wp_next_scheduled( 'wpforms_email_summaries_cron' ) ) {
			\wp_schedule_event( $this->get_first_cron_date_gmt(), 'wpforms_email_summaries_weekly', 'wpforms_email_summaries_cron' );
		}
	}

	/**
	 * Get the instance of a class and store it in itself.
	 *
	 * @since 1.5.4
	 */
	public static function get_instance() {

		static $instance;

		if ( ! $instance ) {
			$instance = new self();
		}

		return $instance;
	}

	/**
	 * Email Summaries hooks.
	 *
	 * @since 1.5.4
	 */
	public function hooks() {

		\add_filter( 'wpforms_settings_defaults', array( $this, 'disable_summaries_setting' ) );

		if ( ! $this->is_disabled() ) {
			\add_action( 'init', array( $this, 'preview' ) );
			\add_filter( 'cron_schedules', array( $this, 'add_weekly_cron_schedule' ) );
			\add_action( 'wpforms_email_summaries_cron', array( $this, 'cron' ) );
		}
	}

	/**
	 * Check if Email Summaries are disabled in settings.
	 *
	 * @since 1.5.4
	 *
	 * @return bool
	 */
	protected function is_disabled() {

		return (bool) apply_filters( 'wpforms_emails_summaries_is_disabled', (bool) \wpforms_setting( 'email-summaries-disable' ) );
	}

	/**
	 * Add "Disable Email Summaries" to WPForms settings.
	 *
	 * @since 1.5.4
	 *
	 * @param array $settings WPForms settings.
	 *
	 * @return mixed
	 */
	public function disable_summaries_setting( $settings ) {

		if ( (bool) apply_filters( 'wpforms_emails_summaries_is_disabled', false ) ) {
			return $settings;
		}

		$url = \add_query_arg(
			array(
				'wpforms_email_template' => 'summary',
				'wpforms_email_preview'  => '1',
			),
			\admin_url()
		);

		$desc = \esc_html__( 'Disable Email Summaries weekly delivery.', 'wpforms-lite' );

		if ( ! $this->is_disabled() ) {
			$desc .= '<br><a href="' . $url . '" target="_blank">' . \esc_html__( 'View Email Summary Example', 'wpforms-lite' ) . '</a>';
		}

		$settings['misc']['email-summaries-disable'] = array(
			'id'   => 'email-summaries-disable',
			'name' => \esc_html__( 'Disable Email Summaries', 'wpforms-lite' ),
			'desc' => $desc,
			'type' => 'checkbox',
		);

		return $settings;
	}

	/**
	 * Preview Email Summary.
	 *
	 * @since 1.5.4
	 */
	public function preview() {

		if ( ! \wpforms_current_user_can() ) {
			return;
		}

		if ( ! isset( $_GET['wpforms_email_preview'], $_GET['wpforms_email_template'] ) ) { // phpcs:ignore
			return;
		}

		if ( 'summary' !== $_GET['wpforms_email_template'] ) { // phpcs:ignore
			return;
		}

		$args = array(
			'body' => array(
				'entries'    => $this->get_entries(),
				'info_block' => ( new InfoBlocks() )->get_next(),
			),
		);

		$template = ( new Templates\Summary() )->set_args( $args );
		$template = \apply_filters( 'wpforms_emails_summaries_template', $template );

		$content = $template->get();

		if ( 'default' !== \wpforms_setting( 'email-template', 'default' ) ) {
			$content = \wpautop( $content );
		}

		echo $content; // phpcs:ignore

		exit;
	}

	/**
	 * Get next cron occurrence date.
	 *
	 * @since 1.5.4
	 *
	 * @return int
	 */
	protected function get_first_cron_date_gmt() {

		$date = \absint( \strtotime( 'next monday 2pm' ) - ( \get_option( 'gmt_offset' ) * \HOUR_IN_SECONDS ) );

		return $date ? $date : \time();
	}

	/**
	 * Add custom Email Summaries cron schedule.
	 *
	 * @since 1.5.4
	 *
	 * @param array $schedules WP cron schedules.
	 *
	 * @return array
	 */
	public function add_weekly_cron_schedule( $schedules ) {

		$schedules['wpforms_email_summaries_weekly'] = array(
			'interval' => \WEEK_IN_SECONDS,
			'display'  => \esc_html__( 'Weekly WPForms Email Summaries', 'wpforms-lite' ),
		);

		return $schedules;
	}

	/**
	 * Email Summaries cron callback.
	 *
	 * @since 1.5.4
	 */
	public function cron() {

		$entries = $this->get_entries();

		// Email won't be sent if there are no form entries.
		if ( empty( $entries ) ) {
			return;
		}

		$info_blocks = new InfoBlocks();

		$next_block = $info_blocks->get_next();

		$args = array(
			'body' => array(
				'entries'    => $entries,
				'info_block' => $next_block,
			),
		);

		$template = ( new Templates\Summary() )->set_args( $args );
		$template = \apply_filters( 'wpforms_emails_summaries_template', $template );

		$content = $template->get();

		if ( ! $content ) {
			return;
		}

		$to_email = \apply_filters( 'wpforms_emails_summaries_cron_to_email', \get_option( 'admin_email' ) );
		$subject  = \apply_filters( 'wpforms_emails_summaries_cron_subject', \esc_html__( 'WPForms Summary', 'wpforms-lite' ) );

		$sent = ( new Mailer() )
			->template( $template )
			->subject( $subject )
			->to_email( $to_email )
			->send();

		if ( true === $sent ) {
			$info_blocks->register_sent( $next_block );
		}
	}

	/**
	 * Get form entries.
	 *
	 * @since 1.5.4
	 *
	 * @return array
	 */
	protected function get_entries() {

		if ( \wpforms()->pro ) {
			$entries_count = new \WPForms\Pro\Reports\EntriesCount();
			$results       = $entries_count->get_by( 'form', 0, 7, 'previous sunday' );
		} else {
			$entries_count = new \WPForms\Lite\Reports\EntriesCount();
			$results       = $entries_count->get_by_form();
		}

		return $results;
	}
}
