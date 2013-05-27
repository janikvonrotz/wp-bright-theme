<?php
/*
# Title: Custom template tags for this theme.

# File name: template-tags.php
# Description: Eventually, some of the functionality here could be replaced by core features
# Tags: wordpress, theme, template, tags
# Project: Bright

# Author: Janik von Rotz
# Author Contact: http://janikvonrotz.ch

# Create Date: 2013-05-17
# Last Edit Date: 2013-05-17
# Version: 1.0.0
*/



// Prints HTML with meta information for the current post-date/time and author.
if ( ! function_exists( 'bright_posted_on' ) ) :

	function bright_posted_on() {

		printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'bright' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'bright' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);
		
	}

endif;



// Returns true if a blog has more than 1 category
function bright_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
	
        // Create an array of all the categories that are attached to posts
        $all_the_cool_cats = get_categories( array(
            'hide_empty' => 1,
        ) );
 
        // Count the number of categories that are attached to the posts
        $all_the_cool_cats = count( $all_the_cool_cats );
 
        set_transient( 'all_the_cool_cats', $all_the_cool_cats );
    }
 
    if ( '1' != $all_the_cool_cats ) {
	
        // This blog has more than 1 category so bright_categorized_blog should return true
        return true;
		
    } else {
	
        // This blog has only 1 category so bright_categorized_blog should return false
        return false;
		
    }
}



// Flush out the transients used in bright_categorized_blog
function bright_category_transient_flusher() {
    // Like, beat it. Dig?
    delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'bright_category_transient_flusher' );
add_action( 'save_post', 'bright_category_transient_flusher' );



// Display navigation to next/previous pages when applicable
if ( ! function_exists( 'bright_content_nav' ) ):

	function bright_content_nav( $nav_id ) {
	
		global $wp_query, $post;
	 
		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );
	 
			if ( ! $next && ! $previous )
				return;
		}
	 
		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
			return;
	 
		$nav_class = 'site-navigation paging-navigation';
		if ( is_single() )
			$nav_class = 'site-navigation post-navigation';
	 
		?>
		<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
			<!-- <h1 class="assistive-text"><?php _e( 'Post navigation', 'bright' ); ?></h1> -->
	 
		<!-- navigation links for single posts -->
		<?php if ( is_single() ) :  ?>
	 
			<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'bright' ) . '</span> %title' ); ?>
			<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'bright' ) . '</span>' ); ?>
		
		<!-- navigation links for home, archive, and search pages -->
		<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : ?>
	 
			<?php if ( get_next_posts_link() ) : ?>
			
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'bright' ) ); ?></div>
			
			<?php endif; ?>
	 
			<?php if ( get_previous_posts_link() ) : ?>
			
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'bright' ) ); ?></div>
			
			<?php endif; ?>
	 
		<?php endif; ?>
	 
		</nav><!-- #<?php echo $nav_id; ?> -->
		<?php
	}
	
endif;