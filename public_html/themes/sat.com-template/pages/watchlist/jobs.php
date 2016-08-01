<?php layout('recruiter-profile'); ?>

<div class="col-xs-3">
  <?php partial('navs/nav-recruiter-watchlist'); ?>
</div>

<div class="col-xs-9">
  <div class="box-gray-light cards">
    <?php
    foreach ($jobs as $job) {
      partial('job/card-lg-6', ['job'=>$job, 'user'=>$job->user]);
    }
    ?>
  </div>
</div>
