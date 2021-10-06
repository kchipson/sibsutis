<?php
/* Support for Renden theme */
$renden = '
		.page-template-builder-fullwidth-std #site-header #intro {
			display: none;
		}
		.page-template-builder-fullwidth-std #body-core #content {
			padding: 0;
		}		
		.page-template-builder-fullwidth-std #body-core #content #content-core {
			padding: 0;
			margin: 0;
			max-width: 100%;
		}
	';
wp_add_inline_style( 'thinkup-style', $renden );
