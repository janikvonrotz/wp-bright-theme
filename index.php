<?php 
/*
# Title: The main template file

# File name: header.php
# Description:
This is the most generic template file in a WordPress theme
and one of the two required files for a theme (the other being style.css).
It is used to display a page when nothing more specific matches a query.
E.g., it puts together the home page when no home.php file exists.
Learn more: http://codex.wordpress.org/Template_Hierarchy

# Tags: wordpress, theme, index
# Project: Bright

# Author: Janik von Rotz
# Author Contact: http://janikvonrotz.ch

# Create Date: 2013-05-17
# Last Edit Date: 2013-05-23
# Version: 1.0.0
*/

get_header(); ?>

<div id="primary" class="content-area row-fluid">
    <div id="content" class="site-content span8 offset2" role="main">
	
	<?php if ( have_posts() ) : ?>
	
		<!-- Start the Loop -->
		<?php bright_content_nav( 'nav-above' ); ?>
		
		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			/*
			Include the Post-Format-specific template for the content.
			If you want to overload this in a child theme then include a file
			called content-___.php (where ___ is the Post Format name) and that will be used instead.
			*/
			get_template_part( 'content', get_post_format() );
			?>
			
		<?php endwhile; ?>
		
		<?php bright_content_nav( 'nav-below' ); ?>
		
	<?php endif; ?>

	</div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>