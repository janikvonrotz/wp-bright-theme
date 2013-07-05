<?php
/**
 * @package Bright
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
	
		<?php the_post_thumbnail('thumbnail-banner', array('class' => 'aligncenter img-rounded'));  ?>
	
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta row-fluid">
			<?php bright_posted_on(); ?>
			<?php bright_posted_by(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php bright_wp_link_pages(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta row-fluid">
	
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
