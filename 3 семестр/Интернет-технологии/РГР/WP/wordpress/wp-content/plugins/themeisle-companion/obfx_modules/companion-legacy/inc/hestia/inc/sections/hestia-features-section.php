<?php
/**
 * Services section for the homepage.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

if ( ! function_exists( 'hestia_features' ) ) :

	/**
	 * Features section content.
	 * This function can be called from a shortcode too.
	 * When it's called as shortcode, the title and the subtitle shouldn't appear and it should be visible all the time,
	 * it shouldn't matter if is disable on front page.
	 *
	 * @since Hestia 1.0
	 * @modified 1.1.51
	 */
	function hestia_features( $is_shortcode = false ) {

		// When this function is called from selective refresh, $is_shortcode gets the value of WP_Customize_Selective_Refresh object. We don't need that.
		if ( ! is_bool( $is_shortcode ) ) {
			$is_shortcode = false;
		}

		$hide_section = get_theme_mod( 'hestia_features_hide', false );
		$default_title = current_user_can( 'edit_theme_options' ) ? esc_html__( 'Why our product is the best', 'themeisle-companion' ) : false;
		$default_subtitle = current_user_can( 'edit_theme_options' ) ? esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'themeisle-companion' ) : false;
		$default_content = current_user_can( 'edit_theme_options' ) ? hestia_get_features_default() : false;
		$hestia_features_title    = get_theme_mod( 'hestia_features_title', $default_title );
		$hestia_features_subtitle = get_theme_mod( 'hestia_features_subtitle', $default_subtitle );
		$hestia_features_content  = get_theme_mod( 'hestia_features_content', $default_content );
		$section_is_empty = empty( $hestia_features_content ) && empty( $hestia_features_subtitle ) && empty( $hestia_features_title );

		/* Don't show section if Disable section is checked or it doesn't have any content. Show it if it's called as a shortcode */
		if ( $is_shortcode === false && ( $section_is_empty || (bool) $hide_section === true ) ) {
			if ( is_customize_preview() ) {
				echo '<section class="hestia-features" id="features" data-sorder="hestia_features" style="display: none"></section>';
			}
			return;
		}

		$wrapper_class = $is_shortcode === true ? 'is-shortcode' : '';
		$container_class = $is_shortcode === true ? '' : 'container';

		hestia_before_features_section_trigger();
		?>
		<section class="hestia-features <?php echo esc_attr( $wrapper_class ); ?>" id="features" data-sorder="hestia_features">
			<?php
            hestia_before_features_section_content_trigger();
			if ( $is_shortcode === false && function_exists('hestia_display_customizer_shortcut') ) {
				hestia_display_customizer_shortcut( 'hestia_features_hide', true );
			}
			?>
			<div class="<?php echo esc_attr( $container_class ); ?>">
				<?php
				hestia_top_features_section_content_trigger();
				if ( $is_shortcode === false ) {
				?>
					<div class="row">
						<div class="col-md-8 col-md-offset-2 hestia-features-title-area">
							<?php
							if ( function_exists('hestia_display_customizer_shortcut') && ! empty( $hestia_features_title ) && ! empty( $hestia_features_subtitle ) ) {
								hestia_display_customizer_shortcut( 'hestia_features_title' );
							}
							if ( ! empty( $hestia_features_title ) || is_customize_preview() ) {
								echo '<h2 class="hestia-title">' . wp_kses_post( $hestia_features_title ) . '</h2>';
							}
							if ( ! empty( $hestia_features_subtitle ) || is_customize_preview() ) {
								echo '<h5 class="description">' . wp_kses_post( $hestia_features_subtitle ) . '</h5>';
							}
							?>
						</div>
					</div>
					<?php
				}
				hestia_features_content( $hestia_features_content );
				?>
				<?php hestia_bottom_features_section_content_trigger(); ?>
			</div>
			<?php hestia_after_features_section_content_trigger(); ?>
		</section>
		<?php
		hestia_after_features_section_trigger();
	}

endif;

/**
 * Get content for features section.
 *
 * @since 1.1.31
 * @access public
 * @param string $hestia_features_content Section content in json format.
 * @param bool   $is_callback Flag to check if it's callback or not.
 */
function hestia_features_content( $hestia_features_content, $is_callback = false ) {
	if ( ! $is_callback ) {
	?>
		<div class="hestia-features-content">
		<?php
	}
	if ( ! empty( $hestia_features_content ) ) :

		$hestia_features_content = json_decode( $hestia_features_content );
		if ( ! empty( $hestia_features_content ) ) {
			echo '<div class="row">';
			foreach ( $hestia_features_content as $features_item ) :
				$icon = ! empty( $features_item->icon_value ) ? apply_filters( 'hestia_translate_single_string', $features_item->icon_value, 'Features section' ) : '';
				$image = ! empty( $features_item->image_url ) ? apply_filters( 'hestia_translate_single_string', $features_item->image_url, 'Features section' ) : '';
				$title = ! empty( $features_item->title ) ? apply_filters( 'hestia_translate_single_string', $features_item->title, 'Features section' ) : '';
				$text = ! empty( $features_item->text ) ? apply_filters( 'hestia_translate_single_string', $features_item->text, 'Features section' ) : '';
				$link = ! empty( $features_item->link ) ? apply_filters( 'hestia_translate_single_string', $features_item->link, 'Features section' ) : '';
				$color = ! empty( $features_item->color ) ? $features_item->color : '';
				$choice = ! empty( $features_item->choice ) ? $features_item->choice : 'customizer_repeater_icon';
				?>
				<div class="col-xs-12 <?php echo apply_filters( 'hestia_features_per_row_class','col-md-4' ); ?> feature-box">
					<div class="hestia-info">
						<?php
						if ( ! empty( $link ) ) {
							$link_html = '<a href="' . esc_url( $link ) . '"';
							if ( function_exists( 'hestia_is_external_url' ) ) {
								$link_html .= hestia_is_external_url( $link );
							}
							$link_html .= '>';
							echo wp_kses_post( $link_html );
						}

						switch ( $choice ) {
							case 'customizer_repeater_image':
								if ( ! empty( $image ) ) {
									?>
									<div class="card card-plain">
										<img src="<?php echo esc_url( $image ); ?>"/>
										</div>
										<?php
								}
								break;
							case 'customizer_repeater_icon':
								if ( ! empty( $icon ) ) {
									?>
									<div class="icon" <?php echo ( ! empty( $color ) ? 'style="color:' . $color . '"' : '' ); ?>>
				<i class="fa <?php echo esc_attr( $icon ); ?>"></i>
										</div>
										<?php
								}
								break;
						}
							?>
							<?php if ( ! empty( $title ) ) : ?>
								<h4 class="info-title"><?php echo esc_html( $title ); ?></h4>
							<?php endif; ?>
							<?php if ( ! empty( $link ) ) : ?>
						</a>
					<?php endif; ?>
			<?php if ( ! empty( $text ) ) : ?>
							<p><?php echo wp_kses_post( html_entity_decode( $text ) ); ?></p>
						<?php endif; ?>
					</div>
				</div>
				<?php
			endforeach;
			echo '</div>';
		}// End if().
		endif;
	if ( ! $is_callback ) {
	?>
		</div>
		<?php
	}
}

/**
 * Get default values for features section.
 *
 * @since 1.1.31
 * @access public
 */
function hestia_get_features_default() {
	return apply_filters(
		'hestia_features_default_content', json_encode(
			array(
				array(
					'icon_value' => 'fa-wechat',
					'title'      => esc_html__( 'Responsive', 'themeisle-companion' ),
					'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'themeisle-companion' ),
					'link'       => '#',
					'color'      => '#e91e63',
				),
				array(
					'icon_value' => 'fa-check',
					'title'      => esc_html__( 'Quality', 'themeisle-companion' ),
					'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'themeisle-companion' ),
					'link'       => '#',
					'color'      => '#00bcd4',
				),
				array(
					'icon_value' => 'fa-support',
					'title'      => esc_html__( 'Support', 'themeisle-companion' ),
					'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'themeisle-companion' ),
					'link'       => '#',
					'color'      => '#4caf50',
				),
			)
		)
	);
}

if ( function_exists( 'hestia_features' ) ) {
	$section_priority = apply_filters( 'hestia_section_priority', 10, 'hestia_features' );
	add_action( 'hestia_sections', 'hestia_features', absint( $section_priority ) );
	if ( function_exists( 'hestia_features_register_strings' ) ) {
		add_action( 'after_setup_theme', 'hestia_features_register_strings', 11 );
	}
}
