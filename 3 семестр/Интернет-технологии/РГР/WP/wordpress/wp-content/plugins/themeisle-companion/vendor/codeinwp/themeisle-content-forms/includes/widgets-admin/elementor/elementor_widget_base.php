<?php
/**
 * This class is a wrapper for all Elementor custom Widgets defined in this module
 *
 * @package ContentForms
 */

namespace ThemeIsle\ContentForms\Includes\Widgets_Admin\Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;
use ThemeIsle\ContentForms\Form_Manager;

/**
 * Class Elementor_Base
 */
abstract class Elementor_Widget_Base extends Widget_Base {

	/**
	 * All the widgets that extends this class have the same category.
	 *
	 * @return array
	 */
	public function get_categories() {
		return array( 'obfx-elementor-widgets' );
	}

	/**
	 * All the widgets that extends this class have the same Icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-text-align-left';
	}

	/**
	 * Retrieve the list of styles the content forms widgets depended on.
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_style_depends() {
		return array( 'content-forms' );
	}

	/**
	 * Register the controls for each Elementor Widget.
	 */
	protected function _register_controls() {
		$this->register_form_fields();
		$this->register_settings_controls();
		$this->register_style_controls();
		$this->add_widget_specific_settings();
	}

	/**
	 * This function registers the Repeater Control that adds fields in the form.
	 */
	private function register_form_fields() {

		$this->start_controls_section(
			$this->get_widget_type() . '_form_fields',
			array(
				'label' => __( 'Fields', 'themeisle-companion' ),
			)
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'requirement',
			array(
				'label'        => __( 'Required', 'themeisle-companion' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'required',
				'default'      => '',
			)
		);

		$field_types = array(
			'text'     => __( 'Text', 'themeisle-companion' ),
			'password' => __( 'Password', 'themeisle-companion' ),
			'email'    => __( 'Email', 'themeisle-companion' ),
			'textarea' => __( 'Textarea', 'themeisle-companion' ),
		);

		$repeater->add_control(
			'type',
			array(
				'label'   => __( 'Type', 'themeisle-companion' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $field_types,
				'default' => 'text',
			)
		);

		$repeater->add_control(
			'key',
			array(
				'label' => __( 'Key', 'themeisle-companion' ),
				'type'  => Controls_Manager::HIDDEN,
			)
		);

		$repeater->add_responsive_control(
			'field_width',
			array(
				'label'   => __( 'Field Width', 'themeisle-companion' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'100' => '100%',
					'75'  => '75%',
					'66'  => '66%',
					'50'  => '50%',
					'33'  => '33%',
					'25'  => '25%',
				),
				'default' => '100',
			)
		);

		$repeater->add_control(
			'label',
			array(
				'label'   => __( 'Label', 'themeisle-companion' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$repeater->add_control(
			'placeholder',
			array(
				'label'   => __( 'Placeholder', 'themeisle-companion' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);
		$this->add_repeater_specific_fields( $repeater );

		$default_fields = $this->get_default_config();
		$this->add_control(
			'form_fields',
			array(
				'label'       => __( 'Form Fields', 'themeisle-companion' ),
				'type'        => Controls_Manager::REPEATER,
				'show_label'  => false,
				'separator'   => 'before',
				'fields'      => array_values( $repeater->get_controls() ),
				'default'     => $default_fields,
				'title_field' => '{{{ label }}}',
			)
		);

		$this->add_control(
			'hide_label',
			array(
				'type'         => Controls_Manager::SWITCHER,
				'label'        => __( 'Hide Label', 'themeisle-companion' ),
				'return_value' => 'hide',
				'default'      => '',
				'separator'    => 'before',
			)
		);
		$this->end_controls_section();
		$this->add_specific_form_fields();
	}

	/**
	 * Register form setting controls.
	 */
	private function register_settings_controls() {

		$this->start_controls_section(
			'contact_form_settings',
			array(
				'label' => __( 'Form Settings', 'themeisle-companion' ),
			)
		);

		$this->add_specific_settings_controls();

		$this->end_controls_section();
	}

	/**
	 * Add style controls.
	 *
	 * @access protected
	 * @return void
	 * @since 1.0,0
	 */
	protected function register_style_controls() {
		$this->start_controls_section(
			'section_form_style',
			array(
				'label' => __( 'Form', 'themeisle-companion' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'column_gap',
			array(
				'label'     => __( 'Columns Gap', 'themeisle-companion' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 10,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 60,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-column' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .content-form .submit-form' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
				),
			)
		);

		$this->add_control(
			'row_gap',
			array(
				'label'     => __( 'Rows Gap', 'themeisle-companion' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 10,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 60,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-column' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .content-form .submit-form' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_label',
			array(
				'label'     => __( 'Label', 'themeisle-companion' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'label_spacing',
			array(
				'label'     => __( 'Spacing', 'themeisle-companion' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 0,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 60,
					),
				),
				'selectors' => array(
					'body.rtl {{WRAPPER}} fieldset > label' => 'padding-left: {{SIZE}}{{UNIT}};',
					// for the label position = inline option
					'body:not(.rtl) {{WRAPPER}} fieldset > label' => 'padding-right: {{SIZE}}{{UNIT}};',
					// for the label position = inline option
					'body {{WRAPPER}} fieldset > label' => 'padding-bottom: {{SIZE}}{{UNIT}};',
					// for the label position = above option
				),
			)
		);

		$this->add_control(
			'label_color',
			array(
				'label'     => __( 'Text Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} fieldset > label, {{WRAPPER}} .elementor-field-subgroup label' => 'color: {{VALUE}};',
				),
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
			)
		);

		$this->add_control(
			'mark_required_color',
			array(
				'label'     => __( 'Mark Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .required-mark' => 'color: {{COLOR}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} fieldset > label',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_field_style',
			array(
				'label' => __( 'Field', 'themeisle-companion' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'field_typography',
				'selector' => '{{WRAPPER}} fieldset > input, {{WRAPPER}} fieldset select, {{WRAPPER}} fieldset > textarea, {{WRAPPER}} fieldset > button',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			)
		);

		$this->add_responsive_control(
			'align_field_text',
			array(
				'label'     => __( 'Text alignment', 'themeisle-companion' ),
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
					'{{WRAPPER}} fieldset > input'    => 'text-align: {{VALUE}}',
					'{{WRAPPER}} fieldset select'     => 'text-align: {{VALUE}}',
					'{{WRAPPER}} fieldset > textarea' => 'text-align: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'field-text-padding',
			array(
				'label'      => __( 'Text Padding', 'themeisle-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} fieldset > input'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} fieldset select'     => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} fieldset > textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_field_style' );

		$this->start_controls_tab(
			'tab_field_normal',
			array(
				'label' => __( 'Normal', 'themeisle-companion' ),
			)
		);

		$this->add_control(
			'field_text_color',
			array(
				'label'     => __( 'Text Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} fieldset > input'    => 'color: {{VALUE}};',
					'{{WRAPPER}} fieldset > input::placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} fieldset select'     => 'color: {{VALUE}};',
					'{{WRAPPER}} fieldset select::placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} fieldset > textarea' => 'color: {{VALUE}};',
					'{{WRAPPER}} fieldset > textarea::placeholder' => 'color: {{VALUE}};',
				),
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
			)
		);

		$this->add_control(
			'field_background_color',
			array(
				'label'     => __( 'Background Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} fieldset > input'    => 'background-color: {{VALUE}};',
					'{{WRAPPER}} fieldset select'     => 'background-color: {{VALUE}};',
					'{{WRAPPER}} fieldset > textarea' => 'background-color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'field_border_color',
			array(
				'label'     => __( 'Border Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} fieldset > input'    => 'border-color: {{VALUE}};',
					'{{WRAPPER}} fieldset select'     => 'border-color: {{VALUE}};',
					'{{WRAPPER}} fieldset > textarea' => 'border-color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'field_border_style',
			array(
				'label'     => _x( 'Border Type', 'Border Control', 'themeisle-companion' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''       => __( 'None', 'themeisle-companion' ),
					'solid'  => _x( 'Solid', 'Border Control', 'themeisle-companion' ),
					'double' => _x( 'Double', 'Border Control', 'themeisle-companion' ),
					'dotted' => _x( 'Dotted', 'Border Control', 'themeisle-companion' ),
					'dashed' => _x( 'Dashed', 'Border Control', 'themeisle-companion' ),
					'groove' => _x( 'Groove', 'Border Control', 'themeisle-companion' ),
				),
				'selectors' => array(
					'{{WRAPPER}} fieldset > input'    => 'border-style: {{VALUE}};',
					'{{WRAPPER}} fieldset select'     => 'border-style: {{VALUE}};',
					'{{WRAPPER}} fieldset > textarea' => 'border-style: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'field_border_width',
			array(
				'label'       => __( 'Border Width', 'themeisle-companion' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'placeholder' => '',
				'size_units'  => array( 'px' ),
				'selectors'   => array(
					'{{WRAPPER}} fieldset > input'    => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} fieldset select'     => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} fieldset > textarea' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'field_border_radius',
			array(
				'label'      => __( 'Border Radius', 'themeisle-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} fieldset > input'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} fieldset select'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} fieldset > textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_field_focus',
			array(
				'label' => __( 'Focus', 'themeisle-companion' ),
			)
		);

		$this->add_control(
			'field_focus_text_color',
			array(
				'label'     => __( 'Text Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} fieldset > input:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} fieldset > input::placeholder:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} fieldset select:focus'  => 'color: {{VALUE}};',
					'{{WRAPPER}} fieldset select::placeholder:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} fieldset > textarea:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} fieldset > textarea::placeholder:focus' => 'color: {{VALUE}};',
				),
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
			)
		);

		$this->add_control(
			'field_focus_background_color',
			array(
				'label'     => __( 'Background Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} fieldset > input:focus' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} fieldset select:focus'  => 'background-color: {{VALUE}};',
					'{{WRAPPER}} fieldset > textarea:focus' => 'background-color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'field_focus_border_color',
			array(
				'label'     => __( 'Border Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} fieldset > input:focus' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} fieldset select:focus'  => 'border-color: {{VALUE}};',
					'{{WRAPPER}} fieldset > textarea:focus' => 'border-color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'field_focus_border_style',
			array(
				'label'     => _x( 'Border Type', 'Border Control', 'themeisle-companion' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''       => __( 'None', 'themeisle-companion' ),
					'solid'  => _x( 'Solid', 'Border Control', 'themeisle-companion' ),
					'double' => _x( 'Double', 'Border Control', 'themeisle-companion' ),
					'dotted' => _x( 'Dotted', 'Border Control', 'themeisle-companion' ),
					'dashed' => _x( 'Dashed', 'Border Control', 'themeisle-companion' ),
					'groove' => _x( 'Groove', 'Border Control', 'themeisle-companion' ),
				),
				'selectors' => array(
					'{{WRAPPER}} fieldset > input:focus' => 'border-style: {{VALUE}};',
					'{{WRAPPER}} fieldset select:focus'  => 'border-style: {{VALUE}};',
					'{{WRAPPER}} fieldset > textarea:focus' => 'border-style: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'field_focus_border_width',
			array(
				'label'       => __( 'Border Width', 'themeisle-companion' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'placeholder' => '',
				'size_units'  => array( 'px' ),
				'selectors'   => array(
					'{{WRAPPER}} fieldset > input:focus' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} fieldset select:focus'  => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} fieldset > textarea:focus' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'field_focus_border_radius',
			array(
				'label'      => __( 'Border Radius', 'themeisle-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} fieldset > input:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} fieldset select:focus'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} fieldset > textarea:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			array(
				'label' => __( 'Button', 'themeisle-companion' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __( 'Normal', 'themeisle-companion' ),
			)
		);

		$this->add_control(
			'button_background_color',
			array(
				'label'     => __( 'Background Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				),
				'selectors' => array(
					'{{WRAPPER}} fieldset > button' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_text_color',
			array(
				'label'     => __( 'Text Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} fieldset > button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} fieldset > button',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'button_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} fieldset > button',
				'separator'   => 'before',
			)
		);

		$this->add_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'themeisle-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} fieldset > button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'button_text_padding',
			array(
				'label'      => __( 'Text Padding', 'themeisle-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} fieldset > button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __( 'Hover', 'themeisle-companion' ),
			)
		);

		$this->add_control(
			'button_background_hover_color',
			array(
				'label'     => __( 'Background Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} fieldset > button:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_hover_color',
			array(
				'label'     => __( 'Text Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} fieldset > button:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} fieldset > button:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'button_border_border!' => '',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'notification_style',
			array(
				'label' => __( 'Notification', 'themeisle-companion' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'notification_margin',
			array(
				'label'      => __( 'Margin', 'themeisle-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .content-form-notice' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'notification_text_padding',
			array(
				'label'      => __( 'Padding', 'themeisle-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .content-form-notice' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'notification_width',
			array(
				'label'     => __( 'Width', 'themeisle-companion' ),
				'type'      => Controls_Manager::SLIDER,
				'unit'      => '%',
				'range'     => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'   => array(
					'unit' => '%',
				),
				'selectors' => array(
					'{{WRAPPER}} .content-form-notice' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'notification_typography',
				'selector' => '{{WRAPPER}} .content-form-notice',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'notification_box_shadow',
				'label'    => __( 'Box Shadow', 'themeisle-companion' ),
				'selector' => '{{WRAPPER}} .content-form-notice',
			)
		);

		$this->add_responsive_control(
			'notification_alignment',
			array(
				'label'   => __( 'Alignment', 'themeisle-companion' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'default' => 'left',
				'options' => array(
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
			)
		);

		$this->start_controls_tabs( 'tabs_notification_style' );

		$this->start_controls_tab(
			'tab_notification_success',
			array(
				'label' => __( 'Success', 'themeisle-companion' ),
			)
		);

		$this->add_control(
			'notification_background_color_success',
			array(
				'label'     => __( 'Background Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .content-form-notice.content-form-success'    => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'notification_text_color_success',
			array(
				'label'     => __( 'Text Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .content-form-notice.content-form-success'    => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'notification_border_success',
				'label'    => __( 'Border', 'themeisle-companion' ),
				'selector' => '{{WRAPPER}} .content-form-notice.content-form-success',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_notification_error',
			array(
				'label' => __( 'Error', 'themeisle-companion' ),
			)
		);

		$this->add_control(
			'notification_background_color_error',
			array(
				'label'     => __( 'Background Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .content-form-notice.content-form-error'    => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'notification_text_color_error',
			array(
				'label'     => __( 'Text Color', 'themeisle-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .content-form-notice.content-form-error'    => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'notification_border_error',
				'label'    => __( 'Border', 'themeisle-companion' ),
				'selector' => '{{WRAPPER}} .content-form-notice.content-form-error',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Render the widget.
	 */
	protected function render() {
		$form_id  = $this->get_data( 'id' );
		$settings = $this->get_settings();
		$fields   = $settings['form_fields'];

		$this->maybe_load_widget_style();

		$this->render_form_header( $form_id );
		$has_errors = $this->maybe_render_form_errors();
		$disabled   = $has_errors === true ? 'disabled="disabled"' : '';

		foreach ( $fields as $index => $field ) {
			$this->render_form_field( $field );
		}

		$btn_label = ! empty( $settings['submit_label'] ) ? $settings['submit_label'] : esc_html__( 'Submit', 'themeisle-companion' );
		echo '<fieldset class="submit-form ' . esc_attr( $this->get_widget_type() ) . '">';
		echo '<button type="submit" name="submit" ' . $disabled . ' value="submit-' . esc_attr( $this->get_widget_type() ) . '-' . esc_attr( $form_id ) . '" class="' . $this->get_render_attribute_string( 'button' ) . '">';
		echo esc_html( $btn_label );

		if ( isset( $settings['button_icon_new'] ) ) {
			echo '<span ' . $this->get_render_attribute_string( 'content-wrapper' ) . '>';
			echo '<span ' . $this->get_render_attribute_string( 'icon-align' ) . '>';
			Icons_Manager::render_icon( $settings['button_icon_new'], array( 'aria-hidden' => 'true' ) );
			echo '</span>';
			echo '</span>';
		}

		echo '</button>';
		echo '</fieldset>';
		$this->render_form_footer();
	}

	/**
	 * Display form configuration errors.
	 *
	 * @return bool
	 */
	private function maybe_render_form_errors() {
		$has_error = false;
		if ( ! current_user_can( 'manage_options' ) ) {
			return $has_error;
		}

		if ( $this->get_widget_type() === 'newsletter' ) {
			$settings = $this->get_settings();
			echo '<div class="content-forms-required">';

			if ( array_key_exists( 'access_key', $settings ) && empty( $settings['access_key'] ) ) {
				echo '<p>';
				printf(
					esc_html__( 'The %s setting is required!', 'themeisle-companion' ),
					'<strong>' . esc_html__( 'Access Key', 'themeisle-companion' ) . '</strong>'
				);
				echo '</p>';
				$has_error = true;
			}

			if ( array_key_exists( 'list_id', $settings ) && empty( $settings['list_id'] ) ) {
				echo '<p>';
				printf(
					esc_html__( 'The %s setting is required!', 'themeisle-companion' ),
					'<strong>' . esc_html__( 'List id', 'themeisle-companion' ) . '</strong>'
				);
				echo '</p>';
				$has_error = true;
			}

			$form_fields = $settings['form_fields'];
			$mapping     = array();
			foreach ( $form_fields as $field ) {
				$field_map = $field['field_map'];
				if ( in_array( $field_map, $mapping, true ) ) {
					echo '<p>';
					printf(
						esc_html__( 'The %s field is mapped to multiple form fields. Please check your field settings.', 'themeisle-companion' ),
						'<strong>' . $field_map . '</strong>'
					);
					echo '</p>';
					$has_error = true;
				}
				array_push( $mapping, $field_map );
			}

			echo '</div>';

			return $has_error;
		}

		if ( $this->get_widget_type() === 'contact' ) {
			$settings = $this->get_settings();

			if ( array_key_exists( 'to_send_email', $settings ) && empty( $settings['to_send_email'] ) ) {
				echo '<p>';
				printf(
					esc_html__( 'The %s setting is required!', 'themeisle-companion' ),
					'<strong>' . esc_html__( 'Send to Email Address', 'themeisle-companion' ) . '</strong>'
				);
				echo '</p>';
				$has_error = true;
			}
		}

		return $has_error;
	}

	/**
	 * Either enqueue the widget style registered by the library
	 * or load an inline version for the preview only
	 *
	 * @return void
	 * @since 1.0.0
	 * @access protected
	 */
	protected function maybe_load_widget_style() {
		if ( Plugin::$instance->editor->is_edit_mode() === true && apply_filters( 'themeisle_content_forms_register_default_style', true ) ) {
			echo '<style>';
			echo $this->get_notice_style();
			echo '</style>';
		} else {
			// if `themeisle_content_forms_register_default_style` is false, the style won't be registered anyway
			$style = $this->get_notice_style();
			wp_localize_script( 'content-forms', 'formStyle', array( 'formStyle' => $style ) );
			wp_enqueue_script( 'content-forms' );
		}
	}

	/**
	 * Get style for form notification.
	 *
	 * @return string
	 */
	public function get_notice_style() {
		$settings = $this->get_settings_for_display();

		$style = 'style="margin-left:0; text-align:' . $settings['notification_alignment'] . '"';
		if ( $settings['notification_alignment'] === 'right' ) {
			$style = 'style="margin-right:0; margin-left:auto; text-align:' . $settings['notification_alignment'] . '"';
		}
		if ( $settings['notification_alignment'] === 'center' ) {
			$style = 'style="margin-left: auto; margin-right: auto; text-align:' . $settings['notification_alignment'] . '"';
		}

		return $style;
	}

	/**
	 * Render the preview of form notifications.
	 *
	 * @return bool
	 */
	private function maybe_render_form_notification() {
		if ( Plugin::$instance->editor->is_edit_mode() !== true ) {
			return false;
		}

		$style = $this->get_notice_style();

		echo '<div class="content-form-notice-wrapper">';
		echo '<h3 ' . $style . ' class="content-form-notice content-form-success">' . __( 'This is a preview of how the success notification will look', 'themeisle-companion' ) . '</h3>';
		echo '</div>';

		echo '<div class="content-form-notice-wrapper">';
		echo '<h3 ' . $style . ' class="content-form-notice content-form-error">' . __( 'This is a preview of how the error notification will look', 'themeisle-companion' ) . '</h3>';
		echo '</div>';

		return true;
	}

	/**
	 * Display method for the form's header
	 * It is also takes care about the form attributes and the regular hidden fields
	 *
	 * @param string $id Form id.
	 */
	private function render_form_header( $id ) {
		// create an url for the form's action
		$url = admin_url( 'admin-post.php' );
		echo '<form action="' . esc_url( $url ) . '" method="post" name="content-form-' . esc_attr( $id ) . '" id="content-form-' . esc_attr( $id ) . '" class="ti-cf-module content-form content-form-' . esc_attr( $this->get_widget_type() ) . ' ' . esc_attr( $this->get_name() ) . '">';
		$this->maybe_render_form_notification();
		wp_nonce_field( 'content-form-' . esc_attr( $id ), '_wpnonce_' . esc_attr( $this->get_widget_type() ) );

		echo '<input type="hidden" name="action" value="content_form_submit" />';
		echo '<input type="hidden" name="form-type" value="' . esc_attr( $this->get_widget_type() ) . '" />';
		echo '<input type="hidden" name="form-builder" value="elementor" />';
		echo '<input type="hidden" name="post-id" value="' . get_the_ID() . '" />';
		echo '<input type="hidden" name="form-id" value="' . esc_attr( $id ) . '" />';
	}

	/**
	 * Print the output of an individual field
	 *
	 * @param array $field Field settings.
	 * @param bool $is_preview Is preview flag.
	 */
	private function render_form_field( $field, $is_preview = false ) {

		$field_id    = $field['_id'];
		$key         = Form_Manager::get_field_key_name( $field );
		$key         = $key === 'ADDRESS' ? $key = 'ADDRESS[addr1]' : $key;
		$form_id     = $this->get_data( 'id' );
		$field_name  = 'data[' . $form_id . '][' . $key . ']';
		$disabled    = $is_preview ? 'disabled="disabled"' : '';
		$required    = $field['requirement'] === 'required' ? 'required="required"' : '';
		$placeholder = ! empty( $field['placeholder'] ) ? $field['placeholder'] : '';

		$this->add_render_attribute( 'fieldset' . $field['_id'], 'class', 'content-form-field-' . $field['type'] );
		$this->add_render_attribute( 'fieldset' . $field['_id'], 'class', 'elementor-column elementor-col-' . $field['field_width'] );
		$this->add_render_attribute(
			array(
				'icon-align' => array(
					'class' => array(
						empty( $instance['button_icon_align'] ) ? '' :
							'elementor-align-icon-' . $instance['button_icon_align'],
						'elementor-button-icon',
					),
				),
			)
		);

		echo '<fieldset ' . $this->get_render_attribute_string( 'fieldset' . $field_id ) . '>';
		$this->render_field_label( $field );

		switch ( $field['type'] ) {
			case 'textarea':
				echo '<textarea name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_name ) . '" ' . $disabled . ' ' . $required . ' placeholder="' . esc_attr( $placeholder ) . '" cols="30" rows="5"></textarea>';
				break;
			case 'password':
				echo '<input type="password" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_name ) . '" ' . $required . ' ' . $disabled . '>';
				break;
			default:
				echo '<input type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_name ) . '" ' . $required . ' ' . $disabled . ' placeholder="' . esc_attr( $placeholder ) . '">';
				break;
		}
		echo '</fieldset>';

		$this->maybe_render_newsletter_address( $field, $is_preview );
	}

	/**
	 * When using MailChimp, additional fields are required for the address field/
	 *
	 * @param array $field Field data.
	 * @return bool
	 */
	private function maybe_render_newsletter_address( $field, $is_preview ) {
		$settings = $this->get_settings();
		if ( ! array_key_exists( 'provider', $settings ) || $settings['provider'] !== 'mailchimp' ) {
			return false;
		}

		if ( ! array_key_exists( 'field_map', $field ) || $field['field_map'] !== 'address' ) {
			return false;
		}

		$form_id       = $this->get_data( 'id' );
		$display_label = $settings['hide_label'];
		$disabled      = $is_preview ? 'disabled="disabled"' : '';
		$required      = $field['requirement'] === 'required' ? 'required="required"' : '';

		$address_fields = array( 'addr2', 'city', 'state', 'zip', 'country' );
		foreach ( $address_fields as $address_item ) {
			$field_name = 'data[' . $form_id . '][ADDRESS[' . $address_item . ']]';
			$this->add_render_attribute( 'fieldset' . $field['_id'] . $address_item, 'class', 'elementor-column elementor-col-' . $field[ $address_item . '_width' ] );

			echo '<fieldset class="elementor-field-group elementor-column elementor-col-' . $field[ $address_item . '_width' ] . '">';

			if ( $display_label !== 'hide' ) {
				echo '<label for="' . esc_attr( $field_name ) . '" >';
				echo wp_kses_post( $field[ $address_item . '_label' ] );
				if ( $field['requirement'] === 'required' ) {
					echo '<span class="required-mark"> *</span>';
				}
				echo '</label>';
			}

			if ( $address_item === 'country' ) {
				echo '<select class="country" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_name ) . '" ' . $required . ' ' . $disabled . '><option value="">-</option><option value="164">USA</option><option value="286">Aaland Islands</option><option value="274">Afghanistan</option><option value="2">Albania</option><option value="3">Algeria</option><option value="178">American Samoa</option><option value="4">Andorra</option><option value="5">Angola</option><option value="176">Anguilla</option><option value="175">Antigua And Barbuda</option><option value="6">Argentina</option><option value="7">Armenia</option><option value="179">Aruba</option><option value="8">Australia</option><option value="9">Austria</option><option value="10">Azerbaijan</option><option value="11">Bahamas</option><option value="12">Bahrain</option><option value="13">Bangladesh</option><option value="14">Barbados</option><option value="15">Belarus</option><option value="16">Belgium</option><option value="17">Belize</option><option value="18">Benin</option><option value="19">Bermuda</option><option value="20">Bhutan</option><option value="21">Bolivia</option><option value="22">Bosnia and Herzegovina</option><option value="23">Botswana</option><option value="181">Bouvet Island</option><option value="24">Brazil</option><option value="180">Brunei Darussalam</option><option value="25">Bulgaria</option><option value="26">Burkina Faso</option><option value="27">Burundi</option><option value="28">Cambodia</option><option value="29">Cameroon</option><option value="30">Canada</option><option value="31">Cape Verde</option><option value="32">Cayman Islands</option><option value="33">Central African Republic</option><option value="34">Chad</option><option value="35">Chile</option><option value="36">China</option><option value="185">Christmas Island</option><option value="37">Colombia</option><option value="204">Comoros</option><option value="38">Congo</option><option value="183">Cook Islands</option><option value="268">Costa Rica</option><option value="275">Cote D\'Ivoire</option><option value="40">Croatia</option><option value="276">Cuba</option><option value="298">Curacao</option><option value="41">Cyprus</option><option value="42">Czech Republic</option><option value="43">Denmark</option><option value="44">Djibouti</option><option value="289">Dominica</option><option value="187">Dominican Republic</option><option value="233">East Timor</option><option value="45">Ecuador</option><option value="46">Egypt</option><option value="47">El Salvador</option><option value="48">Equatorial Guinea</option><option value="49">Eritrea</option><option value="50">Estonia</option><option value="51">Ethiopia</option><option value="189">Falkland Islands</option><option value="191">Faroe Islands</option><option value="52">Fiji</option><option value="53">Finland</option><option value="54">France</option><option value="193">French Guiana</option><option value="277">French Polynesia</option><option value="56">Gabon</option><option value="57">Gambia</option><option value="58">Georgia</option><option value="59">Germany</option><option value="60">Ghana</option><option value="194">Gibraltar</option><option value="61">Greece</option><option value="195">Greenland</option><option value="192">Grenada</option><option value="196">Guadeloupe</option><option value="62">Guam</option><option value="198">Guatemala</option><option value="270">Guernsey</option><option value="63">Guinea</option><option value="65">Guyana</option><option value="200">Haiti</option><option value="66">Honduras</option><option value="67">Hong Kong</option><option value="68">Hungary</option><option value="69">Iceland</option><option value="70">India</option><option value="71">Indonesia</option><option value="278">Iran</option><option value="279">Iraq</option><option value="74">Ireland</option><option value="75">Israel</option><option value="76">Italy</option><option value="202">Jamaica</option><option value="78">Japan</option><option value="288">Jersey  (Channel Islands)</option><option value="79">Jordan</option><option value="80">Kazakhstan</option><option value="81">Kenya</option><option value="203">Kiribati</option><option value="82">Kuwait</option><option value="83">Kyrgyzstan</option><option value="84">Lao People\'s Democratic Republic</option><option value="85">Latvia</option><option value="86">Lebanon</option><option value="87">Lesotho</option><option value="88">Liberia</option><option value="281">Libya</option><option value="90">Liechtenstein</option><option value="91">Lithuania</option><option value="92">Luxembourg</option><option value="208">Macau</option><option value="93">Macedonia</option><option value="94">Madagascar</option><option value="95">Malawi</option><option value="96">Malaysia</option><option value="97">Maldives</option><option value="98">Mali</option><option value="99">Malta</option><option value="207">Marshall Islands</option><option value="210">Martinique</option><option value="100">Mauritania</option><option value="212">Mauritius</option><option value="241">Mayotte</option><option value="101">Mexico</option><option value="102">Moldova, Republic of</option><option value="103">Monaco</option><option value="104">Mongolia</option><option value="290">Montenegro</option><option value="294">Montserrat</option><option value="105">Morocco</option><option value="106">Mozambique</option><option value="242">Myanmar</option><option value="107">Namibia</option><option value="108">Nepal</option><option value="109">Netherlands</option><option value="110">Netherlands Antilles</option><option value="213">New Caledonia</option><option value="111">New Zealand</option><option value="112">Nicaragua</option><option value="113">Niger</option><option value="114">Nigeria</option><option value="217">Niue</option><option value="214">Norfolk Island</option><option value="272">North Korea</option><option value="116">Norway</option><option value="117">Oman</option><option value="118">Pakistan</option><option value="222">Palau</option><option value="282">Palestine</option><option value="119">Panama</option><option value="219">Papua New Guinea</option><option value="120">Paraguay</option><option value="121">Peru</option><option value="122">Philippines</option><option value="221">Pitcairn</option><option value="123">Poland</option><option value="124">Portugal</option><option value="126">Qatar</option><option value="315">Republic of Kosovo</option><option value="127">Reunion</option><option value="128">Romania</option><option value="129">Russia</option><option value="130">Rwanda</option><option value="205">Saint Kitts and Nevis</option><option value="206">Saint Lucia</option><option value="237">Saint Vincent and the Grenadines</option><option value="132">Samoa (Independent)</option><option value="227">San Marino</option><option value="133">Saudi Arabia</option><option value="134">Senegal</option><option value="266">Serbia</option><option value="135">Seychelles</option><option value="136">Sierra Leone</option><option value="137">Singapore</option><option value="302">Sint Maarten</option><option value="138">Slovakia</option><option value="139">Slovenia</option><option value="223">Solomon Islands</option><option value="140">Somalia</option><option value="141">South Africa</option><option value="257">South Georgia and the South Sandwich Islands</option><option value="142">South Korea</option><option value="311">South Sudan</option><option value="143">Spain</option><option value="144">Sri Lanka</option><option value="293">Sudan</option><option value="146">Suriname</option><option value="225">Svalbard and Jan Mayen Islands</option><option value="147">Swaziland</option><option value="148">Sweden</option><option value="149">Switzerland</option><option value="285">Syria</option><option value="152">Taiwan</option><option value="260">Tajikistan</option><option value="153">Tanzania</option><option value="154">Thailand</option><option value="155">Togo</option><option value="232">Tonga</option><option value="234">Trinidad and Tobago</option><option value="156">Tunisia</option><option value="157">Turkey</option><option value="287">Turks &amp; Caicos Islands</option><option value="159">Uganda</option><option value="161">Ukraine</option><option value="162">United Arab Emirates</option><option value="262">United Kingdom</option><option value="163">Uruguay</option><option value="165">Uzbekistan</option><option value="239">Vanuatu</option><option value="166">Vatican City State (Holy See)</option><option value="167">Venezuela</option><option value="168">Vietnam</option><option value="169">Virgin Islands (British)</option><option value="238">Virgin Islands (U.S.)</option><option value="188">Western Sahara</option><option value="170">Yemen</option><option value="173">Zambia</option><option value="174">Zimbabwe</option></select>';
			} else {
				echo '<input type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_name ) . '" ' . $required . ' ' . $disabled . ' placeholder="' . esc_attr( $field[ $address_item . '_placeholder' ] ) . '">';
			}

			echo '</fieldset>';
		}
		return true;
	}

	/**
	 * Maybe render field label
	 *
	 * @var array $field Field data.
	 *
	 * @return true
	 */
	private function render_field_label( $field ) {

		$settings      = $this->get_settings();
		$display_label = $settings['hide_label'];
		$field_id      = $field['_id'];
		$key           = Form_Manager::get_field_key_name( $field );
		$form_id       = $this->get_data( 'id' );
		$field_name    = 'data[' . $form_id . '][' . $key . ']';

		echo '<label for="' . esc_attr( $field_name ) . '" ' . $this->get_render_attribute_string( 'label' . $field_id ) . '>';
		if ( $display_label !== 'hide' && ! empty( $field['label'] ) ) {
			echo wp_kses_post( $field['label'] );
			if ( $field['requirement'] === 'required' ) {
				echo '<span class="required-mark"> *</span>';
			}
		}
		echo '</label>';

		return true;
	}


	/**
	 * Display method for the form's footer
	 */
	private function render_form_footer() {
		echo '</form>';
	}

	/**
	 * Get widget type.
	 * @return string
	 */
	abstract function get_widget_type();

	/**
	 * Add specific fields for repeater form fields.
	 *
	 * @param Object $repeater Repeater object
	 */
	abstract function add_repeater_specific_fields( $repeater );

	/**
	 * Add widget specific settings.
	 *
	 * @return mixed
	 */
	abstract function add_widget_specific_settings();

	/**
	 * Get form fields default values.
	 *
	 * @return array
	 */
	abstract function get_default_config();

	/**
	 * Add Widget specific form fields.
	 */
	abstract function add_specific_form_fields();

	/**
	 * Add widget specific settings controls.
	 */
	abstract function add_specific_settings_controls();
}
