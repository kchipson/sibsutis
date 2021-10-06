<?php

/**
 * WPForms Lite. Load Lite specific features/functionality.
 *
 * @since 1.2.0
 *
 * @package WPForms
 */
class WPForms_Lite {

	/**
	 * Primary class constructor.
	 *
	 * @since 1.2.x
	 */
	public function __construct() {

		$this->includes();

		add_action( 'wpforms_form_settings_notifications', array( $this, 'form_settings_notifications' ), 8, 1 );
		add_action( 'wpforms_form_settings_confirmations', array( $this, 'form_settings_confirmations' ) );
		add_action( 'wpforms_builder_enqueues_before', array( $this, 'builder_enqueues' ) );
		add_action( 'wpforms_admin_page', array( $this, 'entries_page' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'addon_page_enqueues' ) );
		add_action( 'wpforms_admin_page', array( $this, 'addons_page' ) );
		add_action( 'wpforms_admin_settings_after', array( $this, 'settings_cta' ), 10, 1 );
		add_action( 'wp_ajax_wpforms_lite_settings_upgrade', array( $this, 'settings_cta_dismiss' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueues' ) );
	}

	/**
	 * Include files.
	 *
	 * @since 1.0.0
	 */
	private function includes() {
	}

	/**
	 * Form notification settings, supports multiple notifications.
	 *
	 * @since 1.2.3
	 *
	 * @param object $settings
	 */
	public function form_settings_notifications( $settings ) {

		$cc               = wpforms_setting( 'email-carbon-copy', false );
		$from_name_after  = apply_filters( 'wpforms_builder_notifications_from_name_after', '' );
		$from_email_after = apply_filters( 'wpforms_builder_notifications_from_email_after', '' );

		// Handle backwards compatibility.
		if ( empty( $settings->form_data['settings']['notifications'] ) ) {
			/* translators: %s - form name. */
			$settings->form_data['settings']['notifications'][1]['subject']        = ! empty( $settings->form_data['settings']['notification_subject'] ) ? $settings->form_data['settings']['notification_subject'] : sprintf( esc_html__( 'New %s Entry', 'wpforms-lite' ), $settings->form->post_title );
			$settings->form_data['settings']['notifications'][1]['email']          = ! empty( $settings->form_data['settings']['notification_email'] ) ? $settings->form_data['settings']['notification_email'] : '{admin_email}';
			$settings->form_data['settings']['notifications'][1]['sender_name']    = ! empty( $settings->form_data['settings']['notification_fromname'] ) ? $settings->form_data['settings']['notification_fromname'] : get_bloginfo( 'name' );
			$settings->form_data['settings']['notifications'][1]['sender_address'] = ! empty( $settings->form_data['settings']['notification_fromaddress'] ) ? $settings->form_data['settings']['notification_fromaddress'] : '{admin_email}';
			$settings->form_data['settings']['notifications'][1]['replyto']        = ! empty( $settings->form_data['settings']['notification_replyto'] ) ? $settings->form_data['settings']['notification_replyto'] : '';
		}
		$id = 1;

		echo '<div class="wpforms-panel-content-section-title">';
			esc_html_e( 'Notifications', 'wpforms-lite' );
			echo '<button class="wpforms-builder-settings-block-add upgrade-modal" data-name="' . esc_attr__( 'Multiple notifications', 'wpforms-lite' ) . '">';
				esc_html_e( 'Add New Notification', 'wpforms-lite' );
			echo '</button>';
		echo '</div>';
		?>

		<?php
		wpforms_panel_field(
			'select',
			'settings',
			'notification_enable',
			$settings->form_data,
			esc_html__( 'Notifications', 'wpforms-lite' ),
			array(
				'default' => '1',
				'options' => array(
					'1' => esc_html__( 'On', 'wpforms-lite' ),
					'0' => esc_html__( 'Off', 'wpforms-lite' ),
				),
			)
		);
		?>

		<div class="wpforms-notification wpforms-builder-settings-block">

			<div class="wpforms-builder-settings-block-header">
				<span><?php esc_html_e( 'Default Notification', 'wpforms-lite' ); ?></span>
			</div>

			<div class="wpforms-builder-settings-block-content">

				<?php
				wpforms_panel_field(
					'text',
					'notifications',
					'email',
					$settings->form_data,
					esc_html__( 'Send To Email Address', 'wpforms-lite' ),
					array(
						'default'    => '{admin_email}',
						'tooltip'    => esc_html__( 'Enter the email address to receive form entry notifications. For multiple notifications, separate email addresses with a comma.', 'wpforms-lite' ),
						'smarttags'  => array(
							'type'   => 'fields',
							'fields' => 'email',
						),
						'parent'     => 'settings',
						'subsection' => $id,
						'class'      => 'email-recipient',
					)
				);
				if ( $cc ) :
					wpforms_panel_field(
						'text',
						'notifications',
						'carboncopy',
						$settings->form_data,
						esc_html__( 'CC', 'wpforms-lite' ),
						array(
							'smarttags'  => array(
								'type'   => 'fields',
								'fields' => 'email',
							),
							'parent'     => 'settings',
							'subsection' => $id,
						)
					);
				endif;
				wpforms_panel_field(
					'text',
					'notifications',
					'subject',
					$settings->form_data,
					esc_html__( 'Email Subject', 'wpforms-lite' ),
					array(
						/* translators: %s - form name. */
						'default'    => sprintf( esc_html__( 'New Entry: %s', 'wpforms-lite' ), $settings->form->post_title ),
						'smarttags'  => array(
							'type' => 'all',
						),
						'parent'     => 'settings',
						'subsection' => $id,
					)
				);
				wpforms_panel_field(
					'text',
					'notifications',
					'sender_name',
					$settings->form_data,
					esc_html__( 'From Name', 'wpforms-lite' ),
					array(
						'default'    => sanitize_text_field( get_option( 'blogname' ) ),
						'smarttags'  => array(
							'type'   => 'fields',
							'fields' => 'name,text',
						),
						'parent'     => 'settings',
						'subsection' => $id,
						'readonly'   => ! empty( $from_name_after ),
						'after'      => ! empty( $from_name_after ) ? '<p class="note">' . $from_name_after . '</p>' : '',
					)
				);
				wpforms_panel_field(
					'text',
					'notifications',
					'sender_address',
					$settings->form_data,
					esc_html__( 'From Email', 'wpforms-lite' ),
					array(
						'default'    => '{admin_email}',
						'smarttags'  => array(
							'type'   => 'fields',
							'fields' => 'email',
						),
						'parent'     => 'settings',
						'subsection' => $id,
						'readonly'   => ! empty( $from_email_after ),
						'after'      => ! empty( $from_email_after ) ? '<p class="note">' . $from_email_after . '</p>' : '',
					)
				);
				wpforms_panel_field(
					'text',
					'notifications',
					'replyto',
					$settings->form_data,
					esc_html__( 'Reply-To', 'wpforms-lite' ),
					array(
						'smarttags'  => array(
							'type'   => 'fields',
							'fields' => 'email',
						),
						'parent'     => 'settings',
						'subsection' => $id,
					)
				);
				wpforms_panel_field(
					'textarea',
					'notifications',
					'message',
					$settings->form_data,
					esc_html__( 'Message', 'wpforms-lite' ),
					array(
						'rows'       => 6,
						'default'    => '{all_fields}',
						'smarttags'  => array(
							'type' => 'all',
						),
						'parent'     => 'settings',
						'subsection' => $id,
						'class'      => 'email-msg',
						'after'      => '<p class="note">' .
										sprintf(
											/* translators: %s - {all_fields} Smart Tag. */
											esc_html__( 'To display all form fields, use the %s Smart Tag.', 'wpforms-lite' ),
											'<code>{all_fields}</code>'
										) .
										'</p>',
					)
				);
				?>
			</div>
		</div>

		<?php
	}

	/**
	 * Lite admin scripts and styles.
	 *
	 * @since 1.5.7
	 */
	public function admin_enqueues() {

		if ( ! wpforms_is_admin_page() ) {
			return;
		}

		$min = wpforms_get_min_suffix();

		// Admin styles.
		wp_enqueue_style(
			'wpforms-lite-admin',
			WPFORMS_PLUGIN_URL . "lite/assets/css/admin{$min}.css",
			array(),
			WPFORMS_VERSION
		);
	}

	/**
	 * Form confirmation settings, supports multiple confirmations.
	 *
	 * @since 1.4.8
	 *
	 * @param object $settings
	 */
	public function form_settings_confirmations( $settings ) {

		wp_enqueue_editor();

		// Handle backwards compatibility.
		if ( empty( $settings->form_data['settings']['confirmations'] ) ) {
			$settings->form_data['settings']['confirmations'][1]['type']           = ! empty( $settings->form_data['settings']['confirmation_type'] ) ? $settings->form_data['settings']['confirmation_type'] : 'message';
			$settings->form_data['settings']['confirmations'][1]['message']        = ! empty( $settings->form_data['settings']['confirmation_message'] ) ? $settings->form_data['settings']['confirmation_message'] : esc_html__( 'Thanks for contacting us! We will be in touch with you shortly.', 'wpforms-lite' );
			$settings->form_data['settings']['confirmations'][1]['message_scroll'] = ! empty( $settings->form_data['settings']['confirmation_message_scroll'] ) ? $settings->form_data['settings']['confirmation_message_scroll'] : 1;
			$settings->form_data['settings']['confirmations'][1]['page']           = ! empty( $settings->form_data['settings']['confirmation_page'] ) ? $settings->form_data['settings']['confirmation_page'] : '';
			$settings->form_data['settings']['confirmations'][1]['redirect']       = ! empty( $settings->form_data['settings']['confirmation_redirect'] ) ? $settings->form_data['settings']['confirmation_redirect'] : '';
		}
		$id = 1;

		echo '<div class="wpforms-panel-content-section-title">';
			esc_html_e( 'Confirmations', 'wpforms-lite' );
			echo '<button class="wpforms-builder-settings-block-add upgrade-modal" data-name="' . esc_attr__( 'Multiple confirmations', 'wpforms-lite' ) . '">';
				esc_html_e( 'Add New Confirmation', 'wpforms-lite' );
			echo '</button>';
		echo '</div>';
		?>

		<div class="wpforms-confirmation wpforms-builder-settings-block">

			<div class="wpforms-builder-settings-block-header">
				<span><?php esc_html_e( 'Default Confirmation', 'wpforms-lite' ); ?></span>
			</div>

			<div class="wpforms-builder-settings-block-content">

				<?php
				wpforms_panel_field(
					'select',
					'confirmations',
					'type',
					$settings->form_data,
					esc_html__( 'Confirmation Type', 'wpforms-lite' ),
					array(
						'default'     => 'message',
						'options'     => array(
							'message'  => esc_html__( 'Message', 'wpforms-lite' ),
							'page'     => esc_html__( 'Show Page', 'wpforms-lite' ),
							'redirect' => esc_html__( 'Go to URL (Redirect)', 'wpforms-lite' ),
						),
						'class'       => 'wpforms-panel-field-confirmations-type-wrap',
						'input_class' => 'wpforms-panel-field-confirmations-type',
						'parent'      => 'settings',
						'subsection'  => $id,
					)
				);
				wpforms_panel_field(
					'textarea',
					'confirmations',
					'message',
					$settings->form_data,
					esc_html__( 'Confirmation Message', 'wpforms-lite' ),
					array(
						'default'     => esc_html__( 'Thanks for contacting us! We will be in touch with you shortly.', 'wpforms-lite' ),
						'tinymce'     => array(
							'editor_height' => '200',
						),
						'input_id'    => 'wpforms-panel-field-confirmations-message-' . $id,
						'input_class' => 'wpforms-panel-field-confirmations-message',
						'parent'      => 'settings',
						'subsection'  => $id,
					)
				);
				wpforms_panel_field(
					'checkbox',
					'confirmations',
					'message_scroll',
					$settings->form_data,
					esc_html__( 'Automatically scroll to the confirmation message', 'wpforms-lite' ),
					array(
						'input_class' => 'wpforms-panel-field-confirmations-message_scroll',
						'parent'      => 'settings',
						'subsection'  => $id,
					)
				);
				$p     = array();
				$pages = get_pages();
				foreach ( $pages as $page ) {
					$depth          = count( $page->ancestors );
					$p[ $page->ID ] = str_repeat( '-', $depth ) . ' ' . $page->post_title;
				}
				wpforms_panel_field(
					'select',
					'confirmations',
					'page',
					$settings->form_data,
					esc_html__( 'Confirmation Page', 'wpforms-lite' ),
					array(
						'options'     => $p,
						'input_class' => 'wpforms-panel-field-confirmations-page',
						'parent'      => 'settings',
						'subsection'  => $id,
					)
				);
				wpforms_panel_field(
					'text',
					'confirmations',
					'redirect',
					$settings->form_data,
					esc_html__( 'Confirmation Redirect URL', 'wpforms-lite' ),
					array(
						'input_class' => 'wpforms-panel-field-confirmations-redirect',
						'parent'      => 'settings',
						'subsection'  => $id,
					)
				);
				?>
			</div>
		</div>

		<?php
	}

	/**
	 * Load assets for lite version with the admin builder.
	 *
	 * @since 1.0.0
	 */
	public function builder_enqueues() {

		wp_enqueue_script(
			'wpforms-builder-lite',
			WPFORMS_PLUGIN_URL . 'lite/assets/js/admin-builder-lite.js',
			array( 'jquery', 'jquery-confirm' ),
			WPFORMS_VERSION,
			false
		);

		$strings = array(
			'disable_notifications' => sprintf(
				wp_kses(
					/* translators: %s - WPForms.com docs page URL. */
					__( 'You\'ve just turned off notification emails for this form. Since entries are not stored in WPForms Lite, notification emails are recommended for collecting entry details. For setup steps, <a href="%s" target="_blank" rel="noopener noreferrer">please see our notification tutorial</a>.', 'wpforms-lite' ),
					array(
						'a'      => array(
							'href'   => array(),
							'target' => array(),
							'rel'    => array(),
						),
					)
				),
				'https://wpforms.com/docs/setup-form-notification-wpforms/'
			),
		);

		$strings = apply_filters( 'wpforms_lite_builder_strings', $strings );

		wp_localize_script(
			'wpforms-builder-lite',
			'wpforms_builder_lite',
			$strings
		);
	}

	/**
	 * Display upgrade notice at the bottom on the plugin settings pages.
	 *
	 * @since 1.4.7
	 *
	 * @param string $view
	 */
	public function settings_cta( $view ) {

		if ( get_option( 'wpforms_lite_settings_upgrade', false ) || apply_filters( 'wpforms_lite_settings_upgrade', false ) ) {
			return;
		}
		?>
		<div class="settings-lite-cta">
			<a href="#" class="dismiss" title="<?php esc_attr_e( 'Dismiss this message', 'wpforms-lite' ); ?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
			<h5><?php esc_html_e( 'Get WPForms Pro and Unlock all the Powerful Features', 'wpforms-lite' ); ?></h5>
			<p><?php esc_html_e( 'Thanks for being a loyal WPForms Lite user. Upgrade to WPForms Pro to unlock all the awesome features and experience why WPForms is consistently rated the best WordPress form builder.', 'wpforms-lite' ); ?></p>
			<p>
				<?php
				printf(
					wp_kses(
						/* translators: %s - star icons. */
						__( 'We know that you will truly love WPForms. It has over 5000+ five star ratings (%s) and is active on over 3 million websites.', 'wpforms-lite' ),
						array(
							'i' => array(
								'class'       => array(),
								'aria-hidden' => array(),
							),
						)
					),
					str_repeat( '<i class="fa fa-star" aria-hidden="true"></i>', 5 )
				);
				?>
			</p>
			<h6><?php esc_html_e( 'Pro Features:', 'wpforms-lite' ); ?></h6>
			<div class="list">
				<ul>
					<li><?php esc_html_e( 'Entry Management - view all leads in one place', 'wpforms-lite' ); ?></li>
					<li><?php esc_html_e( 'All form features like file upload, pagination, etc', 'wpforms-lite' ); ?></li>
					<li><?php esc_html_e( 'Create surveys & polls with the surveys addon', 'wpforms-lite' ); ?></li>
					<li><?php esc_html_e( 'WordPress user registration and login forms', 'wpforms-lite' ); ?></li>
					<li><?php esc_html_e( 'Create payment forms with Stripe and PayPal', 'wpforms-lite' ); ?></li>
				</ul>
				<ul>
					<li><?php esc_html_e( 'Powerful Conditional Logic so you can create smart forms', 'wpforms-lite' ); ?></li>
					<li><?php esc_html_e( '500+ integrations with different marketing & payment services', 'wpforms-lite' ); ?></li>
					<li><?php esc_html_e( 'Collect signatures, geo-location data, and more', 'wpforms-lite' ); ?></li>
					<li><?php esc_html_e( 'Accept user submitted content with Post Submissions addon', 'wpforms-lite' ); ?></li>
					<li><?php esc_html_e( 'Bonus form templates, form abandonment, and more', 'wpforms-lite' ); ?></li>
				</ul>
			</div>
			<p>
				<a href="<?php echo esc_url( wpforms_admin_upgrade_link( 'settings-upgrade' ) ); ?>" target="_blank" rel="noopener noreferrer">
					<?php esc_html_e( 'Get WPForms Pro Today and Unlock all the Powerful Features »', 'wpforms-lite' ); ?>
				</a>
			</p>
			<p>
				<?php
				echo wp_kses(
					__( '<strong>Bonus:</strong> WPForms Lite users get <span class="green">50% off regular price</span>, automatically applied at checkout.', 'wpforms-lite' ),
					array(
						'strong' => array(),
						'span'   => array(
							'class' => array(),
						),
					)
				);
				?>
			</p>
		</div>
		<script type="text/javascript">
			jQuery( document ).ready( function ( $ ) {
				$( document ).on( 'click', '.settings-lite-cta .dismiss', function ( event ) {
					event.preventDefault();
					$.post( ajaxurl, {
						action: 'wpforms_lite_settings_upgrade'
					} );
					$( '.settings-lite-cta' ).remove();
				} );
			} );
		</script>
		<?php
	}

	/**
	 * Dismiss upgrade notice at the bottom on the plugin settings pages.
	 *
	 * @since 1.4.7
	 */
	public function settings_cta_dismiss() {

		if ( ! wpforms_current_user_can() ) {
			wp_send_json_error();
		}

		update_option( 'wpforms_lite_settings_upgrade', time() );

		wp_send_json_success();
	}

	/**
	 * Notify user that entries is a pro feature.
	 *
	 * @since 1.0.0
	 */
	public function entries_page() {

		if ( ! isset( $_GET['page'] ) || 'wpforms-entries' !== $_GET['page'] ) {
			return;
		}
		?>

		<style type="text/css">
			.wpforms-admin-content {
				-webkit-filter: blur(3px);
				-moz-filter: blur(3px);
				-ms-filter: blur(3px);
				-o-filter: blur(3px);
				filter: blur(3px);
			}

			.wpforms-admin-content a {
				pointer-events: none;
				cursor: default;
			}

			.ie-detected {
				position: absolute;
				top: 0;
				width: 100%;
				height: 100%;
				left: 0;
				background-color: #f1f1f1;
				opacity: 0.65;
				z-index: 10;
			}

			.wpforms-admin-content,
			.wpforms-admin-content-wrap {
				position: relative;
			}

			.entries-modal {
				text-align: center;
				width: 730px;
				box-shadow: 0 0 60px 30px rgba(0, 0, 0, 0.15);
				border-radius: 3px;
				position: absolute;
				top: 75px;
				left: 50%;
				margin: 0 auto 0 -365px;
				z-index: 100;
			}

			.entries-modal *,
			.entries-modal *::before,
			.entries-modal *::after {
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
			}

			.entries-modal h2 {
				font-size: 20px;
				margin: 0 0 16px 0;
				padding: 0;
			}

			.entries-modal p {
				font-size: 16px;
				color: #666;
				margin: 0 0 30px 0;
				padding: 0;
			}

			.entries-modal-content {
				background-color: #fff;
				border-radius: 3px 3px 0 0;
				padding: 40px;
			}

			.entries-modal ul {
				float: left;
				width: 50%;
				margin: 0;
				padding: 0 0 0 30px;
				text-align: left;
			}

			.entries-modal li {
				color: #666;
				font-size: 16px;
				padding: 6px 0;
			}

			.entries-modal li .fa {
				color: #2a9b39;
				margin: 0 8px 0 0;
			}

			.entries-modal-button {
				border-radius: 0 0 3px 3px;
				padding: 30px;
				background: #f5f5f5;
				text-align: center;
			}

			#wpforms-entries-list .entries .column-indicators > a {
				float: left;
			}
		</style>
		<script type="text/javascript">
			jQuery( function ( $ ) {
				var userAgent = window.navigator.userAgent,
					onlyIEorEdge = /msie\s|trident\/|edge\//i.test( userAgent ) && ! ! (document.uniqueID || window.MSInputMethodContext),
					checkVersion = (onlyIEorEdge && + (/(edge\/|rv:|msie\s)([\d.]+)/i.exec( userAgent )[ 2 ])) || NaN;
				if ( ! isNaN( checkVersion ) ) {
					$( '#ie-wrap' ).addClass( 'ie-detected' );
				}
			} );
		</script>

		<div id="wpforms-entries-list" class="wrap wpforms-admin-wrap">
			<h1 class="page-title">Entries</h1>
			<div class="wpforms-admin-content-wrap">

				<div class="entries-modal">
					<div class="entries-modal-content">
						<h2><?php esc_html_e( 'View and Manage All Your Form Entries inside WordPress', 'wpforms-lite' ); ?></h2>
						<p>
							<strong><?php esc_html_e( 'Form entries are not stored in WPForms Lite.', 'wpforms-lite' ); ?></strong><br>
							<?php esc_html_e( 'Once you upgrade to WPForms Pro, all future form entries will be stored in your WordPress database and displayed on this Entries screen.', 'wpforms-lite' ); ?>
						</p>
						<div class="wpforms-clear">
							<ul class="left">
								<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'View Entries in Dashboard', 'wpforms-lite' ); ?></li>
								<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'Export Entries in a CSV File', 'wpforms-lite' ); ?></li>
								<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'Add Notes / Comments', 'wpforms-lite' ); ?></li>
								<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'Save Favorite Entries', 'wpforms-lite' ); ?></li>
							</ul>
							<ul class="right">
								<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'Mark Read / Unread', 'wpforms-lite' ); ?></li>
								<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'Print Entries', 'wpforms-lite' ); ?></li>
								<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'Resend Notifications', 'wpforms-lite' ); ?></li>
								<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'See Geolocation Data', 'wpforms-lite' ); ?></li>
							</ul>
						</div>
					</div>
					<div class="entries-modal-button">
						<a href="<?php echo esc_url( wpforms_admin_upgrade_link( 'entries' ) ); ?>" class="wpforms-btn wpforms-btn-lg wpforms-btn-orange wpforms-upgrade-modal" target="_blank" rel="noopener noreferrer">
							<?php esc_html_e( 'Upgrade to WPForms Pro Now', 'wpforms-lite' ); ?>
						</a>
						<br>
						<p style="margin: 10px 0 0;font-style:italic;font-size: 13px;">and start collecting entries!</p>
					</div>
				</div>

				<div class="wpforms-admin-content">
					<div id="ie-wrap"></div>
					<div class="form-details wpforms-clear">
						<span class="form-details-sub">Select Form</span>
						<h3 class="form-details-title">
							Contact Us
							<div class="form-selector">
								<a href="#" title="Open form selector" class="toggle dashicons dashicons-arrow-down-alt2"></a>
								<div class="form-list" style="display: none;">
									<ul>
										<li></li>
									</ul>
								</div>
							</div>
						</h3>
						<div class="form-details-actions">
							<a href="#" class="form-details-actions-edit"><span class="dashicons dashicons-edit"></span> Edit This Form</a>
							<a href="#" class="form-details-actions-preview" target="_blank" rel="noopener noreferrer"><span class="dashicons dashicons-visibility"></span> Preview Form</a>
							<a href="#" class="form-details-actions-export"><span class="dashicons dashicons-migrate"></span> Export All (CSV)</a>
							<a href="#" class="form-details-actions-read"><span class="dashicons dashicons-marker"></span> Mark All Read</a>
						</div>
					</div>
					<form id="wpforms-entries-table">
						<ul class="subsubsub">
							<li class="all"><a href="#" class="current">All&nbsp;<span class="count">(<span class="total-num">10</span>)</span></a> |</li>
							<li class="unread"><a href="#">Unread&nbsp;<span class="count">(<span class="unread-num">10</span>)</span></a> |</li>
							<li class="starred"><a href="#">Starred&nbsp;<span class="count">(<span class="starred-num">0</span>)</span></a></li>
						</ul>
						<div class="tablenav top">
							<div class="alignleft actions bulkactions">
								<label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
								<select name="action" id="bulk-action-selector-top">
									<option value="-1">Bulk Actions</option>
								</select>
								<input type="submit" id="doaction" class="button action" value="Apply">
							</div>
							<div class="tablenav-pages one-page">
								<span class="displaying-num">10 items</span>
								<span class="pagination-links">
									<span class="tablenav-pages-navspan" aria-hidden="true">«</span>
									<span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
									<span class="paging-input">
										<label for="current-page-selector" class="screen-reader-text">Current Page</label>
										<input class="current-page" id="current-page-selector" type="text" name="paged" value="1" size="1" aria-describedby="table-paging">
										<span class="tablenav-paging-text"> of <span class="total-pages">1</span></span>
									</span>
									<span class="tablenav-pages-navspan" aria-hidden="true">›</span>
									<span class="tablenav-pages-navspan" aria-hidden="true">»</span>
								</span>
							</div>
							<br class="clear">
						</div>
						<table class="wp-list-table widefat fixed striped entries">
							<thead>
								<tr>
									<td id="cb" class="manage-column column-cb check-column">
										<label class="screen-reader-text" for="cb-select-all-1">Select All</label>
										<input id="cb-select-all-1" type="checkbox">
									</td>
									<th scope="col" id="indicators" class="manage-column column-indicators column-primary"></th>
									<th scope="col" id="wpforms_field_0" class="manage-column column-wpforms_field_0">Name</th>
									<th scope="col" id="wpforms_field_1" class="manage-column column-wpforms_field_1">Email</th>
									<th scope="col" id="wpforms_field_2" class="manage-column column-wpforms_field_2">Comment or Message</th>
									<th scope="col" id="date" class="manage-column column-date sortable desc">
										<a href="#"><span>Date</span><span class="sorting-indicator"></span></a>
									</th>
									<th scope="col" id="actions" class="manage-column column-actions">Actions</th>
								</tr>
							</thead>
							<tbody id="the-list" data-wp-lists="list:entry">
								<tr>
									<th scope="row" class="check-column"><input type="checkbox" name="entry_id[]" value="1088"></th>
									<td class="indicators column-indicators has-row-actions column-primary" data-colname="">
										<a href="#" class="indicator-star star" data-id="1088" title="Star entry"><span class="dashicons dashicons-star-filled"></span></a>
										<a href="#" class="indicator-read read" data-id="1088" title="Mark entry read"><span class="dashicons dashicons-marker"></span></a>
										<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
									</td>
									<td class="wpforms_field_0 column-wpforms_field_0" data-colname="Name">David Wells</td>
									<td class="wpforms_field_1 column-wpforms_field_1" data-colname="Email">DavidMWells@example.com</td>
									<td class="wpforms_field_2 column-wpforms_field_2" data-colname="Comment or Message">
										Vivamus sit amet dolor arcu. Praesent fermentum semper justo, nec scelerisq…
									</td>
									<td class="date column-date" data-colname="Date">July 27, 2017</td>
									<td class="actions column-actions" data-colname="Actions">
										<a href="#" title="View Form Entry" class="view">View</a> <span class="sep">|</span> <a href="#" title="Delete Form Entry" class="delete">Delete</a>
									</td>
								</tr>
								<tr>
									<th scope="row" class="check-column"><input type="checkbox" name="entry_id[]" value="1087"></th>
									<td class="indicators column-indicators has-row-actions column-primary" data-colname="">
										<a href="#" class="indicator-star star" data-id="1087" title="Star entry"><span class="dashicons dashicons-star-filled"></span></a>
										<a href="#" class="indicator-read read" data-id="1087" title="Mark entry read"><span class="dashicons dashicons-marker"></span></a>
										<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
									</td>
									<td class="wpforms_field_0 column-wpforms_field_0" data-colname="Name">Jennifer Selzer</td>
									<td class="wpforms_field_1 column-wpforms_field_1" data-colname="Email">JenniferLSelzer@example.com</td>
									<td class="wpforms_field_2 column-wpforms_field_2" data-colname="Comment or Message">
										Maecenas sollicitudin felis et justo elementum, et lobortis justo vulputate…
									</td>
									<td class="date column-date" data-colname="Date">July 27, 2017</td>
									<td class="actions column-actions" data-colname="Actions">
										<a href="#" title="View Form Entry" class="view">View</a> <span	class="sep">|</span> <a href="#" title="Delete Form Entry" class="delete">Delete</a>
									</td>
								</tr>
								<tr>
									<th scope="row" class="check-column"><input type="checkbox" name="entry_id[]" value="1086"></th>
									<td class="indicators column-indicators has-row-actions column-primary" data-colname="">
										<a href="#" class="indicator-star star" data-id="1086" title="Star entry"><span class="dashicons dashicons-star-filled"></span></a>
										<a href="#" class="indicator-read read" data-id="1086" title="Mark entry read"><span class="dashicons dashicons-marker"></span></a>
										<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
									</td>
									<td class="wpforms_field_0 column-wpforms_field_0" data-colname="Name">Philip Norton</td>
									<td class="wpforms_field_1 column-wpforms_field_1" data-colname="Email">PhilipTNorton@example.com</td>
									<td class="wpforms_field_2 column-wpforms_field_2" data-colname="Comment or Message">
										Etiam cursus orci tellus, ut vehicula odio mattis sit amet. Curabitur eros …
									</td>
									<td class="date column-date" data-colname="Date">July 27, 2017</td>
									<td class="actions column-actions" data-colname="Actions">
										<a href="#" title="View Form Entry" class="view">View</a> <span	class="sep">|</span> <a href="#" title="Delete Form Entry" class="delete">Delete</a>
									</td>
								</tr>
								<tr>
									<th scope="row" class="check-column"><input type="checkbox" name="entry_id[]" value="1085"></th>
									<td class="indicators column-indicators has-row-actions column-primary" data-colname="">
										<a href="#" class="indicator-star star" data-id="1085" title="Star entry"><span class="dashicons dashicons-star-filled"></span></a>
										<a href="#" class="indicator-read read" data-id="1085" title="Mark entry read"><span class="dashicons dashicons-marker"></span></a>
										<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
									</td>
									<td class="wpforms_field_0 column-wpforms_field_0" data-colname="Name">Kevin Gregory</td>
									<td class="wpforms_field_1 column-wpforms_field_1" data-colname="Email">KevinJGregory@example.com</td>
									<td class="wpforms_field_2 column-wpforms_field_2" data-colname="Comment or Message">
										Cras vel orci congue, tincidunt eros vitae, consectetur risus. Proin enim m…
									</td>
									<td class="date column-date" data-colname="Date">July 27, 2017</td>
									<td class="actions column-actions" data-colname="Actions">
										<a href="#" title="View Form Entry" class="view">View</a> <span	class="sep">|</span> <a href="#" title="Delete Form Entry" class="delete">Delete</a>
									</td>
								</tr>
								<tr>
									<th scope="row" class="check-column"><input type="checkbox" name="entry_id[]" value="1084"></th>
									<td class="indicators column-indicators has-row-actions column-primary" data-colname="">
										<a href="#" class="indicator-star star" data-id="1084" title="Star entry"><span class="dashicons dashicons-star-filled"></span></a>
										<a href="#" class="indicator-read read" data-id="1084" title="Mark entry read"><span class="dashicons dashicons-marker"></span></a>
										<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
									</td>
									<td class="wpforms_field_0 column-wpforms_field_0" data-colname="Name">John Heiden</td>
									<td class="wpforms_field_1 column-wpforms_field_1" data-colname="Email">JohnCHeiden@example.com</td>
									<td class="wpforms_field_2 column-wpforms_field_2" data-colname="Comment or Message">
										Fusce consequat dui ut orci tempus cursus. Vivamus ut neque id ipsum tempor…
									</td>
									<td class="date column-date" data-colname="Date">July 27, 2017</td>
									<td class="actions column-actions" data-colname="Actions">
										<a href="#" title="View Form Entry" class="view">View</a> <span	class="sep">|</span> <a href="#" title="Delete Form Entry" class="delete">Delete</a>
									</td>
								</tr>
								<tr>
									<th scope="row" class="check-column"><input type="checkbox" name="entry_id[]" value="1083"></th>
									<td class="indicators column-indicators has-row-actions column-primary" data-colname="">
										<a href="#" class="indicator-star star" data-id="1083" title="Star entry"><span class="dashicons dashicons-star-filled"></span></a>
										<a href="#" class="indicator-read read" data-id="1083" title="Mark entry read"><span class="dashicons dashicons-marker"></span></a>
										<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
									</td>
									<td class="wpforms_field_0 column-wpforms_field_0" data-colname="Name">Laura Shuler</td>
									<td class="wpforms_field_1 column-wpforms_field_1" data-colname="Email">LauraDShuler@example.com</td>
									<td class="wpforms_field_2 column-wpforms_field_2" data-colname="Comment or Message">
										In ac finibus erat. Curabitur sit amet ante nec tellus commodo commodo non …
									</td>
									<td class="date column-date" data-colname="Date">July 27, 2017</td>
									<td class="actions column-actions" data-colname="Actions">
										<a href="#" title="View Form Entry" class="view">View</a> <span	class="sep">|</span> <a href="#" title="Delete Form Entry" class="delete">Delete</a>
									</td>
								</tr>
								<tr>
									<th scope="row" class="check-column"><input type="checkbox" name="entry_id[]" value="1082"></th>
									<td class="indicators column-indicators has-row-actions column-primary" data-colname="">
										<a href="#" class="indicator-star star" data-id="1082" title="Star entry"><span class="dashicons dashicons-star-filled"></span></a>
										<a href="#" class="indicator-read read" data-id="1082" title="Mark entry read"><span class="dashicons dashicons-marker"></span></a>
										<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
									</td>
									<td class="wpforms_field_0 column-wpforms_field_0" data-colname="Name">Walter Sullivan</td>
									<td class="wpforms_field_1 column-wpforms_field_1" data-colname="Email">WalterPSullivan@example.com</td>
									<td class="wpforms_field_2 column-wpforms_field_2" data-colname="Comment or Message">
										Phasellus semper magna leo, ut porta nibh pretium sed. Interdum et malesuad…
									</td>
									<td class="date column-date" data-colname="Date">July 27, 2017</td>
									<td class="actions column-actions" data-colname="Actions">
										<a href="#" title="View Form Entry" class="view">View</a> <span	class="sep">|</span> <a href="#" title="Delete Form Entry" class="delete">Delete</a>
									</td>
								</tr>
								<tr>
									<th scope="row" class="check-column"><input type="checkbox" name="entry_id[]" value="1081"></th>
									<td class="indicators column-indicators has-row-actions column-primary" data-colname="">
										<a href="#" class="indicator-star star" data-id="1081" title="Star entry"><span class="dashicons dashicons-star-filled"></span></a>
										<a href="#" class="indicator-read read" data-id="1081" title="Mark entry read"><span class="dashicons dashicons-marker"></span></a>
										<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
									</td>
									<td class="wpforms_field_0 column-wpforms_field_0" data-colname="Name">Gary Austin</td>
									<td class="wpforms_field_1 column-wpforms_field_1" data-colname="Email">GaryJAustin@example.com</td>
									<td class="wpforms_field_2 column-wpforms_field_2" data-colname="Comment or Message">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet ero…
									</td>
									<td class="date column-date" data-colname="Date">July 27, 2017</td>
									<td class="actions column-actions" data-colname="Actions">
										<a href="#" title="View Form Entry" class="view">View</a> <span	class="sep">|</span> <a href="#" title="Delete Form Entry" class="delete">Delete</a>
									</td>
								</tr>
								<tr>
									<th scope="row" class="check-column"><input type="checkbox" name="entry_id[]" value="1080"></th>
									<td class="indicators column-indicators has-row-actions column-primary" data-colname="">
										<a href="#" class="indicator-star star" data-id="1080" title="Star entry"><span class="dashicons dashicons-star-filled"></span></a>
										<a href="#" class="indicator-read read" data-id="1080" title="Mark entry read"><span class="dashicons dashicons-marker"></span></a>
										<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
									</td>
									<td class="wpforms_field_0 column-wpforms_field_0" data-colname="Name">Mark Frahm</td>
									<td class="wpforms_field_1 column-wpforms_field_1" data-colname="Email">MarkTFrahm@example.com</td>
									<td class="wpforms_field_2 column-wpforms_field_2" data-colname="Comment or Message">
										Proin euismod tellus quis tortor bibendum, a pulvinar libero fringilla. Cur…
									</td>
									<td class="date column-date" data-colname="Date">July 27, 2017</td>
									<td class="actions column-actions" data-colname="Actions">
										<a href="#" title="View Form Entry" class="view">View</a> <span	class="sep">|</span> <a href="#" title="Delete Form Entry" class="delete">Delete</a>
									</td>
								</tr>
								<tr>
									<th scope="row" class="check-column"><input type="checkbox" name="entry_id[]" value="1079"></th>
									<td class="indicators column-indicators has-row-actions column-primary" data-colname="">
										<a href="#" class="indicator-star star" data-id="1079" title="Star entry"><span class="dashicons dashicons-star-filled"></span></a>
										<a href="#" class="indicator-read read" data-id="1079" title="Mark entry read"><span class="dashicons dashicons-marker"></span></a>
										<button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
									</td>
									<td class="wpforms_field_0 column-wpforms_field_0" data-colname="Name">Linda Reynolds</td>
									<td class="wpforms_field_1 column-wpforms_field_1" data-colname="Email">LindaJReynolds@example.com</td>
									<td class="wpforms_field_2 column-wpforms_field_2" data-colname="Comment or Message">
										Cras sodales sagittis maximus. Nunc vestibulum orci quis orci pulvinar vulp…
									</td>
									<td class="date column-date" data-colname="Date">July 27, 2017</td>
									<td class="actions column-actions" data-colname="Actions">
										<a href="#" title="View Form Entry" class="view">View</a> <span	class="sep">|</span> <a href="#" title="Delete Form Entry" class="delete">Delete</a>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td class="manage-column column-cb check-column">
										<label class="screen-reader-text" for="cb-select-all-2">Select All</label>
										<input id="cb-select-all-2" type="checkbox">
									</td>
									<th scope="col" class="manage-column column-indicators column-primary"></th>
									<th scope="col" class="manage-column column-wpforms_field_0">Name</th>
									<th scope="col" class="manage-column column-wpforms_field_1">Email</th>
									<th scope="col" class="manage-column column-wpforms_field_2">Comment or Message</th>
									<th scope="col" class="manage-column column-date sortable desc">
										<a href="#"><span>Date</span><span class="sorting-indicator"></span></a>
									</th>
									<th scope="col" class="manage-column column-actions">Actions</th>
								</tr>
							</tfoot>
						</table>
					</form>
				</div>
			</div>
		</div>
		<div class="clear"></div>

		<?php
	}

	/**
	 * Add appropriate styling to addons page.
	 *
	 * @since 1.0.4
	 */
	public function addon_page_enqueues() {

		if ( ! isset( $_GET['page'] ) || 'wpforms-addons' !== $_GET['page'] ) {
			return;
		}

		// JavaScript.
		wp_enqueue_script(
			'jquery-matchheight',
			WPFORMS_PLUGIN_URL . 'assets/js/jquery.matchHeight-min.js',
			array( 'jquery' ),
			'0.7.0',
			false
		);

		wp_enqueue_script(
			'listjs',
			WPFORMS_PLUGIN_URL . 'assets/js/list.min.js',
			array( 'jquery' ),
			'1.5.0'
		);
	}

	/**
	 * Notify user that addons are a pro feature.
	 *
	 * @since 1.0.0
	 */
	public function addons_page() {

		if ( ! isset( $_GET['page'] ) || 'wpforms-addons' !== $_GET['page'] ) {
			return;
		}

		$upgrade = wpforms_admin_upgrade_link( 'addons' );
		$addons  = array(
			array(
				'name' => 'Aweber',
				'desc' => 'WPForms AWeber addon allows you to create AWeber newsletter signup forms in WordPress, so you can grow your email list.',
				'icon' => 'addon-icon-aweber.png',
			),
			array(
				'name' => 'Campaign Monitor',
				'desc' => 'WPForms Campaign Monitor addon allows you to create Campaign Monitor newsletter signup forms in WordPress, so you can grow your email list.',
				'icon' => 'addon-icon-campaign-monitor.png',
			),
			array(
				'name' => 'Conversational Forms',
				'desc' => 'Want to improve your form completion rate? Conversational Forms addon by WPForms helps make your web forms feel more human, so you can improve your conversions. Interactive web forms made easy.',
				'icon' => 'addon-icon-conversational-forms.png',
			),
			array(
				'name' => 'Custom Captcha',
				'desc' => 'WPForms Custom Captcha addon allows you to define custom questions or use random math questions as captcha to combat spam form submissions.',
				'icon' => 'addon-icon-captcha.png',
			),
			array(
				'name' => 'Drip',
				'desc' => 'WPForms Drip addon allows you to create Drip newsletter signup forms in WordPress, so you can grow your email list.',
				'icon' => 'addon-icon-drip.png',
			),
			array(
				'name' => 'Form Abandonment',
				'desc' => 'Unlock more leads by capturing partial entries from your forms. Easily follow up with interested leads and turn them into loyal customers.',
				'icon' => 'addon-icon-form-abandonment.png',
			),
			array(
				'name' => 'Form Locker',
				'desc' => 'WPForms\' Form Locker addon allows you to lock your WordPress forms with various permissions and access control rules including passwords, members-only, specific date / time, max entry limit, and more.',
				'icon' => 'addon-icons-locker.png',
			),
			array(
				'name' => 'Form Pages',
				'desc' => 'Want to improve your form conversions? WPForms Form Pages addon allows you to create completely custom "distraction-free" form landing pages to boost conversions (without writing any code).',
				'icon' => 'addon-icon-form-pages.png',
			),
			array(
				'name' => 'Form Templates Pack',
				'desc' => 'Choose from a huge variety of pre-built templates for every niche and industry, so you can build all kinds of web forms in minutes, not hours.',
				'icon' => 'addon-icon-form-templates-pack.png',
			),
			array(
				'name' => 'Geolocation',
				'desc' => 'WPForms Geolocation addon allows you to collect and store your website visitors geolocation data along with their form submission.',
				'icon' => 'addon-icon-geolocation.png',
			),
			array(
				'name' => 'GetResponse',
				'desc' => 'WPForms GetResponse addon allows you to create GetResponse newsletter signup forms in WordPress, so you can grow your email list.',
				'icon' => 'addon-icon-getresponse.png',
			),
			array(
				'name' => 'MailChimp',
				'desc' => 'WPForms MailChimp addon allows you to create MailChimp newsletter signup forms in WordPress, so you can grow your email list.',
				'icon' => 'addon-icon-mailchimp.png',
			),
			array(
				'name' => 'Offline Forms',
				'desc' => 'WPForms Offline Forms addon allows you to enable offline mode so users can save their entered data and submit when their internet connection is restored.',
				'icon' => 'addon-icon-offline-forms.png',
			),
			array(
				'name' => 'PayPal Standard',
				'desc' => 'WPForms PayPal addon allows you to connect your WordPress site with PayPal to easily collect payments, donations, and online orders.',
				'icon' => 'addon-icon-paypal.png',
			),
			array(
				'name' => 'Post Submissions',
				'desc' => 'WPForms Post Submissions addon makes it easy to have user-submitted content in WordPress. This front-end post submission form allow your users to submit blog posts without logging into the admin area.',
				'icon' => 'addon-icon-post-submissions.png',
			),
			array(
				'name' => 'Signatures',
				'desc' => 'WPForms Signatures addon makes it easy for users to sign your forms. This WordPress signatures plugin will allow your users to sign contracts and other agreements with their mouse or touch screen.',
				'icon' => 'addon-icon-signatures.png',
			),
			array(
				'name' => 'Stripe',
				'desc' => 'WPForms Stripe addon allows you to connect your WordPress site with Stripe to easily collect payments, donations, and online orders.',
				'icon' => 'addon-icon-stripe.png',
			),
			array(
				'name' => 'Surveys and Polls',
				'desc' => 'WPForms Surveys and Polls allows you easily create surveys forms and analyze the data with interactive reports.',
				'icon' => 'addon-icons-surveys-polls.png',
			),
			array(
				'name' => 'User Registration',
				'desc' => 'WPForms User Registration addon allows you to create custom WordPress user registration forms.',
				'icon' => 'addon-icon-user-registration.png',
			),
			array(
				'name' => 'Zapier',
				'desc' => 'WPForms Zapier addon allows you to connect your WordPress forms with over 500+ web apps. The integration possibilities here are just endless.',
				'icon' => 'addon-icon-zapier.png',
			),
		)
		?>

		<div id="wpforms-admin-addons" class="wrap wpforms-admin-wrap">
			<h1 class="page-title">
				<?php esc_html_e( 'WPForms Addons', 'wpforms-lite' ); ?>
				<input type="search" placeholder="<?php esc_html_e( 'Search Addons', 'wpforms-lite' ); ?>" id="wpforms-admin-addons-search">
			</h1>
			<div class="notice notice-info" style="display: block;">
				<p><strong><?php esc_html_e( 'Form Addons are a PRO feature.', 'wpforms-lite' ); ?></strong></p>
				<p><?php esc_html_e( 'Please upgrade to the PRO plan to unlock them and more awesome features.', 'wpforms-lite' ); ?></p>
				<p>
					<a href="<?php echo esc_url( $upgrade ); ?>" class="wpforms-btn wpforms-btn-orange wpforms-btn-md" rel="noopener noreferrer">
						<?php esc_html_e( 'Upgrade Now', 'wpforms-lite' ); ?>
					</a>
				</p>
			</div>
			<div class="wpforms-admin-content">
				<div class="addons-container" id="wpforms-admin-addons-list">
					<div class="list">
						<?php foreach ( $addons as $addon ) : ?>
						<div class="addon-container">
							<div class="addon-item">
								<div class="details wpforms-clear" style="">
									<img src="<?php echo WPFORMS_PLUGIN_URL; ?>assets/images/<?php echo $addon['icon']; ?>">
									<h5 class="addon-name">
										<?php
										printf(
											/* translators: %s - addon name*/
											esc_html__( '%s Addon', 'wpforms-lite' ),
											$addon['name']
										);
										?>
									</h5>
									<p class="addon-desc"><?php echo $addon['desc']; ?></p>
								</div>
								<div class="actions wpforms-clear">
									<div class="upgrade-button">
										<a href="<?php echo esc_url( $upgrade ); ?>" target="_blank" rel="noopener noreferrer" class="wpforms-btn wpforms-btn-light-grey wpforms-upgrade-modal">
											<?php esc_html_e( 'Upgrade Now', 'wpforms-lite' ); ?>
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
}

new WPForms_Lite();
