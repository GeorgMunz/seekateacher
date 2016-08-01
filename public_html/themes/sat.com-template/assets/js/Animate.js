"use strict";
var Animate = (function () {
    function Animate() {
    }
    Animate.init = function () {
        Animate.$mod = $('[data-module="Animate"]');
        if (!Animate.$mod.length)
            return;
        var func = Animate.$mod.attr('data-Animate');
        if (typeof Animate[func] === 'function') {
            Animate[func].call();
        }
        else {
            console.log('Animate Function doesnot exist');
        }
    };
    Animate.hover = function () {
        Animate.$mod.each(function () {
            var $that = $(this);
            var $p = $that.find('[data-Animate-p]');
            var pHeight = '271px';
            var $c = $that.find('[data-Animate-c]');
            $c.css({ top: pHeight });
            $p.hover(function () {
                $c.css({ top: 0 });
                $c.addClass('animated fadeInUp');
                $c.removeClass('fadeOutDown');
            }, function () {
                $c.removeClass('fadeInUp');
                $c.addClass('animated fadeOutDown');
            });
        });
    };
    Animate.$mod = null;
    return Animate;
}());
module.exports = Animate;
