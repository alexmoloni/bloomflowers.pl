<?php

use alexito\Woocommerce;

function amSizesInfo( $prod_id ) {
	$variations = Woocommerce::getProductVariationsForSizes($prod_id);
	?>
    <div class="am-sizes-info">
        <div class="title-above-sizes"><?= get_field( 'sets', 'options' )['title_above_sizes'] ?></div>
	    <?php foreach ( $variations as $variation ):
		    $size = $variation->get_attribute( 'pa_rozmiar-zestawu' );
		    ?>
            <div class="variation">
                <div class="label"><?= __( 'Rozmiar', 'alexmoloni' ) ?> <?= $size ?>:</div>
                <div class="price"><?= wc_price( $variation->get_price() ) ?></div>
            </div>
	    <?php endforeach; ?>
    </div>


<?php }
