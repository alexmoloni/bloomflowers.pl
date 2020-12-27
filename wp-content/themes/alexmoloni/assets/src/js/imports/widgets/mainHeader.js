const $ = jQuery.noConflict();
import constants from '../constants';
import helpers from '../helpers';
import {throttle} from "lodash";

const main_header = $('#main-header');
const mainNav = $('#main-navigation');
const mainElem = $('main.main');
const menuItem = mainNav.find('.menu-item a');
const shadow = $('#header-menu-overlay');
const hamburger = $('#header-menu-hamburger');
let headerSpacer = $('#header-spacer');
const topBar = main_header.find('.topbar');

function categoriesSubmenu() {
    const categoriesWrap = document.querySelector('.header-categories');
    const menuItemShop = document.querySelector('li.menu-item-shop');
    menuItemShop.appendChild(categoriesWrap);
    categoriesWrap.style.top = constants.headerAndAdminBarOffsetTop() + 'px';

    menuItemShop.addEventListener('mouseenter' , () => {
        categoriesWrap.style.top = constants.headerAndAdminBarOffsetTop() + 'px';
    });

}

function mobileMenu() {


    hamburger.click(function () {

        //fires when closing menu
        if ( hamburger.is('.is-active') ) {
            closeMenu();
        }
        //fires when opening menu
        else {
            openMenu();
        }
    });


    var hammer = new Hammer(mainNav[ 0 ]);

    hammer.on("swiperight", function (ev) {
        //prevent on firing when in desktop
        if ( !mainNav.is('.is-open') ) {
            return;
        }
        closeMenu();
    });

    shadow.click(function () {

        //fires when closing menu
        if ( shadow.is('.-visible') ) {
            closeMenu();
        }
    });

    $('.js-close-main-navigation').on('click', function (ev) {
        if ( !mainNav.is('.is-open') ) {
            return;
        }
        closeMenu();
    });

    menuItem.click(function () {
        if ( $(this).parent().is('.menu-item-has-children') ) {
            return;
        }
        if ( !mainNav.is('.is-open') ) {
            return;
        }
        closeMenu();
    });

    function init() {
        if ( main_header.is('.mobile-menu-top-0') ) {
            mainNav.css('top', constants.adminBarHeight());
        }
        else {
            mainNav.css('top', constants.headerAndAdminBarOffsetTop());
        }
    }


    function closeMenu() {
        hamburger.removeClass('is-active');
        mainNav.removeClass('is-open');
        mainNav.attr('aria-expanded', 'false');
        mainElem.removeClass('main-menu-open');
        shadow.removeClass('-visible');
    }

    function openMenu() {
        hamburger.addClass('is-active');
        mainNav.addClass('is-open');
        mainNav.attr('aria-expanded', 'true');
        mainElem.addClass('main-menu-open');
        shadow.addClass('-visible');
    }

    init();
}

function stickyMenu() {
    if ( main_header.is('.sticky-on-load') ) {
        stickyOnLoad();
    }
    else if ( main_header.is('.sticky-on-scroll') ) {
        stickyOnScroll()
    }
}


function stickyOnLoad() {

    main_header.addClass('sticky');

    if ( headerSpacer.length === 0 ) {
        $('<div id="header-spacer"></div>').insertBefore(main_header);

    }

    if ( main_header.is('.sticky-on-load-on-content') ) {
        window.addEventListener('scroll', throttle((ev) => {
            if ( window.scrollY > constants.headerAndAdminBarOffsetTop() && !main_header.is('.sticky-on-load-scrolled-down') ) {
                main_header.addClass('sticky-on-load-scrolled-down')
            } else if (window.scrollY < constants.headerAndAdminBarOffsetTop() && main_header.is('.sticky-on-load-scrolled-down') ) {
                main_header.removeClass('sticky-on-load-scrolled-down')
            }
        }, 300));
    }
    else {
        headerSpacer.height(constants.headerHeight());
    }

    //add spacer height

    //dont add top on homepage, since header is not fixed there, but only if on desktop
    if ( $('#wpadminbar').length ) {
        main_header.css('top', $("#wpadminbar").outerHeight());
    }

    if ( main_header.is('.has-topbar.hide-topbar-on-scroll') ) {
        let topbar_visible = true;


        function checkScroll() {
            if ( window.scrollY === 0 ) {
                topBar.slideDown();
                topbar_visible = true;
            }
            else if ( window.scrollY > 0 && topbar_visible ) {
                topBar.slideUp();
                topbar_visible = false;
            }
        }

        //init - the browser maybe already scrolled on init
        checkScroll();

        window.onscroll = checkScroll;
    }


}

function stickyOnScroll() {
    let waypoints = $('#main-header').waypoint({
        handler: function (direction) {
            const header = $(this.element);

            if ( 'down' === direction ) {
                header.addClass('sticky');
                if ( $('#wpadminbar').length ) {
                    header.css('top', $("#wpadminbar").outerHeight());
                }
            }
            else if ( 'up' === direction ) {
                $(this.element).removeClass('sticky');
                if ( $('#wpadminbar').length ) {
                    header.css('top', '');
                }
            }
        },
        offset: function () {
            return -this.element.clientHeight
        }
    })
}

function subMenus() {
    if ( !helpers.isMobileMenu() ) {
        return;
    }

    $('.menu-item-has-children > a').on('click', function (ev) {
        ev.preventDefault();
        const parentLi = $(this).closest('.menu-item');
        if ( parentLi.is('.expanded') ) {
            parentLi.children('.sub-menu').slideUp();
            parentLi.removeClass('expanded')
        }
        else {
            parentLi.children('.sub-menu').slideDown();
            parentLi.addClass('expanded')
        }
    })

}


export default function () {
    mobileMenu();
    stickyMenu();
    subMenus();
    categoriesSubmenu();
}
