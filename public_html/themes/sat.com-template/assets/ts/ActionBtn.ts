declare var $, bootbox, Promise;

class ActionBtn {
  static $mod = null;

  static init() {
    ActionBtn.$mod = $('[data-module="action-btn"]');
    if ( ! ActionBtn.$mod.length) return;

    ActionBtn.$mod.click(function(event){
      var $btn = $(this);
      var btnData = $btn.data('action-btn');
      $.post(btnData.url, btnData, function(response){
        // console.log(response);
        // console.log(btnData);
        // update status
        $btn.removeClass(btnData['class-'+btnData.status]);
        btnData.status = (btnData.status == 0) ? 1 : 0;
        $btn.addClass(btnData['class-'+btnData.status]);
        $btn.html(btnData['text-'+btnData.status]);
        $btn.data('action-btn', btnData);
        if (btnData.msg !== undefined) {
          //bootbox.alert(btnData.msg);
        }
        else {
          //bootbox.alert('Success');
        }
      });
    });
  }

  static post(url, data, beforeSend = null) {
    return new Promise(function(resolve, reject){
      $.ajax({
        xhr: function() {
          var xhr = new XMLHttpRequest();
          xhr.upload.addEventListener('progress', function(event:any) {
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
  }
}

export = ActionBtn;
