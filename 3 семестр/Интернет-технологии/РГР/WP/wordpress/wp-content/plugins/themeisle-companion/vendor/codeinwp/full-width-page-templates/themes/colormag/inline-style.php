<?php
/* Support for Colormag theme */
$colormag = '
		.page-template-builder-fullwidth-std #main {
			padding: 0;
		}
		.page-template-builder-fullwidth-std #main .inner-wrap {
			margin: 0;
			max-width: 100%;
		}
		@media (max-width: 1190px) {
			.page-template-builder-fullwidth-std #main .inner-wrap {
				margin: 0;
				width: 100%;
			}
		}
	';
wp_add_inline_style( 'colormag_style', $colormag );
