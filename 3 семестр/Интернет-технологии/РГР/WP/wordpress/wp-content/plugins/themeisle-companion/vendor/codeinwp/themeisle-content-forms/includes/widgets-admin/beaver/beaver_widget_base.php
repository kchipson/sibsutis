<?php

namespace ThemeIsle\ContentForms\Includes\Widgets_Admin\Beaver;

use ThemeIsle\ContentForms\Form_Manager;
use ThemeIsle\ContentForms\Includes\Admin\Widget_Actions_Base;

/**
 * This class is used to create an Beaver module based on a ContentForms config
 * Class BeaverModule
 * @package ThemeIsle\ContentForms
 */
abstract class Beaver_Widget_Base extends \FLBuilderModule {

	/**
	 * Form type
	 *
	 * @var array
	 */
	public $form_type;

	/**
	 * Current module settings.
	 *
	 * @var array
	 */
	public $module_settings;

	/**
	 * Widget default data.
	 *
	 * @var array
	 */
	public $default_data = array();

	/**
	 * Beaver_Widget_Base constructor.
	 *
	 * @param $data
	 */
	public function __construct( $data ) {

		$this->run_hooks();

		$this->default_data    = $this->widget_default_values();
		$this->module_settings = $this->get_module_settings();

		parent::__construct( $data );
	}

	/**
	 * Enqueue scripts and styles
	 */
	public function enqueue_scripts() {
		parent::enqueue_scripts();
		$this->add_js( 'content-forms' );
		$this->add_css( 'content-forms' );
	}

	/**
	 * Run hooks and filters.
	 */
	public function run_hooks() {
		add_filter( 'fl_builder_register_settings_form', array( $this, 'filter_widget_settings' ), 10, 2 );
		add_filter( $this->get_type() . '_repeater_fields', array( $this, 'add_widget_repeater_fields' ) );
		add_filter( $this->get_type() . '_controls_fields', array( $this, 'add_widget_specific_controls' ) );
	}


	/**
	 * Filter the form settings.
	 *
	 * @param array $form Form settings
	 * @param static $slug Form slug
	 *
	 * @return array
	 */
	public function filter_widget_settings( $form, $slug ) {
		$form_widgets = array( 'class-themeisle-content-forms-beaver-newsletter', 'class-themeisle-content-forms-beaver-contact', 'class-themeisle-content-forms-beaver-registration' );
		if ( in_array( $slug, $form_widgets, true ) ) {
			return $this->module_settings;
		}

		return $form;
	}

	/**
	 * Beaver Widget style settings.
	 *
	 * @param array $args Settings array.
	 *
	 * @return array
	 */
	private function get_style_settings( $args ) {
		$args['style']['sections'] = array(
			'spacing'              => array(
				'title'  => esc_html__( 'Spacing', 'themeisle-companion' ),
				'fields' => array(
					'column_gap' => array(
						'responsive' => true,
						'type'       => 'unit',
						'units'      => array( 'px' ),
						'label'      => __( 'Columns Gap', 'themeisle-companion' ),
						'slider'     => array(
							'min'  => 0,
							'max'  => 60,
							'step' => 1,
						),
						'preview'    => array(
							'type'  => 'css',
							'rules' => array(
								array(
									'selector' => '.content-form-' . $this->get_type() . ' fieldset',
									'property' => 'padding-right',
								),
								array(
									'selector' => '.content-form-' . $this->get_type() . ' fieldset',
									'property' => 'padding-left',
								),
							),
						),
					),
					'row_gap'    => array(
						'responsive' => true,
						'type'       => 'unit',
						'units'      => array( 'px' ),
						'label'      => __( 'Rows Gap', 'themeisle-companion' ),
						'slider'     => array(
							'min'  => 0,
							'max'  => 60,
							'step' => 1,
						),
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset',
							'property' => 'margin-bottom',
						),
					),
				),
			),
			'label'                => array(
				'title'  => esc_html__( 'Label', 'themeisle-companion' ),
				'fields' => array(
					'label_color'         => array(
						'type'       => 'color',
						'label'      => __( 'Text Color', 'themeisle-companion' ),
						'show_reset' => true,
						'show_alpha' => false,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset label',
							'property' => 'color',
						),

					),
					'mark_required_color' => array(
						'type'       => 'color',
						'label'      => __( 'Mark Color', 'themeisle-companion' ),
						'show_reset' => true,
						'show_alpha' => false,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset label .required-mark',
							'property' => 'color',
						),
					),
					'label_typography'    => array(
						'type'       => 'typography',
						'label'      => __( 'Label Typography', 'themeisle-companion' ),
						'responsive' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset label',
						),
					),
				),
			),
			'field'                => array(
				'title'  => esc_html__( 'Field', 'themeisle-companion' ),
				'fields' => array(
					'field_text_color'       => array(
						'type'       => 'color',
						'label'      => __( 'Text Color', 'themeisle-companion' ),
						'show_reset' => true,
						'show_alpha' => false,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset input, .content-form-' . $this->get_type() . ' fieldset textarea, .content-form-' . $this->get_type() . ' fieldset select, .content-form-' . $this->get_type() . ' fieldset input::placeholder, .content-form-' . $this->get_type() . ' fieldset textarea::placeholder, .content-form-' . $this->get_type() . ' fieldset select::placeholder',
							'property' => 'color',
						),
					),
					'field_background_color' => array(
						'type'       => 'color',
						'label'      => __( 'Background Color', 'themeisle-companion' ),
						'show_reset' => true,
						'show_alpha' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset input, .content-form-' . $this->get_type() . ' fieldset textarea, .content-form-' . $this->get_type() . ' fieldset select',
							'property' => 'background-color',
						),
					),
					'field_typography'       => array(
						'type'       => 'typography',
						'label'      => __( 'Field Typography', 'themeisle-companion' ),
						'responsive' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset input, .content-form-' . $this->get_type() . ' fieldset select, .content-form-' . $this->get_type() . ' fieldset textarea',
						),
					),
					'field_border'           => array(
						'type'       => 'border',
						'label'      => __( 'Border', 'themeisle-companion' ),
						'responsive' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset input, .content-form-' . $this->get_type() . ' fieldset textarea, .content-form-' . $this->get_type() . ' fieldset select',
						),
					),
				),
			),
			'button'               => array(
				'title'  => esc_html__( 'Submit Button', 'themeisle-companion' ),
				'fields' => array(
					'button_width'            => array(
						'responsive'   => 'true',
						'type'         => 'unit',
						'label'        => __( 'Width', 'themeisle-companion' ),
						'units'        => array( 'px', 'vw', '%' ),
						'default_unit' => 'px', // Optional
						'preview'      => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset button[name="submit"]',
							'property' => 'width',
						),
					),
					'button_height'           => array(
						'responsive'   => 'true',
						'type'         => 'unit',
						'label'        => __( 'Height', 'themeisle-companion' ),
						'units'        => array( 'px', 'vw', '%' ),
						'default_unit' => 'px', // Optional
						'preview'      => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset button[name="submit"]',
							'property' => 'height',
						),
					),
					'button_background_color' => array(
						'type'       => 'color',
						'label'      => __( 'Button Background Color', 'themeisle-companion' ),
						'show_reset' => true,
						'show_alpha' => false,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset button[name="submit"]',
							'property' => 'background-color',
						),
					),
					'button_text_color'       => array(
						'type'       => 'color',
						'label'      => __( 'Button Text Color', 'themeisle-companion' ),
						'show_reset' => true,
						'show_alpha' => false,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset button[name="submit"]',
							'property' => 'color',
						),
					),
					'button_typography'       => array(
						'type'       => 'typography',
						'label'      => __( 'Typography', 'themeisle-companion' ),
						'responsive' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset button[name="submit"]',
						),
					),
					'button_border'           => array(
						'type'       => 'border',
						'label'      => __( 'Border', 'themeisle-companion' ),
						'responsive' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset button[name="submit"]',
						),
					),
				),
			),
			'button_hover'         => array(
				'title'  => esc_html__( 'Submit Button Hover', 'themeisle-companion' ),
				'fields' => array(
					'button_background_color_hover' => array(
						'type'       => 'color',
						'label'      => __( 'Button Background Color', 'themeisle-companion' ),
						'show_reset' => true,
						'show_alpha' => false,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset button[name="submit"]:hover',
							'property' => 'background-color',
						),
					),
					'button_text_color_hover'       => array(
						'type'       => 'color',
						'label'      => __( 'Button Text Color', 'themeisle-companion' ),
						'show_reset' => true,
						'show_alpha' => false,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset button[name="submit"]:hover',
							'property' => 'color',
						),
					),
					'button_typography_hover'       => array(
						'type'       => 'typography',
						'label'      => __( 'Typography', 'themeisle-companion' ),
						'responsive' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset button[name="submit"]:hover',
						),
					),
					'button_border_hover'           => array(
						'type'       => 'border',
						'label'      => __( 'Border Hover', 'themeisle-companion' ),
						'responsive' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' fieldset button[name="submit"]:hover',
						),
					),
				),
			),
			'notification'         => array(
				'title'  => esc_html__( 'Notification', 'themeisle-companion' ),
				'fields' => array(
					'notification_margin'       => array(
						'type'        => 'dimension',
						'label'       => __( 'Margin', 'themeisle-companion' ),
						'description' => 'px',
					),
					'notification_text_padding' => array(
						'type'        => 'dimension',
						'label'       => __( 'Padding', 'themeisle-companion' ),
						'description' => 'px',
					),
					'notification_width'        => array(
						'type'   => 'unit',
						'label'  => __( 'Width', 'themeisle-companion' ),
						'slider' => array(
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						),
					),
					'notification_typography'   => array(
						'type'       => 'typography',
						'label'      => __( 'Typography', 'themeisle-companion' ),
						'responsive' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' .content-form-notice',
						),
					),
					'notification_box_shadow'   => array(
						'type'        => 'shadow',
						'label'       => __( 'Box Shadow', 'themeisle-companion' ),
						'show_spread' => true,
						'preview'     => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' .content-form-notice',
							'property' => 'box-shadow',
						),
					),
					'notification_alignment'    => array(
						'type'    => 'align',
						'label'   => __( 'alignment', 'themeisle-companion' ),
						'default' => 'left',
					),
				),
			),
			'notification_success' => array(
				'title'  => esc_html__( 'Notification Success', 'themeisle-companion' ),
				'fields' => array(
					'notification_success_background_color' => array(
						'type'       => 'color',
						'label'      => __( 'Background', 'themeisle-companion' ),
						'show_reset' => true,
						'show_alpha' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' .content-form-success',
							'property' => 'background-color',
						),
					),
					'notification_success_text_color' => array(
						'type'       => 'color',
						'label'      => __( 'Text', 'themeisle-companion' ),
						'show_reset' => true,
						'show_alpha' => false,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' .content-form-success',
							'property' => 'color',
						),
					),
					'notification_success_border'     => array(
						'type'    => 'border',
						'label'   => __( 'Border', 'themeisle-companion' ),
						'preview' => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' .content-form-success',
						),
					),
				),
			),
			'notification_error'   => array(
				'title'  => esc_html__( 'Notification Error', 'themeisle-companion' ),
				'fields' => array(
					'notification_error_background_color' => array(
						'type'       => 'color',
						'label'      => __( 'Background', 'themeisle-companion' ),
						'show_reset' => true,
						'show_alpha' => true,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' .content-form-error',
							'property' => 'background-color',
						),
					),
					'notification_error_text_color'       => array(
						'type'       => 'color',
						'label'      => __( 'Text', 'themeisle-companion' ),
						'show_reset' => true,
						'show_alpha' => false,
						'preview'    => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' .content-form-error',
							'property' => 'color',
						),
					),
					'notification_error_border'           => array(
						'type'    => 'border',
						'label'   => __( 'Border', 'themeisle-companion' ),
						'preview' => array(
							'type'     => 'css',
							'selector' => '.content-form-' . $this->get_type() . ' .content-form-error',
						),
					),
				),
			),
		);
		return $args;
	}

	/**
	 * Beaver Widget form settings.
	 *
	 * @param array $args Settings array.
	 *
	 * @return array
	 */
	private function get_form_settings( $args ) {
		$args['general']['sections']['settings'] = array(
			'title'  => esc_html__( 'Fields', 'themeisle-companion' ),
			'fields' => array(
				'fields'     => array(
					'multiple'     => true,
					'type'         => 'form',
					'label'        => esc_html__( 'Field', 'themeisle-companion' ),
					'form'         => $this->get_type() . '_field',
					'preview_text' => 'label',
					'default'      => $this->get_default( 'fields' ),
				),
				'hide_label' => array(
					'type'    => 'select',
					'label'   => __( 'Hide Label', 'themeisle-companion' ),
					'default' => 'show',
					'options' => array(
						'hide' => esc_html__( 'Hide', 'textarea', 'themeisle-companion' ),
						'show' => esc_html__( 'Show', 'textarea', 'themeisle-companion' ),
					),
				),
			),
		);

		$repeater_fields = array(
			'label'       => array(
				'type'  => 'text',
				'label' => esc_html__( 'Label', 'themeisle-companion' ),
			),
			'placeholder' => array(
				'type'  => 'text',
				'label' => esc_html__( 'Placeholder', 'themeisle-companion' ),
			),
			'type'        => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Type', 'themeisle-companion' ),
				'options' => array(
					'text'     => esc_html__( 'Text', 'themeisle-companion' ),
					'email'    => esc_html__( 'Email', 'themeisle-companion' ),
					'textarea' => esc_html__( 'Textarea', 'themeisle-companion' ),
					'password' => esc_html__( 'Password', 'themeisle-companion' ),
				),
			),
			'field_width' => array(
				'type'       => 'select',
				'label'      => esc_html__( 'Field Width', 'themeisle-companion' ),
				'options'    => array(
					'100' => '100%',
					'75'  => '75%',
					'66'  => '66%',
					'50'  => '50%',
					'33'  => '33%',
					'25'  => '25%',
				),
				'responsive' => true,
			),
			'required'    => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Is required?', 'themeisle-companion' ),
				'options' => array(
					'required' => esc_html__( 'Required', 'themeisle-companion' ),
					'optional' => esc_html__( 'Optional', 'themeisle-companion' ),
				),
			),
		);

		\FLBuilder::register_settings_form(
			$this->get_type() . '_field',
			array(
				'title' => esc_html__( 'Field', 'themeisle-companion' ),
				'tabs'  => array(
					'general' => array(
						'title'    => esc_html__( 'Field', 'themeisle-companion' ),
						'sections' => array(
							'fields' => array(
								'title'  => esc_html__( 'Field', 'themeisle-companion' ),
								'fields' => apply_filters( $this->get_type() . '_repeater_fields', $repeater_fields ),
							),
						),
					),
				),
			)
		);

		return $args;
	}

	/**
	 * Beaver Widget controls settings.
	 *
	 * @param array $args Settings array.
	 *
	 * @return array
	 */
	private function get_control_settings( $args ) {
		$args['general']['sections']['controls'] = apply_filters(
			$this->get_type() . '_controls_fields',
			array(
				'title'  => esc_html__( 'Form Settings', 'themeisle-companion' ),
				'fields' => array(
					'submit_label'    => array(
						'type'        => 'text',
						'label'       => esc_html__( 'Submit', 'themeisle-companion' ),
						'default'     => $this->get_default( 'submit_label' ),
						'description' => esc_html__( 'The Call To Action label', 'themeisle-companion' ),
					),
					'submit_display'  => array(
						'type'    => 'select',
						'label'   => __( 'Submit Display', 'themeisle-companion' ),
						'options' => array(
							'inline' => esc_html__( 'Inline', 'textarea', 'themeisle-companion' ),
							'block'  => esc_html__( 'Block', 'textarea', 'themeisle-companion' ),
						),
						'toggle'  => array(
							'block' => array(
								'fields' => array( 'submit_position' ),
							),
						),
					),
					'submit_position' => array(
						'type'    => 'align',
						'label'   => esc_html__( 'Alignment', 'themeisle-companion' ),
						'default' => 'left',
					),
				),
			)
		);
		return $args;
	}

	/**
	 * Set module settings.
	 */
	private function get_module_settings() {

		$args = array(
			'general' => array(
				'title'    => $this->get_widget_name(),
				'sections' => array(),
			),
			'style'   => array(
				'title'    => esc_html__( 'Style', 'themeisle-companion' ),
				'sections' => array(),
			),
		);

		$args = $this->get_style_settings( $args );
		$args = $this->get_form_settings( $args );
		$args = $this->get_control_settings( $args );

		return $args;
	}

	/**
	 * Get default config data.
	 *
	 * @param string $field Field to retrieve.
	 * @return array | string | bool
	 */
	public function get_default( $field ) {
		if ( ! array_key_exists( $field, $this->default_data ) ) {
			return false;
		}
		return $this->default_data[ $field ];
	}

	/**
	 * Render the preview of form notifications.
	 *
	 * @return bool
	 */
	private function maybe_render_form_notification() {
		if ( ! \FLBuilderModel::is_builder_active() ) {
			return false;
		}

		$style = '';//$this->get_notice_style();

		echo '<div class="content-form-notice-wrapper">';
		echo '<h3 ' . $style . ' class="content-form-notice content-form-success">' . __( 'This is a preview of how the success notification will look', 'themeisle-companion' ) . '</h3>';
		echo '</div>';

		echo '<div class="content-form-notice-wrapper">';
		echo '<h3 ' . $style . ' class="content-form-notice content-form-error">' . __( 'This is a preview of how the error notification will look', 'themeisle-companion' ) . '</h3>';
		echo '</div>';

		return true;
	}
	/**
	 * Render the header of the form based on the block id(for JS identification)
	 *
	 * @param $id
	 */
	public function render_form_header( $id ) {
		$url = admin_url( 'admin-post.php' );
		echo '<form action="' . esc_url( $url ) . '" method="post" name="content-form-' . $id . '" id="content-form-' . $id . '" class="ti-cf-module content-form content-form-' . $this->get_type() . '">';
		$this->maybe_render_form_notification();
		wp_nonce_field( 'content-form-' . $id, '_wpnonce_' . $this->get_type() );
		echo '<input type="hidden" name="action" value="content_form_submit" />';
		echo '<input type="hidden" name="form-type" value="' . $this->get_type() . '" />';
		echo '<input type="hidden" name="form-builder" value="beaver" />';
		echo '<input type="hidden" name="post-id" value="' . get_the_ID() . '" />';
		echo '<input type="hidden" name="form-id" value="' . $id . '" />';
	}

	/**
	 * Render form errors.
	 *
	 * @return bool
	 */
	public function maybe_render_form_errors( $widget_id ) {
		$has_error = false;
		if ( ! current_user_can( 'manage_options' ) ) {
			return $has_error;
		}
		$widget = $this->get_type();

		require_once TI_CONTENT_FORMS_PATH . '/includes/widgets-public/widget_actions_base.php';
		$widget_settings = Widget_Actions_Base::get_beaver_module_settings_by_id( $widget_id, get_the_ID() );

		if ( $widget === 'newsletter' ) {

			echo '<div class="content-forms-required">';

			if ( array_key_exists( 'access_key', (array) $widget_settings ) && empty( $widget_settings['access_key'] ) ) {
				echo '<p>';
				printf(
					esc_html__( 'The %s setting is required!', 'themeisle-companion' ),
					'<strong>' . esc_html__( 'Access Key', 'themeisle-companion' ) . '</strong>'
				);
				echo '</p>';
				$has_error = true;
			}

			if ( array_key_exists( 'list_id', (array) $widget_settings ) && empty( $widget_settings['list_id'] ) ) {
				echo '<p>';
				printf(
					esc_html__( 'The %s setting is required!', 'themeisle-companion' ),
					'<strong>' . esc_html__( 'List id', 'themeisle-companion' ) . '</strong>'
				);
				echo '</p>';
				$has_error = true;
			}

			$form_fields = $widget_settings['fields'];
			$mapping     = array();
			foreach ( (array) $form_fields as $field ) {
				$field_map = $field->field_map;
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

		if ( $widget === 'contact' ) {
			if ( array_key_exists( 'to_send_email', (array) $widget_settings ) && empty( $widget_settings['to_send_email'] ) ) {
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
	 * Render form fields
	 */
	public function render_form_field( $field, $label_visibility ) {
		$key         = Form_Manager::get_field_key_name( $field );
		$key         = $key === 'ADDRESS' ? $key = 'ADDRESS[addr1]' : $key;
		$form_id     = $this->node;
		$field_name  = 'data[' . $form_id . '][' . $key . ']';
		$required    = $field['required'] === 'required' ? 'required="required"' : '';
		$placeholder = array_key_exists( 'placeholder', (array) $field ) && ! empty( $field['placeholder'] ) ? 'placeholder="' . esc_attr( $field['placeholder'] ) . '"' : '';
		$width       = array_key_exists( 'field_width', (array) $field ) && ! empty( $field['field_width'] ) ? 'style="width:' . $field['field_width'] . '%"' : '';

		echo '<fieldset class="content-form-field-' . esc_attr( $field['type'] ) . '" ' . $width . '>';
		if ( $label_visibility === 'show' ) {
			$this->maybe_render_field_label( $field_name, $field );
		}

		switch ( $field['type'] ) {
			case 'textarea':
				echo '<textarea name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_name ) . '" ' . $required . ' ' . $placeholder . ' cols="30" rows="5"></textarea>';
				break;
			case 'password':
				echo '<input type="password" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_name ) . '" ' . $required . '>';
				break;
			default:
				echo '<input type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_name ) . '" ' . $required . ' ' . $placeholder . '">';
				break;
		}

		echo '</fieldset>';

	}

	/**
	 * @param $field
	 * @param $label_visibility
	 * @param $widget_id
	 *
	 * @return bool
	 */
	public function maybe_render_newsletter_address( $field, $widget_id ) {
		require_once TI_CONTENT_FORMS_PATH . '/includes/widgets-public/widget_actions_base.php';
		$widget_settings = Widget_Actions_Base::get_beaver_module_settings_by_id( $widget_id, get_the_ID() );
		if ( ! is_array( $widget_settings ) ) {
			return false;
		}
		if ( ! array_key_exists( 'provider', (array) $widget_settings ) || $widget_settings['provider'] !== 'mailchimp' ) {
			return false;
		}

		if ( ! array_key_exists( 'field_map', (array) $field ) || strtolower( $field['field_map'] ) !== 'address' ) {
			return false;
		}

		$display_label  = $widget_settings['hide_label'];
		$required       = $field['required'] === 'required' ? 'required="required"' : '';
		$width          = array_key_exists( 'field_width', (array) $field ) ? 'style="width:' . $field['field_width'] . '%"' : '';
		$address_fields = array(
			'addr2'   => __( 'Address Line 2', 'themeisle-companion' ),
			'city'    => __( 'City', 'themeisle-companion' ),
			'state'   => __( 'State/Province/Region', 'themeisle-companion' ),
			'zip'     => __( 'Postal / Zip Code', 'themeisle-companion' ),
			'country' => __( 'Country', 'themeisle-companion' ),
		);
		foreach ( $address_fields as $address_item => $item_label ) {
			$placeholder = array_key_exists( 'placeholder', (array) $field ) && ! empty( $field['placeholder'] ) ? 'placeholder="' . esc_attr( $item_label ) . '"' : '';
			$field_name  = 'data[' . $widget_id . '][ADDRESS[' . $address_item . ']]';
			echo '<fieldset class="content-form-field-' . esc_attr( $field['type'] ) . '" ' . $width . '>';

			if ( $display_label !== 'hide' ) {
				echo '<label for="' . esc_attr( $field_name ) . '" >';
				echo $item_label;
				if ( $field['required'] === 'required' ) {
					echo '<span class="required-mark"> *</span>';
				}
				echo '</label>';
			}

			if ( $address_item === 'country' ) {
				echo '<div class="elementor-select-wrapper">';
				echo '<select class="country" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_name ) . '" ' . $required . '><option value="">-</option><option value="164">USA</option><option value="286">Aaland Islands</option><option value="274">Afghanistan</option><option value="2">Albania</option><option value="3">Algeria</option><option value="178">American Samoa</option><option value="4">Andorra</option><option value="5">Angola</option><option value="176">Anguilla</option><option value="175">Antigua And Barbuda</option><option value="6">Argentina</option><option value="7">Armenia</option><option value="179">Aruba</option><option value="8">Australia</option><option value="9">Austria</option><option value="10">Azerbaijan</option><option value="11">Bahamas</option><option value="12">Bahrain</option><option value="13">Bangladesh</option><option value="14">Barbados</option><option value="15">Belarus</option><option value="16">Belgium</option><option value="17">Belize</option><option value="18">Benin</option><option value="19">Bermuda</option><option value="20">Bhutan</option><option value="21">Bolivia</option><option value="22">Bosnia and Herzegovina</option><option value="23">Botswana</option><option value="181">Bouvet Island</option><option value="24">Brazil</option><option value="180">Brunei Darussalam</option><option value="25">Bulgaria</option><option value="26">Burkina Faso</option><option value="27">Burundi</option><option value="28">Cambodia</option><option value="29">Cameroon</option><option value="30">Canada</option><option value="31">Cape Verde</option><option value="32">Cayman Islands</option><option value="33">Central African Republic</option><option value="34">Chad</option><option value="35">Chile</option><option value="36">China</option><option value="185">Christmas Island</option><option value="37">Colombia</option><option value="204">Comoros</option><option value="38">Congo</option><option value="183">Cook Islands</option><option value="268">Costa Rica</option><option value="275">Cote D\'Ivoire</option><option value="40">Croatia</option><option value="276">Cuba</option><option value="298">Curacao</option><option value="41">Cyprus</option><option value="42">Czech Republic</option><option value="43">Denmark</option><option value="44">Djibouti</option><option value="289">Dominica</option><option value="187">Dominican Republic</option><option value="233">East Timor</option><option value="45">Ecuador</option><option value="46">Egypt</option><option value="47">El Salvador</option><option value="48">Equatorial Guinea</option><option value="49">Eritrea</option><option value="50">Estonia</option><option value="51">Ethiopia</option><option value="189">Falkland Islands</option><option value="191">Faroe Islands</option><option value="52">Fiji</option><option value="53">Finland</option><option value="54">France</option><option value="193">French Guiana</option><option value="277">French Polynesia</option><option value="56">Gabon</option><option value="57">Gambia</option><option value="58">Georgia</option><option value="59">Germany</option><option value="60">Ghana</option><option value="194">Gibraltar</option><option value="61">Greece</option><option value="195">Greenland</option><option value="192">Grenada</option><option value="196">Guadeloupe</option><option value="62">Guam</option><option value="198">Guatemala</option><option value="270">Guernsey</option><option value="63">Guinea</option><option value="65">Guyana</option><option value="200">Haiti</option><option value="66">Honduras</option><option value="67">Hong Kong</option><option value="68">Hungary</option><option value="69">Iceland</option><option value="70">India</option><option value="71">Indonesia</option><option value="278">Iran</option><option value="279">Iraq</option><option value="74">Ireland</option><option value="75">Israel</option><option value="76">Italy</option><option value="202">Jamaica</option><option value="78">Japan</option><option value="288">Jersey  (Channel Islands)</option><option value="79">Jordan</option><option value="80">Kazakhstan</option><option value="81">Kenya</option><option value="203">Kiribati</option><option value="82">Kuwait</option><option value="83">Kyrgyzstan</option><option value="84">Lao People\'s Democratic Republic</option><option value="85">Latvia</option><option value="86">Lebanon</option><option value="87">Lesotho</option><option value="88">Liberia</option><option value="281">Libya</option><option value="90">Liechtenstein</option><option value="91">Lithuania</option><option value="92">Luxembourg</option><option value="208">Macau</option><option value="93">Macedonia</option><option value="94">Madagascar</option><option value="95">Malawi</option><option value="96">Malaysia</option><option value="97">Maldives</option><option value="98">Mali</option><option value="99">Malta</option><option value="207">Marshall Islands</option><option value="210">Martinique</option><option value="100">Mauritania</option><option value="212">Mauritius</option><option value="241">Mayotte</option><option value="101">Mexico</option><option value="102">Moldova, Republic of</option><option value="103">Monaco</option><option value="104">Mongolia</option><option value="290">Montenegro</option><option value="294">Montserrat</option><option value="105">Morocco</option><option value="106">Mozambique</option><option value="242">Myanmar</option><option value="107">Namibia</option><option value="108">Nepal</option><option value="109">Netherlands</option><option value="110">Netherlands Antilles</option><option value="213">New Caledonia</option><option value="111">New Zealand</option><option value="112">Nicaragua</option><option value="113">Niger</option><option value="114">Nigeria</option><option value="217">Niue</option><option value="214">Norfolk Island</option><option value="272">North Korea</option><option value="116">Norway</option><option value="117">Oman</option><option value="118">Pakistan</option><option value="222">Palau</option><option value="282">Palestine</option><option value="119">Panama</option><option value="219">Papua New Guinea</option><option value="120">Paraguay</option><option value="121">Peru</option><option value="122">Philippines</option><option value="221">Pitcairn</option><option value="123">Poland</option><option value="124">Portugal</option><option value="126">Qatar</option><option value="315">Republic of Kosovo</option><option value="127">Reunion</option><option value="128">Romania</option><option value="129">Russia</option><option value="130">Rwanda</option><option value="205">Saint Kitts and Nevis</option><option value="206">Saint Lucia</option><option value="237">Saint Vincent and the Grenadines</option><option value="132">Samoa (Independent)</option><option value="227">San Marino</option><option value="133">Saudi Arabia</option><option value="134">Senegal</option><option value="266">Serbia</option><option value="135">Seychelles</option><option value="136">Sierra Leone</option><option value="137">Singapore</option><option value="302">Sint Maarten</option><option value="138">Slovakia</option><option value="139">Slovenia</option><option value="223">Solomon Islands</option><option value="140">Somalia</option><option value="141">South Africa</option><option value="257">South Georgia and the South Sandwich Islands</option><option value="142">South Korea</option><option value="311">South Sudan</option><option value="143">Spain</option><option value="144">Sri Lanka</option><option value="293">Sudan</option><option value="146">Suriname</option><option value="225">Svalbard and Jan Mayen Islands</option><option value="147">Swaziland</option><option value="148">Sweden</option><option value="149">Switzerland</option><option value="285">Syria</option><option value="152">Taiwan</option><option value="260">Tajikistan</option><option value="153">Tanzania</option><option value="154">Thailand</option><option value="155">Togo</option><option value="232">Tonga</option><option value="234">Trinidad and Tobago</option><option value="156">Tunisia</option><option value="157">Turkey</option><option value="287">Turks &amp; Caicos Islands</option><option value="159">Uganda</option><option value="161">Ukraine</option><option value="162">United Arab Emirates</option><option value="262">United Kingdom</option><option value="163">Uruguay</option><option value="165">Uzbekistan</option><option value="239">Vanuatu</option><option value="166">Vatican City State (Holy See)</option><option value="167">Venezuela</option><option value="168">Vietnam</option><option value="169">Virgin Islands (British)</option><option value="238">Virgin Islands (U.S.)</option><option value="188">Western Sahara</option><option value="170">Yemen</option><option value="173">Zambia</option><option value="174">Zimbabwe</option></select>';
				echo '</div>';
			} else {
				echo '<input type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_name ) . '" ' . $required . ' ' . $placeholder . '>';
			}

			echo '</fieldset>';
		}
		return true;
	}

	/**
	 * @param $field_name
	 * @param $field
	 * @return bool
	 */
	private function maybe_render_field_label( $field_name, $field ) {
		$label = $field['label'];
		if ( empty( $label ) ) {
			return false;
		}

		echo '<label for="' . esc_attr( $field_name ) . ' ">';
		echo $field['label'];
		if ( $field['required'] === 'required' ) {
			echo '<span class="required-mark"> *</span>';
		}
		echo '</label>';

		return true;
	}

	/**
	 * Check numeric css property in frontend.css.php
	 *
	 * @param Object $settings Settings object.
	 * @param string $property_name Property name.
	 *
	 * @return bool
	 */
	public function check_numeric_property( $settings, $property_name ) {
		return property_exists( $settings, $property_name ) && is_numeric( $settings->$property_name );
	}

	/**
	 * Check color css property in frontend.css.php
	 *
	 * @param Object $settings Settings object.
	 * @param string $property_name Property name.
	 *
	 * @return bool
	 */
	public function check_color_property( $settings, $property_name ) {
		return property_exists( $settings, $property_name ) && ctype_xdigit( $settings->$property_name ) && strlen( $settings->$property_name ) === 6;
	}

	/**
	 * Check if not empty property in frontend.css.php
	 *
	 * @param Object $settings Settings object.
	 * @param string $property_name Property name.
	 *
	 * @return bool
	 */
	public function check_not_empty_property( $settings, $property_name ) {
		return property_exists( $settings, $property_name ) && ! empty( $settings->$property_name );
	}

	/**
	 * Render form footer.
	 */
	public function render_form_footer() {
		echo '</form>';
	}

	/**
	 * Get form type.
	 * @return string
	 */
	abstract function get_type();

	/**
	 * Get widget name.
	 *
	 * @return string
	 */
	abstract function get_widget_name();

	/**
	 * Add widget specific repeater fields.
	 *
	 * @param array $fields Repeater fields.
	 * @return mixed
	 */
	abstract function add_widget_repeater_fields( $fields );

	/**
	 * Add widget specific controls.
	 *
	 * @param array $fields Widget fields.
	 * @return mixed
	 */
	abstract function add_widget_specific_controls( $fields );

	/**
	 * Set default values for registration widget.
	 *
	 * @return array
	 */
	abstract function widget_default_values();
}
