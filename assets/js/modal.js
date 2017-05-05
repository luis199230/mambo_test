(function ($) {
    "use strict";

    var App = function() {
        var o = this;
        $(document).ready(function() {
            o.initialize();
        });

    };
    var m = App.prototype;

    m.imgClass = '.show_image';
    m.imgModal = '#imgModal';

    m.initialize = function () {
        this.enableEvents();
    };

    m.enableEvents = function () {
        this.enableModal();
    };

    m.enableModal = function () {
        $(m.imgClass).click(this.showModal);
        $(m.imgModal).find('span').click(this.hideModal);
    };


    // =========================================================================
    // Functionality
    // =========================================================================


    m.showModal = function () {
        $(m.imgModal).show();
        $(m.imgModal).find('.modal-content').prop("src",$(this).prop('src'));
    };
    m.hideModal = function () {
        $(m.imgModal).hide();
    };

    window.modal = window.modal || {};
    window.modal.App = new App;
}(jQuery)); // pass in (jQuery):