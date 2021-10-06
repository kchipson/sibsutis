<?php
/**
 * This class handel the Elementor Widgets registration, category registration and all Elementor related actions.
 *
 * @package ContentForms
 */

namespace ThemeIsle\ContentForms\Includes\Widgets_Admin\Elementor;

use Elementor\Plugin;

/**
 * Class Elementor_Widget_Manager
 */
class Elementor_Widget_Manager {

	/**
	 * Type of Widget Forms.
	 *
	 * @var $forms
	 */
	public static $forms = array( 'contact', 'newsletter', 'registration' );

	/**
	 * Initialization Function
	 */
	public function init() {
		// Register Orbit Fox Category in Elementor Dashboard
		add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_widget_categories' ) );

		// Register Orbit Fox Elementor Widgets
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_elementor_widget' ) );

	}

	/**
	 * Register the category for widgets.
	 *
	 * @param \Elementor\Elements_Manager $elements_manager Elements manager.
	 */
	public function add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'obfx-elementor-widgets',
			array(
				'title' => __( 'Orbit Fox Addons', 'themeisle-companion' ),
				'icon'  => 'fa fa-plug',
			)
		);
	}

	/**
	 * Register Elementor Widgets that are added in Orbit Fox.
	 */
	public function register_elementor_widget() {
		foreach ( self::$forms as $form ) {
			require_once $form . '_admin.php';
			$widget = '\ThemeIsle\ContentForms\Includes\Widgets_Admin\Elementor\\' . ucwords( $form ) . '_Admin';
			Plugin::instance()->widgets_manager->register_widget_type( new $widget() );
		}
	}
}
