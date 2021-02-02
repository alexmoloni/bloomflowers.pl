<?php
/**
 * Email Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-addresses.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$text_align = is_rtl() ? 'right' : 'left';
/** @var WC_Order $order */
$address    = $order->get_formatted_billing_address();
$shipping   = $order->get_formatted_shipping_address();

?>
<table class="address-table section-underline" id="addresses" cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top; margin-bottom: 40px; padding:0;" border="0">
    <tr>
        <td class="text-center" valign="top" width="50%">
            <img class="icon-very-small" src="<?= get_field( 'email_billing_icon', 'options' )['url']; ?>" alt="">
            <h2 class="fz16"><?php esc_html_e( 'Billing address', 'woocommerce' ); ?></h2>

            <address class="address">
				<?php echo wp_kses_post( $address ? $address : esc_html__( 'N/A', 'woocommerce' ) ); ?>
				<?php if ( $order->get_billing_phone() ) : ?>
                    <br/><?php echo wc_make_phone_clickable( $order->get_billing_phone() ); ?>
				<?php endif; ?>
				<?php if ( $order->get_billing_email() ) : ?>
                    <br/><?php echo esc_html( $order->get_billing_email() ); ?>
				<?php endif; ?>
            </address>
        </td>
		<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && $shipping ) : ?>
            <td class="text-center" valign="top" width="50%">
                <img class="icon-very-small" src="<?= get_field( 'email_delivery_address_icon', 'options' )['url']; ?>" alt="">
                <h2 class="fz16"><?php esc_html_e( 'Shipping address', 'woocommerce' ); ?></h2>

                <address class="address"><?php echo wp_kses_post( $shipping ); ?>
					<?php
					if ( get_post_meta( $order->get_id(), 'shipping_phone', true ) ) { ?>
                        <br>
                        <a href="tel:<?= get_post_meta( $order->get_id(), 'shipping_phone', true ) ?>"><?= get_post_meta( $order->get_id(), 'shipping_phone', true ) ?></a>
					<?php } ?>
                </address>
            </td>
		<?php endif; ?>
		<?php
		if ( get_post_meta( $order->get_id(), 'no_address', true ) ) { ?>
            <br> <p><?= __( 'Zaznaczono', 'alexmoloni' ) ?>: <?= get_post_meta( $order->get_id(), 'no_address', true ) ?></p>
			<?php
			if ( get_post_meta( $order->get_id(), 'shipping_phone', true ) ) { ?>
                    <p>
                        <?= $order->get_shipping_first_name() ?> <?= $order->get_shipping_last_name()  ?><br>
                        <a href="tel:<?= get_post_meta( $order->get_id(), 'shipping_phone', true ) ?>"><?= get_post_meta( $order->get_id(), 'shipping_phone', true ) ?></a>
                    </p>
			<?php } ?>

		<?php }
		?>
    </tr>
</table>
