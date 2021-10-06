<?php
/**
 * Beaver Newsletter Widget main class.
 *
 * @package ContentForms
 */

namespace ThemeIsle\ContentForms\Includes\Widgets_Admin\Beaver;

require_once 'beaver_widget_base.php';

/**
 * Class Newsletter_Admin
 * @package ThemeIsle\ContentForms\Includes\Widgets_Admin\Beaver
 */
class Newsletter_Admin extends Beaver_Widget_Base {


	/**
	 * Widget name.
	 *
	 * @return string
	 */
	function get_widget_name() {
		return esc_html__( 'Newsletter Form', 'themeisle-companion' );
	}

	/**
	 * Define the form type
	 * @return string
	 */
	public function get_type() {
		return 'newsletter';
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
					'key'         => 'email',
					'label'       => esc_html__( 'Email', 'themeisle-companion' ),
					'placeholder' => esc_html__( 'Email', 'themeisle-companion' ),
					'type'        => 'email',
					'required'    => 'required',
					'field_map'   => 'email',
					'field_width' => '75',
				),
			),
			'submit_label'    => esc_html__( 'Join Newsletter', 'themeisle-companion' ),
			'success_message' => esc_html__( 'Welcome to our newsletter!', 'themeisle-companion' ),
			'error_message'   => esc_html__( 'Action failed!', 'themeisle-companion' ),
		);
	}

	/**
	 * Newsletter_Admin constructor.
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'        => esc_html__( 'Newsletter', 'themeisle-companion' ),
				'description' => esc_html__( 'A simple newsletter form.', 'themeisle-companion' ),
				'category'    => esc_html__( 'Orbit Fox Modules', 'themeisle-companion' ),
				'dir'         => dirname( __FILE__ ),
				'url'         => plugin_dir_url( __FILE__ ),
			)
		);
	}

	/**
	 * Add map field for Newsletter field
	 * @param array $fields Repeater fields.
	 * @return array
	 */
	public function add_widget_repeater_fields( $fields ) {

		$fields['field_map'] = array(
			'label' => __( 'Map field to', 'themeisle-companion' ),
			'type'  => 'text',
		);
		return $fields;
	}

	/**
	 * Add specific controls for this type of widget.
	 *
	 * @param array $fields Fields config.
	 * @return array
	 */
	public function add_widget_specific_controls( $fields ) {
		$fields['fields'] = array(
			'provider'        => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Subscribe to', 'themeisle-companion' ),
				'options' => array(
					'mailchimp'  => esc_html__( 'MailChimp', 'themeisle-companion' ),
					'sendinblue' => esc_html__( 'Sendinblue ', 'themeisle-companion' ),
					'mailerlite' => esc_html__( 'MailerLite', 'themeisle-companion' ),
				),
			),
			'access_key'      => array(
				'type'  => 'text',
				'label' => esc_html__( 'Access Key', 'themeisle-companion' ),
			),
			'list_id'         => array(
				'type'  => 'text',
				'label' => esc_html__( 'List ID', 'themeisle-companion' ),
			),
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
		) + $fields['fields'];

		return $fields;
	}
}
