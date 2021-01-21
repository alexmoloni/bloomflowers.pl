<?php
global $wp_query;
$products    = $wp_query->get_posts();
$current_cat = null;
if ( $wp_query->get_queried_object() instanceof WP_Term && $wp_query->get_queried_object()->taxonomy === 'product_cat' ) {
	$current_cat = $wp_query->get_queried_object();
}

get_header();
amShopBreadcrumb();
?>
    <div class="layout-with-sidebar">
        <div class="container-wide">
            <div class="main-cols-wrap">
                <aside class="sidebar"><?php amShopSidebar( [
						'current_cat' => $current_cat
					] ); ?></aside>
                <div class="main-content">
					<?php amProductsGrid( [
						'with_container'   => false,
						'small_gutter'     => true,
						'with_padding'     => false,
						'products_to_show' => 'custom_query',
						'products'         => $products
					] ) ?>
					<?php amPagination( [
						'paged' => 'paged',
						'query' => $wp_query
					] ); ?>
                </div>
            </div>

        </div>

    </div>
<?php
get_footer();
