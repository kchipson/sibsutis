<?php
	/* Support for GeneratePress theme */
	$style = '	
		.page-template-builder-fullwidth-std #page {
			margin: 0;
			max-width: 100%;
		}
		.page-template-builder-fullwidth-std .entry-header .grid-container .entry-title {
			display: none;
		}
		.page-template-builder-fullwidth .entry-header {
			display: none;
		}
	';
	wp_add_inline_style( 'generate-style', $style );
