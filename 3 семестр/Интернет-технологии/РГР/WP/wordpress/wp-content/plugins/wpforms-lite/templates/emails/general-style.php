<?php
/**
 * General style template.
 *
 * This template can be overridden by copying it to yourtheme/wpforms/emails/general-style.php.
 *
 * @package    WPForms\Emails\Templates
 * @author     WPForms
 * @since      1.5.4
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2019, WPForms LLC
 *
 * @version 1.5.4
 *
 * @var string $email_background_color
 */

if ( ! \defined( 'ABSPATH' ) ) {
	exit;
}

require \WPFORMS_PLUGIN_DIR . '/assets/css/emails/general.min.css';

?>

body, .body {
	background-color: <?php echo \esc_attr( $email_background_color ); ?>;
}

<?php if ( ! empty( $header_image_max_width ) ) : ?>
.header img {
	max-width: <?php echo \esc_attr( $header_image_max_width ); ?>;
}
<?php endif; ?>
