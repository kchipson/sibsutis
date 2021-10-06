<?php
	/* Support for Actions theme */
	$style = '
		.elementor-body .site {
			overflow-x: visible;
		}
		.elementor-body .navbar-fixed-top {
			z-index: 1;
		}
	';
	wp_add_inline_style( 'elementor-frontend', $style );
