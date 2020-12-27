<?php

function amProductCardInput( $options = null ) {

	?>
    <div class="am-product-card-input">
        <h4 class="heading-5 heading"><?= get_field( 'product_card_label', 'options' ) ?></h4>
        <textarea id="product-card" name="card_text"></textarea>
    </div>
<?php }

/**
 * Display engraving text in the cart.
 *
 * @param array $item_data
 * @param array $cart_item
 *
 * @return array
 */
function amProductCardInputCB( $item_data, $cart_item ) {
	if ( empty( $cart_item['product_card_text'] ) ) {
		return $item_data;
	}

	$card_text = wc_clean( $cart_item['product_card_text'] );

	$item_data[] = [
		'key'     => get_field( 'product_card_label', 'options' ),
		'value'   => $card_text,
//		'display' => $card_text . '<a class="js-update-card btn-cta-3">Update</a>'
	];

	return $item_data;
}

add_filter( 'woocommerce_get_item_data', 'amProductCardInputCB', 10, 2 );

/**
 * Add engraving text to order.
 *
 * @param WC_Order_Item_Product $item
 * @param string $cart_item_key
 * @param array $values
 * @param WC_Order $order
 */
function amProductCardInputSaveOrderCB( $item, $cart_item_key, $values, $order ) {
	if ( empty( $values['product_card_text'] ) ) {
		return;
	}

	$item->add_meta_data( get_field( 'product_card_label', 'options' ), $values['product_card_text'] );
}

add_action( 'woocommerce_checkout_create_order_line_item', 'amProductCardInputSaveOrderCB', 10, 4 );


//function prefix_update_existing_cart_item_meta( $cart_item_data, $product_id ) {
//	$cart = WC()->cart->cart_contents;
//	foreach ( $cart as $cart_item_id => $cart_item ) {
//		$cart_item['new_meta_data']                = 'Your stuff goes here';
//		WC()->cart->cart_contents[ $cart_item_id ] = $cart_item;
//	}
//	WC()->cart->set_session();
//}
//
//add_filter( 'woocommerce_add_cart_item_data', 'wdm_add_item_data', 1, 2 );