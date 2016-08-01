"use strict";
var Message = (function () {
    function Message() {
    }
    Message.init = function () {
        Message.$mod = $('[data-module="message"]');
        if (!Message.$mod.length)
            return;
        $('[data-message-select]').click(function () {
            $('[data-message-id]').click();
        });
        $('[data-message-delete]').click(function () {
            var ids = [];
            $('[data-message-id]:checked').each(function () {
                ids.push($(this).val());
            });
            $.post(Message.$mod.data('message-url'), { 'data': ids }, function () {
                location.href = location.href;
            });
        });
        return false;
    };
    Message.$mod = null;
    return Message;
}());
module.exports = Message;
