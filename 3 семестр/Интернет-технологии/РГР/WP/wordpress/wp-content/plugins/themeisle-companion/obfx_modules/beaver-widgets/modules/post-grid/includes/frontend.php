<?php
/**
 * This file is used to render each pricing module instance.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 */


if ( ! function_exists( 'obfx_show_post_grid_thumbnail' ) ) {
	/**
	 * Display post grid image.
	 *
	 * @param array $settings Post grid settings.
	 */
	function obfx_show_post_grid_thumbnail( $settings ) {
		if ( empty( $settings ) ) {
			return;
		}

		$show_post_thumbnail = ! empty( $settings->show_post_thumbnail ) ? $settings->show_post_thumbnail : '';
		if ( $show_post_thumbnail === 'no' ) {
			return;
		}

		$size = ! empty( $settings->image_size ) ? $settings->image_size : 'post-thumbnail';
		$pid  = get_the_ID();
		$img  = get_the_post_thumbnail_url( $pid, $size );
		if ( ! empty( $img ) ) {
			$thumbnail_shadow = ! empty( $settings->thumbnail_shadow ) && $settings->thumbnail_shadow === 'yes' ? 'obfx-card' : '';
			echo '<div class="obfx-post-grid-thumbnail ' . esc_attr( $thumbnail_shadow ) . '">';
			if ( ! empty( $settings->show_thumbnail_link ) && $settings->show_thumbnail_link === 'yes' ) {
				echo '<a href="' . get_permalink() . '">';
			}
			echo '<img src="' . esc_url( $img ) . '"/></div>';
			if ( ! empty( $settings->show_thumbnail_link ) && $settings->show_thumbnail_link === 'yes' ) {
				echo '</a>';
			}
		}
	}
}

if ( ! function_exists( 'obfx_show_post_grid_title' ) ) {
	/**
	 * Display post grid title.
	 *
	 * @param array $settings Post grid settings.
	 */
	function obfx_show_post_grid_title( $settings ) {
		if ( empty( $settings ) ) {
			return;
		}

		$show_post_title = ! empty( $settings->show_post_title ) ? $settings->show_post_title : '';
		if ( $show_post_title === 'no' ) {
			return;
		}

		if ( ! empty( $settings->show_title_link ) && $settings->show_title_link === 'yes' ) {
			echo '<a href="' . get_permalink() . '">';
		}
		$tag = ! empty( $settings->title_tag ) ? $settings->title_tag : 'h4';
		the_title( '<' . $tag . ' class="obfx-post-grid-title">', '</' . $tag . '>' );
		if ( ! empty( $settings->show_title_link ) && $settings->show_title_link === 'yes' ) {
			echo '</a>';
		}
	}
}

if ( ! function_exists( 'obfx_show_post_grid_meta' ) ) {
	/**
	 * Display post grid meta.
	 *
	 * @param array $settings Post grid settings.
	 */
	function obfx_show_post_grid_meta( $settings ) {
		if ( empty( $settings ) ) {
			return;
		}

		$show_post_meta = ! empty( $settings->show_post_meta ) ? $settings->show_post_meta : '';
		if ( $show_post_meta === 'no' ) {
			return;
		}

		$pid        = get_the_ID();
		$meta_data  = ! empty( $settings->meta_data ) ? ( is_array( $settings->meta_data ) ? $settings->meta_data : array( $settings->meta_data ) ) : array();
		$show_icons = ! empty( $settings->show_icons ) ? $settings->show_icons : '';
		echo '<div class="obfx-post-grid-meta">';
		if ( in_array( 'author', $meta_data, true ) ) {
			$author_id = get_post_field( 'post_author', $pid );
			$author    = get_the_author_meta( 'display_name', $author_id );
			if ( ! empty( $author ) ) {
				echo '<div class="obfx-author">';
				if ( $show_icons === 'yes' ) {
					echo '<i class="fa fa-user"></i>';
				}
				printf(
					/* translators: %1$s is Author name wrapped, %2$s is Time */
					esc_html__( 'By %1$s', 'themeisle-companion' ),
					sprintf(
						/* translators: %1$s is Author name, %2$s is author link */
						'<a href="%2$s" title="%1$s"><b>%1$s</b></a>',
						esc_html( get_the_author() ),
						esc_url( get_author_posts_url( $author_id ) )
					)
				);
				echo '</div>';
			}
		}

		if ( in_array( 'date', $meta_data, true ) ) {
			echo '<div class="obfx-date">';
			if ( $show_icons === 'yes' ) {
				echo '<i class="fa fa-calendar"></i>';
			}
			echo get_the_date();
			echo '</div>';
		}

		if ( in_array( 'category', $meta_data, true ) ) {
			$cat = get_the_category();
			if ( ! empty( $cat ) ) {
				echo '<div class="obfx-category">';
				if ( $show_icons === 'yes' ) {
					echo '<i class="fa fa-list"></i>';
				}
				foreach ( $cat as $category ) {
					$cat_id = $category->term_id;
					$link   = get_category_link( $cat_id );
					$name   = $category->name;
					if ( ! empty( $name ) ) {
						if ( ! empty( $link ) ) {
							echo '<a href="' . esc_url( $link ) . '">';
						}
						echo $name;
						if ( ! empty( $link ) ) {
							echo '</a>';
						}
					}
				}
				echo '</div>';
			}
		}

		if ( in_array( 'tags', $meta_data, true ) ) {
			$tags = wp_get_post_tags( $pid );
			if ( ! empty( $tags ) ) {
				echo '<div class="obfx-tags">';
				if ( $show_icons === 'yes' ) {
					echo '<i class="fa fa-tag"></i>';
				}
				foreach ( $tags as $tag ) {
					$tag_id = $tag->term_id;
					$link   = get_tag_link( $tag_id );
					$name   = $tag->name;
					if ( ! empty( $name ) ) {
						if ( ! empty( $link ) ) {
							echo '<a href="' . esc_url( $link ) . '">';
						}
						echo $name;
						if ( ! empty( $link ) ) {
							echo '</a>';
						}
					}
				}
				echo '</div>';
			}
		}

		if ( in_array( 'comments', $meta_data, true ) ) {
			echo '<div class=obfx-comments">';
			if ( $show_icons === 'yes' ) {
				echo '<i class="fa fa-comment"></i>';
			}
			$comments_number = get_comments_number();
			// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
			if ( 0 == ! $comments_number ) {
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					_x( 'One comment', 'comments title', 'themeisle-companion' );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s Comment',
							'%1$s Comments',
							$comments_number,
							'comments title',
							'themeisle-companion'
						),
						number_format_i18n( $comments_number )
					);
				}
			}
			echo '</div>';
		}
		echo '</div>';
	}
}

if ( ! function_exists( 'obfx_show_post_grid_content' ) ) {
	/**
	 * Display post grid content.
	 *
	 * @param array $settings Post grid settings.
	 */
	function obfx_show_post_grid_content( $settings ) {
		if ( empty( $settings ) ) {
			return;
		}

		$show_post_content = ! empty( $settings->show_post_content ) ? $settings->show_post_content : '';
		if ( $show_post_content === 'no' ) {
			return;
		}

		$number_of_words = ! empty( $settings->content_length ) ? $settings->content_length : '';
		echo '<div class="obfx-post-content">';
		if ( ! empty( $number_of_words ) ) {
			$content = obfx_get_limited_content( $number_of_words, $settings );
			echo '<p>' . wp_kses_post( $content ) . '</p>';
		}
		echo '</div>';
	}
}

if ( ! function_exists( 'obfx_get_limited_content' ) ) {
	/**
	 * Get content with limited number of words.
	 *
	 * @param int $limit Words limit.
	 *
	 * @return string
	 */
	function obfx_get_limited_content( $limit, $settings ) {
		$content = explode( ' ', get_the_content(), $limit );

		$show_read_more = ! empty( $settings->show_read_more ) ? $settings->show_read_more : '';
		$read_more      = $show_read_more === 'yes' ? ( ! empty( $settings->read_more_text ) ? '<a class="obfx-post-grid-read-more" href="' . get_the_permalink() . '">' . $settings->read_more_text . '</a>' : '' ) : '';
		if ( count( $content ) >= $limit ) {
			array_pop( $content );
			$content = implode( ' ', $content );
			$content = strip_tags( $content );
			$content = $content . '...' . wp_kses_post( $read_more );
		} else {
			$content = implode( ' ', $content );
		}

		$content = preg_replace( '/\[.+\]/', '', $content );
		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );

		return $content;
	}
}



$query = FLBuilderLoop::query( $settings );
if ( $query->have_posts() ) {

	$class_to_add = ! empty( $settings->card_layout ) && $settings->card_layout === 'yes' ? 'obfx-card' : '';
	while ( $query->have_posts() ) {
		$query->the_post();

		echo '<div class="obfx-post-grid-wrapper">';
			echo '<div class="obfx-post-grid ' . esc_attr( $class_to_add ) . '">';
				obfx_show_post_grid_thumbnail( $settings );
				obfx_show_post_grid_title( $settings );
				obfx_show_post_grid_meta( $settings );
				obfx_show_post_grid_content( $settings );
			echo '</div>';
		echo '</div>';
	}

	if ( $settings->show_pagination === 'yes' ) {
		echo '<div class="obfx-post-grid-pagination">';
		FLBuilderLoop::pagination( $query );
		echo '</div>';
	}
}

wp_reset_postdata();
