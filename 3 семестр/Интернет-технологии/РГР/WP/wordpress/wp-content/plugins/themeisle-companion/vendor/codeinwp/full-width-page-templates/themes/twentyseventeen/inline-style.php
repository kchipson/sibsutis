<?php
/* Support for Twenty Seventeen theme */
$style = '.elementor-editor-active .site-content {
	padding: 2.5em 0 0;
}
.elementor-page .site-content {
	padding: 0;
}
.elementor-page.page:not(.home) #content {
	padding-bottom: 0;
}
.elementor-page .site-footer {
	margin-top: 0;
}';
wp_add_inline_style( 'twentyseventeen-style', $style );
