(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
"use strict";
var ActionBtn = (function () {
    function ActionBtn() {
    }
    ActionBtn.init = function () {
        ActionBtn.$mod = $('[data-module="action-btn"]');
        if (!ActionBtn.$mod.length)
            return;
        ActionBtn.$mod.click(function (event) {
            var $btn = $(this);
            var btnData = $btn.data('action-btn');
            $.post(btnData.url, btnData, function (response) {
                $btn.removeClass(btnData['class-' + btnData.status]);
                btnData.status = (btnData.status == 0) ? 1 : 0;
                $btn.addClass(btnData['class-' + btnData.status]);
                $btn.html(btnData['text-' + btnData.status]);
                $btn.data('action-btn', btnData);
                if (btnData.msg !== undefined) {
                }
                else {
                }
            });
        });
    };
    ActionBtn.post = function (url, data, beforeSend) {
        if (beforeSend === void 0) { beforeSend = null; }
        return new Promise(function (resolve, reject) {
            $.ajax({
                xhr: function () {
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function (event) {
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
    };
    ActionBtn.$mod = null;
    return ActionBtn;
}());
module.exports = ActionBtn;

},{}],2:[function(require,module,exports){
"use strict";
var Animate = (function () {
    function Animate() {
    }
    Animate.init = function () {
        Animate.$mod = $('[data-module="Animate"]');
        if (!Animate.$mod.length)
            return;
        var func = Animate.$mod.attr('data-Animate');
        if (typeof Animate[func] === 'function') {
            Animate[func].call();
        }
        else {
            console.log('Animate Function doesnot exist');
        }
    };
    Animate.hover = function () {
        Animate.$mod.each(function () {
            var $that = $(this);
            var $p = $that.find('[data-Animate-p]');
            var pHeight = '271px';
            var $c = $that.find('[data-Animate-c]');
            $c.css({ top: pHeight });
            $p.hover(function () {
                $c.css({ top: 0 });
                $c.addClass('animated fadeInUp');
                $c.removeClass('fadeOutDown');
            }, function () {
                $c.removeClass('fadeInUp');
                $c.addClass('animated fadeOutDown');
            });
        });
    };
    Animate.$mod = null;
    return Animate;
}());
module.exports = Animate;

},{}],3:[function(require,module,exports){
"use strict";
var Comment = (function () {
    function Comment() {
    }
    Comment.init = function () {
        Comment.$mod = $('[data-module="Comment"][data-action="initComment"]');
        if (Comment.$mod.length)
            Comment.$mod.find('form').on('submit', Comment.postComment);
    };
    Comment.postComment = function (event) {
        event.preventDefault();
        var $form = $(event.target);
        $.post($form.attr('action'), $form.serialize(), function (data) {
            $('[data-module-comment="target"]').append(data);
            $form.find('[name="comment"]').val(' ');
        });
    };
    Comment.$mod = null;
    return Comment;
}());
;
module.exports = Comment;

},{}],4:[function(require,module,exports){
"use strict";
var Fix = (function () {
    function Fix() {
    }
    Fix.init = function () {
        Fix.$mod = $('[data-module="fix"]');
        if (!Fix.$mod.length)
            return;
        var func = Fix.$mod.data('fix');
        Fix[func].call();
    };
    Fix.link = function () {
        $('[data-fix="link"] .dropdown a').click(function () {
            location.href = $(this).attr('href');
        });
    };
    Fix.$mod = null;
    return Fix;
}());
module.exports = Fix;

},{}],5:[function(require,module,exports){
"use strict";
var Form = (function () {
    function Form() {
    }
    Form.init = function () {
        Form.$mod = $('[data-module="form"]');
        Form.$mod.find('form').each(function () {
            var $form = $(this);
            $form.on('submit', Form.submit);
        });
    };
    Form.submit = function (event) {
        event.preventDefault();
        return Form.post(event.target.action, new FormData(event.target));
    };
    Form.post = function (url, data, beforeSend) {
        if (beforeSend === void 0) { beforeSend = null; }
        return new Promise(function (resolve, reject) {
            $.ajax({
                xhr: function () {
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function (event) {
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
    };
    return Form;
}());
module.exports = Form;

},{}],6:[function(require,module,exports){
"use strict";
var uri = require('./URI');
var Fsp = (function () {
    function Fsp() {
    }
    Fsp.init = function () {
        Fsp.$mod = $('[data-module="Fsp"]');
        if (!Fsp.$mod.length)
            return;
        Fsp.$mod.each(function (idx) {
            $(this).find('[data-fsp-do]').on('click', function () {
                Fsp.do(idx);
            });
            $(this).find('[data-fsp-on="change"]').on('change', function () {
                Fsp.do(idx);
            });
            $(this).find('[data-fsp-on="enter"]').on('keypress', function (event) {
                var keyCode = (event.keyCode ? event.keyCode : event.which);
                if (keyCode == 13)
                    Fsp.do(idx);
            });
        });
    };
    Fsp.get = function (idx) {
        var $binds = Fsp.$mod.eq(idx).find('[data-fsp-key]');
        var dict = {};
        $binds.each(function () {
            var key = $(this).data('fsp-key'), val = $(this).val();
            if (val && val !== '_clear')
                dict[key] = Fsp.enc(val);
        });
        return dict;
    };
    Fsp.do = function (idx) {
        var base = Fsp.$mod.eq(idx).data('fsp-base-url');
        location.href = location.origin + base + '/' + uri.assocToUri(Fsp.get(idx));
    };
    Fsp.enc = function (str) {
        return encodeURIComponent(str);
    };
    Fsp.$mod = null;
    return Fsp;
}());
module.exports = Fsp;

},{"./URI":12}],7:[function(require,module,exports){
"use strict";
var ImgPreview = (function () {
    function ImgPreview() {
    }
    ImgPreview.init = function () {
        ImgPreview.$mod = $('[data-module="ImgPreview"]');
        if (!ImgPreview.$mod.length)
            return;
        ImgPreview.checkMaxFiles();
        ImgPreview.$mod.on('click', '[data-ImgPreview-remove]', ImgPreview.remove);
        ImgPreview.$mod.find('[data-ImgPreview-add]').on('click', ImgPreview.add);
    };
    ImgPreview.remove = function (event) {
        $(event.target).parents('[data-ImgPreview-thumb]').remove();
        ImgPreview.checkMaxFiles();
    };
    ImgPreview.add = function () {
        var $el = $($('#ImgPreviewTemplate').html());
        $el.find('input').click();
        $el.find('input').on('change', function () {
            var file = this.files[0];
            ImgPreview.createImgFromFile(file, function (img) {
                $el.find('.thumb').css('background-image', 'url(' + img.src + ')');
                $el.find('input').attr('name', 'pic-' + Math.random());
                ImgPreview.$mod.find('[data-ImgPreview-add]').before($el);
                ImgPreview.checkMaxFiles();
            });
        });
    };
    ImgPreview.checkMaxFiles = function () {
        var count = ImgPreview.$mod.find('[data-ImgPreview-thumb]').length;
        if (count >= 3) {
            ImgPreview.$mod.find('[data-ImgPreview-add]').addClass('hide');
        }
        else {
            ImgPreview.$mod.find('[data-ImgPreview-add]').removeClass('hide');
        }
    };
    ImgPreview.$mod = null;
    ImgPreview.createImgFromFile = function (file, callback) {
        var url = URL.createObjectURL(file);
        var img = new Image;
        img.onload = function () {
            callback(img);
        };
        img.src = url;
    };
    return ImgPreview;
}());
module.exports = ImgPreview;

},{}],8:[function(require,module,exports){
"use strict";
var Message = (function () {
    function Message() {
    }
    Message.init = function () {
        Message.$mod = $('[data-module="message"]');
        if (!Message.$mod.length)
            return;
        $('[data-message-select]').click(function () {
            $('[data-message-id]').click();
        });
        $('[data-message-delete]').click(function () {
            var ids = [];
            $('[data-message-id]:checked').each(function () {
                ids.push($(this).val());
            });
            $.post(Message.$mod.data('message-url'), { 'data': ids }, function () {
                location.href = location.href;
            });
        });
        return false;
    };
    Message.$mod = null;
    return Message;
}());
module.exports = Message;

},{}],9:[function(require,module,exports){
"use strict";
var Plugin = (function () {
    function Plugin() {
    }
    Plugin.init = function () {
        if ($('[data-plugin="bootstrap-switch"]').length) {
            $('[data-plugin="bootstrap-switch"]').bootstrapSwitch();
        }
        if ($('[data-plugin="tinymce"]').length) {
            tinymce.init({
                selector: '[data-plugin="tinymce"]',
                menubar: false
            });
        }
        if ($('[data-plugin="datetimepicker"]').length) {
            $('[data-plugin="datetimepicker"]').each(function () {
                var init = {};
                if ($(this).is('[data-date]')) {
                    init.format = 'YYYY-MM-DD';
                }
                else if ($(this).is('[data-time]')) {
                    init.format = 'HH:mm:ss';
                }
                else {
                    init.format = 'YYYY-MM-DD HH:mm:ss';
                }
                $(this).datetimepicker(init);
            });
        }
        if ($('[data-plugin="select2"]').length) {
            $('[data-plugin="select2"]').each(function () {
                var placeholder = $(this).attr('placeholder') ? $(this).attr('placeholder') : 'Please Choose';
                $(this).select2({
                    placeholder: placeholder
                });
            });
        }
        if ($('[data-plugin="form-validate"]').length) {
            $('[data-plugin="form-validate"]').each(function () {
                var $form = $(this);
                var modules = $form.data('modules');
                if (modules) {
                    $.formUtils.loadModules(modules);
                }
                $form.on('submit', function (event) {
                    if (!$form.isValid()) {
                        event.preventDefault();
                    }
                });
            });
        }
        if ($('[data-plugin="slick"]').length) {
            $('[data-plugin="slick"]').slick();
        }
        $(document).delegate('*[data-toggle="lightbox"]', 'click', function (event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    };
    return Plugin;
}());
module.exports = Plugin;

},{}],10:[function(require,module,exports){
"use strict";
var Show = (function () {
    function Show() {
    }
    Show.init = function () {
        Show.$mod = $('[data-module="Show"]');
        if (!Show.$mod.length)
            return;
        Show.$mod.each(function () {
            var $that = $(this);
            var split = $that.attr('data-Show-on').split(':');
            var on = split[0];
            var target = split[1];
            $(target).on(on, function (event) {
                $that.removeClass('hide');
                $that.addClass('animated bounceIn');
            });
        });
    };
    Show.$mod = null;
    return Show;
}());
module.exports = Show;

},{}],11:[function(require,module,exports){
"use strict";
var fsp = require('./Fsp');
var Typeahead = (function () {
    function Typeahead() {
    }
    Typeahead.init = function () {
        Typeahead.$mod = $('[data-module="typeahead"]');
        if (!Typeahead.$mod.length)
            return;
        Typeahead.$mod.each(function () {
            var data = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: $(this).data('typeahead-prefetch')
            });
            $(this).typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                name: 'data',
                source: data
            });
        });
        Typeahead.$mod.on('typeahead:selected', function (e, datum) {
            var idx = Typeahead.$mod.parents('[data-module="fsp"]').index('[data-module="fsp"]');
            fsp.do(idx);
        });
    };
    Typeahead.$mod = null;
    return Typeahead;
}());
module.exports = Typeahead;

},{"./Fsp":6}],12:[function(require,module,exports){
"use strict";
var URI = (function () {
    function URI() {
        var segments = location.pathname.split('/');
        segments.shift();
        this.segments = segments;
    }
    URI.prototype.assocToUri = function (assoc) {
        var arr = [];
        Object.keys(assoc).forEach(function (key) {
            arr.push(key);
            arr.push(assoc[key]);
        });
        return arr.join('/');
    };
    return URI;
}());
;
var uri = new URI();
module.exports = uri;

},{}],13:[function(require,module,exports){
"use strict";
var Validate = (function () {
    function Validate() {
    }
    Validate.init = function () {
        Validate.$mod = $('[data-module="validate"]');
        if (!Validate.$mod.length)
            return;
        var func = Validate.$mod.data('validate');
        if (typeof Validate[func] !== undefined)
            Validate[func].call();
    };
    Validate.signup = function () {
        Validate.$mod.on('submit', function (event) {
            var $type = $(this).find('[name="signup_as"]');
            var $rec_type = $(this).find('[name="rec_type"]');
            if ($type.filter(':checked').val() === undefined) {
                console.log('Choose Type');
                event.preventDefault();
            }
            if ($type.filter(':checked').val() == 'rec' &&
                $rec_type.filter(':checked').val() === undefined) {
                console.log('Choose Rec Type');
                event.preventDefault();
            }
        });
    };
    Validate.basic_detail = function () {
        Validate.$mod.on('submit', function (event) {
            event.preventDefault();
            var $form = $(this);
            var errors = {};
            $form.find('.help-block').remove();
            var username = $form.find('[name="username"]').val();
            $.post('/page/validUsername', { 'username': username }, function (data) {
                if (!data) {
                    errors['username'] = 'Already exist';
                }
                $form.find('input').each(function () {
                    if ($(this).attr('name') == 'hear')
                        return;
                    if (!$(this).val()) {
                        errors[$(this).attr('name')] = 'Required';
                    }
                });
                if (!grecaptcha.getResponse()) {
                    errors['recaptcha'] = 'required';
                }
                if (errors['username']) {
                    $form.find('[name="username"]').after('<span class="help-block" style="color:#a94442">*Please choose different username</span>');
                }
                if (Object.keys(errors).length > 0) {
                    for (var name_1 in errors) {
                        $form.find("[name=\"" + name_1 + "\"]").after('<span class="help-block" style="color:#a94442">*Required</span>');
                    }
                }
                else {
                    $form.off('submit').submit();
                }
            });
        });
    };
    return Validate;
}());
module.exports = Validate;

},{}],14:[function(require,module,exports){
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

},{"./Form":5}],15:[function(require,module,exports){
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

},{"./ActionBtn":1,"./Animate":2,"./Comment":3,"./Fix":4,"./Form":5,"./Fsp":6,"./ImgPreview":7,"./Message":8,"./Plugin":9,"./Show":10,"./Typeahead":11,"./Validate":13,"./Wizard":14}]},{},[15]);
