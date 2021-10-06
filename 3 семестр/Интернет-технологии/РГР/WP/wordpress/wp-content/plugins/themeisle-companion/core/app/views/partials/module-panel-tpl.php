<?php
/**
 * Panel modules template.
 * Imported via the Orbit_Fox_Render_Helper.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Orbit_Fox
 * @subpackage Orbit_Fox/app/views/partials
 */

if ( ! isset( $slug ) ) {
	$slug = '';
}
$noance = wp_create_nonce( 'obfx_update_module_options_' . $slug );

if ( ! isset( $active ) ) {
	$active = false;
}

if ( ! isset( $name ) ) {
	$name = __( 'The Module Name', 'themeisle-companion' );
}

if ( ! isset( $description ) ) {
	$description = __( 'The Module Description ...', 'themeisle-companion' );
}

if ( ! isset( $options_fields ) ) {
	$options_fields = __( 'No options provided.', 'themeisle-companion' );
}
$styles          = array();
$disabled_fields = '';
if ( ! $active ) {
	$styles []       = 'display: none';
	$disabled_fields = 'disabled';
}
$btn_class = '';
if ( isset( $show ) && $show ) {
	$btn_class = 'active';

}
$styles = sprintf( 'style="%s"', implode( ':', $styles ) );

?>
<div id="obfx-mod-<?php echo $slug; ?>" class="panel options <?php echo esc_attr( $btn_class ); ?>" <?php echo $styles; ?>>
	<div class="panel-header">
		<button class="btn btn-action circle btn-expand <?php echo esc_attr( $btn_class ); ?>"
				style="float: right; margin-right: 10px;">
			<i class="dashicons dashicons-arrow-down-alt2"></i>
		</button>
		<div class="panel-title"><?php echo $name; ?></div>
		<div class="panel-subtitle"><?php echo $description; ?></div>
		<div class="obfx-mod-toast toast" style="display: none;">
			<button class="obfx-toast-dismiss btn btn-clear float-right"></button>
			<span>Mock text for Toast Element</span>
		</div>
	</div>
	<form id="obfx-module-form-<?php echo $slug; ?>" class="obfx-module-form <?php echo esc_attr( $btn_class ); ?> ">
		<fieldset <?php echo $disabled_fields; ?> >
			<input type="hidden" name="module-slug" value="<?php echo $slug; ?>">
			<input type="hidden" name="noance" value="<?php echo $noance; ?>">
			<div class="panel-body">
				<?php echo $options_fields; ?>
				<div class="divider"></div>
			</div>
			<?php if ( isset( $no_save ) && $no_save === false ) : ?>
			<div class="panel-footer text-right">
				<button class="btn obfx-mod-btn-cancel" disabled>Cancel</button>
				<button type="submit" class="btn btn-primary obfx-mod-btn-save" disabled>Save</button>
			</div>
			<?php endif; ?>
		</fieldset>
	</form>
</div>
