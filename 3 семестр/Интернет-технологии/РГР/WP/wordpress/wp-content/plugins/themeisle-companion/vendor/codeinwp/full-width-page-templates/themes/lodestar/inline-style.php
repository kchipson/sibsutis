<?php
	/* Support for Lodestar theme */
	$lodestar = '
				.page-template-builder-fullwidth-std .site-content {
					padding: 0;
				}
			';
	wp_add_inline_style( 'lodestar-style', $lodestar);
