declare var $;

class Fix {
  static $mod = null;

  static init() {
    Fix.$mod = $('[data-module="fix"]');
    if ( ! Fix.$mod.length) return;
    var func = Fix.$mod.data('fix');
    Fix[func].call();
  }

  static link() {
    $('[data-fix="link"] .dropdown a').click(function(){
      location.href = $(this).attr('href');
    });
  }
}

export = Fix;
