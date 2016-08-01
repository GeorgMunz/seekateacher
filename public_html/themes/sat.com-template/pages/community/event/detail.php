<?php layout('c1') ?>

<div class="col-xs-12">
  <a href="<?= url('community-event-listing') ?>" class="link-md">Back to all Events</a>

  <div class="box-gray-light">
    <div class="bg-white">
      <?php
      partial('event/card-lg-2');
      partial('comments/comments');
      partial('comments/comment-form')
      ?>
    </div>
  </div>
</div>
