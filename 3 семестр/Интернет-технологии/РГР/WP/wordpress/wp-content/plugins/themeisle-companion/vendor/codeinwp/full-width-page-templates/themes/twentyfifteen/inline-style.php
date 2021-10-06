<?php
	/* Support for Twenty Fifteen theme */
	$style = '
	    body.page-template-builder-fullwidth:before {
		    display: none;
	    }
		.page-template-builder-fullwidth .site,
		.page-template-builder-fullwidth-std .site	{
            max-width: 100%;
			margin: 0;
        }
        .page-template-builder-fullwidth .elementor-page	{
            overflow: hidden;
        }
        body.page-template-builder-fullwidth-std:before {
		    width: 29.4118%;
	    }		
		.page-template-builder-fullwidth-std .site-footer {
            width: 71%;
			margin-left: 29%;
        }
	';
	wp_add_inline_style( 'twentyfifteen-style', $style );
