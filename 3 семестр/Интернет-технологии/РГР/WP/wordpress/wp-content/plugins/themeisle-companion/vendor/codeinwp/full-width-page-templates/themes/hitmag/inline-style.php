<?php
/* Support for HitMag theme */
$hitmag = '
		.page-template-builder-fullwidth-std .hitmag-wrapper {
			margin: 0;
			max-width: 100%;
		}
		.page-template-builder-fullwidth-std .hitmag-wrapper .site-content {
			padding: 0;
		}
		.page-template-builder-fullwidth-std .hitmag-wrapper .site-header .hm-container {
			padding: 0 40px;
		}
		.page-template-builder-fullwidth-std .hitmag-wrapper .hm-container {
			padding: 0;
			margin: 0;
			max-width: 100%;
		}
		.page-template-builder-fullwidth-std .hm-top-bar {
			display: none;
		}
		.page-template-builder-fullwidth-std .site-header {
			margin: 0;
		}
		.page-template-builder-fullwidth-std .hitmag-wrapper .site-footer {
			padding: 0 40px;
			background-color: #222;
		}
	';
wp_add_inline_style( 'hitmag-style', $hitmag );
