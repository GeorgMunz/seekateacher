<?php layout('teacher-profile'); ?>

<div class="col-xs-8">
  <?php partial('widgets/widget-listing') ?>

  <h1 class="blue m-t-30">Job Updates</h1>
  <div class="box-gray-light cards">
    <?php
    foreach($jobs as $job) {
      partial('job/card-lg-6', ['job'=>$job, 'user'=>$job->user]);
    }
    partial('paginations/pagination-center')
    ?>
  </div>
</div>

<div class="col-xs-4 mar-t-30">
  <div class="box-gray-light">
    <?php partial('teacher/stats', ['tch'=>$tch]) ?>
    <?php partial('teacher/contacts', ['tch'=>$tch]) ?>
  </div>
</div>
