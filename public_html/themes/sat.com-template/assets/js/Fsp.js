"use strict";
var uri = require('./URI');
var Fsp = (function () {
    function Fsp() {
    }
    Fsp.init = function () {
        Fsp.$mod = $('[data-module="Fsp"]');
        if (!Fsp.$mod.length)
            return;
        Fsp.$mod.each(function (idx) {
            $(this).find('[data-fsp-do]').on('click', function () {
                Fsp.do(idx);
            });
            $(this).find('[data-fsp-on="change"]').on('change', function () {
                Fsp.do(idx);
            });
            $(this).find('[data-fsp-on="enter"]').on('keypress', function (event) {
                var keyCode = (event.keyCode ? event.keyCode : event.which);
                if (keyCode == 13)
                    Fsp.do(idx);
            });
        });
    };
    Fsp.get = function (idx) {
        var $binds = Fsp.$mod.eq(idx).find('[data-fsp-key]');
        var dict = {};
        $binds.each(function () {
            var key = $(this).data('fsp-key'), val = $(this).val();
            if (val && val !== '_clear')
                dict[key] = Fsp.enc(val);
        });
        return dict;
    };
    Fsp.do = function (idx) {
        var base = Fsp.$mod.eq(idx).data('fsp-base-url');
        location.href = location.origin + base + '/' + uri.assocToUri(Fsp.get(idx));
    };
    Fsp.enc = function (str) {
        return encodeURIComponent(str);
    };
    Fsp.$mod = null;
    return Fsp;
}());
module.exports = Fsp;
