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
        $('th').click(this.enableOrder);
    };


    // =========================================================================
    // Functionality
    // =========================================================================

    s.enableOrder = function () {
        if(!$(this).hasClass('no-sorter')){
            var table = $(this).parents('table').eq(0);
            var rows = table.find('tr:gt(0)').toArray().sort(s.comparer($(this).index()));
            this.asc = !this.asc;
            if (!this.asc) {
                table.find('th').find('i').removeClass('sort-icon-desc sort-icon-asc');
                $(this).find('i').addClass('sort-icon-desc');
                rows = rows.reverse();
            }else{
                table.find('th').find('i').removeClass('sort-icon-desc sort-icon-asc');
                $(this).find('i').addClass('sort-icon-asc');
            }
            for (var i = 0; i < rows.length; i++) {
                table.append(rows[i]);
            }
        }
    };

    s.comparer = function (index) {
        return function(a, b) {
            var valA = s.getCellValue(a, index),
                valB = s.getCellValue(b, index);
            return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB);
        }
    };

    s.getCellValue = function (row, index){
        return $(row).children('td').eq(index).html();
    };

    window.order = window.order || {};
    window.order.App = new App;
}(jQuery)); // pass in (jQuery):

