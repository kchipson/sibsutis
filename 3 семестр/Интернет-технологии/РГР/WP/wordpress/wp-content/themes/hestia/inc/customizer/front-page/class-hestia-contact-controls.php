<?php
/**
 * Blog section controls.
 *
 * @package Hestia
 */

/**
 * Class Hestia_Blog_Section_Controls
 */
class Hestia_Contact_Controls extends Hestia_Front_Page_Section_Controls_Abstract {

	/**
	 * Add section details
	 *
	 * @return array
	 */
	protected function set_section_data() {
		return array(
			'slug'     => 'contact',
			'title'    => esc_html__( 'Contact', 'hestia' ),
			'priority' => 65,
		);
	}

	/**
	 * Add controls.
	 */
	public function add_controls() {
		$this->add_tabs();
		$this->add_background_control();
		$this->add_form_title_control();
		$this->add_contact_info();
		$this->add_contact_content();
		$this->add_contact_shortcode();
	}

	/**
	 * Add tabs control
	 */
	private function add_tabs() {
		$this->add_control(
			new Hestia_Customizer_Control(
				'hestia_contact_tabs',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'section'  => 'hestia_contact',
					'priority' => 1,
					'tabs'     => array(
						'general' => array(
							'label' => esc_html__( 'General Settings', 'hestia' ),
							'icon'  => 'admin-tools',
						),
						'contact' => array(
							'label' => esc_html__( 'Contact Content', 'hestia' ),
							'icon'  => 'welcome-widgets-menus',
						),
					),
					'controls' => array(
						'general' => array(
							'hestia_contact_hide'       => array(),
							'hestia_contact_title'      => array(),
							'hestia_contact_subtitle'   => array(),
							'hestia_contact_background' => array(),
							'hestia_contact_area_title' => array(),
						),
						'contact' => array(
							'hestia_contact_info'        => array(),
							'hestia_contact_content_new' => array(),
							'hestia_contact_form_shortcode' => array(),
						),
					),
				),
				'Hestia_Customize_Control_Tabs'
			)
		);
	}

	/**
	 * Add control for the background image.
	 */
	private function add_background_control() {
		$this->add_control(
			new Hestia_Customizer_Control(
				'hestia_contact_background',
				array(
					'default'           => apply_filters( 'hestia_contact_background_default', get_template_directory_uri() . '/assets/img/contact.jpg' ),
					'sanitize_callback' => 'esc_url_raw',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Background Image', 'hestia' ),
					'section'  => 'hestia_contact',
					'priority' => 5,
				),
				'WP_Customize_Image_Control'
			)
		);
	}

	/**
	 * Add form title control.
	 */
	private function add_form_title_control() {
		$this->add_control(
			new Hestia_Customizer_Control(
				'hestia_contact_area_title',
				array(
					'default'           => esc_html__( 'Contact Us', 'hestia' ),
					'sanitize_callback' => 'sanitize_text_field',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'    => esc_html__( 'Form Title', 'hestia' ),
					'section'  => 'hestia_contact',
					'priority' => 20,
				)
			)
		);
	}

	/**
	 * Add contact info.
	 */
	private function add_contact_info() {
		$this->add_control(
			new Hestia_Customizer_Control(
				'hestia_contact_info',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'type'       => 'hidden',

					'section'    => 'hestia_contact',
					'capability' => 'install_plugins',
					'priority'   => 25,
				),
				'Hestia_Contact_Info'
			)
		);
	}

	/**
	 * Content control.
	 */
	private function add_contact_content() {
		$this->add_control(
			new Hestia_Customizer_Control(
				'hestia_contact_content_new',
				array(
					'default'           => wp_kses_post( $this->content_default() ),
					'sanitize_callback' => 'wp_kses_post',
					'transport'         => $this->selective_refresh,
				),
				array(
					'label'                      => esc_html__( 'Contact Content', 'hestia' ),
					'section'                    => 'hestia_contact',
					'priority'                   => 30,
					'include_admin_print_footer' => true,
				),
				'Hestia_Page_Editor',
				array(
					'selector'        => '.contactus .col-md-5 > div.hestia-description',
					'settings'        => 'hestia_contact_content_new',
					'render_callback' => array( $this, 'content_render_callback' ),
				)
			)
		);
	}

	/**
	 * Add form shortcode control.
	 */
	private function add_contact_shortcode() {
		$this->add_control(
			new Hestia_Customizer_Control(
				'hestia_contact_form_shortcode',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'label'    => esc_html__( 'Shortcode', 'hestia' ),
					'section'  => 'hestia_contact',
					'priority' => 26,
				)
			)
		);
	}

	/**
	 * Get the contact content control default.
	 *
	 * @return string
	 */
	private function content_default() {
		$contact_section = new Hestia_Contact_Section();

		return $contact_section->content_default();
	}

	/**
	 * Render callback function for contact section content selective refresh
	 *
	 * @since 1.1.31
	 * @access public
	 * @return string
	 */
	public function content_render_callback() {
		return get_theme_mod( 'hestia_contact_content_new' );
	}

	/**
	 * Change necessary controls.
	 *
	 * @return void
	 */
	public function change_controls() {
		$this->change_customizer_object( 'setting', 'hestia_contact_title', 'default', esc_html__( 'Get in Touch', 'hestia' ) );
		$this->change_customizer_object( 'setting', 'hestia_contact_subtitle', 'default', esc_html__( 'Change this subtitle in the Customizer', 'hestia' ) );
	}
}
