<?php layout('recruiter-profile'); ?>

<div class="col-xs-12">

  <div class="flex-sb-h p-y">
    <h1 class="pink"><?= $job->title ?></h1>
    <div>
      <a href='<?=url('job-manage')?>' class="btn-pink">DONE</a>
    </div>
  </div>

  <h3>You Invited: <?= count($invites) ?> people</h3>

  <div class="box-gray-light">
    <div class="cards-4">
      <?php
      foreach ($teachers as $teacher) {
        partial('teacher/card-sm', ['tch'=>$teacher,'btn_invite'=>true]);
      }
      ?>
    </div>
    <?php partial('paginations/pagination-center') ?>
  </div>

</div>
