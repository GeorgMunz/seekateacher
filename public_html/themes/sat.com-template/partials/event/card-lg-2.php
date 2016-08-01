<div class="card">
  <div class="card-body">
    <h1><?= $community->title ?></h1>
    <div class="row">
      <div class="col-xs-8">
        <time class="time">
          <div>
            <span class="month"><?= date('M', strtotime($community->created_at)) ?></span>
            <span class="date"><?= date('d', strtotime($community->created_at)) ?></span>
            <span class ="year"><?= date('Y', strtotime($community->created_at)) ?></span>
          </div>
        </time>
        <?php
        $keyval = ['Venue'=>$community->venue,'Timings'=>"$community->start_time to $community->end_time",'Date'=>fdate($community->start_date) .' to '. fdate($community->end_date)];
        foreach ($keyval as $k=>$v) {
          partial('key-val', ['k'=>$k,'v'=>$v]);
        }
        ?>
      </div>
      <div class="col-xs-3">
        <?php partial('key-val',['k'=>'Created By','v'=>$user->name]) ?>
        <?php partial('key-val',['k'=>'Posted On','v'=>$community->created_at]) ?>
      </div>
    </div>
  </div>
  <?php if (isset($detail)): ?>
    <div class="card-des" style="padding-left:105px;">
      <?= $community->detail ?>
    </div>
  <?php else: ?>
    <div class="card-footer">
      <a href="<?= $community->url ?>" class="btn-detail"> <i class="glyphicon glyphicon-comment"></i> View <?= $community->comments_count?> earlier replies</a>
    </div>
  <?php endif; ?>
</div>
