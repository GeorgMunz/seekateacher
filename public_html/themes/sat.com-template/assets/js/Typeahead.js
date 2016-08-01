"use strict";
var fsp = require('./Fsp');
var Typeahead = (function () {
    function Typeahead() {
    }
    Typeahead.init = function () {
        Typeahead.$mod = $('[data-module="typeahead"]');
        if (!Typeahead.$mod.length)
            return;
        Typeahead.$mod.each(function () {
            var data = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: $(this).data('typeahead-prefetch')
            });
            $(this).typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                name: 'data',
                source: data
            });
        });
        Typeahead.$mod.on('typeahead:selected', function (e, datum) {
            var idx = Typeahead.$mod.parents('[data-module="fsp"]').index('[data-module="fsp"]');
            fsp.do(idx);
        });
    };
    Typeahead.$mod = null;
    return Typeahead;
}());
module.exports = Typeahead;
