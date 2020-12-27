<?php

function amComplementaryProducts( $options = null ) {
	$comp_prods = get_posts( [
		'post_type'      => 'product',
		'posts_per_page' => - 1,
		'tax_query'      => [
			[
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => 'complementary',
				'operator' => 'IN'
			]
		]
	] );
	?>
    <div class="am-complementary-products">
        <h3 class="heading-5 comp-prods-title"><?= __('Dodatki do bukietu', 'alexmoloni') ?>:</h3>
        <div class="items-wrap">
			<?php foreach ( $comp_prods as $product ):
				$product = wc_get_product( $product );
				$uniq_id = wp_unique_id();
				?>
                <div class="comp-item">
                    <input value="<?= $product->get_id() ?>" data-prod-id="<?= $product->get_id() ?>" class="comp-input" id="<?= $uniq_id ?>" type="checkbox" name="comp_item">
                    <label for="<?= $uniq_id ?>">
                        <figure>
		                    <?= $product->get_image( 'thumbnail' ) ?>
                        </figure>
                        <h4 class="heading-5 cross-title"><?= $product->get_title() ?></h4>
                        <div class="comp-price"><?= wc_price( $product->get_price() ) ?></div>
                    </label>

                </div>

			<?php endforeach; ?>
        </div>
    </div>
<?php }
