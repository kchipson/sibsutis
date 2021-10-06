<?php
/* Support for VT Blogging theme */
$vtb = '
		.page-template-builder-fullwidth-std .site-content {
			padding: 0;
			margin: 0;
			width: 100%;
		}
	';
wp_add_inline_style( 'vt-blogging-style', $vtb );
