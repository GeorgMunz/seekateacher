declare var $, Promise;

class Form {
  static $mod;

  static init() {
    Form.$mod = $('[data-module="form"]');

    Form.$mod.find('form').each(function(){
      var $form = $(this);
      $form.on('submit', Form.submit);
    });
  }

  static submit(event) {
    event.preventDefault();
    return Form.post(event.target.action, new FormData(event.target));
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

export = Form;
