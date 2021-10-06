<?php
/**
 * Email Summary body template.
 *
 * This template can be overridden by copying it to yourtheme/wpforms/emails/summary-body.php.
 *
 * @package    WPForms\Emails\Templates
 * @author     WPForms
 * @since      1.5.4
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2019, WPForms LLC
 *
 * @version 1.5.4
 *
 * @var array  $entries
 * @var array  $info_block
 */

if ( ! \defined( 'ABSPATH' ) ) {
	exit;
}

?>

<table class="summary-container">
	<tbody>
	<tr>
		<td>
			<h6 class="greeting"><?php \esc_html_e( 'Hi there!', 'wpforms' ); ?></h6>
			<?php if ( \wpforms()->pro ) : ?>
				<p class="large"><?php \esc_html_e( 'Let’s see how your forms performed in the past week.', 'wpforms' ); ?></p>
			<?php else : ?>
				<p class="large"><?php \esc_html_e( 'Let’s see how your forms performed.', 'wpforms-lite' ); ?></p>
				<p class="lite-disclaimer">
					<?php \esc_html_e( 'Below is the total number of submissions for each form, however actual entries are not stored in WPForms Lite. To generate detailed reports and view future entries inside your WordPress dashboard, consider upgrading to Pro.', 'wpforms-lite' ); ?>
				</p>
			<?php endif; ?>
			<table class="email-summaries">
				<thead>
				<tr>
					<th><?php \esc_html_e( 'Form', 'wpforms-lite' ); ?></th>
					<th class="entries-column text-center"><?php \esc_html_e( 'Entries', 'wpforms-lite' ); ?></th>
				</tr>
				</thead>
				<tbody>

				<?php foreach ( $entries as $row ) : ?>
					<tr>
						<td class="text-large"><?php echo isset( $row['title'] ) ? \esc_html( $row['title'] ) : ''; ?></td>
						<td class="entry-count text-large">
							<?php if ( empty( $row['edit_url'] ) ) : ?>
								<span>
									<?php echo isset( $row['count'] ) ? \absint( $row['count'] ) : ''; ?>
								</span>
							<?php else : ?>
								<a href="<?php echo \esc_url( $row['edit_url'] ); ?>">
									<?php echo isset( $row['count'] ) ? \absint( $row['count'] ) : ''; ?>
								</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>

				<?php if ( empty( $entries ) ) : ?>
					<tr>
						<td class="text-center" colspan="2"><?php \esc_html_e( 'It appears you do not have any form entries yet.', 'wpforms-lite' ); ?></td>
					</tr>
				<?php endif; ?>

				</tbody>
			</table>


			<?php if ( ! empty( $info_block ) ) : ?>
				<table class="summary-info-table">
					<?php if ( ! empty( $info_block['title'] ) || ! empty( $info_block['content'] ) ) : ?>
						<tr>
							<td class="summary-info-content">
								<table>
									<?php if ( ! empty( $info_block['title'] ) ) : ?>
										<tr>
											<td class="text-center">
												<h6><?php echo \esc_html( $info_block['title'] ); ?></h6>
											</td>
										</tr>
									<?php endif; ?>
									<?php if ( ! empty( $info_block['content'] ) ) : ?>
										<tr>
											<td class="text-center"><?php echo \wp_kses_post( $info_block['content'] ); ?></td>
										</tr>
									<?php endif; ?>
								</table>
							</td>
						</tr>
					<?php endif; ?>

					<?php if ( ! empty( $info_block['url'] ) && ! empty( $info_block['button'] ) ) : ?>
						<tr>
							<td class="summary-info-content button-container">
								<center>
									<table class="button rounded-button">
										<tr>
											<td>
												<table>
													<tr>
														<td>
															<a href="<?php echo \esc_url( $info_block['url'] ); ?>" rel="noopener noreferrer" target="_blank">
																<?php echo \esc_html( $info_block['button'] ); ?>
															</a>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</center>
							</td>
						</tr>
					<?php endif; ?>

				</table>
			<?php endif; ?>
		</td>
	</tr>
	</tbody>
</table>
