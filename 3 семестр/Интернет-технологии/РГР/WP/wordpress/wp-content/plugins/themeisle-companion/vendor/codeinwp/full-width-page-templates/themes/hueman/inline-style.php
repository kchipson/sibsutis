<?php
/* Support for Hueman theme */
$hueman = '
		.page-template-builder-fullwidth-std #header {
			padding-bottom: 0;
		}
		.page-template-builder-fullwidth-std #wrapper #page {
			padding: 0;
			margin: 0;	
		}
		.page-template-builder-fullwidth-std #wrapper #page .container-inner {
			max-width: 100%;
		}
		.page-template-builder-fullwidth-std #wrapper #page .container-inner .main-inner {
			padding: 0;
		}
		.page-template-builder-fullwidth-std #footer #nav-footer {
			border-top: none;
		}
	';
wp_add_inline_style( 'hueman-main-style', $hueman );
