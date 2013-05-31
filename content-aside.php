<?php
/*
# Title: Content Aside Template

# File name: content-aside.php
# Description: The template for displaying posts in the Aside post format
# Tags: wordpress, php, theme, template, content, aside
# Project: Bright

# Author: Janik von Rotz
# Author Contact: http://janikvonrotz.ch

# Create Date: 2013-05-27
# Last Edit Date: 2013-05-27
# Version: 1.0.0
*/
 
?>
 
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header">
        <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'bright' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
    </header>
 
	<!-- Only display Excerpts for Search -->
    <?php if ( is_search() ) : ?>
	
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
		
    <?php else : ?>
	
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bright' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'bright' ), 'after' => '</div>' ) ); ?>
		</div>
		
    <?php endif; ?>
 
    <footer class="entry-meta">
	
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'bright' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo get_the_date(); ?></a>
       
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		
			<span class="sep"> | </span>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'bright' ), __( '1 Comment', 'bright' ), __( '% Comments', 'bright' ) ); ?></span>
		
		<?php endif; ?>
 
        <?php edit_post_link( __( 'Edit', 'bright' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
		
    </footer>
	
</article>