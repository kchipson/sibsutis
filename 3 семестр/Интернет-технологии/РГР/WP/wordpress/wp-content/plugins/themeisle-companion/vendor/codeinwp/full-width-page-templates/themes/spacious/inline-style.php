<?php
/* Support for Spacious theme */
$spacious = '	
		.page-template-builder-fullwidth-std {
			padding: 0;
		}
		.page-template-builder-fullwidth-std #page {
			margin: 0;
			max-width: 100%;
		}
		.page-template-builder-fullwidth-std #page #main {
			padding: 0;
		}
		.page-template-builder-fullwidth-std #page #main .inner-wrap {
			max-width: 100%;
		}
		@media (max-width: 1308px) {
			.page-template-builder-fullwidth-std #page,
			.page-template-builder-fullwidth-std #page #main .inner-wrap {
				 width: 100%;
			}
		}
		@media (max-width: 768px) {
			.page-template-builder-fullwidth-std .site-header #header-text-nav-container {
				border-bottom: none;
			}
			.page-template-builder-fullwidth-std .site-header .inner-wrap {
				width: 100%;
			}
			.page-template-builder-fullwidth-std .site-header .inner-wrap #header-text-nav-wrap {
			    padding: 0;
			}
		}		
		.page-template-builder-fullwidth-std .site-header .header-post-title-container {
			display: none;
		}
		.page-template-builder-fullwidth {
			padding: 0;
		}
	';
wp_add_inline_style( 'spacious_style', $spacious );
