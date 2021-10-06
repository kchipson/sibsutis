<?php
/**
 * The View Page for Orbit Fox Modules.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Orbit_Fox
 * @subpackage Orbit_Fox/app/views
 * @codeCoverageIgnore
 */

if ( ! isset( $no_modules ) ) {
	$no_modules = true;
}

if ( ! isset( $empty_tpl ) ) {
	$empty_tpl = '';
}

if ( ! isset( $count_modules ) ) {
	$count_modules = 0;
}

if ( ! isset( $tiles ) ) {
	$tiles = '';
}

if ( ! isset( $toasts ) ) {
	$toasts = '';
}

if ( ! isset( $panels ) ) {
	$panels = '';
}

$current_tab = 'modules';
if ( isset( $_GET['show_plugins'] ) && $_GET['show_plugins'] === 'yes' ) {
	$current_tab = 'plugins';
}

?>
<div class="obfx-wrapper obfx-header">
	<div class="obfx-header-content">
		<img src="<?php echo OBFX_URL; ?>/images/orbit-fox.png" title="Orbit Fox" class="obfx-logo"/>
		<h1><?php echo __( 'Orbit Fox', 'themeisle-companion' ); ?></h1><span class="powered"> by <a
					href="https://themeisle.com" target="_blank"><b>ThemeIsle</b></a></span>
	</div>
</div>
<div id="obfx-wrapper" style="padding: 0; margin-top: 10px; margin-bottom: 5px;">
	<?php
	echo $toasts;
	?>
</div>
<div class="obfx-full-page-container">
	<div class="obfx-wrapper" id="obfx-modules-wrapper">
		<?php
		if ( $no_modules ) {
			echo $empty_tpl;
		} else {
			?>
			<div class="panel">
				<div class="panel-header text-center">
					<div class="panel-title mt-10">
						<ul class="obfx-menu-tabs">
							<li class="<?php echo $current_tab === 'modules' ? 'obfx-tab-active' : ''; ?>"><a
										href="
										<?php
										echo esc_url( admin_url( 'admin.php?page=obfx_companion' ) );
										?>
										"><?php echo __( 'Available Modules', 'themeisle-companion' ); ?></a></li>
							<li class="<?php echo $current_tab === 'plugins' ? 'obfx-tab-active' : ''; ?>">
								<a href="<?php echo esc_url( admin_url( 'admin.php?page=obfx_companion&show_plugins=yes' ) ); ?>"><?php echo __( 'Recommended Plugins', 'themeisle-companion' ); ?></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="panel-body">

					<?php if ( $current_tab === 'modules' ) { ?>
						<?php echo $tiles; ?>
					<?php } ?>
					<?php if ( $current_tab === 'plugins' ) { ?>
						<?php do_action( 'obfx_recommended_plugins' ); ?>
					<?php } ?>
				</div>
				<div class="panel-footer" <?php echo $current_tab === 'plugins' ? 'style="display:none"' : ''; ?>>
					<!-- buttons or inputs -->
				</div>
			</div>
			<div class="panel" <?php echo $current_tab === 'plugins' ? 'style="display:none"' : ''; ?>>
				<div class="panel-header text-center">
					<div class="panel-title mt-10"><?php echo __( 'Activated Modules Options', 'themeisle-companion' ); ?></div>
				</div>
				<?php echo ( $panels === '' ) ? '<p class="text-center">' . __( 'No modules activated.', 'themeisle-companion' ) . '</p>' : $panels; ?>
			</div>
			<?php
		}
		?>
	</div>
</div>
