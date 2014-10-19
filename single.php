<?php get_header(); ?>

	<div id="content-wrapper" class="group">
		<div id="main" role="main">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php esc_attr( get_the_ID() ); ?>" <?php post_class( 'group' ); ?>>
					<h1><?php esc_html( the_title() ); ?></h1>
					<p class="post-meta">Posted by <?php esc_html( the_author() ); ?> on <?php echo date( 'M j, Y' ); ?></p>

					<?php the_content(); ?>

					<div class="meta">
						<div class="categories">
							<p>Posted In: <?php the_category( ', ', 'multiple' ) ?></p>
						</div>
						<div class="tags">
							<p>Tags: <?php the_tags( '', ' ', '' ); ?></p>
						</div>
					</div>

					<?php edit_post_link( 'Edit this entry', '', '' ); ?>
				</article>

				<hr />

				<?php comments_template(); ?>

			<?php endwhile;
				include('includes/nav.php');
			endif; ?>
		</div>

		<?php get_sidebar(); ?>

	</div>
<?php get_footer(); ?>