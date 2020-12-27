<?php

use alexito\Woocommerce;

function amShopBreadcrumb( $options = null ) {
	global $wp_query;
	$queried_object = $wp_query->get_queried_object();
	$cat_link       = false;
	$cat_name       = false;
	$title          = __( 'Katalog kwiatów', 'alexmoloni' );
	$prod_name      = false;
	if ( $queried_object instanceof WP_Term && $queried_object->taxonomy === 'product_cat' ) {
		$cat_link = get_term_link( $queried_object );
		$cat_name = $queried_object->name;
		$title    = $queried_object->name;
	} elseif ( $queried_object instanceof WP_Post ) {
		/** @var WP_Post $queried_object */
		if ( 'product' === get_post_type( $queried_object ) ) {
			$categories = Woocommerce::getCategoriesForProduct( $queried_object->ID );
			if ( $categories ) {
				$cat_link = get_term_link( $categories[0] );
				$cat_name = $categories[0]->name;
			}
			$prod_name = $queried_object->post_title;
		} elseif ( 'page' === get_post_type( $queried_object ) ) {
			$title      = $queried_object->post_title;
			$page_title = $queried_object->post_title;
		}

	}
	?>
    <div class="am-shop-breadcrumb">
        <div class="container-wide">
            <h2 class="heading-3 title"><?= $title ?></h2>
            <div class="links-wrap">
                <a href="<?= site_url() ?>"><?= __( 'Home', 'alexmoloni' ) ?></a>
				<?php
                if ( $cat_link || is_post_type_archive( 'product' ) || is_singular(['product']) ): ?>
                    <span class="separator">-</span>
                    <a href="<?= apply_filters( 'wpml_permalink', site_url( 'sklep' ), ICL_LANGUAGE_CODE ) ?>"><?= __( 'Katalog', 'alexmoloni' ) ?></a>
					<?php if ( $cat_link ): ?>
                        <span class="separator">-</span>
                        <a href="<?= apply_filters( 'wpml_permalink', $cat_link, ICL_LANGUAGE_CODE ) ?>"><?= $cat_name ?></a>
					<?php endif; ?>
				<?php endif; ?>
				<?php if ( $prod_name ): ?>
                    <span class="separator">-</span>
                    <p><?= $prod_name ?></>
				<?php elseif ( ! empty( $page_title ) ): ?>
                    <span class="separator">-</span>
                    <p><?= $page_title ?></>
				<?php endif; ?>
            </div>
        </div>
    </div>
<?php }
