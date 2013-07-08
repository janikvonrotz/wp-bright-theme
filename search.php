<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Bright
 */

get_header(); ?>

	<div id="primary" class="content-area row">
		<div id="content" class="site-content span7 offset1" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="entry-header page-header">
				<h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'bright' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php bright_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; ?>

		</div><!-- #content -->
		


	<?php get_sidebar(); ?>

</div><!-- #primary -->

<?php get_footer(); ?>