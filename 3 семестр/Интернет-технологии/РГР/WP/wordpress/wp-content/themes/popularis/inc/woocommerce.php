<?php
if (!function_exists('popularis_cart_link')) {

    function popularis_cart_link() {
        ?>	
        <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_html_e('View your shopping cart', 'popularis'); ?>">
            <i class="fa fa-shopping-bag"><span class="count"><?php echo wp_kses_data(WC()->cart->get_cart_contents_count()); ?></span></i>
            <div class="amount-cart"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></div> 
        </a>
        <?php
    }

}

if (!function_exists('popularis_header_cart')) {

    function popularis_header_cart() {
        if (get_theme_mod('woo_header_cart', 1) == 1) {
            ?>
            <div class="header-cart float-cart">
                <div class="header-cart-block">
                    <div class="header-cart-inner">
                        <?php popularis_cart_link(); ?>
                        <ul class="site-header-cart menu list-unstyled text-center">
                            <li>
                                <?php the_widget('WC_Widget_Cart', 'title='); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
        }
    }

}

if (!function_exists('popularis_my_account')) {

    function popularis_my_account() {
        if (get_theme_mod('woo_account', 1) == 1) {
            ?>
            <div class="header-my-account float-login">
                <div class="header-login"> 
                    <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" title="<?php esc_attr_e('My Account', 'popularis'); ?>">
                        <i class="fa fa-user-circle-o"></i>
                    </a>
                </div>
            </div>
            <?php
        }
    }

}

if (!function_exists('popularis_header_add_to_cart_fragment')) {
    add_filter('woocommerce_add_to_cart_fragments', 'popularis_header_add_to_cart_fragment');

    function popularis_header_add_to_cart_fragment($fragments) {
        ob_start();

        popularis_cart_link();

        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }

}
