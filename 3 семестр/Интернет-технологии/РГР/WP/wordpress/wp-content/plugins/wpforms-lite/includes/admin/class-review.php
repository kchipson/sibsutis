<?php

/**
 * Ask for some love.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.3.2
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2017, WPForms LLC
 */
class WPForms_Review {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.3.2
	 */
	public function __construct() {

		// Admin notice requesting review.
		add_action( 'admin_notices', array( $this, 'review_request' ) );
		add_action( 'wp_ajax_wpforms_review_dismiss', array( $this, 'review_dismiss' ) );

		// Admin footer text.
		add_filter( 'admin_footer_text', array( $this, 'admin_footer' ), 1, 2 );
	}

	/**
	 * Add admin notices as needed for reviews.
	 *
	 * @since 1.3.2
	 */
	public function review_request() {

		// Only consider showing the review request to admin users.
		if ( ! is_super_admin() ) {
			return;
		}

		// If the user has opted out of product announcement notifications, don't
		// display the review request.
		if ( wpforms_setting( 'hide-announcements', false ) ) {
			return;
		}

		// Verify that we can do a check for reviews.
		$review = get_option( 'wpforms_review' );
		$time   = time();
		$load   = false;

		if ( ! $review ) {
			$review = array(
				'time'      => $time,
				'dismissed' => false,
			);
			update_option( 'wpforms_review', $review );
		} else {
			// Check if it has been dismissed or not.
			if ( ( isset( $review['dismissed'] ) && ! $review['dismissed'] ) && ( isset( $review['time'] ) && ( ( $review['time'] + DAY_IN_SECONDS ) <= $time ) ) ) {
				$load = true;
			}
		}

		// If we cannot load, return early.
		if ( ! $load ) {
			return;
		}

		// Logic is slightly different depending on what's at our disposal.
		if ( wpforms()->pro && class_exists( 'WPForms_Entry_Handler', false ) ) {
			$this->review();
		} else {
			$this->review_lite();
		}
	}

	/**
	 * Maybe show review request.
	 *
	 * @since 1.3.9
	 */
	public function review() {

		// Fetch total entries.
		$entries = wpforms()->entry->get_entries( array( 'number' => 50 ), true );

		// Only show review request if the site has collected at least 50 entries.
		if ( empty( $entries ) || $entries < 50 ) {
			return;
		}

		// We have a candidate! Output a review message.
		?>
		<div class="notice notice-info is-dismissible wpforms-review-notice">
			<p><?php esc_html_e( 'Hey, I noticed you collected over 50 entries from WPForms - that’s awesome! Could you please do me a BIG favor and give it a 5-star rating on WordPress to help us spread the word and boost our motivation?', 'wpforms-lite' ); ?></p>
			<p><strong><?php echo wp_kses( __( '~ Syed Balkhi<br>Co-Founder of WPForms', 'wpforms-lite' ), array( 'br' => array() ) ); ?></strong></p>
			<p>
				<a href="https://wordpress.org/support/plugin/wpforms-lite/reviews/?filter=5#new-post" class="wpforms-dismiss-review-notice wpforms-review-out" target="_blank" rel="noopener"><?php esc_html_e( 'Ok, you deserve it', 'wpforms-lite' ); ?></a><br>
				<a href="#" class="wpforms-dismiss-review-notice" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Nope, maybe later', 'wpforms-lite' ); ?></a><br>
				<a href="#" class="wpforms-dismiss-review-notice" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'I already did', 'wpforms-lite' ); ?></a>
			</p>
		</div>
		<script type="text/javascript">
			jQuery( document ).ready( function ( $ ) {
				$( document ).on( 'click', '.wpforms-dismiss-review-notice, .wpforms-review-notice button', function ( event ) {
					if ( ! $( this ).hasClass( 'wpforms-review-out' ) ) {
						event.preventDefault();
					}
					$.post( ajaxurl, {
						action: 'wpforms_review_dismiss'
					} );
					$( '.wpforms-review-notice' ).remove();
				} );
			} );
		</script>
		<?php
	}

	/**
	 * Maybe show Lite review request.
	 *
	 * @since 1.3.9
	 */
	public function review_lite() {

		// Fetch when plugin was initially installed.
		$activated = get_option( 'wpforms_activated', array() );

		if ( ! empty( $activated['lite'] ) ) {
			// Only continue if plugin has been installed for at least 7 days.
			if ( ( $activated['lite'] + ( DAY_IN_SECONDS * 14 ) ) > time() ) {
				return;
			}
		} else {
			$activated['lite'] = time();
			update_option( 'wpforms_activated', $activated );

			return;
		}

		// Only proceed with displaying if the user created at least one form.
		$form_count = wp_count_posts( 'wpforms' );
		if ( empty( $form_count->publish ) ) {
			return;
		}

		// Check if the Constant Contact notice is displaying.
		$cc = get_option( 'wpforms_constant_contact', false );

		// If it's displaying don't ask for review until they configure CC or
		// dismiss the notice.
		if ( $cc ) {
			return;
		}

		// We have a candidate! Output a review message.
		?>
		<div class="notice notice-info is-dismissible wpforms-review-notice">
			<p><?php esc_html_e( 'Hey, I noticed you created a contact form with WPForms - that’s awesome! Could you please do me a BIG favor and give it a 5-star rating on WordPress to help us spread the word and boost our motivation?', 'wpforms-lite' ); ?></p>
			<p><strong><?php echo wp_kses( __( '~ Syed Balkhi<br>Co-Founder of WPForms', 'wpforms-lite' ), array( 'br' => array() ) ); ?></strong></p>
			<p>
				<a href="https://wordpress.org/support/plugin/wpforms-lite/reviews/?filter=5#new-post" class="wpforms-dismiss-review-notice wpforms-review-out" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Ok, you deserve it', 'wpforms-lite' ); ?></a><br>
				<a href="#" class="wpforms-dismiss-review-notice" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Nope, maybe later', 'wpforms-lite' ); ?></a><br>
				<a href="#" class="wpforms-dismiss-review-notice" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'I already did', 'wpforms-lite' ); ?></a>
			</p>
		</div>
		<script type="text/javascript">
			jQuery( document ).ready( function ( $ ) {
				$( document ).on( 'click', '.wpforms-dismiss-review-notice, .wpforms-review-notice button', function ( event ) {
					if ( ! $( this ).hasClass( 'wpforms-review-out' ) ) {
						event.preventDefault();
					}
					$.post( ajaxurl, {
						action: 'wpforms_review_dismiss'
					} );
					$( '.wpforms-review-notice' ).remove();
				} );
			} );
		</script>
		<?php
	}

	/**
	 * Dismiss the review admin notice
	 *
	 * @since 1.3.2
	 */
	public function review_dismiss() {

		$review              = get_option( 'wpforms_review', array() );
		$review['time']      = time();
		$review['dismissed'] = true;

		update_option( 'wpforms_review', $review );
		die;
	}

	/**
	 * When user is on a WPForms related admin page, display footer text
	 * that graciously asks them to rate us.
	 *
	 * @since 1.3.2
	 *
	 * @param string $text
	 *
	 * @return string
	 */
	public function admin_footer( $text ) {

		global $current_screen;

		if ( ! empty( $current_screen->id ) && strpos( $current_screen->id, 'wpforms' ) !== false ) {
			$url  = 'https://wordpress.org/support/plugin/wpforms-lite/reviews/?filter=5#new-post';
			$text = sprintf(
				wp_kses(
					/* translators: $1$s - WPForms plugin name; $2$s - WP.org review link; $3$s - WP.org review link. */
					__( 'Please rate %1$s <a href="%2$s" target="_blank" rel="noopener noreferrer">&#9733;&#9733;&#9733;&#9733;&#9733;</a> on <a href="%3$s" target="_blank" rel="noopener">WordPress.org</a> to help us spread the word. Thank you from the WPForms team!', 'wpforms-lite' ),
					array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
							'rel'    => array(),
						),
					)
				),
				'<strong>WPForms</strong>',
				$url,
				$url
			);
		}

		return $text;
	}

}

new WPForms_Review;
