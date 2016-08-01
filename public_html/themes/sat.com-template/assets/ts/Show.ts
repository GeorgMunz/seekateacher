declare var $;

class Show {
  static $mod = null;

  static init() {
    Show.$mod = $('[data-module="Show"]');
    if ( ! Show.$mod.length) return;
    Show.$mod.each(function(){
      var $that = $(this);
      var split = $that.attr('data-Show-on').split(':');
      var on = split[0];
      var target = split[1];
      $(target).on(on, function(event){
        $that.removeClass('hide');
        $that.addClass('animated bounceIn');
      });
    });
  }
}

export = Show;
