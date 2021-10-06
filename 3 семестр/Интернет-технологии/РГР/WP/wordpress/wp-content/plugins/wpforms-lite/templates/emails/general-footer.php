<?php
/**
 * General footer template.
 *
 * This template can be overridden by copying it to yourtheme/wpforms/emails/general-footer.php.
 *
 * @package    WPForms\Emails\Templates
 * @author     WPForms
 * @since      1.5.4
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2019, WPForms LLC
 *
 * @version 1.5.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

					</td>
				</tr>
				<tr>
					<td align="center" valign="top" class="footer">
						<?php
						/* translators: %s - link to a site. */
						printf( esc_html__( 'Sent from %s', 'wpforms-lite' ), '<a href="' . esc_url( home_url() ) . '">' . esc_html( wp_specialchars_decode( get_bloginfo( 'name' ) ) ) . '</a>' );
						?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
