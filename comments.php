<?php 
/**
 * The template for displaying Comments.
 * -------------------------------------
 * The area of the page that contains both current comments
 * and the comment form.
 */
?>

<?php 
// Prevent users from viewing this page [Just Secure]
if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>  
    <?php die('You can not access this page directly!'); ?>  
<?php endif; ?>  

<div id="comments">
<?php 
// Are the comments password protected?
if ( post_password_required() ) : ?>

<p class="nopassword"><?php 

    // Show the message for post with password protected comments
    _e('This post is password protected. Enter the password to view any comments.', 'tuscan'); 

?></p>
</div><!-- #comments -->

<?php return; endif; ?>


<?php 
// --------------------------------------------------------------
// COMMENTS SECTION
// --------------------------------------------------------------
if ( have_comments() ) : ?>
    <h3 id="comments-title"><?php

    // Show the message on top of all comments
    printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s',   // The message it self
        get_comments_number() ),                                    // How many are the comments?
        number_format_i18n( get_comments_number() ),                // Output will display comments count in the correct localized format for your blog.
        '<em>' . get_the_title() . '</em>' );                       // The title of the post

    ?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    // Are there comments to navigate through? ?>

    <div class="navigation">
        <div class="nav-previous"><?php previous_comments_link('<span class="meta-nav">&larr;</span>'.__('Older Comments', 'tuscan') ); ?></div>
        <div class="nav-next"><?php next_comments_link(__('Newer Comments', 'tuscan').' <span class="meta-nav">&rarr;</span>'); ?></div>
    </div> <!-- .navigation -->

<?php endif; ?>

    <ol class="commentlist">
    <?php
        /* Loop through and list the comments. Tell wp_list_comments()
         * to use derkox_comment() to format the comments.
         * If you want to overload this in a child theme then you can
         * define derkox_comment() and that will be used instead.
         * See derkox_comment() in derkox/functions.php for more.
         */
        wp_list_comments( array( 'callback' => 'comments' ) );
    ?>
    </ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
    <div class="navigation">
        <div class="nav-previous"><?php previous_comments_link('<span class="meta-nav">&larr;</span>'.__('Older Comments', 'tuscan')); ?></div>
        <div class="nav-next"><?php next_comments_link(__('Newer Comments', 'tuscan').'<span class="meta-nav">&rarr;</span>'); ?></div>
    </div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

<?php else : 
    // or, if we don't have comments:
    // ------------------------------

    /* If there are no comments and comments are closed,
     * let's leave a little note, shall we?
     */
    if ( !comments_open() ) : ?>

    <p class="nocomments"><?php _e('Comments are closed.', 'tuscan'); ?></p>
<?php endif; // end ! comments_open() ?>
<?php endif; // end have_comments() ?>

<?php 
    $args = array( 'comment_notes_after' => '' );
    comment_form($args); 
?>

</div><!-- #comments -->
