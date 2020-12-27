const $ = jQuery.noConflict();
const langSwitcher = document.querySelector('.am-language-switcher');

function languagesDropdownWPML() {
    var toggle = $('.language-switcher .dropdown-toggle');

    toggle.click(function (event) {

        event.stopPropagation();
        event.preventDefault();
        var dropdown = $(this).closest('.dropdown');

        //when closing
        if ( dropdown.is('.open') ) {
            dropdown.removeClass('open');
            $(this).attr('aria-expanded', 'false');
        }
        //when opening menu
        else {
            dropdown.addClass('open');
            $(this).attr('aria-expanded', 'true');
        }

    })
}


export default function () {
    if ( langSwitcher && langSwitcher.matches('.am-language-switcher-wpml.as-dropdown') ) {
        languagesDropdownWPML();
    }
}