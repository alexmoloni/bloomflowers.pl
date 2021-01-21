<?php

use alexito\Woocommerce;

function amProductLabelsRow( $product_id ) {
	$recommended    = Woocommerce::isProductRecommended( $product_id );
	$is_product_hit = Woocommerce::isProductHit( $product_id );
	$product        = wc_get_product( $product_id );
	$on_sale        = Woocommerce::isOnSale( $product );

	if ( ! $recommended && ! $is_product_hit && ! $on_sale ) {
		return;
	}
	?>
    <div class="am-product-labels-row">
		<?php if ( $recommended ): ?>
            <span class="label recommended"><?= __( 'Polecamy', 'alexmoloni' ) ?></span>
		<?php endif; ?>
		<?php if ( $is_product_hit ): ?>
            <span class="label new"><?= __( 'Hit', 'alexmoloni' ) ?></span>
		<?php endif; ?>
		<?php if ( $on_sale ): ?>
            <span class="label on-sale">
                                    <span class="text"><?= __( 'Sale', 'alexmoloni' ) ?></span>
                                    <img src="<?= get_field( 'promo_icon', 'options' )['sizes']['thumbnail']; ?>" alt="">
                                </span>
		<?php endif; ?>
    </div>
<?php }
