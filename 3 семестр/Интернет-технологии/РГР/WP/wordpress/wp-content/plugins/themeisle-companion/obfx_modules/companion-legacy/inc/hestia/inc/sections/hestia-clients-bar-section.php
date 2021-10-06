<?php
/**
 * Clients bar section for the homepage.
 *
 * @package Hestia
 * @since Hestia 1.1.47
 */

if ( ! function_exists( 'hestia_clients_bar' ) ) :

	/**
	 * Clients bar section content.
	 * This function can be called from a shortcode too.
	 * When it's called as shortcode, the title and the subtitle shouldn't appear and it should be visible all the time,
	 * it shouldn't matter if is disable on front page.
	 *
	 * @since Hestia 1.1.47
	 * @modified 1.1.51
	 */
	function hestia_clients_bar( $is_shortcode = false ) {

		/**
		 * Gather data to display the section.
		 */
		$hide_section                       = get_theme_mod( 'hestia_clients_bar_hide', true );
		$hestia_clients_bar_content         = get_theme_mod( 'hestia_clients_bar_content', apply_filters( 'hestia_clients_bar_default_content', false ) );
		$hestia_clients_bar_content_decoded = json_decode( $hestia_clients_bar_content );

		/**
		 * Don't show section if Disable section is checked or it doesn't have any content.
		 * Show it if it's called as a shortcode.
		 */
		$section_style = '';
		if ( $is_shortcode === false && ( empty( $hestia_clients_bar_content ) || (bool) $hide_section === true ) || empty( $hestia_clients_bar_content_decoded ) ) {
			if ( is_customize_preview() ) {
				$section_style = 'style="display: none"';
			} else {
				return;
			}
		}

		/**
		 * In case this function is called as shortcode, we add 'is-shortcode' class.
		 */
		$wrapper_class = $is_shortcode === true ? 'is-shortcode' : '';

		hestia_before_clients_bar_section_trigger(); ?>
        <section class="hestia-clients-bar text-center <?php echo esc_attr( $wrapper_class ); ?>" id="clients" data-sorder="hestia_clients_bar" <?php echo wp_kses_post( $section_style ); ?>>
			<?php
			if ( $is_shortcode === false && function_exists('hestia_display_customizer_shortcut') ) {
				hestia_display_customizer_shortcut( 'hestia_clients_bar_hide', true );
			}
			?>
            <div class="container">
				<?php
				if ( function_exists( 'hestia_clients_bar_section_content_trigger' ) ) {
					hestia_clients_bar_section_content_trigger();
				}
				?>
                <ul class="clients-bar-wrapper" <?php echo hestia_add_animationation( 'fade-up' ); ?>>
					<?php
					if ( ! empty( $hestia_clients_bar_content_decoded ) ) {
						foreach ( $hestia_clients_bar_content_decoded as $client ) {
							$image = ! empty( $client->image_url ) ? apply_filters( 'hestia_translate_single_string', $client->image_url, 'Clients bar section' ) : '';
							$link  = ! empty( $client->link ) ? apply_filters( 'hestia_translate_single_string', $client->link, 'Clients bar section' ) : '';

							$image_id = function_exists( 'attachment_url_to_postid' ) ? attachment_url_to_postid( preg_replace( '/-\d{1,4}x\d{1,4}/i', '', $image ) ) : '';
							$alt_text = '';
							if ( ! empty( $image_id ) ) {
								$alt_text = 'alt="' . get_post_meta( $image_id, '_wp_attachment_image_alt', true ) . '"';
							}

							if ( ! empty( $image ) ) {
								echo '<li class="clients-bar-item">';
								if ( ! empty( $link ) ) {
									$link_html = '<a href="' . esc_url( $link ) . '"';
									if ( function_exists( 'hestia_is_external_url' ) ) {
										$link_html .= hestia_is_external_url( $link );
									}
									$link_html .= '>';
									echo wp_kses_post( $link_html );
								}
								echo '<img src="' . esc_url( $image ) . '" ' . wp_kses_post( $alt_text ) . '>';
								if ( ! empty( $link ) ) {
									echo '</a>';
								}
								echo '</li>';
							}
						}
					}
					?>
                </ul>
            </div>
        </section>
		<?php

		hestia_after_clients_bar_section_trigger();
	}

endif;
if ( function_exists( 'hestia_clients_bar' ) ) {
	$section_priority = apply_filters( 'hestia_section_priority', 50, 'hestia_clients_bar' );
	add_action( 'hestia_sections', 'hestia_clients_bar', absint( $section_priority ) );
	if ( function_exists( 'hestia_features_register_strings' ) ) {
		add_action( 'after_setup_theme', 'hestia_features_register_strings', 11 );
	}
}
