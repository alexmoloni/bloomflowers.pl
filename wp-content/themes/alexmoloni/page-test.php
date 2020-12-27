<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alexmoloni
 */

get_header();
if ( have_posts() ):
	while ( have_posts() ):
		the_post();
		?>
        <section>
            <div class="container">
                <h1 class="heading-1">Heading 1</h1>
                <h2 class="heading-2">Heading 2</h2>
                <h3 class="heading-3">Heading 3</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit eros sem, at luctus mauris
                    scelerisque eget. Pellentesque rutrum volutpat orci nec malesuada. Lorem ipsum dolor sit amet,
                    consectetur adipiscing elit. Sed blandit eros sem,
                    <a href="#">some link</a> at luctus mauris scelerisque eget. Pellentesque rutrum volutpat orci nec
                    malesuada.</p>
                <h2 class="heading-2">Btns</h2>
                <a class="btn-cta-1" href="#">btn cta 1</a>
                <a class="btn-cta-2" href="#">btn cta 2</a>
                <a class="btn-cta-3" href="#">btn cta 3</a>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit eros sem, at luctus mauris
                    scelerisque eget. Pellentesque rutrum volutpat orci nec malesuada.<br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit eros sem, at luctus mauris
                    scelerisque eget. Pellentesque rutrum volutpat orci nec malesuada.
                </p>
                <h2 class="heading-2">Some list</h2>
                <ul>
                    <li>Lorem something</li>
                    <li>Lorem something 2</li>
                    <li>Lorem something 3</li>
                    <li>Lorem something 4</li>
                </ul>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <h2 class="heading-2">New section</h2>
                <h3 class="heading-3">Post content</h3>
                <div class="post-content"><?= get_the_content() ?></div>
            </div>
        </section>
    <section class="section">
        <div class="container">
            <h2 class="heading-2">Contact Form</h2>
	        <?= do_shortcode('[wpforms id="57"]	') ?>
        </div>
    </section>
	<?php endwhile;
endif;

get_footer();
