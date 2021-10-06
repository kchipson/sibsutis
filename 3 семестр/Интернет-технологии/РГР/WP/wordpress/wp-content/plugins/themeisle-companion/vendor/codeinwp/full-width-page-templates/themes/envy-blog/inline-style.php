<?php
/* Support for Envy Blog theme */
$envyblog = '
		.page-template-builder-fullwidth-std .container {
			padding: 0;
			margin: 0;
			width: 100%;
		}
		.page-template-builder-fullwidth-std #breadcrumb {
			display: none;
		}
	';
wp_add_inline_style( 'envy-blog-style', $envyblog );
