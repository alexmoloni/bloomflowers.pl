<?php

add_action( 'pre_get_posts', 'categoriesPagination' );

function categoriesPagination( $query ) {
	if ( $query->is_main_query() && ! is_admin() ) {
		if ( $query->is_tax('product_cat') ) {
			$paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
			$query->set( 'posts_per_page', 16 );
			$query->set( 'page', $paged );

		}
	}
}