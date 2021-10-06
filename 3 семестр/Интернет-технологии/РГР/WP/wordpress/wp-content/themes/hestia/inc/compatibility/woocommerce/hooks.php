<?php
/**
 * Hooks for WooCommerce which only needs to be used when WooCommerce is active.
 *
 * @package Hestia
 * @since Hestia 1.0.2
 */

/**
 * Layout for the main content of shop page
 *
 * @see  hestia_woocommerce_before_main_content()
 * @see  hestia_woocommerce_after_main_content()
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );  /* Remove the sidebar */
add_action( 'woocommerce_before_main_content', 'hestia_woocommerce_before_main_content', 10 );
add_action( 'woocommerce_after_main_content', 'hestia_woocommerce_after_main_content', 9 );

/* Remove Related Products and move it below product.*/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20 );

/* Remove title on shop main */
add_filter( 'woocommerce_show_page_title', 'hestia_woocommerce_hide_page_title' );

/**
 * Layout for each product content on the shop page
 *
 * @see hestia_woocommerce_template_loop_product_thumbnail()
 * @see hestia_woocommerce_before_shop_loop_item()
 * @see hestia_woocommerce_after_shop_loop_item()
 * @see hestia_woocommerce_template_loop_product_title()
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 20 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 ); /* Remove the default thumbnail */
add_action( 'woocommerce_before_shop_loop_item_title', 'hestia_woocommerce_template_loop_product_thumbnail', 10 );

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 ); /* Remove unused link */
add_action( 'woocommerce_before_shop_loop_item', 'hestia_woocommerce_before_shop_loop_item', 10 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 ); /* Remove unused link */
add_action( 'woocommerce_after_shop_loop_item', 'hestia_woocommerce_after_shop_loop_item', 20 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' ); /* Remove default add to cart on single product */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 ); /* Remove default product title on single product */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 ); /* Remove default rating on single product */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 ); /* Remove default price on single product */
add_action( 'woocommerce_shop_loop_item_title', 'hestia_woocommerce_template_loop_product_title', 10 );

/* Move breadcrumbs on the single page */
if ( is_single( 'product' ) ) {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_breadcrumb', 10, 0 );


add_filter( 'woocommerce_add_to_cart_fragments', 'hestia_woocommerce_header_add_to_cart_fragment' ); /* Ensure cart contents update when products are added to the cart via AJAX ) */

/**
 * Checkout page
 *
 * @see hestia_coupon_after_order_table_js()
 * @see hestia_coupon_after_order_table()
 */
add_action( 'woocommerce_before_checkout_form', 'hestia_coupon_after_order_table_js' );
add_action( 'woocommerce_checkout_order_review', 'hestia_coupon_after_order_table' );

/**
 * Reposition breadcrumb, sorting and results count
 */
add_action( 'woocommerce_before_main_content', 'hestia_woocommerce_remove_shop_elements' );
add_action( 'hestia_woocommerce_custom_reposition_left_shop_elements', 'hestia_woocommerce_reposition_left_shop_elements' );
add_action( 'hestia_woocommerce_custom_reposition_right_shop_elements', 'hestia_woocommerce_reposition_right_shop_elements' );

/**
 * Remove category on single product
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'hestia_cart_link_fragment' );

/**
 * Reposition Cross Sells after Cart Totals
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );

/**
 * Add before and after cart totals code for card.
 */
add_action( 'woocommerce_before_cart_totals', 'hestia_woocommerce_before_cart_totals', 1 );
add_action( 'woocommerce_after_cart_totals', 'hestia_woocommerce_after_cart_totals', 1 );

/**
 * Change product-category classes based on the customizer layout options for shop loop items
 */
add_filter( 'product_cat_class', 'hestia_woocommerce_loop_category_classes', 10, 1 );
