<?php
# Title: Bright functions and definitions

# File name: functions.php
# Description: 
# Tags: wordpress, theme, functions
# Project: Bright

# Author: Janik von Rotz
# Author Contact: http://janikvonrotz.ch

# Create Date: 2013-05-17
# Last Edit Date: 2013-05-17
# Version: 1.0.0

// set content width
if ( ! isset( $content_width ) )
    $content_width = 1170; /* twitter bootstrap responsive container width */
	
if ( ! function_exists( 'bright_setup' ) ):
	/*
	Sets up theme defaults and registers support for various WordPress features.

	Note that this function is hooked into the after_setup_theme hook, which runs
	before the init hook. The init hook is too late for some features, such as indicating
	support post thumbnails.

	@since Bright 1.0
	*/
	function bright_setup() {
	 

		 // Custom template tags for this theme.
		require( get_template_directory() . '/inc/template-tags.php' );
	 

		 // Custom functions that act independently of the theme templates
		require( get_template_directory() . '/inc/tweaks.php' );
	 
		/*
		Make theme available for translation
		Translations can be filed in the /languages/ directory
		If you're building a theme based on Bright, use a find and replace
		to change 'bright' to the name of your theme in all the template files
		*/
		load_theme_textdomain( 'bright', get_template_directory() . '/languages' );
	 
		//Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
	 
		// Enable support for the Aside Post Format
		add_theme_support( 'post-formats', array( 'aside' ) );
	 

		//This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'bright' ),
		) );
	}
endif; // bright_setup
add_action( 'after_setup_theme', 'bright_setup' );

#--------------------------------------------------#
# Enqueue scripts and styles
#--------------------------------------------------#
function bright_scripts() {

	//load comment only in single view
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
	
	// jquery
	wp_register_script( 'jquery', get_template_directory_uri() . '/components/jquery/jquery.min.js' );  
	wp_enqueue_script( 'jquery' ); 
	
	// modernizr
	wp_register_script( 'modernizr', get_template_directory_uri() . '/components/modernizr/modernizr.js' );  
	wp_enqueue_script( 'modernizr' ); 

	// enquire
	wp_register_script( 'enquire', get_template_directory_uri() . '/components/enquire/dist/enquire.min.js' );  
	wp_enqueue_script( 'enquire' ); 
	
	// bootstrap
	wp_register_script( 'bootstrap', get_template_directory_uri() . '/components/bootstrap/docs/assets/js/bootstrap.min.js' );  
	wp_enqueue_script( 'bootstrap' ); 	
	
	// hammerjs
	wp_register_script( 'hammerjs', get_template_directory_uri() . '/components/hammerjs/dist/jquery.hammer.min.js' );  
	wp_enqueue_script( 'hammerjs' ); 	
	
	// fancybox
	wp_register_script( 'fancybox', get_template_directory_uri() . '/components/fancybox/source/jquery.fancybox.pack.js' );  
	wp_enqueue_script( 'fancybox' ); 	
	wp_register_script( 'fancybox-thumbs', get_template_directory_uri() . '/components/fancybox/source/helpers/jquery.fancybox-thumbs.js' );  
	wp_enqueue_script( 'fancybox-thumbs' );
	
	// custom
	wp_register_script( 'MediaQuery', get_template_directory_uri() . '/js/MediaQuery.js' );  
	wp_enqueue_script( 'MediaQuery' ); 
	wp_register_script( 'Navigation', get_template_directory_uri() . '/js/Navigation.js' );  
	wp_enqueue_script( 'Navigation' ); 
	wp_register_script( 'PageSwitch', get_template_directory_uri() . '/js/PageSwitch.js' );  
	wp_enqueue_script( 'PageSwitch' ); 
	wp_register_script( 'Gallery', get_template_directory_uri() . '/js/Gallery.js' );  
	wp_enqueue_script( 'Gallery' ); 
}
add_action( 'wp_enqueue_scripts', 'bright_scripts' );

function bright_styles() {

	// bootstrap
	wp_register_style( 'bootstrap', 
	get_template_directory_uri() . '/components/bootstrap/docs/assets/css/bootstrap.css', 
	array(), 
	'20130516', 
	'all' );
	wp_enqueue_style( 'bootstrap' );
	wp_register_style( 'bootstrap-responsive', 
	get_template_directory_uri() . '/components/bootstrap/docs/assets/css/bootstrap-responsive.css', 
	array(), 
	'20130516', 
	'all' );
	wp_enqueue_style( 'bootstrap-responsive' );	
	
	// fancybox
	wp_register_style( 'fancybox', 
	get_template_directory_uri() . '/components/fancybox/source/jquery.fancybox.css', 
	array(), 
	'20130516', 
	'all' );
	wp_enqueue_style( 'fancybox' );
	wp_register_style( 'fancybox-thumbs', 
	get_template_directory_uri() . '/components/fancybox/source/helpers/jquery.fancybox-thumbs.css', 
	array(), 
	'20130516', 
	'all' );
	wp_enqueue_style( 'fancybox-thumbs' );

	// Metrize_Icons thumbs
	wp_register_style( 'Metrize_Icons', 
	get_template_directory_uri() . '/components/Metrize_Icons/Font-Face/style.css', 
	array(), 
	'20130516', 
	'all' );
	wp_enqueue_style( 'Metrize_Icons' );

	// google font
	wp_register_style( 'google-font', 
	'http://fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,700,700italic,600italic', 
	array(), 
	'20130516', 
	'all' );
	wp_enqueue_style( 'google-font' );

	// custom
	wp_register_style( 'custom', 
	get_template_directory_uri() . '/styles.css', 
	array(), 
	'20130516', 
	'all' );
	wp_enqueue_style( 'custom' );
}
add_action( 'wp_enqueue_scripts', 'bright_styles' );