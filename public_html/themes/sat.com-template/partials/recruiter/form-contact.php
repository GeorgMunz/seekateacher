<p>The contact details requested below are the details of the staff member posting
 advertisements on this website, usually the Office Manager, Headteacher's PA or Bursar</p>


<?= form_open('/user/profile-post', 'class="form-strip"') ?>
<div class="form-group">
  <label  class="col-xs-3 control-label">Full name</label>
  <div class="col-xs-9">
    <?= form_input('name', $user->name, 'class="form-control"  placeholder="First name and surname"') ?>
  </div>
</div>

<div class="form-group">
  <label  class="col-xs-3 control-label">Job title </label>
  <div class="col-xs-9">
    <?= form_input('job_title', $user->job_title, 'class="form-control"  placeholder="Your position (e.g. Bursar)"') ?>
  </div>
</div>

<div class="form-group">
  <label  class="col-xs-3 control-label">Username</label>
  <div class="col-xs-9">
    <?= form_input('username', $user->username, 'disabled class="form-control"') ?>
  </div>
</div>


<div class="form-group">
  <label  class="col-xs-3 control-label">Email address  </label>
  <div class="col-xs-9">
     <?= form_email('email', $user->email, 'class="form-control"') ?>
  </div>
</div>

<div class="form-group">
  <label  class="col-xs-3 control-label">Password</label>
  <div class="col-xs-9">
    <?= form_password('password', '', 'class="form-control" placeholder="*****"') ?>
  </div>
</div>

<div class="form-group">
  <label  class="col-xs-3 control-label">Recruitement Email</label>
  <div class="col-xs-9">
    <?= form_email('rec_email', $user->rec_email, 'class="form-control"') ?>
  </div>
</div>
<p >This email will be the one that potential applicants respond to.
 Change it if you want it be different from your own personal email.</p>
<div class="text-center">
  <button class="btn btn-pink xs" type="submit">Save</button>
</div>
</form>
