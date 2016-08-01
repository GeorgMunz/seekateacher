<?php layout('recruiter-profile'); ?>

<div class="col-xs-6">
  <?php partial('widgets/widget-listing'); ?>
</div>


<div class="col-xs-6">
  <h1>Teachers that match your advertisement</h1>
  <div class="box-gray-light">
    <div data-plugin="slick" data-slick='{"slidesToShow": 1, "slidesToScroll": 1}'>
      <?php foreach($adv_tchs as $batch): ?>
        <div>
          <div class="flex-wrap flex-sb-h">
          <?php
          foreach($batch as $teacher) {
            partial('teacher/card-sm', ['tch'=>$teacher, 'btn_public_profile'=>true]);
          }
          ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <h1 class="m-t-30">Available Supply Teachers</h1>
  <div class="box-gray-light">
    <div data-plugin="slick" data-slick='{"slidesToShow": 1, "slidesToScroll": 1}'>
      <?php foreach($supply_tchs as $batch): ?>
        <div>
          <div class="flex-wrap flex-sb-h">
          <?php
          foreach($batch as $teacher) {
            partial('teacher/card-sm', ['tch'=>$teacher, 'btn_public_profile'=>true]);
          }
          ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
