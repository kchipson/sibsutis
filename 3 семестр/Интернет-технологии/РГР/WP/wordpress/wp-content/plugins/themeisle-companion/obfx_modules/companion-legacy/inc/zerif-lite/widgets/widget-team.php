<?php
/**
 * Testimonial Widget
 *
 * @since 1.0.0
 *
 * @package themeisle-companion
 */


/**
 * Class zerif_team_widget
 */
if ( ! class_exists( 'zerif_team_widget' ) ) {

	class zerif_team_widget extends WP_Widget {

		/**
		 * zerif_team_widget constructor.
		 */
		public function __construct() {
			parent::__construct(
				'zerif_team-widget',
				__( 'Zerif - Team member widget', 'themeisle-companion' ),
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

			<div class="col-lg-3 col-sm-3 team-box">

				<div class="team-member" tabindex="0">

					<?php if ( ! empty( $instance['image_uri'] ) && ( preg_match('/(\.jpg|\.png|\.jpeg|\.gif|\.bmp)$/', $instance['image_uri'] ) ) ) { ?>


						<figure class="profile-pic">

							<img src="<?php echo esc_url( $instance['image_uri'] ); ?>" alt=""/>

						</figure>
						<?php
} elseif ( ! empty( $instance['custom_media_id'] ) ) {

	$zerif_team_custom_media_id = wp_get_attachment_image_src( $instance['custom_media_id'] );
	$alt                        = get_post_meta( $instance['custom_media_id'], '_wp_attachment_image_alt', true );

	if ( ! empty( $zerif_team_custom_media_id ) && ! empty( $zerif_team_custom_media_id[0] ) ) {
		?>

		<figure class="profile-pic">

			<img src="<?php echo esc_url( $zerif_team_custom_media_id[0] ); ?>"
				 alt="<?php echo $alt; ?>"/>

							</figure>

							<?php
	}
}
					?>

					<div class="member-details">

						<?php if ( ! empty( $instance['name'] ) ) :  ?>

							<h3 class="dark-text red-border-bottom"><?php echo apply_filters( 'widget_title', $instance['name'] ); ?></h3>

						<?php endif; ?>

						<?php if ( ! empty( $instance['position'] ) ) :  ?>

							<div
								class="position"><?php echo htmlspecialchars_decode( apply_filters( 'widget_title', $instance['position'] ) ); ?></div>

						<?php endif; ?>

					</div>

					<div class="social-icons">

						<ul>
							<?php
							$zerif_team_target = '_self';
							if ( ! empty( $instance['open_new_window'] ) ) :
								$zerif_team_target = '_blank';
							endif;
							?>

							<?php
							if ( ! empty( $instance['fb_link'] ) ) :  ?>
								<li>
									<a href="<?php echo apply_filters( 'widget_title', $instance['fb_link'] ); ?>"
									   target="<?php echo $zerif_team_target; ?>">
										<?php
										if ( ! empty( $instance['name'] ) ) { ?>
											<span class="sr-only">
				                            <?php _e( 'Facebook account of', 'themeisle-companion' ); ?>
				                            <?php echo apply_filters( 'widget_title', $instance['name'] ); ?>
			                            </span>
											<?php
										} ?>
										<i class="fa fa-facebook"></i>
									</a>
								</li>
								<?php
							endif;

							if ( ! empty( $instance['tw_link'] ) ) :  ?>
								<li>
									<a href="<?php echo apply_filters( 'widget_title', $instance['tw_link'] ); ?>"
									   target="<?php echo $zerif_team_target; ?>">
										<?php
										if ( ! empty( $instance['name'] ) ) { ?>
											<span class="sr-only">
				                            <?php _e( 'Twitter account of', 'themeisle-companion' ); ?>
				                            <?php echo apply_filters( 'widget_title', $instance['name'] ); ?>
			                            </span>
											<?php
										} ?>
										<i class="fa fa-twitter"></i>
									</a>
								</li>
								<?php
							endif;

							if ( ! empty( $instance['bh_link'] ) ) :  ?>
								<li>
									<a href="<?php echo apply_filters( 'widget_title', $instance['bh_link'] ); ?>"
									   target="<?php echo $zerif_team_target; ?>">
										<?php
										if ( ! empty( $instance['name'] ) ) { ?>
											<span class="sr-only">
				                            <?php _e( 'Behance account of', 'themeisle-companion' ); ?>
				                            <?php echo apply_filters( 'widget_title', $instance['name'] ); ?>
			                            </span>
											<?php
										} ?>
										<i class="fa fa-behance"></i>
									</a>
								</li>
								<?php
							endif;

							if ( ! empty( $instance['db_link'] ) ) :  ?>
								<li>
									<a href="<?php echo apply_filters( 'widget_title', $instance['db_link'] ); ?>"
									   target="<?php echo $zerif_team_target; ?>">
										<?php
										if ( ! empty( $instance['name'] ) ) { ?>
											<span class="sr-only">
				                            <?php _e( 'Dribble account of', 'themeisle-companion' ); ?>
				                            <?php echo apply_filters( 'widget_title', $instance['name'] ); ?>
			                            </span>
											<?php
										} ?>
										<i class="fa fa-dribbble"></i>
									</a>
								</li>
								<?php
							endif;

							if ( ! empty( $instance['ln_link'] ) ) :  ?>
								<li>
									<a href="<?php echo apply_filters( 'widget_title', $instance['ln_link'] ); ?>"
									   target="<?php echo $zerif_team_target; ?>">
										<?php
										if ( ! empty( $instance['name'] ) ) { ?>
											<span class="sr-only">
				                            <?php _e( 'Linkedin account of', 'themeisle-companion' ); ?>
				                            <?php echo apply_filters( 'widget_title', $instance['name'] ); ?>
			                            </span>
											<?php
										} ?>
										<i class="fa fa-linkedin"></i>
									</a>
								</li>
								<?php
							endif; ?>

						</ul>

					</div>

					<?php if ( ! empty( $instance['description'] ) ) :  ?>
						<div class="details">

							<?php echo htmlspecialchars_decode( apply_filters( 'widget_title', $instance['description'] ) ); ?>

						</div>
					<?php endif; ?>

				</div>

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

			$instance = $old_instance;

			$instance['name']                = strip_tags( $new_instance['name'] );
			$instance['position']            = stripslashes( wp_filter_post_kses( $new_instance['position'] ) );
			$instance['description']         = stripslashes( wp_filter_post_kses( $new_instance['description'] ) );
			$instance['fb_link']             = strip_tags( $new_instance['fb_link'] );
			$instance['tw_link']             = strip_tags( $new_instance['tw_link'] );
			$instance['bh_link']             = strip_tags( $new_instance['bh_link'] );
			$instance['db_link']             = strip_tags( $new_instance['db_link'] );
			$instance['ln_link']             = strip_tags( $new_instance['ln_link'] );
			$instance['image_uri']           = strip_tags( $new_instance['image_uri'] );
			$instance['open_new_window']     = strip_tags( $new_instance['open_new_window'] );
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
				<label
					for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Name', 'themeisle-companion' ); ?></label><br/>
				<input type="text" name="<?php echo $this->get_field_name( 'name' ); ?>"
				       id="<?php echo $this->get_field_id( 'name' ); ?>"
				       value="<?php if ( ! empty( $instance['name'] ) ) :  echo $instance['name'];
endif; ?>"
				       class="widefat"/>
			</p>
			<p>
				<label
					for="<?php echo $this->get_field_id( 'position' ); ?>"><?php _e( 'Position', 'themeisle-companion' ); ?></label><br/>
				<textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name( 'position' ); ?>"
				          id="<?php echo $this->get_field_id( 'position' ); ?>"><?php if ( ! empty( $instance['position'] ) ) :  echo htmlspecialchars_decode( $instance['position'] );
endif; ?></textarea>
			</p>
			<p>
				<label
					for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description', 'themeisle-companion' ); ?></label><br/>
				<textarea class="widefat" rows="8" cols="20"
				          name="<?php echo $this->get_field_name( 'description' ); ?>"
				          id="<?php echo $this->get_field_id( 'description' ); ?>"><?php
							if ( ! empty( $instance['description'] ) ) :  echo htmlspecialchars_decode( $instance['description'] );
endif;
					?></textarea>
			</p>
			<p>
				<label
					for="<?php echo $this->get_field_id( 'fb_link' ); ?>"><?php _e( 'Facebook link', 'themeisle-companion' ); ?></label><br/>
				<input type="text" name="<?php echo $this->get_field_name( 'fb_link' ); ?>"
				       id="<?php echo $this->get_field_id( 'fb_link' ); ?>"
				       value="<?php if ( ! empty( $instance['fb_link'] ) ) :  echo $instance['fb_link'];
endif; ?>"
				       class="widefat">

			</p>
			<p>
				<label
					for="<?php echo $this->get_field_id( 'tw_link' ); ?>"><?php _e( 'Twitter link', 'themeisle-companion' ); ?></label><br/>
				<input type="text" name="<?php echo $this->get_field_name( 'tw_link' ); ?>"
				       id="<?php echo $this->get_field_id( 'tw_link' ); ?>"
				       value="<?php if ( ! empty( $instance['tw_link'] ) ) :  echo $instance['tw_link'];
endif; ?>"
				       class="widefat">
			</p>
			<p>
				<label
					for="<?php echo $this->get_field_id( 'bh_link' ); ?>"><?php _e( 'Behance link', 'themeisle-companion' ); ?></label><br/>
				<input type="text" name="<?php echo $this->get_field_name( 'bh_link' ); ?>"
				       id="<?php echo $this->get_field_id( 'bh_link' ); ?>"
				       value="<?php if ( ! empty( $instance['bh_link'] ) ) :  echo $instance['bh_link'];
endif; ?>"
				       class="widefat">

			</p>
			<p>
				<label
					for="<?php echo $this->get_field_id( 'db_link' ); ?>"><?php _e( 'Dribble link', 'themeisle-companion' ); ?></label><br/>
				<input type="text" name="<?php echo $this->get_field_name( 'db_link' ); ?>"
				       id="<?php echo $this->get_field_id( 'db_link' ); ?>"
				       value="<?php if ( ! empty( $instance['db_link'] ) ) :  echo $instance['db_link'];
endif; ?>"
				       class="widefat">
			</p>
			<p>
				<label
					for="<?php echo $this->get_field_id( 'ln_link' ); ?>"><?php _e( 'Linkedin link', 'themeisle-companion' ); ?></label><br/>
				<input type="text" name="<?php echo $this->get_field_name( 'ln_link' ); ?>"
				       id="<?php echo $this->get_field_id( 'ln_link' ); ?>"
				       value="<?php if ( ! empty( $instance['ln_link'] ) ) :  echo $instance['ln_link'];
endif; ?>"
				       class="widefat">
			</p>
			<p>
				<input type="checkbox" name="<?php echo $this->get_field_name( 'open_new_window' ); ?>"
				       id="<?php echo $this->get_field_id( 'open_new_window' ); ?>" <?php if ( ! empty( $instance['open_new_window'] ) ) :  checked( (bool) $instance['open_new_window'], true );
endif; ?> ><?php _e( 'Open links in new window?', 'themeisle-companion' ); ?>
				<br>
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
