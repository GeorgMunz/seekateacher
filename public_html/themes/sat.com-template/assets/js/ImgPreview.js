"use strict";
var ImgPreview = (function () {
    function ImgPreview() {
    }
    ImgPreview.init = function () {
        ImgPreview.$mod = $('[data-module="ImgPreview"]');
        if (!ImgPreview.$mod.length)
            return;
        ImgPreview.checkMaxFiles();
        ImgPreview.$mod.on('click', '[data-ImgPreview-remove]', ImgPreview.remove);
        ImgPreview.$mod.find('[data-ImgPreview-add]').on('click', ImgPreview.add);
    };
    ImgPreview.remove = function (event) {
        $(event.target).parents('[data-ImgPreview-thumb]').remove();
        ImgPreview.checkMaxFiles();
    };
    ImgPreview.add = function () {
        var $el = $($('#ImgPreviewTemplate').html());
        $el.find('input').click();
        $el.find('input').on('change', function () {
            var file = this.files[0];
            ImgPreview.createImgFromFile(file, function (img) {
                $el.find('.thumb').css('background-image', 'url(' + img.src + ')');
                $el.find('input').attr('name', 'pic-' + Math.random());
                ImgPreview.$mod.find('[data-ImgPreview-add]').before($el);
                ImgPreview.checkMaxFiles();
            });
        });
    };
    ImgPreview.checkMaxFiles = function () {
        var count = ImgPreview.$mod.find('[data-ImgPreview-thumb]').length;
        if (count >= 3) {
            ImgPreview.$mod.find('[data-ImgPreview-add]').addClass('hide');
        }
        else {
            ImgPreview.$mod.find('[data-ImgPreview-add]').removeClass('hide');
        }
    };
    ImgPreview.$mod = null;
    ImgPreview.createImgFromFile = function (file, callback) {
        var url = URL.createObjectURL(file);
        var img = new Image;
        img.onload = function () {
            callback(img);
        };
        img.src = url;
    };
    return ImgPreview;
}());
module.exports = ImgPreview;
