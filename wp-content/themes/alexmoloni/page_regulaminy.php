<?php
/*
Template Name: Page Regulaminy
Template Post Type: page
*/

get_header();
if ( have_posts() ):
	while ( have_posts() ):
		the_post(); ?>
        <div class="container">
            <h1 class="heading-1 heading"><?= get_the_title() ?></h1>
			<?php the_content(); ?>
        </div>
	<?php endwhile;
endif;

get_footer();
