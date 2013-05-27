<?php
/*
# Title: The Header for this theme

# File name: header.php
# Description: Displays all of the <head> section and everything up till <div id="main">
# Tags: wordpress, theme, header
# Project: Bright

# Author: Janik von Rotz
# Author Contact: http://janikvonrotz.ch

# Create Date: 2013-05-17
# Last Edit Date: 2013-05-17
# Version: 1.0.0
*/

?><!DOCTYPE html>
<head>

	<!-- charset -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	
	<!-- viewport -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- favicon -->
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	
	<title><?php
		// Print the <title> tag based on what is being viewed.
		
		global $page, $paged;		 
		wp_title( '|', true, 'right' );
		 
		// Add the blog name.
		bloginfo( 'name' );
		 
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
		 
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'bright' ), max( $paged, $page ) );
		 
	?></title>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php wp_head(); ?>
	
</head>
 
<body <?php body_class(); ?>>

<div id="page" class="container hfeed">

	<header>
	<div id="masthead" class="site-header header" role="banner">
		
		<div class="row-fluid">		
			<div class="span12 pagination-centered logo">
			
				<img src="content/logo.png" alt="logo" />
				
			</div>		
		</div>		

		<div class="row-fluid">
			<div class="span12 pagination-centered page-header">
			
				<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h1 class="site-description"><small><?php bloginfo( 'description' ); ?></small></h1>
				
			</div>			
		</div>	

		<div class="row-fluid">		
			<div class="span12 pagination-centered">
				<nav role="navigation" class="site-navigation main-navigation">
					
					<!--
					 <h1 class="assistive-text"><?php _e( 'Menu', 'bright' ); ?></h1>
					 <div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'bright' ); ?>"><?php _e( 'Skip to content', 'bright' ); ?></a></div>
					-->
					
					<p class="visible-phone menu"><span class="icon-grid-big"></span></i></p>
					
					<?php wp_nav_menu( array(
						'theme_location' => 'primary'
					) ); ?>
		
				</nav>			
			</div>			
		</div>
	
	</div>
	</header>
	
<div class="overlay hide"></div>

<div id="main" class="content site-main">