<?php

// Default Settings
$default_posts_per_page = get_option( 'posts_per_page' );
$defaults = array(
	'data_source' => 'custom_query',
	'post_type'   => 'post',
	'order_by'    => 'date',
	'order'       => 'DESC',
	'offset'      => 0,
	'users'       => '',
	'posts_per_page' => $default_posts_per_page,
);

$tab_defaults = isset( $tab['defaults'] ) ? $tab['defaults'] : array();
$settings     = (object) array_merge( $defaults, $tab_defaults, (array) $settings );
$settings     = apply_filters( 'fl_builder_loop_settings', $settings );  // Allow extension of default Values

do_action( 'fl_builder_loop_settings_before_form', $settings ); // e.g Add custom FLBuilder::render_settings_field()

?>
<div class="fl-custom-query fl-loop-data-source" data-source="custom_query">
	<div id="fl-builder-settings-section-general" class="fl-builder-settings-section">
		<h3 class="fl-builder-settings-title"><?php _e( 'Custom Query', 'themeisle-companion' ); ?></h3>
		<table class="fl-form-table">
			<?php

			// Post type
			FLBuilder::render_settings_field(
				'post_type',
				array(
					'type'          => 'post-type',
					'label'         => esc_html__( 'Post Type', 'themeisle-companion' ),
				),
				$settings
			);

			// Order
			FLBuilder::render_settings_field(
				'order',
				array(
					'type'          => 'select',
					'label'         => esc_html__( 'Order', 'themeisle-companion' ),
					'options'       => array(
						'DESC'          => esc_html__( 'Descending', 'themeisle-companion' ),
						'ASC'           => esc_html__( 'Ascending', 'themeisle-companion' ),
					),
				),
				$settings
			);

			// Order by
			FLBuilder::render_settings_field(
				'order_by',
				array(
					'type'          => 'select',
					'label'         => esc_html__( 'Order By', 'themeisle-companion' ),
					'options'       => array(
						'author'         => esc_html__( 'Author', 'themeisle-companion' ),
						'comment_count'  => esc_html__( 'Comment Count', 'themeisle-companion' ),
						'date'           => esc_html__( 'Date', 'themeisle-companion' ),
						'modified'       => esc_html__( 'Date Last Modified', 'themeisle-companion' ),
						'ID'             => esc_html__( 'ID', 'themeisle-companion' ),
						'menu_order'     => esc_html__( 'Menu Order', 'themeisle-companion' ),
						'meta_value'     => esc_html__( 'Meta Value (Alphabetical)', 'themeisle-companion' ),
						'meta_value_num' => esc_html__( 'Meta Value (Numeric)', 'themeisle-companion' ),
						'rand'           => esc_html__( 'Random', 'themeisle-companion' ),
						'title'          => esc_html__( 'Title', 'themeisle-companion' ),
					),
					'toggle'        => array(
						'meta_value'    => array(
							'fields'        => array( 'order_by_meta_key' ),
						),
						'meta_value_num' => array(
							'fields'        => array( 'order_by_meta_key' ),
						),
					),
				),
				$settings
			);

			// Meta Key
			FLBuilder::render_settings_field(
				'order_by_meta_key',
				array(
					'type'          => 'text',
					'label'         => esc_html__( 'Meta Key', 'themeisle-companion' ),
				),
				$settings
			);

			// Offset
			FLBuilder::render_settings_field(
				'offset',
				array(
					'type'          => 'text',
					'label'         => _x( 'Offset', 'How many posts to skip.', 'themeisle-companion' ),
					'default'       => '0',
					'size'          => '4',
					'help'          => esc_html__( 'Skip this many posts that match the specified criteria.', 'themeisle-companion' ),
				),
				$settings
			);

			// Posts per page
			FLBuilder::render_settings_field(
				'posts_per_page',
				array(
					'type'          => 'obfx_number',
					'label'         => esc_html__( 'Posts per page', 'themeisle-companion' ),
					'default'       => $default_posts_per_page,
					'min'       => '-1',
					'help'          => esc_html__( '-1 means all posts', 'themeisle-companion' ),
				),
				$settings
			);

			// Columns
			FLBuilder::render_settings_field(
				'columns',
				array(
					'type'          => 'obfx_number',
					'label'         => esc_html__( 'Number of columns', 'themeisle-companion' ),
					'default'       => '3',
					'min'       => '1',
					'max'          => '5',
				),
				$settings
			);
			?>
		</table>
	</div>
	<div id="fl-builder-settings-section-filter" class="fl-builder-settings-section">
		<h3 class="fl-builder-settings-title"><?php _e( 'Filter', 'themeisle-companion' ); ?></h3>
		<?php foreach ( FLBuilderLoop::post_types() as $slug => $type ) : ?>
			<table class="fl-form-table fl-custom-query-filter fl-custom-query-<?php echo $slug; ?>-filter" 
																							<?php
																							if ( $slug === $settings->post_type ) {
																								echo 'style="display:table;"';}
																							?>
>
				<?php

				// Posts
				FLBuilder::render_settings_field(
					'posts_' . $slug,
					array(
						'type'          => 'suggest',
						'action'        => 'fl_as_posts',
						'data'          => $slug,
						'label'         => $type->label,
						'help'          => sprintf( esc_html__( 'Enter a list of %1$s.', 'themeisle-companion' ), $type->label ),
						'matching'      => true,
					),
					$settings
				);

				// Taxonomies
				$taxonomies = FLBuilderLoop::taxonomies( $slug );

				foreach ( $taxonomies as $tax_slug => $tax ) {

					FLBuilder::render_settings_field(
						'tax_' . $slug . '_' . $tax_slug,
						array(
							'type'          => 'suggest',
							'action'        => 'fl_as_terms',
							'data'          => $tax_slug,
							'label'         => $tax->label,
							'help'          => sprintf( esc_html__( 'Enter a list of %1$s.', 'themeisle-companion' ), $tax->label ),
							'matching'      => true,
						),
						$settings
					);
				}

				?>
			</table>
		<?php endforeach; ?>
		<table class="fl-form-table">
			<?php

			// Author
			FLBuilder::render_settings_field(
				'users',
				array(
					'type'          => 'suggest',
					'action'        => 'fl_as_users',
					'label'         => esc_html__( 'Authors', 'themeisle-companion' ),
					'help'          => esc_html__( 'Enter a list of authors usernames.', 'themeisle-companion' ),
					'matching'      => true,
				),
				$settings
			);

			?>
		</table>
	</div>
	<div id="fl-builder-settings-section-filter" class="fl-builder-settings-section">
		<h3 class="fl-builder-settings-title"><?php _e( 'Appearance', 'themeisle-companion' ); ?></h3>
		<table class="fl-form-table">

		<?php
		// Vertical align
		FLBuilder::render_settings_field(
			'card_vertical_align',
			array(
				'type'          => 'select',
				'label'         => esc_html__( 'Vertical align', 'themeisle-companion' ),
				'default' => 'grid',
				'options'       => array(
					'top'         => esc_html__( 'Top', 'themeisle-companion' ),
					'middle'  => esc_html__( 'Middle', 'themeisle-companion' ),
					'bottom'  => esc_html__( 'Bottom', 'themeisle-companion' ),
				),
			),
			$settings
		);

		// Display type
		FLBuilder::render_settings_field(
			'display_type',
			array(
				'type'          => 'select',
				'label'         => esc_html__( 'Display type', 'themeisle-companion' ),
				'default' => 'grid',
				'options'       => array(
					'grid'         => esc_html__( 'Grid', 'themeisle-companion' ),
					'list'  => esc_html__( 'List', 'themeisle-companion' ),
				),
			),
			$settings
		);

		// Card layout
		FLBuilder::render_settings_field(
			'card_layout',
			array(
				'type'          => 'obfx_toggle',
				'label'         => esc_html__( 'Card layout', 'themeisle-companion' ),
			),
			$settings
		);

		// Padding top
		FLBuilder::render_settings_field(
			'card_margin_top',
			array(
				'type'          => 'obfx_number',
				'label'         => esc_html__( 'Margin top', 'themeisle-companion' ),
				'default'       => '0',
				'min'       => '0',
			),
			$settings
		);

		// Padding bottom
		FLBuilder::render_settings_field(
			'card_margin_bottom',
			array(
				'type'          => 'obfx_number',
				'label'         => esc_html__( 'Margin bottom', 'themeisle-companion' ),
				'default'       => '30',
				'min'       => '0',
			),
			$settings
		);

		// Background color
		FLBuilder::render_settings_field(
			'post_bg_color',
			array(
				'type'          => 'color',
				'label'         => __( 'Background color', 'themeisle-companion' ),
				'show_reset'    => true,
				'show_alpha'    => true,
				'preview'      => array(
					'type'         => 'css',
					'selector'     => '.obfx-post-grid',
					'property'     => 'background-color',
				),

			),
			$settings
		);

		// Link color
		FLBuilder::render_settings_field(
			'post_link_color',
			array(
				'type'          => 'color',
				'label'         => __( 'Link color', 'themeisle-companion' ),
				'show_reset'    => true,
				'preview'      => array(
					'type'         => 'css',
					'selector'     => '.obfx-post-grid a, .obfx-post-grid-pagination a',
					'property'     => 'color',
				),
			),
			$settings
		);

		// Link color
		FLBuilder::render_settings_field(
			'post_text_color',
			array(
				'type'          => 'color',
				'label'         => __( 'Text color', 'themeisle-companion' ),
				'show_reset'    => true,
				'preview'      => array(
					'type'         => 'css',
					'selector'     => '.obfx-post-grid, .obfx-post-grid-pagination',
					'property'     => 'color',
				),
			),
			$settings
		);
		?>
		</table>
	</div>
</div>
<?php
do_action( 'fl_builder_loop_settings_after_form', $settings ); // e.g Add custom FLBuilder::render_settings_field()
