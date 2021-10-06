<?php
/* Support for Kyle theme */
$kyle = '
		.page-template-builder-fullwidth-std .main-wrapper .container {
			padding: 0;
			margin: 0;
			width: 100%;
		}
		.page-template-builder-fullwidth-std .header > *:last-child {
			margin-bottom: 0;
		}
	';
wp_add_inline_style( 'kale-style', $kyle );
