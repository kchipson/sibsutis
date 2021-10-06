<?php
/**
 * Email Summary body template (plain text).
 *
 * This template can be overridden by copying it to yourtheme/wpforms/emails/summary-body-plain.php.
 *
 * @package    WPForms\Emails\Templates
 * @author     WPForms
 * @since      1.5.4
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2019, WPForms LLC
 *
 * @version 1.5.4
 *
 * @var array  $entries
 * @var array  $info_block
 */

if ( ! \defined( 'ABSPATH' ) ) {
	exit;
}

echo \esc_html__( 'Hi there!', 'wpforms-lite' ) . "\n\n";

if ( \wpforms()->pro ) {
	echo \esc_html__( 'Let’s see how your forms performed in the past week.', 'wpforms' ) . "\n\n";
} else {
	echo \esc_html__( 'Let’s see how your forms performed.', 'wpforms-lite' ) . "\n\n";
	echo \esc_html__( 'Below is the total number of submissions for each form, however actual entries are not stored in WPForms Lite. To generate detailed reports and view future entries inside your WordPress dashboard, consider upgrading to Pro.', 'wpforms-lite' ) . "\n\n\n";
}

echo "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

echo \esc_html__( 'Form', 'wpforms-lite' ) . '   |   ' . esc_html__( 'Entries', 'wpforms-lite' ) . "\n\n";

echo "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

foreach ( $entries as $row ) {
	echo ( isset( $row['title'] ) ? \esc_html( $row['title'] ) : '' ) . '   |   ' . ( isset( $row['count'] ) ? \absint( $row['count'] ) : '' ) . "\n\n";
}

if ( empty( $entries ) ) {
	echo \esc_html__( 'It appears you do not have any form entries yet.', 'wpforms-lite' ) . "\n\n";
}

echo "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n\n";

if ( ! empty( $info_block['title'] ) ) {
	echo \esc_html( $info_block['title'] ) . "\n\n";
}

if ( ! empty( $info_block['content'] ) ) {
	echo \wp_kses_post( $info_block['content'] ) . "\n\n";
}

if ( ! empty( $info_block['button'] ) && ! empty( $info_block['url'] ) ) {
	echo \esc_html( $info_block['button'] ) . ': ' . \esc_url( $info_block['url'] ) . "\n\n";
}
