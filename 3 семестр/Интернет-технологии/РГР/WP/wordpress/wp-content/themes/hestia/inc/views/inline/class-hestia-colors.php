<?php
/**
 * Colors main file.
 *
 * @package Hestia
 */

/**
 * Class Hestia_Colors
 */
class Hestia_Colors extends Hestia_Abstract_Main {

	/**
	 * Add all the hooks necessary.
	 */
	public function init() {
		add_action( 'wp_enqueue_scripts', array( $this, 'add_inline_color_styles' ) );
	}

	/**
	 * Add inline style for colors.
	 */
	public function add_inline_color_styles() {
		wp_add_inline_style( apply_filters( 'hestia_custom_color_handle', 'hestia_style' ), $this->colors_inline_style() );
		wp_add_inline_style( 'hestia_woocommerce_style', $this->woo_colors_inline_style() );
	}

	/**
	 * Colors inline style.
	 *
	 * @return string
	 */
	private function colors_inline_style() {

		$custom_css = '';

		$color_accent    = get_theme_mod( 'accent_color', apply_filters( 'hestia_accent_color_default', '#e91e63' ) );
		$header_gradient = get_theme_mod( 'hestia_header_gradient_color' );

		$custom_css .= ! empty( $color_accent ) ? '	
		a, 
		.navbar .dropdown-menu li:hover > a,
		.navbar .dropdown-menu li:focus > a,
		.navbar .dropdown-menu li:active > a,
		.navbar .navbar-nav > li .dropdown-menu li:hover > a,
		body:not(.home) .navbar-default .navbar-nav > .active:not(.btn) > a,
		body:not(.home) .navbar-default .navbar-nav > .active:not(.btn) > a:hover,
		body:not(.home) .navbar-default .navbar-nav > .active:not(.btn) > a:focus,
		a:hover, 
		.card-blog a.moretag:hover, 
		.card-blog a.more-link:hover, 
		.widget a:hover,
		.has-text-color.has-accent-color,
		p.has-text-color a {
		    color:' . esc_html( $color_accent ) . ';
		}
		
		.pagination span.current, .pagination span.current:focus, .pagination span.current:hover {
			border-color:' . esc_html( $color_accent ) . '
		}
		
		button,
		button:hover,
		.woocommerce .track_order button[type="submit"],
		.woocommerce .track_order button[type="submit"]:hover,
		div.wpforms-container .wpforms-form button[type=submit].wpforms-submit,
		div.wpforms-container .wpforms-form button[type=submit].wpforms-submit:hover,
		input[type="button"],
		input[type="button"]:hover,
		input[type="submit"],
		input[type="submit"]:hover,
		input#searchsubmit, 
		.pagination span.current, 
		.pagination span.current:focus, 
		.pagination span.current:hover,
		.btn.btn-primary,
		.btn.btn-primary:link,
		.btn.btn-primary:hover, 
		.btn.btn-primary:focus, 
		.btn.btn-primary:active, 
		.btn.btn-primary.active, 
		.btn.btn-primary.active:focus, 
		.btn.btn-primary.active:hover,
		.btn.btn-primary:active:hover, 
		.btn.btn-primary:active:focus, 
		.btn.btn-primary:active:hover,
		.hestia-sidebar-open.btn.btn-rose,
		.hestia-sidebar-close.btn.btn-rose,
		.hestia-sidebar-open.btn.btn-rose:hover,
		.hestia-sidebar-close.btn.btn-rose:hover,
		.hestia-sidebar-open.btn.btn-rose:focus,
		.hestia-sidebar-close.btn.btn-rose:focus,
		.label.label-primary,
		.hestia-work .portfolio-item:nth-child(6n+1) .label,
		.nav-cart .nav-cart-content .widget .buttons .button,
		.has-accent-background-color[class*="has-background"] {
		    background-color: ' . esc_html( $color_accent ) . ';
		}
		
		@media (max-width: 768px) { 
	
			.navbar-default .navbar-nav>li>a:hover,
			.navbar-default .navbar-nav>li>a:focus,
			.navbar .navbar-nav .dropdown .dropdown-menu li a:hover,
			.navbar .navbar-nav .dropdown .dropdown-menu li a:focus,
			.navbar button.navbar-toggle:hover,
			.navbar .navbar-nav li:hover > a i {
			    color: ' . esc_html( $color_accent ) . ';
			}
		}
		
		body:not(.woocommerce-page) button:not([class^="fl-"]):not(.hestia-scroll-to-top):not(.navbar-toggle):not(.close),
		body:not(.woocommerce-page) .button:not([class^="fl-"]):not(hestia-scroll-to-top):not(.navbar-toggle):not(.add_to_cart_button),
		div.wpforms-container .wpforms-form button[type=submit].wpforms-submit,
		input[type="submit"], 
		input[type="button"], 
		.btn.btn-primary,
		.widget_product_search button[type="submit"],
		.hestia-sidebar-open.btn.btn-rose,
		.hestia-sidebar-close.btn.btn-rose,
		.everest-forms button[type=submit].everest-forms-submit-button {
		    -webkit-box-shadow: 0 2px 2px 0 ' . hestia_hex_rgba( $color_accent, '0.14' ) . ',0 3px 1px -2px ' . hestia_hex_rgba( $color_accent, '0.2' ) . ',0 1px 5px 0 ' . hestia_hex_rgba( $color_accent, '0.12' ) . ';
		    box-shadow: 0 2px 2px 0 ' . hestia_hex_rgba( $color_accent, '0.14' ) . ',0 3px 1px -2px ' . hestia_hex_rgba( $color_accent, '0.2' ) . ',0 1px 5px 0 ' . hestia_hex_rgba( $color_accent, '0.12' ) . ';
		}
		
		.card .header-primary, .card .content-primary,
		.everest-forms button[type=submit].everest-forms-submit-button {
		    background: ' . esc_html( $color_accent ) . ';
		}
		
		body:not(.woocommerce-page) .button:not([class^="fl-"]):not(.hestia-scroll-to-top):not(.navbar-toggle):not(.add_to_cart_button):hover,
		body:not(.woocommerce-page) button:not([class^="fl-"]):not(.hestia-scroll-to-top):not(.navbar-toggle):not(.close):hover,
		div.wpforms-container .wpforms-form button[type=submit].wpforms-submit:hover,
		input[type="submit"]:hover,
		input[type="button"]:hover,
		input#searchsubmit:hover, 
		.widget_product_search button[type="submit"]:hover,
		.pagination span.current, 
		.btn.btn-primary:hover, 
		.btn.btn-primary:focus, 
		.btn.btn-primary:active, 
		.btn.btn-primary.active, 
		.btn.btn-primary:active:focus, 
		.btn.btn-primary:active:hover, 
		.hestia-sidebar-open.btn.btn-rose:hover,
		.hestia-sidebar-close.btn.btn-rose:hover,
		.pagination span.current:hover,
		.everest-forms button[type=submit].everest-forms-submit-button:hover,
 		.everest-forms button[type=submit].everest-forms-submit-button:focus,
 		.everest-forms button[type=submit].everest-forms-submit-button:active {
			-webkit-box-shadow: 0 14px 26px -12px ' . hestia_hex_rgba( $color_accent, '0.42' ) . ',0 4px 23px 0 rgba(0,0,0,0.12),0 8px 10px -5px ' . hestia_hex_rgba( $color_accent, '0.2' ) . ';
		    box-shadow: 0 14px 26px -12px ' . hestia_hex_rgba( $color_accent, '0.42' ) . ',0 4px 23px 0 rgba(0,0,0,0.12),0 8px 10px -5px ' . hestia_hex_rgba( $color_accent, '0.2' ) . ';
			color: #fff;
		}
		
		.form-group.is-focused .form-control {
			background-image: -webkit-gradient(linear,left top, left bottom,from(' . esc_html( $color_accent ) . '),to(' . esc_html( $color_accent ) . ')),-webkit-gradient(linear,left top, left bottom,from(#d2d2d2),to(#d2d2d2));
			background-image: -webkit-linear-gradient(linear,left top, left bottom,from(' . esc_html( $color_accent ) . '),to(' . esc_html( $color_accent ) . ')),-webkit-linear-gradient(linear,left top, left bottom,from(#d2d2d2),to(#d2d2d2));
			background-image: linear-gradient(linear,left top, left bottom,from(' . esc_html( $color_accent ) . '),to(' . esc_html( $color_accent ) . ')),linear-gradient(linear,left top, left bottom,from(#d2d2d2),to(#d2d2d2));
		}
		
		.navbar:not(.navbar-transparent) li:not(.btn):hover > a,
		.navbar li.on-section:not(.btn) > a, 
		.navbar.full-screen-menu.navbar-transparent li:not(.btn):hover > a,
		.navbar.full-screen-menu .navbar-toggle:hover,
		.navbar:not(.navbar-transparent) .nav-cart:hover, 
		.navbar:not(.navbar-transparent) .hestia-toggle-search:hover {
				color:' . esc_html( $color_accent ) . '}
		' : '';

		// Header Gradient Color + support for Gutenberg color.
		$custom_css .= ! empty( $header_gradient ) ? '
		.header-filter-gradient { 
			background: linear-gradient(45deg, ' . hestia_hex_rgba( $header_gradient ) . ' 0%, ' . hestia_generate_gradient_color( $header_gradient ) . ' 100%); 
		}
		.has-text-color.has-header-gradient-color { color: ' . $header_gradient . '; }
		.has-header-gradient-background-color[class*="has-background"] { background-color: ' . $header_gradient . '; }
		' : '';

		// Gutenberg support for the background color
		$background_color = '#' . get_theme_mod( 'background_color', 'E5E5E5' );

		$custom_css .= '
		.has-text-color.has-background-color-color { color: ' . $background_color . '; }
		.has-background-color-background-color[class*="has-background"] { background-color: ' . $background_color . '; }
		';

		return $custom_css;
	}

	/**
	 * WooCommerce inline color style.
	 *
	 * @return string
	 */
	private function woo_colors_inline_style() {
		if ( ! class_exists( 'WooCommerce', false ) ) {
			return '';
		}

		$color_accent           = get_theme_mod( 'accent_color', apply_filters( 'hestia_accent_color_default', '#e91e63' ) );
		$custom_css_woocommerce = '';

		$custom_css_woocommerce .= ! empty( $color_accent ) ? '
		.woocommerce-cart .shop_table .actions .coupon .input-text:focus,
		.woocommerce-checkout #customer_details .input-text:focus, .woocommerce-checkout #customer_details select:focus,
		.woocommerce-checkout #order_review .input-text:focus,
		.woocommerce-checkout #order_review select:focus,
		.woocommerce-checkout .woocommerce-form .input-text:focus,
		.woocommerce-checkout .woocommerce-form select:focus,
		.woocommerce div.product form.cart .variations select:focus,
		.woocommerce .woocommerce-ordering select:focus {
			background-image: -webkit-gradient(linear,left top, left bottom,from(' . esc_html( $color_accent ) . '),to(' . esc_html( $color_accent ) . ')),-webkit-gradient(linear,left top, left bottom,from(#d2d2d2),to(#d2d2d2));
			background-image: -webkit-linear-gradient(linear,left top, left bottom,from(' . esc_html( $color_accent ) . '),to(' . esc_html( $color_accent ) . ')),-webkit-linear-gradient(linear,left top, left bottom,from(#d2d2d2),to(#d2d2d2));
			background-image: linear-gradient(linear,left top, left bottom,from(' . esc_html( $color_accent ) . '),to(' . esc_html( $color_accent ) . ')),linear-gradient(linear,left top, left bottom,from(#d2d2d2),to(#d2d2d2));
		}

		.woocommerce div.product .woocommerce-tabs ul.tabs.wc-tabs li.active a {
			color:' . esc_html( $color_accent ) . ';
		}
		
		.woocommerce div.product .woocommerce-tabs ul.tabs.wc-tabs li.active a,
		.woocommerce div.product .woocommerce-tabs ul.tabs.wc-tabs li a:hover {
			border-color:' . esc_html( $color_accent ) . '
		}
		
		.added_to_cart.wc-forward:hover,
		#add_payment_method .wc-proceed-to-checkout a.checkout-button:hover,
		#add_payment_method .wc-proceed-to-checkout a.checkout-button,
		.added_to_cart.wc-forward,
		.woocommerce nav.woocommerce-pagination ul li span.current,
		.woocommerce ul.products li.product .onsale,
		.woocommerce span.onsale,
		.woocommerce .single-product div.product form.cart .button,
		.woocommerce #respond input#submit,
		.woocommerce button.button,
		.woocommerce input.button,
		.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
		.woocommerce-checkout .wc-proceed-to-checkout a.checkout-button,
		.woocommerce #respond input#submit.alt,
		.woocommerce a.button.alt,
		.woocommerce button.button.alt,
		.woocommerce input.button.alt,
		.woocommerce input.button:disabled,
		.woocommerce input.button:disabled[disabled],
		.woocommerce a.button.wc-backward,
		.woocommerce .single-product div.product form.cart .button:hover,
		.woocommerce #respond input#submit:hover,
		.woocommerce button.button:hover,
		.woocommerce input.button:hover,
		.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
		.woocommerce-checkout .wc-proceed-to-checkout a.checkout-button:hover,
		.woocommerce #respond input#submit.alt:hover,
		.woocommerce a.button.alt:hover,
		.woocommerce button.button.alt:hover,
		.woocommerce input.button.alt:hover,
		.woocommerce input.button:disabled:hover,
		.woocommerce input.button:disabled[disabled]:hover,
		.woocommerce #respond input#submit.alt.disabled,
		.woocommerce #respond input#submit.alt.disabled:hover,
		.woocommerce #respond input#submit.alt:disabled,
		.woocommerce #respond input#submit.alt:disabled:hover,
		.woocommerce #respond input#submit.alt:disabled[disabled],
		.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
		.woocommerce a.button.alt.disabled,
		.woocommerce a.button.alt.disabled:hover,
		.woocommerce a.button.alt:disabled,
		.woocommerce a.button.alt:disabled:hover,
		.woocommerce a.button.alt:disabled[disabled],
		.woocommerce a.button.alt:disabled[disabled]:hover,
		.woocommerce button.button.alt.disabled,
		.woocommerce button.button.alt.disabled:hover,
		.woocommerce button.button.alt:disabled,
		.woocommerce button.button.alt:disabled:hover,
		.woocommerce button.button.alt:disabled[disabled],
		.woocommerce button.button.alt:disabled[disabled]:hover,
		.woocommerce input.button.alt.disabled,
		.woocommerce input.button.alt.disabled:hover,
		.woocommerce input.button.alt:disabled,
		.woocommerce input.button.alt:disabled:hover,
		.woocommerce input.button.alt:disabled[disabled],
		.woocommerce input.button.alt:disabled[disabled]:hover,
		.woocommerce-button,
		.woocommerce-Button,
		.woocommerce-button:hover,
		.woocommerce-Button:hover,
		#secondary div[id^=woocommerce_price_filter] .price_slider .ui-slider-range,
		.footer div[id^=woocommerce_price_filter] .price_slider .ui-slider-range,
		div[id^=woocommerce_product_tag_cloud].widget a,
		div[id^=woocommerce_widget_cart].widget .buttons .button,
		div.woocommerce table.my_account_orders .button {
		    background-color: ' . esc_html( $color_accent ) . ';
		}
		
		.added_to_cart.wc-forward,
		.woocommerce .single-product div.product form.cart .button,
		.woocommerce #respond input#submit,
		.woocommerce button.button,
		.woocommerce input.button,
		#add_payment_method .wc-proceed-to-checkout a.checkout-button,
		.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
		.woocommerce-checkout .wc-proceed-to-checkout a.checkout-button,
		.woocommerce #respond input#submit.alt,
		.woocommerce a.button.alt,
		.woocommerce button.button.alt,
		.woocommerce input.button.alt,
		.woocommerce input.button:disabled,
		.woocommerce input.button:disabled[disabled],
		.woocommerce a.button.wc-backward,
		.woocommerce div[id^=woocommerce_widget_cart].widget .buttons .button,
		.woocommerce-button,
		.woocommerce-Button,
		div.woocommerce table.my_account_orders .button {
		    -webkit-box-shadow: 0 2px 2px 0 ' . hestia_hex_rgba( $color_accent, '0.14' ) . ',0 3px 1px -2px ' . hestia_hex_rgba( $color_accent, '0.2' ) . ',0 1px 5px 0 ' . hestia_hex_rgba( $color_accent, '0.12' ) . ';
		    box-shadow: 0 2px 2px 0 ' . hestia_hex_rgba( $color_accent, '0.14' ) . ',0 3px 1px -2px ' . hestia_hex_rgba( $color_accent, '0.2' ) . ',0 1px 5px 0 ' . hestia_hex_rgba( $color_accent, '0.12' ) . ';
		}
		
		.woocommerce nav.woocommerce-pagination ul li span.current,
		.added_to_cart.wc-forward:hover,
		.woocommerce .single-product div.product form.cart .button:hover,
		.woocommerce #respond input#submit:hover,
		.woocommerce button.button:hover,
		.woocommerce input.button:hover,
		#add_payment_method .wc-proceed-to-checkout a.checkout-button:hover,
		.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
		.woocommerce-checkout .wc-proceed-to-checkout a.checkout-button:hover,
		.woocommerce #respond input#submit.alt:hover,
		.woocommerce a.button.alt:hover,
		.woocommerce button.button.alt:hover,
		.woocommerce input.button.alt:hover,
		.woocommerce input.button:disabled:hover,
		.woocommerce input.button:disabled[disabled]:hover,
		.woocommerce a.button.wc-backward:hover,
		.woocommerce div[id^=woocommerce_widget_cart].widget .buttons .button:hover,
		.hestia-sidebar-open.btn.btn-rose:hover,
		.hestia-sidebar-close.btn.btn-rose:hover,
		.pagination span.current:hover,
		.woocommerce-button:hover,
		.woocommerce-Button:hover,
		div.woocommerce table.my_account_orders .button:hover {
			-webkit-box-shadow: 0 14px 26px -12px ' . hestia_hex_rgba( $color_accent, '0.42' ) . ',0 4px 23px 0 rgba(0,0,0,0.12),0 8px 10px -5px ' . hestia_hex_rgba( $color_accent, '0.2' ) . ';
		    box-shadow: 0 14px 26px -12px ' . hestia_hex_rgba( $color_accent, '0.42' ) . ',0 4px 23px 0 rgba(0,0,0,0.12),0 8px 10px -5px ' . hestia_hex_rgba( $color_accent, '0.2' ) . ';
			color: #fff;
		}
		
		#secondary div[id^=woocommerce_price_filter] .price_slider .ui-slider-handle,
		.footer div[id^=woocommerce_price_filter] .price_slider .ui-slider-handle {
			border-color: ' . esc_html( $color_accent ) . ';
		}
		' : '';

		return $custom_css_woocommerce;
	}
}
