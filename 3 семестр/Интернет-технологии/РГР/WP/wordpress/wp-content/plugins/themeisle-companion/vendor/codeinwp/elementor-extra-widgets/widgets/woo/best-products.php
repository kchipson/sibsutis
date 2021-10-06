<?php
/**
 * Recent Woo Products
 *
 * @package Woo Recent Products
 */

class Woo_Best_Products extends EAW_WP_Widget {

    private static $cache = array();

	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'woo_best_products',
			'description'                 => __( 'Woo Best Selling Products - designed for use with the Elementor Page Builder plugin', 'themeisle-companion' ),
			'customize_selective_refresh' => true,
		);

		parent::__construct( 'woo-best-products', __( 'Woo Best Selling Products', 'themeisle-companion' ), $widget_ops );
		$this->alt_option_name = 'woo_best_products';

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		if ( ! $this->is_preview() ) {
			self::$cache = wp_cache_get( 'woo_best_products', 'widget' );
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( self::$cache[ $args['widget_id'] ] ) ) {
			echo self::$cache[ $args['widget_id'] ];

			return;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		if ( '' == $title ) {
			$title = __( 'Best Sellers', 'themeisle-companion' );
		}

		$limit = ( ! empty( $instance['limit'] ) ) ? absint( $instance['limit'] ) : 4;
		if ( '' == $limit ) {
			$limit = 4;
		}
		$columns = ( ! empty( $instance['columns'] ) ) ? absint( $instance['columns'] ) : 4;

		if ( '' == $columns ) {
			$columns = 4;
		}

		$args = apply_filters(
			'elementor-addon-widgets_product_categories_args',
			array_merge(
				array(
					'limit'   => $limit,
					'columns' => $columns,
					'title'   => $title,
					'orderby' => 'date',
					'order'   => 'desc',
				),
				$args
			)
		);

		ob_start();

		if ( isset( $args['before_widget'] ) ) {
			echo $args['before_widget'];
		}

		echo '<section class="eaw-product-section woo-best-products">';

		do_action( 'storepage_homepage_before_best_selling_products' );
		echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';

		do_action( 'storepage_homepage_after_best_selling_products_title' );
		echo $this->do_shortcode(
			'best_selling_products', array(
				'per_page' => intval( $args['limit'] ),
				'columns'  => intval( $args['columns'] ),
			)
		);
		do_action( 'storepage_homepage_after_best_selling_products' );

		echo '</section>';

		if ( isset( $args['after_widget'] ) ) {
			echo $args['after_widget'];
		}

		if ( ! $this->is_preview() ) {
			self::$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'woo_best_products', self::$cache, 'widget' );
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
		if ( isset( $alloptions['woo_best_products'] ) ) {
			delete_option( 'woo_best_products' );
		}

		return $instance;
	}

	/**
	 * @access public
	 */
	public function flush_widget_cache() {
		wp_cache_delete( 'woo_best_products', 'widget' );
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$title   = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$limit   = isset( $instance['limit'] ) ? absint( $instance['limit'] ) : 4;
		$columns = isset( $instance['columns '] ) ? absint( $instance['columns '] ) : 4; ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'themeisle-companion' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Number of products to show:', 'themeisle-companion' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'limit' ); ?>"
			       name="<?php echo $this->get_field_name( 'limit' ); ?>" type="text" value="<?php echo $limit; ?>"
			       size="3"/></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'columns' ); ?>"><?php _e( 'Number of Columns:', 'themeisle-companion' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'columns' ); ?>"
			       name="<?php echo $this->get_field_name( 'columns' ); ?>" type="text" value="<?php echo $columns; ?>"
			       size="3"/>
		</p>
		<?php
	}
}
