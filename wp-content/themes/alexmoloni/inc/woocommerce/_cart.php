<?php

use alexito\Woocommerce;

function amAddToCartCB() {
	$nonce = $_POST['nonce'] ?? '';
	if ( ! wp_verify_nonce( $nonce, 'wpRestNonce' ) ) {
		die ( 'nonce' );
	}

	$items = $_POST['items'] ?? false;
	if ( ! $items ) {
		die('no items');
	}
	$cart_key = '';
	$items          = stripslashes( html_entity_decode( $items ) );
	$items          = json_decode($items, true);
	foreach ($items as $item) {
		$product_id              = intval( sanitize_title( $item['productId'] ) );
		$quantity                = intval( sanitize_title( $item['quantity'] ) );
		$variation_id            = intval( sanitize_title( $item['variationId'] ) );
		$cart_item_data          = $item['cartItemData'];
		$filtered_cart_item_data = [];
		foreach ( $cart_item_data as $key => $value ) {
			$filtered_cart_item_data[ sanitize_text_field( $key ) ] = sanitize_text_field( $value );
		}
		try {
			$cart_key = WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, [], $filtered_cart_item_data );
		} catch ( Exception $e ) {
			die( $e->getMessage() );
		}
	}

	ob_start();
	amMiniCart();
	$mini_cart_html = ob_get_clean();

	$response = [
		'cart_key'       => $cart_key,
		'mini_cart_html' => $mini_cart_html,
		'cart_count'     => Woocommerce::getCartCount()
	];

	echo json_encode( $response );
	die();
}

add_action( "wp_ajax_am_add_to_cart", "amAddToCartCB" );
add_action( "wp_ajax_nopriv_am_add_to_cart", "amAddToCartCB" );


function amRemoveCartCB() {
	$nonce = $_POST['nonce'] ?? '';
	if ( ! wp_verify_nonce( $nonce, 'wpRestNonce' ) ) {
		die ( 'nonce' );
	}

	$product_id = $_POST['prodId'] ?? false;
	$product_id = sanitize_title($product_id);
	$product_id = intval($product_id);

	$product_cart_id = WC()->cart->generate_cart_id( $product_id );
	$cart_item_key = WC()->cart->find_product_in_cart( $product_cart_id );
	if ( $cart_item_key ) {
		$success = WC()->cart->remove_cart_item( $cart_item_key );
		if ($success) {
			ob_start();
			amMiniCart();
			$mini_cart_html = ob_get_clean();

			$response = [
				'mini_cart_html' => $mini_cart_html,
				'cart_count'     => Woocommerce::getCartCount()
			];

			echo json_encode($response);
			die();
		}
	}
	echo 'cant remove item from cart';
	die();

}

add_action( "wp_ajax_am_remove_cart", "amRemoveCartCB" );
add_action( "wp_ajax_nopriv_am_remove_cart", "amRemoveCartCB" );

function amRefreshCartDivsCB() {
	$nonce = $_POST['nonce'] ?? '';
	if ( ! wp_verify_nonce( $nonce, 'wpRestNonce' ) ) {
		die ( 'nonce' );
	}

	ob_start();
	amMiniCart();
	$mini_cart_html = ob_get_clean();

	$response = [
		'mini_cart_html' => $mini_cart_html,
		'cart_count'     => Woocommerce::getCartCount()
	];

	echo json_encode( $response );
	die();
}

add_action( "wp_ajax_am_refresh_cart_divs", "amRefreshCartDivsCB" );
add_action( "wp_ajax_nopriv_am_refresh_cart_divs", "amRefreshCartDivsCB" );