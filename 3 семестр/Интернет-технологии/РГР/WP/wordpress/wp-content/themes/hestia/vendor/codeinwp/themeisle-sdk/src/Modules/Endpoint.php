<?php
/**
 * The class that exposes endpoints.
 *
 * @package     ThemeIsleSDK
 * @subpackage  Rollback
 * @copyright   Copyright (c) 2017, Marius Cristea
 * @license     http://opensource.org/licenses/gpl-3.0.php GNU Public License
 * @since       1.0.0
 */

namespace ThemeisleSDK\Modules;

// Exit if accessed directly.
use ThemeisleSDK\Common\Abstract_Module;
use ThemeisleSDK\Loader;
use ThemeisleSDK\Product;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Expose endpoints for ThemeIsle SDK.
 */
class Endpoint extends Abstract_Module {
	/**
	 * Endpoint slug.
	 */
	const SDK_ENDPOINT = 'themeisle-sdk';
	/**
	 * Endpoint version.
	 */
	const SDK_ENDPOINT_VERSION = 1;
	/**
	 * Hash file which contains the checksum.
	 */
	const HASH_FILE = 'themeisle-hash.json';

	/*
	 * If true, the endpoint will expect a product slug and will return the value only for that.
	 */
	const PRODUCT_SPECIFIC = false;

	/**
	 * Registers the endpoints.
	 */
	function rest_register() {
		register_rest_route(
			self::SDK_ENDPOINT . '/v' . self::SDK_ENDPOINT_VERSION,
			'/checksum/' . ( self::PRODUCT_SPECIFIC ? '(?P<slug>.*)/' : '' ),
			array(
				'methods'  => 'GET',
				'callback' => array( $this, 'checksum' ),
			)
		);
	}

	/**
	 * The checksum endpoint.
	 *
	 * @param \WP_REST_Request $data the request.
	 *
	 * @return \WP_REST_Response Response or the error
	 */
	function checksum( \WP_REST_Request $data ) {
		$products = Loader::get_products();
		if ( self::PRODUCT_SPECIFIC ) {
			$params = $this->validate_params( $data, array( 'slug' ) );
			foreach ( $products as $product ) {
				if ( $params['slug'] === $product->get_slug() ) {
					$products = array( $product );
					break;
				}
			}
		}
		$response   = array();
		$custom_css = $this->has_custom_css();
		if ( is_bool( $custom_css ) ) {
			$response['custom_css'] = $custom_css;
		}

		$response['child_theme'] = $this->get_theme_properties();

		foreach ( $products as $product ) {
			$files = array();
			switch ( $product->get_type() ) {
				case 'plugin':
					$files = array();
					break;
				case 'theme':
					$files = array( 'style.css', 'functions.php' );
					break;
			}

			$error = '';

			// if any element in the $files array contains a '/', this would imply recursion is required.
			$diff = $this->generate_diff(
				$product,
				$files,
				array_reduce(
					$files,
					array(
						$this,
						'is_recursion_required',
					),
					false
				)
			);
			if ( is_wp_error( $diff ) ) {
				/**
				 * Error returner by the diff checker method.
				 *
				 * @var \WP_Error $diff Error returned.
				 */
				$error = $diff->get_error_message();
				$diff  = array();
			}

			$response['products'][] = array(
				'slug'    => $product->get_slug(),
				'version' => $product->get_version(),
				'diffs'   => $diff,
				'error'   => $error,
			);
		}

		return new \WP_REST_Response( array( 'checksum' => $response ) );
	}

	/**
	 * Validates the parameters to the API
	 *
	 * @param \WP_REST_Request $data the request.
	 * @param array            $params the parameters to validate.
	 *
	 * @return array of parameter name=>value
	 */
	private function validate_params( \WP_REST_Request $data, $params ) {
		$collect = array();
		foreach ( $params as $param ) {
			$value = sanitize_text_field( $data[ $param ] );
			if ( empty( $value ) ) {
				return rest_ensure_response(
					new \WP_Error(
						'themeisle_' . $param . '_invalid',
						sprintf( 'Invalid %', $param ),
						array(
							'status' => 403,
						)
					)
				);
			} else {
				$collect[ $param ] = $value;
			}
		}

		return $collect;
	}

	/**
	 * Check if custom css has been added to the theme.
	 *
	 * @return bool Whether custom css has been added to the theme.
	 */
	private function has_custom_css() {
		$query = new \WP_Query(
			array(
				'post_type'              => 'custom_css',
				'post_status'            => 'publish',
				'numberposts'            => 1,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
			)
		);

		if ( $query->have_posts() ) {
			$query->the_post();
			$content = get_the_content();

			// if the content contains a colon, a CSS rule has been added.
			return strpos( $content, ':' ) === false ? false : true;
		}

		return false;
	}

	/**
	 * Get the current theme properties.
	 *
	 * @return mixed Properties of the current theme.
	 */
	function get_theme_properties() {
		if ( ! is_child_theme() ) {
			return false;
		}

		$properties = array();
		$theme      = wp_get_theme();
		// @codingStandardsIgnoreStart
		$properties['name'] = $theme->Name;
		// @codingStandardsIgnoreEnd

		// get the files in the child theme.
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		WP_Filesystem();
		global $wp_filesystem;
		$path = str_replace( ABSPATH, $wp_filesystem->abspath(), get_stylesheet_directory() );
		$list = $wp_filesystem->dirlist( $path, false, false );
		if ( $list ) {
			$list                = array_keys( self::flatten_dirlist( $list ) );
			$properties['files'] = $list;
		}

		return $properties;
	}

	/**
	 * Flatten the results of WP_Filesystem::dirlist() for iterating over.
	 *
	 * @access private
	 *
	 * @param  array  $nested_files Array of files as returned by WP_Filesystem::dirlist().
	 * @param  string $path Relative path to prepend to child nodes. Optional.
	 *
	 * @return array $files A flattened array of the $nested_files specified.
	 */
	private static function flatten_dirlist( $nested_files, $path = '' ) {
		$files = array();
		foreach ( $nested_files as $name => $details ) {
			$files[ $path . $name ] = $details;
			// Append children recursively.
			if ( ! empty( $details['files'] ) ) {
				$children = self::flatten_dirlist( $details['files'], $path . $name . '/' );
				// Merge keeping possible numeric keys, which array_merge() will reindex from 0..n.
				$files = $files + $children;
			}
		}

		return $files;
	}

	/**
	 * Generate the diff of the files.
	 *
	 * @param Product $product Themeisle Product.
	 * @param array   $files Array of files.
	 * @param bool    $recurse Whether to recurse or not.
	 *
	 * @return mixed Diff data.
	 */
	private function generate_diff( $product, $files, $recurse = false ) {
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		WP_Filesystem();
		global $wp_filesystem;

		$diff = array();
		$path = str_replace( ABSPATH, $wp_filesystem->abspath(), plugin_dir_path( $product->get_basefile() ) );
		$list = $wp_filesystem->dirlist( $path, false, $recurse );
		// nothing found.
		if ( ! $list ) {
			return $diff;
		}
		$list = array_keys( self::flatten_dirlist( $list ) );

		// now let's get the valid files that actually exist.
		if ( empty( $files ) ) {
			$files = $list;
		} else {
			$files = array_intersect( $files, $list );
		}

		// fetch the calculated hashes.
		if ( ! $wp_filesystem->is_readable( $path . '/' . self::HASH_FILE ) ) {
			return new \WP_Error( 'themeisle_sdk_hash_not_found', sprintf( '%s not found', self::HASH_FILE ) );
		}

		$hashes = json_decode( $wp_filesystem->get_contents( $path . '/' . self::HASH_FILE ), true );
		ksort( $hashes );

		$diff = array();
		foreach ( $files as $file ) {
			// file does not exist in the hashes.
			if ( ! array_key_exists( $file, $hashes ) ) {
				continue;
			}
			$new = md5( $wp_filesystem->get_contents( $path . $file ) );
			$old = $hashes[ $file ];

			// same hash, bail.
			if ( $new === $old ) {
				continue;
			}
			$diff[] = $file;
		}

		return $diff;
	}

	/**
	 * Check if recursion needs to be enabled on the WP_Filesystem by reducing the array of files to a boolean.
	 *
	 * @param string $carry Value of the previous iteration.
	 * @param string $item Value of the current iteration.
	 *
	 * @return bool Whether to recurse or not.
	 */
	function is_recursion_required( $carry, $item ) {
		if ( ! $carry ) {
			return ( strpos( $item, '/' ) !== false );
		}

		return $carry;
	}

	/**
	 * Load module for this product.
	 *
	 * @param Product $product Product to check.
	 *
	 * @return bool Should we load this?
	 */
	public function can_load( $product ) {
		return true;
	}

	/**
	 * Load module logic.
	 *
	 * @param Product $product Product to load.
	 */
	public function load( $product ) {
		$this->setup_endpoints();

		return $this;
	}

	/**
	 * Setup endpoints.
	 */
	private function setup_endpoints() {
		global $wp_version;
		if ( version_compare( $wp_version, '4.4', '<' ) ) {
			// no REST support.
			return;
		}

		$this->setup_rest();
	}

	/**
	 * Setup REST endpoints.
	 */
	private function setup_rest() {
		add_action( 'rest_api_init', array( $this, 'rest_register' ) );
	}
}
