<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Bright
 */
?>

	</div><!-- #main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info pagination-centered">
			
			<?php do_action( 'bright_credits' ); ?>
			
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'bright' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'bright' ), 'WordPress' ); ?></a>
			
			<span class="sep"> | </span>
			
			<?php printf( __( 'Theme: %1$s by %2$s.', 'bright' ), '<a href="https://github.com/janikvonrotz/WP-Bright-Theme" rel="design">Bright</a>', '<a href="http://janikvonrotz.ch" rel="designer">Janik von Rotz</a>' ); ?>
		
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>