declare var $;

class Comment {
  static $mod = null;

  static init() {
    Comment.$mod = $('[data-module="Comment"][data-action="initComment"]');
    if (Comment.$mod.length)
      Comment.$mod.find('form').on('submit', Comment.postComment);
  }

  static postComment(event) {
    event.preventDefault();
    var $form = $(event.target);
    $.post($form.attr('action'), $form.serialize(), function(data){
      $('[data-module-comment="target"]').append(data);
      $form.find('[name="comment"]').val(' ');
    });
  }
};

export = Comment;
