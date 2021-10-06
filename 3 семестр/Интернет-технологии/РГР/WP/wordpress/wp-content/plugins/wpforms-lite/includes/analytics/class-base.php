<?php
/**
 * Analytics integration class.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.4.5
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2017, WPForms LLC
 */
abstract class WPForms_Analytics_Integration {

	/**
	 * Payment name.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $name;

	/**
	 * Payment name in slug format.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $slug;

	/**
	 * Load priority.
	 *
	 * @since 1.0.0
	 *
	 * @var int
	 */
	public $priority = 10;

	/**
	 * Payment icon.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	public $icon;

	/**
	 * Form data and settings.
	 *
	 * @since 1.1.0
	 * @var array
	 */
	public $form_data;

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->init();

		// Add to list of available analytics.
		add_filter( 'wpforms_analytics_available', array( $this, 'register_analytics' ), $this->priority, 1 );

		// Fetch and store the current form data when in the builder.
		add_action( 'wpforms_builder_init', array( $this, 'builder_form_data' ) );

		// Output builder sidebar.
		add_action( 'wpforms_analytics_panel_sidebar', array( $this, 'builder_sidebar' ), $this->priority );

		// Output builder content.
		add_action( 'wpforms_analytics_panel_content', array( $this, 'builder_output' ), $this->priority );
	}

	/**
	 * All systems go. Used by subclasses.
	 *
	 * @since 1.0.0
	 */
	public function init() {
	}

	/**
	 * Add to list of registered analytics.
	 *
	 * @since 1.0.0
	 *
	 * @param array $analytics
	 *
	 * @return array
	 */
	public function register_analytics( $analytics = array() ) {

		$analytics[ $this->slug ] = $this->name;

		return $analytics;
	}

	/********************************************************
	 * Builder methods - these methods _build_ the Builder. *
	 ********************************************************/

	/**
	 * Fetch and store the current form data when in the builder.
	 *
	 * @since 1.1.0
	 */
	public function builder_form_data() {

		$this->form_data = WPForms_Builder::instance()->form_data;
	}

	/**
	 * Display content inside the panel sidebar area.
	 *
	 * @since 1.0.0
	 */
	public function builder_sidebar() {

		$configured = ! empty( $this->form_data['analytics'][ $this->slug ]['enable'] ) ? 'configured' : '';

		echo '<a href="#" class="wpforms-panel-sidebar-section icon ' . $configured . ' wpforms-panel-sidebar-section-' . esc_attr( $this->slug ) . '" data-section="' . esc_attr( $this->slug ) . '">';

		echo '<img src="' . esc_url( $this->icon ) . '">';

		echo esc_html( $this->name );

		echo '<i class="fa fa-angle-right wpforms-toggle-arrow"></i>';

		if ( ! empty( $configured ) ) {
			echo '<i class="fa fa-check-circle-o"></i>';
		}

		echo '</a>';
	}

	/**
	 * Wraps the builder content with the required markup.
	 *
	 * @since 1.0.0
	 */
	public function builder_output() {

		?>
		<div class="wpforms-panel-content-section wpforms-panel-content-section-<?php echo esc_attr( $this->slug ); ?>"
			id="<?php echo esc_attr( $this->slug ); ?>-provider">

			<div class="wpforms-panel-content-section-title">

				<?php echo esc_html( $this->name ); ?>

			</div>

			<div class="wpforms-payment-settings wpforms-clear">

				<?php $this->builder_content(); ?>

			</div>

		</div>
		<?php
	}

	/**
	 * Display content inside the panel content area.
	 *
	 * @since 1.0.0
	 */
	public function builder_content() {

	}
}
