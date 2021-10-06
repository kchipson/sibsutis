<?php
	/* Support for Actions theme */
	$style = '
		.page-template-builder-fullwidth .main-content-area .main,
        .page-template-builder-fullwidth-std .main-content-area .main  {
            margin: 0 auto;
            width: 100%;
            max-width: 100%;
        }
	';
if ( is_child_theme() || ! is_admin() ) {
	wp_add_inline_style( 'actions-child-style', $style );
} else {
	wp_add_inline_style( 'actions-style', $style );
}
