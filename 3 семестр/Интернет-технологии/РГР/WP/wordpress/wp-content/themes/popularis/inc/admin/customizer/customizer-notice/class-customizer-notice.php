<?php
/**
 * Popularis Customizer Notification System.
 *
 * @package Popularis
 */


/**
 * Popularis Customizer Notify Class
 */
class Popularis_Customizer_Notice {

	/**
	 * Recommended plugins
	 *
	 * @var array $recommended_plugins Recommended plugins displayed in customize notification system.
	 */
	private $recommended_plugins;

	/**
	 * The single instance of Popularis_Customizer_Notice
	 *
	 * @var Popularis_Customizer_Notice $instance The Popularis_Customizer_Notice instance.
	 */
	private static $instance;

	/**
	 * Title of Recommended plugins section in customize
	 *
	 * @var string $recommended_plugins_title Title of Recommended plugins section displayed in customize notification system.
	 */
	private $recommended_plugins_title;

	/**
	 * Dismiss button label
	 *
	 * @var string $dismiss_button Dismiss button label displayed in customize notification system.
	 */
	private $dismiss_button;

	/**
	 * Install button label for plugins
	 *
	 * @var string $install_button_label Label of install button for plugins displayed in customize notification system.
	 */
	private $install_button_label;

	/**
	 * Activate button label for plugins
	 *
	 * @var string $activate_button_label Label of activate button for plugins displayed in customize notification system.
	 */
	private $activate_button_label;

	/**
	 * Deactivate button label for plugins
	 *
	 * @var string $deactivate_button_label Label of deactivate button for plugins displayed in customize notification system.
	 */
	private $deactivate_button_label;

	/**
	 * The Main Popularis_Customizer_Notice instance.
	 *
	 * We make sure that only one instance of Popularis_Customizer_Notice exists in the memory at one time.
	 *
	 * @param array $config The configuration array.
	 */
	public static function init( $config ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Popularis_Customizer_Notice ) ) {
			self::$instance = new Popularis_Customizer_Notice;
			if ( ! empty( $config ) && is_array( $config ) ) {
				self::$instance->config = $config;
				self::$instance->setup_config();
				self::$instance->setup_actions();
			}
		}

	}

	/**
	 * Setup the class props based on the config array.
	 */
	public function setup_config() {

		// global arrays for recommended plugins/actions
		global $popularis_recommended_plugins;
		global $install_button_label;
		global $activate_button_label;
		global $deactivate_button_label;

		$this->recommended_plugins = isset( $this->config['recommended_plugins'] ) ? $this->config['recommended_plugins'] : array();
        $this->recommended_plugins_title = isset( $this->config['recommended_plugins_title'] ) ? $this->config['recommended_plugins_title'] : '';
		$this->dismiss_button = isset( $this->config['dismiss_button'] ) ? $this->config['dismiss_button'] : '';

		$popularis_recommended_plugins = array();
		
		if ( isset( $this->recommended_plugins ) ) {
			$popularis_recommended_plugins = $this->recommended_plugins;
		}

		$install_button_label = isset( $this->config['install_button_label'] ) ? $this->config['install_button_label'] : '';
		$activate_button_label = isset( $this->config['activate_button_label'] ) ? $this->config['activate_button_label'] : '';
		$deactivate_button_label = isset( $this->config['deactivate_button_label'] ) ? $this->config['deactivate_button_label'] : '';

	}

	/**
	 * Setup the actions used for this class.
	 */
	public function setup_actions() {

		// Register the section
		add_action( 'customize_register', array( $this, 'customize_register_notice' ) );

		// Enqueue scripts and styles
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'scripts_for_customizer' ), 0 );

		/* ajax callback for dismissable recommended plugins */
		add_action( 'wp_ajax_dismiss_recommended_plugins', array( $this, 'dismiss_recommended_plugins_callback' ) );

	}

	/**
	 * Scripts and styles used in the Themeisle_Customizer_Notify class
	 */
	public function scripts_for_customizer() {

		wp_enqueue_style( 'popularis-customizer-notice', get_template_directory_uri() . '/inc/admin/customizer/customizer-notice/css/customizer-notice.css', array() );

		wp_enqueue_style( 'plugin-install' );
		wp_enqueue_script( 'plugin-install' );
		wp_add_inline_script( 'plugin-install', 'var pagenow = "customizer";' );

		wp_enqueue_script( 'updates' );

		wp_enqueue_script( 'popularis-customizer-notice', get_template_directory_uri() . '/inc/admin/customizer/customizer-notice/js/customizer-notice.js', array( 'customize-controls' ) );
		wp_localize_script(
			'popularis-customizer-notice', 'customizer_notice_data', array(
				'ajaxurl'                  => admin_url( 'admin-ajax.php' ),
				'template_directory'       => get_template_directory_uri(),
				'base_path'                => admin_url(),
				'activating_string'        => esc_html__( 'Activating', 'popularis' ),
			)
		);

	}

	/**
	 * Register the section for the recommended actions/plugins in customize
	 *
	 * @param object $wp_customize The customizer object.
	 */
	public function customize_register_notice( $wp_customize ) {

		/**
		 * Include the Popularis_Customizer_Notice_Section class.
		 */
		require_once get_template_directory() . '/inc/admin/customizer/customizer-notice/class-customizer-notice-section.php';

		$wp_customize->register_section_type( 'Popularis_Customizer_Notice_Section' );

		$wp_customize->add_section(
			new Popularis_Customizer_Notice_Section(
				$wp_customize,
				'customizer-plugin-notice-section',
				array(
					'plugin_text'    => $this->recommended_plugins_title,
					'dismiss_button' => $this->dismiss_button,
					'priority'       => 0,
				)
			)
		);

	}

	/**
	 * Dismiss recommended plugins
	 */
	public function dismiss_recommended_plugins_callback() {

		$action_id = ( isset( $_GET['id'] ) ) ? sanitize_text_field( wp_unslash( $_GET['id'] ) ) : 0;

		echo esc_html( $action_id ); /* this is needed and it's the id of the dismissable required action */

		if ( ! empty( $action_id ) ) {
			/* if the option exists, update the record for the specified id */
			$show_recommended_plugins = get_option( 'popularis_show_recommended_plugins' );
			if ( isset( $_GET['todo'] ) ) {
				switch ( $_GET['todo'] ) {
					case 'add':
						$show_recommended_plugins[ $action_id ] = false;
						break;
					case 'dismiss':
						$show_recommended_plugins[ $action_id ] = true;
						break;
				}
			}
			update_option( 'popularis_show_recommended_plugins', $show_recommended_plugins );
		}
		die(); // this is required to return a proper result
	}

}