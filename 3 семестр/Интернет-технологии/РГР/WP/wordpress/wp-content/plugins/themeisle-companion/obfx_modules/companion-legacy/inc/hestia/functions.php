<?php
/**
 * Companion code for Hestia
 *
 * @author Themeisle
 * @package themeisle-companion
 */

/**
 * Include sections from Companion plugin
 */
function themeisle_hestia_require() {
	if ( function_exists( 'hestia_setup_theme' ) ) {
		$sections_paths = apply_filters( 'themeisle_companion_hestia_sections',array(
			'hestia/inc/features/import-zerif-content.php',
			'hestia/inc/sections/hestia-features-section.php',
			'hestia/inc/sections/hestia-testimonials-section.php',
			'hestia/inc/sections/hestia-team-section.php',
			'hestia/inc/sections/hestia-ribbon-section.php',
			'hestia/inc/sections/hestia-clients-bar-section.php',
		) );
		themeisle_hestia_require_files( $sections_paths );
	}
}


/**
 * Include customizer controls in customizer
 */
function themeisle_hestia_load_controls() {
	if ( function_exists( 'hestia_setup_theme' ) ) {
		$features_paths = apply_filters( 'themeisle_companion_hestia_controls',array(
			'hestia/inc/features/feature-features-section.php',
			'hestia/inc/features/feature-testimonials-section.php',
			'hestia/inc/features/feature-team-section.php',
			'hestia/inc/features/feature-ribbon-section.php',
			'hestia/inc/features/feature-clients-bar-section.php',
			'hestia/inc/customizer.php',
		) );
		themeisle_hestia_require_files( $features_paths );
	}
}

/**
 * This function iterates thorough an array of file paths, checks if the file exist and if it does, it require the
 * file in plugin.
 *
 * @param array $array Array of files to require.
 */
function themeisle_hestia_require_files( $array ) {
	foreach ( $array as $path ) {
		$file_path = trailingslashit( THEMEISLE_COMPANION_PATH ) . $path;
		if ( file_exists( $file_path ) ) {
			require_once( $file_path );
		}
	}
}

/**
 * Set Front page displays option to A static page
 */
function themeisle_hestia_set_frontpage() {
	if ( function_exists( 'hestia_setup_theme' ) ) {
		$is_fresh_site = get_option( 'fresh_site' );
		if ( (bool) $is_fresh_site === false ) {
			$frontpage_title = esc_html__( 'Front Page', 'themeisle-companion' );
			$front_id = themeisle_hestia_create_page( 'hestia-front', $frontpage_title );
			$blogpage_title = esc_html__( 'Blog', 'themeisle-companion' );
			$blog_id = themeisle_hestia_create_page( 'blog', $blogpage_title );
			set_theme_mod( 'show_on_front','page' );
			update_option( 'show_on_front', 'page' );
			if ( ! empty( $front_id ) ) {
				update_option( 'page_on_front', $front_id );
			}
			if ( ! empty( $blog_id ) ) {
				update_option( 'page_for_posts', $blog_id );
			}
		}
	}
}

/**
 * Function that checks if a page with a slug exists. If not, it create one.
 *
 * @param string $slug Page slug.
 * @param string $page_title Page title.
 * @return int
 */
function themeisle_hestia_create_page( $slug, $page_title ) {
	// Check if page exists
	$args = array(
		'name'        => $slug,
		'post_type'   => 'page',
		'post_status' => 'publish',
		'numberposts' => 1,
	);
	$post = get_posts( $args );
	if ( ! empty( $post ) ) {
		$page_id = $post[0]->ID;
	} else {
		// Page doesn't exist. Create one.
		$postargs = array(
			'post_type'     => 'page',
			'post_name'     => $slug,
			'post_title'    => $page_title,
			'post_status'   => 'publish',
			'post_author'   => 1,
		);
		// Insert the post into the database
		$page_id = wp_insert_post( $postargs );
	}
	return $page_id;
}

/**
 * Enqueue style for clients bar to make sure that style doesn't brake after removing bootstrap on this section.
 * Note: this can be deleted in a future version. It's just for maintaining compatibility, if user updates plugin but
 * not the theme.
 */
function themeisle_hestia_enqueue_clients_style(){
	wp_enqueue_style( 'hestia-clients-bar', trailingslashit( THEMEISLE_COMPANION_URL ) . 'assets/css/hestia/clients-bar.css' );
}