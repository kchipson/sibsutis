<?php
	/* Support for Twenty Thirteen theme */
	$thirteen = '
	    .page-template-builder-fullwidth-std .site {
            max-width: 100%;
            border: none;
        }
        .page-template-builder-fullwidth-std .site-header {
            max-width: 100%;
			background-size: 3200px auto;
        }
		.page-template-builder-fullwidth-std .navbar {
            max-width: 100%;
            width: 100%;
        }
	';
	wp_add_inline_style( 'twentythirteen-style', $thirteen );
