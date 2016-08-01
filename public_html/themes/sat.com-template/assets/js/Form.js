"use strict";
var Form = (function () {
    function Form() {
    }
    Form.init = function () {
        Form.$mod = $('[data-module="form"]');
        Form.$mod.find('form').each(function () {
            var $form = $(this);
            $form.on('submit', Form.submit);
        });
    };
    Form.submit = function (event) {
        event.preventDefault();
        return Form.post(event.target.action, new FormData(event.target));
    };
    Form.post = function (url, data, beforeSend) {
        if (beforeSend === void 0) { beforeSend = null; }
        return new Promise(function (resolve, reject) {
            $.ajax({
                xhr: function () {
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function (event) {
                        if (event.lengthComputable) {
                            var percentComplete = (event.loaded / event.total) * 100;
                            console.log(percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                url: url,
                type: 'POST',
                beforeSend: beforeSend,
                processData: false,
                contentType: false,
                data: data,
                success: resolve,
                error: reject
            });
        });
    };
    return Form;
}());
module.exports = Form;
