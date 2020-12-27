<?php

use alexito\Woocommerce;

function amAddToCartBtn( $options = null ) {
	$product        = $options['product'] ?? null;
	$is_variable    = Woocommerce::isVariableProduct( $product );
	$buy_now_btn    = $options['buy_now_btn'] ?? false;
	$has_variations = false;
	if ( $is_variable ) {
		$variations = Woocommerce::getVariableProductAvailableVariations( $product );
		if ( ! empty( $variations ) ) {
			$has_variations    = true;
			$initial_variation = $variations[0]->get_id();
		}
	}
	?>
    <div class="am-cart-btn <?= $buy_now_btn ? 'is-buy-now-btn' : '' ?>">
		<?php if ( $product ): ?>
			<?php if ( $buy_now_btn ): ?>
                <a data-comp-products="" data-checkout-url="<?= wc_get_checkout_url() ?>" <?= $has_variations ? 'data-variation-id="' . $initial_variation . '"' : '' ?> data-product-id="<?= $product->get_id() ?>" class="btn-cta-2 btn-small btn js-buy-now-btn js-ajax-add-to-cart" href="<?= wc_get_checkout_url() ?>"><?= __( 'Kup teraz', 'alexmoloni' ) ?></a>
			<?php else: ?>
                <a data-comp-products="" <?= $has_variations ? 'data-variation-id="' . $initial_variation . '"' : '' ?> data-product-id="<?= $product->get_id() ?>" class="btn-cta-1 btn-small js-ajax-add-to-cart btn-add-to-cart btn" href=""><?= __( 'Do koszyka', 'alexmoloni' ) ?></a>
                <a class="btn-cta-2 btn-small btn-show-cart" href="<?= wc_get_cart_url() ?>"><?= __( 'Koszyk', 'alexmoloni' ) ?></a>
			<?php endif; ?>
		<?php endif; ?>
    </div>
<?php }
