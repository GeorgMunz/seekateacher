"use strict";
var plugin = require('./Plugin');
var fsp = require('./Fsp');
var comment = require('./Comment');
var typeahead = require('./Typeahead');
var imgpreview = require('./ImgPreview');
var message = require('./Message');
var show = require('./Show');
var animate = require('./Animate');
var form = require('./Form');
var wizard = require('./Wizard');
var validate = require('./Validate');
var actionBtn = require('./ActionBtn');
var fix = require('./Fix');
$(function () {
    show.init();
    plugin.init();
    fsp.init();
    typeahead.init();
    comment.init();
    imgpreview.init();
    message.init();
    animate.init();
    form.init();
    wizard.init();
    validate.init();
    actionBtn.init();
    fix.init();
});
