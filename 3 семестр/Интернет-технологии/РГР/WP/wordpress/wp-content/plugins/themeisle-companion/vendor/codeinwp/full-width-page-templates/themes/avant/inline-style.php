<?php
/* Support for Avant theme */
$avant = '
		.page-template-builder-fullwidth-std #page > .site-container {
			padding: 0;
			margin: 0;
			max-width: 100%;
		}
		.page-template-builder-fullwidth-std .site-footer {
			margin: 0;
		}
	';
wp_add_inline_style( 'avant-style', $avant );
