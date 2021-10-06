<?php
/**
 * The View for Rendering the Template Directory Main Dashboard Page.
 *
 * @link       https://themeisle.com
 * @since      2.0.0
 *
 * @package    ThemeIsle
 * @subpackage ThemeIsle/PageTemplatesDirectory
 * @codeCoverageIgnore
 */

$preview_url = add_query_arg( 'obfx_templates', '', home_url() ); // Define query arg for custom endpoint.

$html = '';

if ( is_array( $templates_array ) ) { ?>
	<div class="obfx-template-dir wrap">

        <h2 class="wp-heading-inline"> <?php echo apply_filters( 'obfx_template_dir_page_title', __( 'Orbit Fox Template Directory', 'themeisle-companion' ) ); ?></h2>
        <button id="obfx-template-dir-fetch-templates" class="button-primary button"><i class="dashicons dashicons-update"></i><?php echo __( 'Sync Templates', 'themeisle-companion' ); ?></button>
        <div class="obfx-template-browser">
			<?php
			foreach ( $templates_array as $template => $properties ) {
				?>
				<div class="obfx-template">
					<?php if ( isset( $properties['has_badge'] ) ) { ?>
						<span class="badge"><?php echo esc_html( $properties['has_badge'] ); ?></span>
					<?php } ?>
					<div class="more-details obfx-preview-template"
						 data-demo-url="<?php echo esc_url( $properties['demo_url'] ); ?>"
						 data-template-slug="<?php echo esc_attr( $template ); ?>">
						<span><?php echo __( 'More Details', 'themeisle-companion' ); ?></span></div>
					<div class="obfx-template-screenshot">
						<img src="<?php echo esc_url( $properties['screenshot'] ); ?>"
							 alt="<?php echo esc_html( $properties['title'] ); ?>">
					</div>
					<h2 class="template-name template-header"><?php echo esc_html( $properties['title'] ); ?></h2>
					<div class="obfx-template-actions">

						<?php if ( ! empty( $properties['demo_url'] ) ) { ?>
							<a class="button obfx-preview-template"
							   data-demo-url="<?php echo esc_url( $properties['demo_url'] ); ?>"
							   data-template-slug="<?php echo esc_attr( $template ); ?>"><?php echo __( 'Preview', 'themeisle-companion' ); ?></a>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<div class="wp-clearfix clearfix"></div>
<?php } // End if().
?>

<div class="obfx-template-preview theme-install-overlay wp-full-overlay expanded" style="display: none;">
	<div class="wp-full-overlay-sidebar">
		<div class="wp-full-overlay-header">
			<button class="close-full-overlay"><span
						class="screen-reader-text"><?php esc_html_e( 'Close', 'themeisle-companion' ); ?></span></button>
			<div class="obfx-next-prev">
				<button class="previous-theme"><span
							class="screen-reader-text"><?php esc_html_e( 'Previous', 'themeisle-companion' ); ?></span></button>
				<button class="next-theme"><span
							class="screen-reader-text"><?php esc_html_e( 'Next', 'themeisle-companion' ); ?></span></button>
			</div>
			<span class="obfx-import-template button button-primary"><?php esc_html_e( 'Import', 'themeisle-companion' ); ?></span>
			<a href="https://themeisle.com/plugins/sizzify-elementor-addons-templates" target="_blank"
  class="obfx-upsell-button button button-primary"><?php esc_html_e( 'See Pro Version', 'themeisle-companion' ); ?></a>

		</div>
		<div class="wp-full-overlay-sidebar-content">
			<?php
			foreach ( $templates_array as $template => $properties ) {
				$upsell = 'no';
				if ( isset( $properties['has_badge'] ) && ! isset( $properties['import_file'] ) ) {
					$upsell = 'yes';
					$properties['import_file'] = '';
				}
				?>
				<div class="install-theme-info obfx-theme-info <?php echo esc_attr( $template ); ?>"
					 data-demo-url="<?php echo esc_url( $properties['demo_url'] ); ?>"
                     <?php if( isset( $properties['import_file'] ) ) { ?>
					 data-template-file="<?php echo esc_url( $properties['import_file'] ); ?>"
					<?php  } ?>
                     data-template-title="<?php echo esc_html( $properties['title'] ); ?>"
					 data-upsell="<?php echo esc_attr( $upsell ) ?>">
					<h3 class="theme-name"><?php echo esc_html( $properties['title'] ); ?></h3>
					<div class="obfx-preview-wrap">
						<img class="theme-screenshot" src="<?php echo esc_url( $properties['screenshot'] ); ?>"
							 alt="<?php echo esc_html( $properties['title'] ); ?>">
						<?php if ( isset( $properties['has_badge'] ) ) { ?>
							<span class="badge"> <?php echo esc_html( $properties['has_badge'] ); ?></span>
						<?php } ?>
					</div>
					<div class="theme-details">
						<?php echo esc_html( $properties['description'] ); ?>
					</div>
					<?php
					if ( ! empty( $properties['required_plugins'] ) && is_array( $properties['required_plugins'] ) ) { ?>
						<div class="obfx-required-plugins">
							<p><?php esc_html_e( 'Required Plugins', 'themeisle-companion' ); ?></p>
							<?php
							foreach ( $properties['required_plugins'] as $plugin_slug => $details ) {
								if ( $this->check_plugin_state( $plugin_slug ) === 'install' ) {
									echo '<div class="obfx-installable plugin-card-' . esc_attr( $plugin_slug ) . '">';
									echo '<span class="dashicons dashicons-no-alt"></span>';
									echo $details['title'];
									echo $this->get_button_html( $plugin_slug );
									echo '</div>';
								} elseif ( $this->check_plugin_state( $plugin_slug ) === 'activate' ) {
									echo '<div class="obfx-activate plugin-card-' . esc_attr( $plugin_slug ) . '">';
									echo '<span class="dashicons dashicons-admin-plugins" style="color: #ffb227;"></span>';
									echo $details['title'];
									echo $this->get_button_html( $plugin_slug );
									echo '</div>';
								} else {
									echo '<div class="obfx-installed plugin-card-' . esc_attr( $plugin_slug ) . '">';
									echo '<span class="dashicons dashicons-yes" style="color: #34a85e"></span>';
									echo $details['title'];
									echo '</div>';
								}
							} ?>
						</div>
					<?php } ?>
				</div><!-- /.install-theme-info -->
			<?php } ?>
		</div>

		<div class="wp-full-overlay-footer">
			<button type="button" class="collapse-sidebar button" aria-expanded="true" aria-label="Collapse Sidebar">
				<span class="collapse-sidebar-arrow"></span>
				<span class="collapse-sidebar-label"><?php esc_html_e( 'Collapse', 'themeisle-companion' ); ?></span>
			</button>
			<div class="devices-wrapper">
				<div class="devices obfx-responsive-preview">
					<button type="button" class="preview-desktop active" aria-pressed="true" data-device="desktop">
						<span class="screen-reader-text"><?php esc_html_e( 'Enter desktop preview mode', 'themeisle-companion' ); ?></span>
					</button>
					<button type="button" class="preview-tablet" aria-pressed="false" data-device="tablet">
						<span class="screen-reader-text"><?php esc_html_e( 'Enter tablet preview mode', 'themeisle-companion' ); ?></span>
					</button>
					<button type="button" class="preview-mobile" aria-pressed="false" data-device="mobile">
						<span class="screen-reader-text"><?php esc_html_e( 'Enter mobile preview mode', 'themeisle-companion' ); ?></span>
					</button>
				</div>
			</div>

		</div>
	</div>
	<div class="wp-full-overlay-main obfx-main-preview">
		<iframe src="" title="Preview" class="obfx-template-frame"></iframe>
	</div>
</div>
