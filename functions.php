<?php
/**
 * Bright functions and definitions
 *
 * @package Bright
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 1170; /* pixels */

if ( ! function_exists( 'bright_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function bright_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Bright, use a find and replace
	 * to change 'bright' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'bright', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'bright' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // bright_setup
add_action( 'after_setup_theme', 'bright_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function bright_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'bright_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'bright_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function bright_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'bright' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'bright_widgets_init' );

/**
 * Enqueue scripts and styles
 */
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
		
	// metro
	wp_register_style( 'metro', 
	get_template_directory_uri() . '/WebProject-Resources/icons/metro/style.css', 
	array(), 
	'20130516', 
	'all' );
	wp_enqueue_style( 'metro' );

	// google font
	wp_register_style( 'google-font', 
	'http://fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,700,700italic,600italic', 
	array(), 
	'20130516', 
	'all' );
	wp_enqueue_style( 'google-font' );

	// BrandColors
	wp_register_style( 'BrandColors', 
	get_template_directory_uri() . '/WebProject-Resources/css/BrandColors/style.css', 
	array(), 
	'20130516', 
	'all' );
	wp_enqueue_style( 'BrandColors' );
	
	// style.css
	wp_enqueue_style( 'Bright-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'bright_styles' );

function bright_scripts() {

	//wp_enqueue_script( 'Bright-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	//wp_enqueue_script( 'Bright-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/*
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'Bright-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
	*/
	
	// jquery
	wp_enqueue_script( 'jquery' ); 
	
	// modernizr
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/components/modernizr/modernizr.js', array(), false, true );  

	// enquire
	wp_enqueue_script( 'enquire', get_template_directory_uri() . '/components/enquire/dist/enquire.min.js', array(), false, true );   
	
	// bootstrap
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/components/bootstrap/docs/assets/js/bootstrap.min.js', array(), false, true );    
	
	// hammerjs
	wp_enqueue_script( 'hammerjs', get_template_directory_uri() . '/components/hammerjs/dist/jquery.hammer.min.js', array(), false, true );    
	
	// fancybox
	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/components/fancybox/source/jquery.fancybox.pack.js', array(), false, true );    
	wp_enqueue_script( 'fancybox-thumbs', get_template_directory_uri() . '/components/fancybox/source/helpers/jquery.fancybox-thumbs.js', array(), false, true );  
	
	// custom
	wp_enqueue_script( 'MediaQuery', get_template_directory_uri() . '/js/MediaQuery.js', array(), false, true );   
	wp_enqueue_script( 'Navigation', get_template_directory_uri() . '/js/Navigation.js', array(), false, true );    
	wp_enqueue_script( 'PageSwitch', get_template_directory_uri() . '/js/PageSwitch.js', array(), false, true );     
	wp_enqueue_script( 'Gallery', get_template_directory_uri() . '/js/Gallery.js', array(), false, true );    
}
add_action( 'wp_enqueue_scripts', 'bright_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

