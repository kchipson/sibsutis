<?php
/**
 * Class for logging events and errors
 *
 * This class is forked from Easy Digital Downloads / Pippin Williamson.
 *
 * @link       https://github.com/easydigitaldownloads/Easy-Digital-Downloads/blob/master/includes/class-edd-logging.php
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
*/
class WPForms_Logging {

	/**
	 * Set up the logging class.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Create the log post type
		add_action( 'init', array( $this, 'register_post_type' ), 1 );

		// Create types taxonomy and default types
		add_action( 'init', array( $this, 'register_taxonomy' ), 1 );
	}

	/**
	 * Registers the log post type.
	 *
	 * @since 1.0.0
	 */
	public function register_post_type() {

		$log_args = array(
			'labels'              => array( 'name' => esc_html__( 'WPForms Logs', 'wpforms-lite' ), 'menu_name' => esc_html__( 'Logs', 'wpforms-lite' ) ),
			'public'              => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'show_ui'             => false,
			'query_var'           => false,
			'rewrite'             => false,
			'capability_type'     => wpforms_get_capability_manage_options(),
			'supports'            => array( 'title', 'editor' ),
			'can_export'          => false,
			'show_in_menu'        => 'wpforms-overview',
			'show_in_admin_bar'   => false,
		);

		if ( wpforms_debug() ) {
			$log_args['show_ui'] = true;
		}

		register_post_type( 'wpforms_log', apply_filters( 'wpforms_log_cpt', $log_args ) );
	}

	/**
	 * Registers the Log Type taxonomy.
	 *
	 * @since 1.0.0
	*/
	public function register_taxonomy() {

		register_taxonomy( 'wpforms_log_type', 'wpforms_log', array( 'public' => false ) );
	}

	/**
	 * Log types.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public function log_types() {

		$terms = array(
			'payment',
			'provider',
			'spam',
			'entry',
			'error',
			'conditional_logic'
		);

		return apply_filters( 'wpforms_log_types', $terms );
	}

	/**
	 * Check if a log type is valid.
	 *
	 * @since 1.0.0
	 * @param string $type
	 * @return bool
	 */
	function valid_type( $type ) {

		return in_array( $type, $this->log_types() );
	}

	/**
	 * Create new log entry.
	 *
	 * This is just a simple and fast way to log something. Use $this->insert_log()
	 * if you need to store custom meta data
	 *
	 * @since 1.0.0
	 * @param string $title Log entry title
	 * @param string $message Log entry message
	 * @param int $parent Log entry parent
	 * @param string $type Log type (default: null)
	 * @return int Log ID
	 */
	public function add( $title = '', $message = '', $parent = 0, $type = null, $meta = '' ) {

		$log_data = array(
			'post_title' 	=> $title,
			'post_content'	=> $message,
			'post_parent'	=> $parent,
			'log_type'		=> $type
		);
		return $this->insert_log( $log_data, $meta );
	}

	/**
	 * Easily retrieves log items for a particular object ID.
	 *
	 * @since 1.0.0
	 * @param int $object_id (default: 0)
	 * @param string $type Log type (default: null)
	 * @param int $paged Page number (default: null)
	 * @return array Array of the connected logs
	*/
	public function get_logs( $object_id = 0, $type = null, $paged = null ) {

		return $this->get_connected_logs( array( 'post_parent' => $object_id, 'paged' => $paged, 'log_type' => $type ) );
	}

	/**
	 * Stores a log entry.
	 *
	 * @since 1.0.0
	 * @param array $log_data Log entry data
	 * @param array $log_meta Log entry meta
	 * @return int The ID of the newly created log item
	 */
	function insert_log( $log_data = array(), $log_meta = array() ) {

		$defaults = array(
			'post_type' 	=> 'wpforms_log',
			'post_status'	=> 'publish',
			'post_parent'	=> 0,
			'post_content'	=> '',
			'log_type'		=> false
		);
		$args = wp_parse_args( $log_data, $defaults );

		do_action( 'wpforms_pre_insert_log', $log_data, $log_meta );

		// Store the log entry
		$log_id = wp_insert_post( $args );

		// Set the log type, if any
		if ( $log_data['log_type'] && $this->valid_type( $log_data['log_type'] ) ) {
			wp_set_object_terms( $log_id, $log_data['log_type'], 'wpforms_log_type', false );
		}

		// Set log meta, if any
		if ( $log_id && ! empty( $log_meta ) ) {
			foreach ( (array) $log_meta as $key => $meta ) {
				update_post_meta( $log_id, '_wpforms_log_' . sanitize_key( $key ), $meta );
			}
		}

		do_action( 'wpforms_post_insert_log', $log_id, $log_data, $log_meta );

		return $log_id;
	}

	/**
	 * Update and existing log item.
	 *
	 * @since 1.0.0
	 * @param array $log_data Log entry data
	 * @param array $log_meta Log entry meta
	 * @return bool True if successful, false otherwise
	 */
	public function update_log( $log_data = array(), $log_meta = array() ) {

		do_action( 'wpforms_pre_update_log', $log_data, $log_meta );

		$defaults = array(
			'post_type' 	=> 'wpforms_log',
			'post_status'	=> 'publish',
			'post_parent'	=> 0
		);

		$args = wp_parse_args( $log_data, $defaults );

		// Store the log entry
		$log_id = wp_update_post( $args );

		if ( $log_id && ! empty( $log_meta ) ) {
			foreach ( (array) $log_meta as $key => $meta ) {
				if ( ! empty( $meta ) )
					update_post_meta( $log_id, '_wpforms_log_' . sanitize_key( $key ), $meta );
			}
		}

		do_action( 'wpforms_post_update_log', $log_id, $log_data, $log_meta );
	}

	/**
	 * Retrieve all connected logs.
	 *
	 * Used for retrieving logs related to particular items, such as a specific purchase.
	 *
	 * @since 1.0.0
	 * @param array $args Query arguments
	 * @return mixed array if logs were found, false otherwise
	 */
	public function get_connected_logs( $args = array() ) {
		$defaults = array(
			'post_type'      => 'wpforms_log',
			'posts_per_page' => 20,
			'post_status'    => 'publish',
			'paged'          => get_query_var( 'paged' ),
			'log_type'       => false
		);

		$query_args = wp_parse_args( $args, $defaults );

		if ( $query_args['log_type'] && $this->valid_type( $query_args['log_type'] ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' 	=> 'wpforms_log_type',
					'field'		=> 'slug',
					'terms'		=> $query_args['log_type']
				)
			);
		}

		$logs = get_posts( $query_args );

		if ( $logs )
			return $logs;

		// No logs found
		return false;
	}

	/**
	 * Retrieves number of log entries connected to particular object ID
	 *
	 * @since 1.0.0
	 * @param int $object_id (default: 0)
	 * @param string $type Log type (default: null)
	 * @param array $meta_query Log meta query (default: null)
	 * @param array $date_query Log data query (default: null) (since 1.9)
	 * @return int Log count
	 */
	public function get_log_count( $object_id = 0, $type = null, $meta_query = null, $date_query = null ) {

		global $pagenow, $typenow;

		$query_args = array(
			'post_parent' 	   => $object_id,
			'post_type'		   => 'wpforms_log',
			'posts_per_page'   => -1,
			'post_status'	   => 'publish',
			'fields'           => 'ids',
		);

		if ( ! empty( $type ) && $this->valid_type( $type ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' 	=> 'wpforms_log_type',
					'field'		=> 'slug',
					'terms'		=> $type
				)
			);
		}

		if ( ! empty( $meta_query ) ) {
			$query_args['meta_query'] = $meta_query;
		}

		if ( ! empty( $date_query ) ) {
			$query_args['date_query'] = $date_query;
		}

		$logs = new WP_Query( $query_args );

		return (int) $logs->post_count;
	}

	/**
	 * Delete a log.
	 *
	 * @since 1.0.0
	 * @param int $object_id (default: 0)
	 * @param string $type Log type (default: null)
	 * @param array $meta_query Log meta query (default: null)
	 */
	public function delete_logs( $object_id = 0, $type = null, $meta_query = null  ) {

		$query_args = array(
			'post_parent'    => $object_id,
			'post_type'      => 'wpforms_log',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'fields'         => 'ids'
		);

		if ( ! empty( $type ) && $this->valid_type( $type ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy'  => 'wpforms_log_type',
					'field'     => 'slug',
					'terms'     => $type,
				)
			);
		}

		if ( ! empty( $meta_query ) ) {
			$query_args['meta_query'] = $meta_query;
		}

		$logs = get_posts( $query_args );

		if ( $logs ) {
			foreach ( $logs as $log ) {
				wp_delete_post( $log, true );
			}
		}
	}
}
