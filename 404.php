<?php get_header(); ?>
		<div id="main-content">
			<section id="404-page" class="content">
				<h1><?php esc_html_e( 'Error. Page not found.', 'wimpgives' ); ?></h1>
				<article class="entry">
					<p>The page you were looking cannot be found. Please use the navigation links or you may search for the page you are looking for.</p>

					<?php get_search_form(); ?>

				</article>
			</section>
			<hr />
		</div><!--[END #main-content]-->
	</div><!--[END #main]-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>