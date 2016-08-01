<?php layout('teacher-profile') ?>

<div class="col-xs-12">
  <a href="<?= url('community-request-listing') ?>" class="link-md">Back to all Request</a>

  <div class="box-gray-light">
    <?php
    partial('community/card-lg-3');
    partial('comments/comments');
    partial('comments/comment-form')
    ?>
  </div>

</div>
