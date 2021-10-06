<?php
/**
 *
 * Drop-in file for neve recommendation.
 */

/**
 * Class Droping for Neve recommandation.
 */
class Orbit_Fox_Neve_Dropin {

	/**
	 * How long the notice will show since the user sees it.
	 *
	 * @var string Dismiss option key.
	 */
	const EXPIRATION = WEEK_IN_SECONDS;
	/**
	 * Singleton object.
	 *
	 * @var null Instance object.
	 */
	protected static $instance = null;
	/**
	 * Dismiss option key.
	 *
	 * @var string Dismiss option key.
	 */
	protected static $dismiss_key = 'neve_upsell_off';

	/**
	 * Init the OrbitFox instance.
	 *
	 * @return Orbit_Fox_Neve_Dropin|null
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->init();
		}

		return self::$instance;
	}

	/**
	 * Drop-in actions
	 */
	public function init() {
		add_action( 'admin_notices', array( $this, 'admin_notice' ), defined( 'PHP_INT_MIN' ) ? PHP_INT_MIN : 99999 );
		add_action( 'admin_init', array( $this, 'remove_notice' ), defined( 'PHP_INT_MIN' ) ? PHP_INT_MIN : 99999 );
	}

	/**
	 * Remove notice;
	 */
	public function remove_notice() {
		if ( ! isset( $_GET[ self::$dismiss_key ] ) ) {
			return;
		}
		if ( $_GET[ self::$dismiss_key ] !== 'yes' ) {
			return;
		}
		if ( ! isset( $_GET['remove_upsell'] ) ) {
			return;
		}
		if ( ! wp_verify_nonce( $_GET['remove_upsell'], 'remove_upsell_confirmation' ) ) {
			return;
		}
		update_option( self::$dismiss_key, 'yes' );
	}

	/**
	 * Add notice.
	 */
	public function admin_notice() {

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		if ( is_network_admin() ) {
			return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		if ( get_option( self::$dismiss_key, 'no' ) === 'yes' ) {
			return;
		}
		$theme = wp_get_theme();

		if ( $theme->get( 'Name' ) === 'Neve' ) {
			return;
		}
		// Dont show the notice if the plugin is recently installed.
		$plugin_installed = get_option( 'themeisle_companion_install', '' );
		if ( empty( $plugin_installed ) || ( time() - intval( $plugin_installed ) < DAY_IN_SECONDS ) ) {
			return;
		}

		if ( ( $expiration = get_option( self::$dismiss_key . '_exp', '' ) ) === '' ) {
			update_option( self::$dismiss_key . '_exp', time() );
		}

		// Let's dismiss the notice if the user sees it for more than 1 week.
		if ( ! empty( $expiration ) && ( time() - intval( $expiration ) ) > self::EXPIRATION ) {
			update_option( self::$dismiss_key, 'yes' );

			return;
		}

		?>
		<style type="text/css">
			.neve-notice-upsell a {
				text-decoration: none;
			}

			.neve-notice-upsell {
				position: relative;
			}
			.theme-install-php #wpbody-content .wrap > .notice:not(.neve-notice-upsell),
			.themes-php #wpbody-content .wrap > .notice:not(.neve-notice-upsell) {
				display: none;
			}


		</style>
		<div class="notice notice-success  neve-notice-upsell">
			<p>
				<strong> Check the newest theme recommended by Orbit Fox</strong></p>
			<p class="neve-upsell-text">
				Fully AMP optimized and responsive, <strong>Neve</strong> will load in mere seconds and adapt
				perfectly on any viewing device. Neve works perfectly with Gutenberg and the most popular page builders.
				You will love it!

			</p>
			<p>
				<a href="<?php echo esc_url( admin_url( 'theme-install.php?theme=neve' ) ); ?>" target="_blank"
				   class="button neve-upsell-try button-primary"><span class="dashicons dashicons-external"></span>Get
					started</a></p>
			<a href="<?php echo wp_nonce_url( add_query_arg( array( self::$dismiss_key => 'yes' ) ), 'remove_upsell_confirmation', 'remove_upsell' ); ?>"
			   class=" notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></a>
		</div>
		<?php
	}

	/**
	 * Deny clone.
	 */
	public function __clone() {
	}

	/**
	 * Deny un-serialize.
	 */
	public function __wakeup() {

	}

}
