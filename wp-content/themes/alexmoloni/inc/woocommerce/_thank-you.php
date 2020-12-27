<?php

function amAddLocalPickupMessageThankyou( $order_id ) {
	$order = new WC_Order( $order_id );

	if ( $order->has_shipping_method('local_pickup') ):
		?>
        <h2 class="heading-2"><?= __( 'Odbiór osobisty', 'alexmoloni' ) ?></h2>
        <p style="" class=""><?= get_field( 'text_next_to_shop_pickup', 'options' ); ?></p>

	<?php
	endif;
}

add_action( 'woocommerce_thankyou', 'amAddLocalPickupMessageThankyou', 20 );
add_action( 'woocommerce_view_order', 'addAmDeliveryDateToThankYou', 20 );