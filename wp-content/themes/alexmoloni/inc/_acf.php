<?php

if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( [
		'page_title' => 'Opcje strony',
		'menu_title' => 'Opcje strony',
		'menu_slug'  => 'opcje',
		'capability' => 'edit_posts',
		'position'   => 3,
		'icon_url'   => 'dashicons-admin-tools'
	] );

	acf_add_options_sub_page( array(
		'page_title'  => 'Company Info / Contact / Icons',
		'menu_title'  => 'Company Info / Contact / Icons',
		'parent_slug' => 'opcje',
	) );

	acf_add_options_sub_page( array(
		'page_title'  => 'Footer / Socials',
		'menu_title'  => 'Footer / Socials',
		'parent_slug' => 'opcje',
	) );

	acf_add_options_sub_page( array(
		'page_title'  => 'Teksty sklep',
		'menu_title'  => 'Teksty sklep',
		'parent_slug' => 'opcje',
	) );

	acf_add_options_sub_page( array(
		'page_title'  => 'Ustawienia emaile',
		'menu_title'  => 'Ustawienia emaile',
		'parent_slug' => 'opcje',
	) );


}

add_action( 'acf/init', 'my_acf_blocks_init' );

function my_acf_blocks_init() {

	// Check function exists.
	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register a testimonial block.
		acf_register_block_type( array(
			'name'            => 'am-hero-section',
			'title'           => __( 'AM Hero section' ),
			'render_template' => 'templates/blocks/hero-section.php',
			'category'        => 'widgets',
			'mode'            => 'edit',
		) );

		acf_register_block_type( array(
			'name'            => 'am-grid',
			'title'           => __( 'AM Grid' ),
			'render_template' => 'templates/blocks/am-grid.php',
			'category'        => 'widgets',
			'mode'            => 'edit',
		) );

		acf_register_block_type( array(
			'name'            => 'am-icons-row',
			'title'           => __( 'AM Icons Row' ),
			'render_template' => 'templates/blocks/am-icons-row.php',
			'category'        => 'widgets',
			'mode'            => 'edit',
		) );

		acf_register_block_type( array(
			'name'            => 'am-section-big-image',
			'title'           => __( 'AM Section Big Image' ),
			'render_template' => 'templates/blocks/am-section-big-image.php',
			'category'        => 'widgets',
			'mode'            => 'edit',
		) );

		acf_register_block_type( array(
			'name'            => 'am-products-grid',
			'title'           => __( 'AM Products Grid' ),
			'render_template' => 'templates/blocks/am-products-grid.php',
			'category'        => 'widgets',
			'mode'            => 'edit',
		) );

		acf_register_block_type( array(
			'name'            => 'am-newsletter-signup',
			'title'           => __( 'AM Newsletter Signup' ),
			'render_template' => 'templates/blocks/am-newsletter-signup.php',
			'category'        => 'widgets',
			'mode'            => 'edit',
		) );

		acf_register_block_type( array(
			'name'            => 'am-section-text-and-image',
			'title'           => __( 'AM Section Text and Image' ),
			'render_template' => 'templates/blocks/am-section-text-and-image.php',
			'category'        => 'widgets',
			'mode'            => 'edit',
		) );

		acf_register_block_type( array(
			'name'            => 'am-btn-row',
			'title'           => __( 'AM Btn Row' ),
			'render_template' => 'templates/blocks/am-btn-row.php',
			'category'        => 'widgets',
			'mode'            => 'edit',
		) );

		acf_register_block_type( array(
			'name'            => 'am-gallery-section',
			'title'           => __( 'AM Gallery Section' ),
			'render_template' => 'templates/blocks/am-gallery-section.php',
			'category'        => 'widgets',
			'mode'            => 'edit',
		) );

		acf_register_block_type( array(
			'name'            => 'am-page-o-nas',
			'title'           => __( 'AM Page o nas' ),
			'render_template' => 'templates/blocks/am-page-o-nas.php',
			'category'        => 'widgets',
			'mode'            => 'edit',
		) );

		acf_register_block_type( array(
			'name'            => 'am-page-kontakt',
			'title'           => __( 'AM Page Kontakt' ),
			'render_template' => 'templates/blocks/am-page-kontakt.php',
			'category'        => 'widgets',
			'mode'            => 'edit',
		) );

		acf_register_block_type( array(
			'name'            => 'am-page-dostawa',
			'title'           => __( 'AM Page Dostawa' ),
			'render_template' => 'templates/blocks/am-page-dostawa.php',
			'category'        => 'widgets',
			'mode'            => 'edit',
		) );

		acf_register_block_type( array(
			'name'            => 'am-page-faq',
			'title'           => __( 'AM Page FAQ' ),
			'render_template' => 'templates/blocks/am-page-faq.php',
			'category'        => 'widgets',
			'mode'            => 'edit',
		) );


	}
}


/**
 * Force ACF to use only the default language on some options pages
 */
function cl_set_global_options_pages($current_screen) {

	// IDs of admin options pages that should be "global"
	$page_ids = array(
		"toplevel_page_acf-options-test"
	);

	if (in_array($current_screen->id, $page_ids)) {
		add_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
	}
}
add_action( 'current_screen', 'cl_set_global_options_pages' );

function cl_acf_set_language() {
	return acf_get_setting('default_language');
}

/**
 * Wrapper around get_field() to get the "global" option values.
 * This is the function you'll want to use in your templates instead of get_field() for "global" options.
 */
function get_global_option($name) {
	add_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
	$option = get_field($name, 'option');
	remove_filter('acf/settings/current_language', 'cl_acf_set_language', 100);
	return $option;
}