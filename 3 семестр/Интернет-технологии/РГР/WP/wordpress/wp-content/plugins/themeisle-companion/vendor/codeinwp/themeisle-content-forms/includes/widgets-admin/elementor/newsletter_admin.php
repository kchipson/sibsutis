<?php
/**
 * Main class for Elementor Newsletter Form Custom Widget
 *
 * @package ContentForms
 */

namespace ThemeIsle\ContentForms\Includes\Widgets_Admin\Elementor;

use Elementor\Controls_Manager;

require_once TI_CONTENT_FORMS_PATH . '/includes/widgets-admin/elementor/elementor_widget_base.php';

/**
 * Class Newsletter_Admin
 */
class Newsletter_Admin extends Elementor_Widget_Base {


	/**
	 * The type of current widget form.
	 *
	 * @return string
	 */
	public function get_widget_type() {
		return 'newsletter';
	}

	/**
	 * @var array
	 */
	public $strings = array();


	/**
	 * Elementor Widget Name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'content_form_newsletter';
	}

	/**
	 * The default values for current widget.
	 *
	 * @return array
	 */
	function get_default_config() {
		return array(
			array(
				'key'         => 'email',
				'type'        => 'email',
				'label'       => esc_html__( 'Email', 'themeisle-companion' ),
				'requirement' => 'required',
				'placeholder' => esc_html__( 'Email', 'themeisle-companion' ),
				'field_width' => '100',
				'field_map'   => 'email',
			),
		);
	}

	/**
	 * Get Widget Title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Newsletter Form', 'themeisle-companion' );
	}

	/**
	 * Add specific form fields for Newsletter widget.
	 */
	function add_specific_form_fields() {
		return false;
	}

	/**
	 * Add specific settings for Newsletter widget.
	 */
	function add_specific_settings_controls() {

		$this->add_control(
			'provider',
			array(
				'type'      => 'select',
				'label'     => esc_html__( 'Subscribe to', 'themeisle-companion' ),
				'options'   => array(
					'mailchimp'  => esc_html__( 'MailChimp', 'themeisle-companion' ),
					'sendinblue' => esc_html__( 'Sendinblue ', 'themeisle-companion' ),
					'mailerlite' => esc_html__( 'MailerLite', 'themeisle-companion' ),
				),
				'default'   => 'mailchimp',
				'separator' => 'after',
			)
		);

		$this->add_control(
			'success_message',
			array(
				'type'    => 'text',
				'label'   => esc_html__( 'Success message', 'themeisle-companion' ),
				'default' => esc_html__( 'Welcome to our newsletter!', 'themeisle-companion' ),
			)
		);

		$this->add_control(
			'error_message',
			array(
				'type'      => 'text',
				'label'     => esc_html__( 'Error message', 'themeisle-companion' ),
				'default'   => esc_html__( 'Action failed!', 'themeisle-companion' ),
				'separator' => 'after',
			)
		);

		$this->add_control(
			'submit_label',
			array(
				'type'    => 'text',
				'label'   => esc_html__( 'Submit', 'themeisle-companion' ),
				'default' => esc_html__( 'Join Newsletter', 'themeisle-companion' ),
			)
		);

		$this->add_control(
			'button_icon_new',
			array(
				'label'            => __( 'Icon', 'themeisle-companion' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'button_icon',
			)
		);

		$this->add_control(
			'button_icon_size',
			array(
				'label'     => __( 'Icon Size', 'themeisle-companion' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'condition' => array(
					'button_icon!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-button-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'button_icon_indent',
			array(
				'label'     => __( 'Icon Spacing', 'themeisle-companion' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'condition' => array(
					'button_icon!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-button-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				),
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
	 * Add widget specific settings.
	 *
	 * @return mixed|void
	 */
	function add_widget_specific_settings() {

		$this->start_controls_section(
			'provider_settings',
			array(
				'label' => __( 'Provider Settings', 'themeisle-companion' ),
			)
		);

		$this->add_control(
			'access_key',
			array(
				'type'  => 'text',
				'label' => esc_html__( 'Access Key', 'themeisle-companion' ),
			)
		);

		$this->add_control(
			'list_id',
			array(
				'type'  => 'text',
				'label' => esc_html__( 'List ID', 'themeisle-companion' ),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Add repeater specific fields for newsletter widget.
	 * @param Object $repeater
	 */
	function add_repeater_specific_fields( $repeater ) {
		$repeater->add_control(
			'field_map',
			array(
				'label'       => __( 'Map field to', 'themeisle-companion' ),
				'type'        => Controls_Manager::TEXT,
				'separator'   => 'after',
				'description' => esc_html__( 'If you\'re using SendInBlue or MailerLite and you map the field to address, please ignore the additional settings.', 'themeisle-companion' ),
			)
		);

		$config = array(
			'addr2'   => array(
				'label'       => array(
					'label'   => __( 'Line 2 Label', 'themeisle-companion' ),
					'default' => __( 'Address Line 2', 'themeisle-companion' ),
				),
				'placeholder' => array(
					'label'   => __( 'Line 2 Placeholder', 'themeisle-companion' ),
					'default' => __( 'Address Line 2', 'themeisle-companion' ),
				),
				'width'       => array(
					'label'   => __( 'Line 2 Width', 'themeisle-companion' ),
					'default' => '100',
				),
			),
			'city'    => array(
				'label'       => array(
					'label'   => __( 'City Label', 'themeisle-companion' ),
					'default' => __( 'City', 'themeisle-companion' ),
				),
				'placeholder' => array(
					'label'   => __( 'City Placeholder', 'themeisle-companion' ),
					'default' => __( 'City', 'themeisle-companion' ),
				),
				'width'       => array(
					'label'   => __( 'City Width', 'themeisle-companion' ),
					'default' => '100',
				),
			),
			'state'   => array(
				'label'       => array(
					'label'   => __( 'State Label', 'themeisle-companion' ),
					'default' => __( 'State/Province/Region', 'themeisle-companion' ),
				),
				'placeholder' => array(
					'label'   => __( 'State Placeholder', 'themeisle-companion' ),
					'default' => __( 'State/Province/Region', 'themeisle-companion' ),
				),
				'width'       => array(
					'label'   => __( 'State Width', 'themeisle-companion' ),
					'default' => '100',
				),
			),
			'zip'     => array(
				'label'       => array(
					'label'   => __( 'Zip Code Label', 'themeisle-companion' ),
					'default' => __( 'Postal / Zip Code', 'themeisle-companion' ),
				),
				'placeholder' => array(
					'label'   => __( 'Zip Code Placeholder', 'themeisle-companion' ),
					'default' => __( 'Postal / Zip Code', 'themeisle-companion' ),
				),
				'width'       => array(
					'label'   => __( 'Zip Code Width', 'themeisle-companion' ),
					'default' => '100',
				),
			),
			'country' => array(
				'label'       => array(
					'label'   => __( 'Country Label', 'themeisle-companion' ),
					'default' => __( 'Country', 'themeisle-companion' ),
				),
				'placeholder' => array(
					'label'   => __( ' Country Placeholder', 'themeisle-companion' ),
					'default' => __( 'Country', 'themeisle-companion' ),
				),
				'width'       => array(
					'label'   => __( 'Country Width', 'themeisle-companion' ),
					'default' => '100',
				),
			),
		);
		foreach ( $config as $main_field => $field_value ) {
			foreach ( $field_value as $specific_field => $field_data ) {
				$key = $main_field . '_' . $specific_field;
				if ( $specific_field !== 'width' ) {
					$repeater->add_control(
						$key,
						array(
							'label'     => $field_data['label'],
							'type'      => Controls_Manager::TEXT,
							'default'   => $field_data['default'],
							'condition' => array(
								'field_map' => 'address',
							),
						)
					);
				} else {
					$repeater->add_responsive_control(
						$key,
						array(
							'label'     => $field_data['label'],
							'type'      => Controls_Manager::SELECT,
							'options'   => array(
								'100' => '100%',
								'75'  => '75%',
								'66'  => '66%',
								'50'  => '50%',
								'33'  => '33%',
								'25'  => '25%',
							),
							'default'   => $field_data['default'],
							'condition' => array(
								'field_map' => 'address',
							),
						)
					);
				}
			}
		}
	}
}
