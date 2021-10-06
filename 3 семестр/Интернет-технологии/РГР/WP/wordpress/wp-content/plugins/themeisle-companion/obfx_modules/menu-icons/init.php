<?php
/**
 * The module for menu icons.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Menu_Icons_OBFX_Module
 */

/**
 * The class for menu icons.
 *
 * @package    Menu_Icons_OBFX_Module
 * @author     Themeisle <friends@themeisle.com>
 * @codeCoverageIgnore
 */
class Menu_Icons_OBFX_Module extends Orbit_Fox_Module_Abstract {

	/**
	 * The default icon to use.
	 */
	const DEFAULT_ICON	= 'dashicons-obfx-default-icon';

	/**
	 * Menu_Icons_OBFX_Module constructor.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function __construct() {
		parent::__construct();
		$this->name        = __( 'Menu Icons', 'themeisle-companion' );
		$this->description = __( 'Module to define menu icons for navigation.', 'themeisle-companion' );
		$this->active_default = true;

		add_action( 'admin_init', array( $this, 'check_conflict' ) , 99 );
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
	}

	/**
	 * Method to define hooks needed.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function hooks() {
		$this->loader->add_action( 'wp_update_nav_menu_item', $this, 'save_fields', 10, 3 );
		// Do not change the priority of this from 1.
		$this->loader->add_filter( 'wp_edit_nav_menu_walker', $this, 'custom_walker', 1 );
		$this->loader->add_filter( 'wp_setup_nav_menu_item', $this, 'show_menu', 10, 1 );

	}

	/**
	 * Show the menu item.
	 *
	 * @access  public
	 * @return WP_Post $menu the menu object.
	 */
	public function show_menu( $menu ) {
		$icon	= get_post_meta( $menu->ID, 'obfx_menu_icon', true );
		if ( ! empty( $icon ) ) {
			$menu->icon = $icon;
			if ( ! is_admin() ) {
				// usually, icons are of the format fa-x or dashicons-x and when displayed they are displayed with classes 'fa fa-x' or 'dashicons dashicons-x'.
				// so let's determine the prefix class.
				$array			= explode( '-', $icon );
				$prefix			= reset( $array );
				$prefix			= apply_filters( 'obfx_menu_icons_icon_class', $prefix, $icon );
				$menu->title	= sprintf( '<i class="obfx-menu-icon %s %s"></i>%s', $prefix, $icon, $menu->title );
			}
		}
		return $menu;
	}

	/**
	 * Return the custom walker.
	 *
	 * @access  public
	 * @return Walker_Nav_Menu_Edit $walker the walker.
	 */
	public function custom_walker( $walker ) {
		if ( ! class_exists( 'Menu_Icons_OBFX_Walker' ) ) {
			require_once $this->get_dir() . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'class-menu-icons-obfx-walker.php';
		}
		$walker = 'Menu_Icons_OBFX_Walker';
		return $walker;
	}

	/**
	 * Check if font awesome should load.
	 *
	 * @return bool
	 */
	private function should_load_fa(){

		// Get all locations
		$locations = get_nav_menu_locations();

		if( empty( $locations ) ){
			return false;
		}
		foreach ( $locations as $location => $menu_id ){
			$menu_items = wp_get_nav_menu_items( $menu_id );
			if ( ! is_array( $menu_items ) ) {
				continue;
			}
			foreach ( $menu_items as $menu_item ) {
				$icon = get_post_meta( $menu_item->ID, 'obfx_menu_icon', true );
				if ( !empty( $icon ) ){
					return true;
				}
			}
		}

		return false;
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
		if( $this->should_load_fa() === false ){
			return array();
		}

		return array(
			'css' => array(
				'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' => array( 'dashicons' ),
				'public' => false,
			),
		);
	}

	/**
	 * Method that returns an array of scripts and styles to be loaded
	 * for the admin part.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public function admin_enqueue() {
		$current_screen = get_current_screen();

		if ( ! isset( $current_screen->id ) ) {
			return array();
		}
		if ( $current_screen->id != 'nav-menus' ) {
			return array();
		}

		// Our walker has not been registered because another custom walker exists.
		if ( ! class_exists( 'Menu_Icons_OBFX_Walker' ) ) {
			return array();
		}

		$this->localized	= array(
			'admin'		=> array(
				'icons'	=> apply_filters( 'obfx_menu_icons_icon_list', $this->get_dashicons() ),
				'icon_default' => self::DEFAULT_ICON,
				'i10n' => array(
					'powered_by' => sprintf( __( 'Powered by %s plugin', 'themeisle-companion' ), '<b>' . apply_filters( 'themeisle_companion_friendly_name', '' ) . '</b>' ),
				),
			),
		);

		$font_awesome = array(
			'vendor/font-awesome.min' => false,
			'vendor/fontawesome-iconpicker.min' => array( 'vendor/font-awesome.min' ),
		);
		if ( wp_style_is( 'font-awesome', 'registered' ) || wp_style_is( 'font-awesome', 'enqueued' ) ) {
			$font_awesome = array(
				'vendor/fontawesome-iconpicker.min' => array( 'font-awesome' ),
			);
		}

		return array(
			'css' => array_merge(
				$font_awesome,
				array(
					'admin' => array( 'vendor/fontawesome-iconpicker.min' ),
				)
			),
			'js' => array(
				'vendor/bootstrap.min' => array( 'jquery' ),
				'vendor/fontawesome-iconpicker.min' => array( 'vendor/bootstrap.min' ),
				'admin' => array( 'vendor/fontawesome-iconpicker.min', 'jquery' ),
			),
		);
	}

	/**
	 * Method to define the options fields for the module
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public function options() {
		return array();
	}

	/**
	 * Return all the dashicons.
	 *
	 * @access  private
	 * @return array
	 */
	private function get_dashicons() {
		return array( 'dashicons-menu', 'dashicons-admin-site', 'dashicons-dashboard', 'dashicons-admin-post', 'dashicons-admin-media', 'dashicons-admin-links', 'dashicons-admin-page', 'dashicons-admin-comments', 'dashicons-admin-appearance', 'dashicons-admin-plugins', 'dashicons-admin-users', 'dashicons-admin-tools', 'dashicons-admin-settings', 'dashicons-admin-network', 'dashicons-admin-home', 'dashicons-admin-generic', 'dashicons-admin-collapse', 'dashicons-welcome-write-blog', 'dashicons-welcome-add-page', 'dashicons-welcome-view-site', 'dashicons-welcome-widgets-menus', 'dashicons-welcome-comments', 'dashicons-welcome-learn-more', 'dashicons-format-aside', 'dashicons-format-image', 'dashicons-format-gallery', 'dashicons-format-video', 'dashicons-format-status', 'dashicons-format-quote', 'dashicons-format-chat', 'dashicons-format-audio', 'dashicons-camera', 'dashicons-images-alt', 'dashicons-images-alt2', 'dashicons-video-alt', 'dashicons-video-alt2', 'dashicons-video-alt3', 'dashicons-image-crop', 'dashicons-image-rotate-left', 'dashicons-image-rotate-right', 'dashicons-image-flip-vertical', 'dashicons-image-flip-horizontal', 'dashicons-undo', 'dashicons-redo', 'dashicons-editor-bold', 'dashicons-editor-italic', 'dashicons-editor-ul', 'dashicons-editor-ol', 'dashicons-editor-quote', 'dashicons-editor-alignleft', 'dashicons-editor-aligncenter', 'dashicons-editor-alignright', 'dashicons-editor-insertmore', 'dashicons-editor-spellcheck', 'dashicons-editor-distractionfree', 'dashicons-editor-kitchensink', 'dashicons-editor-underline', 'dashicons-editor-justify', 'dashicons-editor-textcolor', 'dashicons-editor-paste-word', 'dashicons-editor-paste-text', 'dashicons-editor-removeformatting', 'dashicons-editor-video', 'dashicons-editor-customchar', 'dashicons-editor-outdent', 'dashicons-editor-indent', 'dashicons-editor-help', 'dashicons-editor-strikethrough', 'dashicons-editor-unlink', 'dashicons-editor-rtl', 'dashicons-align-left', 'dashicons-align-right', 'dashicons-align-center', 'dashicons-align-none', 'dashicons-lock', 'dashicons-calendar', 'dashicons-visibility', 'dashicons-post-status', 'dashicons-edit', 'dashicons-trash', 'dashicons-arrow-up', 'dashicons-arrow-down', 'dashicons-arrow-right', 'dashicons-arrow-left', 'dashicons-arrow-up-alt', 'dashicons-arrow-down-alt', 'dashicons-arrow-right-alt', 'dashicons-arrow-left-alt', 'dashicons-arrow-up-alt2', 'dashicons-arrow-down-alt2', 'dashicons-arrow-right-alt2', 'dashicons-arrow-left-alt2', 'dashicons-sort', 'dashicons-leftright', 'dashicons-list-view', 'dashicons-exerpt-view', 'dashicons-share', 'dashicons-share-alt', 'dashicons-share-alt2', 'dashicons-twitter', 'dashicons-rss', 'dashicons-email', 'dashicons-email-alt', 'dashicons-facebook', 'dashicons-facebook-alt', 'dashicons-googleplus', 'dashicons-networking', 'dashicons-hammer', 'dashicons-art', 'dashicons-migrate', 'dashicons-performance', 'dashicons-wordpress', 'dashicons-wordpress-alt', 'dashicons-pressthis', 'dashicons-update', 'dashicons-screenoptions', 'dashicons-info', 'dashicons-cart', 'dashicons-feedback', 'dashicons-cloud', 'dashicons-translation', 'dashicons-tag', 'dashicons-category', 'dashicons-yes', 'dashicons-no', 'dashicons-no-alt', 'dashicons-plus', 'dashicons-minus', 'dashicons-dismiss', 'dashicons-marker', 'dashicons-star-filled', 'dashicons-star-half', 'dashicons-star-empty', 'dashicons-flag', 'dashicons-location', 'dashicons-location-alt', 'dashicons-vault', 'dashicons-shield', 'dashicons-shield-alt', 'dashicons-sos', 'dashicons-search', 'dashicons-slides', 'dashicons-analytics', 'dashicons-chart-pie', 'dashicons-chart-bar', 'dashicons-chart-line', 'dashicons-chart-area', 'dashicons-groups', 'dashicons-businessman', 'dashicons-id', 'dashicons-id-alt', 'dashicons-products', 'dashicons-awards', 'dashicons-forms', 'dashicons-testimonial', 'dashicons-portfolio', 'dashicons-book', 'dashicons-book-alt', 'dashicons-download', 'dashicons-upload', 'dashicons-backup', 'dashicons-clock', 'dashicons-lightbulb', 'dashicons-desktop', 'dashicons-tablet', 'dashicons-smartphone', 'dashicons-smiley' );
	}

	/**
	 * Save menu item's icon.
	 *
	 * @access  public
	 *
	 * @param int   $menu_id         Nav menu ID.
	 * @param int   $menu_item_db_id Menu item ID.
	 * @param array $menu_item_args  Menu item data.
	 */
	public static function save_fields( $menu_id, $menu_item_db_id, $menu_item_args ) {
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		if ( ! function_exists( 'get_current_screen' ) ) {
		    return;
        }

		$screen = get_current_screen();
		if ( ! $screen instanceof WP_Screen || 'nav-menus' !== $screen->id ) {
			return;
		}

		check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

		if ( isset( $_POST['menu-item-icon'][ $menu_item_db_id ] ) ) {
			$icon	= $_POST['menu-item-icon'][ $menu_item_db_id ];
			if ( self::DEFAULT_ICON === $icon ) {
				$icon	= '';
			}
			update_post_meta( $menu_item_db_id, 'obfx_menu_icon', $icon );
		}

	}

	/**
	 * Checks if there is any conflict with a theme/plugin.
	 */
	public function check_conflict() {
		// We need to include this so that the wp_edit_nav_menu_walker filter does not misbehave.
		require_once( ABSPATH . 'wp-admin/includes/nav-menu.php' );

		// Let's check if another walker has been defined.
		$walker = apply_filters( 'wp_edit_nav_menu_walker', '', '' );

		// Yes, a conflict!
		if ( ! empty( $walker ) && $walker !== 'Menu_Icons_OBFX_Walker' ) {
			$reflector	= new ReflectionClass( $walker );
			$path		= str_replace( '\\', '/', $reflector->getFileName() );

			$name		= '';
			$type		= '';
			if ( false !== strpos( $path, 'themes' ) ) {
				$type	= __( 'theme', 'themeisle-companion' );
				$theme	= wp_get_theme();
				$name	= $theme->get( 'Name' );
			} else {
				$path = explode( 'plugins', $path );
				$path = explode( DIRECTORY_SEPARATOR, isset($path[1]) ? $path[1] : '' );
				$path = array_values( array_filter( $path ) );
				if ( isset( $path[0] ) ) {
					$name = '&nbsp; <b>' . esc_attr( $path[0] ) . '</b>';
				}
				$type = __( 'plugin', 'themeisle-companion' );
			}

			$this->description .= '<br><i class="chip">' . sprintf( __( 'There appears to be a conflict with the %s %s. This module may not work as expected.', 'themeisle-companion' ), $type, $name ) . '</i>';
			$this->active_default = false;
		}
	}
}
