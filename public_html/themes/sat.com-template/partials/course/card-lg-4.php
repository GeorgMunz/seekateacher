<div class="card">
  <div class="card-body row">
    <div class="col-xs-3">
      <img src="<?= $course->upload_cover_img->uri ?>" class="img-responsive">
    </div>
    <div class="col-xs-5">
      <h1 class="pink"><?= $course->title ?></h1>
      <h2><?= $user->org_name ?></h2>
      <h2 class="blue"><?= $user->org_loc ?>, <?= $user->borough ?></h2>
    </div>
    <div class="col-xs-4">
      <div class="flex-sb-v">
        <div>
          <?php if (isset($course->actions)): ?>
          <div class="flex-end">
            <a href="<?= $course->edit_url ?>" class="darkpink">Edit</a>
          </div>
          <?php endif; ?>

          <div>
            <p>
              <span class="gray-dark">Start Date:</span>
              <?= $course->start_date ?></dd>
            </p>
            <p>
              <span class="gray-dark">End Date:</span>
              <?= $course->end_date ?></dd>
            </p>
            <p>
              <span class="gray-dark">Price:</span>
              <span class="pink"><?= $course->price_f ?></span>
            </p>
            <?php if ($course->action_watchlist_status): ?>
              <button data-module="action-btn" data-action-btn='<?=$course->action_watchlist?>' class="btn-pink">Watching</button>
            <?php else: ?>
              <button data-module="action-btn" data-action-btn='<?=$course->action_watchlist?>' class="btn-pink">Add to Watchlist</button>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php if (!isset($detail)):?>
    <div class="card-footer">
      <a href="<?= $course->url ?>" class="btn btn-blue r-a-0 btn-block">View More</a>
    </div>
  <?php endif;?>
</div>
