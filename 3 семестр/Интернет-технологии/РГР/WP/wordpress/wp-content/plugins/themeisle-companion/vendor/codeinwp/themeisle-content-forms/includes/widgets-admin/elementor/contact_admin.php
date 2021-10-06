<?php
/**
 * Main class for Elementor Contact Form Custom Widget
 *
 * @package ContentForms
 */

namespace ThemeIsle\ContentForms\Includes\Widgets_Admin\Elementor;

use Elementor\Controls_Manager;

require_once TI_CONTENT_FORMS_PATH . '/includes/widgets-admin/elementor/elementor_widget_base.php';
/**
 * Class Contact_Admin
 */
class Contact_Admin extends Elementor_Widget_Base {

	/**
	 * The type of current widget form.
	 *
	 * @return string
	 */
	public function get_widget_type() {
		return 'contact';
	}

	/**
	 * Elementor Widget Name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'content_form_contact';
	}

	/**
	 * Get Widget Title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Contact Form', 'themeisle-companion' );
	}

	/**
	 * The default values for current widget.
	 *
	 * @return array
	 */
	public function get_default_config() {
		return array(
			array(
				'key'         => 'name',
				'type'        => 'text',
				'label'       => esc_html__( 'Name', 'themeisle-companion' ),
				'requirement' => 'required',
				'placeholder' => esc_html__( 'Name', 'themeisle-companion' ),
				'field_width' => '100',
			),
			array(
				'key'         => 'email',
				'type'        => 'email',
				'label'       => esc_html__( 'Email', 'themeisle-companion' ),
				'requirement' => 'required',
				'placeholder' => esc_html__( 'Email', 'themeisle-companion' ),
				'field_width' => '100',
			),
			array(
				'key'         => 'phone',
				'type'        => 'number',
				'label'       => esc_html__( 'Phone', 'themeisle-companion' ),
				'requirement' => 'optional',
				'placeholder' => esc_html__( 'Phone', 'themeisle-companion' ),
				'field_width' => '100',
			),
			array(
				'key'         => 'message',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Message', 'themeisle-companion' ),
				'requirement' => 'required',
				'placeholder' => esc_html__( 'Message', 'themeisle-companion' ),
				'field_width' => '100',
			),
		);
	}

	/**
	 * No other required fields for this widget.
	 *
	 * @return bool
	 */
	function add_specific_form_fields() {
		return false;
	}

	/**
	 * Add specific settings for Contact Widget.
	 */
	function add_specific_settings_controls() {

		$this->add_control(
			'success_message',
			array(
				'type'    => 'text',
				'label'   => esc_html__( 'Success message', 'themeisle-companion' ),
				'default' => esc_html__( 'Your message has been sent!', 'themeisle-companion' ),
			)
		);

		$this->add_control(
			'error_message',
			array(
				'type'    => 'text',
				'label'   => esc_html__( 'Error message', 'themeisle-companion' ),
				'default' => esc_html__( 'Oops! I cannot send this email!', 'themeisle-companion' ),
			)
		);

		$this->add_control(
			'to_send_email',
			array(
				'type'        => 'text',
				'label'       => esc_html__( 'Send to', 'themeisle-companion' ),
				'default'     => get_bloginfo( 'admin_email' ),
				'description' => esc_html__( 'Where should we send the email?', 'themeisle-companion' ),
			)
		);

		$this->add_control(
			'submit_label',
			array(
				'type'    => 'text',
				'label'   => esc_html__( 'Submit', 'themeisle-companion' ),
				'default' => esc_html__( 'Submit', 'themeisle-companion' ),
			)
		);

		$this->add_responsive_control(
			'align_submit',
			array(
				'label'     => __( 'Alignment', 'themeisle-companion' ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
				'default'   => 'left',
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'themeisle-companion' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'themeisle-companion' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'themeisle-companion' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .content-form .submit-form' => 'text-align: {{VALUE}};',
				),
			)
		);
	}

	/**
	 * Add specific widget settings.
	 */
	function add_widget_specific_settings() {
		return false;
	}

	/**
	 * Add repeater specific fields.
	 *
	 * @param Object $repeater Repeater instance.
	 * @return bool
	 */
	function add_repeater_specific_fields( $repeater ) {
		return false;
	}
}
