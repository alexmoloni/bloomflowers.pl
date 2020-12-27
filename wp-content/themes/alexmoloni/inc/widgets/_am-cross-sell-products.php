<?php

function amCrossSellProducts( $options = null ) {
	$product        = $options['product'] ?? null;
	$cross_sell_ids = $product->get_cross_sell_ids();
	?>
    <div class="am-cross-sell-products">
		<?php foreach ( $cross_sell_ids as $prod_id ):
			$product = wc_get_product( $prod_id );
			$uniq_id = wp_unique_id();
			?>
            <div class="cross-sell-item">
                <input id="<?= $uniq_id ?>" type="checkbox" name="cross_sell_item">
                <label for="<?= $uniq_id ?>">
                    <figure>
						<?= $product->get_image( 'thumbnail' ) ?>
                    </figure>
                    <h4 class="heading-5 title"><?= $product->get_title() ?></h4>
                    <div class="price"><?= wc_price( $product->get_price() ) ?></div>
                </label>
            </div>
		<?php endforeach; ?>
    </div>
<?php }
