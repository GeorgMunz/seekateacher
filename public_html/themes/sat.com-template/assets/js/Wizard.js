"use strict";
var form = require('./Form');
var Wizard = (function () {
    function Wizard() {
    }
    Wizard.init = function () {
        Wizard.$mod = $('[data-module="wizard"]');
        if (!Wizard.$mod.length)
            return;
        Wizard.$mod.find('[data-wizard-panel]:gt(0) [data-toggle="collapse"]').click();
        Wizard.$mod.find('[data-toggle="collapse"]').on('click', function (event) {
            Wizard.$mod.find('.collapse').collapse('hide');
        });
        Wizard.$mod.find('form')
            .on('submit', function (event) {
            form.submit(event)
                .then(function (response) {
                if (response == 'logout') {
                    location.href = location.origin + '/auth/logout';
                    return;
                }
                $('[data-wizard-progress]').html(response);
                $('[data-wizard-progress-style]').css({
                    'width': response + '%'
                });
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
    };
    return Wizard;
}());
module.exports = Wizard;
