<?php
class rhea_features_block extends WP_Widget {

	public function __construct() {

		$widget_args = array(
			'description' => esc_html__( 'This widget is designed for Our focus section widgets', 'themeisle-companion' ),
		);
		parent::__construct( 'rhea-feature-block', esc_html__( '[Rhea] Our features widget', 'themeisle-companion' ), $widget_args );
	}

	function widget( $args, $instance ) {

		extract( $args );

		if ( ! empty( $before_widget ) ) {
			echo $before_widget;
		}

		$link = ! empty( $instance['link'] ) ? $instance['link'] : '#';
		?>

		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 focus-box" data-scrollreveal="enter bottom after 0.15s over 1s">
			<div class="service-block">
				<a href="<?php echo esc_url( $link ); ?>" class="service-url">

					<?php if ( ! empty( $instance['icon'] ) ) { ?>
						<span class="icon-holder"><i class="<?php echo esc_attr( $instance['icon'] ); ?>"></i></span>
					<?php } ?>
					<?php if ( ! empty( $instance['title'] ) ) { ?>
						<h3 class="service-title"><?php echo esc_html( $instance['title'] ); ?></h3>
					<?php } ?>
					<?php if ( ! empty( $instance['text'] ) ) { ?>
						<p class="service-title"><?php echo wp_kses_post( $instance['text'] ); ?></p>
					<?php } ?>

				</a>
			</div>
		</div>

		<?php

		if ( ! empty( $after_widget ) ) {
			echo $after_widget;
		}

	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['text'] = stripslashes( wp_filter_post_kses( $new_instance['text'] ) );
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		$instance['icon'] = strip_tags( $new_instance['icon'] );

		return $instance;

	}

	function form( $instance ) {
		$icon_holder_class = empty( $instance['icon'] ) ? ' empty-icon' : '';
		?>
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
			<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php esc_html_e( 'Text', 'themeisle-companion' ); ?></label><br/>
			<textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name( 'text' ); ?>" id="<?php echo $this->get_field_id( 'text' ); ?>"><?php if ( ! empty( $instance['text'] ) ) { echo htmlspecialchars_decode( $instance['text'] ); } ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php esc_html_e( 'Link','themeisle-companion' ); ?></label><br />
			<input type="text" name="<?php echo $this->get_field_name( 'link' ); ?>" id="<?php echo $this->get_field_id( 'link' ); ?>" value="<?php if ( ! empty( $instance['link'] ) ) { echo $instance['link']; } ?>" class="widefat">
		</p>

		<?php

	}

}
