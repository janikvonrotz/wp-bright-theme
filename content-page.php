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
	
	
	<footer class="entry-meta row-fluid">
		
		<?php bright_edit_post_link(); ?>
		
	</footer><!-- .entry-meta -->
	
</article><!-- #post-## -->
