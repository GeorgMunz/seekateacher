<?php layout('teacher-profile'); ?>

<div class="container-gray mar-t-40">
  <h1 class="mar-t-0">Jobs I have Applied for</h1>
  <?php
  foreach ($jobs as $job) {
    partial('job/card-list', ['job'=>$job, 'rec'=>$rec]);
  }
  partial('paginations/pagination-center')
  ?>
</div>
