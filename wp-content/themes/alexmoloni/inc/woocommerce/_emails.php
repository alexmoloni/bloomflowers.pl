<?php

add_filter( 'woocommerce_email_order_items_args', 'amEmails', 10, 1 );
/**
 * WooCommerce
 * Show thumbs in Order Email sent to customers
 */
function amEmails( $args ) {

	$args['show_image'] = true;
	$args['image_size'] = array( 150, 150 );

	return $args;

}

function addInfoLocalPickupEmail( $order_obj, $sent_to_admin, $plain_text ) {
	if ( $order_obj->has_shipping_method( 'local_pickup' ) ):
		if ( $plain_text === false ) : ?>
            <h2><?= __( 'Odbiór osobisty', 'alexmoloni' ) ?></h2>
            <p><?= get_field( 'text_next_to_shop_pickup', 'options' ) ?></p>
		<?php else:
			echo get_field( 'text_next_to_shop_pickup', 'options' );
		endif;
	endif;
}

add_action( 'woocommerce_email_order_meta', 'addInfoLocalPickupEmail', 20, 3 );