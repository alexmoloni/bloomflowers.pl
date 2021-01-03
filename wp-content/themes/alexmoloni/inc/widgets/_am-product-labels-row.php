<?php

use alexito\Woocommerce;

function amProductLabelsRow( $product_id ) {
	$recommended    = get_field( 'recommended', $product_id );
	$is_product_hit = Woocommerce::isProductHit( $product_id );
	$is_in_stock = Woocommerce::isInStock( $product_id );
	if ( ! $recommended && ! $is_product_hit ) {
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
        <?php if (!$is_in_stock): ?>
            <span class="label sold-out"><?= __( 'Wyprzedany', 'alexmoloni' ) ?></span>
        <?php endif; ?>
    </div>
<?php }
