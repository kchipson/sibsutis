<?php

namespace WPForms\Admin;

/**
 * Challenges and guides a user to set up a first form once WPForms is installed.
 *
 * @package    WPForms\Admin
 * @author     WPForms
 * @since      1.5.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2018, WPForms LLC
 */
class Challenge {

	/**
	 * Number of minutes to complete the Challenge.
	 *
	 * @since 1.5.0
	 *
	 * @var int
	 */
	protected $minutes = 5;

	/**
	 * Constructor.
	 *
	 * @since 1.5.0
	 */
	public function __construct() {

		if ( \current_user_can( \wpforms_get_capability_manage_options() ) ) {
			$this->hooks();
		}
	}

	/**
	 * Hooks.
	 *
	 * @since 1.5.0
	 */
	public function hooks() {

		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		\add_action( 'wpforms_builder_init', array( $this, 'start_challenge' ) );
		\add_action( 'admin_footer', array( $this, 'challenge_html' ) );
		\add_action( 'wpforms_welcome_intro_after', array( $this, 'welcome_html' ) );

		\add_action( 'wp_ajax_wpforms_challenge_embed_page_url', array( $this, 'get_embed_page_url_ajax' ) );
		\add_action( 'wp_ajax_wpforms_challenge_save_option', array( $this, 'save_challenge_option_ajax' ) );
		\add_action( 'wp_ajax_wpforms_challenge_send_contact_form', array( $this, 'send_contact_form_ajax' ) );
	}

	/**
	 * Check if the current page is related to Challenge.
	 *
	 * @since 1.5.0
	 */
	public function is_challenge_page() {

		return \wpforms_is_admin_page()
			|| $this->is_builder_page()
			|| $this->is_form_embed_page();
	}

	/**
	 * Check if the current page is a forms builder page related to Challenge.
	 *
	 * @since 1.5.0
	 */
	public function is_builder_page() {

		if ( ! \wpforms_is_admin_page( 'builder' ) ) {
			return false;
		}

		if ( ! $this->challenge_active() ) {
			return false;
		}

		$step    = \absint( $this->get_challenge_option( 'step' ) );
		$form_id = \absint( $this->get_challenge_option( 'form_id' ) );

		if ( $form_id && $step < 2 ) {
			return false;
		}

		$current_form_id = isset( $_GET['form_id'] ) ? \absint( $_GET['form_id'] ) : 0;
		$is_new_form     = isset( $_GET['newform'] ) ? \absint( $_GET['newform'] ) : 0;

		if ( $is_new_form && 2 !== $step ) {
			return false;
		}

		if ( ! $is_new_form && $form_id !== $current_form_id && $step >= 2 ) {
			return false;
		}

		return true;
	}

	/**
	 * Check if the current page is a form embed page edit related to Challenge.
	 *
	 * @since 1.5.0
	 */
	public function is_form_embed_page() {

		if ( ! \is_admin() || ! \is_user_logged_in() ) {
			return false;
		}

		$screen = \get_current_screen();

		if ( ! isset( $screen->id ) || 'page' !== $screen->id ) {
			return false;
		}

		if ( ! $this->challenge_active() ) {
			return false;
		}

		$step = $this->get_challenge_option( 'step' );

		if ( ! \in_array( $step, array( 4, 5 ), true ) ) {
			return false;
		}

		$embed_page = $this->get_challenge_option( 'embed_page' );

		if ( isset( $screen->action ) && 'add' === $screen->action && 0 === $embed_page ) {
			return true;
		}

		if ( isset( $_GET['post'] ) && $embed_page === \absint( $_GET['post'] ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Load scripts and styles.
	 *
	 * @since 1.5.0
	 */
	public function enqueue_scripts() {

		if ( $this->challenge_finished() ) {
			return;
		}

		$min = \wpforms_get_min_suffix();

		if ( $this->is_challenge_page() ) {

			\wp_enqueue_style(
				'wpforms-challenge',
				\WPFORMS_PLUGIN_URL . "assets/css/challenge{$min}.css",
				array(),
				\WPFORMS_VERSION
			);

			\wp_enqueue_script(
				'wpforms-challenge-admin',
				\WPFORMS_PLUGIN_URL . "assets/js/components/admin/challenge/challenge-admin{$min}.js",
				array( 'jquery' ),
				\WPFORMS_VERSION,
				true
			);

			\wp_localize_script(
				'wpforms-challenge-admin',
				'wpforms_challenge_admin',
				array(
					'nonce'        => \wp_create_nonce( 'wpforms_challenge_ajax_nonce' ),
					'minutes_left' => \absint( $this->minutes ),
				)
			);
		}

		if ( $this->is_builder_page() || $this->is_form_embed_page() ) {

			\wp_enqueue_style(
				'tooltipster',
				\WPFORMS_PLUGIN_URL . 'assets/css/tooltipster.css',
				null,
				'4.2.6'
			);

			\wp_enqueue_script(
				'tooltipster',
				\WPFORMS_PLUGIN_URL . 'assets/js/jquery.tooltipster.min.js',
				array( 'jquery' ),
				'4.2.6',
				true
			);

			\wp_enqueue_script(
				'wpforms-challenge-core',
				\WPFORMS_PLUGIN_URL . "assets/js/components/admin/challenge/challenge-core{$min}.js",
				array( 'jquery', 'tooltipster', 'wpforms-challenge-admin' ),
				\WPFORMS_VERSION,
				true
			);
		}

		if ( $this->is_builder_page() ) {

			\wp_enqueue_script(
				'wpforms-challenge-builder',
				\WPFORMS_PLUGIN_URL . "assets/js/components/admin/challenge/challenge-builder{$min}.js",
				array( 'jquery', 'tooltipster', 'wpforms-challenge-core' ),
				\WPFORMS_VERSION,
				true
			);
		}

		if ( $this->is_form_embed_page() ) {

			\wp_enqueue_style(
				'wpforms-font-awesome',
				\WPFORMS_PLUGIN_URL . 'assets/css/font-awesome.min.css',
				null,
				'4.7.0'
			);

			\wp_enqueue_script(
				'wpforms-challenge-embed',
				\WPFORMS_PLUGIN_URL . "assets/js/components/admin/challenge/challenge-embed{$min}.js",
				array( 'jquery', 'tooltipster', 'wpforms-challenge-core' ),
				\WPFORMS_VERSION,
				true
			);
		}
	}

	/**
	 * Get 'wpforms_challenge' option schema.
	 *
	 * @since 1.5.0
	 */
	public function get_challenge_option_schema() {

		return array(
			'status'              => '',
			'step'                => 0,
			'user_id'             => \get_current_user_id(),
			'form_id'             => 0,
			'embed_page'          => 0,
			'started_date_gmt'    => '',
			'finished_date_gmt'   => '',
			'seconds_spent'       => 0,
			'seconds_left'        => 0,
			'feedback_sent'       => false,
			'feedback_contact_me' => false,
		);
	}

	/**
	 * Get Challenge parameter(s) from Challenge option.
	 *
	 * @since 1.5.0
	 *
	 * @param array|string|null $query Query using 'wpforms_challenge' schema keys.
	 *
	 * @return array|mixed
	 */
	public function get_challenge_option( $query = null ) {

		if ( ! $query ) {
			return \get_option( 'wpforms_challenge' );
		}

		if ( ! \is_array( $query ) ) {
			$return_single = true;
			$query         = array( $query );
		}

		$query = \array_flip( $query );

		$option = \get_option( 'wpforms_challenge' );

		if ( ! $option || ! \is_array( $option ) ) {
			return \array_intersect_key( $this->get_challenge_option_schema(), $query );
		}

		$result = \array_intersect_key( $option, $query );

		if ( $return_single ) {
			$result = \reset( $result );
		}

		return $result;
	}

	/**
	 * Set Challenge parameter(s) to Challenge option.
	 *
	 * @since 1.5.0
	 *
	 * @param array $query Query using 'wpforms_challenge' schema keys.
	 */
	public function set_challenge_option( $query ) {

		if ( empty( $query ) || ! \is_array( $query ) ) {
			return;
		}

		$schema  = $this->get_challenge_option_schema();
		$replace = \array_intersect_key( $query, $schema );

		if ( ! $replace ) {
			return;
		}

		// Validate and sanitize the data.
		foreach ( $replace as $key => $value ) {
			if ( \in_array( $key, array( 'step', 'user_id', 'form_id', 'embed_page', 'seconds_spent', 'seconds_left' ), true ) ) {
				$replace[ $key ] = \absint( $value );
				continue;
			}
			if ( \in_array( $key, array( 'feedback_sent', 'feedback_contact_me' ), true ) ) {
				$replace[ $key ] = \wp_validate_boolean( $value );
				continue;
			}
			$replace[ $key ] = \sanitize_text_field( $value );
		}

		$option = \get_option( 'wpforms_challenge' );

		if ( ! $option || ! \is_array( $option ) ) {
			\update_option( 'wpforms_challenge', \array_merge( $schema, $replace ) );

			return;
		}

		\update_option( 'wpforms_challenge', \array_merge( $option, $replace ) );
	}

	/**
	 * Check if any forms are present on a site.
	 *
	 * @since 1.5.0
	 */
	public function website_has_forms() {

		return (bool) \wpforms()->form->get( '', array( 'numberposts' => 1 ) );
	}

	/**
	 * Check if Challenge was started.
	 *
	 * @since 1.5.0
	 */
	public function challenge_started() {

		return 'started' === $this->get_challenge_option( 'status' );
	}

	/**
	 * Check if Challenge was finished.
	 *
	 * @since 1.5.0
	 */
	public function challenge_finished() {

		$status = $this->get_challenge_option( 'status' );

		return \in_array( $status, array( 'completed', 'canceled', 'skipped' ), true );
	}

	/**
	 * Check if Challenge is in progress.
	 *
	 * @since 1.5.0
	 */
	public function challenge_active() {

		return $this->challenge_started() && ! $this->challenge_finished();
	}

	/**
	 * Check if Challenge can be started.
	 *
	 * @since 1.5.0
	 */
	public function challenge_can_start() {

		if ( $this->website_has_forms() ) {
			return false;
		}

		if ( $this->challenge_started() || $this->challenge_finished() ) {
			return false;
		}

		return true;
	}

	/**
	 * Start the Challenge in Form Builder.
	 *
	 * @since 1.5.0
	 */
	public function start_challenge() {

		if ( ! isset( $_GET['challenge'] ) || 'start' !== $_GET['challenge'] ) {
			return;
		}

		if ( ! $this->challenge_can_start() ) {
			return;
		}

		$this->set_challenge_option(
			array(
				'status'           => 'started',
				'started_date_gmt' => \current_time( 'mysql', true ),
			)
		);

		\wp_safe_redirect( \remove_query_arg( 'challenge' ) );
	}

	/**
	 * Include Challenge HTML.
	 *
	 * @since 1.5.0
	 */
	public function challenge_html() {

		if ( $this->challenge_finished() ) {
			return;
		}

		if ( \wpforms_is_admin_page() && ! \wpforms_is_admin_page( 'getting-started' ) && $this->challenge_can_start() ) {
			$this->challenge_modal_html( 'start' );
		}

		if ( $this->is_builder_page() ) {
			$this->challenge_modal_html( 'progress' );
			$this->challenge_builder_templates_html();
		}

		if ( $this->is_form_embed_page() ) {
			$this->challenge_modal_html( 'progress' );
			$this->challenge_embed_templates_html();
		}

	}

	/**
	 * Include Challenge main modal window HTML.
	 *
	 * @since 1.5.0
	 *
	 * @param string $state State of Challenge ('start' or 'progress').
	 */
	public function challenge_modal_html( $state ) {

		?>
		<div class="wpforms-challenge <?php echo 'start' === $state ? \esc_attr( 'wpforms-challenge-start' ) : ''; ?>"
			data-wpforms-challenge-saved-step="<?php echo \absint( $this->get_challenge_option( 'step' ) ); ?>">

			<div class="wpforms-challenge-list-block">
				<p>
					<?php
					echo \wp_kses(
						\sprintf(
							/* translators: %1$d - Number of minutes; %2$s - Single or plural word 'minute'. */
							\__( 'Complete the <b>WPForms Challenge</b> and get up and running within %1$d&nbsp;%2$s.', 'wpforms-lite' ),
							\absint( $this->minutes ),
							\_n( 'minute', 'minutes', \absint( $this->minutes ), 'wpforms-lite' )
						),
						array( 'b' => array() )
					);
					?>
				</p>

				<div class="wpforms-challenge-bar">
					<div></div>
				</div>

				<ul class="wpforms-challenge-list">
					<li class="wpforms-challenge-step1-item"><?php \esc_html_e( 'Name Your Form', 'wpforms-lite' ); ?></li>
					<li class="wpforms-challenge-step2-item"><?php \esc_html_e( 'Select a Template', 'wpforms-lite' ); ?></li>
					<li class="wpforms-challenge-step3-item"><?php \esc_html_e( 'Add Fields to Your Form', 'wpforms-lite' ); ?></li>
					<li class="wpforms-challenge-step4-item"><?php \esc_html_e( 'Check Notification Settings', 'wpforms-lite' ); ?></li>
					<li class="wpforms-challenge-step5-item"><?php \esc_html_e( 'Embed in a Page', 'wpforms-lite' ); ?></li>
				</ul>

				<?php if ( 'start' === $state ) : ?>
					<a href="<?php echo \esc_url( \admin_url( 'admin.php?page=wpforms-builder&challenge=start' ) ); ?>" class="wpforms-btn wpforms-btn-md wpforms-btn-orange wpforms-challenge-start">
						<?php \esc_html_e( 'Start Challenge', 'wpforms-lite' ); ?>
					</a>
					<a href="javascript:void(0);" class="wpforms-challenge-skip"><?php \esc_html_e( 'Skip Challenge', 'wpforms-lite' ); ?></a>
				<?php endif; ?>

				<?php if ( 'progress' === $state ) : ?>
					<a href="javascript:void(0);" class="wpforms-challenge-cancel"><?php \esc_html_e( 'Cancel Challenge', 'wpforms-lite' ); ?></a>
				<?php endif; ?>
			</div>

			<div class="block-timer">
				<img src="<?php echo \esc_url( \WPFORMS_PLUGIN_URL . 'assets/images/challenge/sullie-circle.png' ); ?>" alt="<?php \esc_html_e( 'Sullie the WPForms mascot', 'wpforms-lite' ); ?>">
				<div>
					<h3><?php \esc_html_e( 'WPForms Challenge', 'wpforms-lite' ); ?></h3>
					<p>
						<?php
						printf(
							/* translators: %s - minutes in 2:00 format. */
							esc_html__( '%s remaining', 'wpforms-lite' ),
							'<span id="wpforms-challenge-timer">' . \absint( $this->minutes ) .':00</span>'
						);
						?>
					</p>
				</div>
				<div class="caret-icon">
					<i class="fa fa-caret-down"></i>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Include Challenge HTML templates specific to Form Builder.
	 *
	 * @since 1.5.0
	 */
	public function challenge_builder_templates_html() {

		?>
		<div class="wpforms-challenge-tooltips">

			<div id="tooltip-content1">
				<h3><?php \esc_html_e( 'Name Your Form', 'wpforms-lite' ); ?></h3>
				<p><?php \esc_html_e( 'Give your form a name so you can easily identify it.', 'wpforms-lite' ); ?></p>
				<button type="button" class="wpforms-challenge-step1-done wpforms-challenge-done-btn"><?php \esc_html_e( 'Done', 'wpforms-lite' ); ?></button>
			</div>

			<div id="tooltip-content2">
				<h3><?php \esc_html_e( 'Select a Template', 'wpforms-lite' ); ?></h3>
				<p><?php \esc_html_e( 'Build your form from scratch or use one of our pre-made templates.', 'wpforms-lite' ); ?></p>
			</div>

			<div id="tooltip-content3">
				<h3><?php \esc_html_e( 'Add Fields to Your Form', 'wpforms-lite' ); ?></h3>
				<p><?php \esc_html_e( 'You can add additional fields to your form, if you need them. This step is optional.', 'wpforms-lite' ); ?></p>
				<button type="button" class="wpforms-challenge-step3-done wpforms-challenge-done-btn"><?php \esc_html_e( 'Done', 'wpforms-lite' ); ?></button>
			</div>

			<div id="tooltip-content4">
				<h3><?php \esc_html_e( 'Check Notification Settings', 'wpforms-lite' ); ?></h3>
				<p><?php \esc_html_e( 'The default notification settings might be sufficient, but double&#8209;check to be sure.', 'wpforms-lite' ); ?></p>
				<button type="button" class="wpforms-challenge-step4-done wpforms-challenge-done-btn"><?php \esc_html_e( 'Done', 'wpforms-lite' ); ?></button>
			</div>

		</div>
		<?php
	}

	/**
	 * Include Challenge HTML templates specific to form embed page.
	 *
	 * @since 1.5.0
	 */
	public function challenge_embed_templates_html() {

		?>
		<div class="wpforms-challenge-tooltips">

			<div id="tooltip-content5">
				<?php if ( \function_exists( 'register_block_type' ) ) : // Gutenberg content. ?>
					<h3><?php \esc_html_e( 'Add a Block', 'wpforms-lite' ); ?></h3>
					<p><?php \esc_html_e( 'Click the “Add Block” button, search WPForms, select block to embed.', 'wpforms-lite' ); ?></p>
				<?php else : ?>
					<h3><?php \esc_html_e( 'Embed in a Page', 'wpforms-lite' ); ?></h3>
					<p><?php \esc_html_e( 'Click the “Add Form” button, select your form, then add the embed code.', 'wpforms-lite' ); ?></p>
				<?php endif; ?>
				<button type="button" class="wpforms-challenge-step5-done wpforms-challenge-done-btn"><?php \esc_html_e( 'Done', 'wpforms-lite' ); ?></button>
			</div>
		</div>

		<div class="wpforms-challenge-popup-container">
			<div id="wpforms-challenge-congrats-popup" class="wpforms-challenge-popup">
				<div class="wpforms-challenge-popup-header wpforms-challenge-popup-header-congrats">
					<i class="wpforms-challenge-popup-close fa fa-times-circle fa-lg"></i>
				</div>
				<div class="wpforms-challenge-popup-content">
					<h3><?php \esc_html_e( 'Congrats, you did it!', 'wpforms-lite' ); ?></h3>
					<p>
						<?php
						echo \wp_kses(
							\sprintf(
								/* translators: %1$s - Number of minutes in HTML container; %2$s - Single or plural word 'minute'; %3$s - Number of seconds in HTML container; %4$s - Single or plural word 'second'; %5$s - 5 rating star symbols HTML. */
								\__( 'You completed the WPForms Challenge in <b>%1$s %2$s %3$s %4$s</b>. Share your success story with other WPForms users and help us spread the word <b>by giving WPForms a 5-star rating (%5$s) on WordPress.org</b>. Thanks for your support and we look forward to bringing more awesome features.', 'wpforms-lite' ),
								'<span id="wpforms-challenge-congrats-minutes"></span>',
								\_n( 'minute', 'minutes', \absint( $this->minutes ), 'wpforms-lite' ),
								'<span id="wpforms-challenge-congrats-seconds"></span>',
								\_n( 'second', 'seconds', \absint( $this->minutes ), 'wpforms-lite' ),
								'<span class="rating-stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>'
							),
							array(
								'span' => array(
									'id'    => array(),
									'class' => array(),
								),
								'b'    => array(),
								'i'    => array(
									'class' => array(),
								),
							)
						);
						?>
					</p>
					<a href="https://wordpress.org/support/plugin/wpforms-lite/reviews/?filter=5#new-post" class="wpforms-challenge-popup-btn wpforms-challenge-popup-rate-btn" target="_blank" rel="noopener"><?php \esc_html_e( 'Rate WPForms on WordPress.org', 'wpforms-lite' ); ?>
						<span class="dashicons dashicons-external"></span></a>
				</div>
			</div>

			<div id="wpforms-challenge-contact-popup" class="wpforms-challenge-popup">
				<div class="wpforms-challenge-popup-header wpforms-challenge-popup-header-contact">
					<i class="wpforms-challenge-popup-close fa fa-times-circle fa-lg"></i>
				</div>
				<div class="wpforms-challenge-popup-content">
					<form id="wpforms-challenge-contact-form">
						<h3><?php \esc_html_e( 'Help us improve WPForms', 'wpforms-lite' ); ?></h3>
						<p>
							<?php
							echo \esc_html(
								\sprintf(
									/* translators: %1$d - Number of minutes; %2$s - Single or plural word 'minute'. */
									\__( 'We`re sorry that it took longer than %1$d %2$s to create a form. Our goal is to create the most beginner friendly WordPress form plugin. Please take a moment to let us know how we can improve WPForms.', 'wpforms-lite' ),
									\absint( $this->minutes ),
									\_n( 'minute', 'minutes', \absint( $this->minutes ), 'wpforms-lite' )
								)
							);
							?>
						</p>
						<textarea class="wpforms-challenge-contact-message"></textarea>
						<label>
							<input type="checkbox" class="wpforms-challenge-contact-permission"><?php \esc_html_e( 'Yes, I give WPForms permission to contact me for any follow up questions.', 'wpforms-lite' ); ?>
						</label>
						<button type="submit" class="wpforms-challenge-popup-btn wpforms-challenge-popup-contact-btn"><?php \esc_html_e( 'Submit Feedback', 'wpforms-lite' ); ?></button>
					</form>
				</div>
			</div>
		</div>

		<?php
	}

	/**
	 * Include Challenge CTA on WPForms welcome activation screen.
	 *
	 * @since 1.5.0
	 */
	public function welcome_html() {

		if ( $this->challenge_finished() ) {
			return;
		}

		?>
		<div class="challenge">
			<div class="block">
				<h1><?php esc_html_e( 'Take the WPForms Challenge', 'wpforms-lite' ); ?></h1>
				<h6><?php esc_html_e( 'Create your first form with our guided setup wizard in less than 5 minutes to experience the WPForms difference.', 'wpforms-lite' ); ?></h6>
				<div class="button-wrap">
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=wpforms-builder&challenge=start' ) ); ?>" class="wpforms-btn wpforms-btn-lg wpforms-btn-orange">
						<?php esc_html_e( 'Start the WPForms Challenge', 'wpforms-lite' ); ?>
					</a>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Get embed page URL via AJAX.
	 *
	 * @since 1.5.0
	 */
	public function get_embed_page_url_ajax() {

		\check_admin_referer( 'wpforms_challenge_ajax_nonce' );

		global $wpdb;

		$page_id = \absint(
			$wpdb->get_var(
				"SELECT ID
					FROM $wpdb->posts
					WHERE post_type = 'page'
					AND post_name LIKE '%contact%';"
			)
		);

		if ( $page_id ) {
			$url = \get_edit_post_link( $page_id, '' );
			$this->set_challenge_option( array( 'embed_page' => $page_id ) );
		} else {
			$url = \add_query_arg( 'post_type', 'page', \admin_url( 'post-new.php' ) );
			$this->set_challenge_option( array( 'embed_page' => 0 ) );
		}

		\wp_send_json_success( $url );
	}

	/**
	 * Save Challenge data via AJAX.
	 *
	 * @since 1.5.0
	 */
	public function save_challenge_option_ajax() {

		\check_admin_referer( 'wpforms_challenge_ajax_nonce' );

		if ( empty( $_POST['option_data'] ) ) {
			\wp_send_json_error();
		}

		$schema = $this->get_challenge_option_schema();

		foreach ( $schema as $key => $value ) {
			if ( ! empty( $_POST['option_data'][ $key ] ) ) {
				$query[ $key ] = \sanitize_text_field( \wp_unslash( $_POST['option_data'][ $key ] ) );
			}
		}

		if ( empty( $query ) ) {
			\wp_send_json_error();
		}

		if ( ! empty( $query['status'] ) && \in_array( $query['status'], array( 'completed', 'canceled', 'skipped' ), true ) ) {
			$query['finished_date_gmt'] = \current_time( 'mysql', true );
		}

		if ( ! empty( $query['status'] ) && 'skipped' === $query['status'] ) {
			$query['started_date_gmt']  = \current_time( 'mysql', true );
			$query['finished_date_gmt'] = $query['started_date_gmt'];
		}

		$this->set_challenge_option( $query );

		\wp_send_json_success();
	}

	/**
	 * Send contact form to wpforms.com via AJAX.
	 *
	 * @since 1.5.0
	 */
	public function send_contact_form_ajax() {

		\check_admin_referer( 'wpforms_challenge_ajax_nonce' );

		$url     = 'https://wpforms.com/wpforms-challenge-feedback/';
		$message = ! empty( $_POST['contact_data']['message'] ) ? \sanitize_textarea_field( \wp_unslash( $_POST['contact_data']['message'] ) ) : '';
		$email   = '';

		if ( ! empty( $_POST['contact_data']['contact_me'] ) && 'true' === $_POST['contact_data']['contact_me'] ) {
			$current_user = \wp_get_current_user();
			$email        = $current_user->user_email;
			$this->set_challenge_option( array( 'feedback_contact_me' => true ) );
		}

		if ( empty( $message ) && empty( $email ) ) {
			\wp_send_json_error();
		}

		$data = array(
			'body' => array(
				'wpforms' => array(
					'id'     => 296355,
					'submit' => 'wpforms-submit',
					'fields' => array(
						2 => $message,
						3 => $email,
					),
				),
			),
		);

		$response = \wp_remote_post( $url, $data );

		if ( \is_wp_error( $response ) ) {
			\wp_send_json_error();
		}

		$this->set_challenge_option( array( 'feedback_sent' => true ) );
		\wp_send_json_success();
	}
}
