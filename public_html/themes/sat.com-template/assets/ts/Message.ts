declare var $;

class Message {

  static $mod = null;

  static init() {
    Message.$mod = $('[data-module="message"]');
    if ( ! Message.$mod.length) return;

    $('[data-message-select]').click(function(){
      $('[data-message-id]').click();
    });

    $('[data-message-delete]').click(function(){
      var ids = [];
      $('[data-message-id]:checked').each(function(){
        ids.push($(this).val());
      });
      $.post(Message.$mod.data('message-url'), {'data':ids}, function(){
        location.href = location.href;
      });
    });
    return false;
    // var target = Message.$mod.attr('data-Message-target');
    // var url = Message.$mod.attr('data-Message-url');
    // Message.$mod.on('click', function() {
    //   var ids = [];
    //   $(target+':checked').each(function(){
    //     ids.push($(this).val());
    //   });
    //   $.post(url, {'data':ids}, function(){
    //     location.href = location.href;
    //   });
    // })
  }

}

export = Message;
