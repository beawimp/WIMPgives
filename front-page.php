<?php get_header(); ?>
		<section id="home-image">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/images/home-image.jpg'); ?> " alt="WIMPgives" />
		</section>

		<section id="body-content" class="group">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; endif; ?>

		</section><!--[END #body-content]-->
	</section><!--[EMD #content-wrapper]-->
</section><!--[END #body-wrap]-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
