<?php
/**
 * Header View Manager
 *
 * @package Hestia
 */

/**
 * Class Hestia_Header_Manager
 */
class Hestia_Header extends Hestia_Abstract_Main {
	/**
	 * Add hooks for the front end.
	 */
	public function init() {
		add_action( 'hestia_do_header', array( $this, 'navigation' ) );
		add_filter( 'wp_nav_menu_args', array( $this, 'modify_primary_menu' ) );
	}

	/**
	 * Render navigation
	 */
	public function navigation() {
		if ( apply_filters( 'hestia_filter_components_toggle', false, 'header' ) === true ) {
			return;
		}
		$nav_classes = $this->header_classes(); ?>
		<nav class="navbar navbar-default navbar-fixed-top <?php echo esc_attr( $nav_classes ); ?>">
			<?php hestia_before_header_content_trigger(); ?>
			<div class="container">
				<?php
				if ( ! $this->is_full_screen_menu() ) {
					$this->navbar_sidebar();
				}
				$this->navbar_header();
				if ( apply_filters( 'hestia_header_show_primary_menu', true ) ) {
					$this->render_primary_menu();
				}
				?>
			</div>
			<?php hestia_after_header_content_trigger(); ?>
		</nav>
		<?php
	}

	/**
	 * Get the header class.
	 *
	 * @return string
	 */
	private function header_classes() {
		$class  = '';
		$class .= $this->get_transparent_nav_class();
		$class .= $this->get_nav_alignment_class();
		$class .= $this->get_full_screen_menu_class();
		$class .= $this->get_top_bar_enabled_class();
		if ( ! is_front_page() ) {
			$class .= ' navbar-not-transparent';
		}

		return $class;
	}

	/**
	 * Get the header alignment class.
	 *
	 * @return string
	 */
	private function get_nav_alignment_class() {
		$header_alignment = get_theme_mod( 'hestia_header_alignment', apply_filters( 'hestia_header_alignment_default', 'left' ) );
		if ( ! empty( $header_alignment ) ) {
			return ' hestia_' . $header_alignment;
		}

		return '';
	}

	/**
	 * Render primary menu markup.
	 */
	private function render_primary_menu() {
		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container'       => 'div',
				'container_class' => 'collapse navbar-collapse',
				'container_id'    => 'main-navigation',
				'menu_class'      => 'nav navbar-nav',
				'fallback_cb'     => 'Hestia_Bootstrap_Navwalker::fallback',
				'walker'          => new Hestia_Bootstrap_Navwalker(),
			)
		);
	}

	/**
	 * Render navbar toggle markup.
	 */
	private function render_navbar_toggle() {
		if ( ! has_nav_menu( 'primary' ) ) {
			return;
		}
		?>
		<div class="navbar-toggle-wrapper">
			<?php
			hestia_before_navbar_toggle_trigger();
			?>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navigation">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="sr-only"><?php esc_html_e( 'Toggle Navigation', 'hestia' ); ?></span>
			</button>
			<?php
			hestia_after_navbar_toggle_trigger();
			?>
		</div>
		<?php
	}

	/**
	 * Render the navigation bar Sidebar.
	 */
	private function navbar_sidebar() {
		$header_alignment = get_theme_mod( 'hestia_header_alignment', apply_filters( 'hestia_header_alignment_default', 'left' ) );

		if ( $header_alignment !== 'right' ) {
			return false;
		}

		if ( ! is_active_sidebar( 'header-sidebar' ) && is_customize_preview() ) {
			hestia_sidebar_placeholder( 'hestia-sidebar-header', 'header-sidebar', 'no-variable-width header-sidebar-wrapper' );
			return false;
		}

		echo '<div class="header-sidebar-wrapper">';
		if ( is_active_sidebar( 'header-sidebar' ) ) {
			?>
				<div class="header-widgets-wrapper">
					<?php
					dynamic_sidebar( 'header-sidebar' );
					?>
				</div>
			<?php
		}
		echo '</div>';

		return true;
	}

	/**
	 * Get class if navbar should be transparent.
	 *
	 * @return string
	 */
	private function get_transparent_nav_class() {
		$class = ' navbar-color-on-scroll navbar-transparent';

		$disabled_frontpage = get_theme_mod( 'disable_frontpage_sections', false );
		if ( true === (bool) $disabled_frontpage ) {
			$class = '';
		}

		if ( get_option( 'show_on_front' ) !== 'page' ) {
			$class = '';
		}
		if ( ! is_front_page() ) {
			$class = '';
		}
		if ( is_front_page() && is_home() ) {
			return '';
		}
		if ( is_page_template() ) {
			$class = '';
		}

		$is_nav_transparent = get_theme_mod( 'hestia_navbar_transparent', apply_filters( 'hestia_navbar_transparent_default', true ) );
		if ( ! $is_nav_transparent ) {
			$class = '';
		}

		$hestia_navbar_transparent = get_theme_mod( 'hestia_big_title_hide', false );
		if ( $hestia_navbar_transparent ) {
			$class = ' no-slider';
		}

		return $class;
	}

	/**
	 * Get the full screen menu class.
	 *
	 * @return string
	 */
	private function get_full_screen_menu_class() {
		if ( $this->is_full_screen_menu() ) {
			return ' full-screen-menu';
		}

		return '';
	}

	/**
	 * Utility to check if is full screen menu.
	 *
	 * @return bool
	 */
	protected function is_full_screen_menu() {
		$has_full_screen_menu = get_theme_mod( 'hestia_full_screen_menu', false );
		if ( (bool) $has_full_screen_menu === true ) {
			return true;
		}

		return false;
	}

	/**
	 * Get the header class if top bar is enabled.
	 *
	 * @return string
	 */
	private function get_top_bar_enabled_class() {
		$is_top_bar_hidden = get_theme_mod( 'hestia_top_bar_hide', true );
		if ( (bool) $is_top_bar_hidden === false ) {
			return ' header-with-topbar';
		}

		return '';
	}

	/**
	 * Do the navbar header.
	 */
	private function navbar_header() {
		?>
		<div class="navbar-header">
			<div class="title-logo-wrapper">
				<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"
						title="<?php bloginfo( 'name' ); ?>">
					<?php echo self::logo(); ?></a>
			</div>
			<?php
			if ( $this->is_full_screen_menu() ) {
				$this->navbar_sidebar();
			}
			?>
			<?php $this->render_navbar_toggle(); ?>
		</div>
		<?php
	}

	/**
	 * Display your custom logo if present.
	 *
	 * @since Hestia 1.0
	 */
	public static function logo() {

		$logo = '<p>' . get_bloginfo( 'name' ) . '</p>';

		$transparent_header = get_theme_mod( 'hestia_navbar_transparent', apply_filters( 'hestia_navbar_transparent_default', true ) );
		$main_logo          = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
		$main_logo          = $main_logo[0];
		$transparent_logo   = wp_get_attachment_image_src( get_theme_mod( 'hestia_transparent_header_logo' ), 'full' );
		$transparent_logo   = $transparent_logo[0];

		if ( empty( $main_logo ) && ( empty( $transparent_logo ) || $transparent_header === false ) ) {
			return $logo;
		}

		/**
		 * Make transparent logo as default logo if main logo is missing.
		 */
		if ( empty( $main_logo ) && ! empty( $transparent_logo ) && $transparent_header === true ) {
			$logo = '<p class="hestia-hide-if-transparent">' . get_bloginfo( 'name' ) . '</p>';
		}

		if ( ! empty( $main_logo ) ) {
			$class         = ! empty( $transparent_logo ) ? 'class="hestia-hide-if-transparent"' : '';
			$alt_attribute = get_post_meta( get_theme_mod( 'custom_logo' ), '_wp_attachment_image_alt', true );
			$alt_attribute = ! empty( $alt_attribute ) ? $alt_attribute : get_bloginfo( 'name' );
			$logo          = '<img ' . $class . ' src="' . esc_url( $main_logo ) . '" alt="' . esc_attr( $alt_attribute ) . '">';
		}

		if ( ! empty( $transparent_logo ) && $transparent_header === true ) {
			$transparent_logo_attachment_id = attachment_url_to_postid( $transparent_logo );
			$transparent_logo_alt_attribute = get_post_meta( $transparent_logo_attachment_id, '_wp_attachment_image_alt', true );
			$transparent_logo_alt_attribute = ! empty( $transparent_logo_alt_attribute ) ? $transparent_logo_alt_attribute : get_bloginfo( 'name' );
			$logo                          .= '<img class="hestia-transparent-logo" src="' . esc_url( $transparent_logo ) . '" alt="' . esc_attr( $transparent_logo_alt_attribute ) . '">';
		}

		return $logo;
	}

	/**
	 * Filter Primary Navigation to add navigation cart and search.
	 *
	 * @param string $markup the markup for the navigation addons.
	 *
	 * @access public
	 * @return mixed
	 */
	public function modify_primary_menu( $markup ) {
		if ( 'primary' !== $markup['theme_location'] ) {
			return $markup;
		}
		$markup['items_wrap'] = $this->display_filtered_navigation();

		return $markup;
	}

	/**
	 * Display navigation.
	 *
	 * @return string
	 */
	private function display_filtered_navigation() {
		$nav  = '<ul id="%1$s" class="%2$s">';
		$nav .= '%3$s';
		$nav .= apply_filters( 'hestia_after_primary_navigation_addons', $this->search_in_menu() );
		$nav .= '</ul>';

		return $nav;
	}

	/**
	 * Display search form in menu.
	 */
	private function search_in_menu() {
		$search_in_menu = get_theme_mod( 'hestia_search_in_menu', false );

		if ( (bool) $search_in_menu === false ) {
			return '';
		}
		add_filter( 'get_search_form', array( $this, 'filter_search_form' ) );
		$form = get_search_form( false );
		remove_filter( 'get_search_form', array( $this, 'filter_search_form' ) );

		return $form;
	}

	/**
	 * Filter the search form to adapt to our needs.
	 *
	 * @param string $form search form markup.
	 *
	 * @return string
	 */
	public function filter_search_form( $form ) {
		$output  = '';
		$output .= '<li class="hestia-search-in-menu">';
		$output .= '<div class="hestia-nav-search">';
		$output .= $form;
		$output .= '</div>';
		$output .= '<a class="hestia-toggle-search"><i class="fas fa-search"></i></a>';
		$output .= '</li>';

		return $output;
	}
}
