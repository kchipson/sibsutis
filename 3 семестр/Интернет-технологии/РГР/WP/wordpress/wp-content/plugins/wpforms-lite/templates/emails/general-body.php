<?php
/**
 * General body template.
 *
 * This template can be overridden by copying it to yourtheme/wpforms/emails/general-body.php.
 *
 * @package    WPForms\Emails\Templates
 * @author     WPForms
 * @since      1.5.4
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2019, WPForms LLC
 *
 * @version 1.5.4
 *
 * @var string $message
 */

if ( ! \defined( 'ABSPATH' ) ) {
	exit;
}

?>

<table>
	<tbody>
	<tr>
		<td>
			<?php echo \wp_kses_post( $message ); ?>
		</td>
	</tr>
	</tbody>
</table>
