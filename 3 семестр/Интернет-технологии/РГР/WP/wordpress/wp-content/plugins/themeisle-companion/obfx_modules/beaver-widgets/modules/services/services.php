<?php
/**
 * Services module.
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
class ServicesModule extends FLBuilderModule {

	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir and url in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'          => esc_html__( 'Services', 'themeisle-companion' ),
				'description'   => esc_html__( 'An overview of the products or services.', 'themeisle-companion' ),
				'category'      => esc_html__( 'Orbit Fox Modules', 'themeisle-companion' ),
				'dir'           => BEAVER_WIDGETS_PATH . 'modules/services/',
				'url'           => BEAVER_WIDGETS_URL . 'modules/services/',
			)
		);
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module(
	'ServicesModule',
	array(
		'content' => array(
			'title' => esc_html__( 'Content', 'themeisle-companion' ), // Tab title
			'sections' => array(
				'content' => array(
					'title' => '',
					'fields' => array(
						'services' => array(
							'multiple' => true,
							'type'          => 'form',
							'label'         => esc_html__( 'Service', 'themeisle-companion' ),
							'form'          => 'service_content', // ID of a registered form.
							'preview_text'  => 'title', // ID of a field to use for the preview text.
						),
						'column_number' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Number of columns', 'themeisle-companion' ),
							'default' => '3',
							'options' => array(
								'1' => esc_html__( '1', 'themeisle-companion' ),
								'2' => esc_html__( '2', 'themeisle-companion' ),
								'3' => esc_html__( '3', 'themeisle-companion' ),
								'4' => esc_html__( '4', 'themeisle-companion' ),
								'5' => esc_html__( '5', 'themeisle-companion' ),
							),
						),
						'card_layout' => array(
							'type'          => 'obfx_toggle',
							'label'         => esc_html__( 'Card layout', 'themeisle-companion' ),
							'default'       => 'yes',
						),
						'background_color' => array(
							'type' => 'color',
							'label' => esc_html__( 'Background color', 'themeisle-companion' ),
							'default' => 'ffffff',
							'preview' => array(
								'type' => 'css',
								'rules' => array(
									array(
										'selector' => '.obfx-service',
										'property'     => 'background',
									),
								),
							),
						),

					),
				),
			),
		),
		'icon_style' => array(
			'title' => esc_html__( 'Icon style', 'themeisle-companion' ), // Tab title
			'sections' => array(
				'font' => array(
					'title' => esc_html__( 'General', 'themeisle-companion' ),
					'fields' => array(
						'icon_position' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Position', 'themeisle-companion' ),
							'default' => 'center',
							'options' => array(
								'left' => esc_html__( 'Left', 'themeisle-companion' ),
								'center' => esc_html__( 'Center', 'themeisle-companion' ),
								'right' => esc_html__( 'Right', 'themeisle-companion' ),
							),
						),
						'icon_size' => array(
							'type'        => 'text',
							'label' => esc_html__( 'Size', 'themeisle-companion' ),
							'description' => esc_html__( 'px', 'themeisle-companion' ),
							'default' => '45',
							'maxlength'     => '3',
							'size'          => '4',
							'preview' => array(
								'type' => 'css',
								'rules' => array(
									array(
										'selector' => '.obfx-service-icon',
										'property'     => 'font-size',
										'unit' => 'px',
									),
								),
							),
						),
					),
				),
				'icon_padding' => themeisle_four_fields_control(
					array(
						'default' => array(
							'top' => 30,
							'bottom' => 15,
							'left' => 25,
							'right' => 25,
						),
						'selector' => '.obfx-service-icon',
						'field_name_prefix' => 'icon_',
					)
				),
			),
		),
		'title_style' => array(
			'title' => esc_html__( 'Title style', 'themeisle-companion' ),
			'sections' => array(
				'general' => array(
					'title' => esc_html__( 'General', 'themeisle-companion' ),
					'fields' => array(
						'title_color' => array(
							'type' => 'color',
							'label' => esc_html__( 'Color', 'themeisle-companion' ),
							'preview' => array(
								'type' => 'css',
								'rules' => array(
									array(
										'selector' => '.obfx-service-title',
										'property'     => 'color',
									),
								),
							),
						),
					),
				),
				'typography' => themeisle_typography_settings(
					array(
						'prefix' => 'title_',
						'selector' => '.obfx-service-title',
					)
				),
			),
		),
		'content_style' => array(
			'title' => esc_html__( 'Content style', 'themeisle-companion' ),
			'sections' => array(
				'general' => array(
					'title' => esc_html__( 'General', 'themeisle-companion' ),
					'fields' => array(
						'content_alignment' => array(
							'type'    => 'select',
							'label'   => esc_html__( 'Alignment', 'themeisle-companion' ),
							'default' => 'center',
							'options' => array(
								'left' => esc_html__( 'Left', 'themeisle-companion' ),
								'center' => esc_html__( 'Center', 'themeisle-companion' ),
								'right' => esc_html__( 'Right', 'themeisle-companion' ),
							),
						),
						'content_color' => array(
							'type' => 'color',
							'label' => esc_html__( 'Color', 'themeisle-companion' ),
							'preview' => array(
								'type' => 'css',
								'rules' => array(
									array(
										'selector' => '.obfx-service-content',
										'property'     => 'color',
									),
								),
							),
						),
					),
				),
				'typography' => themeisle_typography_settings(
					array(
						'prefix' => 'content_',
						'selector' => '.obfx-service-content',
					)
				),
			),
		),
	)
);

FLBuilder::register_settings_form(
	'service_content',
	array(
		'title' => __( 'Service', 'themeisle-companion' ),
		'tabs'  => array(
			'general'      => array(
				'title'         => esc_html__( 'General', 'themeisle-companion' ),
				'sections'      => array(
					'general'       => array(
						'title'         => '',
						'fields'        => array(
							'title' => array(
								'type'  => 'text',
								'label' => esc_html__( 'Title', 'themeisle-companion' ),
							),
							'text' => array(
								'type'          => 'textarea',
								'label'         => esc_html__( 'Text', 'themeisle-companion' ),
								'rows'          => '6',
							),
							'icon' => array(
								'type'          => 'icon',
								'label'         => esc_html__( 'Icon', 'themeisle-companion' ),
								'show_remove'   => true,
							),
							'icon_color' => array(
								'type'          => 'color',
								'label'         => esc_html__( 'Icon color', 'themeisle-companion' ),
								'default' => 'd6d6d6',
							),
							'link' => array(
								'type'          => 'link',
								'label'         => esc_html__( 'Link to', 'themeisle-companion' ),
							),
						),
					),
				),
			),
		),
	)
);
