<?php

/*
# Title: The Template for displaying all single posts

# File name: single.php
# Description: 
# Tags: wordpress, php, theme, template, single, post
# Project: Bright

# Author: Janik von Rotz
# Author Contact: http://janikvonrotz.ch

# Create Date: 2013-05-28
# Last Edit Date: 2013-05-28
# Version: 1.0.0
*/
 
get_header(); ?>
 
<div id="primary" class="content-area row-fluid">

    <div id="content" class="site-content span8 offset2" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php bright_content_nav( 'nav-above' ); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php bright_content_nav( 'nav-below' ); ?>

		<?php
		// If comments are open or we have at least one comment, load up the comment template		
		if ( comments_open() || '0' != get_comments_number() )
			comments_template( '', true );	
		?>

		<?php endwhile; ?>

	</div>
	
</div>
 
<?php get_sidebar(); ?>
<?php get_footer(); ?>