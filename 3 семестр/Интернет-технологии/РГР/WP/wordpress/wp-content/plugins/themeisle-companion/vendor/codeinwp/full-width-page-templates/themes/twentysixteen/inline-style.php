<?php
	/* Support for Twenty Sixteen theme */
	$style = '	    
		body.page-template-builder-fullwidth.elementor-page,
		body.page-template-builder-fullwidth-std.elementor-page {
			background: transparent;
		}
		.page-template-builder-fullwidth-std .site {
			margin: 0;
		}
		.page-template-builder-fullwidth .elementor-page,
        .page-template-builder-fullwidth-std .elementor-page {
	        overflow: hidden;
        }
		.page-template-builder-fullwidth .full-width,
        .page-template-builder-fullwidth-std .full-width {
	        width: 100%;
        }
        .page-template-builder-fullwidth .site-inner,
        .page-template-builder-fullwidth-std .site-inner {
            max-width: 100%;
        }
        .page-template-builder-fullwidth .site-content,
        .page-template-builder-fullwidth-std .site-content {
            padding: 0;
        }
        .page-template-builder-fullwidth header#masthead,
        .page-template-builder-fullwidth footer#colophon,
        .page-template-builder-fullwidth-std header#masthead,
        .page-template-builder-fullwidth-std footer#colophon {
	        margin: 0 auto;
	        max-width: 1320px;
        } 
        .page-template-builder-fullwidth .entry-content,
        .page-template-builder-fullwidth-std .entry-content {
	        margin-right: auto;
	        margin-left: auto;
        }
        @media screen and (min-width: 56.875em) {
	        .admin-bar .anchor-menu {
		        top: 20px;
	        }	
			.admin-bar .anchor-menu-fixed.anchor-menu, .admin-bar .anchor-menu-fixed.elementor-widget-wp-widget-nav_menu {
				top: 54px !important;
			}			
			.page-template-builder-fullwidth .entry-content,
            .page-template-builder-fullwidth-std .entry-content	{
	            margin-right: auto;
	            margin-left: auto;
	        }
        }
        @media screen and (min-width: 44.375em) {	        
			.page-template-builder-fullwidth .entry-content,
            .page-template-builder-fullwidth-std .entry-content {
	            margin-right: auto;;
	        }
        }
	';
	wp_add_inline_style( 'twentysixteen-style', $style );
