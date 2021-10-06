<?php
	/* Support for OceanWP theme */
	$oceanwp = '
		.page-template-builder-fullwidth-std .page-header {
			display: none;
		}
	';
	wp_add_inline_style( 'oceanwp-style', $oceanwp );
