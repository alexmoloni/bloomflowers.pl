<?php
/**
 * Created by PhpStorm.
 * User: Aleksander
 * Date: 27-Jul-19
 * Time: 17:04
 */

namespace alexito;


class Pages {

	public static function getContactPageSlug() {
		return 'kontakt';
	}

	public static function getContactPageUrl() {
		return get_home_url() . '/' . self::getContactPageSlug();
	}

	public static function getCartPageSlug() {
		return 'koszyk';
	}

	public static function getCartPageUrl() {
		return get_home_url() . '/' . self::getCartPageSlug();
	}

	public static function getCheckoutPageSlug() {
		return 'zamowienie';
	}

	public static function getCheckoutPageUrl() {
		return get_home_url() . '/' . self::getCheckoutPageSlug();
	}


	public static function getLoginPageSlug() {
		return 'log-in';
	}

	public static function getLoginPageUrl() {
		return get_home_url() . '/' . self::getLoginPageSlug();
	}


	public static function getShopTermsUrl() {
		return ACF::getShopTermsPDFUrl();
	}

	public static function getPrivacyPolicyUrl() {
		return ACF::getPrivacyPolicyPDFUrl();
	}




}