<?php
/* Support for Flash theme */
$flash = '
		.page-template-builder-fullwidth-std #page #flash-breadcrumbs {
			display: none;
		}
		.page-template-builder-fullwidth-std .site-content .tg-container {
			max-width: 100%;
		} 
		@media (max-width: 1200px) {
			.page-template-builder-fullwidth-std .site-content .tg-container {
				padding: 0;
				width: 100%;
			}
		}
	';
wp_add_inline_style( 'flash-style', $flash );
