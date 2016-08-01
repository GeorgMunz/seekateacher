<?php layout('teacher-profile') ?>

<div class="col-xs-12">

  <div class="flex-sb-h">
    <a href="<?= url('group-sc')?>" class="pink font-22 font-lg-regular">Back to all Groups</a>
    <a href="<?= url('group-view-members', $group_id)?>" class="pink font-22 font-lg-regular">View Members</a>
  </div>

  <div class="box-gray-light">

    <div class="bg-white">
      <?php
      partial('group/card-lg-3', ['group'=>$group, 'user'=>$group->user, 'detail'=>true]);
      partial('comments/comments', ['comments'=>$comments]);
      partial('comments/comment-form', ['url'=>url('group-comment-post')]);
      ?>
    </div>
  </div>

</div>
