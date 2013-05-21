<?php
# Title: Custom functions that act independently of the theme templates

# File name: header.php
# Description: Eventually, some of the functionality here could be replaced by core features
# Tags: wordpress, theme, tweaks
# Project: Bright

# Author: Janik von Rotz
# Author Contact: http://janikvonrotz.ch

# Create Date: 2013-05-17
# Last Edit Date: 2013-05-17
# Version: 1.0.0
 
// Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
function bright_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'bright_page_menu_args' );
 

// Adds custom classes to the array of body classes.
function bright_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }
 
    return $classes;
}
add_filter( 'body_class', 'bright_body_classes' );
 
// Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
function bright_enhanced_image_navigation( $url, $id ) {
    if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
        return $url;
 
    $image = get_post( $id );
    if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
        $url .= '#main';
 
    return $url;
}
add_filter( 'attachment_link', 'bright_enhanced_image_navigation', 10, 2 );


#--------------------------------------------------#
# menu customizing
#--------------------------------------------------#