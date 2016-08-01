<div class="card">
  <div class="card-body">
    <h1><?= $community->title ?></h1>
    <div class="row">
      <div class="col-xs-1 p-r-0">
        <img src="<?= $user->profile_pic?>" class="img-responsive">
      </div>
      <div class="col-xs-11">
        <?php partial('author-time', ['a'=>$user->name,'t'=> fdate($community->created_at)]) ?>
        <div class="des">
          <?= isset($detail) ? $community->detail : excerpt($community->detail, 200) ?>
        </div>
      </div>
    </div>
  </div>
  <?php if (!isset($detail)): ?>
    <div class="card-footer">
        <a href="<?= $community->url ?>" class="btn-detail"> <i class="glyphicon glyphicon-comment"></i> View <?= $community->comments_count?> earlier replies</a>
    </div>
  <?php endif;?>
</div>
