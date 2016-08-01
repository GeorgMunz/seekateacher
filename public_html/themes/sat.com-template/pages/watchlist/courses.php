<?php layout('recruiter-profile'); ?>

<div class="col-xs-3">
  <?php partial('navs/nav-recruiter-watchlist'); ?>
</div>

<div class="col-xs-9">
  <div class="box-gray-light cards">
    <?php
    foreach ($courses as $course) {
      partial('course/card-lg-4', ['course'=>$course, 'user'=>$course->user]);
    }
    ?>
  </div>
</div>
