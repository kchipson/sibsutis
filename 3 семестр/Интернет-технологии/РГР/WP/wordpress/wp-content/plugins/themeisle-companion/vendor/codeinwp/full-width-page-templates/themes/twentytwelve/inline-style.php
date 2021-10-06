<?php
	/* Support for Twenty Twelve theme */
	$style = '
			.page-template-builder-fullwidth-std #page {
				padding: 0;
				margin: 0;
				max-width: 100%;
			}
			.page-template-builder-fullwidth-std #page .site-header {
				padding: 0 2.857142857rem;
			}
		';
	wp_add_inline_style( 'twentytwelve-style', $style );
