<?php
/**
 * The template for displaying image attachments.
 *
 * @package Bright
 */

get_header();
?>

	<div id="primary" class="content-area row image-attachment">
		<div id="content" class="site-content span7 offset1" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta  row-fluid">
					
						<?php bright_posted_on(); ?>
						
						<?php
							
							// source link
							$metadata = wp_get_attachment_metadata();
							printf( __( '<span class="span4"><i class="icon-arrow-oblique-expand-directions"></i> Source <a href="%1$s" title="Link to full-size image">%2$s &times; %3$s</a></span>', 'bright' ),
								wp_get_attachment_url(),
								$metadata['width'],
								$metadata['height']
							);
							
							// posted link
							$metadata = wp_get_attachment_metadata();
							printf( __( '<span class="span4"><i class="icon-document-fill"></i> Posted in <a href="%1$s" title="Return to %2$s" rel="gallery">%3$s</a></span>', 'bright' ),
								get_permalink( $post->post_parent ),
								esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
								get_the_title( $post->post_parent )
							);
						?>
						
					</div><!-- .entry-meta -->

					<nav role="navigation" id="image-navigation" class="navigation-image">
					<ul class="pager">
						<li class="nav-previous previous"><?php previous_image_link( false, __( '<span class="meta-nav"><i class="icon-arrow-left-light"></i></span> Previous', 'bright' ) ); ?></li>
						<li class="nav-next next"><?php next_image_link( false, __( 'Next <span class="meta-nav"><i class="icon-arrow-right-light"></i></span>', 'bright' ) ); ?></li>
					</ul>
					</nav><!-- #image-navigation -->
				</header><!-- .entry-header -->

				<div class="entry-content">

					<div class="entry-attachment">
						<div class="attachment">
							<?php
								/**
								 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
								 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
								 */
								$attachments = array_values( get_children( array(
									'post_parent'    => $post->post_parent,
									'post_status'    => 'inherit',
									'post_type'      => 'attachment',
									'post_mime_type' => 'image',
									'order'          => 'ASC',
									'orderby'        => 'menu_order ID'
								) ) );
								foreach ( $attachments as $k => $attachment ) {
									if ( $attachment->ID == $post->ID )
										break;
								}
								$k++;
								// If there is more than 1 attachment in a gallery
								if ( count( $attachments ) > 1 ) {
									if ( isset( $attachments[ $k ] ) )
										// get the URL of the next image attachment
										$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
									else
										// or get the URL of the first image attachment
										$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
								} else {
									// or, if there's only 1 image, get the URL of the image
									$next_attachment_url = wp_get_attachment_url();
								}
							?>

							<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
								$attachment_size = apply_filters( 'bright_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
								echo wp_get_attachment_image( get_the_ID(), $attachment_size );
							?></a>
						</div><!-- .attachment -->

						<?php if ( has_excerpt() ) : ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div><!-- .entry-caption -->
						<?php endif; ?>
					</div><!-- .entry-attachment -->

					<?php the_content(); ?>
					<?php bright_wp_link_pages(); ?>

				</div><!-- .entry-content -->

				<footer class="entry-meta row-fluid">
				
					<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
					
						<?php bright_comments_popup_link(); ?>
							
					<?php endif; ?>
					

					<?php bright_edit_post_link(); ?>
					
				</footer><!-- .entry-meta -->
			</article><!-- #post-<?php the_ID(); ?> -->

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
		
	<?php get_sidebar(); ?>

</div><!-- #primary -->
	
<?php get_footer(); ?>