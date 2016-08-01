import uri = require('./URI');

declare var $;

class Fsp {
  static $mod = null;

  static init() {
    Fsp.$mod = $('[data-module="Fsp"]');
    if ( ! Fsp.$mod.length) return;

    Fsp.$mod.each(function(idx) {
      // Fsp on btn click
      $(this).find('[data-fsp-do]').on('click', function(){
        Fsp.do(idx);
      });

      // Fsp on change
      $(this).find('[data-fsp-on="change"]').on('change', function(){
        Fsp.do(idx);
      });

      $(this).find('[data-fsp-on="enter"]').on('keypress', function(event){
        var keyCode = (event.keyCode ? event.keyCode : event.which);
        if (keyCode == 13) Fsp.do(idx);
      });
    });
  }

  static get(idx) {
    var $binds = Fsp.$mod.eq(idx).find('[data-fsp-key]');
    var dict:any = {};
    $binds.each(function(){
      var key = $(this).data('fsp-key'),
      val = $(this).val();
      if (val && val !== '_clear')
      dict[key] = Fsp.enc(val);
    })
    return dict;
  }

  static do(idx) {
    var base = Fsp.$mod.eq(idx).data('fsp-base-url');
    location.href = location.origin + base + '/' + uri.assocToUri(Fsp.get(idx));
  }

  static enc(str) {
    // var str = str.replace(/\s/g, '-');
    return encodeURIComponent(str);
  }

}

export = Fsp;
