<?php
class Rhea_Progress_Bar extends WP_Widget {

	public function __construct() {
		$widget_args = array(
			'description' => esc_html__( 'This widget is designed for Progress Bar Section', 'themeisle-companion' ),
		);
		parent::__construct( 'rhea-progress-bar', esc_html__( '[Rhea] - Progress Bar', 'themeisle-companion' ), $widget_args );
	}

	function widget( $args, $instance ) {

		extract( $args );

		if ( ! empty( $before_widget ) ) {
			echo $before_widget;
		}

		$percentage = ! empty( $instance['percentage'] ) ? $instance['percentage'] : '0';

		?>

		<div class="progress-holder">
			<?php
			if ( ! empty( $instance['title'] ) ) {
				echo '<h3>' . esc_html( $instance['title'] ) . '</h3>';
			}

			if ( ! empty( $instance['info'] ) ) {
				echo '<span class="completion-rate" style="width: ' . absint( $percentage ) . '%">' . esc_html( $instance['info'] ) . '</span>';
			}

			?>
			<div class="progress">
				<div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo absint( $percentage ) ?>%"></div>
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
		$instance['info'] = strip_tags( $new_instance['info'] );
		$instance['percentage'] = strip_tags( $new_instance['percentage'] );

		return $instance;

	}

	function form( $instance ) {
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'themeisle-companion' ); ?></label><br/>
			<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php if ( ! empty( $instance['title'] ) ) { echo $instance['title']; } ?>" placeholder="Wordpress" class="widefat">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'info' ); ?>"><?php esc_html_e( 'Info', 'themeisle-companion' ); ?></label><br/>
			<input type="text" name="<?php echo $this->get_field_name( 'info' ); ?>" id="<?php echo $this->get_field_id( 'info' ); ?>" value="<?php if ( ! empty( $instance['info'] ) ) { echo $instance['info']; } ?>" placeholder="70%" class="widefat">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'percentage' ); ?>"><?php esc_html_e( 'Percentage','themeisle-companion' ); ?></label><br />
			<input type="text" name="<?php echo $this->get_field_name( 'percentage' ); ?>" id="<?php echo $this->get_field_id( 'percentage' ); ?>" value="<?php if ( ! empty( $instance['percentage'] ) ) { echo $instance['percentage']; } ?>"  placeholder="70" class="widefat">
		</p>

		<?php

	}

}
