import uri = require('./URI');

declare var $;

class Fsp {

  static init() {
    if ( ! $('[data-module="Fsp"]').length) return;
    var binds = $('[data-module="Fsp"]').data('fsp-bind').split(';');
    var base = $('[data-module="Fsp"]').data('fsp-base');
    var urlData:any = (function() {
      var re = new RegExp(base + '\/?(.*)');
      var segs = location.pathname.match(re)[1].split('/');
      var data = {};
      var i = 0;
      while(i < segs.length) {
        if (segs[i] == 'page' || segs[i] == '') {
          break;
        }
        data[segs[i++]] = segs[i++];
      }
      return data;
    })();

    binds.forEach(function (bind) {
      var splits = bind.split(':'),
      onEvent = splits[0],
      selector = splits[1];

      if (onEvent === 'enter') {
        $(selector).on('keypress', function(event){
          var keyCode = (event.keyCode ? event.keyCode : event.which);
          if (keyCode == 13) {
            urlData.search = $(this).val();

            if ( ! urlData.search) delete urlData.search;

            var url = location.origin + base + '/' + uri.assocToUri(urlData);
            location.href = url;
          }
        });
      }
      else {
        $(selector).on(onEvent, function() {
          window.location.href = $(this).val();
        });
      }

    });
  }

  static enc(str) {
    var str = str.replace(/\s/g, '-');
    return encodeURIComponent(str);
  }
};

export = Fsp;
