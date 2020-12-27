const $ = jQuery.noConflict();

function amSlider() {
    $('.js-am-slider').slick({
        slidesToScroll: 1,
        fade: false,
        arrows: true,
        dots: false,
        autoplay: true
    })
}

export default function () {
    amSlider();
}