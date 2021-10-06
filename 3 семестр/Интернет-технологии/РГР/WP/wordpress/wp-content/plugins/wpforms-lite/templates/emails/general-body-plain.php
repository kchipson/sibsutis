<?php
/**
 * General body template (plain text).
 *
 * This template can be overridden by copying it to yourtheme/wpforms/emails/general-body-plain.php.
 *
 * @package    WPForms\Emails\Templates
 * @author     WPForms
 * @since      1.5.4
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2019, WPForms LLC
 *
 * @version 1.5.4
 *
 * @var string $message
 */

if ( ! \defined( 'ABSPATH' ) ) {
	exit;
}

echo \wp_kses_post( $message );
