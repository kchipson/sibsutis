<?php
	/* Support for Virtue theme */
	$experon = '
		.page-template-builder-fullwidth-std #content {
            padding: 0;
        }
		.page-template-builder-fullwidth-std #content-core {
            max-width: 100%;
        }
		.page-template-builder-fullwidth-std #intro {
			display: none;
		}
	';
	wp_add_inline_style( 'thinkup-style', $experon );
