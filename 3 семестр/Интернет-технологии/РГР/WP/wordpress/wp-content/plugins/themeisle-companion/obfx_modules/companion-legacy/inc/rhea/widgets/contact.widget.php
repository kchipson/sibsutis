<?php
class Rhea_Contact_Company extends WP_Widget {

	public function __construct() {

		$widget_args = array(
			'description' => esc_html__( 'This widget is designed for footer area', 'themeisle-companion' ),
		);

		parent::__construct( 'rhea-contact-company', esc_html__( '[Rhea] Contact', 'themeisle-companion' ), $widget_args );
	}

	function widget( $args, $instance ) {

		extract( $args );

		if ( ! empty( $before_widget ) ) {
			echo $before_widget;
		}

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		echo '<div class="rhea_company_contact">';
		if ( ! empty( $instance['adress'] ) ) {

			if ( ! empty( $instance['gmaps_url'] ) ) {
				echo '<p><a href="' . esc_url( $instance['gmaps_url'] ) . '" target="_blank">' . esc_html( $instance['adress'] ) . '</a></p>';
			} else {
				echo '<p>' . esc_html( $instance['adress'] ) . '</p>';
			}
		}
		if ( ! empty( $instance['email'] ) ) {
			echo '<p>Email: <a href="mailto:' . antispambot( $instance['email'] ) . '">' . antispambot( $instance['email'] ) . '</a></p>';
		}
		if ( ! empty( $instance['phone'] ) ) {
			echo '<p>Phone: ' . esc_html( $instance['phone'] ) . '</p>';
		}
		echo '</div>';

		if ( ! empty( $after_widget ) ) {
			echo $after_widget;
		}

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['adress'] = strip_tags( $new_instance['adress'] );
		$instance['gmaps_url'] = esc_url( $new_instance['gmaps_url'] );
		$instance['email'] = strip_tags( $new_instance['email'] );
		$instance['phone'] = strip_tags( $new_instance['phone'] );

		return $instance;

	}

	function form( $instance ) {
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title', 'themeisle-companion' ); ?></label><br/>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php if ( ! empty( $instance['title'] ) ) { echo $instance['title']; } ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'adress' ); ?>"><?php esc_html_e( 'Company Adress', 'themeisle-companion' ); ?></label><br/>
			<textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name( 'adress' ); ?>" id="<?php echo $this->get_field_id( 'adress' ); ?>"><?php if ( ! empty( $instance['adress'] ) ) { echo htmlspecialchars_decode( $instance['adress'] ); } ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'gmaps_url' ); ?>"><?php esc_html_e( 'Google Maps URL', 'themeisle-companion' ); ?></label><br/>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'gmaps_url' ); ?>" id="<?php echo $this->get_field_id( 'gmaps_url' ); ?>" value="<?php if ( ! empty( $instance['gmaps_url'] ) ) { echo $instance['gmaps_url']; } ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php esc_html_e( 'Email', 'themeisle-companion' ); ?></label><br/>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'email' ); ?>" id="<?php echo $this->get_field_id( 'email' ); ?>" value="<?php if ( ! empty( $instance['email'] ) ) { echo $instance['email']; } ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php esc_html_e( 'Phone', 'themeisle-companion' ); ?></label><br/>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'phone' ); ?>" id="<?php echo $this->get_field_id( 'phone' ); ?>" value="<?php if ( ! empty( $instance['phone'] ) ) { echo $instance['phone']; } ?>">
		</p>

		<?php

	}

}
