import constants from "./constants";

const isMobile = () => {
    return window.matchMedia(`(max-width:${constants.mobile_breakpoint}px)`).matches
};

const isStaging = () => {
    if ( window.location.href.indexOf("bluesbrothers.co") > -1 ) {
        return true;
    }
};

const isMinWidth = (width) => {
    return window.matchMedia(`(min-width:${width}px)`).matches
};

const isMaxWidth = (width) => {
    return window.matchMedia(`(max-width:${width}px)`).matches
};

const isMobileMenu = () => {
    return window.matchMedia(`(max-width:${constants.mobileMenuBreakpoint}px)`).matches
};

const isCheckoutPage = () => {
    return document.body.matches('.woocommerce-checkout');
};

const getCurrentHour = () => {
    const date = new Date();
    let currentHours = date.getHours();
    return parseInt(("0" + currentHours).slice(-2));
};

const compareDaysInDates = (d1, d2) => {
    return d1.getFullYear() === d2.getFullYear()
        && d1.getDate() === d2.getDate()
        && d1.getMonth() === d2.getMonth();
};

function formatDateLong(dateObj) {
    let month = dateObj.getMonth() + 1;
    let day = String(dateObj.getDate()).padStart(2, '0');
    let year = dateObj.getFullYear();
    return `day: ${day} / month: ${month} / year: ${year}`;
}

function formatDateShort(dateObj) {
    let month = String(dateObj.getMonth() + 1).padStart(2, '0');
    let day = String(dateObj.getDate()).padStart(2, '0');
    let year = dateObj.getFullYear();
    return `${year}-${month}-${day}`;
}


const sanitizeHtml = (string) => {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#x27;',
        "/": '&#x2F;',
    };
    const reg = /[&<>"'/]/ig;
    return string.replace(reg, (match) => (map[ match ]));
}

const isSingleProductPage = () => {
    return document.body.matches('.single-product');
};

export default {
    isMobile,
    isStaging,
    isMinWidth,
    isMaxWidth,
    isMobileMenu,
    sanitizeHtml,
    isSingleProductPage,
    getCurrentHour,
    compareDaysInDates,
    formatDateLong,
    formatDateShort,
    isCheckoutPage
}