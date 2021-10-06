<?php
/**
 * Template Name: Full Width Blank
 * Template Post Type: page
 *
 * Blank template with minimal HTML required for a page to run
 *
 * @since   1.0.0
 * @version 1.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<?php
		do_action('fwpt_blank_before_content');

		do_action('fwpt_blank_content');

		do_action('fwpt_blank_after_content');

		wp_footer();
		?>
	</body>
</html>
<?php
