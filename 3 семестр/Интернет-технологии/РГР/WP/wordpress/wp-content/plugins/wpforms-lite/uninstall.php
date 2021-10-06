<?php
/**
 * Uninstalls WPForms.
 *
 * Removes:
 * - Entries table
 * - Entry Meta table
 * - Entry fields table
 * - Form Preview page
 * - wpforms_log post type posts and post_meta
 * - wpforms post type posts and post_meta
 * - WPForms settings/options
 * - WPForms user meta
 * - WPForms term meta
 * - WPForms Uploads
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.4.5
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2018, WPForms LLC
 *
 * @var WP_Filesystem_Base $wp_filesystem
 */

// phpcs:disable WordPress.DB.DirectDatabaseQuery

// Exit if accessed directly.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Confirm user has decided to remove all data, otherwise stop.
$settings = get_option( 'wpforms_settings', array() );
if ( empty( $settings['uninstall-data'] ) ) {
	return;
}

global $wpdb;

// Delete entries table.
$wpdb->query( 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'wpforms_entries' );

// Delete entry meta table.
$wpdb->query( 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'wpforms_entry_meta' );

// Delete entry fields table.
$wpdb->query( 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'wpforms_entry_fields' );

// Delete Preview page.
$preview_page = get_option( 'wpforms_preview_page', false );
if ( ! empty( $preview_page ) ) {
	wp_delete_post( $preview_page, true );
}

// Delete wpforms and wpforms_log post type posts/post_meta.
$wpforms_posts = get_posts(
	array(
		'post_type'   => array( 'wpforms_log', 'wpforms' ),
		'post_status' => 'any',
		'numberposts' => -1,
		'fields'      => 'ids',
	)
);
if ( $wpforms_posts ) {
	foreach ( $wpforms_posts as $wpforms_post ) {
		wp_delete_post( $wpforms_post, true );
	}
}

// Delete plugin settings.
$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE 'wpforms\_%'" );

// Delete plugin user meta.
$wpdb->query( "DELETE FROM {$wpdb->usermeta} WHERE meta_key LIKE 'wpforms\_%'" );

// Delete plugin term meta.
$wpdb->query( "DELETE FROM {$wpdb->termmeta} WHERE meta_key LIKE 'wpforms\_%'" );

// Remove any transients we've left behind.
$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '\_transient\_wpforms\_%'" );
$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '\_site\_transient\_wpforms\_%'" );
$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '\_transient\_timeout\_wpforms\_%'" );
$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '\_site\_transient\_timeout\_wpforms\_%'" );

// Remove plugin cron jobs.
wp_clear_scheduled_hook( 'wpforms_email_summaries_cron' );

// Remove uploaded files.
$uploads_directory = wp_upload_dir();
if ( ! empty( $uploads_directory['error'] ) ) {
	return;
}
global $wp_filesystem;
$wp_filesystem->rmdir( $uploads_directory['basedir'] . '/wpforms/', true );
