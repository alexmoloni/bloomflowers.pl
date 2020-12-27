<?php

use alexito\Helpers;
use alexito\Woocommerce;

add_action( 'pre_get_posts', 'am_filter_products' );

function filterPrice( $query ) {
	if ( ! isset( $_GET['filter_price_min'] ) && ! isset( $_GET['filter_price_max'] ) ) {
		return;
	}

	if ( isset( $_GET['filter_price_min'] ) && ! is_numeric( $_GET['filter_price_min'] ) ) {
		return;
	}

	if ( isset( $_GET['filter_price_max'] ) && ! is_numeric( $_GET['filter_price_max'] ) ) {
		return;
	}

	$min_price = (int) $_GET['filter_price_min'] ?? 0;
	$max_price = (int) $_GET['filter_price_max'] ?? Woocommerce::getMinMaxPriceInAllProducts();

	if ( $min_price || $max_price ) {
		$new_meta_query = [
			[
				'key'     => '_price',
				'value'   => [ $min_price, $max_price ],
				'compare' => 'BETWEEN',
				'type'    => 'NUMERIC'
			]
		];

		Helpers::appendMetaQuery( $query, $new_meta_query, 'AND' );
	}
}

function filterNew( $query ) {
	$show_new = isset( $_GET['new'] ) && $_GET['new'] === '1';
	if ( $show_new ) {
		$query->set( 'date_query', [
			[
				'after'  => '-30 days',
				'column' => 'post_date',
			]
		] );
	}

}

function filterRecommended( $query ) {
	$show_recommended = isset( $_GET['recommended'] ) && $_GET['recommended'] === '1';
	if ( $show_recommended ) {


		$new_meta_query = [
			[
				'key'     => 'recommended',
				'value'   => 1,
				'compare' => '=',
				'type'    => 'CHAR',
			]
		];

		Helpers::appendMetaQuery( $query, $new_meta_query, 'AND' );
	}
}


function filterSizes( $query ) {
	$lang = Helpers::wpmlGetCurrentLanguage();
	$slug = '-' . $lang;
	if ( $lang === 'pl' ) {
		$slug = '';
	}
	$sizes_to_show = [];
	if ( isset( $_GET[ 'size_s' . $slug ] ) ) {
		$sizes_to_show[] = 's' . $slug;
	}
	if ( isset( $_GET[ 'size_m' . $slug ] ) ) {
		$sizes_to_show[] = 'm' . $slug;
	}
	if ( isset( $_GET[ 'size_l' . $slug ] ) ) {
		$sizes_to_show[] = 'l' . $slug;
	}
	if ( isset( $_GET[ 'size_xl' . $slug ] ) ) {
		$sizes_to_show[] = 'xl' . $slug;
	}

	$new_tax_query = [
		'taxonomy' => 'pa_rozmiar-zestawu',
		'field'    => 'slug',
		'terms'    => $sizes_to_show,
		'operator' => 'IN'
	];

	if ( ! empty( $sizes_to_show ) ) {
		Helpers::appendTaxQuery( $query, $new_tax_query, 'AND' );
	}
}


function am_filter_products( $query ) {

	if ( is_admin() ) {
		return $query;
	}

	if ( ! isset( $query->query_vars['post_type'] ) ) {
		return $query;
	}

	if ( $query->query_vars['post_type'] !== 'product' ) {
		return $query;
	}

	//Every 3 days change sorting from date to custom
	$t        = date( 'd-m-Y' );
	$todayNum = date( "d", strtotime( $t ) );
	$compare  = ( ceil( $todayNum / 6 ) - 1 ) * 6 + 1;
	$diff     = $todayNum - $compare;

	if ($diff < 3) {
		$query->query_vars['orderby'] = 'date';
		$query->query_vars['order'] = 'DESC';
	}


	//as default order by newest

	if ( Woocommerce::shopFiltersSet() ) {
		filterPrice( $query );
		filterNew( $query );
		filterRecommended( $query );
		filterSizes( $query );
	}


	return $query;

}