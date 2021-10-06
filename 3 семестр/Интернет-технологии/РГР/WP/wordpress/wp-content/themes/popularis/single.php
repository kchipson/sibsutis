<?php get_header(); ?>

<!-- start content container -->
<div class="row">      
    <article class="col-md-<?php popularis_main_content_width_columns(); ?>">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>                         
                <div <?php post_class(); ?>>
                    <div class="news-thumb">
                        <?php the_post_thumbnail('popularis-img'); ?>
                    </div>
                    <div class="single-head">
                        <?php popularis_entry_footer('cats'); ?>
                        <?php the_title('<h1 class="single-title">', '</h1>'); ?>
                        <span class="posted-date">
                            <?php echo esc_html(get_the_date()); ?>
                        </span>
                        <?php popularis_author_meta(); ?>
                    </div>
                    <div class="single-content">
                        <div class="single-entry-summary">
                            <?php do_action('popularis_before_content'); ?> 
                            <?php the_content(); ?>
                            <?php do_action('popularis_after_content'); ?> 
                        </div>
                        <?php wp_link_pages(); ?>
                        <?php popularis_entry_footer('tags'); ?>
                    </div>
                    <?php popularis_prev_next_links(); ?>
                    <?php
                    $authordesc = get_the_author_meta('description');
                    if (!empty($authordesc)) {
                        ?>
                        <div class="single-footer row">
                            <div class="col-md-4">
                                <div class="postauthor-container">			  
                                    <div class="postauthor-title">
                                        <h4 class="about">
                                            <?php esc_html_e('About The Author', 'popularis'); ?>
                                        </h4>
                                        <div class="">
                                            <span class="fn">
                                                <?php the_author_posts_link(); ?>
                                            </span>
                                        </div> 				
                                    </div>        	
                                    <div class="postauthor-content">	             						           
                                        <p>
                                            <?php the_author_meta('description') ?>
                                        </p>					
                                    </div>	 		
                                </div>
                            </div>
                            <div class="col-md-8">
                                <?php comments_template(); ?> 
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="single-footer">
                            <?php comments_template(); ?> 
                        </div>
                    <?php } ?>
                </div>        
            <?php endwhile; ?>        
        <?php else : ?>            
            <?php get_template_part('content', 'none'); ?>        
        <?php endif; ?>    
    </article> 
    <?php get_sidebar('right'); ?>
</div>
<!-- end content container -->

<?php get_footer(); ?>
