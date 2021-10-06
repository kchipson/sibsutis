<?php
/**
 * Our Focus Widget
 *
 * @since 1.0.0
 *
 * @package themeisle-companion
 */


/**
 * Class zerif_ourfocus
 */
if ( ! class_exists( 'zerif_ourfocus' ) ) {

	class zerif_ourfocus extends WP_Widget {

		/**
		 * zerif_ourfocus constructor.
		 */
		public function __construct() {
			parent::__construct(
				'ctUp-ads-widget',
				__( 'Zerif - Our focus widget', 'themeisle-companion' ),
				array(
					'customize_selective_refresh' => true,
				)
			);
			add_action( 'admin_enqueue_scripts', array( $this, 'widget_scripts' ) );
		}

		/**
		 * Enqueue Widget Scripts
		 *
		 * @param $hook
		 */
		function widget_scripts() {
			wp_enqueue_media();
			wp_enqueue_script( 'zerif_widget_media_script', THEMEISLE_COMPANION_URL . 'assets/js/widget-media.js', false, '1.1', true );
		}

		/**
		 * Display Widget
		 *
		 * @param $args
		 * @param $instance
		 */
		function widget( $args, $instance ) {

			extract( $args );

			echo $before_widget;

			?>

			<div class="col-lg-3 col-sm-3 focus-box" data-scrollreveal="enter left after 0.15s over 1s">

				<?php
				if ( ! empty( $instance['image_uri'] ) && ( preg_match('/(\.jpg|\.png|\.jpeg|\.gif|\.bmp)$/', $instance['image_uri'] ) ) ) {
					if ( ! empty( $instance['link'] ) ) { ?>
						<a href="<?php echo esc_url( $instance['link'] ); ?>" class="service-icon">
							<?php
							if ( ! empty( $instance['title'] ) ) { ?>
								<span class="sr-only">
			                    <?php _e( 'Go to', 'themeisle-companion' ); ?>
			                    <?php echo apply_filters( 'widget_title', $instance['title'] ); ?>
		                    </span>
								<?php
							} ?>

							<i class="pixeden"
							   style="background:url(<?php echo esc_url( $instance['image_uri'] ); ?>) no-repeat center;width:100%; height:100%;"></i>
						</a>
						<?php
					} else { ?>
						<div class="service-icon" tabindex="0">
							<i class="pixeden"
							   style="background:url(<?php echo esc_url( $instance['image_uri'] ); ?>) no-repeat center;width:100%; height:100%;"></i>
							<!-- FOCUS ICON-->
						</div>
						<?php
					} ?>


				<?php } elseif ( ! empty( $instance['custom_media_id'] ) ) {

					$zerif_ourfocus_custom_media_id = wp_get_attachment_image_src( $instance['custom_media_id'] );
					if ( ! empty( $zerif_ourfocus_custom_media_id ) && ! empty( $zerif_ourfocus_custom_media_id[0] ) ) {

						if ( ! empty( $instance['link'] ) ) { ?>
							<a href="<?php echo esc_url( $instance['link'] ); ?>" class="service-icon">
								<?php
								if ( ! empty( $instance['title'] ) ) { ?>
									<span class="sr-only">
			                            <?php _e( 'Go to', 'themeisle-companion' ); ?>
			                            <?php echo apply_filters( 'widget_title', $instance['title'] ); ?>
		                            </span>
									<?php
								} ?>
								<i class="pixeden"
								   style="background:url(<?php echo esc_url( $zerif_ourfocus_custom_media_id[0] ); ?>) no-repeat center;width:100%; height:100%;"></i>
							</a>
							<?php
						} else { ?>
							<div class="service-icon" tabindex="0">
								<i class="pixeden"
								   style="background:url(<?php echo esc_url( $zerif_ourfocus_custom_media_id[0] ); ?>) no-repeat center;width:100%; height:100%;"></i>
								<!-- FOCUS ICON-->
							</div>
							<?php
						}
					}
}// End if().
				?>

				<h3 class="red-border-bottom"><?php if ( ! empty( $instance['title'] ) ) :  echo apply_filters( 'widget_title', $instance['title'] );
endif; ?></h3>
				<!-- FOCUS HEADING -->

				<?php
				if ( ! empty( $instance['text'] ) ) {
					echo '<p>';
					echo htmlspecialchars_decode( apply_filters( 'widget_title', $instance['text'] ) );
					echo '</p>';
				}
				?>

			</div>

			<?php

			echo $after_widget;

		}

		/**
		 * Update Widget
		 *
		 * @param $new_instance
		 * @param $old_instance
		 *
		 * @return mixed
		 */
		function update( $new_instance, $old_instance ) {

			$instance                        = $old_instance;
			$instance['text']                = stripslashes( wp_filter_post_kses( $new_instance['text'] ) );
			$instance['title']               = strip_tags( $new_instance['title'] );
			$instance['link']                = strip_tags( $new_instance['link'] );
			$instance['image_uri']           = strip_tags( $new_instance['image_uri'] );
			$instance['custom_media_id']     = strip_tags( $new_instance['custom_media_id'] );
			$instance['image_in_customizer'] = strip_tags( $new_instance['image_in_customizer'] );

			return $instance;

		}

		/**
		 * Widget controls
		 *
		 * @param $instance
		 */
		function form( $instance ) {
			?>

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'themeisle-companion' ); ?></label><br/>
				<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>"
				       id="<?php echo $this->get_field_id( 'title' ); ?>"
				       value="<?php if ( ! empty( $instance['title'] ) ) :  echo $instance['title'];
endif; ?>"
				       class="widefat">
			</p>
			<p>
				<label
					for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text', 'themeisle-companion' ); ?></label><br/>
				<textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name( 'text' ); ?>"
				          id="<?php echo $this->get_field_id( 'text' ); ?>"><?php if ( ! empty( $instance['text'] ) ) :  echo htmlspecialchars_decode( $instance['text'] );
endif; ?></textarea>
			</p>
			<p>
				<label
					for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link', 'themeisle-companion' ); ?></label><br/>
				<input type="text" name="<?php echo $this->get_field_name( 'link' ); ?>"
				       id="<?php echo $this->get_field_id( 'link' ); ?>"
				       value="<?php if ( ! empty( $instance['link'] ) ) :  echo esc_url( $instance['link'] );
endif; ?>"
				       class="widefat">
			</p>
			<p>
				<label
					for="<?php echo $this->get_field_id( 'image_uri' ); ?>"><?php _e( 'Image', 'themeisle-companion' ); ?></label><br/>

				<?php
				$image_in_customizer = '';
				$display             = 'none';
				if ( ! empty( $instance['image_in_customizer'] ) && ! empty( $instance['image_uri'] ) ) {
					$image_in_customizer = esc_url( $instance['image_in_customizer'] );
					$display             = 'inline-block';
				} else {
					if ( ! empty( $instance['image_uri'] ) ) {
						$image_in_customizer = esc_url( $instance['image_uri'] );
						$display             = 'inline-block';
					}
				}
				$zerif_image_in_customizer = $this->get_field_name( 'image_in_customizer' );
				?>
				<input type="hidden" class="custom_media_display_in_customizer"
				       name="<?php if ( ! empty( $zerif_image_in_customizer ) ) {
							echo $zerif_image_in_customizer;
} ?>"
				       value="<?php if ( ! empty( $instance['image_in_customizer'] ) ) :  echo $instance['image_in_customizer'];
endif; ?>">
				<img class="custom_media_image" src="<?php echo $image_in_customizer; ?>"
				     style="margin:0;padding:0;max-width:100px;float:left;display:<?php echo $display; ?>"
				     alt="<?php echo __( 'Uploaded image', 'themeisle-companion' ); ?>"/><br/>

				<input type="text" class="widefat custom_media_url"
				       name="<?php echo $this->get_field_name( 'image_uri' ); ?>"
				       id="<?php echo $this->get_field_id( 'image_uri' ); ?>"
				       value="<?php if ( ! empty( $instance['image_uri'] ) ) :  echo $instance['image_uri'];
endif; ?>"
				       style="margin-top:5px;">

				<input type="button" class="button button-primary custom_media_button" id="custom_media_button"
				       name="<?php echo $this->get_field_name( 'image_uri' ); ?>"
				       value="<?php _e( 'Upload Image', 'themeisle-companion' ); ?>" style="margin-top:5px;">
			</p>

			<input class="custom_media_id" id="<?php echo $this->get_field_id( 'custom_media_id' ); ?>"
			       name="<?php echo $this->get_field_name( 'custom_media_id' ); ?>" type="hidden"
			       value="<?php if ( ! empty( $instance['custom_media_id'] ) ) :  echo $instance['custom_media_id'];
endif; ?>"/>

			<?php

		}

	}
}// End if().
