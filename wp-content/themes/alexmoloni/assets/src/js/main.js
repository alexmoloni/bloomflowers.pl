import pageONas from "./imports/pageONas";

const $ = jQuery.noConflict();
import widgets from './imports/widgets';
import views from './imports/views';
import vendors from "./imports/vendors";
import popups from "./imports/popups";
import animations from "./imports/animations";
import scrolling from "./imports/scrolling";
import blocks from './imports/blocks/index';
import ui from "./imports/ui";
import shop from "./imports/shop/main";



//DOM Content Loaded
$(document).ready(function () {
    views();
    widgets();
    blocks();
    vendors();
    popups.init();
    animations();
    scrolling.init();
    ui();
    shop();
    pageONas();
});
