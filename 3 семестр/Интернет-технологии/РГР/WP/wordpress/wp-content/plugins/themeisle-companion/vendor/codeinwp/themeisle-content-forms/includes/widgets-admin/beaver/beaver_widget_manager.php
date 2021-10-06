<?php
/**
 *
 */

namespace ThemeIsle\ContentForms\Includes\Widgets_Admin\Beaver;

/**
 * Class Beaver_Widget_Manager\
 */
class Beaver_Widget_Manager {

	/**
	 * Type of Widget Forms.
	 *
	 * @var $forms
	 */
	public static $forms = array( 'contact', 'newsletter', 'registration' );

	/*
	 * Register beaver modules
	 *
	 * @return bool
	 */
	public function register_beaver_module() {
		if ( ! class_exists( '\FLBuilderModel' ) ) {
			return false;
		}

		foreach ( self::$forms as $form ) {
			require_once 'class-themeisle-content-forms-beaver-' . $form . '.php';
			$classname = '\ThemeIsle\ContentForms\Includes\Widgets_Admin\Beaver\\' . ucwords( $form ) . '_Admin';
			\FLBuilder::register_module( $classname, array() );
		}

		return true;
	}

}
