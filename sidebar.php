<aside class="sidebar">
  <ul><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Main Sidebar") ) : ?>
  	<h3><?php _e('Add some stuff in the sidebar!', 'tuscan'); ?></h3>
  <?php endif; ?>
  </ul>
</aside><!--/rightsidebar-->
