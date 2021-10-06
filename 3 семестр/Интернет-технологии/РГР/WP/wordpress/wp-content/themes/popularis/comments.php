<?php
if (post_password_required()) {
    return;
}

if (is_single() || is_page()) :
    ?>
    <div id="comments" class="comments-template">
        <?php if (have_comments()) : ?>
            <h4 id="comments">
                <?php
                $comments_number = get_comments_number();
                if ('1' === $comments_number) {
                    /* translators: %s: post title */
                    printf(esc_html_x('One thought on &ldquo;%s&rdquo;', 'comments title', 'popularis'), esc_html(get_the_title()));
                } else {
                    /* translators: 1: number of comments, 2: post title */
                    printf(esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comments_number, 'comments title', 'popularis')), esc_html(number_format_i18n($comments_number)), esc_html(get_the_title()));
                }
                ?>
            </h4>
            <ul class="commentlist list-unstyled">
                <?php
                wp_list_comments();
                paginate_comments_links();

                if (is_singular()) {
                    wp_enqueue_script('comment-reply');
                }
                ?>
            </ul>
            <?php
            comment_form();
        else :
            if (comments_open()) :
                comment_form();
            endif;
        endif;
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
            ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'popularis'); ?></p>
            <?php
        endif;
        ?>
    </div>
    <?php
 
endif;
