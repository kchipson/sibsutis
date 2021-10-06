<?php
/* Support for Poseidon theme */
$poseidon = '
		.page-template-builder-fullwidth-std .site-header {
			border-bottom: none;
		}
		.page-template-builder-fullwidth-std .site-content {
			padding: 0;
			margin: 0;
			max-width: 100%;
		}
		.page-template-builder-fullwidth-std .footer-wrap {
			border-top: none;
		}
	';
wp_add_inline_style( 'poseidon-stylesheet', $poseidon );
