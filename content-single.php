<?php

/*
# Title: Content Single Template

# File name: content-single.php
# Description: 
# Tags: wordpress, php, theme, template, single, content
# Project: Bright

# Author: Janik von Rotz
# Author Contact: http://janikvonrotz.ch

# Create Date: 2013-05-28
# Last Edit Date: 2013-05-28
# Version: 1.0.0
*/

?>
 
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header">
	
        <h1 class="entry-title"><?php the_title(); ?></h1>
 
        <div class="entry-meta">
		
            <?php bright_posted_on(); ?>
			
        </div>
		
    </header>
	
 
    <div class="entry-content">
	
        <?php the_content(); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'bright' ), 'after' => '</div>' ) ); ?>
   
   </div>
 
    <footer class="entry-meta">
        <?php
		
            // translators: used between list items, there is a space after the comma
            $category_list = get_the_category_list( __( ', ', 'bright' ) );
 
            // translators: used between list items, there is a space after the comma
            $tag_list = get_the_tag_list( '', ', ' );
 
            if ( ! bright_categorized_blog() ) {
                
				// This blog only has 1 category so we just need to worry about tags in the meta text
                if ( '' != $tag_list ) {
                   
				   $meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'bright' );
                
				} else {
                    
					$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'bright' );
                
				}
				
            } else {
			
                // But this blog has loads of categories so we should probably display them here
                if ( '' != $tag_list ) {
				
                    $meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'bright' );
                
				} else {
				
                    $meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'bright' );
                }
 
            } // end check for categories on this blog
 
            printf(
                $meta_text,
                $category_list,
                $tag_list,
                get_permalink(),
                the_title_attribute( 'echo=0' )
            );
			
        ?>
 
        <?php edit_post_link( __( 'Edit', 'bright' ), '<span class="edit-link">', '</span>' ); ?>
    
	</footer>
</article>