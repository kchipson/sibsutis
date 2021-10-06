<?php
/**
 * Template used for photo rendering.
 *
 * @package OBFX
 */

?>
<div id='obfx-mystock' data-pagenb="1">
		<ul class='obfx-image-list'>
			<?php
			if ( ! empty( $urls ) ) {
				foreach ( $urls as $photo ) {
					include( dirname( __FILE__ ) ) . '/photo.php';
				}
			}
			?>
		</ul>
		<div class="obfx_spinner"></div>
</div>
