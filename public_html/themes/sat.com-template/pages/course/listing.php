<?php layout(['rec'=>'recruiter-profile', 'tch'=>'teacher-profile', 'guest'=>'default']) ?>

<div class="col-xs-4">
  <?php partial('course/sidebar-listing', ['fsp_base_url'=>'/course/listing', 'typeahead_prefetch'=>'/page/courses']) ?>
</div>

<div class="col-xs-8">
  <div class="cards box-gray-light">
    <?php
    foreach ($courses as $course) {
      partial('course/card-lg-4', ['course'=>$course, 'user'=>$course->user]);
    }

    partial('paginations/pagination-center');
    ?>
    </div>
</div>
