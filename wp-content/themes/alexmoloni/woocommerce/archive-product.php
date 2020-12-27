<?php
global $wp_query;
$products = $wp_query->posts;

use alexito\Woocommerce;

get_header();
amShopBreadcrumb();
?>
    <div class="layout-with-sidebar">
        <div class="container-wide">
            <div class="main-cols-wrap">
                <aside class="sidebar"><?php amShopSidebar(); ?></aside>
                <div class="main-content">
					<?php if ( Woocommerce::shopFiltersSet() ): ?>
						<?php amProductsGrid( [
							'with_container'   => false,
							'small_gutter'     => true,
							'with_padding'     => false,
							'products_to_show' => 'custom_query',
							'products'         => $products
						] ) ?>
					<?php else: ?>
						<?php amCatalogueGrid(); ?>
					<?php endif; ?>
					<?php amNewsletterSignupSidebar( [
						'extra_css' => 'mobile-only'
					] ); ?>
                </div>
            </div>

        </div>

    </div>
<?php
get_footer();
