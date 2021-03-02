<?php

use alexito\Woocommerce;

function amDeliveryDate( $options = null ) {
	date_default_timezone_set( 'Europe/Warsaw' );
	?>
    <div id="am-delivery-date" class="am-delivery-date">
        <h3 class="heading-3"><?= get_field( 'section_delivery_time_title', 'options' ); ?></h3>
        <h4 class="heading-4 icon-text-wrap">
            <img class="icon" src="<?= get_field( 'calendar_icon', 'options' )['url']; ?>" alt="">
			<?= get_field( 'select_date_title', 'options' ); ?></h4>
        <div id="datetimepicker" class="delivery-calendar"></div>
        <h4 class="heading-4 icon-text-wrap">
            <img class="icon" src="<?= get_field( 'clock_icon', 'options' )['url']; ?>" alt="">
			<?= get_field( 'select_hour_title', 'options' ); ?></h4>
        <input data-date-short="" type="hidden" name="delivery_date">
        <select class="delivery-hour" name="delivery_hour" id="delivery-hour">
            <option value="" selected disabled><?= get_field( 'select_hour_title', 'options' ); ?></option>
			<?php
			//take from Checkout Page version PL (Zamówienie)
			$hours = get_field( 'delivery_hours', 64 ); ?>
			<?php foreach ( $hours as $slot ):
				$value = $slot['start'] . ' - ' . $slot['end'];
				$is_extra = $slot['is_extra'];
				?>
                <option <?= $is_extra ? 'data-is-extra="1"' : '' ?> data-hour-start="<?= $slot['start'] ?>" data-hour-end="<?= $slot['end'] ?>" value="<?= $value ?>"><?= $value ?><?= $is_extra ? ' - ' . __( 'Podwójne koszty wysyłki', 'alexmoloni' ) : '' ?></option>
			<?php endforeach; ?>
        </select>
        <div class="extra-info-wrap">
            <div class="insert-post-code-info info-box hidden color-warning">
		        <?= get_field( 'insert_post_code_info', 'options' ); ?></div>
            <div class="extra-price-info info-box hidden color-warning">
				<?= get_field( 'extra_price_info', 'options' ); ?></div>
            <div class="info-selected-date info-box hidden">
				<?= __( 'Wybrano', 'alexmoloni' ) ?>:
                <img src="<?= get_field( 'calendar_icon', 'options' )['url']; ?>" alt="" class="icon">
                <span class="value-date"></span>
                <img src="<?= get_field( 'clock_icon', 'options' )['url']; ?>" alt="" class="icon">
                <span class="value-hours"></span>
            </div>

        </div>


    </div>


<?php }

// Register main datetimepicker jQuery plugin script
add_action( 'wp_enqueue_scripts', 'enabling_date_time_picker' );
function enabling_date_time_picker() {

	// Only on front-end and checkout page
	if ( is_checkout() && ! is_wc_endpoint_url() ) :

		// Load the datetimepicker jQuery-ui plugin script
		wp_enqueue_style( 'datetimepicker', get_stylesheet_directory_uri() . '/assets/css/jquery-ui.min.css', array() );
		wp_enqueue_style( 'datetimepicker-theme', get_stylesheet_directory_uri() . '/assets/css/jquery-ui.theme.min.css', array() );
		wp_enqueue_script( 'datetimepicker', get_stylesheet_directory_uri() . '/assets/js/jquery-ui.min.js', array( 'jquery' ), '1.0', false );
	endif;
}

// Display custom checkout fields (+ datetime picker)
add_action( 'woocommerce_checkout_before_order_review', 'displayAmDeliveryDate', 10, 1 );
function displayAmDeliveryDate( $checkout ) {
	amDeliveryDate();
}

// Check that the delivery date is not empty when it's selected
function checkIssetAmDeliveryDate() {

	if ( ! isset( $_POST['delivery_hour'] ) || empty( $_POST['delivery_hour'] ) ) {
		wc_add_notice( __( 'Musisz wybrać godzinę dostawy', 'alexmoloni' ), 'error' );
	}

	if ( ! isset( $_POST['delivery_date'] ) || empty( $_POST['delivery_date'] ) ) {
		wc_add_notice( __( 'Musisz wybrać dzień dostawy', 'alexmoloni' ), 'error' );
	}


	if ( isset( $_POST['delivery_hour'] ) ) {
		if ( strpos( $_POST['delivery_hour'], '22' ) === 0 ) {
			$shipping_zone = Woocommerce::getCurrentlySelectedShippingZoneOnCheckout();

			/** @var WC_Shipping_Zone $shipping_zone */
			if ( $shipping_zone->get_id() === Woocommerce::getStrefa2ShippingZoneId() ) {
				wc_add_notice( __( 'Wysyłka nie jest możliwa o tej godzinie w strefie 2. Wybierz inną godzinę' ), 'error' );
			}
		}
	}


}

add_action( 'woocommerce_checkout_process', 'checkIssetAmDeliveryDate' );


// Check that the delivery date is not empty when it's selected
function save_order_delivery_data( $order, $data ) {
	if ( isset( $_POST['delivery_hour'] ) ) {
		$order->update_meta_data( 'am_delivery_hour', sanitize_text_field( $_POST['delivery_hour'] ) );
	}
	if ( isset( $_POST['delivery_date'] ) ) {
		$order->update_meta_data( 'am_delivery_date', esc_attr( $_POST['delivery_date'] ) );
	}
}

add_action( 'woocommerce_checkout_create_order', 'save_order_delivery_data', 10, 2 );


function checkoutChangeHour() {
	$hours    = $_POST['hours'] ?? '';
	$is_extra = $_POST['is_extra'] ?? 0;
	$nonce    = $_POST['nonce'] ?? '';
//	if ( ! wp_verify_nonce( $nonce, 'wpRestNonce' ) ) {
//		die ();
//	}
	$hours    = esc_html( $hours );
	$is_extra = (int) esc_html( $is_extra );

	$resp = [
		'hours'    => $hours,
		'is_extra' => $is_extra
	];

	WC()->session->set( 'is_extra_delivery_hour', $is_extra );
	foreach ( WC()->cart->get_shipping_packages() as $package_key => $package ) {
		// this is needed for us to remove the session set for the shipping cost. Without this, we can't set it on the checkout page.
		WC()->session->set( 'shipping_for_package_' . $package_key, false );
	}

	echo json_encode( $resp );
	die();
}


add_action( "wp_ajax_set_hour", "checkoutChangeHour" );
add_action( "wp_ajax_nopriv_set_hour", "checkoutChangeHour" );

function adjust_shipping_rate( $rates ) {

	foreach ( $rates as $rate ) {
		$cost     = $rate->cost;
		$is_extra = (int) WC()->session->get( 'is_extra_delivery_hour' );
		if ( $is_extra ) {
			$rate->cost = $cost * 2;
		}
		WC()->session->__unset( 'is_extra_delivery_hour' );

	}

	return $rates;
}

add_filter( 'woocommerce_package_rates', 'adjust_shipping_rate', 50 );

function clear_wc_shipping_rates_cache() {
	$packages = WC()->cart->get_shipping_packages();

	foreach ( $packages as $key => $value ) {
		$shipping_session = "shipping_for_package_$key";

		unset( WC()->session->$shipping_session );
	}
}

add_filter( 'woocommerce_checkout_update_order_review', 'clear_wc_shipping_rates_cache' );


function addAmDeliveryDateToThankYou( $order_id ) { ?>
    <h2><?= __( 'Termin dostawy', 'alexmoloni' ) ?></h2>
    <table class="woocommerce-table shop_table">
        <tbody>
        <tr>
            <th><?= __( 'Data', 'alexmoloni' ) ?></th>
            <td><?= get_post_meta( $order_id, 'am_delivery_date', true ) ?></td>
        </tr>
        <tr>
            <th><?= __( 'Godzina', 'alexmoloni' ) ?></th>
            <td><?= get_post_meta( $order_id, 'am_delivery_hour', true ) ?></td>
        </tr>
        </tbody>
    </table>
<?php }

add_action( 'woocommerce_thankyou', 'addAmDeliveryDateToThankYou', 20 );
add_action( 'woocommerce_view_order', 'addAmDeliveryDateToThankYou', 20 );


/*
 * @param $order_obj Order Object
 * @param $sent_to_admin If this email is for administrator or for a customer
 * @param $plain_text HTML or Plain text (can be configured in WooCommerce > Settings > Emails)
 */
function addAmDeliveryDateToEmail( $order_obj, $sent_to_admin, $plain_text ) {

	$delivery_date = get_post_meta( $order_obj->get_order_number(), 'am_delivery_date', true );
	$delivery_hour = get_post_meta( $order_obj->get_order_number(), 'am_delivery_hour', true );

	//  we will add the separate version for plaintext emails
	if ( $plain_text === false ) {

		// you shouldn't have to worry about inline styles, WooCommerce adds them itself depending on the theme you use
		?>
        <div class="delivery-date-img-wrap text-center">
            <img class="icon-small" src="<?= get_field( 'email_delivery_icon', 'options' )['url']; ?>" alt="">
        </div>
        <h2><?= __( 'Termin dostawy', 'alexmoloni' ) ?></h2>
        <p><strong><?= __( 'Data', 'alexmoloni' ) ?>:</strong> <?= $delivery_date ?>
            <br>
            <strong><?= __( 'Godzina', 'alexmoloni' ) ?>:</strong> <?= $delivery_hour ?>
        </p>

	<?php } else {
		echo "Delivery time\n
        Delivery date: $delivery_date
        Delivery hour: $delivery_hour";
	}

}

add_action( 'woocommerce_email_order_meta', 'addAmDeliveryDateToEmail', 10, 3 );

function amAdminDeliveryDate( $order ) {
	$order_id = $order->get_id();
	$meta_key = get_post_meta( $order->get_id(), 'am_delivery_date', true );
	if ( ! $meta_key ) {
		echo '<h3>Nie podano daty dostawy</h3>';

		return;
	}
	?>

    <div class="admin-delviery-date">
        <h3><?= __( 'Data dostawy', 'alexmoloni' ) ?></h3>
        <p><strong><?= __( 'Data', 'alexmoloni' ) ?>: </strong><?= get_post_meta( $order_id, 'am_delivery_date', true ) ?></p>
        <p><strong><?= __( 'Godzina', 'alexmoloni' ) ?>: </strong><?= get_post_meta( $order_id, 'am_delivery_hour', true ) ?></p>
    </div>
	<?php
}

add_action( 'woocommerce_admin_order_data_after_shipping_address', 'amAdminDeliveryDate' );
