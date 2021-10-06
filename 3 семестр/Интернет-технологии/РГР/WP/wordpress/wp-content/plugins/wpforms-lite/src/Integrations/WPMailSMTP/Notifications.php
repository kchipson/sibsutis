<?php

namespace WPForms\Integrations\WPMailSMTP;

use WPForms\Integrations\IntegrationInterface;

/**
 * WP Mail SMTP hints inside form builder notifications.
 *
 * @package    WPForms\Integrations\Gutenberg
 * @author     WPForms
 * @since      1.4.8
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2018, WPForms LLC
 */
class Notifications implements IntegrationInterface {

	/**
	 * WP Mail SMTP options.
	 *
	 * @since 1.4.8
	 *
	 * @var \WPMailSMTP\Options
	 */
	public $options;

	/**
	 * Indicates if current integration is allowed to load.
	 *
	 * @since 1.4.8
	 *
	 * @return bool
	 */
	public function allow_load() {
		return \wpforms_is_admin_page( 'builder' ) && \function_exists( 'wp_mail_smtp' );
	}

	/**
	 * Loads an integration.
	 *
	 * @since 1.4.8
	 */
	public function load() {

		$this->options = new \WPMailSMTP\Options();
		$this->filters();
	}

	/**
	 * Integration filters.
	 *
	 * @since 1.4.8
	 */
	protected function filters() {

		\add_filter( 'wpforms_builder_notifications_from_name_after', array( $this, 'from_name_after' ) );
		\add_filter( 'wpforms_builder_notifications_from_email_after', array( $this, 'from_email_after' ) );
	}

	/**
	 * Display hint if WP Mail SMTP is forcing from name.
	 *
	 * @since 1.4.8
	 *
	 * @param string $after Text displayed after setting.
	 *
	 * @return string
	 */
	public function from_name_after( $after ) {

		if ( ! $this->options->get( 'mail', 'from_name_force' ) ) {
			return $after;
		}

		return sprintf(
			\wp_kses(
				/* translators: %s - URL WP Mail SMTP settings. */
				\__( 'This setting is disabled because you have the "Force From Name" setting enabled in <a href="%s" rel="noopener noreferrer" target="_blank">WP Mail SMTP</a>.', 'wpforms-lite' ),
				array(
					'a' => array(
						'href'   => array(),
						'rel'    => array(),
						'target' => array(),
					),
				)
			),
			\esc_url( \admin_url( 'options-general.php?page=wp-mail-smtp#wp-mail-smtp-setting-row-from_name' ) )
		);
	}

	/**
	 * Display hint if WP Mail SMTP is forcing from email.
	 *
	 * @since 1.4.8
	 *
	 * @param string $after Text displayed after setting.
	 *
	 * @return string
	 */
	public function from_email_after( $after ) {

		if ( ! $this->options->get( 'mail', 'from_email_force' ) ) {
			return $after;
		}

		return sprintf(
			\wp_kses(
				/* translators: %s - URL WP Mail SMTP settings. */
				\__( 'This setting is disabled because you have the "Force From Email" setting enabled in <a href="%s" rel="noopener noreferrer" target="_blank">WP Mail SMTP</a>.', 'wpforms-lite' ),
				array(
					'a' => array(
						'href'   => array(),
						'rel'    => array(),
						'target' => array(),
					),
				)
			),
			\esc_url( \admin_url( 'options-general.php?page=wp-mail-smtp#wp-mail-smtp-setting-row-from_email' ) )
		);
	}
}
