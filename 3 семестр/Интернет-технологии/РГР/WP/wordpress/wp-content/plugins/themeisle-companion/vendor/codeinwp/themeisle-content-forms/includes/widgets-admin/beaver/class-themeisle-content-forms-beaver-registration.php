<?php

namespace ThemeIsle\ContentForms\Includes\Widgets_Admin\Beaver;

use ThemeIsle\ContentForms\Form_Manager;

require_once 'beaver_widget_base.php';


class Registration_Admin extends Beaver_Widget_Base {

	/**
	 * Widget name.
	 *
	 * @return string
	 */
	function get_widget_name() {
		return esc_html__( 'Registration Form', 'themeisle-companion' );
	}

	/**
	 * Define the form type
	 * @return string
	 */
	public function get_type() {
		return 'registration';
	}

	/**
	 * Set default values for registration widget.
	 *
	 * @return array
	 */
	public function widget_default_values() {
		return array(
			'fields'       => array(
				array(
					'key'         => 'username',
					'label'       => esc_html__( 'User Name', 'themeisle-companion' ),
					'placeholder' => esc_html__( 'User Name', 'themeisle-companion' ),
					'type'        => 'text',
					'required'    => 'required',
					'field_map'   => 'user_login',
					'field_width' => '100',
				),
				array(
					'key'         => 'email',
					'label'       => esc_html__( 'Email', 'themeisle-companion' ),
					'placeholder' => esc_html__( 'Email', 'themeisle-companion' ),
					'type'        => 'email',
					'required'    => 'required',
					'field_map'   => 'user_email',
					'field_width' => '100',
				),
				array(
					'key'         => 'password',
					'label'       => esc_html__( 'Password', 'themeisle-companion' ),
					'placeholder' => esc_html__( 'Password', 'themeisle-companion' ),
					'type'        => 'password',
					'required'    => 'required',
					'field_map'   => 'user_pass',
					'field_width' => '100',
				),
			),
			'submit_label' => esc_html__( 'Register', 'themeisle-companion' ),
		);
	}

	/**
	 * Registration_Admin constructor.
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'        => esc_html__( 'Registration', 'themeisle-companion' ),
				'description' => esc_html__( 'A sign up form.', 'themeisle-companion' ),
				'category'    => esc_html__( 'Orbit Fox Modules', 'themeisle-companion' ),
				'dir'         => dirname( __FILE__ ),
				'url'         => plugin_dir_url( __FILE__ ),
			)
		);
	}

	/**
	 * Add widget repeater fields specific for contact widget.
	 *
	 * @param array $fields Widget fields.
	 *
	 * @return array
	 */
	function add_widget_repeater_fields( $fields ) {
		$field_types = array(
			'first_name'   => __( 'First Name', 'themeisle-companion' ),
			'last_name'    => __( 'Last Name', 'themeisle-companion' ),
			'user_pass'    => __( 'Password', 'themeisle-companion' ),
			'user_login'   => __( 'Username', 'themeisle-companion' ),
			'user_email'   => __( 'Email', 'themeisle-companion' ),
			'display_name' => __( 'Display Name', 'themeisle-companion' ),
		);

		$fields['field_map'] = array(
			'label'   => __( 'Map field to', 'themeisle-companion' ),
			'type'    => 'select',
			'options' => $field_types,
		);
		return $fields;
	}

	/**
	 * Add specific controls for this type of widget.
	 *
	 * @param array $fields Fields config.
	 *
	 * @return array
	 */
	function add_widget_specific_controls( $fields ) {
		$roles = Form_Manager::get_user_roles();
		if ( ! current_user_can( 'manage_options' ) ) {
			return $fields;
		}
		$fields['fields'] = array(
			'user_role' => array(
				'type'    => 'select',
				'label'   => __( 'Register user as:', 'themeisle-companion' ),
				'default' => 'subscriber',
				'options' => $roles,
			),
		) + $fields['fields'];

		return $fields;
	}
}
