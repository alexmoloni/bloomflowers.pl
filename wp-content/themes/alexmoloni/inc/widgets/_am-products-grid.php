<?php

use alexito\Woocommerce;

function amProductsGrid( $options = null ) {
	$heading                   = $options['heading'] ?? get_field( 'heading' ) ?? false;
	$subheading                = $options['subheading'] ?? get_field( 'subheading' ) ?? false;
	$with_container            = $options['with_container'] ?? get_field( 'with_container' ) ?? true;
	$with_padding              = $options['with_padding'] ?? get_field( 'with_padding' ) ?? true;
	$small_gutter              = $options['small_gutter'] ?? get_field( 'small_gutter' ) ?? false;
	$text_align                = $options['text_align'] ?? get_field( 'text_align' ) ?? 'left';
	$extra_css                 = $options['extra_css'] ?? get_field( 'extra_css' ) ?? '';
	$light_grey_background     = $options['light_grey_background'] ?? get_field( 'light_grey_background' ) ?? false;
	$products_to_show          = $options['products_to_show'] ?? get_field( 'products_to_show' ) ?? 'select_products_manually';
	$use_custom_query          = $products_to_show === 'custom_query';
	$select_products_manually  = $products_to_show === 'select_products_manually';
	$show_recommended_products = $products_to_show === 'show_recommended_products';
	$show_sales_hits           = $products_to_show === 'show_sales_hits';
	$show_company_sets         = $products_to_show === 'show_company_sets';

	if ( $use_custom_query ) {
		$products = $options['products'] ?? [];
	} elseif ( $select_products_manually ) {
		$products = get_field( 'products' ) ?? [];
	} else {
		$query_args = [
			'post_type'      => 'product',
			'posts_per_page' => 4,
			'order'          => 'DESC',
			'orderby'        => 'menu_order'
		];
		if ( $show_recommended_products ) {
			$query_args['meta_query'] = [
				[
					'key'     => 'recommended',
					'value'   => 1,
					'compare' => '=',
					'type'    => 'CHAR',
				]
			];
		} elseif ( $show_sales_hits ) {
			$query_args['meta_query'] = [
				[
					'key'     => 'hit',
					'value'   => 1,
					'compare' => '=',
					'type'    => 'CHAR',
				]
			];

		} elseif ( $show_company_sets ) {
			$query_args['tax_query'] = [
				[
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => [ 'kwiaty-do-domu' ]
				]
			];
		}

		$query    = new WP_Query( $query_args );
		$products = $query->posts;
	} ?>
    <div class="am-products-grid <?= $with_padding ? 'section' : '' ?> <?= $show_company_sets ? 'show-company-sets' : '' ?> <?= $light_grey_background ? 'light-grey-background' : '' ?> <?= $small_gutter ? 'small-gutter' : '' ?> <?= $extra_css ?>">
        <div class="<?= $with_container ? 'container' : '' ?>">
			<?php if ( $heading ): ?>
                <h2 class="heading-2 heading text-<?= $text_align ?>"><?= $heading ?></h2>
			<?php endif; ?>
			<?php if ( $subheading ): ?>
                <h3 class="heading-4 subheading text-<?= $text_align ?>"><?= $subheading ?></h3>
			<?php endif; ?>
			<?php if ( empty( $products ) ): ?>
                <h2 class="heading-2"><?= __( 'Brak produktów do wyświetlenia', 'alexmoloni' ) ?></h2>
			<?php endif; ?>
            <div class="products-wrap">
				<?php
				/** @var WP_Post $post */
				foreach ( $products as $product_id ):
					/** @var WC_Product $product */
					$product = wc_get_product( $product_id );

					if ( ! $product instanceof WC_Product ) {
						break;
					}

					$has_sizes   = Woocommerce::productHasSizesAttribute( $product->get_id() );
					$has_pieces  = Woocommerce::productHasPiecesAttribute( $product->get_id() );
					$is_variable = Woocommerce::isVariableProduct( $product );
					if ( $is_variable ) {
						$price_min = $product->get_variation_price();
						$price_max = $product->get_variation_price( 'max' );
					}

					?>
                    <div class="am-product-item <?= $has_sizes ? 'has-sizes' : 'no-sizes' ?> <?= $is_variable ? 'is-variable' : '' ?>">
                        <a href="<?= get_permalink( $product->get_id() ); ?>" class="img-link">
                            <figure>
								<?= $product->get_image(); ?>
                            </figure>
							<?php amProductLabelsRow( $product->get_id() ); ?>
                        </a>
						<?php if ( $show_company_sets ): ?>
                            <div class="content-product-with-sizes content-wrap">
                                <a href="<?= get_permalink( $product->get_id() ); ?>">
                                    <h3 class="title"><?= $product->get_title() ?></h3>
                                </a>
								<?php amSizesInfo( $product->get_id() ); ?>
								<?php amCompanySetDescription( [
									'product_id' => $product->get_id()
								] ); ?>
                                <a class="btn btn-cta-3" href="<?= get_permalink( $product->get_id() ) ?>"><?= __( 'Szczegóły', 'alexmoloni' ) ?></a>
                            </div>
						<?php else: ?>
                            <div class="content-with-btns-wrap content-wrap">
                                <div class="title-price-wrap">
                                    <h3 class="title"><?= $product->get_title() ?></h3>
									<?php if ( $is_variable ): ?>
                                        <div class="price-wrap-variable">
                                            <span class="label"><?= __( 'od', 'alexmoloni' ) ?></span>&nbsp;<span class="value"><?= wc_price( $price_min ) ?></span><br>
                                            <!--                                            <span class="label">-->
											<? //= __('do', 'alexmoloni') ?><!--</span>&nbsp;<span class="value">-->
											<? //= wc_price( $price_max ) ?><!--</span>-->
                                        </div>
									<?php else: ?>
                                        <h4 class="heading-4 price"><?= wc_price( $product->get_price() ) ?></h4>
									<?php endif; ?>
                                </div>
                                <div class="btns-wrap">
									<?php if ( $product->is_type( 'simple' ) ): ?>
										<?php if ( $product->is_in_stock() ): ?>
											<?php amAddToCartBtn( [
												'product' => $product
											] ); ?>
										<?php endif; ?>
                                        <a class="btn-cta-2 btn-small" href="<?= get_permalink( $product->get_id() ); ?>"><?= __( 'Szczegóły', 'alexmoloni' ) ?></a>
									<?php elseif ( $has_sizes || $has_pieces ): ?>
                                        <a class="btn-cta-2 btn-small" href="<?= get_permalink( $product->get_id() ); ?>"><?= __( 'Wybierz rozmiar', 'alexmoloni' ) ?></a>
									<?php endif; ?>
                                </div>
								<?php if ( $has_sizes ): ?>
									<?php amSizesInfo( $product->get_id() ); ?>
								<?php endif; ?>
                            </div>

						<?php endif; ?>

                    </div>


				<?php endforeach; ?>
            </div>
        </div>
    </div>
<?php }


?>

