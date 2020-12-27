<?php


namespace alexito;

class Woocommerce {

	public static function getCartCount() {
		global $woocommerce;

		return $woocommerce->cart->cart_contents_count;
	}

	public static function getTermIdForNoCategoryTerm() {
		return 16;
	}

	public static function getFormattedPrice( $product ) {
		return wc_price( $product->get_price() );
	}

	public static function getStrefa2ShippingZoneId() {
		return 3;
	}

	public static function getAllProductCategoryTerms() {
		return get_terms( [
			'taxonomy'   => 'product_cat',
			'hide_empty' => false,
			'exclude'    => '16'
		] );
	}

	public static function getCurrentlySelectedShippingZoneOnCheckout() {
		$chosen_methods = WC()->session->get( 'chosen_shipping_methods' ); // The chosen shipping mehod
		$chosen_method  = explode( ':', reset( $chosen_methods ) );

		return \WC_Shipping_Zones::get_zone_by( 'instance_id', $chosen_method[1] );
	}

	/**
	 * @param $prod_id
	 *
	 * @return \WC_Product_Variation[] | [];
	 */
	public static function getProductVariationsForSizes( $prod_id ) {
		return self::getProductVariationsObjectsForGivenAttribute( 'pa_rozmiar-zestawu', $prod_id );

	}

	/**
	 * @param $prod_id
	 *
	 * @return \WC_Product_Variation[] | [];
	 */
	public static function getProductVariationsForPieces( $prod_id ) {
		return self::getProductVariationsObjectsForGivenAttribute( 'pa_pieces', $prod_id );
	}

	/**
	 * @param $product
	 *
	 * @return \WC_Product_Variation[] | []
	 */
	public static function getVariableProductAvailableVariations( $product ) {
		if ( ! self::isVariableProduct( $product ) ) {
			return [];
		}
		$product          = new \WC_Product_Variable( $product );
		$variations_assoc = $product->get_available_variations();
		$variations       = [];
		foreach ( $variations_assoc as $variation ) {
			$variations[] = new \WC_Product_Variation( $variation['variation_id'] );
		}

		return $variations;
	}

	public static function getProductVariationsObjectsForGivenAttribute( $attribute, $prod_id ) {
		$has_attribute = self::checkProductHasAttribute( $attribute, $prod_id );
		$variations    = [];
		if ( $has_attribute ) {
			$product          = new \WC_Product_Variable( $prod_id );
			$variations_assoc = $product->get_available_variations();
			foreach ( $variations_assoc as $variation ) {
				$variations[] = new \WC_Product_Variation( $variation['variation_id'] );
			}
		}

		return $variations;
	}

	/**
	 * @param $prod_id
	 *
	 * @return \WP_Term[]|false|\WP_Error
	 */
	public static function getCategoriesForProduct( $prod_id ) {
		$terms = get_the_terms( $prod_id, 'product_cat' );

		return array_filter( $terms, function ( $term ) {
			return $term->term_id !== self::getTermIdForNoCategoryTerm();
		} );
	}

	public static function getRecentlyViewedProducts() {
		if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) {
			$viewed_products = [];
		} else {
			$viewed_products = wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) );
		}

		return $viewed_products;
	}

	public static function getLinkCategoriesForProduct( $prod_id ) {
		return get_the_term_list( $prod_id, 'product_cat' );
	}

	public static function productHasSizesAttribute( $prod_id ) {
		return self::checkProductHasAttribute( 'pa_rozmiar-zestawu', $prod_id );
	}

	public static function isVariableProduct( $product ) {
		return $product->is_type( 'variable' );
	}

	public static function checkProductHasAttribute( $attr_name, $prod_id ) {
		$product = wc_get_product( $prod_id );
		if ( $product->is_type( 'variable' ) ) {
			if ( ! empty( $product->get_attribute( $attr_name ) ) ) {
				return true;
			}
		}

		return false;
	}

	public static function productHasPiecesAttribute( $prod_id ) {
		return self::checkProductHasAttribute( 'pa_pieces', $prod_id );
	}

	public static function isProductNew( $prod_id ) {
		$product      = wc_get_product( $prod_id );
		$date_created = $product->get_date_created();
		$ts           = $date_created->getTimestamp();

		return ( $ts < strtotime( '+1 month' ) );
	}

	public static function isProductRecommended( $prod_id ) {
		return get_field( 'recommended', $prod_id );
	}

	public static function isProductHit( $prod_id ) {
		return get_field( 'hit', $prod_id );
	}

	public static function getProductCategoryThumbnail( $term_id, $size = 'thumbnail' ) {
		$thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
		if ( wp_get_attachment_image_src( $thumbnail_id, $size ) ) {
			return [
				'url' => wp_get_attachment_image_src( $thumbnail_id, $size )[0],
				'alt' => get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true )
			];
		} else {
			return [
				'url' => self::getPlaceholderImage( $size ),
				'alt' => ''
			];
		}

	}

	public static function getCartTotal(  ) {
		return WC()->cart->get_cart_total();
	}

	public static function getCartItems(  ) {
		global $woocommerce;
		return $woocommerce->cart->get_cart();
	}

	public static function getPlaceholderImage( $size = 'thumbnail' ) {
		return wc_placeholder_img_src( $size );
	}

	public static function getMinMaxPriceInAllProducts( $type = 'max' ) {
		global $wpdb;
		$sql = "SELECT pm.meta_value from wp_postmeta as pm where pm.meta_key = '_price'";

		$results = $wpdb->get_col( $sql );

		sort( $results, SORT_NUMERIC );

		if ( $type === 'max' ) {
			return end( $results );
		}

		return current( $results );
	}

	public static function shopFiltersSet() {
		return isset( $_GET['filters_on'] );
	}
}