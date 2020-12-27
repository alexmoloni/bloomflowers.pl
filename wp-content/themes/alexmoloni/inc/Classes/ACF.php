<?php
/**
 * Created by PhpStorm.
 * User: Aleksander
 * Date: 28-Aug-19
 * Time: 12:24
 */

namespace alexito;


class ACF {

	public static function getLogoImageUrl( $size = 'medium' ) {
		$image_array = get_field( 'logo', 'option' );

		if ( ! $size || empty( $image_array['sizes'][ $size ] ) ) {
			return esc_url( $image_array['url'] );
		}

		return esc_url( $image_array['sizes'][ $size ] );
	}

	public static function getShopTermsPDFUrl() {
		return get_field( 'warunki', 'option' );
	}

	public static function getPrivacyPolicyPDFUrl() {
		return get_field( 'polityka_prywatnosci', 'option' );
	}

}