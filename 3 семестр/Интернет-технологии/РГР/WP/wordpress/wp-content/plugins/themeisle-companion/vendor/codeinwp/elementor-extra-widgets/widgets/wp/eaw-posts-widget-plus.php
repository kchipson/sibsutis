<?php
/**
 * Recent posts with featured image
 *
 * @package Elementor Addon Widgets
 */

class EAW_Recent_Posts_Plus extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget_recent_posts_plus',
			'description'                 => __( 'Recent posts with featured image - ideal for use with Elementor Page Builder plugin', 'themeisle-companion' ),
			'customize_selective_refresh' => true,
		);

		parent::__construct( 'eaw-recent-posts-plus', __( 'EAW: Elementor Posts By Category', 'themeisle-companion' ), $widget_ops );
		$this->alt_option_name = 'widget_recent_entries_plus';

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_recent_posts_plus', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];

			return;
		}

		ob_start();

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;
		if ( ! $number ) {
			$number = 3;
		}

		$category = isset( $instance['category'] ) ? $instance['category'] : '';

		$show_excerpt = isset( $instance['show_excerpt'] ) ? $instance['show_excerpt'] : false;
		$excerptcount = ( ! empty( $instance['excerptcount'] ) ) ? absint( $instance['excerptcount'] ) : 20;

		if ( '' == $excerptcount || '0' == $excerptcount ) {
			$excerptcount = 20;
		}

		$eawp = new WP_Query(
			apply_filters(
				'eaw_widget_posts_plus_args', array(
					'posts_per_page'      => $number,
					'cat'                 => $category,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
				)
			)
		);

		if ( $eawp->have_posts() ) {

			echo $args['before_widget'];
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			while ( $eawp->have_posts() ) :
				$eawp->the_post(); ?>
				<div class="eaw-recent-posts">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'medium' );
					} ?>
					<div class="eaw-content">
						<h3><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
						</h3>
						<p>
							<?php
							if ( $show_excerpt ) {
								echo wp_trim_words( get_the_excerpt(), $excerptcount, ' &hellip;' );
							} ?>
						</p>
					</div>
				</div>
			<?php
			endwhile;

			if ( isset( $args['after_widget'] ) ) {
				echo $args['after_widget'];
			}

			wp_reset_postdata();

		}

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_recent_posts_plus', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title']        = strip_tags( $new_instance['title'] );
		$instance['number']       = (int) $new_instance['number'];
		$instance['category']     = wp_strip_all_tags( $new_instance['category'] );
		$instance['excerptcount'] = (int) ( $new_instance['excerptcount'] );
		$instance['show_excerpt'] = isset( $new_instance['show_excerpt'] ) ? (bool) $new_instance['show_excerpt'] : false;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['widget_recent_entries_plus'] ) ) {
			delete_option( 'widget_recent_entries_plus' );
		}

		return $instance;
	}

	/**
	 * @access public
	 */
	public function flush_widget_cache() {
		wp_cache_delete( 'widget_recent_posts_plus', 'widget' );
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$title        = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number       = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
		$excerptcount = isset( $instance['excerptcount '] ) ? absint( $instance['excerptcount '] ) : 20;
		$show_excerpt = isset( $instance['show_excerpt'] ) ? (bool) $instance['show_excerpt'] : false;
		$category     = isset( $instance['category'] ) ? $instance['category'] : ''; ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'themeisle-companion' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'themeisle-companion' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>"
			       name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>"
			       size="3"/></p>

		<p>
			<label for="rpjc_widget_cat_recent_posts_category"><?php _e( 'Category', 'themeisle-companion' ); ?>:</label>
			<?php
			wp_dropdown_categories(
				array(

					'orderby'    => 'title',
					'hide_empty' => false,
					'name'       => $this->get_field_name( 'category' ),
					'id'         => 'rpjc_widget_cat_recent_posts_category',
					'class'      => 'widefat',
					'selected'   => $category,
				)
			); ?>
		</p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_excerpt ); ?>
		          id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>"
		          name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>"/>
			<label for="<?php echo $this->get_field_id( 'show_dexcerpt' ); ?>"><?php _e( 'Display post excerpt?', 'themeisle-companion' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'excerptcount' ); ?>"><?php _e( 'Excerpt length to show:', 'themeisle-companion' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'excerptcount' ); ?>"
			       name="<?php echo $this->get_field_name( 'excerptcount' ); ?>" type="text"
			       value="<?php echo $excerptcount; ?>" size="3"/></p>
	<?php }
}
