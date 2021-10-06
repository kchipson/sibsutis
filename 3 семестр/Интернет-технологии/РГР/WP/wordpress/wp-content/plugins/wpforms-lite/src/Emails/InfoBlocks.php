<?php
namespace WPForms\Emails;

/**
 * Fetching and formatting Info Blocks for Email Summaries class.
 *
 * @package    WPForms\Emails
 * @author     WPForms
 * @since      1.5.4
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2019, WPForms LLC
 */
class InfoBlocks {

	/**
	 * Source of info blocks content.
	 *
	 * @since 1.5.4
	 */
	const SOURCE_URL = 'https://cdn.wpforms.com/wp-content/email-summaries.json';

	/**
	 * Fetch info blocks info from remote.
	 *
	 * @since 1.5.4
	 *
	 * @return array
	 */
	public function fetch_all() {

		$info = array();

		// TODO: Change this URL once the infrastructure is ready.
		$res = \wp_remote_get( self::SOURCE_URL );

		if ( \is_wp_error( $res ) ) {
			return $info;
		}

		$body = \wp_remote_retrieve_body( $res );

		if ( empty( $body ) ) {
			return $info;
		}

		$body = \json_decode( $body, true );

		return $this->verify_fetched( $body );
	}

	/**
	 * Verify fetched blocks data.
	 *
	 * @since 1.5.4
	 *
	 * @param array $fetched Fetched blocks data.
	 *
	 * @return array
	 */
	protected function verify_fetched( $fetched ) {

		$info = array();

		if ( ! \is_array( $fetched ) ) {
			return $info;
		}

		foreach ( $fetched as $item ) {

			if ( empty( $item['id'] ) ) {
				continue;
			}

			$id = \absint( $item['id'] );

			if ( empty( $id ) ) {
				continue;
			}

			$info[ $id ] = $item;
		}

		return $info;
	}

	/**
	 * Get info blocks relevant to customer's licence.
	 *
	 * @since 1.5.4
	 *
	 * @return array
	 */
	protected function get_by_license() {

		$data     = $this->fetch_all();
		$filtered = array();

		if ( empty( $data ) || ! \is_array( $data ) ) {
			return $filtered;
		}

		$license_type = \wpforms_setting( 'type', false, 'wpforms_license' );

		foreach ( $data as $key => $item ) {

			if ( ! isset( $item['type'] ) || ! \is_array( $item['type'] ) ) {
				continue;
			}

			if ( ! \in_array( $license_type, $item['type'], true ) ) {
				continue;
			}

			$filtered[ $key ] = $item;
		}

		return $filtered;
	}

	/**
	 * Get the first block with a valid id.
	 * Needed to ignore blocks with invalid/missing ids.
	 *
	 * @since 1.5.4
	 *
	 * @param array $data Blocks array.
	 *
	 * @return array
	 */
	protected function get_first_with_id( $data ) {

		if ( empty( $data ) || ! \is_array( $data ) ) {
			return array();
		}

		foreach ( $data as $item ) {
			$item_id = \absint( $item['id'] );
			if ( ! empty( $item_id ) ) {
				return $item;
			}
		}

		return array();
	}

	/**
	 * Get next info block that wasn't sent yet.
	 *
	 * @since 1.5.4
	 *
	 * @return array
	 */
	public function get_next() {

		$data  = $this->get_by_license();
		$block = array();

		if ( empty( $data ) || ! \is_array( $data ) ) {
			return $block;
		}

		$blocks_sent = \get_option( 'wpforms_emails_infoblocks_sent' );

		if ( empty( $blocks_sent ) || ! \is_array( $blocks_sent ) ) {
			$block = $this->get_first_with_id( $data );
		}

		if ( empty( $block ) ) {
			$data  = \array_diff_key( $data, \array_flip( $blocks_sent ) );
			$block = $this->get_first_with_id( $data );
		}

		return $block;
	}

	/**
	 * Register a block as sent.
	 *
	 * @since 1.5.4
	 *
	 * @param array $info_block Info block.
	 */
	public function register_sent( $info_block ) {

		$block_id = isset( $info_block['id'] ) ? \absint( $info_block['id'] ) : false;

		if ( empty( $block_id ) ) {
			return;
		}

		$option_name = 'wpforms_email_summaries_info_blocks_sent';
		$blocks      = \get_option( $option_name );

		if ( empty( $blocks ) || ! \is_array( $blocks ) ) {
			\update_option( $option_name, array( $block_id ) );
			return;
		}

		if ( \in_array( $block_id, $blocks, true ) ) {
			return;
		}

		$blocks[] = $block_id;

		\update_option( $option_name, $blocks );
	}
}
