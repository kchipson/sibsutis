<?php
/* Support for Vogue theme */
$vogue = '
		.page-template-builder-fullwidth-std #page > .site-container {
			padding: 0;
			margin: 0;
			max-width: 100%;
		}
		.page-template-builder-fullwidth-std .site-footer-bottom-bar {
			display: none;
		}
	';
wp_add_inline_style( 'vogue-style', $vogue );
