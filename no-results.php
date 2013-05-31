<?php

/*
# Title: The template part for displaying a message that posts cannot be found.

# File name: no-results.php
# Description: Learn more: http://codex.wordpress.org/Template_Hierarchy
# Tags: wordpress, php, theme, template, no-result
# Project: Bright

# Author: Janik von Rotz
# Author Contact: http://janikvonrotz.ch

# Create Date: 2013-05-28
# Last Edit Date: 2013-05-28
# Version: 1.0.0
*/

?>
 
<article id="post-0" class="post no-results not-found">

    <header class="entry-header">
	
        <h1 class="entry-title"><?php _e( 'Nothing Found', 'bright' ); ?></h1>
    
	</header>
 
    <div class="entry-content">
	
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
 
            <p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'bright' ), admin_url( 'post-new.php' ) ); ?></p>
 
        <?php elseif ( is_search() ) : ?>
 
            <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bright' ); ?></p>
            <?php get_search_form(); ?>
 
        <?php else : ?>
 
            <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'bright' ); ?></p>
            <?php get_search_form(); ?>
 
        <?php endif; ?>
		
    </div>
	
</article>