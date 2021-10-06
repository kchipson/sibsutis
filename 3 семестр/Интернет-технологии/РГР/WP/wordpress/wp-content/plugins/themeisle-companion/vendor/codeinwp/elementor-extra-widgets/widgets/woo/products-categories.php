<?php
/**
 * Recent Woo Products
 *
 * @package Woo Recent Products
 */

class Woo_Product_Categories extends EAW_WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'woo_product_categories',
			'description'                 => __( 'Woo Product Categories - designed for use with the Elementor Page Builder plugin', 'themeisle-companion' ),
			'customize_selective_refresh' => true,
		);

		parent::__construct( 'woo-product-categories', __( 'Woo Product Categories', 'themeisle-companion' ), $widget_ops );
		$this->alt_option_name = 'woo_product_categories';

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
			$cache = wp_cache_get( 'woo_product_categories', 'widget' );
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

		if ( '' == $title ) {
			$title = __( 'Shop By Categories', 'themeisle-companion' );
		}

		$limit = ( ! empty( $instance['limit'] ) ) ? absint( $instance['limit'] ) : 3;
		if ( '' == $limit ) {
			$limit = 3;
		}
		$columns = ( ! empty( $instance['columns'] ) ) ? absint( $instance['columns'] ) : 3;

		if ( '' == $columns ) {
			$columns = 3;
		}

		$args = apply_filters(
			'eaw_product_categories_args',
			array_merge(
                array(
                    'limit'            => $limit,
                    'columns'          => $columns,
                    'child_categories' => 0,
                    'orderby'          => 'name',
                    'title'            => $title,
                ),
				$args
			)
		);

		if ( isset( $args['before_widget'] ) ) {
			echo $args['before_widget'];
		}

		// echo '<div class="widget-woo-categories">';
		echo '<section class="eaw-product-section widget-woo-categories">';

		do_action( 'storepage_homepage_before_product_categories' );

		echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

		do_action( 'storepage_homepage_after_product_categories_title' );

		echo $this->do_shortcode(
			'product_categories', array(
				'number'  => intval( $args['limit'] ),
				'columns' => intval( $args['columns'] ),
				'orderby' => esc_attr( $args['orderby'] ),
				'parent'  => esc_attr( $args['child_categories'] ),
			)
		);

		do_action( 'storepage_homepage_after_product_categories' );

		echo '</section>';
		// echo '</div>';

		if ( isset( $args['after_widget'] ) ) {
			echo $args['after_widget'];
		}

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'woo_product_categories', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance            = $old_instance;
		$instance['title']   = strip_tags( $new_instance['title'] );
		$instance['limit']   = (int) $new_instance['limit'];
		$instance['columns'] = (int) ( $new_instance['columns'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['woo_product_categories'] ) ) {
			delete_option( 'woo_product_categories' );
		}

		return $instance;
	}

	/**
	 * @access public
	 */
	public function flush_widget_cache() {
		wp_cache_delete( 'woo_product_categories', 'widget' );
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$title   = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$limit   = isset( $instance['limit'] ) ? absint( $instance['limit'] ) : 3;
		$columns = isset( $instance['columns '] ) ? absint( $instance['columns '] ) : 3; ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'themeisle-companion' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Number of categories to show:', 'themeisle-companion' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'limit' ); ?>"
			       name="<?php echo $this->get_field_name( 'limit' ); ?>" type="text" value="<?php echo $limit; ?>"
			       size="3"/></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'columns' ); ?>"><?php _e( 'Number of Columns:', 'themeisle-companion' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'columns' ); ?>"
			       name="<?php echo $this->get_field_name( 'columns' ); ?>" type="text" value="<?php echo $columns; ?>"
			       size="3"/></p>
		<?php
	}
}
