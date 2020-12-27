<!doctype html>
<html>
<head>
	<?php wp_head(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&family=Quicksand:wght@500;600&display=swap" rel="stylesheet">

    <title><?php bloginfo( 'name' ); ?><?php wp_title(); ?></title>
</head>

<body <?php
if ( is_singular() ) {
	global $post;
	$post_slug = 'page-' . $post->post_name;
} else {
	$post_slug = '';
}
body_class( [ $post_slug ] ) ?>
>
<?php
//for google tag manager plugin
if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>

<div class="header-main-footer-wrap">
	<?php
	mainHeader( [
		'mobile_menu'             => [
			'full_width'                      => true,
			'show_current-page'               => true,
			'header'                          => false,
			'show_close_x_inside_mobile_menu' => true,
			'fade_in'                         => true,
			'menu_from_side'                  => 'fixed',
			'keep_close_x_on_menu_open'       => true,
			'mobile_menu_top_0'               => true
		],
		'sticky_on_load'          => true,
		'hamburger_location'      => 'right',
		'with_language_switcher'  => true,
		'topbar'                  => true,
		'hide_topbar_on_scroll'   => false,
		'logo_text_to_right'      => true,
		'menu_item_has_underline' => true
	] );
	?>

    <main class="main">
