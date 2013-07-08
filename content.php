<?php
/**
 * @package Bright
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<header class="entry-header">				
		
			<div class="alignleft">
			<?php the_post_thumbnail('thumbnail', array('class' => 'img-circle'));  ?>
			</div>
		
		<span class="clearfix visible-phone"></span>
		
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta row">
			<?php bright_posted_on(); ?>
			<?php bright_posted_by(); ?>			
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	
	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">		
		<?php bright_more_link_text(); ?>
		<?php bright_wp_link_pages(); ?>		
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta row">
	
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ' ', 'bright' ) );
				if ( $categories_list && bright_categorized_blog() ) :
			?>			
			
			<?php bright_get_the_category_list($categories_list); ?>
	
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ' ', 'bright' ) );
				if ( $tags_list ) :
			?>			
			
			<?php  bright_get_the_tag_list($tags_list); ?>
						
			<?php endif; // End if $tags_list ?>
			
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			
			<?php bright_comments_popup_link(); ?>

		<?php endif; ?>
				
		<?php bright_edit_post_link(); ?>
		
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
