<?php

/**
 * About WPForms admin page class.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.5.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2018, WPForms LLC
 */
class WPForms_About {

	/**
	 * Admin menu page slug.
	 *
	 * @since 1.5.0
	 *
	 * @var string
	 */
	const SLUG = 'wpforms-about';

	/**
	 * Default view for a page.
	 *
	 * @since 1.5.0
	 *
	 * @var string
	 */
	const DEFAULT_TAB = 'about';

	/**
	 * Array of license types, that are considered being top level and has no features difference.
	 *
	 * @since 1.5.0
	 *
	 * @var array
	 */
	public static $licenses_top = array( 'pro', 'agency', 'ultimate', 'elite' );

	/**
	 * List of features that licenses are different with.
	 *
	 * @since 1.5.0
	 *
	 * @var array
	 */
	public static $licenses_features = array();

	/**
	 * The current active tab.
	 *
	 * @since 1.5.0
	 *
	 * @var string
	 */
	public $view;

	/**
	 * The core views.
	 *
	 * @since 1.5.0
	 *
	 * @var array
	 */
	public $views = array();

	/**
	 * Primary class constructor.
	 *
	 * @since 1.5.0
	 */
	public function __construct() {

		// In old PHP we can't define this elsewhere.
		self::$licenses_features = array(
			'entries'      => esc_html__( 'Form Entries', 'wpforms-lite' ),
			'fields'       => esc_html__( 'Form Fields', 'wpforms-lite' ),
			'templates'    => esc_html__( 'Form Templates', 'wpforms-lite' ),
			'conditionals' => esc_html__( 'Smart Conditional Logic', 'wpforms-lite' ),
			'marketing'    => esc_html__( 'Marketing Integrations', 'wpforms-lite' ),
			'payments'     => esc_html__( 'Payment Forms', 'wpforms-lite' ),
			'surveys'      => esc_html__( 'Surveys & Polls', 'wpforms-lite' ),
			'advanced'     => esc_html__( 'Advanced Form Features', 'wpforms-lite' ),
			'addons'       => esc_html__( 'WPForms Addons', 'wpforms-lite' ),
			'support'      => esc_html__( 'Customer Support', 'wpforms-lite' ),
			'sites'        => esc_html__( 'Number of Sites', 'wpforms-lite' ),
		);

		// Maybe load tools page.
		add_action( 'admin_init', array( $this, 'init' ) );
	}

	/**
	 * Determining if the user is viewing the our page, if so, party on.
	 *
	 * @since 1.5.0
	 */
	public function init() {

		// Check what page we are on.
		$page = isset( $_GET['page'] ) ? $_GET['page'] : '';

		// Only load if we are actually on the settings page.
		if ( self::SLUG !== $page ) {
			return;
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueues' ) );

		/*
		 * Define the core views for the our tab.
		 */
		$this->views = apply_filters(
			'wpforms_admin_about_views',
			array(
				esc_html__( 'About Us', 'wpforms-lite' )        => array( 'about' ),
				esc_html__( 'Getting Started', 'wpforms-lite' ) => array( 'getting-started' ),
			)
		);

		$license = $this->get_license_type();

		if (
			(
				$license === 'pro' ||
				! in_array( $license, self::$licenses_top, true )
			) ||
			wpforms_debug()
		) {
			$vs_tab_name = sprintf( /* translators: %1$s - current license type, %2$s - suggested license type. */
				esc_html__( '%1$s vs %2$s', 'wpforms-lite' ),
				ucfirst( $license ),
				$this->get_next_license( $license )
			);

			$this->views[ $vs_tab_name ] = array( 'versus' );
		}

		// Determine the current active settings tab.
		$this->view = ! empty( $_GET['view'] ) ? esc_html( $_GET['view'] ) : self::DEFAULT_TAB;

		// If the user tries to load an invalid view - fallback to About Us.
		if (
			! in_array( $this->view, call_user_func_array( 'array_merge', $this->views ), true ) &&
			! has_action( 'wpforms_admin_about_display_tab_' . sanitize_key( $this->view ) )
		) {
			$this->view = self::DEFAULT_TAB;
		}

		add_action( 'wpforms_admin_page', array( $this, 'output' ) );

		// Hook for addons.
		do_action( 'wpforms_admin_about_init' );
	}

	/**
	 * Enqueue assets for the the page.
	 *
	 * @since 1.5.0
	 */
	public function enqueues() {

		wp_enqueue_script(
			'jquery-matchheight',
			WPFORMS_PLUGIN_URL . 'assets/js/jquery.matchHeight-min.js',
			array( 'jquery' ),
			'0.7.0',
			false
		);
	}

	/**
	 * Output the basic page structure.
	 *
	 * @since 1.5.0
	 */
	public function output() {

		$show_nav = false;
		foreach ( $this->views as $view ) {
			if ( in_array( $this->view, (array) $view, true ) ) {
				$show_nav = true;
				break;
			}
		}
		?>

		<div id="wpforms-admin-about" class="wrap wpforms-admin-wrap">

			<?php
			if ( $show_nav ) {
				$license      = $this->get_license_type();
				$next_license = $this->get_next_license( $license );
				echo '<ul class="wpforms-admin-tabs">';
				foreach ( $this->views as $label => $view ) {
					$class = in_array( $this->view, $view, true ) ? 'active' : '';
					echo '<li>';
					printf(
						'<a href="%s" class="%s">%s</a>',
						esc_url( admin_url( 'admin.php?page=' . self::SLUG . '&view=' . sanitize_key( $view[0] ) ) ),
						esc_attr( $class ),
						esc_html( $label )
					);
					echo '</li>';
				}
				echo '</ul>';
			}
			?>

			<h1 class="wpforms-h1-placeholder"></h1>

			<?php
			switch ( $this->view ) {
				case 'about':
					$this->output_about();
					break;
				case 'getting-started':
					$this->output_getting_started();
					break;
				case 'versus':
					$this->output_versus();
					break;
				default:
					do_action( 'wpforms_admin_about_display_tab_' . sanitize_key( $this->view ) );
					break;
			}
			?>

		</div>

		<?php
	}

	/**
	 * Display the About tab content.
	 *
	 * @since 1.5.0
	 */
	protected function output_about() {

		$all_plugins = get_plugins();
		$am_plugins  = $this->get_am_plugins();
		?>

		<div class="wpforms-admin-about-section wpforms-admin-columns">

			<div class="wpforms-admin-column-60">
				<h3>
					<?php esc_html_e( 'Hello and welcome to WPForms, the most beginner friendly drag & drop WordPress forms plugin. At WPForms, we build software that helps you create beautiful responsive online forms for your website in minutes.', 'wpforms-lite' ); ?>
				</h3>

				<p>
					<?php esc_html_e( 'Over the years, we found that most WordPress contact form plugins were bloated, buggy, slow, and very hard to use. So we started with a simple goal: build a WordPress forms plugin that’s both easy and powerful.', 'wpforms-lite' ); ?>
				</p>
				<p>
					<?php esc_html_e( 'Our goal is to take the pain out of creating online forms and make it easy.', 'wpforms-lite' ); ?>
				</p>
				<p>
					<?php
					printf(
						wp_kses(
							/* translators: %1$s - WPBeginner URL, %2$s - OptinMonster URL, %3$s - MonsterInsights URL. */
							__( 'WPForms is brought to you by the same team that’s behind the largest WordPress resource site, <a href="%1$s" target="_blank" rel="noopener noreferrer">WPBeginner</a>, the most popular lead-generation software, <a href="%2$s" target="_blank" rel="noopener noreferrer">OptinMonster</a>, and the best WordPress analytics plugin, <a href="%3$s" target="_blank" rel="noopener noreferrer">MonsterInsights</a>.', 'wpforms-lite' ),
							array(
								'a' => array(
									'href'   => array(),
									'rel'    => array(),
									'target' => array(),
								),
							)
						),
						'https://www.wpbeginner.com/?utm_source=wpformsplugin&utm_medium=pluginaboutpage&utm_campaign=aboutwpforms',
						'https://optinmonster.com/?utm_source=wpformsplugin&utm_medium=pluginaboutpage&utm_campaign=aboutwpforms',
						'https://www.monsterinsights.com/?utm_source=wpformsplugin&utm_medium=pluginaboutpage&utm_campaign=aboutwpforms'
					);
					?>
				</p>
				<p>
					<?php esc_html_e( 'Yup, we know a thing or two about building awesome products that customers love.', 'wpforms-lite' ); ?>
				</p>
			</div>

			<div class="wpforms-admin-column-40 wpforms-admin-column-last">
				<figure>
					<img src="<?php echo WPFORMS_PLUGIN_URL; ?>assets/images/about/team.jpg" alt="<?php esc_attr_e( 'The WPForms Team photo', 'wpforms-lite' ); ?>">
					<figcaption>
						<?php esc_html_e( 'The WPForms Team', 'wpforms-lite' ); ?><br>
					</figcaption>
				</figure>
			</div>

		</div>

		<div id="wpforms-admin-addons">
			<div class="addons-container">
				<?php
				foreach ( $am_plugins as $plugin => $details ) :

					$have_pro = ( ! empty( $details['pro'] ) && ! empty( $details['pro']['plug'] ) );
					$show_pro = false;
					if ( $have_pro ) {
						if ( array_key_exists( $plugin, $all_plugins ) ) {
							if ( is_plugin_active( $plugin ) ) {
								$show_pro = true;
							}
						}
						if ( array_key_exists( $details['pro']['plug'], $all_plugins ) ) {
							$show_pro = true;
						}
						if ( $show_pro ) {
							$plugin  = $details['pro']['plug'];
							$details = $details['pro'];
						}
					}

					if ( array_key_exists( $plugin, $all_plugins ) ) {
						if ( is_plugin_active( $plugin ) ) {
							// Status text/status.
							$status_class = 'status-active';
							$status_text  = esc_html__( 'Active', 'wpforms-lite' );
							// Button text/status.
							$action_class = $status_class . ' button button-secondary disabled';
							$action_text  = esc_html__( 'Activated', 'wpforms-lite' );
							$plugin_src   = esc_attr( $plugin );
						} else {
							// Status text/status.
							$status_class = 'status-inactive';
							$status_text  = esc_html__( 'Inactive', 'wpforms-lite' );
							// Button text/status.
							$action_class = $status_class . ' button button-secondary';
							$action_text  = esc_html__( 'Activate', 'wpforms-lite' );
							$plugin_src   = esc_attr( $plugin );
						}
					} else {
						// Doesn't exist, install.
						// Status text/status.
						$status_class = 'status-download';
						if ( isset( $details['act'] ) && 'go-to-url' === $details['act'] ) {
							$status_class = 'status-go-to-url';
						}
						$status_text = esc_html__( 'Not Installed', 'wpforms-lite' );
						// Button text/status.
						$action_class = $status_class . ' button button-primary';
						$action_text  = esc_html__( 'Install Plugin', 'wpforms-lite' );
						$plugin_src   = esc_url( $details['url'] );
					}
					?>
					<div class="addon-container">
						<div class="addon-item">
							<div class="details wpforms-clear">
								<img src="<?php echo esc_url( $details['icon'] ); ?>">
								<h5 class="addon-name">
									<?php echo $details['name']; ?>
								</h5>
								<p class="addon-desc">
									<?php echo $details['desc']; ?>
								</p>
							</div>
							<div class="actions wpforms-clear">
								<div class="status">
									<strong>
										<?php
										printf(
											/* translators: %s - addon status label. */
											esc_html__( 'Status: %s', 'wpforms-lite' ),
											'<span class="status-label ' . $status_class . '">' . $status_text . '</span>'
										);
										?>
									</strong>
								</div>
								<div class="action-button">
									<button class="<?php echo esc_attr( $action_class ); ?>" data-plugin="<?php echo $plugin_src; ?>" data-type="plugin">
										<?php echo $action_text; ?>
									</button>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<?php
	}

	/**
	 * Display the Getting Started tab content.
	 *
	 * @since 1.5.0
	 */
	protected function output_getting_started() {

		$license = $this->get_license_type();
		?>

		<div class="wpforms-admin-about-section wpforms-admin-about-section-first-form" style="display:flex;">

			<div class="wpforms-admin-about-section-first-form-text">

				<h2>
					<?php esc_html_e( 'Creating Your First Form', 'wpforms-lite' ); ?>
				</h2>

				<p>
					<?php esc_html_e( 'Want to get started creating your first form with WPForms? By following the step by step instructions in this walkthrough, you can easily publish your first form on your site.', 'wpforms-lite' ); ?>
				</p>

				<p>
					<?php esc_html_e( 'To begin, you’ll need to be logged into the WordPress admin area. Once there, click on WPForms in the admin sidebar to go the Forms Overview page.', 'wpforms-lite' ); ?>
				</p>

				<p>
					<?php esc_html_e( 'In the Forms Overview page, the forms list will be empty because there are no forms yet. To create a new form, click on the Add New button, and this will launch the WPForms Form Builder.', 'wpforms-lite' ); ?>
				</p>

				<ul class="list-plain">
					<li>
						<a href="https://wpforms.com/docs/creating-first-form/?utm_source=WordPress&utm_medium=wpforms-about-page&utm_campaign=gettingstarted#add-new" target="_blank" rel="noopener noreferrer">
							<?php esc_html_e( 'How to Add a New Form', 'wpforms-lite' ); ?>
						</a>
					</li>
					<li>
						<a href="https://wpforms.com/docs/creating-first-form/?utm_source=WordPress&utm_medium=wpforms-about-page&utm_campaign=gettingstarted#customize-fields" target="_blank" rel="noopener noreferrer">
							<?php esc_html_e( 'How to Customize Form Fields', 'wpforms-lite' ); ?>
						</a>
					</li>
					<li>
						<a href="https://wpforms.com/docs/creating-first-form/?utm_source=WordPress&utm_medium=wpforms-about-page&utm_campaign=gettingstarted#display-form" target="_blank" rel="noopener noreferrer">
							<?php esc_html_e( 'How to Display Forms on Your Site', 'wpforms-lite' ); ?>
						</a>
					</li>
				</ul>

			</div>

			<div class="wpforms-admin-about-section-first-form-video">
				<iframe src="https://www.youtube-nocookie.com/embed/yDyvSGV7tP4?rel=0" width="540" height="304" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			</div>

		</div>

		<?php if ( ! in_array( $license, self::$licenses_top, true ) ) { ?>
			<div class="wpforms-admin-about-section wpforms-admin-about-section-hero">

				<div class="wpforms-admin-about-section-hero-main">
					<h2>
						<?php esc_html_e( 'Get WPForms Pro and Unlock all the Powerful Features', 'wpforms-lite' ); ?>
					</h2>

					<p class="bigger">
						<?php
						echo wp_kses(
							__( 'Thanks for being a loyal WPForms Lite user. <strong>Upgrade to WPForms Pro</strong> to unlock all the awesome features and experience<br>why WPForms is consistently rated the best WordPress form builder.', 'wpforms-lite' ),
							array(
								'br'     => array(),
								'strong' => array(),
							)
						);
						?>
					</p>

					<p>
						<?php
						printf(
							wp_kses(
								/* translators: %s - stars. */
								__( 'We know that you will truly love WPForms. It has over <strong>5000+ five star ratings</strong> (%s) and is active on over 1 million websites.', 'wpforms-lite' ),
								array(
									'strong' => array(),
								)
							),
							'<i class="fa fa-star" aria-hidden="true"></i>' .
							'<i class="fa fa-star" aria-hidden="true"></i>' .
							'<i class="fa fa-star" aria-hidden="true"></i>' .
							'<i class="fa fa-star" aria-hidden="true"></i>' .
							'<i class="fa fa-star" aria-hidden="true"></i>'
						);
						?>
					</p>
				</div>

				<div class="wpforms-admin-about-section-hero-extra">
					<div class="wpforms-admin-columns">
						<div class="wpforms-admin-column-50">
							<ul class="list-features list-plain">
								<li>
									<i class="fa fa-check" aria-hidden="true"></i>
									<?php esc_html_e( 'Entry Management - view all leads in one place.', 'wpforms-lite' ); ?>
								</li>
								<li>
									<i class="fa fa-check" aria-hidden="true"></i>
									<?php esc_html_e( 'All form features like file upload, pagination, etc.', 'wpforms-lite' ); ?>
								</li>
								<li>
									<i class="fa fa-check" aria-hidden="true"></i>
									<?php esc_html_e( 'Create surveys & polls with the surveys addon.', 'wpforms-lite' ); ?>
								</li>
								<li>
									<i class="fa fa-check" aria-hidden="true"></i>
									<?php esc_html_e( 'WordPress user registration and login forms.', 'wpforms-lite' ); ?>
								</li>
								<li>
									<i class="fa fa-check" aria-hidden="true"></i>
									<?php esc_html_e( 'Create payment forms with Stripe and PayPal.', 'wpforms-lite' ); ?>
								</li>
							</ul>
						</div>
						<div class="wpforms-admin-column-50 wpforms-admin-column-last">
							<ul class="list-features list-plain">
								<li>
									<i class="fa fa-check" aria-hidden="true"></i>
									<?php esc_html_e( 'Powerful Conditional Logic so you can create smart forms.', 'wpforms-lite' ); ?>
								</li>
								<li>
									<i class="fa fa-check" aria-hidden="true"></i>
									<?php esc_html_e( '500+ integrations with different marketing & payment services.', 'wpforms-lite' ); ?>
								</li>
								<li>
									<i class="fa fa-check" aria-hidden="true"></i>
									<?php esc_html_e( 'Collect signatures, geo-location data, and more.', 'wpforms-lite' ); ?>
								</li>
								<li>
									<i class="fa fa-check" aria-hidden="true"></i>
									<?php esc_html_e( 'Accept user submitted content with Post Submissions addon.', 'wpforms-lite' ); ?>
								</li>
								<li>
									<i class="fa fa-check" aria-hidden="true"></i>
									<?php esc_html_e( 'Bonus form templates, form abandonment, and more.', 'wpforms-lite' ); ?>
								</li>
							</ul>
						</div>
					</div>

					<hr />

					<h3 class="call-to-action">
						<?php
						if ( 'lite' === $license ) {
							echo '<a href="' . wpforms_admin_upgrade_link( 'wpforms-about-page' ) . '" target="_blank" rel="noopener noreferrer">';
						} else {
							echo '<a href="https://wpforms.com/pricing?utm_source=WordPress&utm_medium=wpforms-about-page&utm_campaign=gettingstarted" target="_blank" rel="noopener noreferrer">';
						}
							 esc_html_e( 'Get WPForms Pro Today and Unlock all the Powerful Features', 'wpforms-lite' );
						?>
						</a>
					</h3>

					<?php if ( 'lite' === $license ) { ?>
						<p>
							<?php
							echo wp_kses(
								__( 'Bonus: WPForms Lite users get <span class="price-20-off">50% off regular price</span>, automatically applied at checkout.', 'wpforms-lite' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							);
							?>
						</p>
					<?php } ?>
				</div>

			</div>
		<?php } ?>

		<div class="wpforms-admin-about-section wpforms-admin-about-section-squashed wpforms-admin-about-section-post wpforms-admin-columns">
			<div class="wpforms-admin-column-20">
				<img src="<?php echo WPFORMS_PLUGIN_URL; ?>assets/images/about/how-choose-right-form-field.png" alt="">
			</div>
			<div class="wpforms-admin-column-80">
				<h2>
					<?php esc_html_e( 'How to Choose the Right Form Field', 'wpforms-lite' ); ?>
				</h2>

				<p>
					<?php esc_html_e( 'Are you wondering which form fields you have access to in WPForms and what each field does? WPForms has lots of field types to make creating and filling out forms easy. In this tutorial, we’ll cover all of the fields available in WPForms.', 'wpforms-lite' ); ?>
				</p>

				<a href="https://wpforms.com/docs/how-to-choose-the-right-form-field-for-your-forms/?utm_source=WordPress&utm_medium=wpforms-about-page&utm_campaign=gettingstarted" target="_blank" rel="noopener noreferrer" class="wpforms-admin-about-section-post-link">
					<?php esc_html_e( 'Read Documentation', 'wpforms-lite' ); ?><i class="fa fa-external-link" aria-hidden="true"></i>
				</a>
			</div>
		</div>

		<div class="wpforms-admin-about-section wpforms-admin-about-section-squashed wpforms-admin-about-section-post wpforms-admin-columns">
			<div class="wpforms-admin-column-20">
				<img src="<?php echo WPFORMS_PLUGIN_URL; ?>assets/images/about/complete-guide-to-wpforms-settings.png" alt="">
			</div>
			<div class="wpforms-admin-column-80">
				<h2>
					<?php esc_html_e( 'A Complete Guide to WPForms Settings', 'wpforms-lite' ); ?>
				</h2>

				<p>
					<?php esc_html_e( 'Would you like to learn more about all of the settings available in WPForms? In addition to tons of customization options within the form builder, WPForms has an extensive list of plugin-wide options available. This includes choosing your currency, adding GDPR enhancements, setting up integrations.', 'wpforms-lite' ); ?>
				</p>

				<a href="https://wpforms.com/docs/a-complete-guide-to-wpforms-settings/?utm_source=WordPress&utm_medium=wpforms-about-page&utm_campaign=gettingstarted" target="_blank" rel="noopener noreferrer" class="wpforms-admin-about-section-post-link">
					<?php esc_html_e( 'Read Documentation', 'wpforms-lite' ); ?><i class="fa fa-external-link" aria-hidden="true"></i>
				</a>
			</div>
		</div>

		<div class="wpforms-admin-about-section wpforms-admin-about-section-squashed wpforms-admin-about-section-post wpforms-admin-columns">
			<div class="wpforms-admin-column-20">
				<img src="<?php echo WPFORMS_PLUGIN_URL; ?>assets/images/about/how-create-gdpr-compliant-forms.png" alt="">
			</div>
			<div class="wpforms-admin-column-80">
				<h2>
					<?php esc_html_e( 'How to Create GDPR Compliant Forms', 'wpforms-lite' ); ?>
				</h2>

				<p>
					<?php esc_html_e( 'Do you need to check that your forms are compliant with the European Union’s General Data Protection Regulation? The best way to ensure GDPR compliance for your specific site is always to consult legal counsel. In this guide, we’ll discuss general considerations for GDPR compliance in your WordPress forms.', 'wpforms-lite' ); ?>
				</p>

				<a href="https://wpforms.com/docs/how-to-create-gdpr-compliant-forms/?utm_source=WordPress&utm_medium=wpforms-about-page&utm_campaign=gettingstarted" target="_blank" rel="noopener noreferrer" class="wpforms-admin-about-section-post-link">
					<?php esc_html_e( 'Read Documentation', 'wpforms-lite' ); ?><i class="fa fa-external-link" aria-hidden="true"></i>
				</a>
			</div>
		</div>

		<div class="wpforms-admin-about-section wpforms-admin-about-section-squashed wpforms-admin-about-section-post wpforms-admin-columns">
			<div class="wpforms-admin-column-20">
				<img src="<?php echo WPFORMS_PLUGIN_URL; ?>assets/images/about/how-install-activate-wpforms-addons.png" alt="">
			</div>
			<div class="wpforms-admin-column-80">
				<h2>
					<?php esc_html_e( 'How to Install and Activate WPForms Addons', 'wpforms-lite' ); ?>
				</h2>

				<p>
					<?php esc_html_e( 'Would you like to access WPForms addons to extend the functionality of your forms? The first thing you need to do is install WPForms. Once that’s done, let’s go ahead and look at the process of activating addons.', 'wpforms-lite' ); ?>
				</p>

				<a href="https://wpforms.com/docs/install-activate-wpforms-addons/?utm_source=WordPress&utm_medium=wpforms-about-page&utm_campaign=gettingstarted" target="_blank" rel="noopener noreferrer" class="wpforms-admin-about-section-post-link">
					<?php esc_html_e( 'Read Documentation', 'wpforms-lite' ); ?><i class="fa fa-external-link" aria-hidden="true"></i>
				</a>
			</div>
		</div>

		<?php
	}

	/**
	 * Get the next license type. Helper for Versus tab content.
	 *
	 * @since 1.5.5
	 *
	 * @param string $current Current license type slug.
	 *
	 * @return string Next license type slug.
	 */
	protected function get_next_license( $current ) {

		$current       = ucfirst( $current );
		$license_pairs = array(
			'Lite'  => 'Pro',
			'Basic' => 'Pro',
			'Plus'  => 'Pro',
			'Pro'   => 'Elite',
		);

		return ! empty( $license_pairs[ $current ] ) ? $license_pairs[ $current ] : 'Elite';
	}

	/**
	 * Display the Versus tab content.
	 *
	 * @since 1.5.0
	 */
	protected function output_versus() {

		$license      = $this->get_license_type();
		$next_license = $this->get_next_license( $license );
		?>

		<div class="wpforms-admin-about-section wpforms-admin-about-section-squashed">
			<h1 class="centered">
				<strong><?php echo esc_html( ucfirst( $license ) ); ?></strong> vs <strong><?php echo esc_html( $next_license ); ?></strong>
			</h1>

			<p class="centered">
				<?php esc_html_e( 'Get the most out of WPForms by upgrading to Pro and unlocking all of the powerful features.', 'wpforms-lite' ); ?>
			</p>
		</div>

		<div class="wpforms-admin-about-section wpforms-admin-about-section-squashed wpforms-admin-about-section-hero wpforms-admin-about-section-table">

			<div class="wpforms-admin-about-section-hero-main wpforms-admin-columns">
				<div class="wpforms-admin-column-33">
					<h3 class="no-margin">
						<?php esc_html_e( 'Feature', 'wpforms-lite' ); ?>
					</h3>
				</div>
				<div class="wpforms-admin-column-33">
					<h3 class="no-margin">
						<?php echo esc_html( ucfirst( $license ) ); ?>
					</h3>
				</div>
				<div class="wpforms-admin-column-33">
					<h3 class="no-margin">
						<?php echo esc_html( $next_license ); ?>
					</h3>
				</div>
			</div>
			<div class="wpforms-admin-about-section-hero-extra no-padding wpforms-admin-columns">

				<table>
					<?php
					foreach ( self::$licenses_features as $slug => $name ) {
						$current = $this->get_license_data( $slug, $license );
						$next    = $this->get_license_data( $slug, strtolower( $next_license ) );

						if ( empty( $current ) || empty( $next ) ) {
							continue;
						}
						?>
						<tr class="wpforms-admin-columns">
							<td class="wpforms-admin-column-33">
								<p><?php echo esc_html( $name ); ?></p>
							</td>
							<td class="wpforms-admin-column-33">
								<?php if ( is_array( $current ) ) : ?>
									<p class="features-<?php echo esc_attr( $current['status'] ); ?>">
										<?php echo implode( '<br>', $current['text'] ); ?>
									</p>
								<?php endif; ?>
							</td>
							<td class="wpforms-admin-column-33">
								<?php if ( is_array( $current ) ) : ?>
									<p class="features-full">
										<?php echo implode( '<br>', $next['text'] ); ?>
									</p>
								<?php endif; ?>
							</td>
						</tr>
						<?php
					}
					?>
				</table>

			</div>

		</div>

		<div class="wpforms-admin-about-section wpforms-admin-about-section-hero">
			<div class="wpforms-admin-about-section-hero-main no-border">
				<h3 class="call-to-action centered">
					<?php
					if ( 'lite' === $license ) {
						echo '<a href="' . esc_url( wpforms_admin_upgrade_link( 'wpforms-about-page' ) ) . '" target="_blank" rel="noopener noreferrer">';
					} else {
						echo '<a href="https://wpforms.com/pricing?utm_source=WordPress&utm_medium=wpforms-about-page&utm_campaign=gettingstarted" target="_blank" rel="noopener noreferrer">';
					}
						printf( /* translators: %s - next license level. */
							esc_html__( 'Get WPForms %s Today and Unlock all the Powerful Features', 'wpforms-lite' ),
							esc_html( $next_license )
						);
					?>
					</a>
				</h3>

				<?php if ( 'lite' === $license ) { ?>
					<p class="centered">
						<?php
						echo wp_kses(
							__( 'Bonus: WPForms Lite users get <span class="price-20-off">50% off regular price</span>, automatically applied at checkout.', 'wpforms-lite' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						);
						?>
					</p>
				<?php } ?>
			</div>
		</div>

		<?php
	}

	/**
	 * List of AM plugins that we propose to install.
	 *
	 * @since 1.5.0
	 *
	 * @return array
	 */
	protected function get_am_plugins() {

		$data = array(

			'google-analytics-for-wordpress/googleanalytics.php' => array(
				'icon' => WPFORMS_PLUGIN_URL . 'assets/images/about/plugin-mi.png',
				'name' => esc_html__( 'MonsterInsights', 'wpforms-lite' ),
				'desc' => esc_html__( 'MonsterInsights makes it “effortless” to properly connect your WordPress site with Google Analytics, so you can start making data-driven decisions to grow your business.', 'wpforms-lite' ),
				'url'  => 'https://downloads.wordpress.org/plugin/google-analytics-for-wordpress.zip',
				'pro'  => array(
					'plug' => 'google-analytics-premium/googleanalytics-premium.php',
					'icon' => WPFORMS_PLUGIN_URL . 'assets/images/about/plugin-mi.png',
					'name' => esc_html__( 'MonsterInsights Pro', 'wpforms-lite' ),
					'desc' => esc_html__( 'MonsterInsights makes it “effortless” to properly connect your WordPress site with Google Analytics, so you can start making data-driven decisions to grow your business.', 'wpforms-lite' ),
					'url'  => 'https://www.monsterinsights.com/?utm_source=proplugin&utm_medium=pluginheader&utm_campaign=pluginurl&utm_content=7%2E0%2E0',
					'act'  => 'go-to-url',
				),
			),

			'optinmonster/optin-monster-wp-api.php' => array(
				'icon' => WPFORMS_PLUGIN_URL . 'assets/images/about/plugin-om.png',
				'name' => esc_html__( 'OptinMonster', 'wpforms-lite' ),
				'desc' => esc_html__( 'Our high-converting optin forms like Exit-Intent® popups, Fullscreen Welcome Mats, and Scroll boxes help you dramatically boost conversions and get more email subscribers.', 'wpforms-lite' ),
				'url'  => 'https://downloads.wordpress.org/plugin/optinmonster.zip',
			),

			'wp-mail-smtp/wp_mail_smtp.php'         => array(
				'icon' => WPFORMS_PLUGIN_URL . 'assets/images/about/plugin-smtp.png',
				'name' => esc_html__( 'WP Mail SMTP', 'wpforms-lite' ),
				'desc' => esc_html__( 'Make sure your website\'s emails reach the inbox. Our goal is to make email deliverability easy and reliable. Trusted by over 1 million websites.', 'wpforms-lite' ),
				'url'  => 'https://downloads.wordpress.org/plugin/wp-mail-smtp.zip',
				'pro'  => array(
					'plug' => 'wp-mail-smtp-pro/wp_mail_smtp.php',
					'icon' => WPFORMS_PLUGIN_URL . 'assets/images/about/plugin-smtp.png',
					'name' => esc_html__( 'WP Mail SMTP Pro', 'wpforms-lite' ),
					'desc' => esc_html__( 'Make sure your website\'s emails reach the inbox. Our goal is to make email deliverability easy and reliable. Trusted by over 1 million websites.', 'wpforms-lite' ),
					'url'  => 'https://wpmailsmtp.com/pricing/',
					'act'  => 'go-to-url',
				),
			),
		);

		return $data;
	}

	/**
	 * Get the array of data that compared the license data.
	 *
	 * @since 1.5.0
	 *
	 * @param string $feature Feature name.
	 * @param string $license License type to get data for.
	 *
	 * @return array|false
	 */
	protected function get_license_data( $feature, $license ) {

		$data = array(
			'entries'      => array(
				'lite'  => array(
					'status' => 'partial',
					'text'   => array(
						'<strong>' . esc_html__( 'Entries via Email Only', 'wpforms-lite' ) . '</strong>',
					),
				),
				'basic' => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Complete Entry Management inside WordPress', 'wpforms-lite' ) . '</strong>',
					),
				),
				'plus'  => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Complete Entry Management inside WordPress', 'wpforms-lite' ) . '</strong>',
					),
				),
				'pro'   => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Complete Entry Management inside WordPress', 'wpforms-lite' ) . '</strong>',
					),
				),
			),
			'fields'       => array(
				'lite'  => array(
					'status' => 'partial',
					'text'   => array(
						'<strong>' . esc_html__( 'Standard Fields Only', 'wpforms-lite' ) . '</strong>',
						esc_html__( 'Name, Email, Single Line Text, Paragraph Text, Dropdown, Multiple Choice, Checkboxes, and Numbers', 'wpforms-lite' ),
					),
				),
				'basic' => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Access to all Standard and Fancy Fields', 'wpforms-lite' ) . '</strong>',
						esc_html__( 'Address, Phone, Website URL, Date/Time, Password, File Upload, HTML, Pagebreaks, Section Dividers, Ratings, and Hidden Field', 'wpforms-lite' ),
					),
				),
				'plus'  => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Access to all Standard and Fancy Fields', 'wpforms-lite' ) . '</strong>',
						esc_html__( 'Address, Phone, Website URL, Date/Time, Password, File Upload, HTML, Pagebreaks, Section Dividers, Ratings, and Hidden Field', 'wpforms-lite' ),
					),
				),
				'pro'   => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Access to all Standard and Fancy Fields', 'wpforms-lite' ) . '</strong>',
						esc_html__( 'Address, Phone, Website URL, Date/Time, Password, File Upload, HTML, Pagebreaks, Section Dividers, Ratings, and Hidden Field', 'wpforms-lite' ),
					),
				),
			),
			'conditionals' => array(
				'lite'  => array(
					'status' => 'none',
					'text'   => array(
						'<strong>' . esc_html__( 'Not available', 'wpforms-lite' ) . '</strong>',
					),
				),
				'basic' => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Powerful Form Logic for Building Smart Forms', 'wpforms-lite' ) . '</strong>',
					),
				),
				'plus'  => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Powerful Form Logic for Building Smart Forms', 'wpforms-lite' ) . '</strong>',
					),
				),
				'pro'   => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Powerful Form Logic for Building Smart Forms', 'wpforms-lite' ) . '</strong>',
					),
				),
			),
			'templates'    => array(
				'lite'  => array(
					'status' => 'partial',
					'text'   => array(
						'<strong>' . esc_html__( 'Basic Form Templates', 'wpforms-lite' ) . '</strong>',
					),
				),
				'basic' => array(
					'status' => 'partial',
					'text'   => array(
						'<strong>' . esc_html__( 'Basic Form Templates', 'wpforms-lite' ) . '</strong>',
					),
				),
				'plus'  => array(
					'status' => 'partial',
					'text'   => array(
						'<strong>' . esc_html__( 'Basic Form Templates', 'wpforms-lite' ) . '</strong>',
					),
				),
				'pro'   => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'All Form Templates including Bonus 150+ pre-made form templates.', 'wpforms-lite' ) . '</strong>',
					),
				),
			),
			'marketing'    => array(
				'lite'  => array(
					'status' => 'partial',
					'text'   => array(
						'<strong>' . esc_html__( 'Limited Marketing Integration', 'wpforms-lite' ) . '</strong>',
						esc_html__( 'Constant Contact only', 'wpforms-lite' ),
					),
				),
				'basic' => array(
					'status' => 'partial',
					'text'   => array(
						'<strong>' . esc_html__( 'Limited Marketing Integration', 'wpforms-lite' ) . '</strong>',
						esc_html__( 'Constant Contact only', 'wpforms-lite' ),
					),
				),
				'plus'  => array(
					'status' => 'partial',
					'text'   => array(
						'<strong>' . esc_html__( '6 Email Marketing Integrations', 'wpforms-lite' ) . '</strong>',
						esc_html__( 'Constant Contact, Mailchimp, AWeber, GetResponse, Campaign Monitor, and Drip', 'wpforms-lite' ),
					),
				),
				'pro'   => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'All Marketing Integrations', 'wpforms-lite' ) . '</strong>',
						esc_html__( 'Constant Contact, MailChimp, AWeber, GetResponse, Campaign Monitor, and Drip.', 'wpforms-lite' ),
						'',
						wp_kses(
							__( '<strong>Bonus:</strong> 500+ integrations with Zapier.', 'wpforms-lite' ),
							array(
								'strong' => array(),
							)
						),
					),
				),
			),
			'payments'     => array(
				'lite'  => array(
					'status' => 'none',
					'text'   => array(
						'<strong>' . esc_html__( 'Not Available', 'wpforms-lite' ) . '</strong>',
					),
				),
				'basic' => array(
					'status' => 'none',
					'text'   => array(
						'<strong>' . esc_html__( 'Not Available', 'wpforms-lite' ) . '</strong>',
					),
				),
				'plus'  => array(
					'status' => 'none',
					'text'   => array(
						'<strong>' . esc_html__( 'Not Available', 'wpforms-lite' ) . '</strong>',
					),
				),
				'pro'   => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Create Payment Forms', 'wpforms-lite' ) . '</strong>',
						esc_html__( 'Accept payments using Stripe (credit card) and PayPal', 'wpforms-lite' ),
					),
				),
			),
			'surveys'      => array(
				'lite'  => array(
					'status' => 'none',
					'text'   => array(
						'<strong>' . esc_html__( 'Not Available', 'wpforms-lite' ) . '</strong>',
					),
				),
				'basic' => array(
					'status' => 'none',
					'text'   => array(
						'<strong>' . esc_html__( 'Not Available', 'wpforms-lite' ) . '</strong>',
					),
				),
				'plus'  => array(
					'status' => 'none',
					'text'   => array(
						'<strong>' . esc_html__( 'Not Available', 'wpforms-lite' ) . '</strong>',
					),
				),
				'pro'   => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Create interactive Surveys and Polls with beautiful reports', 'wpforms-lite' ) . '</strong>',
					),
				),
			),
			'advanced'     => array(
				'lite'  => array(
					'status' => 'none',
					'text'   => array(
						'<strong>' . esc_html__( 'No Advanced Features', 'wpforms-lite' ) . '</strong>',
					),
				),
				'basic' => array(
					'status' => 'partial',
					'text'   => array(
						'<strong>' . esc_html__( 'Limited Advanced Features', 'wpforms-lite' ) . '</strong>',
						esc_html__( 'Multi-page Forms, File Upload Forms, Multiple Form Notifications, Conditional Form Confirmation', 'wpforms-lite' ),
					),
				),
				'plus'  => array(
					'status' => 'partial',
					'text'   => array(
						'<strong>' . esc_html__( 'Limited Advanced Features', 'wpforms-lite' ) . '</strong>',
						esc_html__( 'Multi-page Forms, File Upload Forms, Multiple Form Notifications, Conditional Form Confirmation', 'wpforms-lite' ),
					),
				),
				'pro'   => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'All Advanced Features', 'wpforms-lite' ) . '</strong>',
						esc_html__( 'Multi-page Forms, File Upload Forms, Multiple Form Notifications, Conditional Form Confirmation, Custom CAPTCHA, Offline Forms, Signature Forms', 'wpforms-lite' ),
					),
				),
			),
			'addons'       => array(
				'lite'  => array(
					'status' => 'none',
					'text'   => array(
						'<strong>' . esc_html__( 'No Addons Included', 'wpforms-lite' ) . '</strong>',
					),
				),
				'basic' => array(
					'status' => 'partial',
					'text'   => array(
						'<strong>' . esc_html__( 'Custom Captcha Addon included', 'wpforms-lite' ) . '</strong>',
					),
				),
				'plus'  => array(
					'status' => 'partial',
					'text'   => array(
						'<strong>' . esc_html__( 'Email Marketing Addons included', 'wpforms-lite' ) . '</strong>',
					),
				),
				'pro'   => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'All Addons Included', 'wpforms-lite' ) . '</strong>',
						esc_html__( 'Form Abandonment, Front-end Post Submission, User Registration, Geo-location, and more (17 total)', 'wpforms-lite' ),
					),
				),
			),
			'support'      => array(
				'lite'     => array(
					'status' => 'none',
					'text'   => array(
						'<strong>' . esc_html__( 'Limited Support', 'wpforms-lite' ) . '</strong>',
					),
				),
				'basic'    => array(
					'status' => 'partial',
					'text'   => array(
						'<strong>' . esc_html__( 'Standard Support', 'wpforms-lite' ) . '</strong>',
					),
				),
				'plus'     => array(
					'status' => 'partial',
					'text'   => array(
						'<strong>' . esc_html__( 'Standard Support', 'wpforms-lite' ) . '</strong>',
					),
				),
				'pro'      => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Priority Support', 'wpforms-lite' ) . '</strong>',
					),
				),
				'elite'    => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Premium Support', 'wpforms-lite' ) . '</strong>',
					),
				),
				'ultimate' => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Premium Support', 'wpforms-lite' ) . '</strong>',
					),
				),
				'agency'   => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Premium Support', 'wpforms-lite' ) . '</strong>',
					),
				),
			),
			'sites'        => array(
				'basic'    => array(
					'status' => 'partial',
					'text'   => array(
						'<strong>' . esc_html__( '1 Site', 'wpforms-lite' ) . '</strong>',
					),
				),
				'plus'     => array(
					'status' => 'partial',
					'text'   => array(
						'<strong>' . esc_html__( '3 Sites', 'wpforms-lite' ) . '</strong>',
					),
				),
				'pro'      => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( '5 Sites', 'wpforms-lite' ) . '</strong>',
					),
				),
				'elite'    => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Unlimited Sites', 'wpforms-lite' ) . '</strong>',
					),
				),
				'ultimate' => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Unlimited Sites', 'wpforms-lite' ) . '</strong>',
					),
				),
				'agency'   => array(
					'status' => 'full',
					'text'   => array(
						'<strong>' . esc_html__( 'Unlimited Sites', 'wpforms-lite' ) . '</strong>',
					),
				),
			),
		);

		// Wrong feature?
		if ( ! isset( $data[ $feature ] ) ) {
			return false;
		}

		// Is a top level license?
		$is_licenses_top = in_array( $license, self::$licenses_top, true );

		// Wrong license type?
		if ( ! isset( $data[ $feature ][ $license ] ) && ! $is_licenses_top ) {
			return false;
		}

		// Some licenses have partial data.
		if ( isset( $data[ $feature ][ $license ] ) ) {
			return $data[ $feature ][ $license ];
		}

		// Top level plans has no feature difference with `pro` plan in most cases.
		return $is_licenses_top ? $data[ $feature ]['pro'] : $data[ $feature ][ $license ];
	}

	/**
	 * Get the current installation license type (always lowercase).
	 *
	 * @since 1.5.0
	 *
	 * @return string
	 */
	protected function get_license_type() {

		$type = wpforms_setting( 'type', '', 'wpforms_license' );

		if ( empty( $type ) || ! wpforms()->pro ) {
			$type = 'lite';
		}

		return strtolower( $type );
	}
}

new WPForms_About();
