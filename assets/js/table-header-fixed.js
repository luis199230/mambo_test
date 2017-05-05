(function ($) {
    "use strict";

    var App = function() {
        var o = this;
        $(document).ready(function() {
            o.initialize();
        });

    };
    var s = App.prototype;

    s.initialize = function () {
        this.enableEvents();
    };

    s.enableEvents = function () {
        $(window).scroll(this.enableScroll);
    };


    // =========================================================================
    // Functionality
    // =========================================================================

    s.enableScroll = function(){
        var headerTR = $('table').find('tr:first');
        var scroll = $(window).scrollTop();
        if (scroll >= 65) headerTR.addClass('fixed');
        else headerTR.removeClass('fixed');
    };

    window.headerFixed = window.headerFixed || {};
    window.headerFixed.App = new App;
}(jQuery)); // pass in (jQuery):