<?php

/**
 * Settings class.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */
class WPForms_Settings {

	/**
	 * The current active tab.
	 *
	 * @since 1.3.9
	 * @var string
	 */
	public $view;

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Maybe load settings page.
		add_action( 'admin_init', array( $this, 'init' ) );
	}

	/**
	 * Determine if the user is viewing the settings page, if so, party on.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		// Check what page we are on.
		$page = isset( $_GET['page'] ) ? sanitize_key( wp_unslash( $_GET['page'] ) ) : ''; // phpcs:ignore WordPress.CSRF.NonceVerification

		// Only load if we are actually on the settings page.
		if ( 'wpforms-settings' === $page ) {

			// Include API callbacks and functions.
			require_once WPFORMS_PLUGIN_DIR . 'includes/admin/settings-api.php';

			// Watch for triggered save.
			$this->save_settings();

			// Determine the current active settings tab.
			$this->view = isset( $_GET['view'] ) ? sanitize_key( wp_unslash( $_GET['view'] ) ) : 'general'; // phpcs:ignore WordPress.CSRF.NonceVerification

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueues' ) );
			add_action( 'wpforms_admin_page', array( $this, 'output' ) );

			// Hook for addons.
			do_action( 'wpforms_settings_init' );
		}
	}

	/**
	 * Sanitize and save settings.
	 *
	 * @since 1.3.9
	 */
	public function save_settings() {

		// Check nonce and other various security checks.
		if ( ! isset( $_POST['wpforms-settings-submit'] ) || empty( $_POST['nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'wpforms-settings-nonce' ) ) {
			return;
		}

		if ( ! wpforms_current_user_can() ) {
			return;
		}

		if ( empty( $_POST['view'] ) ) {
			return;
		}

		// Get registered fields and current settings.
		$fields   = $this->get_registered_settings( $_POST['view'] );
		$settings = get_option( 'wpforms_settings', array() );

		if ( empty( $fields ) || ! is_array( $fields ) ) {
			return;
		}

		// Sanitize and prep each field.
		foreach ( $fields as $id => $field ) {

			// Certain field types are not valid for saving and are skipped.
			$exclude = apply_filters( 'wpforms_settings_exclude_type', array( 'content', 'license', 'providers' ) );

			if ( empty( $field['type'] ) || in_array( $field['type'], $exclude, true ) ) {
				continue;
			}

			$value      = isset( $_POST[ $id ] ) ? trim( $_POST[ $id ] ) : false;
			$value_prev = isset( $settings[ $id ] ) ? $settings[ $id ] : false;

			// Custom filter can be provided for sanitizing, otherwise use
			// defaults.
			if ( ! empty( $field['filter'] ) && function_exists( $field['filter'] ) ) {

				$value = call_user_func( $field['filter'], $value, $id, $field, $value_prev );

			} else {

				switch ( $field['type'] ) {
					case 'checkbox':
						$value = (bool) $value;
						break;
					case 'image':
						$value = esc_url_raw( $value );
						break;
					case 'color':
						$value = wpforms_sanitize_hex_color( $value );
						break;
					case 'number':
						$value = (float) $value;
						break;
					case 'text':
					case 'radio':
					case 'select':
					default:
						$value = sanitize_text_field( $value );
						break;
				}
			}

			// Add to settings.
			$settings[ $id ] = $value;
		}

		// Save settings.
		update_option( 'wpforms_settings', $settings );

		WPForms_Admin_Notice::success( esc_html__( 'Settings were successfully saved.', 'wpforms-lite' ) );
	}

	/**
	 * Enqueue assets for the settings page.
	 *
	 * @since 1.0.0
	 */
	public function enqueues() {

		do_action( 'wpforms_settings_enqueue' );
	}

	/**
	 * Return registered settings tabs.
	 *
	 * @since 1.3.9
	 * @return array
	 */
	public function get_tabs() {

		$tabs = array(
			'general'      => array(
				'name'   => esc_html__( 'General', 'wpforms-lite' ),
				'form'   => true,
				'submit' => esc_html__( 'Save Settings', 'wpforms-lite' ),
			),
			'email'        => array(
				'name'   => esc_html__( 'Email', 'wpforms-lite' ),
				'form'   => true,
				'submit' => esc_html__( 'Save Settings', 'wpforms-lite' ),
			),
			'recaptcha'    => array(
				'name'   => esc_html__( 'reCAPTCHA', 'wpforms-lite' ),
				'form'   => true,
				'submit' => esc_html__( 'Save Settings', 'wpforms-lite' ),
			),
			'validation'   => array(
				'name'   => esc_html__( 'Validation', 'wpforms-lite' ),
				'form'   => true,
				'submit' => esc_html__( 'Save Settings', 'wpforms-lite' ),
			),
			'integrations' => array(
				'name'   => esc_html__( 'Integrations', 'wpforms-lite' ),
				'form'   => false,
				'submit' => false,
			),
			'misc'         => array(
				'name'   => esc_html__( 'Misc', 'wpforms-lite' ),
				'form'   => true,
				'submit' => esc_html__( 'Save Settings', 'wpforms-lite' ),
			),
		);

		return apply_filters( 'wpforms_settings_tabs', $tabs );
	}

	/**
	 * Output tab navigation area.
	 *
	 * @since 1.3.9
	 */
	public function tabs() {

		$tabs = $this->get_tabs();

		echo '<ul class="wpforms-admin-tabs">';
		foreach ( $tabs as $id => $tab ) {

			$active = $id === $this->view ? 'active' : '';
			$link   = add_query_arg( 'view', $id, admin_url( 'admin.php?page=wpforms-settings' ) );

			echo '<li><a href="' . esc_url_raw( $link ) . '" class="' . esc_attr( $active ) . '">' . esc_html( $tab['name'] ) . '</a></li>';
		}
		echo '</ul>';
	}

	/**
	 * Return all the default registered settings fields.
	 *
	 * @since 1.3.9
	 *
	 * @param string $view
	 *
	 * @return array
	 */
	public function get_registered_settings( $view = '' ) {

		// reCAPTCHA heading description is long so we define it separately.
		$recaptcha_desc  = '<p>' . esc_html__( 'reCAPTCHA is a free anti-spam service from Google which helps to protect your website from spam and abuse while letting real people pass through with ease.', 'wpforms-lite' ) . '</p>';
		$recaptcha_desc .= '<p>' . esc_html__( 'Google offers 3 versions of reCAPTCHA (all supported within WPForms):', 'wpforms-lite' ) . '</p>';
		$recaptcha_desc .= '<ul style="list-style: disc;margin-left: 20px;">';
		$recaptcha_desc .=
			'<li>' .
				wp_kses(
					__( '<strong>v2 Checkbox reCAPTCHA</strong>: Prompts users to check a box to prove they\'re human.', 'wpforms-lite' ),
					array(
						'strong' => array()
					)
				) .
			'</li>';
		$recaptcha_desc .=
			'<li>' .
				wp_kses(
					__( '<strong>v2 Invisible reCAPTCHA</strong>: Uses advanced technology to detect real users without requiring any input.', 'wpforms-lite' ),
					array(
						'strong' => array()
					)
				) .
			'</li>';
		$recaptcha_desc .=
			'<li>' .
				wp_kses(
					__( '<strong>v3 reCAPTCHA</strong>: Uses a behind-the-scenes scoring system to detect abusive traffic, and lets you decide the minimum passing score. Recommended for advanced use only (or if using Google AMP).', 'wpforms-lite' ),
					array(
						'strong' => array()
					)
				) .
			'</li>';
		$recaptcha_desc .= '</ul>';
		$recaptcha_desc .= '<p>' . esc_html__( 'Sites already using one type of reCAPTCHA will need to create new site keys before switching to a different option.', 'wpforms-lite' ) . '</p>';
		$recaptcha_desc .=
			'<p>' .
			sprintf(
				wp_kses(
					/* translators: %s - WPForms.com Setup Captcha URL. */
					__( '<a href="%s" target="_blank" rel="noopener noreferrer">Read our walk through</a> to learn more and for step-by-step directions.', 'wpforms-lite' ),
					array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
							'rel'    => array(),
						),
					)
				),
				'https://wpforms.com/docs/setup-captcha-wpforms/'
			) .
			'</p></ul>';

		$defaults = array(
			// General Settings tab.
			'general'      => array(
				'license-heading' => array(
					'id'       => 'license-heading',
					'content'  => '<h4>' . esc_html__( 'License', 'wpforms-lite' ) . '</h4><p>' . esc_html__( 'Your license key provides access to updates and addons.', 'wpforms-lite' ) . '</p>',
					'type'     => 'content',
					'no_label' => true,
					'class'    => array( 'section-heading' ),
				),
				'license-key'     => array(
					'id'   => 'license-key',
					'name' => esc_html__( 'License Key', 'wpforms-lite' ),
					'type' => 'license',
				),
				'general-heading' => array(
					'id'       => 'general-heading',
					'content'  => '<h4>' . esc_html__( 'General', 'wpforms-lite' ) . '</h4>',
					'type'     => 'content',
					'no_label' => true,
					'class'    => array( 'section-heading', 'no-desc' ),
				),
				'disable-css'     => array(
					'id'        => 'disable-css',
					'name'      => esc_html__( 'Include Form Styling', 'wpforms-lite' ),
					'desc'      => sprintf(
						wp_kses(
							/* translators: %s - WPForms.com documentation URL. */
							__( 'Determines which CSS files to load for the site (<a href="%s" target="_blank" rel="noopener noreferrer">please see our tutorial for full details</a>). Unless experienced with CSS or instructed by support, "Base and Form Theme Styling" is recommended.', 'wpforms-lite' ),
							array(
								'a' => array(
									'href'   => array(),
									'target' => array(),
									'rel'    => array(),
								),
							)
						),
						'https://wpforms.com/docs/how-to-choose-an-include-form-styling-setting/'
					),
					'type'      => 'select',
					'choicesjs' => true,
					'default'   => 1,
					'options'   => array(
						1 => esc_html__( 'Base and form theme styling', 'wpforms-lite' ),
						2 => esc_html__( 'Base styling only', 'wpforms-lite' ),
						3 => esc_html__( 'No styling', 'wpforms-lite' ),
					),
				),
				'global-assets'   => array(
					'id'   => 'global-assets',
					'name' => esc_html__( 'Load Assets Globally', 'wpforms-lite' ),
					'desc' => esc_html__( 'Check this if you would like to load WPForms assets site-wide. Only check if your site is having compatibility issues or instructed to by support.', 'wpforms-lite' ),
					'type' => 'checkbox',
				),
				'gdpr-heading'    => array(
					'id'       => 'GDPR',
					'content'  => '<h4>' . esc_html__( 'GDPR', 'wpforms-lite' ) . '</h4>',
					'type'     => 'content',
					'no_label' => true,
					'class'    => array( 'section-heading', 'no-desc' ),
				),
				'gdpr'            => array(
					'id'   => 'gdpr',
					'name' => esc_html__( 'GDPR Enhancements', 'wpforms-lite' ),
					'desc' => sprintf(
						wp_kses(
							/* translators: %s - WPForms.com GDPR documentation URL. */
							__( 'Check this to turn on GDPR related features and enhancements. <a href="%s" target="_blank" rel="noopener noreferrer">Read our GDPR documentation</a> to learn more.', 'wpforms-lite' ),
							array(
								'a' => array(
									'href'   => array(),
									'target' => array(),
									'rel'    => array(),
								),
							)
						),
						'https://wpforms.com/docs/how-to-create-gdpr-compliant-forms/'
					),
					'type' => 'checkbox',
				),
			),
			// Email settings tab.
			'email'        => array(
				'email-heading'          => array(
					'id'       => 'email-heading',
					'content'  => '<h4>' . esc_html__( 'Email', 'wpforms-lite' ) . '</h4>',
					'type'     => 'content',
					'no_label' => true,
					'class'    => array( 'section-heading', 'no-desc' ),
				),
				'email-template'         => array(
					'id'      => 'email-template',
					'name'    => esc_html__( 'Template', 'wpforms-lite' ),
					'desc'    => esc_html__( 'Determines how email notifications will be formatted. HTML Templates are the default.', 'wpforms-lite' ),
					'type'    => 'radio',
					'default' => 'default',
					'options' => array(
						'default' => esc_html__( 'HTML Template', 'wpforms-lite' ),
						'none'    => esc_html__( 'Plain text', 'wpforms-lite' ),
					),
				),
				'email-header-image'     => array(
					'id'   => 'email-header-image',
					'name' => esc_html__( 'Header Image', 'wpforms-lite' ),
					'desc' => wp_kses( __( 'Upload or choose a logo to be displayed at the top of email notifications.<br>Recommended size is 300x100 or smaller for best support on all devices.', 'wpforms-lite' ), array( 'br' => array() ) ),
					'type' => 'image',
				),
				'email-background-color' => array(
					'id'      => 'email-background-color',
					'name'    => esc_html__( 'Background Color', 'wpforms-lite' ),
					'desc'    => esc_html__( 'Customize the background color of the HTML email template.', 'wpforms-lite' ),
					'type'    => 'color',
					'default' => '#e9eaec',
				),
				'email-carbon-copy'      => array(
					'id'   => 'email-carbon-copy',
					'name' => esc_html__( 'Carbon Copy', 'wpforms-lite' ),
					'desc' => esc_html__( 'Check this if you would like to enable the ability to CC: email addresses in the form notification settings.', 'wpforms-lite' ),
					'type' => 'checkbox',
				),
			),
			// Recaptcha settings tab.
			'recaptcha'    => array(
				'recaptcha-heading'    => array(
					'id'       => 'recaptcha-heading',
					'content'  => '<h4>' . esc_html__( 'reCAPTCHA', 'wpforms-lite' ) . '</h4>' . $recaptcha_desc,
					'type'     => 'content',
					'no_label' => true,
					'class'    => array( 'section-heading' ),
				),
				'recaptcha-type'       => array(
					'id'      => 'recaptcha-type',
					'name'    => esc_html__( 'Type', 'wpforms-lite' ),
					'type'    => 'radio',
					'default' => 'v2',
					'options' => array(
						'v2'        => esc_html__( 'Checkbox reCAPTCHA v2', 'wpforms-lite' ),
						'invisible' => esc_html__( 'Invisible reCAPTCHA v2', 'wpforms-lite' ),
						'v3'        => esc_html__( 'reCAPTCHA v3', 'wpforms-lite' ),
					),
				),
				'recaptcha-site-key'   => array(
					'id'   => 'recaptcha-site-key',
					'name' => esc_html__( 'Site Key', 'wpforms-lite' ),
					'type' => 'text',
				),
				'recaptcha-secret-key' => array(
					'id'   => 'recaptcha-secret-key',
					'name' => esc_html__( 'Secret Key', 'wpforms-lite' ),
					'type' => 'text',
				),
				'recaptcha-fail-msg' => array(
					'id'      => 'recaptcha-fail-msg',
					'name'    => esc_html__( 'Fail Message', 'wpforms-lite' ),
					'desc'    => esc_html__( 'The message displayed to users who fail the reCAPTCHA verification process.', 'wpforms-lite' ),
					'type'    => 'text',
					'default' => esc_html__( 'Google reCAPTCHA verification failed, please try again later.', 'wpforms-lite' ),
				),
				'recaptcha-v3-threshold' => array(
					'id'      => 'recaptcha-v3-threshold',
					'name'    => esc_html__( 'Score Threshold', 'wpforms-lite' ),
					'desc'    => esc_html__( 'reCAPTCHA v3 returns a score (1.0 is very likely a good interaction, 0.0 is very likely a bot). If the score less than or equal to this threshold, the form submission will be blocked and the message above will be displayed.', 'wpforms-lite' ),
					'type'    => 'number',
					'attr'    => array(
						'step' => '0.1',
						'min'  => '0.0',
						'max'  => '1.0',
					),
					'default' => esc_html__( '0.4', 'wpforms-lite' ),
				),
				'recaptcha-noconflict' => array(
					'id'   => 'recaptcha-noconflict',
					'name' => esc_html__( 'No-Conflict Mode', 'wpforms-lite' ),
					'desc' => esc_html__( 'When checked, other reCAPTCHA occurrences are forcefully removed, to prevent conflicts. Only check if your site is having compatibility issues or instructed to by support.', 'wpforms-lite' ),
					'type' => 'checkbox',
				),
			),
			// Validation messages settings tab.
			'validation'   => array(
				'validation-heading'          => array(
					'id'       => 'validation-heading',
					'content'  => '<h4>' . esc_html__( 'Validation Messages', 'wpforms-lite' ) . '</h4><p>' . esc_html__( 'These messages are displayed to the users as they fill out a form in real-time.', 'wpforms-lite' ) . '</p>',
					'type'     => 'content',
					'no_label' => true,
					'class'    => array( 'section-heading' ),
				),
				'validation-required'         => array(
					'id'      => 'validation-required',
					'name'    => esc_html__( 'Required', 'wpforms-lite' ),
					'type'    => 'text',
					'default' => esc_html__( 'This field is required.', 'wpforms-lite' ),
				),
				'validation-url'              => array(
					'id'      => 'validation-url',
					'name'    => esc_html__( 'Website URL', 'wpforms-lite' ),
					'type'    => 'text',
					'default' => esc_html__( 'Please enter a valid URL.', 'wpforms-lite' ),
				),
				'validation-email'            => array(
					'id'      => 'validation-email',
					'name'    => esc_html__( 'Email', 'wpforms-lite' ),
					'type'    => 'text',
					'default' => esc_html__( 'Please enter a valid email address.', 'wpforms-lite' ),
				),
				'validation-email-suggestion' => array(
					'id'      => 'validation-email-suggestion',
					'name'    => esc_html__( 'Email Suggestion', 'wpforms-lite' ),
					'type'    => 'text',
					'default' => esc_html__( 'Did you mean {suggestion}?', 'wpforms-lite' ),
				),
				'validation-number'           => array(
					'id'      => 'validation-number',
					'name'    => esc_html__( 'Number', 'wpforms-lite' ),
					'type'    => 'text',
					'default' => esc_html__( 'Please enter a valid number.', 'wpforms-lite' ),
				),
				'validation-confirm'          => array(
					'id'      => 'validation-confirm',
					'name'    => esc_html__( 'Confirm Value', 'wpforms-lite' ),
					'type'    => 'text',
					'default' => esc_html__( 'Field values do not match.', 'wpforms-lite' ),
				),
				'validation-check-limit'      => array(
					'id'      => 'validation-check-limit',
					'name'    => esc_html__( 'Checkbox Selection Limit', 'wpforms-lite' ),
					'type'    => 'text',
					'default' => esc_html__( 'You have exceeded the number of allowed selections: {#}.', 'wpforms-lite' ),
				),
			),
			// Provider integrations settings tab.
			'integrations' => array(
				'integrations-heading'   => array(
					'id'       => 'integrations-heading',
					'content'  => '<h4>' . esc_html__( 'Integrations', 'wpforms-lite' ) . '</h4><p>' . esc_html__( 'Manage integrations with popular providers such as Constant Contact, MailChimp, Zapier, and more.', 'wpforms-lite' ) . '</p>',
					'type'     => 'content',
					'no_label' => true,
					'class'    => array( 'section-heading' ),
				),
				'integrations-providers' => array(
					'id'      => 'integrations-providers',
					'content' => '<h4>' . esc_html__( 'Integrations', 'wpforms-lite' ) . '</h4><p>' . esc_html__( 'Manage integrations with popular providers such as Constant Contact, MailChimp, Zapier, and more.', 'wpforms-lite' ) . '</p>',
					'type'    => 'providers',
					'wrap'    => 'none',
				),
			),
			// Misc. settings tab.
			'misc'         => array(
				'misc-heading'       => array(
					'id'       => 'misc-heading',
					'content'  => '<h4>' . esc_html__( 'Misc', 'wpforms-lite' ) . '</h4>',
					'type'     => 'content',
					'no_label' => true,
					'class'    => array( 'section-heading', 'no-desc' ),
				),
				'hide-announcements' => array(
					'id'   => 'hide-announcements',
					'name' => esc_html__( 'Hide Announcements', 'wpforms-lite' ),
					'desc' => esc_html__( 'Check this if you would like to hide plugin announcements and update details.', 'wpforms-lite' ),
					'type' => 'checkbox',
				),
				'uninstall-data'     => array(
					'id'   => 'uninstall-data',
					'name' => esc_html__( 'Uninstall WPForms', 'wpforms-lite' ),
					'desc' => esc_html__( 'Check this if you would like to remove ALL WPForms data upon plugin deletion. All forms and settings will be unrecoverable.', 'wpforms-lite' ),
					'type' => 'checkbox',
				),
			),
		);

		if ( wpforms()->pro ) {
			$defaults['misc']['uninstall-data']['desc'] = esc_html__( 'Check this if you would like to remove ALL WPForms data upon plugin deletion. All forms, entries, and uploaded files will be unrecoverable.', 'wpforms' );
		}

		$defaults = apply_filters( 'wpforms_settings_defaults', $defaults );

		if ( empty( $view ) ) {
			$settings = $defaults;
		} else {
			$settings = isset( $defaults[ $view ] ) ? $defaults[ $view ] : array();
		}

		return $settings;
	}

	/**
	 * Return array containing markup for all the appropriate settings fields.
	 *
	 * @since 1.3.9
	 *
	 * @param string $view View slug.
	 *
	 * @return array
	 */
	public function get_settings_fields( $view = '' ) {

		$fields   = array();
		$settings = $this->get_registered_settings( $view );

		foreach ( $settings as $id => $args ) {

			$fields[ $id ] = wpforms_settings_output_field( $args );
		}

		return apply_filters( 'wpforms_settings_fields', $fields, $view );
	}

	/**
	 * Build the output for the plugin settings page.
	 *
	 * @since 1.0.0
	 */
	public function output() {

		$tabs   = $this->get_tabs();
		$fields = $this->get_settings_fields( $this->view );
		?>

		<div id="wpforms-settings" class="wrap wpforms-admin-wrap">

			<?php $this->tabs(); ?>

			<h1 class="wpforms-h1-placeholder"></h1>

			<?php
			if ( wpforms()->pro && class_exists( 'WPForms_License', false ) ) {
				wpforms()->license->notices( true );
			}
			?>

			<div class="wpforms-admin-content wpforms-admin-settings">

				<?php
				// Some tabs rely on AJAX and do not contain a form, such as Integrations.
				if ( ! empty( $tabs[ $this->view ]['form'] ) ) :
				?>
					<form class="wpforms-admin-settings-form" method="post">
						<input type="hidden" name="action" value="update-settings">
						<input type="hidden" name="view" value="<?php echo esc_attr( $this->view ); ?>">
						<input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'wpforms-settings-nonce' ); ?>">
				<?php endif; ?>

				<?php do_action( 'wpforms_admin_settings_before', $this->view, $fields ); ?>

				<?php
				foreach ( $fields as $field ) {
					echo $field;
				}
				?>

				<?php if ( ! empty( $tabs[ $this->view ]['submit'] ) ) : ?>
					<p class="submit">
						<button type="submit" class="wpforms-btn wpforms-btn-md wpforms-btn-orange" name="wpforms-settings-submit"><?php echo $tabs[ $this->view ]['submit']; ?></button>
					</p>
				<?php endif; ?>

				<?php do_action( 'wpforms_admin_settings_after', $this->view, $fields ); ?>

				<?php if ( ! empty( $tabs[ $this->view ]['form'] ) ) : ?>
					</form>
				<?php endif; ?>

			</div>

		</div>

		<?php
	}
}
new WPForms_Settings();
