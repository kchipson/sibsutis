<?php

/**
 * adds the closing <header> tag
 */
function zerif_close_header() {
	echo '</header> <!-- / END HOME SECTION  -->';
}
add_action( 'fwpt_std_content', 'zerif_close_header' );
