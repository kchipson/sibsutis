<?php
	/* Support for Storefront theme */
	$css = '
		.page-template-builder-fullwidth-std .site-header {
			border: none;
		}
		.page-template-builder-fullwidth-std .site-content .col-full {
            max-width: 100%;
            padding: 0;
			margin: 0;
        }
		
		.page-template-builder-fullwidth-std .site-header {
           margin-bottom: 0;
        }
	';
	wp_add_inline_style( 'storefront-style', $css );
