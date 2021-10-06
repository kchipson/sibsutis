<?php
	/* Support for Virtue theme */
	$edge = '
		.page-template-builder-fullwidth-std #content {
            padding: 0;
        }
		.page-template-builder-fullwidth-std #content .container {
            max-width: 100%;
        }
		.page-template-builder-fullwidth-std .page-header {
            display: none;
        }
		@media only screen and (max-width: 1023px) {
			.page-template-builder-fullwidth-std #content .container {
                width: 100%;
            }
		}
	';
	wp_add_inline_style( 'edge-style', $edge );
