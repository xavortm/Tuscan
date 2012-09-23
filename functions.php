<?php
// Post formats
add_theme_support( 'post-formats', array( 'link' ) );
add_post_type_support( 'page', 'post-formats' );

// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'tuscan', get_template_directory() . '/languages' );

// Add custom background support
$defaults = array(
    'default-color'          => 'ffffff',
    'default-image'          => '',
    'wp-head-callback'       => '_custom_background_cb',
    'admin-head-callback'    => '',
    'admin-preview-callback' => '' );
add_theme_support( 'custom-background', $defauts);

// Add editor style
add_editor_style( get_template_directory() . '/inc/css/custom-editor-style.css' );

// Register sidebar
function widgets_init() {
	if ( function_exists('register_sidebar') ) {

	register_sidebar(array(
	  	'name'          => __('Main Sidebar', 'tuscan'),
	  	'id'            => 'primary',
	  	'description'   => 'Widgets in this area will be shown on the right-hand side.',
	  	'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
	 	'before_title'  => '<h3 class="sidebar-heading">',
	  	'after_title'   => '</h3>'
	));
    
    }
}
add_action( 'init', 'widgets_init' );

// Register menus
register_nav_menus(array(
    'main-menu' => __( 'Main Menu' )
    )
);

// Line required by Wordpress Codex
if ( ! isset( $content_width ) ) $content_width = 960;
add_theme_support( 'automatic-feed-links' );

// Alow the use of thumbnails
add_theme_support( 'post-thumbnails' );

/* ------------------------------------------------------------------------ * 
 * Comments functions
 * ------------------------------------------------------------------------ */   

// Custom callback to list comments in the your-theme style
function custom_comments($comment, $args, $depth) {
    $GLOBALS['comment']       = $comment;
    $GLOBALS['comment_depth'] = $depth;
  ?>
    <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
        <div class="comment-meta"><?php
            printf(__('Posted %1$s at %2$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'tuscan') ,
            get_comment_date(),
            get_comment_time(),
            '#comment-' . get_comment_ID() );

            edit_comment_link(__('Edit', 'tuscan'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?>
        </div>

    <?php if ($comment->comment_approved == '0') {
    echo "\t\t\t\t\t<span class='unapproved'>"; _e('Your comment is awaiting moderation.', 'tuscan'); echo '</span>\n'; } ?>
 		
        <?php  // echo the comment reply link
        if($args['type'] == 'all' || get_comment_type() == 'comment') :
            comment_reply_link(array_merge($args, array(
                'reply_text'    => _('Reply', 'tuscan'), 
                'login_text'    => __('Log in to reply.', 'tuscan'),
                'depth'         => $depth,
                'before'        => '<div class="comment-reply-link">', 
                'after'         => '</div>'
            )));
        endif; ?>

    <div class="comment-content">
        <?php comment_text() ?>
    </div>
<?php } // end custom_comments

// Custom callback to list pings
function custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
        ?>
            <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
                <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'tuscan'),
                        get_comment_author_link(),
                        get_comment_date(),
                        get_comment_time() );
                        edit_comment_link(__('Edit', 'tuscan'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'tuscan') ?>
            <div class="comment-content">
                <?php comment_text() ?>
            </div>
<?php } // end custom_pings

// Produces an avatar image with the hCard-compliant photo class
function commenter_link() {
    $commenter = get_comment_author_link();
    if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
        $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
    } else {
        $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
    }
    $avatar_email = get_comment_author_email();
    echo ' <span class="fn n">' . $commenter . '</span>';
} // end commenter_link

function comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<span class="comment-author vcard"><?php printf( __('Comment by:', 'tuscan') . ' %s <span class="says"> | </span>', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></span><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e('Your comment is awayting moderation', 'tuscan') ?></em>
			<br />
		<?php endif; ?>

		<span class="comment-meta commentmetadata"><?php
				/* translators: 1: date, 2: time */
				printf( '%1$s at %2$s' , get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __('(Edit)', 'tuscan') );
		?> <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e('Pingback:', 'tuscan') ; ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'tuscan') ); ?></p>
	<?php
			break;
	endswitch;
}