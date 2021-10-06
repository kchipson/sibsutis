<?php
/* Support for Hestia theme */
$hestia = '
		.page-template-builder-fullwidth-std .header > .elementor {
			padding-top: 70px;
		}
';
wp_add_inline_style( 'hestia_style', $hestia);
