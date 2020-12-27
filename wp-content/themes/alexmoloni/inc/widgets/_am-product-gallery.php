<?php

function amProductGallery( $options = null ) {
	/** @var WC_Product | null $product */
	$product = $options['product'] ?? null;
	$images  = [];
	if ( $product ) {
		$images = $product->get_gallery_image_ids();
	}

	?>
    <div class="am-product-gallery">
        <div class="cols-wrap">
            <div class="col-left">
                <ul class="product-gallery-slider-nav">
		            <?php foreach (  $images as $imageId ): ?>
                        <li class="product-image-thumb">
                            <figure class="img-wrap">
                                <img alt="<?= $product->get_title() ?>" src="<?= wp_get_attachment_image_src( $imageId, 'thumbnail' )[0] ?>">
                            </figure>
                        </li>
		            <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-right">
                <ul class="product-gallery product-gallery-slider">
		            <?php foreach ( $images as $imageId ): ?>
                        <li class="product-image">
                            <figure class="img-wrap">
                                <img alt="<?= $product->get_title() ?>" src="<?= wp_get_attachment_image_src( $imageId, 'woocommerce_single' )[0] ?>">
                            </figure>
                        </li>
		            <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php }

