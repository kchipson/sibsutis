<?php
/* Support for Writee theme */
$writee = '
		.page-template-builder-fullwidth-std p,
		 .page-template-builder-fullwidth p {
			margin: 0;
		}
	';
wp_add_inline_style( 'WRT-style', $writee );
