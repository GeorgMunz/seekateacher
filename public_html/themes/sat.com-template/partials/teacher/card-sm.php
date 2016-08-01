<div class="card card-style-2">
  <div class="card-body">
    <div class="row">
      <div class="col-xs-4 p-r-0">
        <img src="<?= $tch->profile_pic ?>" class="img-responsive">
      </div>
      <div class="col-xs-8">
        <h2 class="m-t-0"><?= excerpt($tch->name,15) ?></h2>
        <h3 class="pink m-t-0"><?= excerpt($tch->subject_main,15) ?></h3>
        <h3 class="m-b-0"><?= $tch->location ?></h3>
      </div>
    </div>
  </div>
  <div class="card-footer">
    <?php if (isset($btn_member) && $btn_member): ?>
      <?php if ($tch->is_member): ?>
        <a href="<?=$tch->add_member_url?>" class="btn btn-orange btn-block r-a-0" data-action-btn data-args='<?= $tch->data_module ?>'>Remove</a>
      <?php else: ?>
        <a href="<?=$tch->add_member_url?>" class="btn btn-blue btn-block r-a-0" data-action-btn data-args='<?= $tch->data_module ?>'>Add</a>
      <?php endif; ?>
    <?php endif; ?>

    <?php if (isset($btn_invite) && $btn_invite): ?>
      <?php if ($tch->action_invite_status): ?>
        <button data-module="action-btn" data-action-btn='<?=$tch->action_invite?>' class="btn btn-orange btn-block r-a-0">Invited</button>
      <?php else: ?>
        <button data-module="action-btn" data-action-btn='<?=$tch->action_invite?>' class="btn btn-blue btn-block r-a-0">Invite</button>
      <?php endif; ?>
    <?php endif; ?>

    <?php if (isset($btn_public_profile)): ?>
      <a href="<?=$tch->public_profile?>" class="btn btn-blue btn-block r-a-0">View</a>
    <?php endif; ?>
  </div>
</div>
