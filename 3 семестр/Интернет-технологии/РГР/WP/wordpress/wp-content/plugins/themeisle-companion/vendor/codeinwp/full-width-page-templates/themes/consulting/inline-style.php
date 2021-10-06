<?php
/* Support for Consulting theme */
$consulting = '
		.page-template-builder-fullwidth-std #site-header #intro {
			display: none;
		}
		.page-template-builder-fullwidth-std #content {
			padding: 0;
		}
		.page-template-builder-fullwidth-std #content #content-core {
			margin: 0;
			max-width: 100%;
		}
	';
wp_add_inline_style( 'consulting-thinkup-style', $consulting );
