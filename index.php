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
	
	<!-- post loop -->
	<?php while ( have_posts() ) : the_post() ?>
	
	<!-- 
	Create an HTML5 article section with a unique ID thanks to the_ID() and 
	semantic classes with post_class() 
	-->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<!-- post header -->
		<header class="entry-header">

			<!-- post title -->
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', '_s' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			
			<!-- post meta -->
			 <div class="entry-content">
				  <?php the_content( __( 'Continue reading <span class="meta-nav">→</span>', 'bright' ) ); ?>
				  <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'bright' ), 'after' => '</div>' ) ); ?>
			 </div>
			 			
		</header>
		
		<!-- Only display Excerpts on Search results pages -->
		<?php if ( is_search() ) : ?>
		
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>
			
		<?php else : ?>
		
			<!-- post content -->
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">→</span>', 'bright' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'bright' ), 'after' => '</div>' ) ); ?>
			</div>
		
		<?php endif; ?>
		
		<!-- Show the post's tags, categories, and a comment link -->
		<footer class="entry-meta">
			
			<!-- Hide category and tag text for Pages in Search results  -->
			<?php if ( 'post' == get_post_type() ) : //?>
			
				<?php
				// translators: used between list items, there is a space after the comma
				$categories_list = get_the_category_list( __( ', ', 'bright' ) );
			
				if ( $categories_list && bright_categorized_blog() ) : ?>
				
					<span class="cat-links">
						<?php printf( __( 'Posted in %1$s', 'bright' ), $categories_list ); ?>
					</span>
			
				<!-- End if categories  -->
				<?php endif; ?>
				
				<!-- translators: used between list items, there is a space after the comma  -->
				<?php			
				$tags_list = get_the_tag_list( '', __( ', ', 'bright' ) );
				if ( $tags_list ) :
				?>
				
					<span class="sep"> | </span>
					<span class="tag-links">
					<?php printf( __( 'Tagged %1$s', 'bright' ), $tags_list ); ?>					
					</span>
				
				<!-- End if $tags_list  -->
				<?php endif; ?>
			
			<!-- End if 'post' == get_post_type()t  -->
			<?php endif; ?>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			
				<span class="sep"> | </span>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'bright' ), __( '1 Comment', 'bright' ), __( '% Comments', 'bright' ) ); ?></span>
			
			<?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'bright' ), '<span class="sep"> |   </span><span class="edit-link">', '</span>' ); ?>
		
		</footer>

	</article>
	
	<!-- Close up the article and end the loop  -->
	<?php endwhile; ?>

	</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>