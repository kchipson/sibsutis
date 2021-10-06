<?php

// Get the module directory.
$module_directory = $this->get_dir();

// Include custom fields
require_once( $module_directory . '/custom-fields/toggle-field/toggle_field.php' );

// Include common functions file.
require_once( $module_directory . '/inc/common-functions.php' );

/**
 * Class PostGridModule
 */
class PostGridModule extends FLBuilderModule {

	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir and url in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'          => esc_html__( 'Post Grid', 'themeisle-companion' ),
				'description'   => esc_html__( 'A method to display your posts.', 'themeisle-companion' ),
				'category'      => esc_html__( 'Orbit Fox Modules', 'themeisle-companion' ),
				'dir'           => BEAVER_WIDGETS_PATH . 'modules/post-grid/',
				'url'           => BEAVER_WIDGETS_URL . 'modules/post-grid/',
			)
		);
	}
}

/**
 * Register the module and its form settings.
 */
$image_sizes = get_intermediate_image_sizes();
$choices = array();
if ( ! empty( $image_sizes ) ) {
	foreach ( $image_sizes as $size ) {
		$name = str_replace( '_', ' ', $size );
		$name = str_replace( '-', ' ', $name );
		$choices[ $size ] = ucfirst( $name );
	}
}
FLBuilder::register_module(
	'PostGridModule',
	array(
		'loop_settings' => array(
			'title'         => esc_html__( 'Loop Settings', 'themeisle-companion' ),
			'file'          => BEAVER_WIDGETS_PATH . 'modules/post-grid/includes/loop-settings.php',
		),
		'image_options' => array(
			'title' => esc_html__( 'Image options', 'themeisle-companion' ), // Tab title
			'sections' => array(
				'general' => array(
					'title' => '',
					'fields' => array(
						'show_post_thumbnail' => array(
							'type'          => 'obfx_toggle',
							'label'         => esc_html__( 'Show post thumbnail', 'themeisle-companion' ),
							'default' => 'yes',
						),
						'show_thumbnail_link' => array(
							'type'          => 'obfx_toggle',
							'label'         => esc_html__( 'Link in thumbnail', 'themeisle-companion' ),
							'default' => 'no',
						),
						'thumbnail_shadow' => array(
							'type'          => 'obfx_toggle',
							'label'         => esc_html__( 'Enable thumbnail shadow', 'themeisle-companion' ),
							'default' => 'no',
						),
						'image_size' => array(
							'type'          => 'select',
							'label'         => esc_html__( 'Image size', 'themeisle-companion' ),
							'default' => 'medium_large',
							'options'       => $choices,

						),
						'image_alignment' => array(
							'type'          => 'select',
							'label'         => esc_html__( 'Image alignment', 'themeisle-companion' ),
							'default' => 'center',
							'options'       => array(
								'center' => esc_html__( 'Center', 'themeisle-companion' ),
								'left' => esc_html__( 'Left', 'themeisle-companion' ),
								'right' => esc_html__( 'Right', 'themeisle-companion' ),
							),
							'toggle'        => array(
								'left'  => array(
									'fields'        => array('thumbnail_margin_left', 'thumbnail_margin_right'),
								),
								'right'  => array(
									'fields'        => array('thumbnail_margin_left', 'thumbnail_margin_right'),
								),
							),
						),
					),
				),
				'thumbnail_margins' => themeisle_four_fields_control(
					array(
						'default' => array(
							'top' => 0,
							'bottom' => 30,
							'left' => 0,
							'right' => 0,
						),
						'selector' => '.obfx-post-grid-thumbnail',
						'field_name_prefix' => 'thumbnail_margin_',
						'type' => 'margin',
					)
				),
			),
		),
		'title_options' => array(
			'title' => esc_html__( 'Title options', 'themeisle-companion' ), // Tab title
			'sections' => array(
				'general' => array(
					'title' => '',
					'fields' => array(
						'show_post_title' => array(
							'type'          => 'obfx_toggle',
							'label'         => esc_html__( 'Show post title', 'themeisle-companion' ),
							'default' => 'yes',
						),
						'show_title_link'  => array(
							'type'          => 'obfx_toggle',
							'label'         => esc_html__( 'Link on title', 'themeisle-companion' ),
							'default' => 'yes',
						),
						'title_alignment' => array(
							'type'          => 'select',
							'label'         => esc_html__( 'Title alignment', 'themeisle-companion' ),
							'default' => 'center',
							'options'       => array(
								'center' => esc_html__( 'Center', 'themeisle-companion' ),
								'left' => esc_html__( 'Left', 'themeisle-companion' ),
								'right' => esc_html__( 'Right', 'themeisle-companion' ),
							),

						),
						'title_tag' => array(
							'type'          => 'select',
							'label'         => esc_html__( 'Title tag', 'themeisle-companion' ),
							'default' => 'h5',
							'options'       => array(
								'h1' => esc_html__( 'H1', 'themeisle-companion' ),
								'h2' => esc_html__( 'H2', 'themeisle-companion' ),
								'h3' => esc_html__( 'H3', 'themeisle-companion' ),
								'h4' => esc_html__( 'H4', 'themeisle-companion' ),
								'h5' => esc_html__( 'H5', 'themeisle-companion' ),
								'h6' => esc_html__( 'H6', 'themeisle-companion' ),
								'span' => esc_html__( 'span', 'themeisle-companion' ),
								'p' => esc_html__( 'p', 'themeisle-companion' ),
								'div' => esc_html__( 'div', 'themeisle-companion' ),
							),
						),
					),
				),
				'title_margins' => themeisle_four_fields_control(
					array(
						'default' => array(
							'top' => 0,
							'bottom' => 0,
							'left' => 0,
							'right' => 0,
						),
						'selector' => '.obfx-post-grid-title',
						'field_name_prefix' => 'title_padding_',
						'type' => 'padding',
					)
				),
				'title_typography' => themeisle_typography_settings(
					array(
						'prefix' => 'title_',
						'selector' => '.obfx-post-grid-title',
						'font_size_default' => 25,
					)
				),
			),
		),
		'meta_options' => array(
			'title' => esc_html__( 'Meta options', 'themeisle-companion' ), // Tab title
			'sections' => array(
				'general' => array(
					'title' => '',
					'fields' => array(
						'show_post_meta' => array(
							'type'          => 'obfx_toggle',
							'label'         => esc_html__( 'Show post meta', 'themeisle-companion' ),
							'default' => 'yes',
						),
						'show_icons' => array(
							'type'          => 'obfx_toggle',
							'label'         => esc_html__( 'Show icons', 'themeisle-companion' ),
							'default' => 'yes',
							'help'          => esc_html__( 'If icons doesn\'t show you have to enqueue FontAwesome in your theme.', 'themeisle-companion' ),
						),
						'meta_data' => array(
							'type'          => 'select',
							'label'         => esc_html__( 'Display', 'themeisle-companion' ),
							'default'       => array('author', 'date'),
							'options'       => array(
								'author'      => esc_html__( 'Author', 'themeisle-companion' ),
								'date'      => esc_html__( 'Date', 'themeisle-companion' ),
								'category'      => esc_html__( 'Category', 'themeisle-companion' ),
								'tags'      => esc_html__( 'Tags', 'themeisle-companion' ),
								'comments'      => esc_html__( 'Comments', 'themeisle-companion' ),
							),
							'multi-select'  => true,
						),
						'meta_alignment' => array(
							'type'          => 'select',
							'label'         => esc_html__( 'Meta alignment', 'themeisle-companion' ),
							'default' => 'center',
							'options'       => array(
								'center' => esc_html__( 'Center', 'themeisle-companion' ),
								'left' => esc_html__( 'Left', 'themeisle-companion' ),
								'right' => esc_html__( 'Right', 'themeisle-companion' ),
							),
						),
					),
				),
				'meta_margins' => themeisle_four_fields_control(
					array(
						'default' => array(
							'top' => 0,
							'bottom' => 0,
							'left' => 0,
							'right' => 0,
						),
						'selector' => '.obfx-post-grid-meta',
						'field_name_prefix' => 'meta_padding_',
						'type' => 'padding',
					)
				),
				'meta_typography' => themeisle_typography_settings(
					array(
						'prefix' => 'meta_',
						'selector' => '.obfx-post-grid-meta',
						'font_size_default' => 15,
					)
				),
			),
		),
		'content_options' => array(
			'title' => esc_html__( 'Content options', 'themeisle-companion' ), // Tab title
			'sections' => array(
				'general' => array(
					'title' => '',
					'fields' => array(
						'show_post_content' => array(
							'type'          => 'obfx_toggle',
							'label'         => esc_html__( 'Show post content', 'themeisle-companion' ),
							'default' => 'yes',
						),
						'show_read_more' => array(
							'type'          => 'obfx_toggle',
							'label'         => esc_html__( 'Show read more', 'themeisle-companion' ),
							'default' => 'yes',
						),
						'content_length' => array(
							'type'          => 'obfx_number',
							'label'         => esc_html__( 'Number of words', 'themeisle-companion' ),
							'default'       => '30',
							'min'       => '1',
						),
						'read_more_text' => array(
							'type'          => 'text',
							'label'         => esc_html__( 'Read more text', 'themeisle-companion' ),
							'default'       => esc_html__( 'Read more', 'themeisle-companion' ),
							'maxlength'     => '70',
							'size'          => '30',
							'preview'       => array(
								'type'          => 'text',
								'selector'      => '.obfx-post-grid-read-more',
							),
						),
						'content_alignment' => array(
							'type'          => 'select',
							'label'         => esc_html__( 'Text alignment', 'themeisle-companion' ),
							'default' => 'left',
							'options'       => array(
								'center' => esc_html__( 'Center', 'themeisle-companion' ),
								'left' => esc_html__( 'Left', 'themeisle-companion' ),
								'right' => esc_html__( 'Right', 'themeisle-companion' ),
							),

						),
					),
				),
				'content_margins' => themeisle_four_fields_control(
					array(
						'default' => array(
							'top' => 0,
							'bottom' => 0,
							'left' => 15,
							'right' => 15,
						),
						'selector' => '.obfx-post-content',
						'field_name_prefix' => 'content_padding_',
						'type' => 'padding',
					)
				),
				'content_typography' => themeisle_typography_settings(
					array(
						'prefix' => 'content_',
						'selector' => '.obfx-post-content',
						'font_size_default' => 20,
					)
				),
			),
		),
		'pagination_options' => array(
			'title' => esc_html__( 'Pagination options', 'themeisle-companion' ),
			'sections' => array(
				'general' => array(
					'title' => '',
					'fields' => array(
						'show_pagination' => array(
							'type'          => 'obfx_toggle',
							'label'         => esc_html__( 'Enable pagination', 'themeisle-companion' ),
						),
						'pagination_alignment' => array(
							'type'          => 'select',
							'label'         => esc_html__( 'Pagination alignment', 'themeisle-companion' ),
							'default' => 'center',
							'options'       => array(
								'center' => esc_html__( 'Center', 'themeisle-companion' ),
								'left' => esc_html__( 'Left', 'themeisle-companion' ),
								'right' => esc_html__( 'Right', 'themeisle-companion' ),
							),
						),
					),
				),
				'pagination_typography' => themeisle_typography_settings(
					array(
						'prefix' => 'pagination_',
						'selector' => '.obfx-post-grid-pagination',
						'font_size_default' => 20,
					)
				),
			),
		),
	)
);
