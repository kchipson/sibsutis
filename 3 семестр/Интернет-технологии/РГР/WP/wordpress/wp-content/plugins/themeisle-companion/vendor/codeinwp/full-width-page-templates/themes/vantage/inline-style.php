<?php
	/* Support for Vantage theme */
	$vantage = '
		.page-template-builder-fullwidth-std #main {
            padding: 0;
	        max-width: 100%;
        }

        .page-template-builder-fullwidth-std.responsive.layout-full #main .full-container {
            max-width: 100%;
            margin-left: auto;
            margin-right: auto;
        }
	';
	wp_add_inline_style( 'vantage-style', $vantage );
