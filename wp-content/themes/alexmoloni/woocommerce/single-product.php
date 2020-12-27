<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alexmoloni
 */

use alexito\Woocommerce;

get_header();
if ( have_posts() ):
	while ( have_posts() ):
		the_post();
		$product = wc_get_product( get_the_ID() );
		$prod_id = $product->get_id();
		amShopBreadcrumb();
		?>
        <section class="section-1">
            <div class="container">
                <div class="cols-wrap">
                    <div class="col-gallery">
						<?php amProductGallery( [
							'product' => $product
						] ) ?>
                    </div>
                    <div class="col-details">
                        <form class="am-single-product-form">
	                        <?php amProductLabelsRow($product->get_id()); ?>
                            <h1 class="title heading-3"><?= $product->get_title() ?></h1>
                            <div class="description"><?= $product->get_description() ?></div>
                            <?php amCompanySetDescription([
                                    'product_id' => $product->get_id()
                            ]); ?>
                            <div class="price"><?= Woocommerce::getFormattedPrice( $product ) ?></div>
							<?php if ( Woocommerce::productHasSizesAttribute( $product->get_id() ) ): ?>
                                <div class="sizes-section variations-section">
									<?php
									$variations = Woocommerce::getProductVariationsForSizes( $prod_id );
									?>
                                    <p class="section-title heading-5"><?= get_field( 'sizes_title', 'options' ) ?>:</p>
									<?php
									$i = 0;
									foreach ( $variations as $variation ):
										$i ++;
										$checked = $i === 1;
										?>
										<?php amPrettyRadio( [
										'label_text'       => $variation->get_attribute( 'pa_rozmiar-zestawu' ),
										'input_name'       => 'size',
										'input_value'      => $variation->get_price(),
										'input_extra_data' => 'data-variation-id="' . $variation->get_id() . '" data-variation-price="' . $variation->get_price() . '"',

										'checked'         => $checked,
										'input_extra_css' => 'js-change-variation'
									] ); ?>

									<?php endforeach; ?>
                                </div>
							<?php endif; ?>
							<?php if ( Woocommerce::productHasPiecesAttribute( $product->get_id() ) ): ?>
                                <div class="pieces-section variations-section">
									<?php
									$variations = Woocommerce::getProductVariationsForPieces( $prod_id );
									?>
                                    <p class="section-title heading-5"><?= get_field( 'pieces_title', 'options' ) ?>:</p>
									<?php
									$i = 0;
									foreach ( $variations as $variation ):
										$i ++;
										$checked = $i === 1;
										?>
										<?php amPrettyRadio( [
										'label_text'       => $variation->get_attribute( 'pa_pieces' ),
										'input_name'       => 'size',
										'input_value'      => $variation->get_price(),
										'input_extra_data' => 'data-variation-id="' . $variation->get_id() . '" data-variation-price="' . $variation->get_price() . '"',

										'checked'         => $checked,
										'input_extra_css' => 'js-change-variation'
									] ); ?>

									<?php endforeach; ?>
                                </div>
							<?php endif; ?>
                            <div class="btns-wrap">
								<?php amAddToCartBtn( [
									'product' => $product
								] ); ?>
								<?php amAddToCartBtn( [
									'product'     => $product,
									'buy_now_btn' => true
								] ); ?>
                            </div>
                            <div class="categories-wrap">
                                <h4 class="heading-5 heading"><?= __( 'Kategorie', 'alexmoloni' ) ?>:</h4>
                                <div class="links-wrap">
									<?= Woocommerce::getLinkCategoriesForProduct( $prod_id ); ?>
                                </div>
                            </div>
                            <?php amProductCardInput(); ?>
							<?php amComplementaryProducts(); ?>
                        </form>
                    </div>
                </div>
            </div>
        </section>
		<?php amRecentlyViewedProducts( [
		'heading'         => get_field( 'title_recently_viewed', 'options' ),
		'current_prod_id' => $product->get_id()
	] ); ?>
	<?php endwhile;
endif;

get_footer();
