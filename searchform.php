<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="field" name="s" id="s" placeholder="<?php _e('Tap and hit enter to search.', 'tuscan'); ?>" />
	<input type="hidden" class="submit" name="submit" id="searchsubmit" value="Search" />
</form>