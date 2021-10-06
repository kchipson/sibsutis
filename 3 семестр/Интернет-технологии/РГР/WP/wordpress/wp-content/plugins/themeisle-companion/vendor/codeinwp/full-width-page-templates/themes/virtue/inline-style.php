<?php
/* Support for Virtue theme */
$virtue = '.page-template-builder-fullwidth .headerclass,
.page-template-builder-fullwidth .footerclass {
    display: none;
}
.page-template-builder-fullwidth .contentclass,
.page-template-builder-fullwidth-std .contentclass {
    padding-bottom: 0;
}
.page-template-builder-fullwidth .contentclass {
    padding-top: 0;
}';
wp_add_inline_style( 'kadence_theme', $virtue );
