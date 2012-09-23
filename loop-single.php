<div class="entries>">
  	
<?php 

	// Start the main loop. Nothing diferent here.
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	?>

<div class="posts">

<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?> >
    <hgroup>
      <span class="entry-category"><?php the_category(' ') ?></span>
      <h2 class="entry-title" href="<?php the_permalink(); ?>"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
      <p class="entry-meta">By: <?php the_author(); ?> <?php edit_post_link('(Edit)'); ?></p>
    </hgroup>
    <section class="entry-content"><?php the_content(); ?></section>
    <?php if(has_tag()) { ?>
    <p class="entry-tags"><?php the_tags(); }?></p>

</article>

</div><!-- END POSTS -->
<?php endwhile; else : ?>
	<h3 class="no-posts"><?php _e('Sorry, there are no posts yet.', 'tuscan'); ?></h3>
	<p><?php _e('Please, visit me soon, i am still crafting the blog.', 'tuscan'); ?></p>
<?php endif ?>


  </div>
  <div class="navigation">
 		<?php paginate_comments_links(); ?> 
 	</div>

	<?php comments_template(); ?> 

	<div class="navigation">
 		<?php paginate_comments_links(); ?> 
 	</div>
</section>