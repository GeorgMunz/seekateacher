"use strict";
var Comment = (function () {
    function Comment() {
    }
    Comment.init = function () {
        Comment.$mod = $('[data-module="Comment"][data-action="initComment"]');
        if (Comment.$mod.length)
            Comment.$mod.find('form').on('submit', Comment.postComment);
    };
    Comment.postComment = function (event) {
        event.preventDefault();
        var $form = $(event.target);
        $.post($form.attr('action'), $form.serialize(), function (data) {
            $('[data-module-comment="target"]').append(data);
            $form.find('[name="comment"]').val(' ');
        });
    };
    Comment.$mod = null;
    return Comment;
}());
;
module.exports = Comment;
