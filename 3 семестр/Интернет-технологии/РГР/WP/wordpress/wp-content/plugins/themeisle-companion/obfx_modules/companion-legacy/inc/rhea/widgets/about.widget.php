<?php
class Rhea_About_Company extends WP_Widget {

	public function __construct() {

		$widget_args = array(
			'description' => esc_html__( 'This widget is designed for footer area', 'themeisle-companion' ),
		);

		parent::__construct( 'rhea-about-company', esc_html__( '[Rhea] About Company', 'themeisle-companion' ), $widget_args );
		add_action( 'admin_enqueue_scripts', array( $this, 'widget_scripts' ) );
	}

	function widget_scripts( $hook ) {
		if ( $hook != 'widgets.php' ) {
			return;
		}
		wp_enqueue_media();
		wp_enqueue_script( 'rhea_widget_media_script', THEMEISLE_COMPANION_URL . 'assets/js/widget-media.js', false, '1.1', true );
	}

	function widget( $args, $instance ) {

		extract( $args );

		if ( ! empty( $before_widget ) ) {
			echo $before_widget;
		}

		$logo_url = '';
		if ( ! empty( $instance['use_logo'] ) ) {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			if ( ! empty( $custom_logo_id ) ) {
				$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
				if ( ! empty( $image ) ) {
					if ( ! empty( $image[0] ) ) {
						$logo_url = $image[0];
					}
				}
			}
		} elseif ( ! empty( $instance['image_uri'] ) ) {
			$logo_url = $instance['image_uri'];
		}

		?>

		<div class="rhea-about-company">
			<?php
			if ( ! empty( $logo_url ) ) {
				echo '<div class="rhea-company-logo">';
					echo '<img src="' . esc_url( $logo_url ) . '" alt="' . esc_attr( get_bloginfo( 'title' ) ) . '">';
				echo '</div>';
			}

			if ( ! empty( $instance['text'] ) ) {
				echo '<div class="rhea-company-description">';
					echo wp_kses_post( $instance['text'] );
				echo '</div>';
			}
			?>
		</div>

		<?php

		if ( ! empty( $after_widget ) ) {
			echo $after_widget;
		}

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['image_uri'] = esc_url( $new_instance['image_uri'] );
		$instance['use_logo'] = strip_tags( $new_instance['use_logo'] );
		$instance['text'] = strip_tags( $new_instance['text'] );

		return $instance;

	}

	function form( $instance ) {

		$image_in_customizer = '';
		$display             = 'none';
		if ( ! empty( $instance['image_uri'] ) ) {
			$image_in_customizer = esc_url( $instance['image_uri'] );
			$display             = 'inline-block';
		}

		?>
		<p>
			<input type="checkbox" name="<?php echo $this->get_field_name( 'use_logo' ); ?>" id="<?php echo $this->get_field_id( 'use_logo' ); ?>" value="use_logo" <?php if ( isset( $instance['use_logo'] ) ) { checked( $instance['use_logo'], 'use_logo' ); } ?>>
			<label for="<?php echo $this->get_field_id( 'use_logo' ); ?>"><?php esc_html_e( 'Use website logo','themeisle-companion' ); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'image_uri' ); ?>"><?php esc_html_e( 'Logo', 'themeisle-companion' ); ?></label><br/>
			<img class="custom_media_image" src="<?php echo $image_in_customizer; ?>" style="margin:0;padding:0;max-width:100px;float:left;display:<?php echo esc_attr( $display ); ?>" alt="<?php echo __( 'Uploaded image', 'themeisle-companion' ); ?>"/><br/>
			<input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name( 'image_uri' ); ?>" id="<?php echo $this->get_field_id( 'image_uri' ); ?>" value="<?php if ( ! empty( $instance['image_uri'] ) ) { echo $instance['image_uri']; } ?>" style="margin-top:5px;">
			<input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name( 'image_uri' ); ?>" value="<?php esc_html_e( 'Upload Image','themeisle-companion' ); ?>" style="margin-top:5px;">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php esc_html_e( 'Company Description', 'themeisle-companion' ); ?></label><br/>
			<textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name( 'text' ); ?>" id="<?php echo $this->get_field_id( 'text' ); ?>"><?php if ( ! empty( $instance['text'] ) ) { echo htmlspecialchars_decode( $instance['text'] ); } ?></textarea>
		</p>

		<?php

	}

}
