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
	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'thumbnail-banner', 670, 999, false ); 
	}
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 'thumbnail-banner' ); // default Post Thumbnail dimensions   
	}



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
 * Link all post thumbnails to the post permalink
 */
add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );
function my_post_image_html( $html, $post_id, $post_image_id ) {
  $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
  return $html;
}

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
 function bright_styles(){	
 
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
	
	// metro icon font
	wp_register_style( 'icon-font-metro', 
	get_template_directory_uri() . '/css/icon-fonts/metro/style.css', 
	array(), 
	'20130516', 
	'all' );
	wp_enqueue_style( 'icon-font-metro' );

	// header font
	wp_register_style( 'font-raleway-thin', 
	get_template_directory_uri() . '/css/fonts/raleway_thin/stylesheet.css', 
	array(), 
	'20130516', 
	'all' );
	wp_enqueue_style( 'font-raleway-thin' );

	// content font
	wp_register_style( 'font-junction', 
	get_template_directory_uri() . '/css/fonts/junction/stylesheet.css', 
	array(), 
	'20130516', 
	'all' );
	wp_enqueue_style( 'font-junction' );
	
	// color brand
	wp_register_style( 'color-brand', 
	get_template_directory_uri() . '/css/colors/brand/style.css', 
	array(), 
	'20130516', 
	'all' );
	wp_enqueue_style( 'color-brand' );
 
	// custom style
	wp_enqueue_style( 'bright-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'bright_styles' );

function bright_scripts() {

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'bright-keyboard-image-navigation', get_template_directory_uri() . '/js/bright-keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
	
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

	// jquery.fitvids
	wp_enqueue_script( 'jquery.fitvids', get_template_directory_uri() . '/components/jquery.fitvids/jquery.fitvids.min.js', array(), false, true );	
	
	// custom
	wp_enqueue_script( 'Responsive', get_template_directory_uri() . '/js/Responsive.js', array(), false, true );
	wp_enqueue_script( 'MediaQuery', get_template_directory_uri() . '/js/MediaQuery.js', array(), false, true );   
	wp_enqueue_script( 'Navigation', get_template_directory_uri() . '/js/Navigation.js', array(), false, true );    
	wp_enqueue_script( 'PageSwitch', get_template_directory_uri() . '/js/PageSwitch.js', array(), false, true );     

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

/**
 * Extend Walker_Nav_Menu
 */
class bright_walker_nav_menu extends Walker_Nav_Menu{
	  
	// add classes to ul sub-menus
	function start_lvl( &$output, $depth ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'sub-menu',
			'unstyled text-left hide',
			( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
			( $display_depth >=2 ? 'sub-sub-menu' : '' ),
			'menu-depth-' . $display_depth
			);
		$class_names = implode( ' ', $classes );
	  
		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}
	  
	// add main/sub classes to li's and links
	 function start_el( &$output, $item, $depth, $args ) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
	  
		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
			( $depth >=2 ? 'sub-sub-menu-item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
	  
		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
	  
		// build html
		$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . '">';
	  
		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
	  
		$item_output = sprintf( '%1$s<a%2$s><i class="'.$class_names.'"></i>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);
	  
		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}