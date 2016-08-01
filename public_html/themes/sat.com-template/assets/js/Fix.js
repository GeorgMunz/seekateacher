"use strict";
var Fix = (function () {
    function Fix() {
    }
    Fix.init = function () {
        Fix.$mod = $('[data-module="fix"]');
        if (!Fix.$mod.length)
            return;
        var func = Fix.$mod.data('fix');
        Fix[func].call();
    };
    Fix.link = function () {
        $('[data-fix="link"] .dropdown a').click(function () {
            location.href = $(this).attr('href');
        });
    };
    Fix.$mod = null;
    return Fix;
}());
module.exports = Fix;
