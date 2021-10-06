<?php get_header(); ?>

<div class="row">
    <div class="col-md-<?php popularis_main_content_width_columns(); ?>">
        <?php
        if (is_search()) {
            /* translators: %s: search result string */
            echo "<h1 class='search-head text-center'>" . sprintf(esc_html__('Search Results for: %s', 'popularis'), get_search_query()) . "</h1>";
        }
        if (have_posts()) :
            while (have_posts()) : the_post();
                get_template_part('content', get_post_format());
            endwhile;
            the_posts_pagination();
        else :
            get_template_part('content', 'none');
        endif;
        ?>
    </div>
    <?php get_sidebar('right'); ?>
</div>

<?php
get_footer();
