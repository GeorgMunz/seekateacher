<?php layout('box') ?>

<h1>Forgot password</h1>
<?= alert() ?>
<?= form_open('/auth/forgot-password-post', 'class="form-horizontal" data-plugin="form-validate"') ?>
<div class="form-group">
  <label  class="col-sm-2 control-label pink">Email</label>
  <div class="col-sm-10">
    <?= form_input('email', '', 'class="form-control" data-validation="required"') ?>
  </div>
</div>

<div>
  <button class="btn btn-pink m-y-30" value="submit">Send Reset Link</button>
  <p>
    Don’t have an account yet?
    <a href="<?=url('sign-up')?>">Create new</a> |
    <a href="<?=url('sign-in')?>">Login</a>
  </p>
</div>

</form>
