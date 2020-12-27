const $ = jQuery.noConflict();


export default {
    mobile_breakpoint: 800,
    xs_breakpoint: 500,
    mobileMenuBreakpoint: 800,
    headerAndAdminBarOffsetTop: function () {
        return this.headerHeight() + this.adminBarHeight();
    },
    headerHeight: function () {
        return $('.main-header').length ? $('.main-header').outerHeight() : 0;
    },
    adminBarHeight: function () {
        return $("#wpadminbar").length ? $("#wpadminbar").outerHeight() : 0;
    }
}

