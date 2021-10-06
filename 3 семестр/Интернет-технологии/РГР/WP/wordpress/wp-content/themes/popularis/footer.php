</div><!-- end main-container -->
</div><!-- end page-area -->

<?php if (is_active_sidebar('popularis-footer-area')) { ?>  				
    <div id="content-footer-section" class="container-fluid clearfix">
        <div class="container">
            <?php dynamic_sidebar('popularis-footer-area'); ?>
        </div>	
    </div>		
<?php } ?>

<?php do_action('popularis_before_footer'); ?> 
<footer id="colophon" class="footer-credits container-fluid">
    <div class="container">
        <?php do_action('popularis_generate_footer'); ?> 
    </div>	
</footer>
</div><!-- end page-wrap -->

<?php do_action('popularis_after_footer'); ?>

<?php if (function_exists('popularis_header_cart') && class_exists('WooCommerce')) { ?>
    <div class="float-cart-login hidden-xs" >
        <?php popularis_header_cart(); ?>
        <?php popularis_my_account(); ?>
    </div>	
<?php } ?>

<?php wp_footer(); ?>

</body>
</html>
