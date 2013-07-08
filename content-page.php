<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Bright
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php bright_wp_link_pages(); ?>
	</div><!-- .entry-content -->
	
	<?php if ( is_user_logged_in() ) : ?>
	
		<footer class="entry-meta row-fluid">			
			<?php bright_edit_post_link(); ?>			
		</footer><!-- .entry-meta -->
	
	<?php endif; // is_user_logged_in() ?>
	
</article><!-- #post-## -->
