<?php layout(['rec'=>'recruiter-profile','tch'=>'teacher-profile']) ?>

<div class="col-xs-4">
  <?php partial('recruiter/sidebar-list', ['title'=>$rec_type]) ?>
</div>

<div class="col-xs-8">
  <div class="box-gray-light cards">
    <?php
    foreach ($recs as $rec) {
      partial('recruiter/card-lg', ['rec'=>$rec]);
    }
    partial('paginations/pagination-center');
    ?>
  </div>
</div>
