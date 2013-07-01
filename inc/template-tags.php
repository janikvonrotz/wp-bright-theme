<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Bright
 */

if ( ! function_exists( 'bright_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
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

	$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';
	?>
	
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
	
		<?php /* <h4 class="screen-reader-text"><?php _e( 'Post navigation', 'bright' ); ?></h4>*/  ?>
		
		<ul class="pager">

		<?php if ( is_single() ) : // navigation links for single posts ?>

			<?php previous_post_link( '<li class="nav-previous previous">%link</li>', '<span class="meta-nav">' . _x( '<i class="icon-arrow-left-light"></i>', 'Previous post link', 'bright' ) . '</span> %title' ); ?>
			<?php next_post_link( '<li class="nav-next next">%link</li>', '%title <span class="meta-nav">' . _x( '<i class="icon-arrow-right-light"></i>', 'Next post link', 'bright' ) . '</span>' ); ?>

		<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

			<?php if ( get_next_posts_link() ) : ?>
			<li class="nav-previous previous"><?php next_posts_link( __( '<span class="meta-nav"><i class="icon-arrow-left-light"></i></span> Older posts', 'bright' ) ); ?></li>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<li class="nav-next next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav"><i class="icon-arrow-right-light"></i></span>', 'bright' ) ); ?></li>
			<?php endif; ?>

		<?php endif; ?>
		
		</ul>
	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // bright_content_nav

if ( ! function_exists( 'bright_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function bright_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			
			<div class="comment-content"><p>
				<?php _e( 'Pingback:', 'bright' ); ?> <?php comment_author_link(); ?>
			</p></div><!-- .comment-content -->

			<?php edit_comment_link( __( 'Edit', 'bright' ), '<footer class="comment-meta row-fluid"><span class="edit-link comment-metadata span4"><i class="icon-edit"></i> ', '</span><!-- .comment-metadata --></footer>' ); ?>			
			
		</article>
	
	</li>
	
	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		
			<footer class="comment-meta">
			
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'bright' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author -->
				
				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'bright' ); ?></p>
				<?php endif; ?>
				
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->
		
			<footer class="comment-meta row-fluid">
			
				<div class="reply span4">					
					<i class="icon-arrow-curve-left"></i>
					<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			
				<div class="comment-metadata span4">
					<i class="icon-clock"> </i>
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'bright' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
				</div><!-- .comment-metadata -->

				<?php edit_comment_link( __( 'Edit', 'bright' ), '<span class="edit-link comment-metadata span4"><i class="icon-edit"></i> ', '</span><!-- .comment-metadata -->' ); ?>
				
			</footer>
			
		</article><!-- .comment-body -->

	</li>
		
	<?php
	endif;
}
endif; // ends check for bright_comment()

if ( ! function_exists( 'bright_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function bright_posted_on() {
	printf( __( '<span class="span4"><i class="icon-clock"></i> Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>', 'bright' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
}
endif;

if ( ! function_exists( 'bright_posted_by' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function bright_posted_by() {
	printf( __( '<span class="byline span4"><i class="icon-user"></i> by <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></span>', 'bright' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'bright' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 */
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

/**
 * Flush out the transients used in bright_categorized_blog
 */
function bright_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'bright_category_transient_flusher' );
add_action( 'save_post', 'bright_category_transient_flusher' );

/**
 * edit post link
 */
function bright_edit_post_link(){
	printf( edit_post_link( __( 'Edit', 'bright' ), '<span class="edit-link span4"><i class="icon-edit"></i> ', '</span>' ));
 }
 
/**
 * page links
 */
function bright_wp_link_pages(){
	wp_link_pages( array(
		'before' => '<p class="page-links"><i class="icon-copy-paste-document"></i> ' . __( 'Pages', 'bright' ),
		'after'  => '</p>',
	));
}
/**
 * more link
 */
function bright_more_link_text(){
	the_content( __( '<i class="icon-arrow-right-light"></i> Continue reading', 'bright' ) );
}

/**
 * tag links
 */
function bright_get_the_tag_list($tags_list){
	printf( '<span class="tags-links span4">' . __( '<i class="icon-tag"></i> Tagged %1$s', 'bright' ), $tags_list . '</span>');
}

/**
 * category links
 */
function bright_get_the_category_list($categories_list){
	printf( '<span class="cat-links span4">' . __( '<i class="icon-category"></i> Posted in %1$s', 'bright' ), $categories_list . '</span>' );
}

/**
 * comment popup link
 */
 function bright_comments_popup_link(){
	printf('<span class="comments-link span4">');
	printf(comments_popup_link( __( '<i class="icon-report-comment"></i> Leave a comment', 'bright' ), __( '<i class="icon-comment"></i> 1 Comment', 'bright' ), __( '<i class="icon-comments"></i> % Comments', 'bright' )));
	printf('</span>');
}