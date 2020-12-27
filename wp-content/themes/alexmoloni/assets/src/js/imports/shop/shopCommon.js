import helpers from "../helpers";

const $ = jQuery.noConflict();
import cart from "./cart";

function handleRemoveCartItem() {

    jQuery(document.body).on('updated_wc_div', function (ev, a) {
        cart.refreshCartDivs();
    });

}

function toggleShopSectionMobile() {
    if ( !helpers.isMobile() ) {
        return;
    }

    $('.js-shop-mobile-toggle').on('click', function () {
        const target = $(this).closest('.mobile-toggle-parent').find('.mobile-toggle-target');
        if ( target.is(':visible') ) {
            target.slideUp();
            $(this).removeClass('target-visible');
        }
        else {
            target.slideDown();
            $(this).addClass('target-visible');
        }
    })
}


export default function () {
    handleRemoveCartItem();
    toggleShopSectionMobile();
}