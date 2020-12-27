import helpers from "../helpers";

const $ = jQuery.noConflict();

function amProductGallery() {
    $('.product-gallery-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: false,
        dots: false,
        asNavFor: '.product-gallery-slider-nav'
    });
    $('.product-gallery-slider-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 5,
        asNavFor: '.product-gallery-slider',
        dots: false,
        arrows: false,
        focusOnSelect: true,
        vertical: !helpers.isMobile()
    });
}

export default function () {
    amProductGallery();
}