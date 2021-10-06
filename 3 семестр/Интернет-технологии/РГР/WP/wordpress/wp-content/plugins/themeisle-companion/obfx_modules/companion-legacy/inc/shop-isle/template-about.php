<?php
/**
 * The template for displaying about us page.
 *
 * Template Name: About us page
 *
 * @package WordPress
 * @subpackage Shop Isle
 */

get_header(); ?>
	<!-- Wrapper start -->
	<div class="main">
	
		<!-- Header section start -->
		<?php
		$shop_isle_header_image = get_the_post_thumbnail_url();
		if ( empty( $shop_isle_header_image ) ) {
			$shop_isle_header_image = get_header_image();
		}
		?>
		<section class="page-header-module module bg-dark" 
		<?php
		if ( ! empty( $shop_isle_header_image ) ) {
			echo ' data-background="' . esc_url( $shop_isle_header_image ) . '"';
		}
		?>
		>
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<h1 class="module-title font-alt"><?php the_title(); ?></h1>
						<?php
						/* Header description */
						$shop_isle_shop_id = get_the_ID();
						if ( ! empty( $shop_isle_shop_id ) ) {
							$shop_isle_page_description = get_post_meta( $shop_isle_shop_id, 'shop_isle_page_description' );
							if ( ! empty( $shop_isle_page_description[0] ) ) {
								echo '<div class="module-subtitle font-serif mb-0">' . wp_kses_post( $shop_isle_page_description[0] ) . '</div>';
							}
						}
						?>
					</div>
				</div><!-- .row -->
			</div><!-- .container -->
		</section><!-- .page-header-module -->
		<!-- Header section end -->
				
		<!-- About start -->
		<?php
		$shop_isle_content_aboutus = '';
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				$shop_isle_content_aboutus = get_the_content();
			}
		}

		if ( trim( $shop_isle_content_aboutus ) != '' ) {
			echo '<section class="module">';
				echo '<div class="container">';
					echo '<div class="row">';
						echo '<div class="col-sm-12">';
							the_content();
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</section>';
		}
		?>
		<!-- About end -->
				
		<!-- Divider -->
		<hr class="divider-w">
		<!-- Divider -->

		<!-- Team start -->
		<section class="module">
			<div class="container">
				<?php
				$shop_isle_our_team_title = get_theme_mod( 'shop_isle_our_team_title', __( 'Meet our team', 'themeisle-companion' ) );
				$shop_isle_our_team_subtitle = get_theme_mod( 'shop_isle_our_team_subtitle',__( 'An awesome way to introduce the members of your team.', 'themeisle-companion' ) );

				if ( ! empty( $shop_isle_our_team_title ) || ! empty( $shop_isle_our_team_subtitle ) ) {

					echo '<div class="row">';
					echo '<div class="col-sm-6 col-sm-offset-3">';

					if ( ! empty( $shop_isle_our_team_title ) ) {
						echo '<h2 class="module-title font-alt meet-out-team-title">' . wp_kses_post( $shop_isle_our_team_title ) . '</h2>';
					}

					if ( ! empty( $shop_isle_our_team_subtitle ) ) {
						echo '<div class="module-subtitle font-serif meet-out-team-subtitle">';
						echo wp_kses_post( $shop_isle_our_team_subtitle );
						echo '</div>';
					}

					echo '</div>';
					echo '</div><!-- .row -->';
				}

				/* Team members start */
				echo '<div class="row">';
				shop_isle_about_page_display_team_members();
				echo '</div>';
				/* Team members end */
				?>
			</div>
		</section>
		<!-- Team end -->
				
		<!-- Video start -->
		<?php
		$shop_isle_about_page_video_background = get_theme_mod( 'shop_isle_about_page_video_background',get_template_directory_uri() . '/assets/images/background-video.jpg' );
		?>
		<section class="module bg-dark-60 about-page-video" 
		<?php
		if ( ! empty( $shop_isle_about_page_video_background ) ) {
			echo 'data-background="' . esc_url( $shop_isle_about_page_video_background ) . '"';}
?>
>
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="video-box">
							<?php
							$shop_isle_about_page_video_link = get_theme_mod( 'shop_isle_about_page_video_link' );
							if ( ! empty( $shop_isle_about_page_video_link ) ) :
								echo '<div class="video-box-icon">';
								echo '<a href="' . esc_url( $shop_isle_about_page_video_link ) . '" class="video-pop-up"><span class="social_youtube_square"></span></a>';
								echo '</div>';
							endif;
							if ( empty( $shop_isle_about_page_video_link ) && is_customize_preview() ) :
								echo '<div class="video-box-icon shop_isle_hidden_if_not_customizer">';
								echo '<a href="' . esc_url( $shop_isle_about_page_video_link ) . '" class="video-pop-up"><span class="social_youtube_square"></span></a>';
								echo '</div>';
							endif;

							$shop_isle_about_page_video_title = get_theme_mod( 'shop_isle_about_page_video_title',__( 'Presentation', 'themeisle-companion' ) );
							$shop_isle_about_page_video_subtitle = get_theme_mod( 'shop_isle_about_page_video_subtitle',__( 'What the video about our new products', 'themeisle-companion' ) );

							if ( ! empty( $shop_isle_about_page_video_title ) ) :
								echo '<div class="video-title font-alt">' . wp_kses_post( $shop_isle_about_page_video_title ) . '</div>';
							endif;

							if ( ! empty( $shop_isle_about_page_video_subtitle ) ) :
								echo '<div class="video-subtitle font-alt">' . wp_kses_post( $shop_isle_about_page_video_subtitle ) . '</div>';
							endif;
							?>
						</div>
					</div>
				</div><!-- .row -->
			</div>
		</section>
		<!-- Video end -->

		<!-- Features start -->
		<section class="module module-advantages">
			<div class="container">
				<?php
				$shop_isle_our_advantages_title = get_theme_mod( 'shop_isle_our_advantages_title',__( 'Our advantages', 'themeisle-companion' ) );
				if ( ! empty( $shop_isle_our_advantages_title ) ) :
					echo '<div class="row">';
						echo '<div class="col-sm-6 col-sm-offset-3">';
							echo '<h2 class="module-title font-alt our_advantages">' . wp_kses_post( $shop_isle_our_advantages_title ) . '</h2>';
						echo '</div>';
					echo '</div>';
				endif;

				shop_isle_about_page_display_advantages();
				?>
			</div><!-- .container -->
		</section>
		<!-- Features end -->
	
<?php get_footer(); ?>
