<?php
/* Support for News Portal theme */
$newsportal = '
		.page-template-builder-fullwidth-std #page .site-content,
		 .page-template-builder-fullwidth-std #page .site-footer {
			margin: 0;
		}
		.page-template-builder-fullwidth-std #page .site-content .mt-container {
			width: 100%;
		}
		@media (max-width: 1200px) {
			.page-template-builder-fullwidth-std #page .site-content .mt-container {
				padding: 0;
			}
		}
	';
wp_add_inline_style( 'news-portal-style', $newsportal );
