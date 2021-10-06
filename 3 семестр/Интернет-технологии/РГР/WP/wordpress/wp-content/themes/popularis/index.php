<?php
get_header();
?>

<div class="row">

    <div class="col-md-<?php popularis_main_content_width_columns(); ?>">

        <?php
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
