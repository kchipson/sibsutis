<?php get_header(); ?>

<div class="row">
    <article class="col-md-<?php popularis_main_content_width_columns(); ?>">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>                          
                <div <?php post_class(); ?>>
                    <div class="news-thumb">
                        <?php the_post_thumbnail('popularis-img'); ?>
                    </div>
                    <header class="single-head">                              
                        <?php the_title('<h1 class="single-title">', '</h1>'); ?>
                        <time class="posted-on published" datetime="<?php the_time('Y-m-d'); ?>"></time>                                                        
                    </header>
                    <div class="main-content-page">                            
                        <div class="single-entry-summary">                              
                            <?php do_action('popularis_before_content'); ?>
                            <?php the_content(); ?>
                            <?php do_action('popularis_after_content'); ?>
                        </div>                               
                        <?php wp_link_pages(); ?>                                                                                     
                        <?php comments_template(); ?>
                    </div>
                </div>        
            <?php endwhile; ?>        
        <?php else : ?>            
            <?php get_template_part('content', 'none'); ?>        
        <?php endif; ?>    
    </article>       
    <?php get_sidebar('right'); ?>
</div>

<?php 
get_footer();
