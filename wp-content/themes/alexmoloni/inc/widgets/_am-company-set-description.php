<?php

function amCompanySetDescription( $options = null ) {
	$texts      = get_field( 'sets', 'options' );
	$product_id = $options['product_id'];
	if ( ! get_field( 'composition', $product_id ) && ! get_field( 'items_in_set', $product_id ) ) {
		return;
	}
	?>
    <div class="am-company-set-description">
		<?php if ( get_field( 'composition', $product_id ) ): ?>
            <p class="desc-row">
                <strong><?= $texts['title_composition'] ?></strong>: <?= get_field( 'composition', $product_id ); ?>
            </p>
		<?php endif; ?>
		<?php if ( get_field( 'items_in_set', $product_id ) ): ?>
            <p class="desc-row">
                <strong><?= $texts['title_complete_set'] ?></strong>: <?= get_field( 'items_in_set', $product_id ); ?>
            </p>
		<?php endif; ?>
    </div>
<?php }
