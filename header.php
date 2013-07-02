<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Bright
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

<script>
/**
 * IEMobile responsive fix
 */

if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
    var msViewportStyle = document.createElement("style");
    msViewportStyle.appendChild(
        document.createTextNode(
            "@-ms-viewport{width:auto!important}"
        )
    );
    document.getElementsByTagName("head")[0].
        appendChild(msViewportStyle);
}
</script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site container">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
	
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) { ?>
			<div class="row-fluid">
				<div class="span12 pagination-centered logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
					</a>
				</div>	
			</div>
		<?php } // if ( ! empty( $header_image ) ) ?>
		
		<div class="row-fluid">
			<div class="site-branding span12 pagination-centered page-header">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h1 class="site-description"><small><?php bloginfo( 'description' ); ?></small></h1>
			</div>
		</div>
		
		<div class="row-fluid">
			<nav id="site-navigation" class="navigation-main span12 pagination-centered" role="navigation">
				
				<p class="visible-phone toggle-menu"><i class="icon-block-menu"></i></p>
								
				<?php wp_nav_menu( array( 
					'theme_location' => 'primary', 
					'items_wrap' => ' <ul id="%1$s" class="hidden-phone inline nav %2$s">%3$s</ul>',
					'walker' => new bright_walker_nav_menu()
				) ); ?>
				
			</nav><!-- #site-navigation -->		
		</div>
		
	</header><!-- #masthead -->
	<div class="overlay hide"></div>
	<div id="main" class="site-main">
