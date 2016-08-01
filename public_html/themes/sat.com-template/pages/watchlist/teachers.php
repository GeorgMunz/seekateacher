<?php layout('recruiter-profile'); ?>

<div class="col-xs-3">
  <?php partial('navs/nav-recruiter-watchlist'); ?>
</div>

<div class="col-xs-9">
  <div class="box-gray-light cards">
    <?php
    foreach ($tchs as $tch) {
      partial('teacher/card-lg', ['tch'=>$tch]);
    }
    ?>
  </div>
</div>
