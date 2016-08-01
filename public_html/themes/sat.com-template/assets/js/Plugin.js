"use strict";
var Plugin = (function () {
    function Plugin() {
    }
    Plugin.init = function () {
        if ($('[data-plugin="bootstrap-switch"]').length) {
            $('[data-plugin="bootstrap-switch"]').bootstrapSwitch();
        }
        if ($('[data-plugin="tinymce"]').length) {
            tinymce.init({
                selector: '[data-plugin="tinymce"]',
                menubar: false
            });
        }
        if ($('[data-plugin="datetimepicker"]').length) {
            $('[data-plugin="datetimepicker"]').each(function () {
                var init = {};
                if ($(this).is('[data-date]')) {
                    init.format = 'YYYY-MM-DD';
                }
                else if ($(this).is('[data-time]')) {
                    init.format = 'HH:mm:ss';
                }
                else {
                    init.format = 'YYYY-MM-DD HH:mm:ss';
                }
                $(this).datetimepicker(init);
            });
        }
        if ($('[data-plugin="select2"]').length) {
            $('[data-plugin="select2"]').each(function () {
                var placeholder = $(this).attr('placeholder') ? $(this).attr('placeholder') : 'Please Choose';
                $(this).select2({
                    placeholder: placeholder
                });
            });
        }
        if ($('[data-plugin="form-validate"]').length) {
            $('[data-plugin="form-validate"]').each(function () {
                var $form = $(this);
                var modules = $form.data('modules');
                if (modules) {
                    $.formUtils.loadModules(modules);
                }
                $form.on('submit', function (event) {
                    if (!$form.isValid()) {
                        event.preventDefault();
                    }
                });
            });
        }
        if ($('[data-plugin="slick"]').length) {
            $('[data-plugin="slick"]').slick();
        }
        $(document).delegate('*[data-toggle="lightbox"]', 'click', function (event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    };
    return Plugin;
}());
module.exports = Plugin;
