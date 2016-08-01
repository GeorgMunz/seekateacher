"use strict";
var fsp = require('./Fsp');
var uri = require('./URI');
var WidgetSearch = (function () {
    function WidgetSearch() {
    }
    WidgetSearch.init = function () {
        if (!$('[data-module="WidgetSearch"]').length)
            return;
        var $btn = $('[data-module="WidgetSearch"] [data-ws-do-search]');
        $btn.on('click', WidgetSearch.do);
        $('[data-module="WidgetSearch"] [data-ws-key]').on('change', function () {
            WidgetSearch.do();
        });
    };
    WidgetSearch.get = function () {
        var $binds = $('[data-module="WidgetSearch"] [data-ws-key]');
        var dict = {};
        $binds.each(function () {
            var key = $(this).data('ws-key'), val = $(this).val();
            if (val && val !== '_clear')
                dict[key] = fsp.enc(val);
        });
        return dict;
    };
    WidgetSearch.do = function () {
        var base = $('[data-module="WidgetSearch"]').data('base-url');
        location.href = location.origin + base + '/' + uri.assocToUri(WidgetSearch.get());
    };
    return WidgetSearch;
}());
module.exports = WidgetSearch;
