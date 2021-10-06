<?php
/* Support for Shapely theme */
$shapely = '
		.page-template-builder-fullwidth-std .site .main-container .page-title-section {
			display: none;
		}
		.page-template-builder-fullwidth-std .site .main-container .content-area {
			padding: 0;
		}
		.page-template-builder-fullwidth-std .site .main-container .content-area .container {
			padding: 0;
			margin: 0;
			width: 100%;
		}
		.page-template-builder-fullwidth-std section {
			padding: 0;
			position: initial;
			overflow: initial;
		}
	';
wp_add_inline_style( 'shapely-style', $shapely );
