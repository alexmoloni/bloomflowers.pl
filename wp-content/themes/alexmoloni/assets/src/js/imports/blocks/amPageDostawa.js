const $ = jQuery.noConflict();

function initTabs() {
    $("#tabs").tabs();
}


export default function () {
    if ( !document.body.matches('.page-template-page_dostawa') ) {
        return;
    }
    initTabs();
}