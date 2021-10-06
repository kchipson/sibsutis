<?php
/**
 * Gutenberg Blocks modules Orbit Fox Module.
 *
 * @link       https://themeisle.com
 * @since      2.2.5
 */

/**
 * Class Gutenberg_Blocks_OBFX_Module
 */
class Gutenberg_Blocks_OBFX_Module extends Orbit_Fox_Module_Abstract {

	protected $blocks_classes = array();

	/**
	 * Gutenberg_Blocks_OBFX_Module constructor.
	 *
	 * @since   2.2.5
	 * @access  public
	 */
	public function __construct() {
		parent::__construct();
		$this->name           = __( 'Gutenberg Blocks <sup class="obfx-title-new">NEW</sup>', 'themeisle-companion' );
		$this->description    =sprintf(  __(  'A set of awesome Gutenberg Blocks provided by %sOtter\'s%s plugin!', 'themeisle-companion' ),'<span class="dashicons dashicons-external"></span><a target="_blank" href="https://wordpress.org/plugins/otter-blocks/">','</a>');
		$this->active_default = true;
	}

	/**
	 * Determine if module should be loaded.
	 *
	 * @since   2.2.5
	 * @access  public
	 * @return bool
	 */
	public function enable_module() {
		global $wp_version;
		require_once( ABSPATH . 'wp-admin' . '/includes/plugin.php' );
		if ( is_plugin_active( 'otter-blocks/otter-blocks.php' ) ) {
			return false;
		}
		if ( version_compare( $wp_version, '5.0', '>=' ) ) {
			return true;
		}
		if ( is_plugin_active( 'gutenberg/gutenberg.php' ) ) {
			return true;
		}


		return false;
	}

	/**
	 * The loading logic for the module.
	 *
	 * @since   2.2.5
	 * @access  public
	 */
	public function load() {
	}

	/**
	 * Method to define hooks needed.
	 *
	 * @since   2.2.5
	 * @access  public
	 */
	public function hooks() {
		$this->loader->add_action( 'enqueue_block_assets', $this, 'enqueue_block_assets' );
		$this->loader->add_action( 'init', $this, 'load_gutenberg_blocks' );
	}

	/**
	 * Method that returns an array of scripts and styles to be loaded
	 * for the front end part.
	 *
	 * @since   2.2.5
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
	 * @since   2.2.5
	 * @access  public
	 * @return array
	 */
	public function admin_enqueue() {
		return array();
	}

	/**
	 * Method to define the options fields for the module
	 *
	 * @since   2.2.5
	 * @access  public
	 * @return array
	 */
	public function options() {
		return array();
	}

	/**
	 * Load assets for our blocks.
	 */
	function enqueue_block_assets() {
		wp_enqueue_style( 'font-awesome-5', plugins_url( 'assets/fontawesome/css/all.min.css', __FILE__ ) );
		wp_enqueue_style( 'font-awesome-4-shims', plugins_url( 'assets/fontawesome/css/v4-shims.min.css', __FILE__ ) );
	}

	/**
	 * If the composer library is present let's try to init.
	 */
	function load_gutenberg_blocks() {
		if ( class_exists( '\ThemeIsle\GutenbergBlocks' ) ) {
			\ThemeIsle\GutenbergBlocks::instance( __( 'Blocks by OrbitFox and Otter', 'themeisle-companion' ) );
		}
	}

}
