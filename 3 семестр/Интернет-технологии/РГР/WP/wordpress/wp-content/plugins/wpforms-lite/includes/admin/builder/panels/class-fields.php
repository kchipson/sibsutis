<?php

/**
 * Fields management panel.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */
class WPForms_Builder_Panel_Fields extends WPForms_Builder_Panel {

	/**
	 * All systems go.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		// Define panel information.
		$this->name    = esc_html__( 'Fields', 'wpforms-lite' );
		$this->slug    = 'fields';
		$this->icon    = 'fa-list-alt';
		$this->order   = 10;
		$this->sidebar = true;

		if ( $this->form ) {
			add_action( 'wpforms_builder_fields', array( $this, 'fields' ) );
			add_action( 'wpforms_builder_fields_options', array( $this, 'fields_options' ) );
			add_action( 'wpforms_builder_preview', array( $this, 'preview' ) );

			// Template for form builder previews.
			add_action( 'wpforms_builder_print_footer_scripts', array( $this, 'field_preview_templates' ) );
		}
	}

	/**
	 * Enqueue assets for the Fields panel.
	 *
	 * @since 1.0.0
	 */
	public function enqueues() {

		// CSS.
		wp_enqueue_style(
			'wpforms-builder-fields',
			WPFORMS_PLUGIN_URL . 'assets/css/admin-builder-fields.css',
			null,
			WPFORMS_VERSION
		);
	}

	/**
	 * Outputs the Field panel sidebar.
	 *
	 * @since 1.0.0
	 */
	public function panel_sidebar() {

		// Sidebar contents are not valid unless we have a form.
		if ( ! $this->form ) {
			return;
		}
		?>
		<ul class="wpforms-tabs wpforms-clear">

			<li class="wpforms-tab" id="add-fields">
				<a href="#" class="active">
					<?php esc_html_e( 'Add Fields', 'wpforms-lite' ); ?>
					<i class="fa fa-angle-down"></i>
				</a>
			</li>

			<li class="wpforms-tab" id="field-options">
				<a href="#">
					<?php esc_html_e( 'Field Options', 'wpforms-lite' ); ?>
					<i class="fa fa-angle-right"></i>
				</a>
			</li>

		</ul>

		<div class="wpforms-add-fields wpforms-tab-content">
			<?php do_action( 'wpforms_builder_fields', $this->form ); ?>
		</div>

		<div id="wpforms-field-options" class="wpforms-field-options wpforms-tab-content">
			<?php do_action( 'wpforms_builder_fields_options', $this->form ); ?>
		</div>
		<?php
	}

	/**
	 * Outputs the Field panel primary content.
	 *
	 * @since 1.0.0
	 */
	public function panel_content() {

		// Check if there is a form created.
		if ( ! $this->form ) {
			echo '<div class="wpforms-alert wpforms-alert-info">';
			echo wp_kses(
				__( 'You need to <a href="#" class="wpforms-panel-switch" data-panel="setup">setup your form</a> before you can manage the fields.', 'wpforms-lite' ),
				array(
					'a' => array(
						'href'       => array(),
						'class'      => array(),
						'data-panel' => array(),
					),
				)
			);
			echo '</div>';

			return;
		}

		?>

		<div class="wpforms-preview-wrap">

			<div class="wpforms-preview">

				<div class="wpforms-title-desc">
					<h2 class="wpforms-form-name"><?php echo esc_html( $this->form->post_title ); ?></h2>
					<span class="wpforms-form-desc"><?php echo $this->form->post_excerpt; ?></span>
				</div>

				<div class="wpforms-field-wrap">
					<?php do_action( 'wpforms_builder_preview', $this->form ); ?>
				</div>

				<div class="wpforms-field-recaptcha">
					<div class="wpforms-field-recaptcha-wrap">
						<div class="wpforms-field-recaptcha-wrap-l">
							<svg class="wpforms-field-recaptcha-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 27.918"><path d="M28 13.943l-.016-.607V2l-3.133 3.134a13.983 13.983 0 00-21.964.394l5.134 5.183a6.766 6.766 0 012.083-2.329A6.171 6.171 0 0114.025 7.1a1.778 1.778 0 01.492.066 6.719 6.719 0 015.17 3.119l-3.625 3.641 11.941.016" fill="#1c3aa9"/><path d="M13.943 0l-.607.016H2.018l3.133 3.133a13.969 13.969 0 00.377 21.964l5.183-5.134A6.766 6.766 0 018.382 17.9 6.171 6.171 0 017.1 13.975a1.778 1.778 0 01.066-.492 6.719 6.719 0 013.117-5.167l3.641 3.641L13.943 0" fill="#4285f4"/><path d="M0 13.975l.016.607v11.334l3.133-3.133a13.983 13.983 0 0021.964-.394l-5.134-5.183a6.766 6.766 0 01-2.079 2.33 6.171 6.171 0 01-3.92 1.279 1.778 1.778 0 01-.492-.066 6.719 6.719 0 01-5.167-3.117l3.641-3.641c-4.626 0-9.825.016-11.958-.016" fill="#ababab"/></svg>
						</div>
						<div class="wpforms-field-recaptcha-wrap-r">
							<p class="wpforms-field-recaptcha-title"><?php esc_html_e( 'reCAPTCHA', 'wpforms-lite' ); ?></p>
							<p class="wpforms-field-recaptcha-desc">
								<span class="wpforms-field-recaptcha-desc-txt"><?php esc_html_e( 'Enabled', 'wpforms-lite' ); ?></span>&nbsp;<svg class="wpforms-field-recaptcha-desc-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M512 256c0-37.7-23.7-69.9-57.1-82.4 14.7-32.4 8.8-71.9-17.9-98.6-26.7-26.7-66.2-32.6-98.6-17.9C325.9 23.7 293.7 0 256 0s-69.9 23.7-82.4 57.1c-32.4-14.7-72-8.8-98.6 17.9-26.7 26.7-32.6 66.2-17.9 98.6C23.7 186.1 0 218.3 0 256s23.7 69.9 57.1 82.4c-14.7 32.4-8.8 72 17.9 98.6 26.6 26.6 66.1 32.7 98.6 17.9 12.5 33.3 44.7 57.1 82.4 57.1s69.9-23.7 82.4-57.1c32.6 14.8 72 8.7 98.6-17.9 26.7-26.7 32.6-66.2 17.9-98.6 33.4-12.5 57.1-44.7 57.1-82.4zm-144.8-44.25L236.16 341.74c-4.31 4.28-11.28 4.25-15.55-.06l-75.72-76.33c-4.28-4.31-4.25-11.28.06-15.56l26.03-25.82c4.31-4.28 11.28-4.25 15.56.06l42.15 42.49 97.2-96.42c4.31-4.28 11.28-4.25 15.55.06l25.82 26.03c4.28 4.32 4.26 11.29-.06 15.56z"></path></svg>
							</p>
						</div>
					</div>
				</div>

				<?php
				$submit = ! empty( $this->form_data['settings']['submit_text'] ) ? $this->form_data['settings']['submit_text'] : esc_html__( 'Submit', 'wpforms-lite' );
				printf( '<p class="wpforms-field-submit"><input type="submit" value="%s" class="wpforms-field-submit-button"></p>', esc_attr( $submit ) );
				?>

				<?php wpforms_debug_data( $this->form_data ); ?>
			</div>

		</div>

		<?php
	}

	/**
	 * Builder field buttons.
	 *
	 * @since 1.0.0
	 */
	public function fields() {

		$fields = array(
			'standard' => array(
				'group_name' => esc_html__( 'Standard Fields', 'wpforms-lite' ),
				'fields'     => array(),
			),
			'fancy'    => array(
				'group_name' => esc_html__( 'Fancy Fields', 'wpforms-lite' ),
				'fields'     => array(),
			),
			'payment'  => array(
				'group_name' => esc_html__( 'Payment Fields', 'wpforms-lite' ),
				'fields'     => array(),
			),
		);
		$fields = apply_filters( 'wpforms_builder_fields_buttons', $fields );

		// Output the buttons.
		foreach ( $fields as $id => $group ) {

			usort( $group['fields'], array( $this, 'field_order' ) );

			echo '<div class="wpforms-add-fields-group">';

			echo '<a href="#" class="wpforms-add-fields-heading" data-group="' . esc_attr( $id ) . '">';

			echo '<span>' . esc_html( $group['group_name'] ) . '</span>';

			echo '<i class="fa fa-angle-down"></i>';

			echo '</a>';

			echo '<div class="wpforms-add-fields-buttons">';

			foreach ( $group['fields'] as $field ) {

				$atts = apply_filters( 'wpforms_builder_field_button_attributes', array(
					'id'    => 'wpforms-add-fields-' . $field['type'],
					'class' => array( 'wpforms-add-fields-button' ),
					'data'  => array(
						'field-type' => $field['type'],
					),
					'atts'  => array(),
				), $field, $this->form_data );

				if ( ! empty( $field['class'] ) ) {
					$atts['class'][] = $field['class'];
				}

				echo '<button ' . wpforms_html_attributes( $atts['id'], $atts['class'], $atts['data'], $atts['atts'] ) . '>';
					if ( $field['icon'] ) {
						echo '<i class="fa ' . esc_attr( $field['icon'] ) . '"></i> ';
					}
					echo esc_html( $field['name'] );
				echo '</button>';
			}

			echo '</div>';

			echo '</div>';
		}
	}

	/**
	 * Editor Field Options.
	 *
	 * @since 1.0.0
	 */
	public function fields_options() {

		// Check to make sure the form actually has fields created already.
		if ( empty( $this->form_data['fields'] ) ) {
			printf( '<p class="no-fields">%s</p>', esc_html__( 'You don\'t have any fields yet.', 'wpforms-lite' ) );

			return;
		}

		$fields = $this->form_data['fields'];

		foreach ( $fields as $field ) {

			$class = apply_filters( 'wpforms_builder_field_option_class', '', $field );

			printf( '<div class="wpforms-field-option wpforms-field-option-%s %s" id="wpforms-field-option-%d" data-field-id="%d">', esc_attr( $field['type'] ), $class, $field['id'], $field['id'] );

			printf( '<input type="hidden" name="fields[%d][id]" value="%d" class="wpforms-field-option-hidden-id">', $field['id'], $field['id'] );

			printf( '<input type="hidden" name="fields[%d][type]" value="%s" class="wpforms-field-option-hidden-type">', $field['id'], esc_attr( $field['type'] ) );

			do_action( "wpforms_builder_fields_options_{$field['type']}", $field );

			echo '</div>';
		}
	}

	/**
	 * Editor preview (right pane).
	 *
	 * @since 1.0.0
	 */
	public function preview() {

		// Check to make sure the form actually has fields created already.
		if ( empty( $this->form_data['fields'] ) ) {
			printf( '<p class="no-fields-preview">%s</p>', esc_html__( 'You don\'t have any fields yet. Add some!', 'wpforms-lite' ) );

			return;
		}

		$fields = $this->form_data['fields'];

		foreach ( $fields as $field ) {

			$css  = ! empty( $field['size'] ) ? 'size-' . esc_attr( $field['size'] ) : '';
			$css .= ! empty( $field['label_hide'] ) && $field['label_hide'] == '1' ? ' label_hide' : '';
			$css .= ! empty( $field['sublabel_hide'] ) && $field['sublabel_hide'] == '1' ? ' sublabel_hide' : '';
			$css .= ! empty( $field['required'] ) && $field['required'] == '1' ? ' required' : '';
			$css .= ! empty( $field['input_columns'] ) && $field['input_columns'] === '2' ? ' wpforms-list-2-columns' : '';
			$css .= ! empty( $field['input_columns'] ) && $field['input_columns'] === '3' ? ' wpforms-list-3-columns' : '';
			$css .= ! empty( $field['input_columns'] ) && $field['input_columns'] === 'inline' ? ' wpforms-list-inline' : '';
			$css .= isset( $field['meta']['delete'] ) && $field['meta']['delete'] === false ? ' no-delete' : '';

			$css = apply_filters( 'wpforms_field_preview_class', $css, $field );

			printf( '<div class="wpforms-field wpforms-field-%s %s" id="wpforms-field-%d" data-field-id="%d" data-field-type="%s">', $field['type'], $css, $field['id'], $field['id'], $field['type'] );

			if ( apply_filters( 'wpforms_field_preview_display_duplicate_button', true, $field, $this->form_data ) ) {
				printf( '<a href="#" class="wpforms-field-duplicate" title="%s"><i class="fa fa-files-o" aria-hidden="true"></i></a>', esc_html__( 'Duplicate Field', 'wpforms-lite' ) );
			}

			printf( '<a href="#" class="wpforms-field-delete" title="%s"><i class="fa fa-trash" aria-hidden="true"></i></a>', esc_html__( 'Delete Field', 'wpforms-lite' ) );

			printf( '<span class="wpforms-field-helper">%s</span>', esc_html__( 'Click to edit. Drag to reorder.', 'wpforms-lite' ) );

			do_action( "wpforms_builder_fields_previews_{$field['type']}", $field );

			echo '</div>';
		}
	}

	/**
	 * Sort Add Field buttons by order provided.
	 *
	 * @since 1.0.0
	 *
	 * @param array $a
	 * @param array $b
	 *
	 * @return array
	 */
	public function field_order( $a, $b ) {
		return $a['order'] - $b['order'];
	}

	/**
	 * Template for form builder preview.
	 *
	 * @since 1.4.5
	 */
	public function field_preview_templates() {

		// Checkbox, Radio, and Payment Multiple/Checkbox field choices.
		?>
		<script type="text/html" id="tmpl-wpforms-field-preview-checkbox-radio-payment-multiple">
			<# if ( data.settings.choices_images ) { #>
			<ul class="primary-input wpforms-image-choices wpforms-image-choices-{{ data.settings.choices_images_style }}">
				<# _.each( data.order, function( choiceID, key ) {  #>
				<li class="wpforms-image-choices-item<# if ( 1 === data.settings.choices[choiceID].default ) { print( ' wpforms-selected' ); } #>">
					<label>
						<span class="wpforms-image-choices-image">
							<# if ( ! _.isEmpty( data.settings.choices[choiceID].image ) ) { #>
							<img src="{{ data.settings.choices[choiceID].image }}" alt="{{ data.settings.choices[choiceID].label }}"<# if ( data.settings.choices[choiceID].label ) { print( ' title="{{ data.settings.choices[choiceID].label }}"' ); } #>>
							<# } else { #>
							<img src="{{ wpforms_builder.image_placeholder }}" alt="{{ data.settings.choices[choiceID].label }}"<# if ( data.settings.choices[choiceID].label ) { print( ' title="{{ data.settings.choices[choiceID].label }}"' ); } #>>
							<# } #>
						</span>
						<# if ( 'none' === data.settings.choices_images_style ) { #>
							<br>
							<input type="{{ data.type }}" disabled<# if ( 1 === data.settings.choices[choiceID].default ) { print( ' checked' ); } #>>
						<# } else { #>
							<input class="wpforms-screen-reader-element" type="{{ data.type }}" disabled<# if ( 1 === data.settings.choices[choiceID].default ) { print( ' checked' ); } #>>
						<# } #>
						<span class="wpforms-image-choices-label">{{{ data.settings.choices[choiceID].label }}}</span>
					</label>
				</li>
				<# }) #>
			</ul>
			<# } else { #>
			<ul class="primary-input">
				<# _.each( data.order, function( choiceID, key ) {  #>
				<li>
					<input type="{{ data.type }}" disabled<# if ( 1 === data.settings.choices[choiceID].default ) { print( ' checked' ); } #>>{{{ data.settings.choices[choiceID].label }}}
				</li>
				<# }) #>
			</ul>
			<# } #>
		</script>
		<?php
	}

}

new WPForms_Builder_Panel_Fields();
