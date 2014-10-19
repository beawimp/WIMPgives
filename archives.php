<?php
/**
 * @package    WIMPcamp
 * @subpackage Frame Worker
 **/
?>
<?php get_header(); ?>

	<div id="content-wrapper" class="group">
		<div id="main" role="main">
			<?php if ( have_posts() ) : ?>
				<section id="archive-title">
					<?php $post = $posts[0]; // Hack. Set $post so that the_date() works.

					if ( is_category() ) { // if this is a category archive
						?>
						<h2>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
					<?php } elseif ( is_tag() ) { // if this is a tag archive ?>
						<h2>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
					<?php } elseif ( is_day() ) { // if this is a daily archive ?>
						<h2>Archive for <?php the_time( 'F jS, Y' ); ?></h2>
					<?php } elseif ( is_month() ) { // if this is a monthly archive ?>
						<h2>Archive for <?php the_time( 'F, Y' ); ?></h2>
					<?php } elseif ( is_year() ) { // if this is a yearly archive ?>
						<h2 class="pagetitle">Archive for <?php the_time( 'Y' ); ?></h2>
					<?php } elseif ( is_author() ) { // if this is an author archive ?>
						<h2 class="pagetitle">Author Archive</h2>
					<?php } elseif ( is_paged() ) { // if this is a paged archive ?>
						<h2 class="pagetitle">Blog Archives</h2>
					<?php } ?>
				</section>

				<hr />

				<?php while ( have_posts() ) : the_post(); ?>
					<article <?php post_class( 'group' ); ?>>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

						<div class="date">
							<p><?php echo the_date( 'M j, Y' ); ?></p>
						</div>

						<?php the_post_thumbnail( array( 120, 120 ) ); ?>

						<?php the_excerpt(); ?>

						<p class="read-more button">
							<a href="<?php the_permalink(); ?>">Read more</a></p>

						<p class="comments button">
							<a href="<?php the_permalink(); ?>/#respond"><?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?></a>
						</p>

						<div class="meta">
							<div class="tags">
								<?php if ( ! empty( $posttags ) ) : ?>
									<p>Tags:
										<?php
										$count = 0;
										if ( $posttags ) {
											foreach ( $posttags as $tag ) {
												$count ++;
												echo '<span><a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a></span>';
												if ( $count > 4 ) {
													break;
												}
											}
										}
										?>
									</p>
								<?php else : ?>
									<p>No Tags</p>
								<?php endif; ?>
							</div>
						</div>
					</article>
					<hr />
				<?php endwhile;

				if ( ! is_home() ) {
					echo '<hr />';
				}
				if ( ! is_single() && is_paged() ) : ?>
					<div id="pagination" class="group">
						<div class="alignright button"><?php next_posts_link( 'Older Entries' ); ?></div>
						<div class="alignleft button"><?php previous_posts_link( 'Newer Entries' ); ?></div>
					</div>

				<?php elseif ( is_single() ) : ?>
					<div id="pagination" class="group">
						<?php next_post_link( '<div class="alignright button">Next post: %link</div>', '%title' ); ?>
						<?php previous_post_link( '<div class="alignleft button">Previous post: %link</div>', '%title' ); ?>
					</div>

				<?php endif;
			endif; ?>
		</div>

		<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>