<?php layout('box') ?>

<h1>Log In</h1>
<?= alert() ?>
<?= form_open(url('f-si'), 'class="form-horizontal" data-plugin="form-validate"') ?>
<div class="form-group">
  <label  class="col-sm-2 control-label pink">Username</label>
  <div class="col-sm-10">
    <?= form_input('username', '', 'class="form-control" data-validation="required"') ?>
  </div>
</div>

<div class="form-group">
  <label  class="col-sm-2 control-label pink">Password</label>
  <div class="col-sm-10">
    <?= form_password('password', '', 'class="form-control" data-validation="required"') ?>
  </div>
</div>

<div>
  <button class="btn btn-pink m-y-30" value="submit">Log In</button>
  <p>
    Don’t have an account yet?
    <a href="<?=url('sign-up')?>">Create new</a> |
    <a href="<?=url('forgot-password')?>">Forgot Password</a>
  </p>
</div>

</form>
