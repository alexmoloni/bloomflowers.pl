<?php
/*
Template Name: Page FAQ
Template Post Type: page
*/

get_header();
if ( have_posts() ):
	while ( have_posts() ):
		the_post();
		the_content();
	endwhile;
endif;

get_footer();



