<?php layout('teacher-profile') ?>

<div class="col-xs-12">
  <div class="flex-sb-h m-b-30">
    <div>
      <a href="<?=url('group-sc')?>" class="font-lg-regular font-22 m-r-30">Self Created</a>
      <a href="<?=url('group-mi')?>" class="font-lg-regular font-22">Me Included</a>
    </div>
    <a href="<?= url('group-form') ?>" class="btn btn-pink">Start a conversation</a>
  </div>

  <div class="cards box-gray-light">
    <?php
    foreach ($groups as $group) {
      partial('group/card-lg-3', ['group'=>$group, 'user'=>$group->user]);
    }

    partial('paginations/pagination-center');
    ?>
  </div>

</div>
