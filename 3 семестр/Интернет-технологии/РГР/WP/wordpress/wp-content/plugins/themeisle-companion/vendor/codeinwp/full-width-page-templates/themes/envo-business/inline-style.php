<?php
/* Support for Envo Business theme */
$envob = '
		.page-template-builder-fullwidth-std .main-container {
			padding: 0;
			width: 100%;
		}
	';
wp_add_inline_style( 'envo-business-stylesheet', $envob );
