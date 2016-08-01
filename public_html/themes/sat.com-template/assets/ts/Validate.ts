declare var $,grecaptcha;

class Validate {
  static $mod;

  static init() {
    Validate.$mod = $('[data-module="validate"]');
    if ( ! Validate.$mod.length) return;

    var func = Validate.$mod.data('validate');
    if (typeof Validate[func] !== undefined)
      Validate[func].call();
  }

  static signup() {
    Validate.$mod.on('submit', function(event){
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
  }

  static basic_detail() {
    Validate.$mod.on('submit', function(event){
      event.preventDefault();
      var $form = $(this);
      var errors = {};
      $form.find('.help-block').remove();
      var username = $form.find('[name="username"]').val();
      $.post('/page/validUsername', {'username':username}, function(data){
        if (!data) {
          errors['username'] = 'Already exist';
        }
        $form.find('input').each(function(){
          if ($(this).attr('name') == 'hear') return;
          if (!$(this).val()) {
            errors[$(this).attr('name')] = 'Required';
          }
        });
        if(!grecaptcha.getResponse()) {
          errors['recaptcha'] = 'required';
        }
        if (errors['username']) {
          $form.find('[name="username"]').after('<span class="help-block" style="color:#a94442">*Please choose different username</span>');
        }
        if(Object.keys(errors).length > 0) {
          for (let name in errors) {
            $form.find(`[name="${name}"]`).after('<span class="help-block" style="color:#a94442">*Required</span>');
          }
        } else {
          $form.off('submit').submit();
        }
      });
    });
  }
}

export = Validate;
