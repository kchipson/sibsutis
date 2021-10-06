<?php 
get_header(); 
?>
<!-- start Woo content container -->
<div class="row">
    <article class="col-md-<?php popularis_main_content_width_columns(); ?>">
        <?php woocommerce_content(); ?>
    </article>       
    <?php get_sidebar('right'); ?>
</div>
<!-- end Woo content container -->

<?php
get_footer();
