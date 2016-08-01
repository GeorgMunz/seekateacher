"use strict";
var URI = (function () {
    function URI() {
        var segments = location.pathname.split('/');
        segments.shift();
        this.segments = segments;
    }
    URI.prototype.assocToUri = function (assoc) {
        var arr = [];
        Object.keys(assoc).forEach(function (key) {
            arr.push(key);
            arr.push(assoc[key]);
        });
        return arr.join('/');
    };
    return URI;
}());
;
var uri = new URI();
module.exports = uri;
