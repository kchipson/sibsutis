<?php

/**
 * Admin notices, on the fly.
 *
 * @example
 * WPForms_Admin_Notice::success( 'All is good!' );
 *
 * @example
 * WPForms_Admin_Notice::warning( 'Do something please.' );
 *
 * @todo       Persistent, dismissible notices.
 * @link       https://gist.github.com/monkeymonk/2ea17e2260daaecd0049c46c8d6c85fd
 * @package    WPForms
 * @author     WPForms
 * @since      1.3.9
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2017, WPForms LLC
 */
class WPForms_Admin_Notice {

	/**
	 * Single instance holder.
	 *
	 * @since 1.3.9
	 * @var mixed
	 */
	private static $_instance = null;

	/**
	 * Added notices.
	 *
	 * @since 1.3.9
	 * @var array
	 */
	public $notices = array();

	/**
	 * Get the instance.
	 *
	 * @since 1.3.9
	 * @return WPForms_Admin_Notice
	 */
	public static function getInstance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new WPForms_Admin_Notice();
		}

		return self::$_instance;
	}

	/**
	 * Hook when called.
	 *
	 * @since 1.3.9
	 */
	public function __construct() {
		add_action( 'admin_notices', array( &$this, 'display' ) );
	}

	/**
	 * Display the notices.
	 *
	 * @since 1.3.9
	 */
	public function display() {

		if ( ! wpforms_current_user_can() ) {
			return;
		}

		echo implode( ' ', $this->notices );
	}

	/**
	 * Add notice to instance property.
	 *
	 * @since 1.3.9
	 *
	 * @param string $message Message to display.
	 * @param string $type Type of the notice (default: '').
	 */
	public static function add( $message, $type = '' ) {

		$instance = self::getInstance();
		$id       = 'wpforms-notice-' . ( count( $instance->notices ) + 1 );
		$type     = ! empty( $type ) ? 'notice-' . $type : '';
		$notice   = sprintf( '<div class="notice wpforms-notice %s" id="%s">%s</div>', $type, $id, wpautop( $message ) );

		$instance->notices[] = $notice;
	}

	/**
	 * Add Info notice.
	 *
	 * @since 1.3.9
	 *
	 * @param string $message Message to display.
	 */
	public static function info( $message ) {
		self::add( $message, 'info' );
	}

	/**
	 * Add Error notice.
	 *
	 * @since 1.3.9
	 *
	 * @param string $message Message to display.
	 */
	public static function error( $message ) {
		self::add( $message, 'error' );
	}

	/**
	 * Add Success notice.
	 *
	 * @since 1.3.9
	 *
	 * @param string $message Message to display.
	 */
	public static function success( $message ) {
		self::add( $message, 'success' );
	}

	/**
	 * Add Warning notice.
	 *
	 * @since 1.3.9
	 *
	 * @param string $message Message to display.
	 */
	public static function warning( $message ) {
		self::add( $message, 'warning' );
	}
}
