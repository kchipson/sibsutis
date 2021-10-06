<?php
/**
 *
 * *****    SLIDER   *******
 *
 */

$shop_isle_homepage_slider_shortcode = get_theme_mod('shop_isle_homepage_slider_shortcode');

echo '<section id="home" class="home-section home-parallax home-fade'. (empty($shop_isle_homepage_slider_shortcode) ? ' home-full-height' : ' home-slider-plugin' ) .'">';

if( !empty($shop_isle_homepage_slider_shortcode) ) {
	echo do_shortcode( $shop_isle_homepage_slider_shortcode );
} else {

	$shop_isle_slider = get_theme_mod( 'shop_isle_slider',json_encode( array( array( 'image_url' => get_template_directory_uri() . '/assets/images/slide1.jpg', 'link' => '#', 'text' => __( 'ShopIsle','themeisle-companion' ), 'subtext' => __( 'WooCommerce Theme','themeisle-companion' ), 'label' => __( 'FIND OUT MORE','themeisle-companion' ) ), array( 'image_url' => get_template_directory_uri() . '/assets/images/slide2.jpg', 'link' => '#', 'text' => __( 'ShopIsle','themeisle-companion' ), 'subtext' => __( 'Hight quality store','themeisle-companion' ), 'label' => __( 'FIND OUT MORE','themeisle-companion' ) ), array( 'image_url' => get_template_directory_uri() . '/assets/images/slide3.jpg', 'link' => '#', 'text' => __( 'ShopIsle','themeisle-companion' ), 'subtext' => __( 'Responsive Theme','themeisle-companion' ), 'label' => __( 'FIND OUT MORE','themeisle-companion' ) ) ) ) );

	if ( ! empty( $shop_isle_slider ) ) {

		$shop_isle_slider_decoded = json_decode( $shop_isle_slider );

		if ( ! empty( $shop_isle_slider_decoded ) ) {

			echo '<div class="hero-slider">';

			echo '<ul class="slides">';

			foreach ( $shop_isle_slider_decoded as $shop_isle_slide ) {

				if ( ! empty( $shop_isle_slide->image_url ) ) {

					if ( function_exists( 'icl_t' ) && ! empty( $shop_isle_slide->id ) ) {
						$shop_isle_slider_image_url = icl_t( 'Slide ' . $shop_isle_slide->id, 'Slide image', $shop_isle_slide->image_url );
						echo '<li class="bg-dark-30 bg-dark" style="background-image:url(' . esc_url( $shop_isle_slider_image_url ) . ')">';
					} else {
						echo '<li class="bg-dark-30 bg-dark" style="background-image:url(' . esc_url( $shop_isle_slide->image_url ) . ')">';
					}

					echo '<div class="hs-caption">';
					echo '<div class="caption-content">';

					if ( ! empty( $shop_isle_slide->text ) ) {
						if ( function_exists( 'icl_t' ) && ! empty( $shop_isle_slide->id ) ) {
							$shop_isle_slider_text = icl_t( 'Slide ' . $shop_isle_slide->id, 'Slide text', $shop_isle_slide->text );
							echo '<div class="hs-title-size-4 font-alt mb-30">' . $shop_isle_slider_text . '</div>';
						} else {
							echo '<div class="hs-title-size-4 font-alt mb-30">' . $shop_isle_slide->text . '</div>';
						}
					}

					if ( ! empty( $shop_isle_slide->subtext ) ) {
						if ( function_exists( 'icl_t' ) && ! empty( $shop_isle_slide->id ) ) {
							$shop_isle_slider_subtext = icl_t( 'Slide ' . $shop_isle_slide->id, 'Slide subtext', $shop_isle_slide->subtext );
							echo '<div class="hs-title-size-1 font-alt mb-40">' . $shop_isle_slider_subtext . '</div>';
						} else {
							echo '<div class="hs-title-size-1 font-alt mb-40">' . $shop_isle_slide->subtext . '</div>';
						}
					}

					if ( ! empty( $shop_isle_slide->link ) && ! empty( $shop_isle_slide->label ) ) {
						if ( function_exists( 'icl_t' ) && ! empty( $shop_isle_slide->id ) ) {
							$shop_isle_slider_link  = icl_t( 'Slide ' . $shop_isle_slide->id, 'Slide button link', $shop_isle_slide->link );
							$shop_isle_slider_label = icl_t( 'Slide ' . $shop_isle_slide->id, 'Slide button label', $shop_isle_slide->label );
							echo '<a href="' . esc_url( $shop_isle_slider_link ) . '" class="section-scroll btn btn-border-w btn-round">' . $shop_isle_slider_label . '</a>';
						} else {
							echo '<a href="' . esc_url( $shop_isle_slide->link ) . '" class="section-scroll btn btn-border-w btn-round">' . $shop_isle_slide->label . '</a>';
						}
					}
					echo '</div>';
					echo '</div>';
					echo '</li>';

				}
			}

			echo '</ul>';

			echo '</div>';

		}
	}
}

echo '</section >';



