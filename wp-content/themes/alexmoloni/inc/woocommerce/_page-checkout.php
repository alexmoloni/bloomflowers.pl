<?php

function am_before_billing() {
	?>
    <h3 class="heading-3"><?= get_field( 'title_checkout_billing_details', 'options' ); ?></h3>
	<?php
}

add_action( 'woocommerce_before_checkout_billing_form', 'am_before_billing', 15 );

function am_before_shipping_details() {
	?>
    <h3 class="heading-3"><?= get_field( 'title_checkout_shipping_person_details', 'options' ); ?></h3>
	<?php
}

add_action( 'woocommerce_before_checkout_shipping_form', 'am_before_shipping_details', 15 );

function am_woocommerce_checkout_before_order_review() {
	?>
    <h3 class="heading-3"><?= get_field( 'title_checkout_shipping', 'options' ); ?></h3>
	<?php
}

add_action( 'woocommerce_checkout_before_order_review', 'am_woocommerce_checkout_before_order_review', 15 );

function am_woocommerce_review_order_before_payment() {
	?>
    <h3 class="heading-3"><?= get_field( 'title_checkout_payment', 'options' ); ?></h3>
	<?php
}

add_action( 'woocommerce_review_order_before_payment', 'am_woocommerce_review_order_before_payment', 15 );


function shipchange( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'Ship to a different address?' :
			$translated_text = 'Ship to a different address? Recipient details';
			break;
		case 'Wysłać na inny adres?' :
			$translated_text = 'Wysłać na inny adres? Dane odbiorcy';
			break;
	}

	return $translated_text;
}

add_filter( 'gettext', 'shipchange', 20, 3 );

function am_modify_fields( $fields ) {
	unset( $fields['billing']['billing_company'] );
	unset( $fields['billing']['billing_address_1'] );
	unset( $fields['billing']['billing_address_2'] );
	unset( $fields['billing']['billing_city'] );
	unset( $fields['billing']['billing_postcode'] );
	unset( $fields['billing']['billing_country'] );
	unset( $fields['billing']['billing_state'] );


	$fields['shipping']['no_address'] = [
		'label'    => get_field( 'text_shipping_no_address', 'options' ),
		'required' => false,
		'class'    => array( 'form-row-wide' ),
		'clear'    => true,
		'type'     => 'checkbox',
		'priority' => 30
	];


	return $fields;
}

add_filter( "woocommerce_checkout_fields", "am_modify_fields", 10, 1 );

function am_default_address_fields( $fields ) {
	unset( $fields['company'] );
	$fields['address_1']['required'] = false;
	$fields['address_2']['required'] = false;
	$fields['city']['required']      = false;
	$fields['state']['required']     = false;

//	$fields['postcode']['required']  = false;

	return $fields;
}

add_filter( "woocommerce_default_address_fields", "am_default_address_fields", 15, 1 );


//add extra text to Darmowa Przesyłka  shipping method
/**
 * @param $method WC_Shipping_Rate
 * @param $index
 */
function extraTextShipping( WC_Shipping_Rate $method, $index ) {
	if ( $method->get_method_id() === 'local_pickup' ) {
		?>
        <small class="extra-info"><?= get_field( 'text_next_to_shop_pickup', 'options' ) ?></small>
	<?php }
}

add_action( 'woocommerce_after_shipping_rate', 'extraTextShipping', 10, 2 );

function amUpdateOrderMeta( $order_id ) {
	if ( isset( $_POST['no_address'] ) ) {

		update_post_meta( $order_id, 'no_address', get_field( 'text_shipping_no_address', 'options' ) );
	}
}

add_action( 'woocommerce_checkout_update_order_meta', 'amUpdateOrderMeta' );

function amThankYouCb( $order_id ) {
	if ( get_post_meta( $order_id, 'no_address', true ) === '' ) {
		return;
	}
	?>

    <p class="no-address-wrap">
        Zaznaczono: <?= get_post_meta( $order_id, 'no_address', true ) ?>
    </p>
	<?php
}

add_action( 'woocommerce_thankyou', 'amThankYouCb', 40, 1 );

function amAddMetaToAdminOrder( $order ) {
	$meta_key = get_post_meta( $order->get_id(), 'no_address', true );
	if ( $meta_key ) { ?>
        <p>
            Zaznaczono: <?= get_post_meta( $order->get_id(), 'no_address', true ) ?>
        </p>
	<?php }

}

add_action( 'woocommerce_admin_order_data_after_shipping_address',
	'amAddMetaToAdminOrder' );

function amAddCopyFromBilling() {
	?>
    <a id="copy-buyer-details" class="btn-cta-3" href=""><?= get_field( 'text_copy_buyer_details', 'options' ) ?></a>
<?php }

add_action( 'woocommerce_before_checkout_shipping_form', 'amAddCopyFromBilling', 30 );