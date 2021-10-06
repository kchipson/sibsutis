<?php
/**
 * Beaver Contact Widget main class.
 *
 * @package ContentForms
 */

namespace ThemeIsle\ContentForms\Includes\Widgets_Admin\Beaver;

require_once 'beaver_widget_base.php';

/**
 * Class Contact_Admin
 * @package ThemeIsle\ContentForms\Includes\Widgets_Admin\Beaver
 */
class Contact_Admin extends Beaver_Widget_Base {

	/**
	 * Widget name.
	 *
	 * @return string
	 */
	function get_widget_name() {
		return esc_html__( 'Contact Form', 'themeisle-companion' );
	}

	/**
	 * Define the form type
	 * @return string
	 */
	public function get_type() {
		return 'contact';
	}

	/**
	 * Set default values for registration widget.
	 *
	 * @return array
	 */
	public function widget_default_values() {
		return array(
			'fields'          => array(
				array(
					'key'         => 'name',
					'label'       => esc_html__( 'Name', 'themeisle-companion' ),
					'placeholder' => esc_html__( 'Name', 'themeisle-companion' ),
					'type'        => 'text',
					'field_width' => '100',
					'required'    => 'required',
				),
				array(
					'key'         => 'email',
					'label'       => esc_html__( 'Email', 'themeisle-companion' ),
					'placeholder' => esc_html__( 'Email', 'themeisle-companion' ),
					'type'        => 'email',
					'field_width' => '100',
					'required'    => 'required',
				),
				array(
					'key'         => 'phone',
					'label'       => esc_html__( 'Phone', 'themeisle-companion' ),
					'placeholder' => esc_html__( 'Phone', 'themeisle-companion' ),
					'type'        => 'number',
					'field_width' => '100',
					'required'    => 'optional',
				),
				array(
					'key'         => 'message',
					'label'       => esc_html__( 'Message', 'themeisle-companion' ),
					'placeholder' => esc_html__( 'Message', 'themeisle-companion' ),
					'type'        => 'textarea',
					'field_width' => '100',
					'required'    => 'required',
				),
			),
			'submit_label'    => esc_html__( 'Submit', 'themeisle-companion' ),
			'success_message' => esc_html__( 'Your message has been sent!', 'themeisle-companion' ),
			'error_message'   => esc_html__( 'Oops! I cannot send this email!', 'themeisle-companion' ),
		);
	}

	/**
	 * Contact_Admin constructor.
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'        => esc_html__( 'Contact', 'themeisle-companion' ),
				'description' => esc_html__( 'A contact form.', 'themeisle-companion' ),
				'category'    => esc_html__( 'Orbit Fox Modules', 'themeisle-companion' ),
				'dir'         => dirname( __FILE__ ),
				'url'         => plugin_dir_url( __FILE__ ),
			)
		);
	}

	/**
	 * Add map field for Contact field
	 * @param array $fields Repeater fields.
	 * @return array
	 */
	public function add_widget_repeater_fields( $fields ) {
		return $fields;
	}

	/**
	 * Add specific controls for this type of widget.
	 *
	 * @param array $fields Fields config.
	 *
	 * @return array
	 */
	public function add_widget_specific_controls( $fields ) {
		$fields['fields'] = array(
			'success_message' => array(
				'type'    => 'text',
				'label'   => esc_html__( 'Success message', 'themeisle-companion' ),
				'default' => $this->get_default( 'success_message' ),
			),
			'error_message'   => array(
				'type'    => 'text',
				'label'   => esc_html__( 'Error message', 'themeisle-companion' ),
				'default' => $this->get_default( 'error_message' ),
			),
			'to_send_email'   => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Send to', 'themeisle-companion' ),
				'description' => esc_html__( 'Where should we send the email?', 'themeisle-companion' ),
				'default'     => get_bloginfo( 'admin_email' ),
			),
		) + $fields['fields'];
		return $fields;
	}
}
