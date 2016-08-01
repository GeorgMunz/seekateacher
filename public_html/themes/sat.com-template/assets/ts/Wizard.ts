declare var $;

import form = require('./Form');

class Wizard {
  static $mod;

  static init() {
    Wizard.$mod = $('[data-module="wizard"]');
    if ( ! Wizard.$mod.length) return;

    // Open first close others
    Wizard.$mod.find('[data-wizard-panel]:gt(0) [data-toggle="collapse"]').click();

    // on click close all but open clicked
    Wizard.$mod.find('[data-toggle="collapse"]').on('click', function(event) {
      Wizard.$mod.find('.collapse').collapse('hide');
    });

    // Init forms
    Wizard.$mod.find('form')
    .on('submit', function(event){
      form.submit(event)
      .then(function(response) {
        // #SC deactivate
        if (response == 'logout') {
          location.href = location.origin + '/auth/logout';
          return;
        }

        $('[data-wizard-progress]').html(response);

        $('[data-wizard-progress-style]').css({
          'width': response + '%'
        });
        // close present open next
        $(event.target)
        .parents('[data-wizard-panel]')
        .find('[data-toggle="collapse"]')
        .click();

        $(event.target)
        .parents('[data-wizard-panel]')
        .next()
        .find('[data-toggle="collapse"]')
        .click();
      });
    });
  }
}

export = Wizard;
