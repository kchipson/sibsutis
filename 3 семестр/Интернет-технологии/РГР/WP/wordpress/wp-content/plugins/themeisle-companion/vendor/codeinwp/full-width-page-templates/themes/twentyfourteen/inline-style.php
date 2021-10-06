<?php
	/* Support for Twenty Fourteen theme */
	$style = '
	    .page-template-builder-fullwidth-std #page {
            max-width: 100%;
        }
        .page-template-builder-fullwidth-std .site::before {
            display: none;
        }
        .page-template-builder-fullwidth-std .site-header {
            max-width: 100%;
        }
	';
	wp_add_inline_style( 'twentyfourteen-style', $style );
