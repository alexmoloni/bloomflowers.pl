<?php

use alexito\Woocommerce;

function amMiniCart( $options = null ) {
	$items = Woocommerce::getCartItems();
	?>
    <div class="am-mini-cart">
		<?php if ( empty( $items ) ): ?>
        <p class="empty-msg"><?= __('Brak produktów w koszyku', 'alexmoloni') ?></p>
		<?php else: ?>
            <div class="items-wrap">
				<?php
				foreach ( $items as $key => $value ):
					$_product = wc_get_product( $value['data']->get_id() );

					?>
                    <div data-product-id="<?= $_product->get_id() ?>" class="cart-item">
                        <figure class="col-left">
							<?= $_product->get_image( 'thumbnail' ); ?>
                        </figure>
                        <div class="col-right">
                            <a href="<?= $_product->get_permalink() ?>" class="title"><?= $_product->get_title() ?></a>
                            <div class="row-bottom">
								<?= $value['quantity'] ?> X <?= wc_price( $_product->get_price() ) ?>
                            </div>
                        </div>
                        <div class="col-remove">
                            <a data-prod-id="<?= $_product->get_id() ?>" class="js-ajax-remove-from-cart btn-remove-item" href="">Remove
                                item</a>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
            <div class="cart-total-wrap">
                <div class="label"><?= __( 'Total', 'alexmoloni' ) ?></div>
                <div class="value cart-total-value"><?= Woocommerce::getCartTotal() ?></div>
            </div>
            <div class="btn-wrap">
                <a class="btn-cta-2" href="<?= apply_filters( 'wpml_permalink', site_url( 'zamowienie' ), ICL_LANGUAGE_CODE ) ?>"><?= __( 'Zamówienie', 'alexmoloni' ) ?></a>
            </div>
		<?php endif; ?>

    </div>
<?php }
