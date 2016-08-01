<?php layout('teacher-profile'); ?>
<div class="col-xs-12">

  <div class="flex-sb-h pad-15">
    <h1 class="pink">Members</h1>
    <?php if ($self_created): ?>
      <p>
        <a href="<?= url('group-sc') ?>" class="btn btn-pink btn-xs">Save</a>
      </p>
    <?php endif;?>
  </div>

  <div class="box-gray-light">
    <div class="card-container cards-4"
    data-module="Group"
    data-action="initActions"
    data-args='<?= $data_module ?>'>
      <?php
      foreach($tchs as $tch) {
        partial('teacher/card-sm', ['tch'=>$tch, 'group_id'=>$group_id, 'btn_member' => $self_created]);
      }
      ?>
    </div>

  </div>
</div>
