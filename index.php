<?php get_header(); ?>

	<div id="content-wrapper" class="group">
		<div id="main" role="main">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				$posttags = get_the_tags(); ?>

				<article <?php post_class( 'group' ); ?>>

					<h2><a href="<?php the_permalink(); ?>"><?php esc_html( the_title() ); ?></a>
					</h2>

					<div class="date">
						<p><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></p>
					</div>

					<div class="featured-img alignleft">
						<?php the_post_thumbnail( array( 120, 120 ) ); ?>
					</div>

					<?php the_excerpt(); ?>

					<p class="read-more button"><a href="<?php the_permalink(); ?>">Read more</a>
					</p>

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

											echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a>, ';
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

				if ( ! is_single() && is_paged() ) :
					?>
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