<?php layout('recruiter-profile'); ?>

<div class="container">
  <h1>Job Responses for <span class="pink"><?= $job->title ?></span></h1>
  <div>
    <a href="/job/manage" class="link-md">Back to Jobs list</a>
  </div>

  <div class="box-gray-light">
    <div class="cards-4">
      <?php
      foreach ($teachers as $teacher) {
        partial('teacher/card-sm', ['tch'=>$teacher, 'btn_public_profile'=>true]);
      }
      ?>
    </div>
    <?php partial('paginations/pagination-center') ?>
  </div>
</div>
