<?php

namespace WPForms\Admin\Pages;

/**
 * SMTP Sub-page.
 *
 * @since 1.5.7
 */
class SMTP {

	/**
	 * Admin menu page slug.
	 *
	 * @since 1.5.7
	 *
	 * @var string
	 */
	const SLUG = 'wpforms-smtp';

	/**
	 * Configuration.
	 *
	 * @since 1.5.7
	 *
	 * @var array
	 */
	private $config = array(
		'lite_plugin'       => 'wp-mail-smtp/wp_mail_smtp.php',
		'lite_download_url' => 'https://downloads.wordpress.org/plugin/wp-mail-smtp.zip',
		'pro_plugin'        => 'wp-mail-smtp-pro/wp_mail_smtp.php',
		'smtp_settings'     => 'admin.php?page=wp-mail-smtp',
	);

	/**
	 * Runtime data used for generating page HTML.
	 *
	 * @since 1.5.7
	 *
	 * @var array
	 */
	private $output_data = array();

	/**
	 * Constructor.
	 *
	 * @since 1.5.7
	 */
	public function __construct() {

		if ( ! \wpforms_current_user_can() ) {
			return;
		}

		$this->hooks();
	}

	/**
	 * Hooks.
	 *
	 * @since 1.5.7
	 */
	public function hooks() {

		if ( wp_doing_ajax() ) {
			add_action( 'wp_ajax_wpforms_smtp_page_check_plugin_status', array( $this, 'ajax_check_plugin_status' ) );
		}

		// Check what page we are on.
		$page = isset( $_GET['page'] ) ? \sanitize_key( \wp_unslash( $_GET['page'] ) ) : ''; // phpcs:ignore WordPress.CSRF.NonceVerification

		// Only load if we are actually on the SMTP page.
		if ( self::SLUG !== $page ) {
			return;
		}

		add_action( 'admin_init', array( $this, 'redirect_to_smtp_settings' ) );
		add_filter( 'wpforms_admin_header', '__return_false' );
		add_action( 'wpforms_admin_page', array( $this, 'output' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );

		// Hook for addons.
		do_action( 'wpforms_admin_pages_smtp_hooks' );
	}

	/**
	 * Enqueue JS and CSS files.
	 *
	 * @since 1.5.7
	 */
	public function enqueue_assets() {

		$min = \wpforms_get_min_suffix();

		// Lity.
		wp_enqueue_style(
			'wpforms-lity',
			WPFORMS_PLUGIN_URL . 'assets/css/lity.min.css',
			null,
			'3.0.0'
		);

		wp_enqueue_script(
			'wpforms-lity',
			WPFORMS_PLUGIN_URL . 'assets/js/lity.min.js',
			array( 'jquery' ),
			'3.0.0',
			true
		);

		wp_enqueue_script(
			'wpforms-admin-page-smtp',
			WPFORMS_PLUGIN_URL . "assets/js/components/admin/pages/smtp{$min}.js",
			array( 'jquery' ),
			WPFORMS_VERSION,
			true
		);

		\wp_localize_script(
			'wpforms-admin-page-smtp',
			'wpforms_pluginlanding',
			$this->get_js_strings()
		);
	}

	/**
	 * JS Strings.
	 *
	 * @since 1.5.7
	 *
	 * @return array Array of strings.
	 */
	protected function get_js_strings() {

		$error_could_not_install = sprintf(
			wp_kses( /* translators: %s - Lite plugin download URL. */
				__( 'Could not install plugin. Please <a href="%s">download</a> and install manually.', 'wpforms-lite' ),
				array(
					'a' => array(
						'href' => true,
					),
				)
			),
			esc_url( $this->config['lite_download_url'] )
		);

		$error_could_not_activate = sprintf(
			wp_kses( /* translators: %s - Lite plugin download URL. */
				__( 'Could not activate plugin. Please activate from the <a href="%s">Plugins page</a>.', 'wpforms-lite' ),
				array(
					'a' => array(
						'href' => true,
					),
				)
			),
			esc_url( admin_url( 'plugins.php' ) )
		);

		return array(
			'installing'               => esc_html__( 'Installing...', 'wpforms-lite' ),
			'activating'               => esc_html__( 'Activating...', 'wpforms-lite' ),
			'activated'                => esc_html__( 'WP Mail SMTP Installed & Activated', 'wpforms-lite' ),
			'install_now'              => esc_html__( 'Install Now', 'wpforms-lite' ),
			'activate_now'             => esc_html__( 'Activate Now', 'wpforms-lite' ),
			'download_now'             => esc_html__( 'Download Now', 'wpforms-lite' ),
			'plugins_page'             => esc_html__( 'Go to Plugins page', 'wpforms-lite' ),
			'error_could_not_install'  => $error_could_not_install,
			'error_could_not_activate' => $error_could_not_activate,
			'manual_install_url'       => $this->config['lite_download_url'],
			'manual_activate_url'      => admin_url( 'plugins.php' ),
			'smtp_settings_button'     => esc_html__( 'Go to SMTP Settings', 'wpforms-lite' ),
		);
	}

	/**
	 * Generate and output page HTML.
	 *
	 * @since 1.5.7
	 */
	public function output() {

		echo '<div id="wpforms-admin-smtp" class="wrap wpforms-admin-wrap wpforms-admin-plugin-landing">';

		$this->output_section_heading();
		$this->output_section_screenshot();
		$this->output_section_step_install();
		$this->output_section_step_setup();

		echo '</div>';
	}

	/**
	 * Generate and output heading section HTML.
	 *
	 * @since 1.5.7
	 */
	protected function output_section_heading() {

		// Heading section.
		printf(
			'<section class="top">
				<img class="img-top" src="%1$s" srcset="%2$s 2x" alt="%3$s"/>
				<h1>%4$s</h1>
				<p>%5$s</p>
			</section>',
			esc_url( WPFORMS_PLUGIN_URL . 'assets/images/smtp/wpforms-wpmailsmtp.png' ),
			esc_url( WPFORMS_PLUGIN_URL . 'assets/images/smtp/wpforms-wpmailsmtp@2x.png' ),
			esc_attr__( 'WPForms ♥ WP Mail SMTP', 'wpforms-lite' ),
			esc_html__( 'Making Email Deliverability Easy for WordPress', 'wpforms-lite' ),
			esc_html__( 'WP Mail SMTP allows you to easily set up WordPress to use a trusted provider to reliably send emails, including form notifications. Built by the same folks behind WPForms.', 'wpforms-lite' )
		);
	}

	/**
	 * Generate and output screenshot section HTML.
	 *
	 * @since 1.5.7
	 */
	protected function output_section_screenshot() {

		// Screenshot section.
		printf(
			'<section class="screenshot">
				<div class="cont">
					<img src="%1$s" alt="%2$s"/>
					<a href="%3$s" class="hover" data-lity></a>
				</div>
				<ul>
					<li>%4$s</li>
					<li>%5$s</li>
					<li>%6$s</li>
					<li>%7$s</li>
				</ul>			
			</section>',
			esc_url( WPFORMS_PLUGIN_URL . 'assets/images/smtp/screenshot-tnail.png' ),
			esc_attr__( 'WP Mail SMTP screenshot', 'wpforms-lite' ),
			esc_url( WPFORMS_PLUGIN_URL . 'assets/images/smtp/screenshot-full.png' ),
			esc_html__( 'Over 1,000,000 websites use WP Mail SMTP.', 'wpforms-lite' ),
			esc_html__( 'Send emails authenticated via trusted parties.', 'wpforms-lite' ),
			esc_html__( 'Transactional Mailers: Pepipost, SendinBlue, Mailgun, SendGrid, Amazon SES.', 'wpforms-lite' ),
			esc_html__( 'Web Mailers: Gmail, G Suite, Office 365, Outlook.com.', 'wpforms-lite' )
		);
	}

	/**
	 * Generate and output step 'Install' section HTML.
	 *
	 * @since 1.5.7
	 */
	protected function output_section_step_install() {

		$step = $this->get_data_step_install();

		if ( empty( $step ) ) {
			return;
		}

		printf(
			'<section class="step step-install">
				<aside class="num">
					<img src="%1$s" alt="%2$s" />
					<i class="loader hidden"></i>
				</aside>
				<div>
					<h2>%3$s</h2>
					<p>%4$s</p>
					<button class="button %5$s" data-plugin="%6$s" data-action="%7$s">%8$s</button>
				</div>		
			</section>',
			esc_url( WPFORMS_PLUGIN_URL . 'assets/images/' . $step['icon'] ),
			esc_attr__( 'Step 1', 'wpforms-lite' ),
			esc_html__( 'Install and Activate WP Mail SMTP', 'wpforms-lite' ),
			esc_html__( 'Install WP Mail SMTP from the WordPress.org plugin repository.', 'wpforms-lite' ),
			esc_attr( $step['button_class'] ),
			esc_attr( $step['plugin'] ),
			esc_attr( $step['button_action'] ),
			esc_html( $step['button_text'] )
		);
	}

	/**
	 * Generate and output step 'Setup' section HTML.
	 *
	 * @since 1.5.7
	 */
	protected function output_section_step_setup() {

		$step = $this->get_data_step_setup();

		if ( empty( $step ) ) {
			return;
		}

		printf(
			'<section class="step step-setup %1$s">
				<aside class="num">
					<img src="%2$s" alt="%3$s" />
					<i class="loader hidden"></i>
				</aside>
				<div>
					<h2>%4$s</h2>
					<p>%5$s</p>
					<button class="button %6$s" data-url="%7$s">%8$s</button>
				</div>		
			</section>',
			esc_attr( $step['section_class'] ),
			esc_url( WPFORMS_PLUGIN_URL . 'assets/images/' . $step['icon'] ),
			esc_attr__( 'Step 2', 'wpforms-lite' ),
			esc_html__( 'Set Up WP Mail SMTP', 'wpforms-lite' ),
			esc_html__( 'Select and configure your mailer.', 'wpforms-lite' ),
			esc_attr( $step['button_class'] ),
			esc_url( admin_url( $this->config['smtp_settings'] ) ),
			esc_html( $step['button_text'] )
		);
	}

	/**
	 * Step 'Install' data.
	 *
	 * @since 1.5.7
	 *
	 * @return array Step data.
	 */
	protected function get_data_step_install() {

		$step = array();

		$this->output_data['all_plugins']          = get_plugins();
		$this->output_data['plugin_installed']     = array_key_exists( $this->config['lite_plugin'], $this->output_data['all_plugins'] );
		$this->output_data['pro_plugin_installed'] = array_key_exists( $this->config['pro_plugin'], $this->output_data['all_plugins'] );
		$this->output_data['plugin_activated']     = false;
		$this->output_data['plugin_setup']         = false;

		if ( ! $this->output_data['plugin_installed'] && ! $this->output_data['pro_plugin_installed'] ) {
			$step['icon']          = 'step-1.svg';
			$step['button_text']   = esc_html__( 'Install WP Mail SMTP', 'wpforms-lite' );
			$step['button_class']  = '';
			$step['button_action'] = 'install';
			$step['plugin']        = $this->config['lite_download_url'];
		} else {
			$this->output_data['plugin_activated'] = $this->is_smtp_activated();
			$this->output_data['plugin_setup']     = $this->is_smtp_configured();
			$step['icon']                          = $this->output_data['plugin_activated'] ? 'step-complete.svg' : 'step-1.svg';
			$step['button_text']                   = $this->output_data['plugin_activated'] ? esc_html__( 'WP Mail SMTP Installed & Activated', 'wpforms-lite' ) : esc_html__( 'Activate WP Mail SMTP', 'wpforms-lite' );
			$step['button_class']                  = $this->output_data['plugin_activated'] ? 'grey disabled' : '';
			$step['button_action']                 = $this->output_data['plugin_activated'] ? '' : 'activate';
			$step['plugin']                        = $this->output_data['pro_plugin_installed'] ? $this->config['pro_plugin'] : $this->config['lite_plugin'];
		}

		return $step;
	}

	/**
	 * Step 'Setup' data.
	 *
	 * @since 1.5.7
	 *
	 * @return array Step data.
	 */
	protected function get_data_step_setup() {

		$step = array();

		$step['icon']          = 'step-2.svg';
		$step['section_class'] = $this->output_data['plugin_activated'] ? '' : 'grey';
		$step['button_text']   = esc_html__( 'Start Setup', 'wpforms-lite' );
		$step['button_class']  = 'grey disabled';

		if ( $this->output_data['plugin_setup'] ) {
			$step['icon']          = 'step-complete.svg';
			$step['section_class'] = '';
			$step['button_text']   = esc_html__( 'Go to SMTP settings', 'wpforms-lite' );
		} else {
			$step['button_class'] = $this->output_data['plugin_activated'] ? '' : 'grey disabled';
		}

		return $step;
	}

	/**
	 * Ajax endpoint. Check plugin setup status.
	 * Used to properly init step 'Setup' section after completing step 'Install'.
	 *
	 * @since 1.5.7
	 */
	public function ajax_check_plugin_status() {

		// Security checks.
		if (
			! check_ajax_referer( 'wpforms-admin', 'nonce', false ) ||
			! wpforms_current_user_can()
		) {
			wp_send_json_error(
				array(
					'error' => esc_html__( 'You do not have permission.', 'wpforms-lite' ),
				)
			);
		}

		$result = array();

		if ( ! $this->is_smtp_activated() ) {
			wp_send_json_error(
				array(
					'error' => esc_html__( 'Plugin unavailable.', 'wpforms-lite' ),
				)
			);
		}

		$result['setup_status']  = (int) $this->is_smtp_configured();
		$result['license_level'] = wp_mail_smtp()->get_license_type();

		wp_send_json_success( $result );
	}

	/**
	 * Get $phpmailer instance.
	 *
	 * @since 1.5.7
	 *
	 * @return \PHPMailer Instance of PHPMailer.
	 */
	protected function get_phpmailer() {

		global $phpmailer;

		if ( ! is_object( $phpmailer ) || ! is_a( $phpmailer, 'PHPMailer' ) ) {
			require_once ABSPATH . WPINC . '/class-phpmailer.php';
			$phpmailer = new \PHPMailer( true ); // phpcs:ignore
		}

		return $phpmailer;
	}

	/**
	 * Whether WP Mail SMTP plugin configured or not.
	 *
	 * @since 1.5.7
	 *
	 * @return bool True if some mailer is selected and configured properly.
	 */
	protected function is_smtp_configured() {

		if ( ! $this->is_smtp_activated() ) {
			return false;
		}

		$phpmailer = $this->get_phpmailer();

		$mailer             = \WPMailSMTP\Options::init()->get( 'mail', 'mailer' );
		$is_mailer_complete = wp_mail_smtp()->get_providers()->get_mailer( $mailer, $phpmailer )->is_mailer_complete();

		return 'mail' !== $mailer && $is_mailer_complete;
	}

	/**
	 * Whether WP Mail SMTP plugin active or not.
	 *
	 * @since 1.5.7
	 *
	 * @return bool True if SMTP plugin is active.
	 */
	protected function is_smtp_activated() {

		return function_exists( 'wp_mail_smtp' ) && ( is_plugin_active( $this->config['lite_plugin'] ) || is_plugin_active( $this->config['pro_plugin'] ) );
	}

	/**
	 * Redirect to SMTP settings page.
	 *
	 * @since 1.5.7
	 */
	public function redirect_to_smtp_settings() {

		// Redirect to SMTP plugin if it is activated.
		if ( $this->is_smtp_configured() ) {
			wp_safe_redirect( admin_url( $this->config['smtp_settings'] ) );
			exit;
		}
	}
}
