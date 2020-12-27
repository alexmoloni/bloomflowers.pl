<?php

add_filter( 'woocommerce_package_rates', 'hide_shipping_method_based_on_shipping_class', 10, 2 );
function hide_shipping_method_based_on_shipping_class( $rates, $package )
{
	if ( is_admin() && ! defined( 'DOING_AJAX' ) )
		return;

	// Class for produkty available in whole country
	$class = 47;

	// If selected method flat rate for Strefa polska
	$method_key_id = 'flat_rate:1';

	// Checking in cart items
	foreach( $package['contents'] as $item ){
		// If we find any item not in the class for country delivery
		if( $item['data']->get_shipping_class_id() != $class ){
			unset($rates[$method_key_id]); // Remove the targeted method
			break; // Stop the loop
		}
	}
	return $rates;
}

add_filter( 'woocommerce_cart_no_shipping_available_html', 'change_noship_message' );
add_filter( 'woocommerce_no_shipping_available_html', 'change_noship_message' );
function change_noship_message() {
	echo __('Brak dostępnych metod wysyłki. Dla produktów żywych wysyłka możliwa jedynie w Warszawie i okolichach.', 'alexmoloni');
}