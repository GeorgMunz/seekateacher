<?php layout('teacher-profile') ?>

<aside class="col-xs-4" style="margin-top:45px;">
  <?php partial('job/sidebar-listing', ['fsp_base_url'=>'/job/applied', 'typeahead_prefetch'=>'/page/jobs/0/1']) ?>
</aside>

<main class="col-xs-8">
    <h1>Jobs Applied By me</h1>
  <div class="box-gray-light cards">
    <?php
    foreach ($jobs as $job) {
      partial('job/card-lg-6', ['job'=>$job, 'user'=>$job->user]);
    }

    partial('paginations/pagination-center');
    ?>
  </div>
</main>
