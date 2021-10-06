<?php
/**
 * Pricing table module.
 *
 * @package themeisle-companion
 */

// Get the module directory.
$module_directory = $this->get_dir();

// Include common functions file.
require_once( $module_directory . '/inc/common-functions.php' );

// Include custom fields
require_once( $module_directory . '/custom-fields/toggle-field/toggle_field.php' );

/**
 * Class PricingTableModule
 */
class PricingTableModule extends FLBuilderModule {

	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir and url in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'          => esc_html__( 'Pricing table', 'themeisle-companion' ),
				'description'   => esc_html__( 'Pricing Tables are the perfect option when showcasing services you have on offer.', 'themeisle-companion' ),
				'category'      => esc_html__( 'Orbit Fox Modules', 'themeisle-companion' ),
				'dir'           => BEAVER_WIDGETS_PATH . 'modules/pricing-table/',
				'url'           => BEAVER_WIDGETS_URL . 'modules/pricing-table/',
				'editor_export' => true, // Defaults to true and can be omitted.
				'enabled'       => true, // Defaults to true and can be omitted.
			)
		);
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module(
	'PricingTableModule',
	array(
		'content' => array(
			'title' => esc_html__( 'Content', 'themeisle-companion' ), // Tab title
			'sections' => array(
				'header' => array(
					'title'  => esc_html__( 'Plan Header', 'themeisle-companion' ),
					'fields' => array(
						'plan_title' => array(
							'type'    => 'text',
							'label'   => esc_html__( 'Title', 'themeisle-companion' ),
							'default' => esc_html__( 'Plan title', 'themeisle-companion' ),
							'preview' => array(
								'type'     => 'text',
								'selector' => '.obfx-plan-title',
							),
						),
						'plan_title_tag' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Title tag', 'themeisle-companion' ),
							'default' => 'h2',
							'options' => array(
								'h1' => esc_html__( 'h1', 'themeisle-companion' ),
								'h2' => esc_html__( 'h2', 'themeisle-companion' ),
								'h3' => esc_html__( 'h3', 'themeisle-companion' ),
								'h4' => esc_html__( 'h4', 'themeisle-companion' ),
								'h5' => esc_html__( 'h5', 'themeisle-companion' ),
								'h6' => esc_html__( 'h6', 'themeisle-companion' ),
								'p'  => esc_html__( 'p', 'themeisle-companion' ),
							),
						),
						'plan_subtitle' => array(
							'type'    => 'text',
							'label'   => esc_html__( 'Subtitle', 'themeisle-companion' ),
							'default' => esc_html__( 'Plan subtitle', 'themeisle-companion' ),
							'preview' => array(
								'type'     => 'text',
								'selector' => '.obfx-plan-subtitle',
							),
						),
						'plan_subtitle_tag' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Subtitle tag', 'themeisle-companion' ),
							'default' => 'p',
							'options' => array(
								'h1' => esc_html__( 'h1', 'themeisle-companion' ),
								'h2' => esc_html__( 'h2', 'themeisle-companion' ),
								'h3' => esc_html__( 'h3', 'themeisle-companion' ),
								'h4' => esc_html__( 'h4', 'themeisle-companion' ),
								'h5' => esc_html__( 'h5', 'themeisle-companion' ),
								'h6' => esc_html__( 'h6', 'themeisle-companion' ),
								'p'  => esc_html__( 'p', 'themeisle-companion' ),
							),
						),
					),
				),
				'price' => array(
					'title'  => esc_html__( 'Price Tag', 'themeisle-companion' ),
					'fields' => array(
						'price' => array(
							'type'    => 'text',
							'label'   => esc_html__( 'Price', 'themeisle-companion' ),
							'default' => '50',
							'preview' => array(
								'type'     => 'text',
								'selector' => '.obfx-price',
							),
						),
						'currency' => array(
							'type'    => 'text',
							'label'   => esc_html__( 'Currency', 'themeisle-companion' ),
							'default' => '$',
							'preview' => array(
								'type'     => 'text',
								'selector' => '.obfx-currency',
							),
						),
						'currency_position' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Currency position', 'themeisle-companion' ),
							'default' => 'after',
							'options' => array(
								'before' => esc_html__( 'Before', 'themeisle-companion' ),
								'after'  => esc_html__( 'After', 'themeisle-companion' ),
							),
						),
						'period' => array(
							'type'    => 'text',
							'label'   => esc_html__( 'Period', 'themeisle-companion' ),
							'default' => esc_html__( '/month', 'themeisle-companion' ),
							'preview' => array(
								'type'     => 'text',
								'selector' => '.obfx-period',
							),
						),
					),
				),
				'features' => array(
					'title' => esc_html__( 'Features list', 'themeisle-companion' ),
					'fields' => array(
						'features' => array(
							'multiple' => true,
							'type'          => 'form',
							'label'         => esc_html__( 'Feature', 'themeisle-companion' ),
							'form'          => 'feature_field', // ID of a registered form.
							'preview_text'  => 'text', // ID of a field to use for the preview text.
						),
					),
				),
				'button' => array(
					'title' => esc_html__( 'Button', 'themeisle-companion' ),
					'fields' => array(
						'text' => array(
							'type'    => 'text',
							'label'   => esc_html__( 'Button text', 'themeisle-companion' ),
							'default' => esc_html__( 'Button', 'themeisle-companion' ),
							'preview' => array(
								'type'     => 'text',
								'selector' => '.obfx-plan-button',
							),
						),
						'link' => array(
							'type' => 'link',
							'label' => esc_html__( 'Button link', 'themeisle-companion' ),
						),
					),
				),
				'appearance' => array(
					'title' => esc_html__( 'Appearance', 'themeisle-companion' ),
					'fields' => array(
						'card_layout' => array(
							'type'          => 'obfx_toggle',
							'label'         => esc_html__( 'Card layout', 'themeisle-companion' ),
							'default'       => 'yes',
						),
						'text_position' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Align', 'themeisle-companion' ),
							'default' => 'center',
							'options' => array(
								'center' => esc_html__( 'Center', 'themeisle-companion' ),
								'left'  => esc_html__( 'Left', 'themeisle-companion' ),
								'right'  => esc_html__( 'Right', 'themeisle-companion' ),
							),
						),
					),
				),
			),
		),
		'header_style' => array(
			'title' => esc_html__( 'Header Style', 'themeisle-companion' ),
			'sections' => array(
				'header_padding' => themeisle_four_fields_control(
					array(
						'default' => array(
							'top' => 15,
							'bottom' => 15,
							'left' => 0,
							'right' => 0,
						),
						'selector' => '.obfx-pricing-header',
						'field_name_prefix' => '',
					)
				),
				'colors' => array(
					'title'  => esc_html__( 'Colors', 'themeisle-companion' ),
					'fields' => array(
						'title_color' => array(
							'type' => 'color',
							'label' => esc_html__( 'Title color', 'themeisle-companion' ),
							'preview' => array(
								'type' => 'css',
								'rules' => array(
									array(
										'selector' => '.obfx-pricing-header *:first-child',
										'property'     => 'color',
									),
								),
							),
						),
						'subtitle_color' => array(
							'type' => 'color',
							'label' => esc_html__( 'Subtitle color', 'themeisle-companion' ),
							'preview' => array(
								'type' => 'css',
								'rules' => array(
									array(
										'selector' => '.obfx-pricing-header *:last-child',
										'property'     => 'color',
									),
								),
							),
						),
					),
				),
				'title_typography' => themeisle_typography_settings(
					array(
						'title' => esc_html__( 'Title typography', 'themeisle-companion' ),
						'prefix' => 'title_',
						'selector' => '.obfx-pricing-header *:first-child',
					)
				),
				'subtitle_typography' => themeisle_typography_settings(
					array(
						'title' => esc_html__( 'Subtitle typography', 'themeisle-companion' ),
						'prefix' => 'subtitle_',
						'selector' => '.obfx-pricing-header *:last-child',
					)
				),
				'header_background' => array(
					'title' => esc_html__( 'Background', 'themeisle-companion' ),
					'fields' => array(
						'bg_type' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Type', 'themeisle-companion' ),
							'default' => 'color',
							'options' => array(
								'color' => esc_html__( 'Color', 'themeisle-companion' ),
								'image' => esc_html__( 'Background', 'themeisle-companion' ),
								'gradient' => esc_html__( 'Gradient', 'themeisle-companion' ),
							),
							'toggle' => array(
								'color' => array(
									'fields' => array('header_bg_color'),
								),
								'image' => array(
									'fields' => array('header_bg_image'),
								),
								'gradient' => array(
									'fields' => array('gradient_color1', 'gradient_color2', 'gradient_orientation'),
								),
							),
						),
						'header_bg_color' => array(
							'type' => 'color',
							'label' => esc_html__( 'Background color', 'themeisle-companion' ),
							'show_reset'    => true,
							'preview' => array(
								'type' => 'css',
								'rules' => array(
									array(
										'selector' => '.obfx-pricing-header',
										'property'     => 'background-color',
									),
								),
							),
						),
						'header_bg_image' => array(
							'type'          => 'photo',
							'label'         => esc_html__( 'Photo Field', 'themeisle-companion' ),
							'show_remove'    => true,
						),
						'gradient_color1' => array(
							'type' => 'color',
							'label' => esc_html__( 'Gradient color 1', 'themeisle-companion' ),
							'show_reset'    => true,
						),
						'gradient_color2' => array(
							'type' => 'color',
							'label' => esc_html__( 'Gradient color 2', 'themeisle-companion' ),
							'show_reset'    => true,
						),
						'gradient_orientation' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Orientation', 'themeisle-companion' ),
							'default' => 'horizontal',
							'options' => array(
								'horizontal' => esc_html__( 'Horizontal', 'themeisle-companion' ),
								'vertical' => esc_html__( 'Vertical', 'themeisle-companion' ),
								'diagonal_bottom' => esc_html__( 'Diagonal bottom', 'themeisle-companion' ),
								'diagonal_top' => esc_html__( 'Diagonal top', 'themeisle-companion' ),
								'radial' => esc_html__( 'Radial', 'themeisle-companion' ),
							),
						),
					),
				),
			),
		),
		'price_style' => array(
			'title' => esc_html__( 'Price Style', 'themeisle-companion' ),
			'sections' => array(
				'price_padding' => themeisle_four_fields_control(
					array(
						'default' => array(
							'top' => 15,
							'bottom' => 15,
							'left' => 0,
							'right' => 0,
						),
						'selector' => '.obfx-pricing-price',
						'field_name_prefix' => 'price_',
					)
				),
				'price_colors' => array(
					'title' => esc_html__( 'Colors', 'themeisle-companion' ),
					'fields' => array(
						'price_color' => array(
							'type'          => 'color',
							'label'         => esc_html__( 'Price color', 'themeisle-companion' ),
							'preview'       => array(
								'type'          => 'css',
								'rules'           => array(
									array(
										'selector'     => '.obfx-price',
										'property'     => 'color',
									),
								),
							),
						),
						'currency_color' => array(
							'type'          => 'color',
							'label'         => esc_html__( 'Currency color', 'themeisle-companion' ),
							'preview'       => array(
								'type'          => 'css',
								'rules'           => array(
									array(
										'selector'     => '.obfx-pricing-price sup',
										'property'     => 'color',
									),
								),
							),
						),
						'period_color' => array(
							'type'          => 'color',
							'label'         => esc_html__( 'Period color', 'themeisle-companion' ),
							'preview'       => array(
								'type'          => 'css',
								'rules'           => array(
									array(
										'selector'     => '.obfx-period',
										'property'     => 'color',
									),
								),
							),
						),
					),
				),
				'price_typography' => themeisle_typography_settings(
					array(
						'prefix' => 'price_',
						'selector' => '.obfx-pricing-price',
						'font_size_default' => 40,
					)
				),
			),
		),
		'features_style' => array(
			'title' => esc_html__( 'Features Style', 'themeisle-companion' ),
			'sections' => array(
				'features_padding' => themeisle_four_fields_control(
					array(
						'default' => array(
							'top' => 15,
							'bottom' => 15,
							'left' => 0,
							'right' => 0,
						),
						'selector' => '.obfx-pricing-price',
						'field_name_prefix' => 'features_',
					)
				),
				'features_colors' => array(
					'title' => esc_html__( 'Colors', 'themeisle-companion' ),
					'fields' => array(
						'icon_color' => array(
							'type'          => 'color',
							'label'         => esc_html__( 'Icon color', 'themeisle-companion' ),
							'preview'       => array(
								'type'          => 'css',
								'rules'           => array(
									array(
										'selector'     => '.obfx-pricing-feature-content i',
										'property'     => 'color',
									),
								),
							),
						),
						'bold_color' => array(
							'type'          => 'color',
							'label'         => esc_html__( 'Bold text color', 'themeisle-companion' ),
							'preview'       => array(
								'type'          => 'css',
								'rules'           => array(
									array(
										'selector'     => '.obfx-pricing-feature-content strong',
										'property'     => 'color',
									),
								),
							),
						),
						'feature_color' => array(
							'type'          => 'color',
							'label'         => esc_html__( 'Text color', 'themeisle-companion' ),
							'preview'       => array(
								'type'          => 'css',
								'rules'           => array(
									array(
										'selector'     => '.obfx-pricing-feature-content:not(i):not(strong)',
										'property'     => 'color',
									),
								),
							),
						),
					),
				),
				'feature_typography' => themeisle_typography_settings(
					array(
						'prefix' => 'feature_',
						'selector' => '.obfx-pricing-feature-content *',
						'font_size_default' => 17,
					)
				),
			),
		),
		'button_style' => array(
			'title' => esc_html__( 'Button Style', 'themeisle-companion' ),
			'sections' => array(
				'button_margins' => themeisle_four_fields_control(
					array(
						'default' => array(
							'top' => 15,
							'bottom' => 15,
							'left' => 0,
							'right' => 0,
						),
						'selector' => '.obfx-plan-bottom',
						'field_name_prefix' => 'button_margin_',
						'type' => 'margin',
					)
				),
				'button_padding' => themeisle_four_fields_control(
					array(
						'default' => array(
							'top' => 6,
							'bottom' => 6,
							'left' => 12,
							'right' => 12,
						),
						'selector' => '.obfx-plan-button',
						'field_name_prefix' => 'button_padding_',
					)
				),
				'button_colors' => array(
					'title' => esc_html__( 'Colors', 'themeisle-companion' ),
					'fields' => array(
						'button_text_color' => array(
							'type'          => 'color',
							'label'         => esc_html__( 'Text', 'themeisle-companion' ),
							'preview'       => array(
								'type'          => 'css',
								'rules'           => array(
									array(
										'selector'     => '.obfx-plan-button',
										'property'     => 'color',
									),
								),
							),
						),
						'button_text_color_hover' => array(
							'type'          => 'color',
							'label'         => esc_html__( 'Text on hover', 'themeisle-companion' ),
							'preview'       => array(
								'type'          => 'css',
								'rules'           => array(
									array(
										'selector'     => '.obfx-plan-button:hover',
										'property'     => 'color',
									),
								),
							),
						),
						'button_bg_color' => array(
							'type'          => 'color',
							'label'         => esc_html__( 'Button background', 'themeisle-companion' ),
							'preview'       => array(
								'type'          => 'css',
								'rules'           => array(
									array(
										'selector'     => '.obfx-plan-button',
										'property'     => 'background-color',
									),
								),
							),
						),
						'button_bg_color_hover' => array(
							'type'          => 'color',
							'label'         => esc_html__( 'Button background on hover', 'themeisle-companion' ),
							'preview'       => array(
								'type'          => 'css',
								'rules'           => array(
									array(
										'selector'     => '.obfx-plan-button:hover',
										'property'     => 'background-color',
									),
								),
							),
						),
					),
				),
				'button_typography' => themeisle_typography_settings(
					array(
						'prefix' => 'button_',
						'selector' => '.obfx-plan-button',
						'font_size_default' => 15,
					)
				),
			),
		),
	)
);


FLBuilder::register_settings_form(
	'feature_field',
	array(
		'title' => __( 'Feature', 'themeisle-companion' ),
		'tabs'  => array(
			'general'      => array(
				'title'         => esc_html__( 'General', 'themeisle-companion' ),
				'sections'      => array(
					'general'       => array(
						'title'         => '',
						'fields'        => array(
							'bold_text' => array(
								'type'  => 'text',
								'label' => esc_html__( 'Bold text', 'themeisle-companion' ),
							),
							'text' => array(
								'type'  => 'text',
								'label' => esc_html__( 'Text', 'themeisle-companion' ),
							),
							'icon' => array(
								'type'          => 'icon',
								'label'         => esc_html__( 'Icon', 'themeisle-companion' ),
								'show_remove'   => true,
							),
						),
					),
				),
			),
		),
	)
);
