<?php
class Rhea_Icon_Box extends WP_Widget {

	public function __construct() {
		$widget_args = array(
			'description' => esc_html__( 'This widget is designed for Right Section sidebar', 'themeisle-companion' ),
		);
		parent::__construct( 'rhea-icon-box', esc_html__( '[Rhea] Icon Box', 'themeisle-companion' ), $widget_args );
	}

	function widget( $args, $instance ) {

		extract( $args );

		if ( ! empty( $before_widget ) ) {
			echo $before_widget;
		}

		?>

		<div class="about_us_box">
			<div class="header_aboutus_box">
				<div class="pull-left icon-holder">
					<?php if ( ! empty( $instance['icon'] ) ) { ?>
						<i class="fa <?php echo esc_attr( $instance['icon'] ); ?>"></i>
					<?php } ?>
				</div>
				<div class="aboutus_titles pull-left">
					<?php
					if ( ! empty( $instance['title'] ) ) {
						echo '<h4>' . esc_html( $instance['title'] ) . '</h4>';
					}
					if ( ! empty( $instance['subtitle'] ) ) {
						echo '<p>' . esc_html( $instance['subtitle'] ) . '</p>';
					}
					?>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="aboutus_content">
				<?php
				if ( ! empty( $instance['description'] ) ) {
					echo '<p>' . esc_html( $instance['description'] ) . '</p>';
				}
				?>
			</div>
		</div>

		<?php

		if ( ! empty( $after_widget ) ) {
			echo $after_widget;
		}

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = stripslashes( wp_filter_post_kses( $new_instance['title'] ) );
		$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		$instance['icon'] = strip_tags( $new_instance['icon'] );
		$instance['description'] = strip_tags( $new_instance['description'] );

		return $instance;

	}

	function form( $instance ) {
		$icon_holder_class = empty( $instance['icon'] ) ? ' empty-icon' : ''; ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php esc_html_e( 'Icon', 'themeisle-companion' ); ?></label><br/>
			<div class="fontawesome-icon-container<?php echo esc_attr( $icon_holder_class ); ?>">
				<input type="hidden" class="widefat" name="<?php echo $this->get_field_name( 'icon' ); ?>" id="<?php echo $this->get_field_id( 'icon' ); ?>" value="<?php if ( ! empty( $instance['icon'] ) ) { echo esc_html( $instance['icon'] ); } ?>">
				<div class="icon-holder">
		<p><?php esc_html_e( 'No icon selected :( ...', 'themeisle-companion' ) ?></p>
		<i class="<?php if ( ! empty( $instance['icon'] ) ) { echo esc_attr( $instance['icon'] ); } ?>"></i>
		</div>
		<div class="actions">
			<button type="button" class="button add-icon-button"><?php esc_html_e( 'Select Icon', 'themeisle-companion' ) ?></button>
			<button type="button" class="button change-icon-button"><?php esc_html_e( 'Change Icon', 'themeisle-companion' ) ?></button>
			<button type="button" class="button remove-icon-button"><?php esc_html_e( 'Remove', 'themeisle-companion' ) ?></button>
		</div>
		</div>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'themeisle-companion' ); ?></label><br/>
			<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php if ( ! empty( $instance['title'] ) ) { echo $instance['title']; } ?>" class="widefat">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php esc_html_e( 'Subtitle', 'themeisle-companion' ); ?></label><br/>
			<input type="text" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" value="<?php if ( ! empty( $instance['subtitle'] ) ) { echo $instance['subtitle']; } ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php esc_html_e( 'Description', 'themeisle-companion' ); ?></label><br/>
			<textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name( 'description' ); ?>" id="<?php echo $this->get_field_id( 'description' ); ?>"><?php if ( ! empty( $instance['description'] ) ) { echo htmlspecialchars_decode( $instance['description'] ); } ?></textarea>
		</p>

		<?php

	}

}
