<?php
/* Support for Zerif Lite theme */
$style = '
		.page-template-builder-fullwidth {
			overflow: hidden;
		}
		@media (min-width: 768px) {
			.page-template-builder-fullwidth-std .header > .elementor {
				padding-top: 76px;
			}
		}
';
wp_add_inline_style( 'zerif_style', $style );
