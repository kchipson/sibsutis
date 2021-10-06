<?php

namespace WPForms\Providers\Provider\Settings;

use WPForms\Providers\Provider\Core;
use WPForms\Providers\Provider\Status;

/**
 * Class FormBuilder handles functionality inside the form builder.
 *
 * @package    WPForms\Providers\Provider\Settings
 * @author     WPForms
 * @since      1.4.7
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2018, WPForms LLC
 */
abstract class FormBuilder implements FormBuilderInterface {

	/**
	 * Get the Core loader class of a provider.
	 *
	 * @since 1.4.7
	 *
	 * @var Core
	 */
	protected $core;

	/**
	 * Most of Marketing providers will have 'connection' type.
	 * Payment providers may have (or not) something different.
	 *
	 * @since 1.4.7
	 *
	 * @var string
	 */
	protected $type = 'connection';

	/**
	 * Form data and settings.
	 *
	 * @since 1.4.7
	 *
	 * @var array
	 */
	protected $form_data = array();

	/**
	 * Integrations constructor.
	 *
	 * @since 1.4.7
	 *
	 * @param Core $core Core provider class.
	 */
	public function __construct( Core $core ) {

		$this->core = $core;

		if ( ! empty( $_GET['form_id'] ) ) { // phpcs:ignore
			$this->form_data = \wpforms()->form->get(
				\absint( $_GET['form_id'] ), // phpcs:ignore
				array(
					'content_only' => true,
				)
			);
		}

		$this->init_hooks();
	}

	/**
	 * Register all hooks (actions and filters) here.
	 *
	 * @since 1.4.7
	 */
	protected function init_hooks() {

		// Register builder HTML template(s).
		\add_action( 'wpforms_builder_print_footer_scripts', array( $this, 'builder_templates' ), 10 );
		\add_action( 'wpforms_builder_print_footer_scripts', array( $this, 'builder_custom_templates' ), 11 );

		// Process builder AJAX requests.
		\add_action( "wp_ajax_wpforms_builder_provider_ajax_{$this->core->slug}", array( $this, 'process_ajax' ) );

		/*
		 * Enqueue assets.
		 */
		if (
			( ! empty( $_GET['page'] ) && $_GET['page'] === 'wpforms-builder' ) && // phpcs:ignore
			! empty( $_GET['form_id'] ) && // phpcs:ignore
			\is_admin()
		) {
			\add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		}
	}

	/**
	 * Used to register generic templates for all providers inside form builder.
	 *
	 * @since 1.4.7
	 */
	public function builder_templates() {
		?>

		<!-- Single connection block sub-template: FIELDS -->
		<script type="text/html" id="tmpl-wpforms-providers-builder-content-connection-fields">
			<div class="wpforms-builder-provider-connection-block wpforms-builder-provider-connection-fields">

				<table class="wpforms-builder-provider-connection-fields-table">
					<thead>
						<tr>
							<th><?php \esc_html_e( 'Custom Field Name', 'wpforms-lite' ); ?></th>
							<th colspan="3"><?php \esc_html_e( 'Form Field Value', 'wpforms-lite' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<# if ( ! _.isEmpty( data.connection.fields_meta ) ) { #>
							<# _.each( data.connection.fields_meta, function( item, meta_id ) { #>
								<tr class="wpforms-builder-provider-connection-fields-table-row">
									<td>
										<input type="text" value="{{ item.name }}"
										       name="providers[<?php echo \esc_attr( $this->core->slug ); ?>][{{ data.connection.id }}][fields_meta][{{ meta_id }}][name]"
										       placeholder="<?php \esc_attr_e( 'Field Name', 'wpforms-lite' ); ?>"
										/>
									</td>
									<td>
										<select name="providers[<?php echo \esc_attr( $this->core->slug ); ?>][{{ data.connection.id }}][fields_meta][{{ meta_id }}][field_id]">
											<option value=""><?php \esc_html_e( '--- Select Field ---', 'wpforms-lite' ); ?></option>

											<# _.each( data.fields, function( field, key ) { #>
												<option value="{{ field.id }}"
														<# if ( field.id === item.field_id ) { #>selected="selected"<# } #>
												>
													{{ field.label }}
												</option>
											<# } ); #>
										</select>
									</td>
									<td class="add">
										<button class="button-secondary js-wpforms-builder-provider-connection-fields-add"
										        title="<?php \esc_attr_e( 'Add Another', 'wpforms-lite' ); ?>">
											<i class="fa fa-plus-circle"></i>
										</button>
									</td>
									<td class="delete">
										<button class="button js-wpforms-builder-provider-connection-fields-delete <# if ( meta_id === 0 ) { #>hidden<# } #>"
										        title="<?php \esc_attr_e( 'Remove', 'wpforms-lite' ); ?>">
											<i class="fa fa-minus-circle"></i>
										</button>
									</td>
								</tr>
							<# } ); #>
						<# } else { #>
							<tr class="wpforms-builder-provider-connection-fields-table-row">
								<td>
									<input type="text" value=""
									       name="providers[<?php echo \esc_attr( $this->core->slug ); ?>][{{ data.connection.id }}][fields_meta][0][name]"
									       placeholder="<?php \esc_attr_e( 'Field Name', 'wpforms-lite' ); ?>"
									/>
								</td>
								<td>
									<select name="providers[<?php echo \esc_attr( $this->core->slug ); ?>][{{ data.connection.id }}][fields_meta][0][field_id]">
										<option value=""><?php \esc_html_e( '--- Select Field ---', 'wpforms-lite' ); ?></option>

										<# _.each( data.fields, function( field, key ) { #>
											<option value="{{ field.id }}">
												{{ field.label }}
											</option>
										<# } ); #>
									</select>
								</td>
								<td class="add">
									<button class="button-secondary js-wpforms-builder-provider-connection-fields-add"
									        title="<?php \esc_attr_e( 'Add Another', 'wpforms-lite' ); ?>">
										<i class="fa fa-plus-circle"></i>
									</button>
								</td>
								<td class="delete">
									<button class="button js-wpforms-builder-provider-connection-fields-delete hidden"
									        title="<?php \esc_attr_e( 'Delete', 'wpforms-lite' ); ?>">
										<i class="fa fa-minus-circle"></i>
									</button>
								</td>
							</tr>
						<# } #>
					</tbody>
				</table><!-- /.wpforms-builder-provider-connection-fields-table -->

				<p class="description">
					<?php \esc_html_e( 'Map custom fields (or properties) to form fields values.', 'wpforms-lite' ); ?>
				</p>

			</div><!-- /.wpforms-builder-provider-connection-fields -->
		</script>

		<!-- Single connection block sub-template: CONDITIONAL LOGIC -->
		<script type="text/html" id="tmpl-wpforms-providers-builder-content-connection-conditionals">
			<?php
			echo wpforms_conditional_logic()->builder_block( // phpcs:ignore
				array(
					'form'       => $this->form_data,
					'type'       => 'panel',
					'parent'     => 'providers',
					'panel'      => esc_attr( $this->core->slug ),
					'subsection' => '%connection_id%',
					'reference'  => esc_html__( 'Marketing provider connection', 'wpforms-lite' ),
				),
				false
			);
			?>
		</script>
		<?php
	}

	/**
	 * Enqueue JavaScript and CSS files if needed.
	 * When extending - include the `parent::enqueue_assets();` not to break things!
	 *
	 * @since 1.4.7
	 */
	public function enqueue_assets() {

		$min = \wpforms_get_min_suffix();

		\wp_enqueue_script(
			'wpforms-admin-builder-templates',
			WPFORMS_PLUGIN_URL . "assets/js/components/admin/builder/templates{$min}.js",
			array( 'wp-util' ),
			WPFORMS_VERSION,
			true
		);

		\wp_enqueue_script(
			'wpforms-admin-builder-providers',
			WPFORMS_PLUGIN_URL . "assets/js/components/admin/builder/providers{$min}.js",
			array( 'wpforms-utils', 'wpforms-builder', 'wpforms-admin-builder-templates' ),
			WPFORMS_VERSION,
			true
		);
	}

	/**
	 * Process the Builder AJAX requests.
	 *
	 * @since 1.4.7
	 */
	public function process_ajax() {

		// Run a security check.
		\check_ajax_referer( 'wpforms-builder', 'nonce' );

		// Check for permissions.
		if ( ! \wpforms_current_user_can() ) {
			\wp_send_json_error(
				array(
					'error' => \esc_html__( 'You do not have permission to perform this action.', 'wpforms-lite' ),
				)
			);
		}

		// Process required values.
		$error = array( 'error' => \esc_html__( 'Something went wrong while performing an AJAX request.', 'wpforms-lite' ) );

		if (
			empty( $_POST['id'] ) ||
			empty( $_POST['task'] )
		) {
			\wp_send_json_error( $error );
		}

		$form_id = (int) $_POST['id'];
		$task    = \sanitize_key( $_POST['task'] );
		$data    = null;

		// Setup form data based on the ID, that we got from AJAX request.
		$this->form_data = \wpforms()->form->get(
			$form_id,
			array(
				'content_only' => true,
			)
		);

		// Do not allow to proceed further, as form_id may be incorrect.
		if ( empty( $this->form_data ) ) {
			\wp_send_json_error( $error );
		}

		$data = \apply_filters(
			'wpforms_providers_settings_builder_ajax_' . $task . '_' . $this->core->slug,
			null
		);

		if ( null !== $data ) {
			\wp_send_json_success( $data );
		}

		\wp_send_json_error( $error );
	}

	/**
	 * Display content inside the panel sidebar area.
	 *
	 * @since 1.4.7
	 */
	public function display_sidebar() {

		$configured = '';

		if ( ! empty( $this->form_data['id'] ) && Status::init( $this->core->slug )->is_ready( $this->form_data['id'] ) ) {
			$configured = 'configured';
		}

		$classes = array(
			'wpforms-panel-sidebar-section',
			'icon',
			$configured,
			'wpforms-panel-sidebar-section-' . $this->core->slug,
		);
		?>

		<a href="#" class="<?php echo \esc_attr( \implode( ' ', $classes ) ); ?>"
		   data-section="<?php echo \esc_attr( $this->core->slug ); ?>">

			<img src="<?php echo \esc_url( $this->core->icon ); ?>">

			<?php echo \esc_html( $this->core->name ); ?>

			<i class="fa fa-angle-right wpforms-toggle-arrow"></i>

			<?php if ( ! empty( $configured ) ) : ?>
				<i class="fa fa-check-circle-o"></i>
			<?php endif; ?>

		</a>

		<?php
	}

	/**
	 * Wraps the builder section content with the required (for tabs switching) markup.
	 *
	 * @since 1.4.7
	 */
	public function display_content() {
		?>

		<div class="wpforms-panel-content-section wpforms-builder-provider wpforms-panel-content-section-<?php echo \esc_attr( $this->core->slug ); ?>"
		     id="<?php echo \esc_attr( $this->core->slug ); ?>-provider">

			<!-- Provider content goes here. -->
			<?php $this->display_content_header(); ?>

			<div class="wpforms-builder-provider-body">
				<div class="wpforms-provider-connections-wrap wpforms-clear">
					<div class="wpforms-builder-provider-connections"></div>
				</div>
			</div>

		</div>

		<?php
	}

	/**
	 * Section content header.
	 *
	 * @since 1.4.7
	 */
	protected function display_content_header() {

		$is_configured = Status::init( $this->core->slug )->is_configured();
		?>

		<div class="wpforms-builder-provider-title">

			<?php echo \esc_html( $this->core->name ); ?>

			<span class="wpforms-builder-provider-title-spinner">
				<i class="fa fa-refresh fa-spin"></i>
			</span>

			<button class="wpforms-builder-provider-title-add js-wpforms-builder-provider-connection-add <?php echo $is_configured ? '' : 'hidden'; ?>"
			        data-form_id="<?php echo \absint( $_GET['form_id'] ); ?>"
			        data-provider="<?php echo \esc_attr( $this->core->slug ); ?>">
				<?php \esc_html_e( 'Add New Connection', 'wpforms-lite' ); ?>
			</button>

			<button class="wpforms-builder-provider-title-add js-wpforms-builder-provider-account-add <?php echo ! $is_configured ? '' : 'hidden'; ?>"
			        data-form_id="<?php echo \absint( $_GET['form_id'] ); ?>"
			        data-provider="<?php echo \esc_attr( $this->core->slug ); ?>">
				<?php \esc_html_e( 'Add New Account', 'wpforms-lite' ); ?>
			</button>

		</div>

		<?php
	}
}
