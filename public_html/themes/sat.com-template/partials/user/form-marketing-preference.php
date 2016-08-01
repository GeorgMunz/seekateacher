<?= form_open('/user/profile-post', '') ?>
<?= form_hidden('marketing_preferences', 0) ?>
<div class="flex m-b">
  <?= form_checkbox('marketing_preferences', 1, $user->marketing_preferences, 'data-plugin="bootstrap-switch"') ?>
  <span style="margin:5px">I would like to recieve email notifications about jobs</span>
</div>
<p>
  You allow us to occasionally send you information about SAT.<br>
  (We will never pass your details on to any third party for marketing purposes).
</p>
<div class="text-center">
  <button class="btn-pink" type="submit">Save</button>
</div>
<?= form_close() ?>
