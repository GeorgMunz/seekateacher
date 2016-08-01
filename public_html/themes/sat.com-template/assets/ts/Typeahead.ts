import fsp = require('./Fsp');

declare var Bloodhound, $;

class Typeahead {
  static $mod = null;
  static init() {
    Typeahead.$mod = $('[data-module="typeahead"]');
    if ( ! Typeahead.$mod.length) return;

    Typeahead.$mod.each(function(){
      // constructs the suggestion engine
      var data:any = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: $(this).data('typeahead-prefetch')
      });

      $(this).typeahead({
        hint: true,
        highlight: true,
        minLength: 1
      },
      {
        name: 'data',
        source: data
      });
    });


    Typeahead.$mod.on('typeahead:selected', function (e, datum) {
      // Find the index of parent Fsp
      var idx = Typeahead.$mod.parents('[data-module="fsp"]').index('[data-module="fsp"]');
      fsp.do(idx);
    });
  }
}

export = Typeahead;
