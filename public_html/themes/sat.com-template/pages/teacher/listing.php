<?php layout(['rec'=>'recruiter-profile', 'tch'=>'teacher-profile', 'guest'=>'default']) ?>

<div class="col-xs-4">
  <?php partial('teacher/sidebar-listing') ?>
</div>

<div class="col-xs-8">
    <div class="row">
        <div class="col-xs-6">
            <?php
            if (fsp('data', 'search')) {
                echo '<h1>'.pagi('num_rows').' Teacher found for <span class="pink">"' . fsp('data','search') . '"</span></h1>';
            }
            ?>
        </div>
    </div>
  <div class="cards box-gray-light">

      <?php

      if (count($tchs)) {
          foreach($tchs as $tch) {
              partial('teacher/card-lg', ['tch'=>$tch]);
          }
      } else {
          echo '<h1 class="pink">No Teacher Found</h1>';
      }

      partial('paginations/pagination-center');
      ?>
  </div>
</div>
