<?php
/**
 * Hestia Additional Views.
 *
 * @package Hestia
 */

/**
 * Class Hestia_Header_Layout_Manager
 */
class Hestia_Additional_Views extends Hestia_Abstract_Main {
	/**
	 * Init layout manager.
	 */
	public function init() {
		add_action( 'hestia_after_single_post_article', array( $this, 'post_after_article' ) );

		add_action( 'hestia_blog_social_icons', array( $this, 'social_icons' ) );

		add_action( 'wp_footer', array( $this, 'scroll_to_top' ) );

		add_action( 'hestia_blog_related_posts', array( $this, 'related_posts' ) );

		add_action( 'hestia_before_header_hook', array( $this, 'hidden_sidebars' ) );
	}

	/**
	 * Social sharing icons for single view.
	 *
	 * @since Hestia 1.0
	 */
	public function social_icons() {
		$enabled_socials = get_theme_mod( 'hestia_enable_sharing_icons', true );
		if ( (bool) $enabled_socials !== true ) {
			return;
		}

		$post_link  = esc_url( get_the_permalink() );
		$post_title = get_the_title();

		$facebook_url =
			esc_url(
				add_query_arg(
					array(
						'u' => $post_link,
					),
					'https://www.facebook.com/sharer.php'
				)
			);

		$twitter_url =
			esc_url(
				add_query_arg(
					array(
						'url'  => $post_link,
						'text' => rawurlencode( html_entity_decode( wp_strip_all_tags( $post_title ), ENT_COMPAT, 'UTF-8' ) ),
					),
					'http://twitter.com/share'
				)
			);

		$email_title = str_replace( '&', '%26', $post_title );

		$email_url =
			esc_url(
				add_query_arg(
					array(
						'subject' => wp_strip_all_tags( $email_title ),
						'body'    => $post_link,
					),
					'mailto:'
				)
			);

		$social_links = '
        <div class="col-md-6">
            <div class="entry-social">
                <a target="_blank" rel="tooltip"
                   data-original-title="' . esc_attr__( 'Share on Facebook', 'hestia' ) . '"
                   class="btn btn-just-icon btn-round btn-facebook"
                   href="' . $facebook_url . '">
                   <i class="fab fa-facebook-f"></i>
                </a>
                
                <a target="_blank" rel="tooltip"
                   data-original-title="' . esc_attr__( 'Share on Twitter', 'hestia' ) . '"
                   class="btn btn-just-icon btn-round btn-twitter"
                   href="' . $twitter_url . '">
                   <i class="fab fa-twitter"></i>
                </a>
                
                <a rel="tooltip"
                   data-original-title=" ' . esc_attr__( 'Share on Email', 'hestia' ) . '"
                   class="btn btn-just-icon btn-round"
                   href="' . $email_url . '">
                   <i class="fas fa-envelope"></i>
               </a>
            </div>
		</div>';
		echo apply_filters( 'hestia_filter_blog_social_icons', $social_links );
	}

	/**
	 * Single post after article.
	 */
	public function post_after_article() {
		global $post;
		$categories = get_the_category( $post->ID );
		?>

		<div class="section section-blog-info">
			<div class="row">
				<div class="col-md-6">
					<div class="entry-categories"><?php esc_html_e( 'Categories:', 'hestia' ); ?>
						<?php
						foreach ( $categories as $category ) {
							echo '<span class="label label-primary"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></span>';
						}
						?>
					</div>
					<?php the_tags( '<div class="entry-tags">' . esc_html__( 'Tags: ', 'hestia' ) . '<span class="entry-tag">', '</span><span class="entry-tag">', '</span></div>' ); ?>
				</div>
				<?php do_action( 'hestia_blog_social_icons' ); ?>
			</div>
			<hr>
			<?php
			$this->maybe_render_author_box();
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
		</div>
		<?php
	}


	/**
	 * Render the author box.
	 */
	private function maybe_render_author_box() {
		$author_description = get_the_author_meta( 'description' );
		if ( empty( $author_description ) ) {
			return;
		}
		?>
		<div class="card card-profile card-plain">
			<div class="row">
				<div class="col-md-2">
					<div class="card-avatar">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
								title="<?php echo esc_attr( get_the_author() ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?></a>
					</div>
				</div>
				<div class="col-md-10">
					<h4 class="card-title"><?php the_author(); ?></h4>
					<p class="description"><?php the_author_meta( 'description' ); ?></p>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Display scroll to top button.
	 *
	 * @since 1.1.54
	 */
	public function scroll_to_top() {
		$hestia_enable_scroll_to_top = get_theme_mod( 'hestia_enable_scroll_to_top', apply_filters( 'hestia_scroll_to_top_default', 0 ) );
		if ( (bool) $hestia_enable_scroll_to_top === false ) {
			return;
		}
		?>
		<button class="hestia-scroll-to-top">
			<i class="fas fa-angle-double-up" aria-hidden="true"></i>
		</button>
		<?php
	}

	/**
	 * Related posts for single view.
	 *
	 * @since Hestia 1.0
	 */
	public function related_posts() {
		global $post;
		$cats         = wp_get_object_terms(
			$post->ID,
			'category',
			array(
				'fields' => 'ids',
			)
		);
		$args         = array(
			'posts_per_page'      => 3,
			'cat'                 => $cats,
			'orderby'             => 'date',
			'ignore_sticky_posts' => true,
			'post__not_in'        => array( $post->ID ),
		);
		$allowed_html = array(
			'br'     => array(),
			'em'     => array(),
			'strong' => array(),
			'i'      => array(
				'class' => array(),
			),
			'span'   => array(),
		);

		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) :
			?>
			<div class="section related-posts">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h2 class="hestia-title text-center"><?php echo apply_filters( 'hestia_related_posts_title', esc_html__( 'Related Posts', 'hestia' ) ); ?></h2>
							<div class="row">
								<?php
								while ( $loop->have_posts() ) :
									$loop->the_post();
									?>
									<div class="col-md-4">
										<div class="card card-blog">
											<?php if ( has_post_thumbnail() ) : ?>
												<div class="card-image">
													<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
														<?php the_post_thumbnail( 'hestia-blog' ); ?>
													</a>
												</div>
											<?php endif; ?>
											<div class="content">
												<h6 class="category text-info"><?php echo hestia_category( false ); ?></h6>
												<h4 class="card-title">
													<a class="blog-item-title-link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
														<?php echo wp_kses( force_balance_tags( get_the_title() ), $allowed_html ); ?>
													</a>
												</h4>
												<p class="card-description"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
											</div>
										</div>
									</div>
								<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		endif;
	}

	/**
	 * Display the hidden sidebars to enable the customizer panels.
	 */
	public function hidden_sidebars() {
		echo '<div style="display: none">';
		if ( is_customize_preview() ) {
			dynamic_sidebar( 'sidebar-top-bar' );
			dynamic_sidebar( 'header-sidebar' );
			dynamic_sidebar( 'subscribe-widgets' );
			dynamic_sidebar( 'sidebar-big-title' );
		}
		echo '</div>';
	}

}
