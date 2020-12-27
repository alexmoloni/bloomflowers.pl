<?php

use alexito\Woocommerce;

function amRecentlyViewedProducts( $options = null ) {
	$heading       = $options['heading'] ?? get_field( 'heading' ) ?? false;
	$items_to_show = $options['items_to_show'] ?? get_field( 'items_to_show' ) ?? 4;
	$current_prod_id  = $options['current_prod_id'] ?? null;
	$products = Woocommerce::getRecentlyViewedProducts();
	if (($key = array_search($current_prod_id, $products)) !== false) {
		\array_splice($products, $key, 1);
	}

	\array_splice($products, $items_to_show );

	amProductsGrid( [
		'heading'          => $heading,
		'products_to_show' => 'custom_query',
		'products'         => $products,
		'extra_css'        => 'am-recently-viewed-products'
	] );
	?>

<?php }


function amRecentlyViewedProductsCB() {
	if ( ! is_singular( 'product' ) ) {
		return;
	}

	global $post;

	$viewed_products = Woocommerce::getRecentlyViewedProducts();

	// Unset if already in viewed products list.
	$keys = array_flip( $viewed_products );

	if ( isset( $keys[ $post->ID ] ) ) {
		unset( $viewed_products[ $keys[ $post->ID ] ] );
	}

	$viewed_products[] = $post->ID;

	if ( count( $viewed_products ) > 15 ) {
		array_shift( $viewed_products );
	}

	// Store for session only.
	wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ), strtotime( '+30 days' ) );
}

remove_action( 'template_redirect', 'wc_track_product_view', 20 );
add_action( 'template_redirect', 'amRecentlyViewedProductsCB', 20 );
