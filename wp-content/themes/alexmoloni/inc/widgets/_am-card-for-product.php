<?php

function amCardForProduct( $prod_id ) {

	?>
    <div class="am-card-for-product">
        <h4 class="heading-5 heading"><?= get_field( 'title_card_for_product', 'options' ) ?>:</h4>
        <div class="input-btn-wrap">
            <textarea data-prod-id="<?= $prod_id ?>" value="" type="text"><?= get_field( 'card_for_product', $prod_id ) ?></textarea>
            <a class="btn-cta-3 btn"><?= __( 'Dodaj notkę', 'alexmoloni' ) ?></a>
        </div>
    </div>
<?php }


function amCardForProductCB() {
	$card_text = $_POST['card_text'] ?? '';
	$nonce     = $_POST['nonce'] ?? '';
//	if ( ! wp_verify_nonce( $nonce, 'wpRestNonce' ) ) {
//		die ();
//	}
	$card_text = esc_html( $card_text );
	$prod_id   = $_POST['prod_id'] ?? null;
	$prod_id   = absint( $prod_id );
	if ( $prod_id && $card_text ) {
		update_post_meta( $prod_id, 'card_for_product', $card_text );
	}
	die();
}

add_action( "wp_ajax_am_card_for_product", "amCardForProductCB" );
add_action( "wp_ajax_nopriv_am_card_for_product", "amCardForProductCB" );
