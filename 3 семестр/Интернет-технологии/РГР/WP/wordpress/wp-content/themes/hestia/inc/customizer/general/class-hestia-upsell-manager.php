<?php
/**
 * Upsell Manager
 *
 * @package Hestia
 */

/**
 * Class Hestia_Upsell_Manager
 */
class Hestia_Upsell_Manager extends Hestia_Register_Customizer_Controls {
	/**
	 * Add the controls.
	 */
	public function add_controls() {
		$this->register_type( 'Hestia_Section_Upsell', 'section' );
		$this->register_type( 'Hestia_Control_Upsell', 'control' );
		$this->add_main_upsell();

		if ( function_exists( 'hestia_check_passed_time' ) && hestia_check_passed_time( '21600' ) ) {
			$this->add_front_page_sections_upsells();
			$this->add_typography_upsells();
			$this->add_big_title_upsells();
		}
	}

	/**
	 * Change controls
	 */
	public function change_controls() {
		$this->change_customizer_object( 'section', 'hestia_front_page_sections_upsell_section', 'active_callback', '__return_true' );
		$this->change_customizer_object( 'section', 'hestia_front_page_translation_upsell_section', 'active_callback', '__return_true' );
	}

	/**
	 * Adds main
	 */
	private function add_main_upsell() {
		$this->add_section(
			new Hestia_Customizer_Section(
				'hestia_upsell_main_section',
				array(
					'title'    => esc_html__( 'View PRO Features', 'hestia' ),
					'priority' => 0,
				)
			)
		);

		$this->add_control(
			new Hestia_Customizer_Control(
				'hestia_upsell_main_control',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'            => 'hestia_upsell_main_section',
					'priority'           => 100,
					'options'            => array(
						esc_html__( 'Header Slider', 'hestia' ),
						esc_html__( 'Fully Customizable Colors', 'hestia' ),
						esc_html__( 'Jetpack Portfolio', 'hestia' ),
						esc_html__( 'Pricing Plans Section', 'hestia' ),
						esc_html__( 'Section Reordering', 'hestia' ),
						esc_html__( 'Quality Support', 'hestia' ),
					),
					'explained_features' => array(
						esc_html__( 'You will be able to add more content to your site header with an awesome slider.', 'hestia' ),
						esc_html__( 'Change colors for the header overlay, header text and navbar.', 'hestia' ),
						esc_html__( 'Portfolio section with two possible layouts.', 'hestia' ),
						esc_html__( 'A fully customizable pricing plans section.', 'hestia' ),
						esc_html__( 'Drag and drop panels to change the order of sections.', 'hestia' ),
						esc_html__( 'The ability to reorganize your Frontpage Sections more easily and quickly.', 'hestia' ),
						esc_html__( '24/7 HelpDesk Professional Support', 'hestia' ),
					),
					'button_url'         => esc_url( apply_filters( 'hestia_upgrade_link_from_child_theme_filter', 'https://themeisle.com/themes/hestia-pro/upgrade/?utm_medium=customizer&utm_source=button&utm_campaign=profeatures' ) ),
					'button_text'        => esc_html__( 'Get the PRO version!', 'hestia' ),
				),
				'Hestia_Control_Upsell'
			)
		);
	}

	/**
	 * Add upsell section under Front Page Sections panel.
	 */
	private function add_front_page_sections_upsells() {

		$this->add_control(
			new Hestia_Customizer_Control(
				'hestia_control_to_enable_translation_upsell_section',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section' => 'hestia_front_page_translation_upsell_section',
					'type'    => 'hidden',
				)
			)
		);

		$notification_settings = array(
			'panel'              => 'hestia_frontpage_sections',
			'priority'           => 500,
			'explained_features' => array(
				esc_html__( 'Portfolio section with two possible layouts.', 'hestia' ),
				esc_html__( 'A fully customizable pricing plans section.', 'hestia' ),
				esc_html__( 'The ability to reorganize your Frontpage sections more easily and quickly.', 'hestia' ),
			),
			'options'            => array(
				esc_html__( 'Jetpack Portfolio', 'hestia' ),
				esc_html__( 'Pricing Plans Section', 'hestia' ),
				esc_html__( 'Section Reordering', 'hestia' ),
			),
		);

		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		if ( defined( 'POLYLANG_VERSION' ) || defined( 'TRP_PLUGIN_VERSION' ) || ( get_option( 'icl_sitepress_settings' ) !== false ) ) {
			/* translators: %s Required action */
			array_push( $notification_settings['options'], sprintf( esc_html__( 'Hestia front-page is not multi-language compatible, for this feature %s.', 'hestia' ), sprintf( '<a href="%1$s" target="_blank" class="button button-primary" style="margin-top: 20px; margin-bottom: -20px;">%2$s</a>', esc_url( apply_filters( 'hestia_upgrade_link_from_child_theme_filter', 'https://docs.themeisle.com/article/753-hestia-doc?utm_medium=customizer&utm_source=button&utm_campaign=multilanguage#translatehestia' ) ), esc_html__( 'Get the PRO version!', 'hestia' ) ) ) );
		} else {
			$notification_settings['button_url']  = esc_url( apply_filters( 'hestia_upgrade_link_from_child_theme_filter', 'https://themeisle.com/themes/hestia-pro/upgrade?utm_medium=customizer&utm_source=button&utm_campaign=frontpagesection' ) );
			$notification_settings['button_text'] = esc_html__( 'Get the PRO version!', 'hestia' );
		}

		$this->add_section(
			new Hestia_Customizer_Section(
				'hestia_front_page_sections_upsell_section',
				$notification_settings,
				'Hestia_Section_Upsell'
			)
		);

		$this->add_control(
			new Hestia_Customizer_Control(
				'hestia_control_to_enable_upsell_section',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section' => 'hestia_front_page_sections_upsell_section',
					'type'    => 'hidden',
				)
			)
		);
	}

	/**
	 * Typography upsells
	 */
	private function add_typography_upsells() {
		$this->add_control(
			new Hestia_Customizer_Control(
				'hestia_typography_upsell',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'        => 'hestia_typography',
					'priority'       => 230,
					'options'        => array(
						sprintf(
							/* translators: %s is Feature name */
							esc_html__( 'More Options Available for %s in the PRO version.', 'hestia' ),
							esc_html__( 'Typography', 'hestia' )
						),
					),
					'show_pro_label' => false,
					'button_url'     => esc_url( apply_filters( 'hestia_upgrade_link_from_child_theme_filter', 'https://docs.themeisle.com/article/920-typography-options-in-hestia-pro?utm_medium=customizer&utm_source=button&utm_campaign=typography' ) ),
					'button_text'    => esc_html__( 'Read more', 'hestia' ),
				),
				'Hestia_Control_Upsell'
			)
		);
	}

	/**
	 * Big title upsells
	 */
	private function add_big_title_upsells() {
		$this->add_control(
			new Hestia_Customizer_Control(
				'hestia_big_title_upsell',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'        => 'sidebar-widgets-sidebar-big-title',
					'priority'       => -3,
					'options'        => array(
						sprintf(
							/* translators: %s Feature name*/
							esc_html__( 'More Options Available for %s in the PRO version.', 'hestia' ),
							esc_html__( 'Big Title Background', 'hestia' )
						),
					),
					'show_pro_label' => false,
					'button_url'     => esc_url( apply_filters( 'hestia_upgrade_link_from_child_theme_filter', 'https://docs.themeisle.com/article/921-big-title-background-options-in-hestia-pro?utm_medium=customizer&utm_source=button&utm_campaign=bigtitle' ) ),
					'button_text'    => esc_html__( 'Read more', 'hestia' ),
				),
				'Hestia_Control_Upsell'
			)
		);
	}


	/**
	 * Check if should display upsell.
	 *
	 * @since 1.1.45
	 * @access public
	 * @return bool
	 */
	private function should_display_upsells() {
		$current_time    = time();
		$show_after      = 12 * HOUR_IN_SECONDS;
		$activation_time = get_option( 'hestia_time_activated' );

		if ( empty( $activation_time ) ) {
			return false;
		}

		if ( $current_time < $activation_time + $show_after ) {
			return false;
		}

		return true;
	}
}
