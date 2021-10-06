<?php

/**
 * The Orbit Fox Template Directory Module.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Template_Directory_OBFX_Module
 */

use  Elementor\TemplateLibrary\Classes;

/**
 * The class defines a new module to be used by Orbit Fox plugin.
 *
 * @package    Template_Directory_OBFX_Module
 * @author     Themeisle <friends@themeisle.com>
 */
class Template_Directory_OBFX_Module extends Orbit_Fox_Module_Abstract {

	/**
	 * Template_Directory_OBFX_Module constructor.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function __construct() {
		parent::__construct();
		$this->name           = __( 'Template Directory Module', 'themeisle-companion' );
		$this->description    = __( 'The awesome template directory is aiming to provide a wide range of templates that you can import straight into your website.', 'themeisle-companion' );
		$this->active_default = true;
	}

	/**
	 * Determine if module should be loaded.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return bool
	 */
	public function enable_module() {
		return true;
	}

	/**
	 * The loading logic for the module.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function load() {
		return true;
	}

	/**
	 * Method to define hooks needed.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function hooks() {
		// Get the full-width pages feature
		$this->loader->add_action( 'init', $this, 'load_template_directory_library' );
		$this->loader->add_action( 'init', $this, 'load_full_width_page_templates' );
		$this->loader->add_filter( 'obfx_template_dir_products',$this, 'add_page', 90 );
	}

	/**
	 * Enqueue the scripts for the dashboard page of the
	 */
	public function enqueue_template_dir_scripts() {
		$current_screen = get_current_screen();
		if ( $current_screen->id == 'orbit-fox_page_obfx_template_dir' ) {
			$script_handle = $this->slug . '-script';
			wp_enqueue_script( 'plugin-install' );
			wp_enqueue_script( 'updates' );
			wp_register_script( $script_handle, plugin_dir_url( $this->get_dir() ) . $this->slug . '/js/script.js', array( 'jquery' ), $this->version );
			wp_localize_script( $script_handle, 'importer_endpoint',
				array(
					'url'   => $this->get_endpoint_url( '/import_elementor' ),
					'nonce' => wp_create_nonce( 'wp_rest' ),
				) );
			wp_enqueue_script( $script_handle );
		}
	}

	/**
	 * Add the menu page.
	 *
	 * @param $products
	 *
	 * @return array
	 */
	public function add_page( $products ) {
		$sizzify = array(
			'obfx' => array(
				'directory_page_title' => __( 'Orbit Fox Template Directory', 'themeisle-companion' ),
				'parent_page_slug'     => 'obfx_companion',
				'page_slug'            => 'obfx_template_dir',
			)
		);
		return array_merge($products, $sizzify );
	}

	/**
	 *
	 *
	 * @param string $path
	 *
	 * @return string
	 */
	public function get_endpoint_url( $path = '' ) {
		return rest_url( $this->slug . $path );
	}

	/**
	 * Method that returns an array of scripts and styles to be loaded
	 * for the front end part.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public function public_enqueue() {
		return array();
	}

	/**
	 * Method that returns an array of scripts and styles to be loaded
	 * for the admin part.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array|boolean
	 */
	public function admin_enqueue() {
		return array();
	}


	/**
	 * Options array for the Orbit Fox module.
	 *
	 * @return array
	 */
	public function options() {
		return array();
	}


	/**
	 * If the composer library is present let's try to init.
	 */
	public function load_full_width_page_templates() {
		if ( class_exists( '\ThemeIsle\FullWidthTemplates' ) ) {
			\ThemeIsle\FullWidthTemplates::instance();
		}
	}

	/**
	 * Call the Templates Directory library
	 */
	public function load_template_directory_library() {
		if ( class_exists( '\ThemeIsle\PageTemplatesDirectory' ) ) {
			\ThemeIsle\PageTemplatesDirectory::instance();
		}
	}

	/**
	 * By default the composer library "Full Width Page Templates" comes with two page templates: a blank one and a full
	 * width one with the header and footer inherited from the active theme.
	 * OBFX Template directory doesn't need the blonk one, so we are going to ditch it.
	 *
	 * @param array $list
	 *
	 * @return array
	 */
	public function filter_fwpt_templates_list( $list ){
		unset( $list['templates/builder-fullwidth.php'] );
		return $list;
	}
}
