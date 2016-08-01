"use strict";
var ActionBtn = (function () {
    function ActionBtn() {
    }
    ActionBtn.init = function () {
        ActionBtn.$mod = $('[data-module="action-btn"]');
        if (!ActionBtn.$mod.length)
            return;
        ActionBtn.$mod.click(function (event) {
            var $btn = $(this);
            var btnData = $btn.data('action-btn');
            $.post(btnData.url, btnData, function (response) {
                $btn.removeClass(btnData['class-' + btnData.status]);
                btnData.status = (btnData.status == 0) ? 1 : 0;
                $btn.addClass(btnData['class-' + btnData.status]);
                $btn.html(btnData['text-' + btnData.status]);
                $btn.data('action-btn', btnData);
                if (btnData.msg !== undefined) {
                }
                else {
                }
            });
        });
    };
    ActionBtn.post = function (url, data, beforeSend) {
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
    ActionBtn.$mod = null;
    return ActionBtn;
}());
module.exports = ActionBtn;
