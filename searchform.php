<?php
/**
 * The template for displaying search forms in Bright
 *
 * @package Bright
 */
?>
	<form method="get" id="searchform" class="searchform form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<h1 for="s" class="screen-reader-text"><?php _ex( 'Search', 'assistive text', 'bright' ); ?></h1>
		<input type="search" class="field input-medium search-query" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'bright' ); ?>" />
		<input type="submit" class="submit btn" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'bright' ); ?>" />
	</form>
