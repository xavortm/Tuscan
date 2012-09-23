<?php 

// Start the main loop. Nothing diferent here.
while ( have_posts() ) : the_post(); ?>

<?php if ( ( function_exists( 'get_post_format' ) && 'link' == get_post_format( $post->ID ) )  ) : ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
		<h2 class="entry-title"><a href="<?php echo get_the_content(); ?>"><?php the_title(); ?></a></h2>
	</div>

<?php else : ?> 

<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
	<span class="entry-category"><?php the_category(' ') ?></span>
    <h2 class="entry-title" href="<?php the_permalink(); ?>"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>

    <?php if( has_post_thumbnail() ) {?>
    	<div class="entry-thumbnail"><a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?></a></div> 
    <?php } ?>
    <section class="entry-content"><?php the_content($more_link_text = __( 'Read More', 'tuscan' )); ?></section>
    <a href="" class="more-link"></a>
</article>


<?php endif; endwhile; ?>


<div class="navigation"><p><?php posts_nav_link(); ?></p></div>