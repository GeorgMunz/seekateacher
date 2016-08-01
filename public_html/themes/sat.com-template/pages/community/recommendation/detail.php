<?php layout('c1') ?>

<div class="col-xs-12">
  <a href="<?= url('community-recom-listing') ?>" class="link-md">Back to all Recomendations</a>

  <div class="box-gray-light">
    <div class="bg-white">
      <?php partial('community/card-lg-3') ?>
      <?php partial('comments/comments') ?>
      <?php partial('comments/comment-form') ?>      
    </div>
  </div>

</div>
