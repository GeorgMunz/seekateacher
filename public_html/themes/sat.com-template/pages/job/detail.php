<?php layout(['rec'=>'recruiter-profile-gray','tch'=>'teacher-profile-gray', 'guest'=>'gray-light']) ?>

<main class="col-xs-8">
  <?php partial('job/card-lg-8') ?>
  <div class="box-white">
    <h2 class="m-t-0">Description</h2>
    <?php partial('job/table-1') ?>
    <div class="desc word-break">
      <?= $job->detail ?>
    </div>
    <h2>About the School</h2>
    <div class="m-b-30">
      <?= $user->org_about ?>
    </div>
    <?php partial('job/panel-apply') ?>
  </div>
</main>

<aside class="col-xs-4">
  <?php partial('job/panel-about') ?>
  <?php partial('job/panel-pics') ?>
  <?php partial('job/panel-vid') ?>
</aside>
