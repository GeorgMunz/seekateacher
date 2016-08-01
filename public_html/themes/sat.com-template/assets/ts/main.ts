declare var $;

import plugin = require('./Plugin');
import fsp = require('./Fsp');
import comment = require('./Comment');
import typeahead = require('./Typeahead');
import imgpreview = require('./ImgPreview');
import message = require('./Message');
import show = require('./Show');
import animate = require('./Animate');
import form = require('./Form');
import wizard = require('./Wizard');
import validate = require('./Validate');
import actionBtn = require('./ActionBtn');
import fix = require('./Fix');

$(function(){
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
