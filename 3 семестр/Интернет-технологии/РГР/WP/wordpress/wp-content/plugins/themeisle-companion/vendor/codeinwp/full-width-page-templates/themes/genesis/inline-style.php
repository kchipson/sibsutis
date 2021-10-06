<?php
	/* Support for Genesis theme */
	$genesis = '
		.page-template-builder-fullwidth .site-inner,
		.page-template-builder-fullwidth-std .site-inner {
            max-width: 100%;
			width: 100%;
            padding: 0;
			margin: 0;			
        }
		.page-template-builder-fullwidth .elementor-page,
		.page-template-builder-fullwidth-std .elementor-page .site-inner {
            padding-top: 0;
			max-width: 100%;
			width: 100%;
            overflow: hidden;			
        }
		@media only screen and (max-width: 860px) {
			.page-template-builder-fullwidth-std .site-inner {
				padding: 0;				
			}
		}
	';
	wp_add_inline_style( 'elementor-frontend', $genesis );
