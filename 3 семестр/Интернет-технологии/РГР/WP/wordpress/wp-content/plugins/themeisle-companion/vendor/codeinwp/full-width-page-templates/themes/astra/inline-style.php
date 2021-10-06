<?php
	/* Support for Astra theme */
	$astra = '
			.page-template-builder-fullwidth-std #content .ast-container {
				max-width: 100%;
				padding: 0;
				margin: 0;
			}
		';
	wp_add_inline_style( 'astra-theme-css', $astra );
