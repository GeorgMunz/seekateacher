<?php layout('recruiter-profile'); ?>

<div class="col-xs-12">
  <h1 class="mar-t-0">Jobs I have posted…</h1>
</div>

<aside class="col-xs-4">
  <?php partial('job/sidebar-listing', ['fsp_base_url'=>'/job/manage', 'typeahead_prefetch'=>'/page/jobs/'.(count($jobs)?$jobs[0]->user->id:'0')]) ?>
</aside>

<main class="col-xs-8">
  <div class="box-gray-light cards">
    <?php
    foreach ($jobs as $job) {
      partial('job/card-lg-7', ['job'=>$job]);
    }
    partial('paginations/pagination-center');
    ?>
  </div>
</main>
