<?php
/* Support for Primer theme */
$primer = '
		.page-template-builder-fullwidth-std .page-title-container {
			display: none;
		}
		.page-template-builder-fullwidth-std .site-content {
			margin: 0;
			max-width: 100%;
		}
	';
wp_add_inline_style( 'primer', $primer );
