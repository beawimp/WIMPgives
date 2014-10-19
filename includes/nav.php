<?php if ( ! is_front_page() ) {
	echo '<hr />';
} ?>
<?php if ( ! is_single() && is_paged() ) : ?>
	<div id="pagination" class="group">
		<div class="alignright"><?php next_posts_link( 'Older Entries' ); ?></div>
		<div class="alignleft"><?php previous_posts_link( 'Newer Entries' ); ?></div>
	</div>

<?php elseif ( is_single() ) : ?>
	<div id="pagination" class="group">
		<?php next_post_link( '<div class="alignright">&raquo; %link</div>', '%title' ); ?>
		<?php previous_post_link( '<div class="alignleft">&laquo; %link</div>', '%title' ); ?>
	</div>

<?php endif; ?>