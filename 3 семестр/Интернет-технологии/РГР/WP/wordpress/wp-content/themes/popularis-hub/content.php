<article class="blog-article col-md-6">
    <div <?php post_class(); ?>>                    
        <div class="post-item">
            <?php if (has_post_thumbnail()) { ?>
                <div class="news-thumb ">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail('popularis-img'); ?>
                    </a>
                    <?php popularis_entry_footer('cats') ?>
                </div>
                <div class="news-text-wrap thumbnail-on col-md-12">
            <?php } else { ?>
                <div class="news-text-wrap col-md-12">
                    <?php popularis_entry_footer('cats') ?>
            <?php } ?>
                    <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                    <span class="posted-date">
                        <?php echo esc_html(get_the_date()); ?>
                    </span>
                    <?php popularis_author_meta(); ?>
                    <div class="post-excerpt">
                        <?php the_excerpt(); ?>
                    </div><!-- .post-excerpt -->
                </div><!-- .news-text-wrap -->

            </div><!-- .post-item -->
        </div>
</article>
