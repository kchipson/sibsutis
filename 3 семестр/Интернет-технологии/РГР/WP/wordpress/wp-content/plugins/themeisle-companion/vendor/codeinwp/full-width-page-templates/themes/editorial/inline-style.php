<?php
/* Support for Editorial theme */
$editorial = '
			.page-template-builder-fullwidth-std {
				display: none;
			}
			.page-template-builder-fullwidth-std #masthead {
				margin-bottom: 0;
			}
			.page-template-builder-fullwidth-std #page > .site-content .mt-container {
				padding: 0;
				margin: 0;
				width: 100%;
			}
	';
wp_add_inline_style( 'editorial-style', $editorial);

