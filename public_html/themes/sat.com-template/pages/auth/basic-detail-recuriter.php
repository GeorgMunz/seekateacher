<?php layout('basic-detail') ?>

<?= form_open(url('f-su-3'), 'class="form form-horizontal form-strip" data-module="validate" data-validate="basic_detail"') ?>
  <?= alert() ?>
  <div class="form-group">
    <label class="col-xs-4 control-label">Profile:</label>
    <div class="col-xs-8">
      <?= form_input('rec_type', $group_name, 'disabled class="form-control bold"') ?>
    </div>
  </div>

  <div class="form-group">
    <label class="col-xs-4 control-label pad-r-0">Organisation name</label>
    <div class="col-xs-8">
      <?= form_input('org_name', '', 'class="form-control"') ?>
    </div>
  </div>

  <div class="form-group">
    <label  class="col-xs-4 control-label pad-r-0">Name</label>
    <div class="col-xs-4">
      <?= form_input('first_name', '', 'class="form-control" placeholder="First Name"') ?>
    </div>
    <div class="col-xs-4 pad-l-0">
      <?= form_input('last_name', '', 'class="form-control" placeholder="First Name"') ?>
    </div>
  </div>

  <div class="form-group">
    <label class="col-xs-4 control-label pad-r-0">Email</label>
    <div class="col-xs-8">
      <?= form_email('email', '', 'class="form-control" placeholder="Email"') ?>
    </div>
  </div>

  <div class="form-group">
    <label class="col-xs-4 control-label">Username</label>
    <div class="col-xs-8">
      <?= form_input('username', '', 'class="form-control" placeholder="For Login"') ?>
    </div>
  </div>

  <div class="form-group">
    <label class="col-xs-4 control-label">Password</label>
    <div class="col-xs-8">
      <?= form_password('password', '', 'class="form-control" placeholder="*****" data-validation="required"') ?>
    </div>
  </div>

  <div class="form-group p-r">
    <?= form_input('hear', '', 'class="form-control text" placeholder="How did you hear about us?"') ?>
  </div>

  <div class="form-group">
    <div class="g-recaptcha" data-sitekey="6LcrNxUTAAAAAAYd-1zqP5BOSx7-d_D7-MQVMl2d"></div>
  </div>


  <div class="row flex-sb-h">
    <p>By clicking on <strong>“Create my Account”</strong> you agree to <a href="/page/terms_conditions"> terms &amp; conditions</a></p>
    <p class="p-r">
      <button class="btn btn-pink" value="submit" type="submit">Create My Account <span class="glyphicon glyphicon-play"></span></button>
    </p>
  </div>

</form>
