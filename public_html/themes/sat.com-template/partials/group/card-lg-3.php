<div class="card">
  <div class="card-body">
    <div class="flex-sb-h">
      <h1><?= $group->title ?></h1>
      <?php if (isset($group->edit_url)): ?>
        <div>
          <a href="<?= $group->edit_url ?>">Edit</a>
        </div>
      <?php endif; ?>
    </div>
    <div class="row">
      <div class="col-xs-1 p-r-0">
        <img src="<?=$user->profile_pic?>" alt="" class="img-responsive">
      </div>
      <div class="col-xs-11">
        <?php partial('author-time', ['a'=>$user->name,'t'=>fdate($group->created_at)]) ?>
        <div>
          <?= $group->detail ?>
        </div>
      </div>
    </div>
  </div>
  <?php if (!isset($detail)): ?>
    <div class="card-footer">
      <a href="<?= $group->url ?>" class="btn-detail"> <i class="glyphicon glyphicon-comment"></i> View <?= $group->comments_count?> earlier replies</a>
    </div>
  <?php endif;?>
</div>
