<?php
function enqueueJsAndCss() {

	wp_enqueue_style( 'reset', get_template_directory_uri() . '/assets/css/reset.css', [], null );


	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', [], null, true );

	wp_enqueue_style( 'nouislider', 'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.2/nouislider.min.css' );

	wp_enqueue_script( 'nouislider', 'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.2/nouislider.min.js', [], null, true );

	wp_enqueue_script( 'squeezebox', get_template_directory_uri() . '/assets/js/squeezebox.min.js', ['jquery'], null, true );

	/*use slick from cdn for faster download and caching*/
	wp_enqueue_style( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css' );

	wp_enqueue_script( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array( 'jquery' ), null, true );


	wp_enqueue_script( 'hammer', 'https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js', array( 'jquery' ), null, true );

	if ( is_page_template( 'page_o-nas.php' ) ) {
		wp_enqueue_script( 'waypoints', 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js', array( 'jquery' ), null, true );
	}

	if ( is_page_template( 'page_dostawa.php' ) ) {

		wp_enqueue_script( 'jquery-ui-tabs', get_stylesheet_directory_uri() . '/assets/js/jquery-ui-tabs.min.js', [ 'jquery' ], '1.0', false );
		wp_enqueue_style( 'jquery-ui-tabs', get_stylesheet_directory_uri() . '/assets/css/jquery-ui-tabs.min.css', [] );
		wp_enqueue_style( 'jquery-ui-tabs-theme', get_stylesheet_directory_uri() . '/assets/css/jquery-ui-tabs.theme.min.css', [] );


	}


	//main css file
	$css_url  = get_stylesheet_directory_uri() . '/assets/css/main.css';
	$css_path = get_stylesheet_directory() . '/assets/css/main.css';
	$version  = filemtime( $css_path ) ?: false;
	wp_enqueue_style( 'main', $css_url, [], $version );


	//js gets placed at bottom of body
	$js_url  = get_stylesheet_directory_uri() . '/assets/js/main.js';
	$js_path = get_stylesheet_directory() . '/assets/js/main.js';
	$version = filemtime( $js_path ) ?: false;
	wp_enqueue_script( 'main', $js_url, [ 'jquery', ], $version, true );

	wp_localize_script( 'main', 'wpRest', [
		'url'   => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'wpRestNonce' )
	] );


}

add_action( 'wp_enqueue_scripts', 'enqueueJsAndCss', 50 );


/*Dont include Dashlogo-texticons assets*/
function wpdocs_dequeue_dashicon() {
	//have to set this condition so that wp-admin bar displays correctly
	if ( current_user_can( 'update_core' ) ) {
		return;
	}
	wp_deregister_style( 'dashicons' );
}

add_action( 'wp_enqueue_scripts', 'wpdocs_dequeue_dashicon' );


function alexmoloniAdminScripts() {
	wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/assets/css/admin-styles.css', [], null );
}

add_action( 'admin_enqueue_scripts', 'alexmoloniAdminScripts' );