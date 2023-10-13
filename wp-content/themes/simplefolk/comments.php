<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="entry-comments">

    <?php if (have_comments()) : ?>
        <h3>
            <?php
            $comments_number = get_comments_number();
            echo esc_html($comments_number) . ' ' . _n('Comment', 'Comments', $comments_number, 'simplefolk');
            echo '<a href="#respond" class="reply">Leave a Reply</a>';
            ?>
        </h3>

        <ol class="comment-list">
            <?php wp_list_comments(array('style' => 'ol', 'avatar_size' => 64, 'short_ping' => true, 'callback' => 'custom_comment')); ?>
        </ol>

    <?php the_comments_pagination(array('prev_text' => __('Previous', 'simplefolk'), 'next_text' => __('Next', 'simplefolk')));

    endif; // Check for have_comments().

    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
        <p class="no-comments"><?php _e('Comments are closed.', 'simplefolk'); ?></p>
    <?php
    endif;
    comment_form(array(
        'title_reply' => __('Leave a Comment', 'simplefolk'),
        'fields' => array(
            'author' => '<p class="comment-form-author"><label for="author">' . __('Name', 'simplefolk') . '</label> <span class="required">*</span><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="100" required /></p>',
            'email' => '<p class="comment-form-email"><label for="email">' . __('Email', 'simplefolk') . '</label> <span class="required"></span><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" /></p>',
            'website' => '<p class="website-comment" style="display: none;"><label for="website">' . __('Website', 'simplefolk') . '</label> <span class="required">*</span><textarea id="website" name="website" cols="45" rows="8" maxlength="50" ></textarea></p>'
        ),
        'comment_field' => '<span class="comment-text"><label for="comment">' . __('Comment * ', 'simplefolk') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></span>',

    ));

    ?>
    <div id="response-container"></div>
</div><!-- #comments -->