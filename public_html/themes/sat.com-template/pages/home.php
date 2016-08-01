<?php layout('full-width') ?>

<?php partial('home/section-search') ?>

<div class="p-y-30 container">
  <h1 class="pink">Latest SCHOOL JOBS</h1>
  <div data-plugin="slick" data-slick='{"slidesToShow": 4, "slidesToScroll": 1}'>
    <?php foreach ($jobs as $job): ?>
      <?php partial('job/card-sm', ['job'=>$job,'user'=>$job->user]) ?>
    <?php endforeach; ?>
  </div>
</div>


<?php partial('home/section-hiw') ?>
