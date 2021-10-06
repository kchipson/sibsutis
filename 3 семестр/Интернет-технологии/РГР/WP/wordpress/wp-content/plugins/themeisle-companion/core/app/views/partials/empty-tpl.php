<?php
/**
 * Empty modules template.
 * Imported via the Orbit_Fox_Render_Helper.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Orbit_Fox
 * @subpackage Orbit_Fox/app/views/partials
 */

if ( ! isset( $title ) ) {
	$title = __( 'There are no modules for the Fox!', 'themeisle-companion' );
}

if ( ! isset( $btn_text ) ) {
	$btn_text = __( 'Contact support', 'themeisle-companion' );
}

if ( ! isset( $show_btn ) ) {
	$show_btn = true;
}

?>
<div class="empty">
	<div class="empty-icon">
		<i class="dashicons dashicons-warning" style="width: 48px; height: 48px; font-size: 48px; "></i>
	</div>
	<h4 class="empty-title"><?php echo $title; ?></h4>
	<?php echo ( isset( $sub_title ) ) ? '<p class="empty-subtitle">' . $sub_title . '</p>' : ''; ?>
	<?php
	if ( $show_btn ) {
		?>
		<div class="empty-action">
			<button class="btn btn-primary"><?php echo $btn_text; ?></button>
		</div>
		<?php
	}
	?>
</div>
