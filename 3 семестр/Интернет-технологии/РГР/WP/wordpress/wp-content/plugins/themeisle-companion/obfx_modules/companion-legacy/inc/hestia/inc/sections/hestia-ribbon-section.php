<?php
/**
 * Ribbon section for the homepage.
 *
 * @package Hestia
 * @since Hestia 1.1.47
 */

if ( ! function_exists( 'hestia_ribbon' ) ) :

	/**
	 * Ribbon section content.
	 * This function can be called from a shortcode too.
	 * When it's called as shortcode, the title and the subtitle shouldn't appear and it should be visible all the time,
	 * it shouldn't matter if is disable on front page.
	 *
	 * @since 1.1.47
	 * @modified 1.1.51
	 */
	function hestia_ribbon( $is_shortcode = false ) {

		/**
		 * Don't show section if Disable section is checked or it doesn't have any content.
		 * Show it if it's called as a shortcode.
		 */
		$hestia_ribbon_hide = get_theme_mod( 'hestia_ribbon_hide', true );
		$section_style      = '';
		if ( $is_shortcode === false && (bool) $hestia_ribbon_hide === true ) {
			if ( is_customize_preview() ) {
				$section_style .= 'display: none;';
			} else {
				return;
			}
		}

		/**
		 * Gather data to display the section.
		 */
		$default            = ( current_user_can( 'edit_theme_options' ) ? esc_html__( 'Subscribe to our Newsletter', 'themeisle-companion' ) : false );
		$hestia_ribbon_text = get_theme_mod( 'hestia_ribbon_text', $default );

		$default                   = ( current_user_can( 'edit_theme_options' ) ? esc_html__( 'Subscribe', 'themeisle-companion' ) : false );
		$hestia_ribbon_button_text = get_theme_mod( 'hestia_ribbon_button_text', $default );

		$default                  = ( current_user_can( 'edit_theme_options' ) ? '#' : false );
		$hestia_ribbon_button_url = get_theme_mod( 'hestia_ribbon_button_url', $default );

		$default                  = ( current_user_can( 'edit_theme_options' ) ? get_template_directory_uri() . '/assets/img/contact.jpg' : false );
		$hestia_ribbon_background = get_theme_mod( 'hestia_ribbon_background', $default );
		if ( ! empty( $hestia_ribbon_background ) ) {
			$section_style .= 'background-image: url( ' . esc_url( $hestia_ribbon_background ) . ');';
		}
		$section_style = 'style="' . esc_attr( $section_style ) . '"';

		/**
		 * In case this function is called as shortcode, we remove the container and we add 'is-shortcode' class.
		 */
		$class_to_add  = $is_shortcode === true ? 'is-shortcode ' : '';
		$class_to_add .= ! empty( $hestia_ribbon_background ) ? 'section-image' : '';

		hestia_before_ribbon_section_trigger(); ?>
        <section class="hestia-ribbon section <?php echo esc_attr( $class_to_add ); ?>" id="ribbon" data-sorder="hestia_ribbon" <?php echo wp_kses_post( $section_style ); ?>>
			<?php
			if ( function_exists('hestia_display_customizer_shortcut') && $is_shortcode === false ) {
				hestia_display_customizer_shortcut( 'hestia_ribbon_hide', true );
			}
			?>
            <div class="container">
                <div class="row hestia-xs-text-center hestia-like-table hestia-ribbon-content">
					<?php
                    if( function_exists('hestia_display_customizer_shortcut') ) {
	                    hestia_display_customizer_shortcut( 'hestia_ribbon_text' );
                    } ?>
                    <div class="col-md-8 hestia-ribbon-content-left" <?php echo hestia_add_animationation( 'fade-right' ); ?>>
						<?php
						if ( ! empty( $hestia_ribbon_text ) || is_customize_preview() ) {
							?>
                            <h2 class="hestia-title" style="margin:0;">
								<?php echo hestia_sanitize_string( $hestia_ribbon_text ); ?>
                            </h2>
							<?php
						}
						?>
                    </div>
                    <div class="col-md-4 text-center hestia-ribbon-content-right" <?php echo hestia_add_animationation( 'fade-left' ); ?>>
						<?php

						if ( ( ! empty( $hestia_ribbon_button_text ) && ! empty( $hestia_ribbon_button_url ) ) || is_customize_preview() ) {

							$link_html = '<a href="' . esc_url( $hestia_ribbon_button_url ) . '"';
							if ( function_exists( 'hestia_is_external_url' ) ) {
								$link_html .= hestia_is_external_url( $hestia_ribbon_button_url );
							}
							$link_html .= ' class="btn btn-md btn-primary hestia-subscribe-button">';
							$link_html .= wp_kses_post( $hestia_ribbon_button_text );
							$link_html .= '</a>';
							echo wp_kses_post( $link_html );
						}
						?>
                    </div>
                </div>
            </div>
        </section>
		<?php
		hestia_after_ribbon_section_trigger();
	}
endif;

if ( function_exists( 'hestia_ribbon' ) ) {
	$section_priority = apply_filters( 'hestia_section_priority', 40, 'hestia_ribbon' );
	add_action( 'hestia_sections', 'hestia_ribbon', absint( $section_priority ) );
}
