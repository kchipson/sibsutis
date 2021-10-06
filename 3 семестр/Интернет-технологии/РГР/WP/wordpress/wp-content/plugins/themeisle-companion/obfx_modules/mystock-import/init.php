<?php
/**
 * The module for mystock import.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Mystock_Import_OBFX_Module
 */

/**
 * The class for mystock import.
 *
 * @package    Mystock_Import_OBFX_Module
 * @author     Themeisle <friends@themeisle.com>
 * @codeCoverageIgnore
 */
class Mystock_Import_OBFX_Module extends Orbit_Fox_Module_Abstract {

	/**
	 * The api key.
	 */
	const API_KEY = '97d007cf8f44203a2e578841a2c0f9ac';

	/**
	 * Flickr user id.
	 */
	const USER_ID = '136375272@N05';

	/**
	 * The number of images to fetch. Only the first page will be fetched.
	 */
	const MAX_IMAGES = 40;

	/**
	 * The cache time.
	 */
	const CACHE_DAYS = 7;


	/**
	 * Mystock_Import_OBFX_Module constructor.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function __construct() {
		parent::__construct();
		$this->name           = __( 'Mystock Import', 'themeisle-companion' );
		$this->description    = __( 'Module to import images directly from', 'themeisle-companion' ) . sprintf( ' <a href="%s" target="_blank">mystock.photos</a>', 'https://mystock.photos' );
		$this->active_default = true;
	}


	/**
	 * Determine if module should be loaded.
	 *
	 * @return bool
	 * @since   1.0.0
	 * @access  public
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
	}

	/**
	 * Method to define hooks needed.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function hooks() {

		/*Get tab content*/
		$this->loader->add_action( 'wp_ajax_get-tab-' . $this->slug, $this, 'get_tab_content' );
		$this->loader->add_action( 'wp_ajax_infinite-' . $this->slug, $this, 'infinite_scroll' );
		$this->loader->add_action( 'wp_ajax_handle-request-' . $this->slug, $this, 'handle_request' );
		$this->loader->add_filter( 'media_view_strings', $this, 'media_view_strings' );
	}

	/**
	 * Display tab content.
	 */
	public function get_tab_content() {
		$urls = $this->get_images();
		$page = 1;
		require $this->get_dir() . "/inc/photos.php";
		wp_die();
	}

	/**
	 * Request images from flickr.
	 *
	 * @param int $page Page to load.
	 *
	 * @return array
	 */
	private function get_images( $page = 1 ) {
		$photos = get_transient( $this->slug . 'photos_' . self::MAX_IMAGES . '_' . $page );
		if ( ! $photos ) {
			require_once $this->get_dir() . '/vendor/phpflickr/phpflickr.php';
			$api    = new phpFlickr( self::API_KEY );
			$photos = $api->people_getPublicPhotos( self::USER_ID, null, 'url_sq, url_t, url_s, url_q, url_m, url_n, url_z, url_c, url_l, url_o', self::MAX_IMAGES, $page );
			if ( ! empty( $photos ) ) {
				$pages = get_transient( $this->slug . 'photos_' . self::MAX_IMAGES . '_pages' );
				if ( false === $pages ) {
					set_transient( $this->slug . 'photos_' . self::MAX_IMAGES . '_pages', $photos['photos']['pages'], self::CACHE_DAYS * DAY_IN_SECONDS );
				}
				$photos = $photos['photos']['photo'];
			}
			set_transient( $this->slug . 'photos_' . self::MAX_IMAGES . '_' . $page, $photos, self::CACHE_DAYS * DAY_IN_SECONDS );
		}

		return $photos;
	}

	/**
	 * Upload image.
	 */
	function handle_request() {
		check_ajax_referer( $this->slug . filter_input( INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP ), 'security' );

		if ( ! isset( $_POST['url'] ) ) {
			echo esc_html__( 'Image failed to upload', 'themeisle-companion' );
			wp_die();
		}

		$url      = $_POST['url'];
		$name     = basename( $url );
		$tmp_file = download_url( $url );
		if ( is_wp_error( $tmp_file ) ) {
			echo esc_html__( 'Image failed to upload', 'themeisle-companion' );
			wp_die();
		}
		$file             = array();
		$file['name']     = $name;
		$file['tmp_name'] = $tmp_file;
		$image_id         = media_handle_sideload( $file, 0 );
		if ( is_wp_error( $image_id ) ) {
			echo esc_html__( 'Image failed to upload', 'themeisle-companion' );
			wp_die();
		}
		$attach_data = wp_generate_attachment_metadata( $image_id, get_attached_file( $image_id ) );
		if ( is_wp_error( $attach_data ) ) {
			echo esc_html__( 'Image failed to upload', 'themeisle-companion' );
			wp_die();
		}
		wp_update_attachment_metadata( $image_id, $attach_data );

		wp_send_json_success( array( 'id' => $image_id ) );
	}

	/**
	 * Ajax function to load new images.
	 */
	function infinite_scroll() {
		check_ajax_referer( $this->slug . filter_input( INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP ), 'security' );

		if ( ! isset( $_POST['page'] ) ) {
			wp_die();
		}

		//Update last page that was loaded
		$page = (int) $_POST['page'] + 1;

		//Request new page
		$urls = $this->get_images( $page );
		if ( ! empty( $urls ) ) {
			foreach ( $urls as $photo ) {
				include $this->get_dir() . '/inc/photo.php';
			}
		}
		wp_die();
	}

	/**
	 * Method that returns an array of scripts and styles to be loaded
	 * for the front end part.
	 *
	 * @return array
	 * @since   1.0.0
	 * @access  public
	 */
	public function public_enqueue() {
		return array();
	}

	/**
	 * Method that returns an array of scripts and styles to be loaded
	 * for the admin part.
	 *
	 * @return array
	 * @since   1.0.0
	 * @access  public
	 */
	public function admin_enqueue() {
		$current_screen = get_current_screen();
		if ( ! isset( $current_screen->id ) ) {
			return array();
		}
		if ( ! in_array( $current_screen->id, array( 'post', 'page', 'post-new', 'upload' ) ) ) {
			return array();
		}

		$this->localized = array(
			'admin' => array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( $this->slug . filter_input( INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP ) ),
				'l10n'    => array(
					'fetch_image_sizes'     => esc_html__( 'Fetching data', 'themeisle-companion' ),
					'upload_image'          => esc_html__( 'Downloading image. Please wait...', 'themeisle-companion' ),
					'upload_image_complete' => esc_html__( 'Your image was imported. Go to Media Library tab to use it.', 'themeisle-companion' ),
					'load_more'             => esc_html__( 'Loading more photos...', 'themeisle-companion' ),
					'tab_name'              => esc_html__( 'MyStock Library', 'themeisle-companion' ),
					'featured_image_new'    => esc_html__( 'Import & set featured image', 'themeisle-companion' ),
					'insert_image_new'      => esc_html__( 'Import & insert image', 'themeisle-companion' ),
					'featured_image'        => isset( $this->strings['setFeaturedImage'] ) ? $this->strings['setFeaturedImage'] : '',
					'insert_image'          => isset( $this->strings['insertIntoPost'] ) ? $this->strings['insertIntoPost'] : '',
				),
				'slug'    => $this->slug,
				'pages'   => get_transient( $this->slug . 'photos_' . self::MAX_IMAGES . '_pages' ),
			),
		);

		return array(
			'js'  => array(
				'admin' => array( 'media-views' ),
			),
			'css' => array(
				'media' => array(),
			),
		);
	}

	/**
	 * Method to define the options fields for the module
	 *
	 * @return array
	 * @since   1.0.0
	 * @access  public
	 */
	public function options() {
		return array();
	}

	public function media_view_strings( $strings ) {
		$this->strings = $strings;

		return $strings;
	}
}
