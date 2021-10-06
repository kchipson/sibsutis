<?php

/**
 * Setup panel.
 *
 * @package    WPForms
 * @author     WPForms
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2016, WPForms LLC
 */
class WPForms_Builder_Panel_Setup extends WPForms_Builder_Panel {

	/**
	 * All systems go.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		// Define panel information.
		$this->name  = esc_html__( 'Setup', 'wpforms-lite' );
		$this->slug  = 'setup';
		$this->icon  = 'fa-cog';
		$this->order = 5;
	}

	/**
	 * Enqueue assets for the builder.
	 *
	 * @since 1.0.0
	 */
	public function enqueues() {

		// CSS.
		wp_enqueue_style(
			'wpforms-builder-setup',
			WPFORMS_PLUGIN_URL . 'assets/css/admin-builder-setup.css',
			null,
			WPFORMS_VERSION
		);
	}

	/**
	 * Outputs the Settings panel primary content.
	 *
	 * @since 1.0.0
	 */
	public function panel_content() {

		$core_templates       = apply_filters( 'wpforms_form_templates_core', array() );
		$additional_templates = apply_filters( 'wpforms_form_templates', array() );
		$additional_count     = count( $additional_templates );
		?>
		<div id="wpforms-setup-form-name">
			<span><?php esc_html_e( 'Form Name', 'wpforms-lite' ); ?></span>
			<input type="text" id="wpforms-setup-name" placeholder="<?php esc_attr_e( 'Enter your form name here&hellip;', 'wpforms-lite' ); ?>">
		</div>

		<div class="wpforms-setup-title core">
			<?php esc_html_e( 'Select a Template', 'wpforms-lite' ); ?>
		</div>

		<p class="wpforms-setup-desc core">
			<?php
			echo wp_kses(
				__( 'To speed up the process, you can select from one of our pre-made templates or start with a <strong><a href="#" class="wpforms-trigger-blank">blank form.</a></strong>', 'wpforms-lite' ),
				array(
					'strong' => array(),
					'a'      => array(
						'href'  => array(),
						'class' => array(),
					),
				)
			);
			?>
		</p>

		<?php $this->template_select_options( $core_templates, 'core' ); ?>

		<div class="wpforms-setup-title additional">
			<?php esc_html_e( 'Additional Templates', 'wpforms-lite' ); ?>
			<?php echo ! empty( $additional_count ) ? '<span class="count">(' . $additional_count . ')</span>' : ''; ?>
		</div>

		<?php if ( ! empty( $additional_count ) ) : ?>

			<p class="wpforms-setup-desc additional">
				<?php
				printf(
					wp_kses(
						/* translators: %1$s - WPForms.com URL to a template suggestion, %2$s - WPForms.com URL to a doc about custom templates. */
						__( 'Have a suggestion for a new template? <a href="%1$s" target="_blank" rel="noopener noreferrer">We\'d love to hear it</a>. Also, you can <a href="%2$s" target="_blank" rel="noopener noreferrer">create your own templates</a>!', 'wpforms-lite' ),
						array(
							'a' => array(
								'href'   => array(),
								'target' => array(),
								'rel'    => array(),
							),
						)
					),
					'https://wpforms.com/form-template-suggestion/',
					'https://wpforms.com/docs/how-to-create-a-custom-form-template/'
				);
				?>
			</p>

			<div class="wpforms-setup-template-search-wrap">
				<i class="fa fa-search" aria-hidden="true"></i>
				<input type="text" id="wpforms-setup-template-search" value="" placeholder="<?php esc_attr_e( 'Search additional templates...', 'wpforms-lite' ); ?>">
			</div>

			<?php $this->template_select_options( $additional_templates, 'additional' ); ?>

		<?php else : ?>

			<p class="wpforms-setup-desc additional">
				<?php
				printf(
					wp_kses(
						/* translators: %1$s - WPForms.com URL to an addon page, %2$s - WPForms.com URL to a docs article. */
						__( 'More are available in the <a href="%1$s" target="_blank" rel="noopener noreferrer">Form Templates Pack addon</a> or by <a href="%2$s" target="_blank" rel="noopener noreferrer">creating your own</a>.', 'wpforms-lite' ),
						array(
							'a' => array(
								'href'   => array(),
								'target' => array(),
								'rel'    => array(),
							),
						)
					),
					'https://wpforms.com/addons/form-templates-pack-addon/',
					'https://wpforms.com/docs/how-to-create-a-custom-form-template/'
				);
				?>
			</p>

		<?php
		endif;
		do_action( 'wpforms_setup_panel_after' );
	}

	/**
	 * Generate a block of templates to choose from.
	 *
	 * @since 1.4.0
	 *
	 * @param array $templates
	 * @param string $slug
	 */
	public function template_select_options( $templates, $slug ) {

		if ( ! empty( $templates ) ) {

			echo '<div id="wpforms-setup-templates-' . $slug . '" class="wpforms-setup-templates ' . $slug . ' wpforms-clear">';

			echo '<div class="list">';

			// Loop through each available template.
			foreach ( $templates as $template ) {

				$selected = ! empty( $this->form_data['meta']['template'] ) && $this->form_data['meta']['template'] === $template['slug'] ? true : false;
				?>
				<div class="wpforms-template <?php echo $selected ? 'selected' : ''; ?>"
					id="wpforms-template-<?php echo sanitize_html_class( $template['slug'] ); ?>">

					<div class="wpforms-template-inner">

						<div class="wpforms-template-name wpforms-clear">
							<?php echo esc_html( $template['name'] ); ?>
							<?php echo $selected ? '<span class="selected">' . esc_html__( 'Selected', 'wpforms-lite' ) . '</span>' : ''; ?>
						</div>

						<?php if ( ! empty( $template['description'] ) ) : ?>
							<div class="wpforms-template-details">
								<p class="desc"><?php echo esc_html( $template['description'] ); ?></p>
							</div>
						<?php endif; ?>

						<?php
						$template_name = sprintf(
							/* translators: %s - Form template name. */
							esc_html__( '%s template', 'wpforms-lite' ),
							$template['name']
						);
						?>

						<div class="wpforms-template-overlay">
							<a href="#" class="wpforms-template-select"
								data-template-name-raw="<?php echo esc_attr( $template['name'] ); ?>"
								data-template-name="<?php echo esc_attr( $template_name ); ?>"
								data-template="<?php echo esc_attr( $template['slug'] ); ?>">
								<?php
								printf(
									/* translators: %s - Form template name. */
									esc_html__( 'Create a %s', 'wpforms-lite' ),
									$template['name']
								);
								?>
							</a>
						</div>

					</div>

				</div>
				<?php
			}

			echo '</div>';

			echo '</div>';
		}
	}
}

new WPForms_Builder_Panel_Setup;
