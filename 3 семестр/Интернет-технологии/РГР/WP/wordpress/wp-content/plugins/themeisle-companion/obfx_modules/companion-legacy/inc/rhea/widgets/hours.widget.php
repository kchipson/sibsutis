<?php
class Rhea_Hours extends WP_Widget {

	public function __construct() {

		$widget_args = array(
			'description' => esc_html__( 'This widget is designed for footer area', 'themeisle-companion' ),
		);
		parent::__construct( 'rhea-company-hours', esc_html__( '[Rhea] Company Program', 'themeisle-companion' ), $widget_args );
	}

	function widget( $args, $instance ) {

		extract( $args );

		if ( ! empty( $before_widget ) ) {
			echo $before_widget;
		}

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		?>

		<div class="rhea_program">

			<?php if ( ! empty( $instance['monday_from'] ) || ! empty( $instance['monday_to'] ) ) { ?>
				<div class="rhea_program_item">
					<p><?php esc_html_e( 'Monday', 'themeisle-companion' ); ?></p>
					<div class="rhea_program_hours">
						<?php if ( ! empty( $instance['monday_from'] ) ) { ?>
							<div class="rhea_program_item_from">
								<?php echo esc_html( $instance['monday_from'] ); ?>
							</div>
						<?php } ?>
						<?php if ( ! empty( $instance['monday_to'] ) ) { ?>
							<div class="rhea_program_item_to">
								<?php echo esc_html( $instance['monday_to'] ); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<?php if ( ! empty( $instance['tuesday_from'] ) || ! empty( $instance['tuesday_to'] ) ) { ?>
				<div class="rhea_program_item">
					<p><?php esc_html_e( 'Tuesday', 'themeisle-companion' ); ?></p>
					<div class="rhea_program_hours">
						<?php if ( ! empty( $instance['tuesday_from'] ) ) { ?>
							<div class="rhea_program_item_from">
								<?php echo esc_html( $instance['tuesday_from'] ); ?>
							</div>
						<?php } ?>
						<?php if ( ! empty( $instance['tuesday_to'] ) ) { ?>
							<div class="rhea_program_item_to">
								<?php echo esc_html( $instance['tuesday_to'] ); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<?php if ( ! empty( $instance['wednesday_from'] ) || ! empty( $instance['wednesday_to'] ) ) { ?>
				<div class="rhea_program_item">
					<p><?php esc_html_e( 'Wednesday', 'themeisle-companion' ); ?></p>
					<div class="rhea_program_hours">
						<?php if ( ! empty( $instance['wednesday_from'] ) ) { ?>
							<div class="rhea_program_item_from">
								<?php echo esc_html( $instance['wednesday_from'] ); ?>
							</div>
						<?php } ?>
						<?php if ( ! empty( $instance['wednesday_to'] ) ) { ?>
							<div class="rhea_program_item_to">
								<?php echo esc_html( $instance['wednesday_to'] ); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<?php if ( ! empty( $instance['thursday_from'] ) || ! empty( $instance['thursday_to'] ) ) { ?>
				<div class="rhea_program_item">
					<p><?php esc_html_e( 'Thursday', 'themeisle-companion' ); ?></p>
					<div class="rhea_program_hours">
						<?php if ( ! empty( $instance['thursday_from'] ) ) { ?>
							<div class="rhea_program_item_from">
								<?php echo esc_html( $instance['thursday_from'] ); ?>
							</div>
						<?php } ?>
						<?php if ( ! empty( $instance['thursday_to'] ) ) { ?>
							<div class="rhea_program_item_to">
								<?php echo esc_html( $instance['thursday_to'] ); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<?php if ( ! empty( $instance['friday_from'] ) || ! empty( $instance['friday_to'] ) ) { ?>
				<div class="rhea_program_item">
					<p><?php esc_html_e( 'Friday', 'themeisle-companion' ); ?></p>
					<div class="rhea_program_hours">
						<?php if ( ! empty( $instance['friday_from'] ) ) { ?>
							<div class="rhea_program_item_from">
								<?php echo esc_html( $instance['friday_from'] ); ?>
							</div>
						<?php } ?>
						<?php if ( ! empty( $instance['friday_to'] ) ) { ?>
							<div class="rhea_program_item_to">
								<?php echo esc_html( $instance['friday_to'] ); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<?php if ( ! empty( $instance['saturday_from'] ) || ! empty( $instance['saturday_to'] ) ) { ?>
				<div class="rhea_program_item">
					<p><?php esc_html_e( 'Saturday', 'themeisle-companion' ); ?></p>
					<div class="rhea_program_hours">
						<?php if ( ! empty( $instance['saturday_from'] ) ) { ?>
							<div class="rhea_program_item_from">
								<?php echo esc_html( $instance['saturday_from'] ); ?>
							</div>
						<?php } ?>
						<?php if ( ! empty( $instance['saturday_to'] ) ) { ?>
							<div class="rhea_program_item_to">
								<?php echo esc_html( $instance['saturday_to'] ); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<?php if ( ( isset( $instance['sunday_from'] ) && $instance['sunday_from'] != '' ) || ( isset( $instance['sunday_to'] ) && $instance['sunday_to'] != '' ) ) { ?>
				<div class="rhea_program_item">
					<p><?php esc_html_e( 'Sunday', 'themeisle-companion' ); ?></p>
					<div class="rhea_program_hours">
						<?php if ( ! empty( $instance['sunday_from'] ) ) { ?>
							<div class="rhea_program_item_from">
								<?php echo esc_html( $instance['sunday_from'] ); ?>
							</div>
						<?php } ?>
						<?php if ( ! empty( $instance['sunday_to'] ) ) { ?>
							<div class="rhea_program_item_to">
								<?php echo esc_html( $instance['sunday_to'] );?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

		</div>

		<?php
		if ( ! empty( $after_widget ) ) {
			echo $after_widget;
		}

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );

		// Monday
		$instance['monday_from'] = strip_tags( $new_instance['monday_from'] );
		$instance['monday_to'] = strip_tags( $new_instance['monday_to'] );

		// Tuesday
		$instance['tuesday_from'] = strip_tags( $new_instance['tuesday_from'] );
		$instance['tuesday_to'] = strip_tags( $new_instance['tuesday_to'] );

		// Wednesday
		$instance['wednesday_from'] = strip_tags( $new_instance['wednesday_from'] );
		$instance['wednesday_to'] = strip_tags( $new_instance['wednesday_to'] );

		// Thursday
		$instance['thursday_from'] = strip_tags( $new_instance['thursday_from'] );
		$instance['thursday_to'] = strip_tags( $new_instance['thursday_to'] );

		// Friday
		$instance['friday_from'] = strip_tags( $new_instance['friday_from'] );
		$instance['friday_to'] = strip_tags( $new_instance['friday_to'] );

		// Saturday
		$instance['saturday_from'] = strip_tags( $new_instance['saturday_from'] );
		$instance['saturday_to'] = strip_tags( $new_instance['saturday_to'] );

		// Sunday
		$instance['sunday_from'] = strip_tags( $new_instance['sunday_from'] );
		$instance['sunday_to'] = strip_tags( $new_instance['sunday_to'] );

		return $instance;

	}

	function form( $instance ) {
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'themeisle-companion' ); ?></label><br/>
			<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php if ( ! empty( $instance['title'] ) ) { echo esc_html( $instance['title'] ); } ?>" class="widefat">
		</p>
		<p>
			<label><?php esc_html_e( 'Monday', 'themeisle-companion' ); ?></label><br/>

			<input type="text" name="<?php echo $this->get_field_name( 'monday_from' ); ?>" id="<?php echo $this->get_field_id( 'monday_from' ); ?>" value="<?php if ( ! empty( $instance['monday_from'] ) ) { echo esc_html( $instance['monday_from'] ); } ?>" placeholder="<?php esc_html_e( 'From', 'themeisle-companion' ); ?>" style="width:45%;">
			<input type="text" name="<?php echo $this->get_field_name( 'monday_to' ); ?>" id="<?php echo $this->get_field_id( 'monday_to' ); ?>" value="<?php if ( ! empty( $instance['monday_to'] ) ) { echo esc_html( $instance['monday_to'] ); } ?>" placeholder="<?php esc_html_e( 'To', 'themeisle-companion' ); ?>" style="width:45%;">
		</p>
		<p>
			<label><?php esc_html_e( 'Tuesday', 'themeisle-companion' ); ?></label><br/>

			<input type="text" name="<?php echo $this->get_field_name( 'tuesday_from' ); ?>" id="<?php echo $this->get_field_id( 'tuesday_from' ); ?>" value="<?php if ( ! empty( $instance['tuesday_from'] ) ) { echo esc_html( $instance['tuesday_from'] ); } ?>" placeholder="<?php esc_html_e( 'From', 'themeisle-companion' ); ?>" style="width:45%;">
			<input type="text" name="<?php echo $this->get_field_name( 'tuesday_to' ); ?>" id="<?php echo $this->get_field_id( 'tuesday_to' ); ?>" value="<?php if ( ! empty( $instance['tuesday_to'] ) ) { echo esc_html( $instance['tuesday_to'] ); } ?>" placeholder="<?php esc_html_e( 'To', 'themeisle-companion' ); ?>" style="width:45%;">
		</p>
		<p>
			<label><?php esc_html_e( 'Wednesday', 'themeisle-companion' ); ?></label><br/>

			<input type="text" name="<?php echo $this->get_field_name( 'wednesday_from' ); ?>" id="<?php echo $this->get_field_id( 'wednesday_from' ); ?>" value="<?php if ( ! empty( $instance['wednesday_from'] ) ) { echo esc_html( $instance['wednesday_from'] ); } ?>" placeholder="<?php esc_html_e( 'From', 'themeisle-companion' ); ?>" style="width:45%;">
			<input type="text" name="<?php echo $this->get_field_name( 'wednesday_to' ); ?>" id="<?php echo $this->get_field_id( 'wednesday_to' ); ?>" value="<?php if ( ! empty( $instance['wednesday_to'] ) ) { echo esc_html( $instance['wednesday_to'] ); } ?>" placeholder="<?php esc_html_e( 'To', 'themeisle-companion' ); ?>" style="width:45%;">
		</p>
		<p>
			<label><?php esc_html_e( 'Thursday', 'themeisle-companion' ); ?></label><br/>

			<input type="text" name="<?php echo $this->get_field_name( 'thursday_from' ); ?>" id="<?php echo $this->get_field_id( 'thursday_from' ); ?>" value="<?php if ( ! empty( $instance['thursday_from'] ) ) { echo esc_html( $instance['thursday_from'] ); } ?>" placeholder="<?php esc_html_e( 'From', 'themeisle-companion' ); ?>" style="width:45%;">
			<input type="text" name="<?php echo $this->get_field_name( 'thursday_to' ); ?>" id="<?php echo $this->get_field_id( 'thursday_to' ); ?>" value="<?php if ( ! empty( $instance['thursday_to'] ) ) { echo esc_html( $instance['thursday_to'] ); } ?>" placeholder="<?php esc_html_e( 'To', 'themeisle-companion' ); ?>" style="width:45%;">
		</p>
		<p>
			<label><?php esc_html_e( 'Friday', 'themeisle-companion' ); ?></label><br/>

			<input type="text" name="<?php echo $this->get_field_name( 'friday_from' ); ?>" id="<?php echo $this->get_field_id( 'friday_from' ); ?>" value="<?php if ( ! empty( $instance['friday_from'] ) ) { echo esc_html( $instance['friday_from'] ); } ?>" placeholder="<?php esc_html_e( 'From', 'themeisle-companion' ); ?>" style="width:45%;">
			<input type="text" name="<?php echo $this->get_field_name( 'friday_to' ); ?>" id="<?php echo $this->get_field_id( 'friday_to' ); ?>" value="<?php if ( ! empty( $instance['friday_to'] ) ) { echo esc_html( $instance['friday_to'] ); } ?>" placeholder="<?php esc_html_e( 'To', 'themeisle-companion' ); ?>" style="width:45%;">
		</p>
		<p>
			<label><?php esc_html_e( 'Saturday', 'themeisle-companion' ); ?></label><br/>

			<input type="text" name="<?php echo $this->get_field_name( 'saturday_from' ); ?>" id="<?php echo $this->get_field_id( 'saturday_from' ); ?>" value="<?php if ( ! empty( $instance['saturday_from'] ) ) { echo esc_html( $instance['saturday_from'] ); } ?>" placeholder="<?php esc_html_e( 'From', 'themeisle-companion' ); ?>" style="width:45%;">
			<input type="text" name="<?php echo $this->get_field_name( 'saturday_to' ); ?>" id="<?php echo $this->get_field_id( 'saturday_to' ); ?>" value="<?php if ( ! empty( $instance['saturday_to'] ) ) { echo esc_html( $instance['saturday_to'] ); } ?>" placeholder="<?php esc_html_e( 'To', 'themeisle-companion' ); ?>" style="width:45%;">
		</p>
		<p>
			<label><?php esc_html_e( 'Sunday', 'themeisle-companion' ); ?></label><br/>

			<input type="text" name="<?php echo $this->get_field_name( 'sunday_from' ); ?>" id="<?php echo $this->get_field_id( 'sunday_from' ); ?>" value="<?php if ( ! empty( $instance['sunday_from'] ) ) { echo esc_html( $instance['sunday_from'] ); } ?>" placeholder="<?php esc_html_e( 'From', 'themeisle-companion' ); ?>" style="width:45%;">
			<input type="text" name="<?php echo $this->get_field_name( 'sunday_to' ); ?>" id="<?php echo $this->get_field_id( 'sunday_to' ); ?>" value="<?php if ( ! empty( $instance['sunday_to'] ) ) { echo esc_html( $instance['sunday_to'] ); } ?>" placeholder="<?php esc_html_e( 'To', 'themeisle-companion' ); ?>" style="width:45%;">
		</p>

		<?php

	}

}
