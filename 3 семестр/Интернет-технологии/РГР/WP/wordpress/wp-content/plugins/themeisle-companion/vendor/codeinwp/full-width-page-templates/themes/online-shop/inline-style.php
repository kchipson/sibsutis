<?php
/* Support for Online Shop theme */
$style = '
		.page-template-builder-fullwidth-std .site-header .header-wrapper {
			padding-bottom: 0;
		}
		.page-template-builder-fullwidth-std .site-content {
			width: 100%;
		}
		.page-template-builder-fullwidth-std .site-content .breadcrumbs {
			display: none;
		}
		@media (max-width: 992px) {
			.page-template-builder-fullwidth-std .site-content {
				padding: 0;
			}
		}
	';
wp_add_inline_style( 'online-shop-style', $style );
