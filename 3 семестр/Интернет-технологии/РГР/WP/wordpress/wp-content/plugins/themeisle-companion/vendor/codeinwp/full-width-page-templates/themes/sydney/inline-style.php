<?php
	/* Support for Sydney theme */
	$sydney = '
		.page-template-builder-fullwidth-std .page-wrap,
        .page-template-builder-fullwidth-std .page-wrap .content-wrapper {
            padding: 0;
			margin: 0;
			width: 100%
        }
		.page-template-builder-fullwidth-std.elementor-page .page-wrap .container {
            width: 100%;
	        overflow: hidden;
        }
		.page-template-builder-fullwidth-std .page .entry-header,
        .page-template-builder-fullwidth-std .page .entry-footer {
           display: none;
        }
	';
	wp_add_inline_style( 'sydney-style', $sydney );
