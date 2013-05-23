<?php 
/*
# Title: The main template file

# File name: header.php
# Description:
This is the most generic template file in a WordPress theme
and one of the two required files for a theme (the other being style.css).
It is used to display a page when nothing more specific matches a query.
E.g., it puts together the home page when no home.php file exists.
Learn more: http://codex.wordpress.org/Template_Hierarchy

# Tags: wordpress, theme, index
# Project: Bright

# Author: Janik von Rotz
# Author Contact: http://janikvonrotz.ch

# Create Date: 2013-05-17
# Last Edit Date: 2013-05-23
# Version: 1.0.0
*/
get_header(); ?>

<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
    </div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>